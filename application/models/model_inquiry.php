<?php 

class Model_inquiry extends CI_Model
{
	public $CI="";
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}

	function get_record($table='', $condition){

		return $this->CI->db->get_where($table,$condition)->result_array();
	}
	function delete_record($table='',$arr=''){

		return $this->CI->db->delete($table,$arr);
	}

	function data_update($table='',$arr='',$field='',$value=''){

		$this->CI->db->where($field,$value);
		return $this->CI->db->update($table,$arr);
	}
	
	public function get_max_id($table, $field)
  	{
  		$company_id = $_SESSION['company_id'];

  		$check_comp = $this->db->query("SELECT prefix, count, sufix FROM company WHERE id = $company_id")->result_array();

  		$prefix = $check_comp[0]['prefix'];
  		$count = $check_comp[0]['count'];
  		$sufix = $check_comp[0]['sufix'];
  		$number = strlen($check_comp[0]['count']);


		if($check_comp[0]['prefix'] && $check_comp[0]['count'] && $check_comp[0]['sufix']){
	    // $record = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),$number) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE company_id = $company_id")->result_array();
		$record = $this->db->query("SELECT  inquiry_number FROM inquiry WHERE company_id = $company_id order by inquiry_id desc limit 1")->result_array();
		// $record = "SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),$number) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE company_id = $company_id";
        $getOnlyNumbersFromString = preg_replace('/[^0-9.]+/', '', $record[0]['inquiry_number']);

	    if(empty($getOnlyNumbersFromString))
	    {
			///$str = $record[0]['inquiry_number'] + 1;
			$code = $check_comp[0]['prefix'].$number.$compSuffixPrefix[0]['sufix'];
			return $code;
	    }
	    else
	    {	
	      $str = $getOnlyNumbersFromString + 1;
	      $code = $prefix.$str.$sufix;
		  return $code;

	    }
	  }else{

		return '';
	  }
  	}


	public function get_auto_increment_id($table, $field)
  	{

		$company_id = $_SESSION['company_id'];
  		$check_comp = $this->db->query("SELECT prefix, count, sufix FROM company WHERE id = $company_id")->result_array();
  		$prefix = $check_comp[0]['prefix'];
  		$count = $check_comp[0]['count'];
  		$sufix = $check_comp[0]['sufix'];
  		$number = strlen($check_comp[0]['count']);

		  if($check_comp[0]['prefix'] && $check_comp[0]['count'] && $check_comp[0]['sufix']){

			$record = $this->db->query("SELECT auto_count_number FROM inquiry WHERE company_id = $company_id order by inquiry_id desc limit 1")->result_array();
			// $record = "SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),$number) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE company_id = $company_id";
			$getOnlyNumbersFromString = preg_replace('/[^0-9.]+/', '', $record[0]['auto_count_number']);

			//print_r();
	
			if(empty($getOnlyNumbersFromString))
			{
				///$str = $record[0]['inquiry_number'] + 1;
				$code = array('prefix'=>$check_comp[0]['prefix'],'count'=>$getOnlyNumbersFromString+1,'sufix'=>$check_comp[0]['sufix']);
				return $code;
			}
			else
			{	
			  $str = $getOnlyNumbersFromString + 1;
			  $code = $prefix.$str.$sufix;

			  $code = array('prefix'=>$prefix,'count'=>$str,'sufix'=>$sufix);
			   return $code;
			}

		  }else{

			return '';
		  }
	}




	/* get the brand data */
	public function getInquiryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM inquiry where inquiry_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM inquiry ORDER BY inquiry_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInquiryProductData($id)
	{
		$sql = "SELECT it.*,p.name FROM inquiry_trans it LEFT JOIN products p ON(p.id = it.product_id) WHERE trans_inquiry_id = $id ORDER BY trans_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getInquiryDataAsPerCompany($company_id = null, $id = null)
	{

		if($_SESSION['username']=="Superadmin"){
						if($id) {
							$sql = "SELECT * FROM inquiry 
								left join users on inquiry.inquiry_emp_assigned = users.id 
								left join department on users.department_id =department.deprt_id
								where inquiry.company_id = ? && inquiry.inquiry_id = ?";
							$query = $this->db->query($sql, array($company_id,$id));
							return $query->row_array();
						}
						$sql = "SELECT * FROM inquiry 
								left join users on inquiry.inquiry_emp_assigned = users.id 
								left join department on users.department_id =department.deprt_id
								where inquiry.company_id = ? ORDER BY inquiry.inquiry_id DESC";
						$query = $this->db->query($sql, array($company_id));
						return $query->result_array();	
					}else{

						$user_id = $_SESSION['id'];
						if($id) {
							$sql = "SELECT * FROM inquiry 
								left join users on inquiry.inquiry_emp_assigned = users.id 
								left join department on users.department_id =department.deprt_id
								where inquiry.company_id = ? && inquiry.inquiry_id = ? AND inquiry.inquiry_emp_assigned=$user_id";
							$query = $this->db->query($sql, array($company_id,$id));
							return $query->row_array();
						}
						$sql = "SELECT * FROM inquiry 
								left join users on inquiry.inquiry_emp_assigned = users.id 
								left join department on users.department_id =department.deprt_id
								where inquiry.company_id = ? AND inquiry.inquiry_emp_assigned=$user_id  ORDER BY inquiry.inquiry_id DESC";
						$query = $this->db->query($sql, array($company_id));
						return $query->result_array();	

					}
						
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('inquiry', $data);
			return ($insert == true) ? true : false;
		}
	}

	function insert_id($table='',$arr=''){

		$this->CI->db->insert($table,$arr);
		return $this->CI->db->insert_id();
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('inquiry_id', $id);
			$update = $this->db->update('inquiry', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('inquiry_id', $id);
			$delete = $this->db->delete('inquiry');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalinquiry()
	{
		$sql = "SELECT * FROM inquiry";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function create_invoice($data)
	{
		if($data) {
			$insert = $this->db->insert('invoice', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function countTotalinquiryAsPerComp($company_id = null)
	{
		$sql = "SELECT * FROM inquiry where company_id = ?";
		$query = $this->db->query($sql, array($company_id));
		return $query->num_rows();
	}

	public function getproductList_aspercustomer($id)
	{
		$sql = "SELECT * FROM products join product_type on products.product_code =product_type.type_id  where customer_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getproductListData($id)
	{
		$sql = "SELECT * FROM products where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();	
	}

	public function getproductListDataFromInquiry($comp_id,$id,$inquiry_id)
	{

		$sql = "SELECT * FROM inquiry_trans where  company_id = $comp_id AND product_id = ? AND trans_inquiry_id = ?";
		$query = $this->db->query($sql, array($id,$inquiry_id));
		return $query->result_array();	
	}

	public function getDeptWiseuserListData($dept_id)
	{
		$company_id =$_SESSION['company_id'];
		$sql = "SELECT * FROM users where department_id = $dept_id and company_id= $company_id";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}

	public function getInquiryCustomerData($company_id,$id){
		$sql = "SELECT *,customers.delivery_address as customer_billing,inquiry.freight_charges,products.name as productname,inquiry_trans.qty as inquiry_qty,customers.name as customername,customers.phone as customerphone,customers.mobile as customermobile,customers.gst_no as gst_number, company.address as company_address, company.factory_address as company_factory_address, product_type.product_type as product_type FROM inquiry 
		join customers on inquiry.customer_id= customers.id
		join inquiry_trans on inquiry_trans.trans_inquiry_id=inquiry.inquiry_id
		join company on company.id=inquiry.company_id
		join products on products.id=inquiry_trans.product_id
		join product_type on product_type.type_id=products.product_code where customers.company_id=$company_id
		And inquiry_trans.company_id=$company_id AND products.company_id=$company_id And inquiry.inquiry_id=$id";
		// $sql = "SELECT * FROM inquiry";
		$query = $this->db->query($sql);
		return $query->result_array();	

	}


	public function GetCompanyName($company_id){
		$sql = "SELECT * FROM company where id = $company_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	
	public function getInquiryDetails($company_id,$id){
		$sql = "SELECT * FROM inquiry  where company_id=$company_id AND inquiry_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getnotesData($company_id, $id){
		$sql = "SELECT * FROM inquiry_notes  where company_id=$company_id AND inquiry_id = $id";
		$query = $this->db->query($sql);
		return $query->result_array();

	}

	public function create_notes($data)
	{
		if($data) {
			$insert = $this->db->insert('create_notes', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function _fetechAssineedata($id,$company_id){
		$sql = "SELECT *,customers.email as customer_email,inquiry.inquiry_id as in_id,users.email as user_email FROM inquiry
		  left join users on inquiry.inquiry_emp_assigned = users.id 
		  left join department on users.department_id =department.deprt_id
		  left join customers on inquiry.customer_id =customers.id
		  where inquiry.company_id=$company_id  AND users.company_id= $company_id  AND inquiry.inquiry_id = $id";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function _fetechProductdata($company_id,$enquiry_id){
		$sql = "SELECT * FROM inquiry_trans 
		        JOIN products ON inquiry_trans.product_id=products.id 
				JOIN product_type ON products.product_code=product_type.type_id 
				where inquiry_trans.company_id=$company_id AND inquiry_trans.trans_inquiry_id=$enquiry_id";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function getInquiryTrackDetails($company_id,$enquiry_id){
		$sql = "SELECT * FROM invoice 
		join users on invoice.user_id = users.id
		join department on users.department_id = department.deprt_id
		where invoice.company_id=$company_id AND invoice.inquiry_id=$enquiry_id  order by invoice_id DESC";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}

	public function checkIfEnquirynumberExits($company_id,$enquiry_id){
		$sql = "SELECT * FROM inquiry where company_id=$company_id AND inquiry_number='$enquiry_id'";
		$query = $this->db->query($sql);
		return $query->num_rows();
		
	}


	public function checkIfEnquirynumberExitsedit($company_id,$enquiry_id,$id){
		$sql = "SELECT * FROM inquiry where company_id=$company_id AND inquiry_number='$enquiry_id' AND inquiry_id = $id";
		$query = $this->db->query($sql);
		return $query->num_rows();
		
	}

	public function checkIfEnquirynumberExitseditwithoutid($company_id,$enquiry_id){
		$sql = "SELECT * FROM inquiry where company_id=$company_id AND inquiry_number=$enquiry_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
		
	}

	public function getInquirynotes($company_id,$enquiry_id){
		$user_id =$_SESSION['id'];
		$sql = "SELECT * FROM inquiry_notes
		where company_id=$company_id AND inquiry_id=$enquiry_id AND `user_id`=$user_id order by id DESC";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}


	public function create_notes_data($data)
	{
		if($data) {
			$insert = $this->db->insert('inquiry_notes', $data);
			return ($insert == true) ? true : false;
		}
	}


	public function getUser_list($company_id){

		$sql = "SELECT *,users.id as userid FROM users join department ON users.department_id = department.deprt_id
		         where users.company_id=$company_id order by users.id DESC";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}


	public function getSalesorderdonebyData($company_id,$sales_order_done_by_id){

		$sql = "SELECT *,users.id as userid FROM users join department ON users.department_id = department.deprt_id
		         where users.company_id=$company_id  AND users.id=$sales_order_done_by_id";
		$query = $this->db->query($sql);
		if($query){
			return $query->result_array();
		}else{
			return array();
		}
	}

}