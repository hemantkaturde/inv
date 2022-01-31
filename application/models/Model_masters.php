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
    /* Function End Here*/
	
	/* This Function is used To create department*/
    public function departmentCreate($data){
		if($data) {
			$insert = $this->db->insert('department', $data);
			return ($insert == true) ? true : false;
		}

	}
	/* Function End Here*/

	public function CheckdepartmentAlreadyExist($department ,$companyid){

			$sql = "SELECT * FROM department where company_id = ? && `department` = ?";
			$query = $this->db->query($sql, array($companyid, $department));
			$record = $query->row_array();
			return $record;

	}

	public function delete($id)
	{
		$this->db->where('deprt_id', $id);
		$delete = $this->db->delete('department');
		return ($delete == true) ? true : false;
	}

	public function departmentUpdate($data, $id)
	{
		$this->db->where('deprt_id', $id);
		$this->db->where('company_id', $id);
		$update = $this->db->update('department', $data);
		return ($update == true) ? true : false;	
	}



}