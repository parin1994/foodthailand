<?php
defined('BASEPATH') OR exit('NO direct script acces allowed');
class Curl extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('booking_model');
    }
    public function index($id_booking,$userid)
    {
        $this->booking_model->message_curl($id_booking);
        $url = 'https://api.line.me/v2/bot/message/push';
        $authorization = "LAVPut6p2Seyw/s97j1L3cMOH/rvoUvXvJluohkrnIkWtdh2TO8cS2n1LQFpofSsBBOkkUfKKjdOF5GNn2KOayOCtcMPd+mqrThpGwGr8Ss1b+p/hB5nodrQHqFA5gb4X2mhOBEg1fpTtWFubt9hfgdB04t89/1O/w1cDnyilFU=";
        $post = '{
            "to": "'.$userid.'",
            "messages":[
              {
                  "type":"text",
                  "text":"กำลังส่งอาหารครับ"
              }
          ]
          }';
        $headers = [
          "Authorization: Bearer $authorization",
          "Content-Type: application/json"
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        // var_export($result);
        // exit;
        //return json_decode($result);
        redirect('foodthailandoffice/booking/index');
        
    }
}
