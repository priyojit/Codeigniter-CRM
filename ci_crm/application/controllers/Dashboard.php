<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller{

  public function index(){

    if(!$this->session->userdata('is_loggedin')){
      redirect('users/login');
    }

    $user_id = $this->session->userdata('user_id');
    $data['title'] = "Dashboard";
    $data['sidebar_dashboard_active'] = "active";
    $data['userdata'] = $this->users_model->get_userdata($user_id);

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar', $data);
    $this->load->view('pages/index', $data);
    $this->load->view('template/footer');
  }

}
