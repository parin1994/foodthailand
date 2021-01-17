<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('booking_model');
    }
    public function index(){
        
        $data["product"] = $this->booking_model->read_all();
        $this->load->view("booking",$data);
    }
}