<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Sales_setup extends CI_Controller {

  public $privileges;

  function __construct() {
    parent::__construct();
    $this->privileges = $this->MUser_privileges->get_by_ref_user($this->session->userdata('user_id'));
  }

  /* -------------- Sales Item Start ------------------------ */

  function index() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/item_list';
    $data['items'] = $this->MItems->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function add() {
    if ($this->input->post('name')) {
      $this->MItems->create();
      $this->session->set_flashdata('message', 'Item created');
      redirect('sales_setup', 'refresh');
    } else {
      $data['from'] = 'sales';
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

  function edit($id=0) {
    if ($this->input->post()) {
      $this->MItems->update();
      $this->session->set_flashdata('message', 'Item updated.');
      redirect('sales_setup', 'refresh');
    } else {
      $data['item'] = $this->MItems->get_by_id($id);
      $data['suppliers'] = $this->MSuppliers->get_all();
      $this->load->vars($data);
      $this->load->view('admin/sales/item_edit');
    }
  }

  function delete($id) {
    $this->MItems->delete($id);
    redirect('sales_setup', 'refresh');
  }

  /* -------------- Sales Item End ------------------------ */

  /* -------------- Supplier Start ------------------ */

  function supplier_list() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/supplier_list';
    $data['suppliers'] = $this->MSuppliers->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function supplier_add() {
    if ($this->input->post()) {
      $this->MSuppliers->create();
      $this->session->set_flashdata('message', 'Supplier created');
      redirect('sales_setup/supplier_list', 'refresh');
    } else {
      $supplier = $this->MSuppliers->get_latest();
      if (count($supplier) > 0) {
        $data['code'] = (int) $supplier['code'] + 1;
      } else {
        $data['code'] = 1;
      }

      $this->load->vars($data);
      $this->load->view('admin/sales/supplier_entry');
    }
  }

  function supplier_edit($id=0) {
    if ($this->input->post()) {
      $this->MSuppliers->update();
      $this->session->set_flashdata('message', 'Supplier updated.');
      redirect('supplier', 'refresh');
    } else {
      $data['supplier'] = $this->MSuppliers->get_by_id($id);
      $this->load->vars($data);
      $this->load->view('admin/sales/supplier_edit');
    }
  }

  function supplier_delete($id) {
    $this->MSuppliers->delete($id);
    redirect('sales_setup/supplier_list', 'refresh');
  }

  /* -------------- Supplier End -------------------- */

  /* -------------- Customer Start ------------------ */

  function customer_list() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/customer_list';
    $data['customers'] = $this->MCustomers->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function customer_add() {
    if ($this->input->post()) {
      $this->MCustomers->create();
      $this->session->set_flashdata('message', 'Customer created');
      redirect($this->input->post('referrer'), 'refresh');
    } else {
      $customer = $this->MCustomers->get_latest();
      if (count($customer) > 0) {
        $data['code'] = (int) $customer['code'] + 1;
      } else {
        $data['code'] = 1;
      }

      $this->load->vars($data);
      $this->load->view('admin/sales/customer_entry');
    }
  }

  function customer_edit($id=0) {
    if ($this->input->post()) {
      $this->MCustomers->update();
      $this->session->set_flashdata('message', 'Customer updated.');
      redirect('sales_setup/customer_list', 'refresh');
    } else {
      $data['customer'] = $this->MCustomers->get_by_id($id);
      $this->load->vars($data);
      $this->load->view('admin/sales/customer_edit');
    }
  }

  function customer_delete($id) {
    $this->MCustomers->delete($id);
    redirect('sales_setup/customer_list', 'refresh');
  }

  /* -------------- Customer End -------------------- */

  /* -------------- Purchase Start ------------------- */

  function purchase_list() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/purchase_list';
    $data['purchase'] = $this->MPurchase_master->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }

  function purchase_master_add() {
    if ($this->input->post()) {
      $this->MPurchase_master->create();
      redirect('sales_setup/purchase_details_add/' . $this->input->post('purchase_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/purchase_master_entry';
      $purchase = $this->MPurchase_master->get_latest();
      if (count($purchase) > 0) {
        $data['purchase_no'] = (int) $purchase['purchase_no'] + 1;
      } else {
        $data['purchase_no'] = 1;
      }
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }
  
  function purchase_master_edit($id=NULL) {
    if ($this->input->post()) {
      $this->MPurchase_master->update();
      redirect('sales_setup/purchase_details_add/' . $this->input->post('purchase_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/purchase_master_edit';
      $data['purchase'] = $this->MPurchase_master->get_by_id($id);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function purchase_details_add($purchase_no=NULL) {
    if ($this->input->post()) {
      $item = $this->MItems->get_by_id($this->input->post('item_id'));
      $barcode = date('y') . date('m') . date('d') . $item['code'] . $this->input->post('supplier_code');
      $this->MPurchase_details->create($barcode);
      redirect('sales_setup/purchase_details_add/' . $this->input->post('purchase_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/purchase_details_entry';
      $data['purchase_no'] = $purchase_no;
      $data['items'] = $this->MItems->get_all();
      $data['suppliers'] = $this->MSuppliers->get_all();
      $data['purchase_details'] = $this->MPurchase_details->get_by_purchase_no($purchase_no);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function purchase_complete() {
    redirect('sales_setup/purchase_list', 'refresh');
  }

  function purchase_delete($id) {
    $purchase = $this->MPurchase_master->get_by_id($id);
    $this->MPurchase_details->delete_by_purchase_no($purchase['purchase_no']);
    $this->MPurchase_master->delete($id);
    redirect('sales_setup/purchase_list', 'refresh');
  }

  function purchase_item_delete() {
    $this->MPurchase_details->delete($this->input->post('id'));
    redirect('sales_setup/purchase_list', 'refresh');
  }

  /* -------------- Purchase End --------------------- */

  /* -------------- Inventory Check Start --------------------- */

  function inventory_list() {
    $data['title'] = 'Sales Inventory System';
    $data['menu'] = 'sales';
    $data['content'] = 'admin/sales/inventory_list';
    $data['inventory'] = $this->MInventory_master->get_all();
    $data['privileges'] = $this->privileges;
    $this->load->vars($data);
    $this->load->view('admin/dashboard');
  }
  
  
  function inventory_master_add() {
    if ($this->input->post()) {
      $this->MInventory_master->create();
      redirect('sales_setup/inventory_details_add/' . $this->input->post('inventory_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/inventory_master_entry';
      $inventory = $this->MInventory_master->get_latest();
      if (count($inventory) > 0) {
        $data['inventory_no'] = (int) $inventory['inventory_no'] + 1;
      } else {
        $data['inventory_no'] = 1;
      }
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }
  
  function inventory_master_edit($id=NULL) {
    if ($this->input->post()) {
      $this->MInventory_master->update();
      redirect('sales_setup/inventory_details_add/' . $this->input->post('inventory_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/inventory_master_edit';
      $data['inventory'] = $this->MInventory_master->get_by_id($id);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  function inventory_details_add($inventory_no=NULL) {
    if ($this->input->post()) {
      $inv_check = $this->MPurchase_details->get_by_barcode($this->input->post('barcode'));
      $this->MInventory_details->create($inv_check);
      redirect('sales_setup/inventory_details_add/' . $this->input->post('inventory_no'), 'refresh');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/inventory_details_entry';
      $data['inventory_no'] = $inventory_no;
      $data['inventory_details'] = $this->MInventory_details->get_by_inventory_no($inventory_no);
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }
  
  function inventory_complete() {
    redirect('sales_setup/inventory_list', 'refresh');
  }
  
  function inventory_delete($id) {
    $inventory = $this->MInventory_master->get_by_id($id);
    $this->MInventory_details->delete_by_inventory_no($inventory['inventory_no']);
    $this->MInventory_master->delete($id);
    redirect('sales_setup/inventory_list', 'refresh');
  }

  function inventory_check() {
    if ($this->input->post()) {
      $inv_check = $this->MPurchase_details->get_by_barcode($this->input->post('barcode'));

      if (count($inv_check) > 0) {
        if ($inv_check['status'] == 'received') {
          echo '<script type="text/javascript">alert("Item in Stock.");</script>';
        } else {
          echo '<script type="text/javascript">alert("Item Already Sold.");</script>';
        }
      } else {
        echo '<script type="text/javascript">alert("Item Not Found!");</script>';
      }
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/inventory_check';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    } else {
      $data['title'] = 'Sales Inventory System';
      $data['menu'] = 'sales';
      $data['content'] = 'admin/sales/inventory_check';
      $data['privileges'] = $this->privileges;
      $this->load->vars($data);
      $this->load->view('admin/dashboard');
    }
  }

  /* -------------- Inventory Check End --------------------- */
}