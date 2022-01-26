<?php 

class Controller_Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Customer';
		$this->load->model('Model_customer');
		$this->load->model('Model_groups');
	}

	public function index()
	{
		$this->render_template('customer/index', $this->data);
	}

	public function fetchCustomerData()
    {
        $result = array('data' => array());
        $data = $this->Model_customer->getCustomerDataAsPerCompany($_SESSION['company_id']);
        foreach ($data['customer'] as $key => $value) {
            if (($_SESSION['company_id'] == $value['company_id'])) {
                $buttons = '';
                    // $buttons .= ' <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_attachment" onclick="addAttach_Func('.$value['id'].')"><i class="fa fa-file"></i></button>';
                    $buttons .= ' <a href="'.base_url('Controller_Customer/attachment/'.$value['id']).'" class="btn btn-info btn-sm"><i class="fa fa-upload"></i></a>';
                    $buttons .= ' <a href="'.base_url('Controller_Customer/edit/'.$value['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
                    $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                    $buttons .= ' <a href="'.base_url('Controller_Products/index/'.$value['id']).'" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a>';
                // if (!empty($value['cust_attachment'])) {
                //     $img = '<img src="'.base_url($value['cust_attachment']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
                // }else
                // {
                //     $img = "";
                // }
                $result['data'][$key] = array(
                    // $img,
                    $value['name'],
                    $value['phone'],
                    $value['email'],
                    $buttons
                );
            }
        } // /foreach
        
        echo json_encode($result);
    }
	public function create()
	{
		$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('customer', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            // $upload_image = $this->upload_image();
             $check_customer = $this->Model_customer->CheckCustomerAlreadyExist(trim($this->input->post('customer')),$_SESSION['company_id']);
        
             if($check_customer){
                $this->session->set_flashdata('errors', 'Customer Alreday Exits!');
        		redirect('Controller_Customer/create', 'refresh');

             }else{
        	$data = array(
        		'name' => $this->input->post('customer'),
                'company_id' => $_SESSION['company_id'],
        		'contact_person' => $this->input->post('contact_person'),
        		'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
        		'email' => $this->input->post('email'),
        		'email_2' => $this->input->post('email2'), 
        		// 'cust_attachment' => $upload_image,       		
        		'gst_no' => $this->input->post('gst'),
        		'pan_no' => $this->input->post('pan_no'),
        		'address' => $this->input->post('address'),
        		'delivery_address' => $this->input->post('del_address'),
        		'notes' => $this->input->post('notes')
        	);

        	$create = $this->Model_customer->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Controller_Customer/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Customer/create', 'refresh');
        	}
        }
        }
        else {
            // false case

            $this->render_template('customer/create', $this->data);
        }
	}

	public function edit($id = null)
	{
		// if(!in_array('updateCustomer', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		if($id) {

			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('customer', 'Customer name', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
		          $customer = $this->input->post('customer');
                  $customer_data = $this->Model_customer->getCustomerData_isunique($id, $customer);
                  // echo $customer_data['name'];
                  // print_r($customer_data);exit;
                  
                  if($customer_data > 0)
                  {
                    $this->session->set_flashdata('error', 'Customer name is already exist');
                    redirect('Controller_Customer/edit/'.$id, 'refresh');

                  }else{

		        	$data = array(
		        	
        				'name' => $this->input->post('customer'),
                        'company_id' => $_SESSION['company_id'],
        				'contact_person' => $this->input->post('contact_person'),
		        		'phone' => $this->input->post('phone'),
                        'mobile' => $this->input->post('mobile'),
		        		'email' => $this->input->post('email'),
		        		'email_2' => $this->input->post('email2'),
		        		'gst_no' => $this->input->post('gst'),
		        		'pan_no' => $this->input->post('pan_no'),
		        		'address' => $this->input->post('address'),
		        		'delivery_address' => $this->input->post('del_address'),
		        		'notes' => $this->input->post('notes')
				    );

		        	// if($_FILES['cust_attach']['size'] > 0) {
		         //        $upload_image = $this->upload_image();
		         //        $upload_image = array('cust_attachment' => $upload_image);
		                
		         //        $this->Model_customer->update($upload_image, $id);
		         //    }

		        	$update = $this->Model_customer->edit($data, $id);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('Controller_Customer/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('Controller_Customer/edit/'.$id, 'refresh');
		        	}
		        }
	        }
	        else {
	            // false case
	        	$customer_data = $this->Model_customer->getCustomerData($id);

	        	$this->data['customer_data'] = $customer_data;

				$this->render_template('customer/edit', $this->data);	
	        }	
		}	
	}

	public function remove()
    {
        // if(!in_array('deleteCustomer', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $delete = $this->Model_customer->remove($id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    // === ADD ATTACHMENT TRANSACTION

    public function attachment($id = null)
    {
        if($id)
        {
            // print_r($id);
            $this->data['id'] = $id;
            $this->render_template('customer/customer_attachment', $this->data);
        }
    }

    public function fetchCustomerAttachments($id= null)
    {
        $result = array('data' => array());
        $data = $this->Model_customer->getCustomerAttachments($id);
        // print_r($data);

        foreach ($data['cust_trans'] as $key => $value) {
                $buttons = '';
                $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeTransFunc('.$value['id'].')" data-toggle="modal" data-target="#removeTransModal"><i class="fa fa-trash"></i></button>';
            
                if(!empty($value['attach_img']))
                {
                    $substring = substr($value['attach_img'], strpos($value['attach_img'], '_image/')+7);
                }
                else
                {
                    $substring = "";
                }
                // $attachments = "";
                $attachments = '<a href="'.base_url().$value['attach_img'].'" target="_blank" download><i class="fa fa-eye"></i></a>';
       
                $result['data'][$key] = array(
                    $value['attach_name'],
                    // $value['attach_img'],
                    $substring,
                    $attachments,
                    $buttons
                );
        } // /foreach
        
        echo json_encode($result);
    }
    
    public function add_attachment()
    {
        // print_r($this->input->post());
        $upload_image = $this->upload_image();

        $cust_id = $this->input->post('id');
        $attach_name = $this->input->post('attach_name');

        $response = array();
        if($cust_id) {
            $data = array(
                'cust_id' => $cust_id,
                'attach_name' => $attach_name,
                'attach_img' => $upload_image
            );
            $insert_trans = $this->Model_customer->create_trans($data);
            if($insert_trans == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully Uploaded"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

    public function upload_image()
    {
        // assets/images/cust_attach
        $config['upload_path'] = 'assets/images/customer_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '1000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('attach_img'))
        {
            $error = '';
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['attach_img']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    public function removeTrans()
    {        
        $id = $this->input->post('id');

        $response = array();
        if($id) {
            $delete = $this->Model_customer->removeTrans($id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }
}