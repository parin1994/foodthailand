<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('register_model');
    }
    public function index(){
        $this->load->view('register');
    }
    public function create(){
        $userid = $this->input->post('$userid');
        $name = $this->input->post('$name');
        $lastname = $this->input->post('$lastname');
        $email = $this->input->post('$email');
        $phone = $this->input->post('$phone');
        $address = $this->input->post('$address');
        $address = $this->input->post('$address');

        $savedata =array(
            'userid' => $userid,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'date' => date("Y/m/d H:i:s")
        );
        $result = $this->register_model->create($savedata);
    }
}