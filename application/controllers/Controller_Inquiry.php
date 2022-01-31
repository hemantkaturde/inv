<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Inquiry extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Inquiry';

		$this->load->model('Model_inquiry');
        $this->load->model('Model_users');
        $this->load->model('Model_customer');
        $this->load->model('Model_products');
        $this->load->model('Model_masters');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        // if(!in_array('viewInquiry', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        $this->data['department'] = $this->Model_masters->getDepartmentData($_SESSION['company_id']);
        $this->data['users'] = $this->Model_users->getUserData();
		$this->render_template('inquiry/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchInquiryData()
	{
		// $result = array('data' => array());
        // if($_SESSION['id'] == 1)
        // {
        //     $data = $this->Model_inquiry->getInquiryData();
        // }
        // else
        // {
            $data = $this->Model_inquiry->getInquiryDataAsPerCompany($_SESSION['company_id']);
        // }

		
		foreach ($data as $key => $value) {

            $customer_data = $this->Model_customer->getCustomerData($value['customer_id']);
			// button
            $buttons = '';
            if((in_array('updateInquiry', $this->permission))) {
    			$buttons .= '<a href="'.base_url('Controller_Inquiry/update/'.$value['inquiry_id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteInquiry', $this->permission)) { 
    			$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['inquiry_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            
            if(in_array('assigntoInquiry', $this->permission)) { 
                $buttons .= ' <a data-toggle="modal" data-target="#addInvoice" onclick="addInvoiceFunc('.$value['inquiry_id'].')"  class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i></a>';
            }

            
            $buttons .= ' <a href="'.base_url('Controller_Tcpdf/purchase_order/'.$value['inquiry_id']).'" class="btn btn-warning btn-sm"><i class="fa fa-file-text-o"></i></a>';
            $buttons .= ' <a href="'.base_url('Controller_Tcpdf/sales_order/'.$value['inquiry_id']).'" class="btn btn-warning btn-sm"><i class="fa fa fa-file"></i></a>';
            $buttons .= ' <a href="'.base_url('Controller_Inquiry/add_notes/'.$value['inquiry_id']).'" class="btn btn-warning btn-sm"><i class="fa fa fa-plus"></i></a>';
         
            $inquiry_date =  date("d-m-Y", strtotime($value['inquiry_date']));
			
            if($value['inquiry_from'] == 1) {
                $inq_from = 'Justdial';
            } else if($value['inquiry_from'] == 2) {
                $inq_from = 'Direct';
            }else if($value['inquiry_from'] == 3) {
                $inq_from = 'Indiamart';
            }else if($value['inquiry_from'] == 4) {
                $inq_from = 'Tradeindia';
            }else if($value['inquiry_from'] == 5) {
                $inq_from = 'Whatsapp';
            }else if($value['inquiry_from'] == 6) {
                $inq_from = 'Telephone';
            }else if($value['inquiry_from'] == 7) {
                $inq_from = 'Email';
            }else if($value['inquiry_from'] == 8) {
                $inq_from = 'Website';
            }else if($value['inquiry_from'] == 9) {
                $inq_from = 'Exhibition';
            }else if($value['inquiry_from'] == 10) {
                $inq_from = 'Other';
            }else {
                $inq_from = "";
            }

            // $qty_status = '';
            if($value['inquiry_status'] == 1) {
                $status = 'Assigned';
            } else if($value['inquiry_status'] == 2) {
                $status = 'In Progress';
            }else if($value['inquiry_status'] == 3) {
                $status = 'Closed';
            }else if($value['inquiry_status'] == 4) {
                $status = "Created";
            }


			$result['data'][$key] = array(
			    $value['inquiry_number'],
				$customer_data['customer']['name'],
                $inq_from,
                $inquiry_date,
                $status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    // === GET PRODUCT LIST AS PER CUSTOMER
    public function get_product_data_asper_customers($id)
    {
        $result = $this->Model_inquiry->getproductList_aspercustomer($id);
        echo json_encode($result);
    }

    public function get_product_data($id)
    {
        $result = $this->Model_inquiry->getproductListData($id);
        echo json_encode($result);
    }

    public function get_product_data_in_inquiry($id)
    {
        $comp_id = $_SESSION['company_id'];
        $result = $this->Model_inquiry->getproductListDataFromInquiry($comp_id,$id);
        echo json_encode($result);
    }

    public function get_userListdata($dept_id)
    {
        $result = $this->Model_inquiry->getDeptWiseuserListData($dept_id);
        echo json_encode($result);   
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		// if(!in_array('createInquiry', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        

		$this->form_validation->set_rules('inq_no', 'Inquiry Number', 'trim|required');
        $this->form_validation->set_rules('inq_date', 'Inquiry Date', 'trim|required');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
            $enq_no = $this->Model_inquiry->get_max_id('inquiry', 'inquiry_number');

            $formdata = $this->input->post();
            // echo "<pre>"; print_r($formdata);
            // exit;

            // $product = implode(',',$this->input->post('product'));
            
        	$data = array(
        		'inquiry_number' => $enq_no,
                'company_id' => $_SESSION['company_id'],
        		'customer_id' => $this->input->post('customer'),
        		'inquiry_from' => $this->input->post('inq_from'),
        		'inquiry_date' => date('Y-m-d', strtotime($this->input->post('inq_date'))),
                'inquiry_status' => 4,
                // 'inquiry_emp_assigned' => $this->input->post('emp_assigned'),
                'inquiry_notes' => $this->input->post('notes')
        	);
            $this->db->trans_begin();
        	// $create = $this->Model_inquiry->create($data);
            $create = $this->Model_inquiry->insert_id('inquiry',$data);
        	if(!empty($create)) {
                if(!empty($this->input->post('inq_trans_id')))
                {
                    $trans_result = $this->data_insert_inquiry_trans($this->input->post(),$create);
                    if($trans_result == 1)
                    {
                        if ($this->db->trans_status() === FALSE)
                        {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('errors', 'Error occurred!!');
        		            redirect('Controller_Inquiry/create', 'refresh');
                        }
                        else
                        {
                            echo $this->db->trans_commit();
                            $this->session->set_flashdata('success', 'Successfully created');
        		            redirect('Controller_Inquiry/', 'refresh');
                        }
                    } // ATTACH TRANS
                }
                else
                {
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('errors', 'Error occurred!!');
        		        redirect('Controller_Inquiry/create', 'refresh');
                    }
                    else
                    {
                        echo $this->db->trans_commit();
                        $this->session->set_flashdata('success', 'Successfully created');
        		        redirect('Controller_Inquiry/', 'refresh');
                    }
                } // ELSE NOT EMPTY ATTACH ID
        		
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Inquiry/create', 'refresh');
        	}
        }
        else {
   //          // false case

               
			$this->data['inq_no'] = $this->Model_inquiry->get_max_id('inquiry', 'inquiry_number');

            // $this->data['users'] = $this->Model_users->getUserData();
            if ($_SESSION['id'] == 0) {
                $this->data['cust'] = $this->Model_customer->getActiveCustomerData();
            }else
            {
                $this->data['cust'] = $this->Model_customer->getActiveCustomerDataAsPerCompany($_SESSION['company_id']);
            }


            $this->data['product'] = $this->Model_products->getActiveProductData();            

            $this->render_template('inquiry/create', $this->data);
        }	
	}
    
    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($inquiry_id)
	{      
        // if(!in_array('updateInquiry', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        if(!$inquiry_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('inq_no', 'Inquiry Number', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            // $product = implode(',',$this->input->post('product'));

            $data = array(
                'inquiry_number' => $this->input->post('inq_no'),
                'customer_id' => $this->input->post('customer'),
                'inquiry_from' => $this->input->post('inq_from'),
                'inquiry_date' => date('Y-m-d', strtotime($this->input->post('inq_date'))),
                // 'inquiry_product' => $product,
                'inquiry_status' => $this->input->post('status'),
                // 'inquiry_emp_assigned' => $this->input->post('emp_assigned'),
                'inquiry_notes' => $this->input->post('notes')
            );

            
            $this->db->trans_begin();
        	// $create = $this->Model_inquiry->create($data);
            $update = $this->Model_inquiry->update($data, $inquiry_id);
        	if(!empty($update)) {
                if(!empty($this->input->post('inq_trans_id')))
                {
                    $trans_result = $this->data_insert_inquiry_trans($this->input->post(),$inquiry_id);
                    if($trans_result == 1)
                    {
                        if ($this->db->trans_status() === FALSE)
                        {
                            $this->db->trans_rollback();
                            $this->session->set_flashdata('errors', 'Error occurred!!');
        		            redirect('Controller_Inquiry/create', 'refresh');
                        }
                        else
                        {
                            $this->db->trans_commit();
                            $this->session->set_flashdata('success', 'Successfully updated');
        		            redirect('Controller_Inquiry/', 'refresh');
                        }
                    } // ATTACH TRANS
                }
                else
                {
                    if ($this->db->trans_status() === FALSE)
                    {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('errors', 'Error occurred!!');
        		        redirect('Controller_Inquiry/create', 'refresh');
                    }
                    else
                    {
                        $this->db->trans_commit();
                        $this->session->set_flashdata('success', 'Successfully updated');
        		        redirect('Controller_Inquiry/', 'refresh');
                    }
                } // ELSE NOT EMPTY ATTACH ID
        		
        	}
            // if($update == true) {
            //     $this->session->set_flashdata('success', 'Successfully updated');
            //     redirect('Controller_Inquiry/', 'refresh');
            // }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Controller_Inquiry/update/'.$inquiry_id, 'refresh');
            }
        }
        else {
            
            $inquiry_data = $this->Model_inquiry->getInquiryData($inquiry_id);
            $inqTrans_data = $this->Model_inquiry->getInquiryProductData($inquiry_id);
            // $this->data['users'] = $this->Model_users->getUserData();
            if ($_SESSION['id'] == 0) {
                $this->data['cust'] = $this->Model_customer->getActiveCustomerData();
            }else
            {
                $this->data['cust'] = $this->Model_customer->getActiveCustomerDataAsPerCompany($_SESSION['company_id']);
            }
            $cust_id = $inquiry_data['customer_id'];
            $this->data['product'] = $this->Model_inquiry->getproductList_aspercustomer($cust_id);
            $this->data['inquiry_data'] = $inquiry_data;
            $this->data['trans_data'] = $inqTrans_data;

            $this->render_template('inquiry/edit', $this->data); 
        }   
	}

    
    function data_insert_inquiry_trans($formdata, $id)
    {
         $db_trans = $this->Model_inquiry->get_record('inquiry_trans',array('trans_inquiry_id' =>$id));
  	    foreach($db_trans as $key => $value)
  	    {
	        if(!in_array( $value['trans_id'], $formdata['inq_trans_id'] ) )
	        {
	            $this->Model_inquiry->delete_record('inquiry_trans',array('trans_id' =>$value['trans_id']));
	        }
	    }

        $flag = 0;
        foreach ($formdata['inq_trans_id'] as $key => $value) 
		{
		  $trans_data = array();
		  $trans_data['trans_inquiry_id']  = $id;
          $trans_data['company_id']  = $_SESSION['company_id'];
		  $trans_data['product_id']  = $formdata['inq_product_id'][$key];
		  $trans_data['qty']	  = $formdata['inq_qty'][$key];
		  $trans_data['rate']= $formdata['inq_rate'][$key];
          $trans_data['final_amount']= $formdata['inq_final_amt'][$key];
	      if($value == 0)
          {
            $result1 = $this->Model_inquiry->insert_id('inquiry_trans',$trans_data);	
          }
          else{
            $result1 = $this->Model_inquiry->data_update('inquiry_trans',$trans_data, 'trans_id', $value);	
          }
          
		  
		  if(!empty($result1))
		  {	$flag = 1; }		
		}
        if($flag == 1)
        {
            return true;
        }

    }


    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        // if(!in_array('deleteInquiry', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
        $inquiry_id = $this->input->post('inquiry_id');

        $response = array();
        if($inquiry_id) {
            $delete = $this->Model_inquiry->remove($inquiry_id);
            if($delete == true)
            {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else
            {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the inquiry information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

    // ================================
    
    public function add_invoice($id)
    {
        // if(!in_array('createInquiry', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        // $this->form_validation->set_rules('invoice_no', 'Invoice Number', 'trim|required');
    
        // if ($this->form_validation->run() == TRUE) {
            // true case
            $enq_no = $this->Model_inquiry->get_max_id('inquiry', 'inquiry_number');
            $data = array(
                'inquiry_id' => $id,
                'company_id' => $_SESSION['company_id'],
                'deprt_id' => $this->input->post('dept_id'),
                'user_id' => $this->input->post('member_id'),
                // 'invoice_no' => $this->input->post('invoice_no'),
                // 'vehicle_no' => $this->input->post('veh_no'),
                // 'invoice_date' => date('Y-m-d', strtotime($this->input->post('invoice_date'))),
                // 'lr_no' => $this->input->post('inv_lr_no'),
                'remark' => $this->input->post('remark')
            );

            $create = $this->Model_inquiry->create_invoice($data);
            $response = array();
            if($create == true)
            {
                $udata = array(
                    'inquiry_status' => 1
                );
                $update = $this->Model_inquiry->update($udata, $id);

                $response['success'] = true;
                $response['messages'] = "Successfully Assigned"; 
            }
            else
            {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the inquiry information";
            }
        // }
        // else {
        //     $response['success'] = false;
        //     $response['messages'] = "Refersh the page again!!";
        // }
        echo json_encode($response);
    }

    public function add_notes($id){
        
        $data['getInquiryDetails'] = $this->Model_inquiry->getInquiryDetails($_SESSION['company_id'], $id);
        $data['notes_data'] = $this->Model_inquiry->getnotesData($_SESSION['company_id'], $id);
        $data['enquiry_id']=$id;
        $this->render_template('inquiry/add_notes', $data);
    }

}