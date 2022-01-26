<?php 

class Model_products extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the brand data */
	public function getProductData($cust_id= null, $id = null)
	{
		if($id) {
			$sql = "SELECT * FROM products LEFT JOIN product_type pt ON(pt.type_id = product_code) where customer_id = $cust_id AND id = ?";
			// $CI->db->join('user_email', 'user_email.user_id = emails.id', 'left');
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM products LEFT JOIN product_type pt ON(pt.type_id = product_code) WHERE customer_id = $cust_id ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getProductDataAsPerCompany($company_id = null, $customer_id = null, $id = null)
	{
		if($company_id && $id) {
			$sql = "SELECT * FROM products LEFT JOIN product_type pt ON(pt.type_id = product_code) where customer_id = $customer_id AND  company_id = ? && id = ?";
			$query = $this->db->query($sql, array($company_id,$id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM products LEFT JOIN product_type pt ON(pt.type_id = product_code) where customer_id = $customer_id AND company_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($company_id));
		return $query->result_array();
	}

	public function getActiveProductData()
	{
		$sql = "SELECT * FROM products WHERE availability = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('products', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('products', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('products');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalProducts()
	{
		$sql = "SELECT * FROM products";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


	public function countTotalbrands()
	{
		$sql = "SELECT * FROM brands";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countTotalcategory()
	{
		$sql = "SELECT * FROM categories";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


	public function countTotalattribures()
	{
		$sql = "SELECT * FROM attributes";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function countTotalProductsAsPerComp($company_id = null)
	{
		$sql = "SELECT * FROM products where company_id = ?";
		$query = $this->db->query($sql, array($company_id));
		return $query->num_rows();
	}

	public function getproductdata_isunique($product_id, $code)
    {
        $this->db->where('product_code', $code);
        $this->db->where_not_in('id', $product_id);
        $this->db->from('products');
        return $this->db->count_all_results();
    }
    
    // ==========================

    public function create_product($data)
	{
		if($data) {
			$insert = $this->db->insert('product_type', $data);
			return ($insert == true) ? true : false;
		}		
	}

	/* get the brand data */
	public function getProductTypeData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM product_type where type_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM product_type ORDER BY type_id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getProductTypeDataAsPerCompany($company_id = null, $id = null)
	{
		if($company_id && $id) {
			$sql = "SELECT * FROM product_type where company_id = ? && type_id = ?";
			$query = $this->db->query($sql, array($company_id,$id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM product_type where company_id = ? ORDER BY type_id DESC";
		$query = $this->db->query($sql, array($company_id));
		return $query->result_array();
	}

	public function getproducttypedata_isunique($type_id, $code)
    {
        $this->db->where('product_type', $code);
        $this->db->where_not_in('type_id', $type_id);
        $this->db->from('product_type');
        return $this->db->count_all_results();
    }

    public function update_ptype($data, $id)
	{
		if($data && $id) {
			$this->db->where('type_id', $id);
			$update = $this->db->update('product_type', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove_ptype($id)
	{
		if($id) {
			$this->db->where('type_id', $id);
			$delete = $this->db->delete('product_type');
			return ($delete == true) ? true : false;
		}
	}
    // ==========================
}