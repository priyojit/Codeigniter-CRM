<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Clients extends CI_Controller{

   public function add_clients(){
     if(!$this->session->userdata('is_loggedin')){
       redirect('users/login');
     }

     $user_id = $this->session->userdata('user_id');
     $data['title'] = "Add Clients";
     $data['sidebar_add_clients_active'] = "active";
     $data['userdata'] = $this->users_model->get_userdata($user_id);
     $this->load->model('Country_Model');
     $data['country'] = $this->Country_Model->getCountry();

     //form validation
     $this->form_validation->set_rules('FirstName', 'First Name', 'required');
     $this->form_validation->set_rules('LastName', 'Last Name', 'required');
     $this->form_validation->set_rules('EmailAddress', 'Email Address', 'required');
     $this->form_validation->set_rules('PhoneNumber', 'Phone Number', 'required');
     $this->form_validation->set_rules('Address', 'Address', 'required');
     $this->form_validation->set_rules('City', 'City', 'required');
     $this->form_validation->set_rules('State', 'State', 'required');
     $this->form_validation->set_rules('Country', 'Country', 'required');
     $this->form_validation->set_rules('Pincode', 'Pincode', 'required');

     if($this->form_validation->run() == false){
       $this->load->view('template/header', $data);
       $this->load->view('template/sidebar', $data);
       $this->load->view('clients/add_clients', $data);
       $this->load->view('template/footer');
     }
     else {
       //Get Clients Data From Post
       $FirstName = $this->input->post('FirstName');
       $MiddleName = $this->input->post('MiddleName');
       $LastName = $this->input->post('LastName');
       $EmailAddress = $this->input->post('EmailAddress');
       $PhoneNumber = $this->input->post('PhoneNumber');
       $Company = $this->input->post('Company');
       $Address = $this->input->post('Address');
       $City = $this->input->post('City');
       $State = $this->input->post('State');
       $Country = $this->input->post('Country');
       $Pincode = $this->input->post('Pincode');

       //Check Email Exist
       $user_exist = $this->clients_model->checkEmailExist($EmailAddress);
       if($user_exist){
         //Set message
         $this->session->set_flashdata('email_exist', 'Email Address already exist!');
         $this->load->view('clients/add_clients', $data);
       }
       else{
         //Post Array
         $post_data = array(
           'FirstName'  =>  $FirstName,
           'MiddleName' =>  $MiddleName,
           'LastName'   =>  $LastName,
           'Email'      =>  $EmailAddress,
           'Phone'      =>  $PhoneNumber,
           'Company'    =>  $Company,
           'Address'    =>  $Address,
           'City'       =>  $City,
           'State'      =>  $State,
           'Country'    =>  $Country,
           'Pincode'    =>  $Pincode
         );

         //Insert Data
         $get_response = $this->clients_model->addClients($post_data);

         if($get_response){
           //Set message
           $this->session->set_flashdata('client_added', 'Client Added Successfully!');
           redirect('clients/add_clients');
         }else{
           //Set message
           $this->session->set_flashdata('error_occurred', 'Some Error Occurred. Please try again!');
           $this->load->view('clients/add_clients', $data);
         }
       }

     }
   }

   public function getStateByCountry($countryID){
     $this->load->model('State_Model');
     $data['state'] = $this->State_Model->getStateByCountry($countryID);
     $this->load->view('state/ajax_state_list', $data);
   }

   public function manage_clients(){
     if(!$this->session->userdata('is_loggedin')){
       redirect('users/login');
     }

     $user_id = $this->session->userdata('user_id');
     $data = array();
     $client_data = $this->clients_model->get_clients();
     $data['title'] = "Manage Clients";
     $data['sidebar_manage_clients_active'] = "active";
     $data['userdata'] = $this->users_model->get_userdata($user_id);
     //$data['clients_data'] = $this->clients_model->get_clients();
     foreach ($client_data as $key => $value) {
       $data['clients_data'][$key]['id'] = $value->id;
       $data['clients_data'][$key]['fullName'] = $value->FirstName.' '.$value->MiddleName.' '.$value->LastName;
       $data['clients_data'][$key]['email'] = $value->Email;
       $data['clients_data'][$key]['phone'] = $value->Phone;
       $data['clients_data'][$key]['order_data'] = $this->orders_model->count_pending_orders_by_client($value->id);
     }

     $this->load->view('template/header', $data);
     $this->load->view('template/sidebar', $data);
     $this->load->view('clients/manage_clients', $data);
     $this->load->view('template/footer', $data);

   }

 }
