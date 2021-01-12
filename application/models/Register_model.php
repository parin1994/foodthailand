<?php

defined('BASEPATH') OR exit('NO direct script acces allowed');

class Register_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function create($savedata){
        $data = array(
            'userid' => $savedata ['userid'],
            'name' => $savedata ['name'],
            'lastname' => $savedata ['lastname'],
            'email' => $savedata ['email'],
            'phone' => $savedata ['phone'],
            'address' => $savedata ['address'],
            'date' => $savedata ['date']
        );
        $this->db->insert($data);
        return $this->db->insert_id();
    }
}