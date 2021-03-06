<?php

defined('BASEPATH') or exit('NO direct script acces allowed');

class booking_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function create($savedata)
    {
        $data = array(
            'menu' => $savedata['menu'],
            'price' => $savedata['price'],
            'total' => $savedata['total'],
            'detail' => $savedata['detail'],
            'date' => $savedata['date'],
            'receipt' => $savedata['receirt'],
            'userid' => $savedata['userid'],

        );
        $this->db->insert('booking', $data);
        return $this->db->insert_id();
    }
    public function read_table_all()
    {
        $this->db->select('*')->from('table');
        $query = $this->db->get();
        return $query->result();
    }
    public function create_booking($savedata)
    {
        $data = array(
            'id_table' => $savedata['id_table'],
            'total' => $savedata['total'],
            'date' => $savedata['date'],
            'status' => $savedata['status'],
            'status_food' => $savedata['status_food'],
            'userid' => $savedata['userid'],

        );
        $this->db->insert('booking', $data);
        return $this->db->insert_id();
    }
    public function create_menu($array_data,$id)
    {
        foreach($array_data as $a){
            $data = array(
                   'id_booking' => $id,
                   'name_food' => $a['0'],
                   'qty' => $a['1'],
                   'price'=>$a['2'],
                );
         $this->db->insert('order', $data); 
        }
    }
    public function payment_booking($savedata)
    {
        $data = array(
            'id_booking' => $savedata['id_booking'],
            'receipt' => $savedata['receipt'],
            'status' =>  'สำเร็จ'

        );
        $this->db->where('id_booking', $savedata['id_booking']);
        $this->db->update('booking', $data);
        return $this->db->affected_rows();
    }
    public function read_all()
    {
        $query = $this->db->get("food");
        return $query->result();
    }
    public function read_booking()
    {
        $query = $this->db->get("booking");
        return $query->result();
    }
    public function order($id_booking)
    {
        $sql = "SELECT * FROM `order` where id_booking = $id_booking";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function read_userid($userid)
    {
        $sql = "SELECT * FROM booking where userid = '$userid' and status_food = 'รอ';";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function message_curl($id_booking)
    {
        $this->db->set('status_food', 'สำเร็จ');
        $this->db->where('id_booking', $id_booking);
        $this->db->update('booking');
        return $this->db->affected_rows();
    }
    public function read_order($userid)
    {
        $sql = "SELECT * FROM booking where userid = '$userid' and status = 'รอ'";
        $query = $this->db->query($sql);
        return $query->result();
    }
}
