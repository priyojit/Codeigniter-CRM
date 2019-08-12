<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_Model extends CI_Model{

  public function addOrders($post_data){

    $query = $this->db->insert('orders', $post_data);
    if($query){
      return true;
    }
    else{
      return false;
    }

  }

  public function get_orders(){

    $this->db->order_by("timestamp", "asc");
    $query = $this->db->get('orders');
    if($query->num_rows() > 0){
      return $query->result();
    }
    else {
      return false;
    }

  }

  public function count_pending_orders_by_client($client_id){

    $query = $this->db->get_where('orders', array('order_client' => $client_id, 'order_status !=' => 3));
    if($query->num_rows() > 0){
      return count($query->result());
    }
    else {
      return false;
    }

  }

}
