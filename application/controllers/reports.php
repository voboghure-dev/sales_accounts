<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Reports extends CI_Controller {

  public $privileges;

  function __construct() {
    parent::__construct();
    $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->userdata('user_id'));
  }

  function index() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['content'] = 'admin/reports/home';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  //Accounts Report Start--------------

  function account_chart_ac() {
    if ($this->input->post()) {
      
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/account_chart_ac';
      $data['ac_chart_tree'] = $this->MAc_charts->get_coa_tree();
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function account_trial_balance() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['content'] = 'admin/reports/account_trail_balance';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function account_balance_sheet() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['content'] = 'admin/reports/account_balance_sheet';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function account_income_statement() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['content'] = 'admin/reports/account_income_statement';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function account_income() {
    if ($this->input->post('s_date')) {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['vouchers'] = $this->MAc_vouchers->get_voucher('debit', $this->input->post('s_date'), $this->input->post('e_date'));
      $data['content'] = 'admin/reports/account_income_details';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/account_income';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function account_expense() {
    if ($this->input->post('s_date')) {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['vouchers'] = $this->MAc_vouchers->get_voucher('credit', $this->input->post('s_date'), $this->input->post('e_date'));
      $data['content'] = 'admin/reports/report_expense_details';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/account_expense';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function account_profit_loss() {
    if ($this->input->post('s_date')) {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['debit_vouchers'] = $this->MAc_vouchers->get_voucher('debit', $this->input->post('s_date'), $this->input->post('e_date'));
      $data['credit_vouchers'] = $this->MAc_vouchers->get_voucher('credit', $this->input->post('s_date'), $this->input->post('e_date'));
      $data['content'] = 'admin/reports/account_profit_loss_details';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/account_profit_loss';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  //Accounts Report End---------------
  //
  //Purchase Report Start----------------
  
  function purchase() {
    if ($this->input->post()) {
      $data['content'] = 'admin/reports/purchase_summery';
      if($this->input->post('item_id')!='all' && $this->input->post('supplier_id')!='all'){
        $data['purchase'] = $this->MPurchase_master->get_all_between_date($this->input->post('item_id'), $this->input->post('supplier_id'));
      }elseif($this->input->post('item_id')!='all' && $this->input->post('supplier_id')=='all'){
        $data['purchase'] = $this->MPurchase_master->get_all_between_date($this->input->post('item_id'));
      }elseif($this->input->post('item_id')=='all' && $this->input->post('supplier_id')!='all'){
        $data['purchase'] = $this->MPurchase_master->get_all_between_date(NULL, $this->input->post('supplier_id'));
      }else{
        $data['purchase'] = $this->MPurchase_master->get_all_between_date();
      }
      
    } else {
      $data['content'] = 'admin/reports/purchase';
      $data['items'] = $this->MItems->get_all();
      $data['suppliers'] = $this->MSuppliers->get_all();
    }
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }
  
  //Purchase Report End---------------
  //
  //Sales Report Start----------------
  
  function sales_by_date() {
    if ($this->input->post()) {
      $data['content'] = 'admin/reports/sales_by_date_details';
      $data['sales'] = $this->MSales_master->get_all_between_date();
    } else {
      $data['content'] = 'admin/reports/sales_by_date';
    }
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function sales_by_item() {
    if ($this->input->post()) {
      $data['content'] = 'admin/reports/sales_by_item_details';
      $data['sales'] = $this->MSales_details->get_by_item_between_date();
    } else {
      $data['content'] = 'admin/reports/sales_by_item';
      $data['items'] = $this->MItems->get_all();
    }
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function sales_by_customer() {
    if ($this->input->post()) {
      $data['content'] = 'admin/reports/sales_by_customer_details';
      $data['sales'] = $this->MSales_master->get_by_customer_between_date();
    } else {
      $data['content'] = 'admin/reports/sales_by_customer';
      $data['customers'] = $this->MCustomers->get_all();
    }
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }
  
  //Sales Report End---------------
  //
  //Others Report Start----------------

  function transaction_all() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'reports';
    $data['content'] = 'admin/reports/transaction_all';
    $data['transactions'] = $this->MSales_master->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function inventory_by_item() {
    if ($this->input->post()) {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/sales_by_customer_details';
      $data['inventory'] = $this->MSales_master->get_by_customer_between_date();
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'reports';
      $data['content'] = 'admin/reports/inventory_by_item';
      $data['items'] = $this->MItems->get_all();
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function check() {
    $receive = $this->MReceive_items->get_stock();
    $sale = $this->MSales_details->get_stock();
    $result = array_merge($receive, $sale);
    $sortarr = array_distinct($result, 'edate');

    print_r($sortarr);
    //print_r($result);
  }

  //Others Report End----------------
}