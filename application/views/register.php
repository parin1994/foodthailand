
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <body>
        <div class="container-contact100" style="background-color:darkblue;">
            <div class="card col-12 col-md-6 offset-md-2">
                    <form action="<?php echo base_url('register/create') ?>" method="post" class="contact100-form validate-form" style="width:100%;">
                    <span class="contact100-form-title">
                        ลงทะเบียน
                    </span>
                    <input type="hidden" id="userid" name="userid" value="">
                    <label class="label-input100"><h3><i class="fa fa-user" aria-hidden="true"></i></h3></label>
                    <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="กรุณากรอกชื่อครับ">
                        <input id="name" class="input100" type="text" name="name" placeholder="ชื่อ">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 rs2-wrap-input100 validate-input" data-validate="กรุณากรอกนามสกุลครับ">
                        <input id="lastname" class="input100" type="text" name="lastname" placeholder="นามสกุล">
                        <span class="focus-input100"></span>
                    </div>
                    <label class="label-input100" for="phone"><h3><i size="10 px" class="fa fa-mobile" aria-hidden="true"></i></h3></label>
                    <div class="wrap-input100 validate-input" data-validate="กรุณากรอกหมายเลขโทรศัพท์ครับ">
                        <input id="phone" class="input100" type="tel" name="phone" maxlength="10" placeholder="เบอร์โทรศัพท์">
                        <span class="focus-input100"></span>
                    </div>
                    <label class="label-input100" for="email"><h3><i class="fa fa-envelope" aria-hidden="true"></i></h3></label>
                    <div class="wrap-input100 validate-input" data-validate="กรุณากรอกอีเมลครับ">
                        <input id="email" class="input100" type="email" name="email" placeholder="อีเมล">
                        <span class="focus-input100"></span>
                    </div>
                    <label class="label-input100" for="message"><h3><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i></h3></label>
                    <div class="wrap-input100 validate-input" data-validate="กรุณากรอกที่อยู่ครับ">
                        <textarea id="address" class="input100" name="address" placeholder="ที่อยู่"></textarea>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-contact100-form-btn">
                        <button href="<?php echo base_url('register') ?>" class="contact100-form-btn">
                            บันทึก
                        </button>                                       
                    </div>
                </form>
            </div>
        </div>
        <div id="dropDownSelect1"></div>

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
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-23581568-13');
        </script>
        <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="3d44b465189b22b734a3929d-|49" defer=""></script></body>
    <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
    <script src="liff-starter.js"></script>
    <script>
        window.onload = function (e) {
            liff.init(function (data) {
                initializeApp(data);
            });
        };

        function initializeApp(data) {
            document.getElementById('userid').value = data.context.userId;
        }
    </script>
</html>
