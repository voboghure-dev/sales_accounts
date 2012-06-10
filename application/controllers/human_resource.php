<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Human_resource extends CI_Controller {

  public $privileges;

  function __construct() {
    parent::__construct();
    $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->userdata('user_id'));
  }

  function index() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'settings';
    $data['content'] = 'admin/human_resource/emp_info_list';
    $data['privileges'] = $this->privileges;
    $data['emp_list'] = $this->MHr_emp_info->get_all();
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function emp_add() {
    if ($this->input->post()) {
      $this->MHr_emp_info->create();
      redirect('human_resource', 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $this->load->vars($data);
      $this->load->view('admin/human_resource/emp_info_entry');
    }
  }
  
  function emp_edit($id=NULL) {
    if ($this->input->post()) {
      $this->MHr_emp_info->update();
      redirect('human_resource', 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['employee'] = $this->MHr_emp_info->get_by_id($id);
      $data['dob'] = explode('-', $data['employee']['dob']);
      $data['joining'] = explode('-', $data['employee']['joining']);
      $this->load->vars($data);
      $this->load->view('admin/human_resource/emp_info_edit');
    }
  }


  function emp_delete($id) {
    $this->MHr_emp_info->delete($id);
    redirect('human_resource', 'refresh');
  }

}