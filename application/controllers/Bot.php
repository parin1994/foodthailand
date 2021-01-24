<?php

// กรณีต้องการตรวจสอบการแจ้ง error ให้เปิด 3 บรรทัดล่างนี้ให้ทำงาน กรณีไม่ ให้ comment ปิดไป
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include composer autoload
require_once 'vendor/autoload.php';

// การตั้งเกี่ยวกับ bot
require_once 'bot_settings.php';

// กรณีมีการเชื่อมต่อกับฐานข้อมูล
//require_once("dbconnect.php");
///////////// ส่วนของการเรียกใช้งาน class ผ่าน namespace
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event;
use LINE\LINEBot\Event\BaseEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\AccountLinkEvent;
use LINE\LINEBot\Event\MemberJoinEvent;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\LocationMessageBuilder;
use LINE\LINEBot\MessageBuilder\AudioMessageBuilder;
use LINE\LINEBot\MessageBuilder\VideoMessageBuilder;
use LINE\LINEBot\ImagemapActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\DatetimePickerTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\PostbackTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\Constant\Flex\ComponentIconSize;
use LINE\LINEBot\Constant\Flex\ComponentImageSize;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectRatio;
use LINE\LINEBot\Constant\Flex\ComponentImageAspectMode;
use LINE\LINEBot\Constant\Flex\ComponentFontSize;
use LINE\LINEBot\Constant\Flex\ComponentFontWeight;
use LINE\LINEBot\Constant\Flex\ComponentMargin;
use LINE\LINEBot\Constant\Flex\ComponentSpacing;
use LINE\LINEBot\Constant\Flex\ComponentButtonStyle;
use LINE\LINEBot\Constant\Flex\ComponentButtonHeight;
use LINE\LINEBot\Constant\Flex\ComponentSpaceSize;
use LINE\LINEBot\Constant\Flex\ComponentGravity;
use LINE\LINEBot\MessageBuilder\FlexMessageBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BubbleStylesBuilder;
use LINE\LINEBot\MessageBuilder\Flex\BlockStyleBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\BubbleContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ContainerBuilder\CarouselContainerBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\BoxComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ButtonComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\IconComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\ImageComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SpacerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\FillerComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\SeparatorComponentBuilder;
use LINE\LINEBot\MessageBuilder\Flex\ComponentBuilder\TextComponentBuilder;
use LINE\LINEBot\Event\MessageEvent\LocationMessage;

class Bot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('booking_model');
    }

    public function ToObject($Array)
    {
        $object = new stdClass();
        foreach ($Array as $key => $value) {
            if (is_array($value)) {
                $value = $this->ToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }

    public function index()
    {
        // เชื่อมต่อกับ LINE Messaging API
        $httpClient = new CurlHTTPClient(LINE_MESSAGE_ACCESS_TOKEN);
        $bot = new LINEBot($httpClient, array('channelSecret' => LINE_MESSAGE_CHANNEL_SECRET));

        // คำสั่งรอรับการส่งค่ามาของ LINE Messaging API
        $content = file_get_contents('php://input');
        $hash = hash_hmac('sha256', $content, LINE_MESSAGE_CHANNEL_SECRET, true);
        $signature = base64_encode($hash);

        // แปลงค่าข้อมูลที่ได้รับจาก LINE เป็น array ของ Event Object
        $events = $bot->parseEventRequest($content, $signature);
        $eventObj = $events[0]; // Event Object ของ array แรก
        // ดึงค่าประเภทของ Event มาไว้ในตัวแปร มีทั้งหมด 7 event
        $eventType = $eventObj->getType();

        // แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
        // สร้างตัวแปร ไว้เก็บ sourceId ของแต่ละประเภท
        $userId = NULL;
        $sourceId = NULL;
        $sourceType = NULL;
        // สร้างตัวแปร replyToken และ replyData สำหรับกรณีใช้ตอบกลับข้อความ
        $result = NULL;
        $replyToken = NULL;
        $replyData = NULL;
        // สร้างตัวแปร ไว้เก็บค่าว่าเป้น Event ประเภทไหน
        $eventMessage = NULL;
        $eventPostback = NULL;
        $eventJoin = NULL;
        $eventLeave = NULL;
        $eventFollow = NULL;
        $eventUnfollow = NULL;
        $eventBeacon = NULL;
        $eventAccountLink = NULL;
        $eventMemberJoined = NULL;
        $eventMemberLeft = NULL;

        switch ($eventType) {
            case 'message':
                $eventMessage = true;
                break;
            case 'postback':
                $eventPostback = true;
                break;
            case 'join':
                $eventJoin = true;
                break;
            case 'leave':
                $eventLeave = true;
                break;
            case 'follow':
                $eventFollow = true;
                break;
            case 'unfollow':
                $eventUnfollow = true;
                break;
            case 'beacon':
                $eventBeacon = true;
                break;
            case 'accountLink':
                $eventAccountLink = true;
                break;
            case 'memberJoined':
                $eventMemberJoined = true;
                break;
            case 'memberLeft':
                $eventMemberLeft = true;
                break;
        }
        // สร้างตัวแปรเก็บค่า userId กรณีเป็น Event ที่เกิดขึ้นใน USER
        if ($eventObj->isUserEvent()) {
            $userId = $eventObj->getUserId();
            $sourceType = "USER";
        }

        $sourceId = $eventObj->getEventSourceId();
        if (is_null($eventLeave) && is_null($eventUnfollow) && is_null($eventMemberLeft)) {
            $replyToken = $eventObj->getReplyToken();
        }

        if (!is_null($eventPostback)) {
            $dataPostback = NULL;
            $paramPostback = NULL;
            // // แปลงข้อมูลจาก Postback Data เป็น array
            parse_str($eventObj->getPostbackData(), $dataPostback);
            // // ดึงค่า params กรณีมีค่า params
            $paramPostback = $eventObj->getPostbackParams();
            // file_put_contents('log.txt', "dataPostback : " . print_r($dataPostback, true) . PHP_EOL, FILE_APPEND);
            // file_put_contents('log.txt', "dataPostback : " . print_r($paramPostback, true) . PHP_EOL, FILE_APPEND);
        }
        $events = json_decode($content, true);

        if (!is_null($events)) {
            if (!is_null($eventMessage)) {

                // สร้างตัวแปรเก็ยค่าประเภทของ Message จากทั้งหมด 7 ประเภท
                $typeMessage = $eventObj->getMessageType();
                //  text | image | sticker | location | audio | video | file  
                // เก็บค่า id ของข้อความ
                $idMessage = $eventObj->getMessageId();
                // ถ้าเป็นข้อความ
                if ($typeMessage == 'text') {
                    $userMessage = $eventObj->getText(); // เก็บค่าข้อความที่ผู้ใช้พิมพ์
                }
                // ถ้าเป็น image
                if ($typeMessage == 'image') {
                    $message_id = $eventObj->getMessageId();
                    $response = $bot->getMessageContent($message_id);
                }
                // ถ้าเป็น audio
                if ($typeMessage == 'audio') {
                }
                // ถ้าเป็น video
                if ($typeMessage == 'video') {
                }
                if ($typeMessage == 'location') {
                }

                switch ($typeMessage) {
                    case 'text':
                        $userMessage = strtolower($userMessage);
                        switch ($userMessage) {

                                case "สถานะอาหาร":
                                    $response = $bot->getProfile($userId);
                                    if ($response->isSucceeded()) {
                                        $userData = $response->getJSONDecodedBody(); // return array     
                                        $userId = $userData['userId'];
                                    }
                                    $result = $this->booking_model->read_userid($userId);
                                    foreach ($result as $value) {
                                        $textReplyMessage = "เลข".$value->id_booking;
                                    }                                    
                                    $replyData = new TextMessageBuilder($textReplyMessage);
                                    break;

                                case "หลังบ้าน":                  
                                    $actionBuilder = array(
                                        new UriTemplateActionBuilder(
                                            'เข้าสู่ระบบ', // ข้อความแสดงในปุ่ม
                                            'https://liff.line.me/1655534162-pdgzDdAx' // ข้อความแสดงในปุ่ม
                                        )
                                    );
                                    $replyData = new TemplateMessageBuilder(
                                        'Carousel',
                                        new CarouselTemplateBuilder(
                                            array(
                                                new CarouselColumnTemplateBuilder(
                                                    'เข้าสู่ระบบ',
                                                    'Admin',
                                                    'https://i.pinimg.com/736x/00/12/cd/0012cdc873feaf62cf91594fb575ca90.jpg',
                                                    $actionBuilder
                                                )
                                            )
                                        )
                                    );
                                    break;
                                    case "จ่ายเงิน":                  
                                        $actionBuilder = array(
                                            new UriTemplateActionBuilder(
                                                'ชำระเงิน', // ข้อความแสดงในปุ่ม
                                                'https://liff.line.me/1655534162-PlY90bgn' // ข้อความแสดงในปุ่ม
                                            )
                                        );
                                        $replyData = new TemplateMessageBuilder(
                                            'Carousel',
                                            new CarouselTemplateBuilder(
                                                array(
                                                    new CarouselColumnTemplateBuilder(
                                                        'จ่ายเงิน',
                                                        'ขอบคุณที่ใช้บริการครับ',
                                                        'https://i.pinimg.com/736x/00/12/cd/0012cdc873feaf62cf91594fb575ca90.jpg',
                                                        $actionBuilder
                                                    )
                                                )
                                            )
                                        );
                                        break;

                            case "บริการ":
                                $textReplyMessage = "บริการของศูนย์บริการทั้งหมดจะมี ล้างรถ ขัดสี ขัดเงา ดูดฝุ่น ครับ";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                                break;
                            case "ราคา":
                                $textReplyMessage = "ราคาของบริการล้างสีจะอยู่ในช่วง 150 - 300 บาทครับ";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                                break;
                            case "เวลาเปิด-ปิด":
                                $textReplyMessage = "ศูนย์บริการล้างรถจะเปิดระหว่าง 8:30 - 17:30น.";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                                break;
                            default:
                                $textReplyMessage = "สามารถเลือกดูเมนูต่างๆภายในร้านค้าได้ คลิกที่เมนูด้านล่างครับ";
                                $replyData = new TextMessageBuilder($textReplyMessage);
                        }
                        break;

                        // default:
                        //     $textReplyMessage = json_encode($events);
                        //     $replyData = new TextMessageBuilder($textReplyMessage);
                        //     break;
                }
            }
            //l ส่วนของคำสั่งตอบกลับข้อความ
            $response = $bot->replyMessage($replyToken, $replyData);
            //        $err_msg = $response->getHTTPStatus() . " " . $response->getRawBody();
            //        file_put_contents('error_log.txt', print_r($err_msg, TRUE) . PHP_EOL, FILE_APPEND);
        }
    }
}
