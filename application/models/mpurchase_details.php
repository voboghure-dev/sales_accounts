<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MPurchase_details extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $item = $this->MItems->get_by_id($row['item_id']);
        $row['item_name'] = $item['name'];
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_by_barcode($barcode) {
    $data = array();
    $this->db->where('barcode', $barcode);
    $q = $this->db->get('purchase_details');
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
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_purchase_no($purchase_no, $item_id=NULL) {
    $data = array();
    if($item_id){
      $this->db->where('item_id', $item_id);
    }
    $this->db->where('purchase_no', $purchase_no);
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $item = $this->MItems->get_by_id($row['item_id']);
        $row['item_name'] = $item['name'];
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_total_quantity($purchase_no, $item_id=NULL, $supplier_id=NULL) {
    $this->db->select_sum('quantity');
    if($item_id){
      $this->db->where('item_id', $item_id);
    }
    if($supplier_id){
      $this->db->where('supplier_id', $supplier_id);
    }
    $this->db->where('purchase_no', $purchase_no);
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row['quantity'];
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_total_price($purchase_no, $item_id=NULL, $supplier_id=NULL) {
    $this->db->select_sum('price_bdt');
    if($item_id){
      $this->db->where('item_id', $item_id);
    }
    if($supplier_id){
      $this->db->where('supplier_id', $supplier_id);
    }
    $this->db->where('purchase_no', $purchase_no);
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row['price_bdt'];
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_stock() {
    $data = array();
    $this->db->where('status', 'received');
    $q = $this->db->get('purchase_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $item = $this->MItems->get_by_id($row['item_id']);
        $row['name'] = $item['name'];
        $data[] = $row;
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
        $company = $this->MCompanies->get_by_id($row['company_id']);
        $row['company'] = $company['name'];
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function set_status_sold($id){
    $data = array(
        'status' => 'sold'
    );
    
    $this->db->where('id', $id);
    $this->db->update('purchase_details', $data);
  }
  
  function get_by_item_with_purchase_no() {
    $data = array();
    $this->db->distinct();
    $this->db->select('sales_id');
    if ($this->input->post('item_id') != 'all') {
      $this->db->where('item_id', $this->input->post('item_id'));
    }
    $sdate = $this->input->post('s_date');
    $edate = $this->input->post('e_date');
    $this->db->where("edate BETWEEN '$sdate' AND '$edate'");
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = MSales_master::get_by_id($row['sales_id']);
        //$data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function create_by_csv($item) {
    $item_name = $this->MItems->get_by_name($item['item']);
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'supplier_id' => 0,
        'supplier_code' => $item['code'],
        'purchase_no' => '1001',
        'item_id' => $item_name['id'],
        'barcode' => $item['barcode'],
        'pur_price_bdt' => '',
        'price_bdt' => $item['bdt'],
        'price_rs' => $item['rs'],
        'quantity' => 1,
        'status' => 'received',
        'edate' => date('Y-m-d H:i:s', time())
    );
    
    $this->db->insert('purchase_details', $data);
  }
  
  function create($barcode) {
    $data = array(
        'company_id' => $this->input->post('company_id'),
        'user_id' => $this->session->userdata('user_id'),
        'supplier_id' => $this->input->post('supplier_id'),
        'supplier_code' => $this->input->post('supplier_code'),
        'purchase_no' => $this->input->post('purchase_no'),
        'item_id' => $this->input->post('item_id'),
        'barcode' => $barcode,
        'pur_price_bdt' => $this->input->post('pur_price_bdt'),
        'price_bdt' => $this->input->post('price_bdt'),
        'price_rs' => $this->input->post('price_rs'),
        'quantity' => 1,
        'status' => 'received',
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('purchase_details', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'purchase_no' => $this->input->post('purchase_no'),
        'item_id' => $this->input->post('item_id'),
        'price_bdt' => $this->input->post('price_bdt'),
        'price_rs' => $this->input->post('price_rs'),
        'quantity' => $this->input->post('quantity'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('purchase_details', $data);
  }

  function delete_by_purchase_no($purchase_no) {
    $this->db->where('purchase_no', $purchase_no);
    $this->db->delete('purchase_details');
  }
  
  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('purchase_details');
  }

}