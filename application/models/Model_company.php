<?php 

class Model_company extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCompanyData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM company where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM company ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('company', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('company', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('company');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalCompany()
	{
		$sql = "SELECT * FROM company";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getcompanydata_isunique($id,$company)
	{
		$this->db->where('company_name', $company);
        $this->db->where_not_in('id', $id);
        $this->db->from('company');
        return $this->db->count_all_results();
	}

	// === GET COMPANY ATTACHMENTS
	public function getCompanyAttachments($id = null)
	{
		$sql = "SELECT * FROM company_trans WHERE comp_id = $id ORDER BY id DESC";
		$query = $this->db->query($sql);
		$record['comp_trans'] = $query->result_array();
		return $record;
	}

	public function create_trans($data)
	{
		if($data) {
			$insert = $this->db->insert('company_trans', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function removeTrans($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('company_trans');
			return ($delete == true) ? true : false;
		}
	}

	public function getDepartmentData($id=null,$company_id){
		if($id) {
			$sql = "SELECT * FROM department";
			$query = $this->db->query($sql, array($id,$company_id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM department ORDER BY deprt_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();

	}

}