<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Sales extends CI_Controller {

  public $privileges;

  function __construct() {
    parent::__construct();
    $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->userdata('user_id'));
  }

  function index() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/sales_entry';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function add($id=0, $barcode=0) {
    if ($this->input->post('barcode')) {
      if (!$this->input->post('sales_id')) {
        $sales_id = $this->MSales_master->create();
      } else {
        $sales_id = $this->input->post('sales_id');
      }
      $item = $this->MPurchase_details->get_by_barcode($this->input->post('barcode'));
      $this->MSales_details->create($sales_id, $item);
      redirect('sales/add/' . $sales_id, 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      if ($barcode != 0) {
        $data['barcode'] = $barcode;
      }
      $data['sales'] = $this->MSales_master->get_by_id($id);
      if (isset($data['sales']['customer_id'])) {
        if ($data['sales']['customer_id'] != 0) {
          $data['customer'] = $this->MCustomers->get_by_id($data['sales']['customer_id']);
        }
      }
      if (isset($data['sales']['emp_id'])) {
        if ($data['sales']['emp_id'] != 0) {
          $data['sales_man'] = $this->MHr_emp_info->get_by_id($data['sales']['emp_id']);
        }
      }

      $data['details'] = $this->MSales_details->get_by_sales_id($id);
      $data['content'] = 'admin/sales/sales_entry';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function set_customer($sales_id=0, $customer_id=0) {
    if ($customer_id != 0) {
      $this->MSales_master->set_sales_customer($sales_id, $customer_id);
      redirect('sales/add/' . $sales_id, 'refresh');
    } else {
      $data['sales_id'] = $sales_id;
      $data['customers'] = $this->MCustomers->get_all();
      $this->load->vars($data);
      $this->load->view('admin/sales/set_customer');
    }
  }

  function set_sales_man($sales_id=0, $sales_man_id=0) {
    if ($sales_man_id != 0) {
      $this->MSales_master->set_sales_man($sales_id, $sales_man_id);
      redirect('sales/add/' . $sales_id, 'refresh');
    } else {
      $data['sales_id'] = $sales_id;
      $data['sales_man'] = $this->MHr_emp_info->get_all();
      $this->load->vars($data);
      $this->load->view('admin/sales/set_sales_man');
    }
  }

  function find_item($sales_id=0) {
    $data['sales_id'] = $sales_id;
    $data['items'] = $this->MPurchase_details->get_all_stock();
    $this->load->vars($data);
    $this->load->view('admin/sales/find_item');
  }

  function new_item() {
    if ($this->input->post()) {
      $this->MItems->create();
      redirect($this->input->post('sale_url'), 'refresh');
    } else {
      $data['sale_url'] = $_SERVER['HTTP_REFERER'];
      $data['from'] = 'cashier';
      $data['companies'] = $this->MCompanies->get_all();
      $item = $this->MItems->get_latest();
      if (count($item) > 0) {
        $data['code'] = (int) $item['code'] + 1;
      } else {
        $data['code'] = 1;
      }
      $this->load->vars($data);
      $this->load->view('admin/sales/item_entry');
    }
  }

  function discount($sales_id=0) {
    if ($this->input->post()) {
      $this->MSales_master->discount();
      redirect('sales/add/' . $this->input->post('sales_id'), 'refresh');
    } else {
      $data['sales_id'] = $sales_id;
      $this->load->vars($data);
      $this->load->view('admin/sales/discount');
    }
  }

  function payout($sales_id=NULL) {
    if ($this->input->post()) {
      $items = $this->MSales_details->get_by_sales_id($this->input->post('sales_id'));
      foreach ($items as $key => $value) {
        $this->MPurchase_details->set_status_sold($value['purchase_id']);
      }
      redirect('sales', 'refresh');
    } else {
      $total = $this->MSales_details->get_total_price_by_sales_id($sales_id);
      $master = $this->MSales_master->get_by_id($sales_id);
      if ($master['type'] == 'percent') {
        $discount = ($master['discount'] * $total) / 100;
      } else {
        $discount = $master['discount'];
      }
      $data['sales_id'] = $sales_id;
      $data['total'] = $total - $discount;

      $this->load->vars($data);
      $this->load->view('admin/sales/payout');
    }
  }

  function delete_item($id, $sales_id) {
    $this->MSales_details->delete($id);
    redirect('sales/add/' . $sales_id, 'refresh');
  }

  function delete($id=NULL) {
    if ($id) {
      $this->MSales_details->delete_by_sales_id($id);
      $this->MSales_master->delete($id);
    } else {
      $this->MSales_details->delete_by_sales_id($this->input->post('id'));
      $this->MSales_master->delete($this->input->post('id'));
    }
    redirect('sales/add', 'refresh');
  }

}