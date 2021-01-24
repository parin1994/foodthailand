<?php
defined('BASEPATH') or exit('NO direct script acces allowed');

class Service extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('upload');
        $this->load->model('service_model');
        $this->load->model('booking_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $email = $this->session->userdata('email');
        if (empty($email)) {
            redirect('foodthailandoffice/login');
        }
    }
    public function index()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'การให้บริการ';
        $data['read'] = $this->booking_model->read_booking($email);
        $data['menu'] = $this->load->view('foodthailandoffice/include/menu', $data, TRUE);
        $data['headers'] = $this->load->view('foodthailandoffice/include/headers', '', TRUE);
        $this->load->view('foodthailandoffice/service/services', $data);
    }
    public function create()
    {
        $email = $this->session->userdata('email');
        $data['readname'] = $this->booking_model->read_namestore($email);
        $data['title'] = 'เพิ่มข้อมูล';
        $data['method'] = 'Create';
        $data['headers'] = $this->load->view('carcareoffice/include/headers', '', TRUE);
        $data['menu'] = $this->load->view('carcareoffice/include/menu',  $data, TRUE);
        $method = $this->input->post('method');


        $data['con'] = new stdClass();
        $data['con']->id_service = '';
        $data['con']->option = '';
        $data['con']->price = '';
        $email = $this->session->userdata('email');



        $option = $this->input->post('option');

        if (!empty($option)) {
            $price = $this->input->post('price');
            $date_service = $this->input->post('date_service');

            $savedata = array(

                'option' => $option,
                'price' => $price,
                'date_service' => date("Y/m/d H:i:s"),
                'email' => $email,
                'delete' => 1,

            );

            $result = $this->service_model->create_service($savedata);
            redirect('carcareoffice/service/index');
        }
        $this->load->view('carcareoffice/service/form', $data);
    }

    public function update($id_service)
    {
        $email = $this->session->userdata('email');
        $data['readname'] = $this->booking_model->read_namestore($email);
        $data['title'] = 'แก้ไขข้อมูล';
        $data['method'] = 'Update';
        $data['headers'] = $this->load->view('carcareoffice/include/headers', '', TRUE);
        $data['menu'] = $this->load->view('carcareoffice/include/menu',$data, TRUE);

        $data['con'] = $this->service_model->read_service_by_id1($id_service);
        $method = $this->input->post('method');

        if (!empty($method)) {
            $option = $this->input->post('option');
            $price = $this->input->post('price');

            $savedata = array(
                'id_service' => $id_service,
                'option' => $option,
                'price' => $price

            );

            $result = $this->service_model->update_service($savedata);
            redirect('carcareoffice/service/index');

            $data['con'] = $this->service_model->read_service_by_id($id_service);
        }
        $this->load->view('carcareoffice/service/form', $data);
    }

    public function delete($id_service) {

        if (!empty($id_service)) {

            $result = $this->service_model->delete_service($id_service);
        }

        $response = array('Delete SUCESS');
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response))
                ->_display();
        exit;
    }

    
}
