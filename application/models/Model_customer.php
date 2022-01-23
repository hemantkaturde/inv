<?php 

class Model_customer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getCustomerData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customers where id = ?";
			$query = $this->db->query($sql, array($id));
			// return $query->row_array();
			$record['customer'] = $query->row_array();
			return $record;
		}

		$sql = "SELECT * FROM customers ORDER BY id DESC";
		$query = $this->db->query($sql);
		// return $query->result_array();
		$record['customer'] = $query->row_array();
			return $record;
	}

	public function getCustomerAttachments($id = null)
	{
		$sql = "SELECT * FROM customer_trans WHERE cust_id = $id ORDER BY id DESC";
		$query = $this->db->query($sql);
		$record['cust_trans'] = $query->result_array();
		return $record;
	}

	public function getCustomerDataAsPerCompany($company_id = null, $id = null)
	{
		if($company_id && $id) {
			$sql = "SELECT * FROM customers where company_id = ? && id = ?";
			$query = $this->db->query($sql, array($company_id, $id));
			$record['customer'] = $query->row_array();
			return $record;
		}
		$sql = "SELECT * FROM customers where company_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($company_id));
		$record['customer'] = $query->result_array();

		$sql = "SELECT * FROM customer_trans ORDER BY id DESC";
		$query = $this->db->query($sql, array($company_id));
		$record['cust_trans'] = $query->result_array();
		return $record;
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('customers', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function edit($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('customers', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('customers');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalCustomers()
	{
		$sql = "SELECT * FROM customers";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function getCustomerData_isunique($id, $cust)
	{
		$this->db->where('name', $cust);
		$this->db->where_not_in('id', $id);
		$this->db->from('customers');
		return $this->db->count_all_results();
	}

	public function create_trans($data)
	{
		if($data) {
			$insert = $this->db->insert('customer_trans', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function removeTrans($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('customer_trans');
			return ($delete == true) ? true : false;
		}
	}

    public function CheckCustomerAlreadyExist($companyid,$customername){

		$sql = "SELECT * FROM customers where company_id = ? && `name` = ?";
		$query = $this->db->query($sql, array($companyid, $customername));
		$record = $query->row_array();
		return $record;

	}

}