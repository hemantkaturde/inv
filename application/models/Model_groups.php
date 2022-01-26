<?php 

class Model_groups extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}

	public function getGroupData($groupId = null) 
	{
		$company_id = $_SESSION['company_id'];
		if($groupId && $company_id) {
			$sql = "SELECT * FROM groups WHERE company_id=? AND id = ?";
			$query = $this->db->query($sql, array($company_id ,$groupId));
			return $query->row_array();
		}else{
			$sql = "SELECT * FROM groups WHERE company_id = ?";
			$query = $this->db->query($sql, $company_id);
			return $query->result_array();
		}
	}

	public function create($data = '')
	{
		$create = $this->db->insert('groups', $data);
		return ($create == true) ? true : false;
	}

	public function edit($data, $id)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('groups', $data);
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('groups');
		return ($delete == true) ? true : false;
	}

	public function existInUserGroup($id)
	{
		$sql = "SELECT * FROM user_group WHERE group_id = ?";
		$query = $this->db->query($sql, array($id));
		return ($query->num_rows() == 1) ? true : false;
	}

	public function getUserGroupByUserId($user_id) 
	{
		$sql = "SELECT * FROM user_group 
		INNER JOIN groups ON groups.id = user_group.group_id 
		WHERE user_group.user_id = ?";
		$query = $this->db->query($sql, array($user_id));
		$result = $query->row_array();

		return $result;

	}

    public function CheckgroupsAlreadyExist($groupname='', $company_id='',$id=''){

		if($id){
			$sql = "SELECT * FROM groups WHERE company_id=? AND group_name =? AND id=?";
			$query = $this->db->query($sql, array($company_id ,$groupname,$id));
			return $query->row_array();

		}else if($groupname && $company_id){

			$sql = "SELECT * FROM groups WHERE company_id=? AND group_name =?";
			$query = $this->db->query($sql, array($company_id ,$groupname));
			return $query->row_array();

		}
	
	}

	




}