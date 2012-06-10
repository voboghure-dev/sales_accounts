<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MHr_emp_info extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('hr_emp_info');
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
    $q = $this->db->get('hr_emp_info');
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
        'name' => $this->input->post('name'),
        'father_name' => $this->input->post('father_name'),
        'mother_name' => $this->input->post('mother_name'),
        'dob' => $this->input->post('year'). '-' . $this->input->post('month') . '-' . $this->input->post('day'),
        'present_address' => $this->input->post('present_address'),
        'permanent_address' => $this->input->post('permanent_address'),
        'voter_id' => $this->input->post('voter_id'),
        'department' => $this->input->post('department'),
        'position' => $this->input->post('position'),
        'joining' => $this->input->post('jyear'). '-' . $this->input->post('jmonth') . '-' . $this->input->post('jday'),
        'status' => $this->input->post('status'),
        'created' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('hr_emp_info', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'name' => $this->input->post('name'),
        'father_name' => $this->input->post('father_name'),
        'mother_name' => $this->input->post('mother_name'),
        'dob' => $this->input->post('year'). '-' . $this->input->post('month') . '-' . $this->input->post('day'),
        'present_address' => $this->input->post('present_address'),
        'permanent_address' => $this->input->post('permanent_address'),
        'voter_id' => $this->input->post('voter_id'),
        'department' => $this->input->post('department'),
        'position' => $this->input->post('position'),
        'joining' => $this->input->post('jyear'). '-' . $this->input->post('jmonth') . '-' . $this->input->post('jday'),
        'status' => $this->input->post('status'),
        'modified' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('hr_emp_info', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('hr_emp_info');
  }

}