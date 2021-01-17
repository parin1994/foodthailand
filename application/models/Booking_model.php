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
    public function read_all(){
        $query = $this->db->get("food");
        return $query->result();
    }
}