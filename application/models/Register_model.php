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
        $this->db->insert('register', $data);
        return $this->db->insert_id();
    }
    public function read_admin($email,$pass){
        $sql = "select email, pass from admin where email = '$email' and pass = '$pass'";
        $query = $this->db->query($sql);
        return $query->result();

    }
}