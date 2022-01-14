<?php 

class Model_inquiry extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_max_id($table, $field)
  	{
  		$company_id = $_SESSION['company_id'];
  		$company_name = $_SESSION['company_name'];
  		$name = substr($company_name, 0,1);

	    $record = $this->db->query("SELECT MAX(CAST(SUBSTR(TRIM(inquiry_number),2) AS UNSIGNED)) AS inquiry_number FROM inquiry WHERE inquiry_number RLIKE '$name' AND company_id = $company_id")->result_array();

	    if(empty($record[0]['inquiry_number']))
	    {
	      return $name.'1001';
	    }
	    else
	    {
	      $str = $record[0]['inquiry_number'] + 2;
	      $code = $name.$str;
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
}