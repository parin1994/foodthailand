<?php

defined('BASEPATH') or exit('NO direct script acces allowed');

class Service_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_service($savedata)
    {
        $data = array(
            'option' => $savedata['option'],
            'price' => $savedata['price'],
            'date_service' => $savedata['date_service'],
            'email' => $savedata['email'],
            'delete' => $savedata ['delete']

        );

        $this->db->insert('service', $data);
        return $this->db->insert_id();
    }

    public function read_service_by_id($email)
    {
        $where = array(
            'email' => $email,
            'delete' => 1
        );
        $this->db->select('id_service,option,price,date_service,email,delete')->from('service')->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function read_service_by_id1($id_service)
    {
        $where = array(
            'id_service' => $id_service,
        );
        $this->db->select('id_service,option,price,date_service,email')->from('service')->where($where);
        $query = $this->db->get();
        // print_r($where);
        // exit();
        return $query->row();
    }

    public function read_service_all()
    {
        $this->db->select('id_service,option,price,date_service,email')->from('service');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_service($savedata)
    {

        $data = array(
            'id_service' => $savedata['id_service'],
            'option' => $savedata['option'],
            'price' => $savedata['price'],

        );
        $this->db->where('id_service', $savedata['id_service']);
        $this->db->update('service', $data);
    }
    
    public function delete_service($id_service)
    {
        $this->db->set('delete', 0);
        $this->db->where('id_service', $id_service);
        $this->db->update('service');
        return $this->db->affected_rows();
    }

    //ลบออกจาก database
    // public function delete_service($id_service) {
    //     $this->db->where('id_service', $id_service);
    //     $this->db->delete('service');
    //     return $this->db->affected_rows();
    // }
}
