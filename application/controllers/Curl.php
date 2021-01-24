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
        $authorization = "F9U+52FYdBOSEhTIpvGHSseU8n8eRBcCWJt7QaR9ey3V1u5BQNzt1XJPtlq+GhQvekhWVbdsV0SGi6pzyXDX6pu2w+eBVKnPPjwAnMxF33nTIgMijXuRgtGJ5V7PnwPjLJVedqBztbt0X7vHl9NN7lGUYhWQfeY8sLGRXgo3xvw=";
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
