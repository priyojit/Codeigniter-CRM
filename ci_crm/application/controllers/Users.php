<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 class Users extends CI_Controller{

   //Users Login
   public function login(){
      if($this->session->userdata('is_loggedin') == true){
				redirect('dashboard/index');
			}

      $data['title'] = "Login - CRM";

      //Login Validation
      $this->form_validation->set_rules('username', 'Username', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if($this->form_validation->run() === FALSE){
        $this->load->view('users/login', $data);
      }
      else{
        //Get Username
        $username = $this->input->post('username');
        //Get Encrypt Password
        $password = md5($this->input->post('password'));

        //Login User
        $user_id = $this->users_model->login($username, $password);

        if($user_id){
          //Set Session
          $user_data = array(
            'user_id' => $user_id,
            'username' => $username,
            'is_loggedin' => true
          );
          $this->session->set_userdata($user_data);

          //Set message
          $this->session->set_flashdata('user_loggedin', 'You are now logged in');

          redirect('dashboard/index');
        }
        else{
          //Set message
          $this->session->set_flashdata('login_invalid', 'Incorrect Username or Password!');
          $this->load->view('users/login', $data);
        }

      }

   }

   //Users Logout
   public function logout(){
     $user_data = array('user_id','username','is_loggedin');

     $this->session->unset_userdata($user_data);

     redirect('users/login');
   }

 }
