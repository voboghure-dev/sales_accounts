<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MCustomers extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('customers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_name($id) {
    //$data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('customers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row['full_name'];
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_latest() {
    $data = array();
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);
    $q = $this->db->get('customers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function getCustomerNameBySalesID($id) {
    //$data = array();
    $this->db->select('customers.id, customers.full_name');
    $this->db->from('customers');
    $this->db->join('sales_master', 'customers.id=sales_master.customer_id');
    $this->db->where('sales_master.id', $id);
    $q = $this->db->get();
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
    $q = $this->db->get('customers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_dropdown() {
    $q = $this->db->get('customers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[$row['id']] = $row['full_name'];
      }
    } else {
      $data['0'] = 'No Customer Added';
    }

    $q->free_result();
    return $data;
  }

  function create() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'code' => $this->input->post('code'),
        'name' => $this->input->post('name'),
        'address' => $this->input->post('address'),
        'city' => $this->input->post('city'),
        'zip' => $this->input->post('zip'),
        'country' => $this->input->post('country'),
        'mobile' => $this->input->post('mobile'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'dob' => $this->input->post('dob'),
        'web' => $this->input->post('web'),
        'notes' => $this->input->post('notes'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('customers', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'code' => $this->input->post('code'),
        'name' => $this->input->post('name'),
        'address' => $this->input->post('address'),
        'city' => $this->input->post('city'),
        'zip' => $this->input->post('zip'),
        'country' => $this->input->post('country'),
        'mobile' => $this->input->post('mobile'),
        'phone' => $this->input->post('phone'),
        'email' => $this->input->post('email'),
        'dob' => $this->input->post('dob'),
        'web' => $this->input->post('web'),
        'notes' => $this->input->post('notes'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('customers', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('customers');
  }

}