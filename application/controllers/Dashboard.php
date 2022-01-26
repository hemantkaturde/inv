<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('Model_products');
		// $this->load->model('model_orders');
		$this->load->model('Model_users');
		$this->load->model('Model_company');
		$this->load->model('Model_inquiry');
		// $this->load->model('model_stores');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		// if ($is_admin == true) {
		// 	$this->data['total_company'] = $this->Model_company->countTotalCompany();
		// 	$this->data['total_users'] = $this->Model_users->countTotalUsers();
		// 	$this->data['total_products'] = $this->Model_products->countTotalProducts();
		// 	$this->data['total_inquiry'] = $this->Model_inquiry->countTotalinquiry();
		// }
		// else
		// {   
			
			$this->data['total_company'] = $this->Model_company->countTotalCompany();
			$this->data['total_users'] = $this->Model_users->countTotalUsersAsPerComp($_SESSION['company_id']);
			$this->data['total_products'] = $this->Model_products->countTotalProductsAsPerComp($_SESSION['company_id']);
			$this->data['total_inquiry'] = $this->Model_inquiry->countTotalinquiryAsPerComp($_SESSION['company_id']);
		// }
		

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}