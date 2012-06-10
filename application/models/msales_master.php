<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class MSales_master extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_by_id($id) {
    $data = array();
    $this->db->where('id', $id);
    $q = $this->db->get('sales_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        if ($row['customer_id'] == 0) {
          $customer['name'] = 'Annynimous';
        } else {
          $customer = $this->MCustomers->get_by_id($row['customer_id']);
        }
        $row['customer_name'] = $customer['name'];
        $user = $this->MUsers->get_by_id($row['user_id']);
        $row['user_name'] = $user['full_name'];
        $item_qty = $this->MSales_details->get_total_qty_by_sales_id($row['id']);
        $row['item_qty'] = $item_qty;
        $amount = $this->MSales_details->get_total_price_by_sales_id($row['id']);
        $row['amount'] = $amount;
        $data = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all() {
    $data = array();
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('sales_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        if ($row['customer_id'] == 0) {
          $customer['name'] = 'Annynimous';
        } else {
          $customer = $this->MCustomers->get_by_id($row['customer_id']);
        }
        $row['customer_name'] = $customer['name'];
        $user = $this->MUsers->get_by_id($row['user_id']);
        $row['user_name'] = $user['full_name'];
        $item_qty = $this->MSales_details->get_total_qty_by_sales_id($row['id']);
        $row['item_qty'] = $item_qty;
        $amount = $this->MSales_details->get_total_price_by_sales_id($row['id']);
        $row['amount'] = $amount;
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_all_between_date() {
    $data = array();
    $sdate = $this->input->post('s_date');
    $edate = $this->input->post('e_date');
    $this->db->where("sales_date BETWEEN '$sdate' AND '$edate'");
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('sales_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        if ($row['customer_id'] == 0) {
          $customer['name'] = 'Annynimous';
        } else {
          $customer = $this->MCustomers->get_by_id($row['customer_id']);
        }
        $row['customer_name'] = $customer['name'];
        $user = $this->MUsers->get_by_id($row['user_id']);
        $row['user_name'] = $user['full_name'];
        $item_qty = $this->MSales_details->get_total_qty_by_sales_id($row['id']);
        $row['item_qty'] = $item_qty;
        $amount = $this->MSales_details->get_total_price_by_sales_id($row['id']);
        $row['amount'] = $amount;
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_by_customer_between_date() {
    $data = array();
    $sdate = $this->input->post('s_date');
    $edate = $this->input->post('e_date');
    $this->db->where("sales_date BETWEEN '$sdate' AND '$edate'");
    if ($this->input->post('customer_id') != 'all') {
      $this->db->where('customer_id', $this->input->post('customer_id'));
    }
    $this->db->order_by('id', 'DESC');
    $q = $this->db->get('sales_master');
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        if ($row['customer_id'] == 0) {
          $customer['name'] = 'Annynimous';
        } else {
          $customer = $this->MCustomers->get_by_id($row['customer_id']);
        }
        $row['customer_name'] = $customer['name'];
        $user = $this->MUsers->get_by_id($row['user_id']);
        $row['user_name'] = $user['full_name'];
        $item_qty = $this->MSales_details->get_total_qty_by_sales_id($row['id']);
        $row['item_qty'] = $item_qty;
        $amount = $this->MSales_details->get_total_price_by_sales_id($row['id']);
        $row['amount'] = $amount;
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function get_sales_customer() {
    $data = array();
    $this->db->select('sales_master.id, sales_master.sales_date, customers.full_name');
    $this->db->from('sales_master');
    $this->db->join('customers', 'sales_master.customer_id=customers.id');
    $this->db->where('sales_master.company_id', $this->session->userdata('company_id'));
    $q = $this->db->get();
    if ($q->num_rows() > 0) {
      foreach ($q->result_array() as $row) {
        $data[] = $row;
      }
    }

    $q->free_result();
    return $data;
  }

  function set_sales_customer($id, $customer) {
    $this->db->where('id', $id);
    $data = array('customer_id' => $customer);
    $this->db->update('sales_master', $data);
  }

  function set_sales_man($id, $emp_id) {
    $this->db->where('id', $id);
    $data = array('emp_id' => $emp_id);
    $this->db->update('sales_master', $data);
  }

  function create() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'customer_id' => 0,
        'sales_date' => date('Y-m-d'),
        'created' => date('Y-m-d H:i:s', time())
    );
    $this->db->insert('sales_master', $data);

    return $this->db->insert_id();
  }

  function discount() {
    $data = array(
        'discount' => $this->input->post('discount'),
        'type' => $this->input->post('type')
    );

    $this->db->where('id', $this->input->post('sales_id'));
    $this->db->update('sales_master', $data);
  }

  function update() {
    $data = array(
        'user_id' => $this->session->userdata('user_id'),
        'customer_id' => $this->input->post('customer_id'),
        'modified' => date('Y-m-d H:i:s', time())
    );

    $this->db->where('id', $this->input->post('sales_id'));
    $this->db->update('sales_master', $data);
  }

  function delete($id) {
    $this->db->where('id', $id);
    $this->db->delete('sales_master');
  }

}