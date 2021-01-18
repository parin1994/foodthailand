<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class Booking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('booking_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $email = $this->session->userdata('email');
        if (empty($email)) {
            redirect('foodthailandoffice/login');
        }
    }
    public function index(){
        $email = $this->session->userdata('email');
        $data['title'] = 'เมนูอาหาร';
        $data['read'] = $this->booking_model->read_booking($email);
        $data['menu'] = $this->load->view('foodthailandoffice/include/menu', $data, TRUE);
        $data['headers'] = $this->load->view('foodthailandoffice/include/headers', '', TRUE);
        $this->load->view('foodthailandoffice/booking/index',$data);
    }
    public function order(){
        $id_booking = $this->input->post('id');
        $data = $this->booking_model->order($id_booking);
        echo json_encode($data);
    }
}