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
            'name_food' => $savedata['name_food'],
            'price' => $savedata['price'],
            'img' => $savedata['img'],
            'delete' => $savedata ['delete']

        );

        $this->db->insert('food', $data);
        return $this->db->insert_id();
    }
    public function read_admin(){
        $sql = "select email from admin where email ";
        $query = $this->db->get($sql);
        return $query->result();
    }
    public function read_service_all_admin()
    {
        $where = array(
            'delete' => 1,
        );
        $this->db->select('id_food,name_food,price,img')->from('food')->where($where);
        $query = $this->db->get();
        return $query->result();
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
    public function read_service_by_id1($id_food)
    {
        $where = array(
            'id_food' => $id_food,
        );
        $this->db->select('id_food,name_food,price,')->from('food')->where($where);
        $query = $this->db->get();
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
            'id_food' => $savedata['id_food'],
            'name_food' => $savedata['name_food'],
            'price' => $savedata['price'],

        );
        $this->db->where('id_food', $savedata['id_food']);
        $this->db->update('food', $data);
    }
    
    public function delete_service($id_food)
    {
        $this->db->set('delete', 0);
        $this->db->where('id_food', $id_food);
        $this->db->update('food');
        return $this->db->affected_rows();
    }

    //ลบออกจาก database
    // public function delete_service($id_service) {
    //     $this->db->where('id_service', $id_service);
    //     $this->db->delete('service');
    //     return $this->db->affected_rows();
    // }
}
