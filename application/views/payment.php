<!DOCTYPE html>
<html lang="en">
<script src="https://res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/vconsole/3.0.0/vconsole.min.js"></script>
        <script> var vConsole = new VConsole();</script>
<script>
    var vConsole = new VConsole();
</script>

<head>
    <title>Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/register/images/icons/favicon.ico') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/bootstrap/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/animate/animate.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/css-hamburgers/hamburgers.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/animsition/css/animsition.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/select2/select2.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/vendor/daterangepicker/daterangepicker.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/css/util.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/register/css/main.css') ?>">



</head>
<style>
    .js-select2 {
        font-family: Poppins-Regular;
        font-size: 15px;
        color: #555555;
        text-transform: uppercase;
        letter-spacing: 1px;

        width: 450%;
        min-height: 55px;
        border: 1px solid #e6e6e6;
        margin-top: 0px;
        line-height: 1.2;
        padding: 0 25px;

        margin-bottom: 0;
    }

    .label-input150 {
        align-items: center;
        font-family: Poppins-Regular;
        font-size: 12px;
        color: #555555;
        line-height: 1.5;
        text-transform: uppercase;
        letter-spacing: 1px;

        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;

        width: 100%;
        min-height: 55px;
        border: 1px solid #e6e6e6;
        padding: 10px 25px;
        margin-top: 15px;
        margin-bottom: 0;
    }
</style>

<body>
    <div class="container-contact100" style="background-color:white;">
        <div class="card col-12 col-md-6 offset-md-2">

            <form action="<?php echo base_url('payment/payment_booking') ?>" method="post" class="contact100-form validate-form" style="width:100%;" enctype="multipart/form-data">
        
                <div class="container">
                <span class="col-12 text-center">
                <h5>อัพโหลดใบเสร็จการชำระเงิน</h5>
                <br>
                <input type="file" name="img" id="img" >
                </span>
                </div>
                <br>
                <div class="container-contact100-form-btn">
                    <button  class="contact100-form-btn">
                        ยืนยัน
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="dropDownSelect1"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
    <script src="<?php echo base_url('assets/register/vendor/jquery/jquery-3.2.1.min.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script src="<?php echo base_url('assets/register/vendor/animsition/js/animsition.min.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script src="<?php echo base_url('assets/register/vendor/bootstrap/js/popper.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>
    <script src="<?php echo base_url('assets/register/vendor/bootstrap/js/bootstrap.min.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script src="<?php echo base_url('assets/register/vendor/select2/select2.min.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>
    <script type="3d44b465189b22b734a3929d-text/javascript">
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>

    <script src="<?php echo base_url('assets/register/vendor/daterangepicker/moment.min.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>
    <script src="<?php echo base_url('assets/register/vendor/daterangepicker/daterangepicker.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script src="<?php echo base_url('assets/register/vendor/countdowntime/countdowntime.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script src="<?php echo base_url('assets/register/js/main.js') ?>" type="3d44b465189b22b734a3929d-text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="3d44b465189b22b734a3929d-text/javascript"></script>
    <script type="3d44b465189b22b734a3929d-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="3d44b465189b22b734a3929d-|49" defer=""></script>
</body>
<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
<script src="liff-starter.js"></script>

<script>
    window.onload = function(e) {
        liff.init( function(data) {
             runApp();
        });
    };

    function runApp() {
        liff.getProfile().then(profile => {
            document.getElementById("pictureUrl").src = profile.pictureUrl;
            document.getElementById("displayName").innerHTML = '<b>สวัสดีคุณ </b> ' + profile.displayName;
            document.getElementById("userid").value = profile.userId;
            
        }).catch(err => console.error(err));
    }
    
    liff.init({
        liffId: "1655534162-PlY90bgn"
    }, () => {
        if (liff.isLoggedIn()) {
            runApp()
        } else {
            liff.login();
        }
    }, err => console.error(err.code, error.message));
</script>
</html>