<?php
defined('BASEPATH') or exit('NO direct script acces allowed');
class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('booking_model');
        $this->load->library('ftp');
    }
    public function index()
    {
        $this->load->helper('url');
        $userid = $this->input->post('userid');
        print_r($userid);
        $result = $this->booking_model->read_userid($userid);
        $this->load->view('payment', $result);
    }
    public function payment_booking()
    {
        $userid = $this->input->post('userid');

        $receipt = '';
        if (isset($_FILES['img']['name'])) {
            $this->load->library('ftp');
            $ftp_config['hostname'] = 'www.ratszone.com';
            $ftp_config['username'] = 'ratszone';
            $ftp_config['password'] = 'Peng2903';
            $ftp_config['debug']    = TRUE;

            //Connect to the remote server
            $this->ftp->connect($ftp_config);
            $this->ftp->upload($_FILES['img']['tmp_name'],"/assets/img/".$_FILES['img']['name'],"ascii", 0775);

            //Close FTP connection
            $this->ftp->close();
            $receipt = './assets/img/' . $_FILES['img']['name'];
        }
        $savedata = array(

            'img' => $receipt,
        );
        $result = $this->booking_model->payment_booking($savedata);

        //$this->load->view('booking');
        echo "<script>
                alert('บันทึกข้อมูลสำเร็จ');
                window.location.href='https://foodthailand.herokuapp.com/payment';
                </script>";
    }
}
