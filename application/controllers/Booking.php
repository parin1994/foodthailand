<?php

defined('BASEPATH') or exit('NO direct script acces allowed');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('booking_model');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url', 'file'));

    }
    public function index()
    {
        $data["product"] = $this->booking_model->read_all();
        $this->load->view("booking", $data);
    }
    function load()
    {
        echo $this->view();
    }
    public function add()
    {
        $this->load->library('cart');
        $id_food = $this->input->post('id_food');
        $name_food = $this->input->post('name_food');
        $price = $this->input->post('price');
        $quantity = $this->input->post('quantity');
        $data = array(
            "id_food"  => $id_food,
            "name_food"  => $name_food,
            "price"  => $price,
            "quantity"  => $quantity
        );
        $this->cart->insert($data);
        print_r($this->cart->contents());
        echo $this->view();
    }
    public function view()
    {
        // $this->load->library("cart");
        $output = '';
        $output .= '
        <h3>Shopping Cart</h3><br />
        <div class="table-responsive">
        <div align="right">
        <button type="button" id="clear_cart" class="btn btn-warning">Clear Cart</button>
        </div>
        <br />
        <table class="table table-bordered">
        <tr>
        <th width="40%">Name</th>
        <th width="15%">Quantity</th>
        <th width="15%">Price</th>
        <th width="15%">Total</th>
        <th width="15%">Action</th>
        </tr>
        ';
        $count = 0;
        foreach ($this->cart->contents() as $items) {
            $count++;
            $output .= '
        <tr> 
            <td>' . $items["name_food"] . '</td>
            <td>' . $items["quantity"] . '</td>
            <td>' . $items["price"] . '</td>
            <td>' . $items["total"] . '</td>
            <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="' . $items["rowid"] . '">Remove</button></td>
            </tr>
        ';
        }
        $output .= '
             <tr>
            <td colspan="4" align="right">Total</td>
            <td>' . $this->cart->total() . '</td>
            </tr>
        </table>

  </div>
  ';
        if ($count == 0) {
            $output = '<h3 align="center">Cart is Empty</h3>';
        }
        return $output;
    }
    function remove()
    {
        // $this->load->library("cart");
        $row_id = $_POST["row_id"];
        $data = array(
            'rowid'  => $row_id,
            'qty'  => 0
        );
        $this->cart->update($data);
        echo $this->view();
    }

    function clear()
    {
        // $this->load->library("cart");
        $this->cart->destroy();
        echo $this->view();
    }
}
