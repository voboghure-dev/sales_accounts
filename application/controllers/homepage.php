<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Homepage extends CI_Controller {

  function __construct() {
    parent::__construct();
  }

  function index() {
    $data['title'] = 'Sales Inventory - Login';
    $data['menu'] = 'home';
    $data['content'] = 'homepage';
    $this->load->vars($data);
    $this->load->view('template');
  }

  function login() {
    if ($this->input->post('email')) {
      $this->form_validation->set_rules('email', 'Username', 'trim|required|valid_email|xss_clean');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run() == TRUE) {
        $email = $this->input->post('email');
        $pw = substr(do_hash($this->input->post('password')), 0, 16);
        $this->MUsers->verify($email, $pw);

        if ($this->session->userdata('user_id')) {
          redirect('sales', 'refresh');
        } else {
          redirect('homepage', 'refresh');
        }
      } else {
        $data['title'] = 'Sales Inventory - Login';
        $data['menu'] = 'home';
        $data['content'] = 'homepage';
        $this->load->vars($data);
        $this->load->view('template');
      }
    } else {
      $data['title'] = 'Sales Inventory - Login';
      $data['menu'] = 'home';
      $data['content'] = 'homepage';
      $this->load->vars($data);
      $this->load->view('template');
    }
  }

  function logout() {
    $data = array();
    $data['user_id'] = $this->session->userdata('user_id');
    $data['company_id'] = $this->session->userdata('company_id');
    $this->session->unset_userdata($data);
    //$this->session->unset_userdata('user_email');
    //$this->session->sess_destroy();

    $this->session->set_flashdata('error', "Successfully loged out!");
    redirect('homepage', 'refresh');
  }

  function xml_write() {
    $myFile = "thumbnail.xml";
    $fh = fopen($myFile, 'w') or die("can't open file");

    $data = $this->MUsers->get_all(); //get data from database
    //starting tag for xml
    $stringData = '<?xml version="1.0" encoding="utf-8" ?>' . "\n";
    fwrite($fh, $stringData);
    $stringData = '<thumbnails>' . "\n";
    fwrite($fh, $stringData);

    foreach ($data as $key => $value) { //loop through each data
      $stringData = '<thumbnail filename="' . $value['fname'] . '" email="' . $value['email'] . '" />' . "\n";
      fwrite($fh, $stringData);
    }

    //closing tag for xml
    $stringData = '</thumbnails>';
    fwrite($fh, $stringData);

    fclose($fh);
  }

  function csv_import() {
    $this->load->library('csvreader');
    $filePath = './database/stock_18_01_12.csv';
    $csvData = $this->csvreader->parse_file($filePath);
    //print_r($csvData);
    
    foreach ($csvData as $key => $value) {
      $this->MPurchase_details->create_by_csv($value);
    }
  }

}