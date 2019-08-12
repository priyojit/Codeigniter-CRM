<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_Model extends CI_Model{

  public function getCountry(){
    $this->db->select('*');
    $this->db->where(array('status'=>1));
    $query = $this->db->get('country');
    return $query->result();
  }

}
