<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Products extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Products';

		$this->load->model('Model_products');
		$this->load->model('Model_brands');
		$this->load->model('Model_category');
		$this->load->model('Model_stores');
		$this->load->model('Model_attributes');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index($id = null)
	{
        // if(!in_array('viewProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        // print_r($_SESSION['company_id']);
        // exit;
        $this->data['id'] = $id;
		$this->render_template('products/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchProductData($id = null)
	{
        // $id = $_GET['id'];
        
		$result = array('data' => array());

        // if($_SESSION['id'] == 1)
        // {
        //     $data = $this->Model_products->getProductData($id);    
        // }
		// else
        // {
            $data = $this->Model_products->getProductDataAsPerCompany($_SESSION['company_id'],$id);
        // }
        

		foreach ($data as $key => $value) {
            // $store_data = $this->Model_stores->getStoresData($value['store_id']);
            // if($_SESSION['company_id'] == $value['company_id']):
			// button
                $buttons = '';
                if(in_array('updateProduct', $this->permission)) {
        			$buttons .= '<a href="'.base_url('Controller_Products/update/'.$value['customer_id'].'/'.$value['id']).'" class="btn btn-warning btn-sm">Edit</a>';
                }

                if(in_array('deleteProduct', $this->permission)) { 
        			$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal">Delete</button>';
                }
    			

    			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
                
                $result['data'][$key] = array(
                    $img,
                    $value['name'],
                    $value['price'],
                    $value['product_type'],
                    $buttons
                );    
                
                
            // endif;
		} // /foreach
        // exit;

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create($id = null)
	{
		// if(!in_array('createProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

		$this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
                'company_id' => $_SESSION['company_id'],
                'customer_id' => $id,
                'qty'=>1,
        		'name' => $this->input->post('product_name'),
        		'product_code' => $this->input->post('product_code'),
        		'price' => $this->input->post('rate'),
        		'image' => $upload_image,
        		'description' => $this->input->post('description'),
                'notes' => $this->input->post('notes')
        	);

        	$create = $this->Model_products->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Controller_Products/index/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Products/create/'.$id, 'refresh');
        	}
        }
        else {
            // false case
            $this->data['id'] = $id;
            $this->data['type'] = $this->Model_products->getProductTypeData();
            $this->render_template('products/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $config['upload_path'].'/5fc5cf759483c.png';
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($customer_id,$product_id)
	{      
        // if(!in_array('updateProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required');
       // $this->form_validation->set_rules('description', 'Description', 'trim');
        // print_r($product_id);exit;

       // $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $code = $this->input->post('product_code');
            $product_data1 = $this->Model_products->getproductdata_isunique($product_id, $code);
            // print_r($product_data1);
            // exit;
            
            // if($product_data1 > 0)
            // {
            //     $this->session->set_flashdata('error', 'Product Description is already exist');
            //     redirect('Controller_Products/update/'.$product_id, 'refresh');

            // }else{
                $data = array(
                    'company_id' => $_SESSION['company_id'],
                    'customer_id' => $customer_id,
                    'qty'=>1,
                    'name' => $this->input->post('product_name'),
                    'product_code' => $this->input->post('product_code'),
                    'price' => $this->input->post('rate'),
                    'description' => $this->input->post('description'),
                    'notes' => $this->input->post('notes')
                );

                
                if($_FILES['product_image']['size'] > 0) {
                    $upload_image = $this->upload_image();
                    $upload_image = array('image' => $upload_image);
                    
                    $this->Model_products->update($upload_image, $product_id);
                }

                $update = $this->Model_products->update($data, $product_id);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('Controller_Products/index/'.$customer_id, 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('Controller_Products/update/'.$customer_id.'/'.$product_id, 'refresh');
                }
            // }
        }
        else {
            
            $product_data = $this->Model_products->getProductData($customer_id, $product_id);
            $this->data['type'] = $this->Model_products->getProductTypeData();
            $this->data['product_data'] = $product_data;
            $this->data['id'] = $customer_id;
            $this->render_template('products/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        // if(!in_array('deleteProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->Model_products->remove($product_id);
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

    // ==================================================
    //          PRODUCT TYPE
    // ==================================================
    public function product_type()
    {
        $this->render_template('products/product_type_list', $this->data);  
    }

    public function create_ptype()
    {
        // if(!in_array('createProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->form_validation->set_rules('product_type', 'Product Type', 'trim|required');
    
        if ($this->form_validation->run() == TRUE) {
            // true case

                    /* Check if Alreday Exits*/

                    $checkifalredayExits = $this->Model_products->checkProductTypeExits($this->input->post('product_type'),$_SESSION['company_id']);

                    if($checkifalredayExits > 0 ){
                        $this->session->set_flashdata('error', 'Product Type Already Exists');
                        redirect('Controller_Products/create_ptype', 'refresh');

                    }else{

                    $data = array(
                        'company_id' => $_SESSION['company_id'],
                        'product_type' => $this->input->post('product_type')
                    );

                    $create = $this->Model_products->create_product($data);
                    if($create == true) {
                        $this->session->set_flashdata('success', 'Successfully created');
                        redirect('Controller_Products/product_type', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Controller_Products/create_ptype', 'refresh');
                    }
                }
        }
        else {
            // false case

            $this->render_template('products/create_product_type', $this->data);
        }   
    }

    // ==========

    public function fetchProductTypeData()
    {
        $result = array('data' => array());

        $data = $this->Model_products->getProductTypeDataAsPerCompany($_SESSION['company_id']);
        

        foreach ($data as $key => $value) {
            // $store_data = $this->Model_stores->getStoresData($value['store_id']);
            // if($_SESSION['company_id'] == $value['company_id']):
            // button
                $buttons = '';
                if(in_array('updateProductType', $this->permission)) {
                    $buttons .= '<a href="'.base_url('Controller_Products/update_ptype/'.$value['type_id']).'" class="btn btn-warning btn-sm">Edit</a>';
                }

                if(in_array('deleteProductType', $this->permission)) { 
                    $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['type_id'].')" data-toggle="modal" data-target="#removeModal">Delete</button>';
                }
                
                $result['data'][$key] = array(
                    $value['product_type'],
                    $buttons
                );    
            
        } // /foreach

        echo json_encode($result);
    }

    // =======
    
    public function update_ptype($type_id)
    {      
        // if(!in_array('updateProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        // if(!$type_id) {
        //     redirect('dashboard', 'refresh');
        // }

        // print_r($type_id);exit;

        $this->form_validation->set_rules('product_type', 'Product Type', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $code = $this->input->post('product_type');
            $product_data1 = $this->Model_products->getproducttypedata_isunique($type_id, $code ,$_SESSION['company_id']);
            
            if($product_data1 > 0)
            {
                    $data = array(
                        'company_id' => $_SESSION['company_id'],
                        'product_type' => $this->input->post('product_type')
                    );

                    $update = $this->Model_products->update_ptype($data, $type_id);
                    if($update == true) {
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('Controller_Products/product_type', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Controller_Products/update_ptype/'.$type_id, 'refresh');
                    }

            }else{

                $product_data2 = $this->Model_products->getproducttypedata_isunique_name($code ,$_SESSION['company_id']);

                   if($product_data2 > 0){
                        $this->session->set_flashdata('error', 'Product Already Exists');
                        redirect('Controller_Products/update_ptype/'.$type_id, 'refresh');

                   }else{

                    $data = array(
                        'company_id' => $_SESSION['company_id'],
                        'product_type' => $this->input->post('product_type')
                    );

                    $update = $this->Model_products->update_ptype($data, $type_id);
                    if($update == true) {
                        $this->session->set_flashdata('success', 'Successfully updated');
                        redirect('Controller_Products/product_type', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Controller_Products/update/'.$type_id, 'refresh');
                    }
                

                   }     
            }
        }
        else {
            
            $product_data = $this->Model_products->getProductTypeData($type_id);
            $this->data['product_data'] = $product_data;
            $this->render_template('products/edit_product_type', $this->data); 
        }   
    }

    // ========
    public function remove_ptype()
    {
        // if(!in_array('deleteProduct', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        
        $type_id = $this->input->post('type_id');

        $response = array();
        if($type_id) {
            $delete = $this->Model_products->remove_ptype($type_id);
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
    // ==================================================

}