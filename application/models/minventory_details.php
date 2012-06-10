<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MInventory_details extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('inventory_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function get_by_inventory_no($inventory_no) {
    $data = array();
    $this->db->where('inventory_no', $inventory_no);
    $q = $this->db->get('inventory_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        if($row['item_id']){
          $item = $this->MItems->get_by_id($row['item_id']);
          $row['item_name'] = $item['name'];
        }else{
          $row['item_name'] = 'not found';
        }
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all() {
    $data = array();
    $q = $this->db->get('inventory_details');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function create($inv_check) {
    if (count($inv_check) > 0) {
      if ($inv_check['status'] == 'received') {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'company_id' => $this->input->post('company_id'),
            'inventory_no' => $this->input->post('inventory_no'),
            'barcode' => $inv_check['barcode'],
            'item_id' => $inv_check['item_id'],
            'pur_price_bdt' => $inv_check['pur_price_bdt'],
            'price_bdt' => $inv_check['price_bdt'],
            'price_rs' => $inv_check['price_rs'],
            'status' => 'in_stock',
            'created' => date('Y-m-d H:i:s', time())
        );
      } else {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'company_id' => $this->input->post('company_id'),
            'inventory_no' => $this->input->post('inventory_no'),
            'barcode' => $inv_check['barcode'],
            'item_id' => $inv_check['item_id'],
            'pur_price_bdt' => $inv_check['pur_price_bdt'],
            'price_bdt' => $inv_check['price_bdt'],
            'price_rs' => $inv_check['price_rs'],
            'status' => 'out_stock',
            'created' => date('Y-m-d H:i:s', time())
        );
      }
    } else {
      $data = array(
          'user_id' => $this->session->userdata('user_id'),
          'company_id' => $this->input->post('company_id'),
          'inventory_no' => $this->input->post('inventory_no'),
          'barcode' => $this->input->post('barcode'),
          'item_id' => 0,
          'pur_price_bdt' => 0,
          'price_bdt' => 0,
          'price_rs' => 0,
          'status' => 'not_found',
          'created' => date('Y-m-d H:i:s', time())
      );
    }


    $this->db->insert('inventory_details', $data);
  }

  function update() {
    $data = array(
        'company_id' => $this->input->post('company_id'),
        'user_id' => $this->session->userdata('user_id'),
        'purchase_no' => $this->input->post('purchase_no'),
        'purchase_date' => $this->input->post('purchase_date'),
        'notes' => $this->input->post('notes'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('inventory_details', $data);
  }

  function delete_by_inventory_no($inventory_no) {
    $this->db->where('inventory_no', $inventory_no);
    $this->db->delete('inventory_details');
  }
  
  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('inventory_details');
  }

}