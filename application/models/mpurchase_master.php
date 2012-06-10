<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MPurchase_master extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('purchase_master');
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
    $q = $this->db->get('purchase_master');
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
    $q = $this->db->get('purchase_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $qty = $this->MPurchase_details->get_total_quantity($row['purchase_no']);
        $price = $this->MPurchase_details->get_total_price($row['purchase_no']);
        $row['total_qty'] = $qty;
        $row['total_price'] = $price;
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_between_date($item_id=NULL, $supplier_id=NULL) {
    $data = array();
    $sdate = $this->input->post('s_date');
    $edate = $this->input->post('e_date');
    $this->db->where("purchase_date BETWEEN '$sdate' AND '$edate'");
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('purchase_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $user = $this->MUsers->get_by_id($row['user_id']);
        $row['user_name'] = $user['full_name'];
        if($item_id && $supplier_id){
          $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no'], $item_id, $supplier_id);
          $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no'], $item_id, $supplier_id);
        }elseif($item_id){
          $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no'], $item_id);
          $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no'], $item_id);
        }elseif($supplier_id){
          $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no'], NULL, $supplier_id);
          $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no'], NULL, $supplier_id);
        }else{
          $row['item_quantity'] = $this->MPurchase_details->get_total_quantity($row['purchase_no']);
          $row['total_price'] = $this->MPurchase_details->get_total_price($row['purchase_no']);
        }
        
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }
  
  function create() {
    $data = array(
        'company_id' => $this->input->post('company_id'),
        'user_id' => $this->session->userdata('user_id'),
        'purchase_no' => $this->input->post('purchase_no'),
        'purchase_date' => $this->input->post('purchase_date'),
        'notes' => $this->input->post('notes'),
        'edate' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('purchase_master', $data);
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
    $this->db->update('purchase_master', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('purchase_master');
  }

}