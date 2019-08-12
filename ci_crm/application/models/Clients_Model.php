<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients_Model extends CI_Model{

  public function checkEmailExist($email){

    $this->db->select('*');
    $query = $this->db->get_where('clients', array('Email' => $email));

    if($query->num_rows() > 0){
      return true;
    }
    else {
      return false;
    }

  }

  public function addClients($post_data){

    $query = $this->db->insert('clients', $post_data);
    if($query){
      return true;
    }
    else{
      return false;
    }

  }

  public function get_clients(){

    $this->db->order_by("timestamp", "asc");
    $query = $this->db->get('clients');
    if($query->num_rows() > 0){
      return $query->result();
    }
    else {
      return false;
    }

  }

  public function get_clients_by_id($client_id){

    $query = $this->db->get_where('clients', array('id' => $client_id));
    if($query->num_rows() > 0){
      return $query->result();
    }
    else {
      return false;
    }

  }

}
