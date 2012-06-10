<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MSuppliers extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('suppliers');
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
    $q = $this->db->get('suppliers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_dropdown() {
    $q = $this->db->get('suppliers');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[$row['id']] = $row['name'];
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all() {
    $data = array();
    $q = $this->db->get('suppliers');
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
        'code' => $this->input->post('code'),
        'name' => $this->input->post('name'),
        'contact_person' => $this->input->post('contact_person'),
        'address' => $this->input->post('address'),
        'phone' => $this->input->post('phone'),
        'fax' => $this->input->post('fax'),
        'email' => $this->input->post('email'),
        'web' => $this->input->post('web'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('suppliers', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'code' => $this->input->post('code'),
        'name' => $this->input->post('name'),
        'contact_person' => $this->input->post('contact_person'),
        'address' => $this->input->post('address'),
        'phone' => $this->input->post('phone'),
        'fax' => $this->input->post('fax'),
        'email' => $this->input->post('email'),
        'web' => $this->input->post('web'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('suppliers', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('suppliers');
  }

}