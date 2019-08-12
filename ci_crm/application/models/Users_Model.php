<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_Model extends CI_Model{

  public function __construct(){
    $this->load->database();
  }

  public function login($username, $password){
    //Validate
    $this->db->where('username', $username);
    $this->db->where('password', $password);

    $result = $this->db->get('users');
    if($result->num_rows() == 1){
      return $result->row(0)->id;
    }
    else {
      return false;
    }
  }

  public function get_userdata($user_id){

    $query = $this->db->get_where('users', array('id' => $user_id));
    return $query->row();

  }

}
