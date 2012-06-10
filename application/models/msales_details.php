<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MSales_details extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_stock() {
    $data = array();
    $this->db->group_by('edate');
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_sales_id($id=0) {
    $data = array();
    $this->db->where('sales_id', $id);
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $item = $this->MPurchase_details->get_by_id($row['purchase_id']);
        $row['item_name'] = $item['item_name'];
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_total_price_by_sales_id($id=0) {
    //$data = array();
    $this->db->select_sum('price_total');
    $this->db->where('sales_id', $id);
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row['price_total'];
      }
    }

    $q->free_result();
    return $data;
  }

  function get_total_qty_by_sales_id($id=0) {
    //$data = array();
    $this->db->select_sum('quantity');
    $this->db->where('sales_id', $id);
    $q = $this->db->get('sales_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row['quantity'];
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_item_between_date() {
    $data = array();
    $this->db->distinct();
    $this->db->select('sales_id');
    if ($this->input->post('item_id') != 'all') {
      $this->db->where('item_id', $this->input->post('item_id'));
    }
    $sdate = $this->input->post('s_date');
    $edate = $this->input->post('e_date');
    $this->db->where("sales_date BETWEEN '$sdate' AND '$edate'");
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

  function create($sales_id, $item) {
    $sales = MSales_master::get_by_id($sales_id);
    if ($this->input->post('fixed_price_bdt')) {
      $price = ( 100 / ( 100 + 2 ) ) * $this->input->post('fixed_price_bdt');
      $vat = ($price * 2) / 100;
      $data = array(
          'user_id' => $this->session->userdata('user_id'),
          'sales_id' => $sales_id,
          'sales_date' => $sales['sales_date'],
          'purchase_id' => $item['id'],
          'item_id' => $item['item_id'],
          'barcode' => $this->input->post('barcode'),
          'fixed_price_bdt' => $price,
          'price_bdt' => $item['price_bdt'],
          'price_rs' => $item['price_rs'],
          'vat_percent' => 2,
          'vat_amount' => $vat,
          'quantity' => 1,
          'price_total' => $this->input->post('fixed_price_bdt'),
          'created' => date('Y-m-d H:i:s', time())
      );
    } else {
      $vat = ($item['price_bdt'] * 2) / 100;
      $data = array(
          'user_id' => $this->session->userdata('user_id'),
          'sales_id' => $sales_id,
          'sales_date' => $sales['sales_date'],
          'purchase_id' => $item['id'],
          'item_id' => $item['item_id'],
          'barcode' => $this->input->post('barcode'),
          'price_bdt' => $item['price_bdt'],
          'price_rs' => $item['price_rs'],
          'quantity' => 1,
          'vat_percent' => 2,
          'vat_amount' => $vat,
          'price_total' => $item['price_bdt'],
          'created' => date('Y-m-d H:i:s', time())
      );
    }

    $this->db->insert('sales_details', $data);

    return $this->db->insert_id();
  }

  function delete_by_sales_id($sales_id) {
    $this->db->where('sales_id', $sales_id);
    $this->db->delete('sales_details');
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('sales_details');
  }

}