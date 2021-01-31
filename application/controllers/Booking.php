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
        $this->load->view("booking", $data);
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
        print_r($cart);
    }
}
