<?php 

class Model_masters extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the Department data */
	public function getDepartmentData($company_id = null, $id = null)
	{
		if($company_id && $id) {
			$sql = "SELECT * FROM department where company_id= ? AND deprt_id =?";
			// $CI->db->join('user_email', 'user_email.user_id = emails.id', 'left');
			$query = $this->db->query($sql, array($company_id,$id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM department where company_id= ? ORDER BY deprt_id DESC";
		$query = $this->db->query($sql, array($company_id));
		return $query->result_array();
	}

}