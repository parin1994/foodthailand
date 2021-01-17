<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('register_model');
        $this->load->library('session');
    }
    public function index(){
        $this->load->view('foodthailandoffice/login/login');
    }
    public function auth(){
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');

        $member = $this->register_model->read_admin($email,$pass);
        if(!empty($member)){
            $this->session->set_userdata('email', $member[0]->email);
            redirect('foodthailandoffice/booking');
        }else{
            ?>
               <script type="text/javascript">
               alert("email or password ไม่ถูกต้อง");
               location.href="index";
               </script>
               <?php
        }
    }
    public function logout(){
       
        $this->session->unset_userdata('email','');
        $this->session->sess_destroy();
            redirect('foodthailandoffice/login');
        }
}