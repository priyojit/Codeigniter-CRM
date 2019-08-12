<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_Model extends CI_Model{

  public function getStateByCountry($countryID = ''){
    $this->db->select('*');
    $this->db->where(array(
      'countryID' =>  $countryID,
      'status'    =>  1
    ));
    $query = $this->db->get('state');
    return $query->result();
  }

}
