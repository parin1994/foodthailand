<?php
defined('BASEPATH') or exit('NO direct script acces allowed');

class Services extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url', 'file'));
        $this->load->library('upload');
        $this->load->model('service_model');
        $this->load->model('booking_model');
        // $this->load->library('session');
        // $this->load->library('form_validation');
        // $email = $this->session->userdata('email');
        // if (empty($email)) {
        //     redirect('foodthailandoffice/login');
        // }
    }
    public function index()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'การให้บริการ';
        $data['read'] = $this->service_model->read_service_all_admin();
        $data['menu'] = $this->load->view('foodthailandoffice/include/menu', $data, TRUE);
        $data['headers'] = $this->load->view('foodthailandoffice/include/headers', '', TRUE);
        $this->load->view('foodthailandoffice/service/index', $data);
    }
    public function create()
    {
       
        $data['title'] = 'เพิ่มข้อมูล';
        $data['method'] = 'Create';
        $data['headers'] = $this->load->view('foodthailandoffice/include/headers', '', TRUE);
        $data['menu'] = $this->load->view('foodthailandoffice/include/menu',  $data, TRUE);
        $method = $this->input->post('method');


        $data['con'] = new stdClass();
        $data['con']->id_food = '';
        $data['con']->name_food = '';
        $data['con']->price = '';



        $name_food = $this->input->post('name_food');

        if (!empty($name_food)) {
            $name_food = $this->input->post('name_food');
            $price = $this->input->post('price');

            $savedata = array(

                'name_food' => $name_food,
                'price' => $price,
                'delete' => 1,

            );

            $result = $this->service_model->create_service($savedata);
            redirect('foodthailandoffice/service/index');
        }
        $this->load->view('foodthailandoffice/service/form', $data);
    }

    public function update($id_food)
    {
        $data['title'] = 'แก้ไขข้อมูล';
        $data['method'] = 'Update';
        $data['headers'] = $this->load->view('foodthailandoffice/include/headers', '', TRUE);
        $data['menu'] = $this->load->view('foodthailandoffice/include/menu',$data, TRUE);

        $data['con'] = $this->service_model->read_service_by_id1($id_food);
        $method = $this->input->post('method');

        if (!empty($method)) {
            $name_food = $this->input->post('name_food');
            $price = $this->input->post('price');

            $savedata = array(
                'id_food' => $id_food,
                'name_food' => $name_food,
                'price' => $price

            );

            $result = $this->service_model->update_service($savedata);
            redirect('foodthailandoffice/service/index');

            $data['con'] = $this->service_model->read_service_by_id1($id_food);
        }
        $this->load->view('foodthailandoffice/service/form', $data);
    }

    public function delete($id_food) {

        if (!empty($id_food)) {

            $result = $this->service_model->delete_service($id_food);
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
