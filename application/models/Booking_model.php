<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class booking_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function create($savedata){
        $data = array(
            'menu' => $savedata ['menu'],
            'price' => $savedata ['price'],
            'total' => $savedata ['total'],
            'detail' => $savedata ['detail'],
            'date' => $savedata ['date'],
            'receipt' => $savedata ['receirt'],
            'userid' => $savedata ['userid'],
           
        );
        $this->db->insert('booking', $data);
        return $this->db->insert_id();
    }
    public function payment_booking($savedata){
        $data = array(
            'receipt' => $savedata ['receirt'],
           
        );
        $this->db->insert('booking', $data);
        return $this->db->insert_id();
    }
    public function read_all(){
        $query = $this->db->get("food");
        return $query->result();
    }
    public function read_booking(){
        $query = $this->db->get("booking");
        return $query->result();
    }
    public function order($id_booking){
        $sql = "SELECT `order`.id_order,food.name_food,food.price,`order`.qty,`order`.detail FROM `order` inner join food on `order`.id_food = food.id_food where `order`.id_booking = $id_booking";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function read_userid($userid){
        $sql = "SELECT * FROM booking where userid = '$userid' and status = '0';";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function message_curl($id_booking) {
        $this->db->set('status_food', 'สำเร็จ');
        $this->db->where('id_booking', $id_booking);
        $this->db->update('booking');
        return $this->db->affected_rows();
    }
}