<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MInventory_master extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('inventory_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  
  function get_latest() {
    $data = array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $q = $this->db->get('inventory_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all() {
    $data = array();
    $q = $this->db->get('inventory_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function create() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'company_id' => $this->input->post('company_id'),
        'inventory_no' => $this->input->post('inventory_no'),
        'inventory_date' => $this->input->post('inventory_date'),
        'notes' => $this->input->post('notes'),
        'created' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('inventory_master', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'company_id' => $this->input->post('company_id'),
        'inventory_no' => $this->input->post('inventory_no'),
        'inventory_date' => $this->input->post('inventory_date'),
        'notes' => $this->input->post('notes'),
        'modified' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('inventory_master', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('inventory_master');
  }

}