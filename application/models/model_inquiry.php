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

	   // $record = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),$number) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE company_id = $company_id")->result_array();

		$record = $this->db->query("SELECT REGEXP_SUBSTR(inquiry_number,'[0-9]+') as inquiry_number FROM inquiry WHERE company_id = $company_id order by inquiry_id desc limit 1")->result_array();
		// $record = "SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),$number) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE company_id = $company_id";
	    if((empty($record[0]['inquiry_number'])))
	    {
	      return $prefix.$count.$sufix;
	    }
	    else
	    {
	      $str = $record[0]['inquiry_number'] + 1;
	      $code = $prefix.$str.$sufix;

		  return $code;
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
		if($id) {
			$sql = "SELECT * FROM inquiry where company_id = ? && inquiry_id = ?";
			$query = $this->db->query($sql, array($company_id,$id));
			return $query->row_array();
		}
		$sql = "SELECT * FROM inquiry where company_id = ? ORDER BY inquiry_id DESC";
		$query = $this->db->query($sql, array($company_id));
		return $query->result_array();		
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
		$sql = "SELECT * FROM products where customer_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function getproductListData($id)
	{
		$sql = "SELECT * FROM products where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();	
	}

	public function getproductListDataFromInquiry($comp_id,$id)
	{
		$sql = "SELECT * FROM inquiry_trans where company_id = $comp_id AND product_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();	
	}

	public function getDeptWiseuserListData($dept_id)
	{
		$sql = "SELECT * FROM users where department_id = $dept_id";
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
}