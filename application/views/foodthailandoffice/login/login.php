<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo base_url('assets/loginn/images/icons/favicon.ico') ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/bootstrap/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/animate/animate.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/css-hamburgers/hamburgers.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/animsition/css/animsition.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/select2/select2.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/vendor/daterangepicker/daterangepicker.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/css/util.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/loginn/css/main.css') ?>">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(<?php echo base_url('assets/loginn/images/bg-01.jpg') ?>);">

                </div>
                <form action="<?php echo base_url('foodthailandoffice/login/auth') ?>" method="post" class="login100-form validate-form">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="กรุณากรอกอีเมลด้วยครับ">
                        <span class="label-input100"></span>
                        <input class="input100" type="text" id="email" name="email" placeholder="อีเมล">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate="กรุณากรอกรหัสผ่านด้วยครับ">
                        <span class="label-input100"></span>
                        <input class="input100" type="password" id="pass" name="pass" placeholder="รหัสผ่าน">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/loginn/vendor/jquery/jquery-3.2.1.min.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/vendor/animsition/js/animsition.min.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/vendor/bootstrap/js/popper.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>
    <script src="<?php echo base_url('assets/loginn/vendor/bootstrap/js/bootstrap.min.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/vendor/select2/select2.min.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/vendor/daterangepicker/moment.min.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>
    <script src="<?php echo base_url('assets/loginn/vendor/daterangepicker/daterangepicker.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/vendor/countdowntime/countdowntime.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script src="<?php echo base_url('assets/loginn/js/main.js') ?>" type="c1a4c73952d65138dee55ae1-text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="c1a4c73952d65138dee55ae1-text/javascript"></script>
    <script type="c1a4c73952d65138dee55ae1-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="c1a4c73952d65138dee55ae1-|49" defer=""></script>
</body>

</html>