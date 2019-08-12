<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Orders extends CI_Controller{

   public function add_orders(){
     if(!$this->session->userdata('is_loggedin')){
       redirect('users/login');
     }

     $user_id = $this->session->userdata('user_id');
     $data['title'] = "Add Orders";
     $data['sidebar_add_orders_active'] = "active";
     $data['userdata'] = $this->users_model->get_userdata($user_id);
     $data['clients'] = $this->clients_model->get_clients();

     //form validation
     $this->form_validation->set_rules('order_name', 'Order Name', 'required');
     $this->form_validation->set_rules('order_client', 'Order Client', 'required');
     $this->form_validation->set_rules('order_budget', 'Order Budget', 'required');
     $this->form_validation->set_rules('order_deadline', 'Submission Date', 'required');
     $this->form_validation->set_rules('order_cat', 'Priority', 'required');

     if($this->form_validation->run() == false){
       $this->load->view('template/header', $data);
       $this->load->view('template/sidebar', $data);
       $this->load->view('orders/add_orders', $data);
       $this->load->view('template/footer');
     }
     else {
       //Get Clients Data From Post
       $order_name = $this->input->post('order_name');
       $order_client = $this->input->post('order_client');
       $order_budget = $this->input->post('order_budget');
       $order_deadline = $this->input->post('order_deadline');
       //$order_document = $this->input->post('order_document');
       $order_msg = $this->input->post('order_msg');
       $order_cat = $this->input->post('order_cat');

       $config['upload_path'] = "./project_document/";
       $config['max_size'] = '0';
       $config['allowed_types'] = "gif|jpg|jpeg|png|iso|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp";

       $this->load->library('upload', $config);

       // check if folder exists
       if( ! is_dir($config['upload_path'])) {
       @mkdir($config['upload_path'], 0755, true);
       }

       if($this->upload->do_upload('order_document'))
       {
         $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
         $file_name = $upload_data['file_name'];

         //Post Array
         $post_data = array(
           'order_name'       =>  $order_name,
           'order_client'     =>  $order_client,
           'order_budget'     =>  $order_budget,
           'order_deadline'   =>  $order_deadline,
           'order_document'   =>  $file_name,
           'order_msg'        =>  $order_msg,
           'order_cat'        =>  $order_cat
         );

         //Insert Data
         $get_response = $this->orders_model->addOrders($post_data);

         if($get_response){
           //Set message
           $this->session->set_flashdata('client_added', 'Order Added Successfully!');
           redirect('orders/add_orders');
         }else{
           //Set message
           $this->session->set_flashdata('error_occurred', 'Some Error Occurred. Please try again!');
           $this->load->view('orders/add_orders', $data);
         }

       }else{
         $error = $this->upload->display_errors();
         //Set message
         $this->session->set_flashdata('error_occurred', $error);
         $this->load->view('orders/add_orders', $data);
       }

     }
   }

   public function manage_orders(){
     if(!$this->session->userdata('is_loggedin')){
       redirect('users/login');
     }

     $user_id = $this->session->userdata('user_id');
     $data = array();
     $order_data = $this->orders_model->get_orders();
     $data['title'] = "Manage Orders";
     $data['sidebar_manage_orders_active'] = "active";
     $data['userdata'] = $this->users_model->get_userdata($user_id);
     //$data['clients_data'] = $this->clients_model->get_clients();
     foreach ($order_data as $key => $value) {
       $data['order_data'][$key]['id'] = $value->id;
       $data['order_data'][$key]['orderName'] = $value->order_name;
       $data['order_data'][$key]['client'] = $this->clients_model->get_clients_by_id($value->order_client);
       $data['order_data'][$key]['orderBudget'] = $value->order_budget;
       $data['order_data'][$key]['orderDeadline'] = $value->order_deadline;
       $data['order_data'][$key]['orderStatus'] = $value->order_status;
     }

     $this->load->view('template/header', $data);
     $this->load->view('template/sidebar', $data);
     $this->load->view('orders/manage_orders', $data);
     $this->load->view('template/footer', $data);

   }

 }
