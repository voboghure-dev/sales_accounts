<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Settings extends CI_Controller {

  public $privileges;
  
  function __construct() {
    parent::__construct();
    $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->userdata('user_id'));
  }

  /* --------------------- User Part Start --------------------- */

  function index() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'settings';
    $data['content'] = 'admin/settings/user_list';
    $data['users'] = $this->MUsers->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function user_add() {
    if ($this->input->post()) {
      $this->MUsers->create();
      $this->session->set_flashdata('message', 'User created');
      redirect('settings', 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'settings';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/settings/user_entry');
    }
  }

  function user_edit($id=NULL) {
    if ($this->input->post()) {
      $this->MUsers->update();
      $this->session->set_flashdata('message', 'User updated');
      redirect('settings', 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'settings';
      $data['user'] = $this->MUsers->get_by_id($id);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/settings/user_edit');
    }
  }

  function user_delete($id) {
    $this->MUsers->delete($id);
    $this->MUser_privileges->delete_by_ref_user($id);
    redirect('settings', 'refresh');
  }

  /* --------------------- User Part End ----------------------- */

  //
  /* --------------------- User Privileges Part Start --------------------- */
  function user_privileges($ref_user=NULL) {
    if ($this->input->post()) {
      if($this->MUser_privileges->get_by_ref_user($this->input->post('ref_user'))){
        $this->MUser_privileges->update();
      }else{
        $this->MUser_privileges->create();
      }
      redirect('settings', 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'settings';
      $data['content'] = 'admin/settings/user_privileges';
      $data['privileges'] = $this->MUser_privileges->get_by_ref_user($ref_user);
      $data['ref_user'] = $this->MUsers->get_by_id($ref_user);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  /* --------------------- User Privileges Part Start --------------------- */
}