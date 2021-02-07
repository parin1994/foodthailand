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
        $this->load->helper(array('form', 'url', 'file'));

    }
    public function index()
    {
        $data["product"] = $this->booking_model->read_all();
        $data['store'] = $this->booking_model->read_table_all();
        $this->load->view("booking", $data);
    }
    function load()
    {
        echo $this->view();
    }
    public function create(){
        $array = $this->input->post('myTableArray');
        $table = $this->input->post('id_table');
        $total = $this->input->post('total');
        $userid = $this->input->post('userid');
        
        $savedata = array(
            'id_table' => $table,
            'total' => $total,
            'date'  => date("Y/m/d H:i:s"),
            'status' => 'รอ',
            'status_food' => 'รอ',
            'userid' => $userid
        );
        $result1 = $this->booking_model->create_booking($savedata);
        $result = $this->booking_model->create_menu($array,$result1);
    }
    public function add()
    {
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
        $this->session->set_userdata('cart', $data);
        $cart = $this->session->userdata('cart');
        $result = $this->ToObject($cart);
        echo json_encode($result);
    }
    public function view()
    {
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
        $cart = $this->session->userdata('cart');
        $resultObj1 = $this->ToObject($cart);
        print_r($resultObj1);
        foreach ($resultObj1 as $item) {
            $count++;
            $output .= '
        <tr> 
            <td>' . $item->name_food . '</td>
            <td>' . $item->quantity . '</td>
            <td>' . $item->price . '</td>
            <td>' . $item->total . '</td>
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
    public function ToObject($Array)
    {
        $object = new stdClass();
        foreach ($Array as $key => $value) {
            if (is_array($value)) {
                $value = $this->ToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}
