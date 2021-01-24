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
        $authorization = "GZEJLqSSM+/1fMGVUK7Bk4ngrmJyzyiPW4fQ7JNaauAaUI51RSzcYJNaRbsJxB1CBBOkkUfKKjdOF5GNn2KOayOCtcMPd+mqrThpGwGr8Su0XFao8kpkrjZxP4C4XdFY7Y1cL4vrHH+JLuZyv0APRAdB04t89/1O/w1cDnyilFU=";
        $post = '{
            "to": "'.$userid.'",
            "messages": [
              {
                "type": "flex",
                "altText": "This is a Flex Message",
                "contents": {
                  "type": "bubble",
                  "body": {
                    "type": "box",
                    "layout": "horizontal",
                    "contents": [
                      {
                        "type": "text",
                        "text": "กำลังส่งอาหารครับ"
                      }
                    ]
                  }
                }
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