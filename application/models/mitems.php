<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MItems extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('items');
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
    $q = $this->db->get('items');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_code($code) {
    $data = array();
    $this->db->where('code', $code);
    $q = $this->db->get('items');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_name($name) {
    $data = array();
    $this->db->where('name', $name);
    $q = $this->db->get('items');
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
    $q = $this->db->get('items');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_dropdown() {
    $q = $this->db->get('items');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[$row['id']] = $row['name'];
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
        'description' => $this->input->post('description'),
        'purchase_price' => $this->input->post('purchase_price'),
        'sale_price' => $this->input->post('sale_price'),
        're_order' => $this->input->post('re_order'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('items', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'code' => $this->input->post('code'),
        'name' => $this->input->post('name'),
        'description' => $this->input->post('description'),
        'purchase_price' => $this->input->post('purchase_price'),
        'sale_price' => $this->input->post('sale_price'),
        're_order' => $this->input->post('re_order'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('items', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('items');
  }

}