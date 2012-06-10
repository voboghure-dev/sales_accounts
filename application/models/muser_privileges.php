<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MUser_privileges extends CI_Model {
  
  public $tablename;

  function __construct() {
    parent::__construct();
    $this->tablename = 'user_privileges';
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $this->db->limit(1);
    $q = $this->db->get($this->tablename);
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_by_ref_user($ref_user) {
    $data = array();
    $this->db->where('ref_user', $ref_user);
    $this->db->limit(1);
    $q = $this->db->get($this->tablename);
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $user = $this->MUsers->get_by_id($row['ref_user']);
        $row['full_name'] = $user['full_name'];
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all() {
    $data = array();
    $q = $this->db->get($this->tablename);
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
        'ref_user' => $this->input->post('ref_user'),
        'sales_main' => $this->input->post('sales_main'),
        'sales_setup' => $this->input->post('sales_setup'),
        'accounts' => $this->input->post('accounts'),
        'settings' => $this->input->post('settings'),
        'reports' => $this->input->post('reports'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert($this->tablename, $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'ref_user' => $this->input->post('ref_user'),
        'sales_main' => $this->input->post('sales_main'),
        'sales_setup' => $this->input->post('sales_setup'),
        'accounts' => $this->input->post('accounts'),
        'settings' => $this->input->post('settings'),
        'reports' => $this->input->post('reports'),
        'edate' => date('Y-m-d H:i:s', time())
    );

    $this->db->where('ref_user', $this->input->post('ref_user'));
    $this->db->update($this->tablename, $data);
  }

  function delete_by_ref_user($ref_user) {
    $this->db->where('ref_user', $ref_user);
    $this->db->delete($this->tablename);
  }
  
  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete($this->tablename);
  }

}