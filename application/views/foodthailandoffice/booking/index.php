<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Carcare</title>
    <link href="img/favicon.png" rel="icon">
    <link href="<?php echo base_url('assets/services/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">
    <link href="<?php echo base_url('assets/services/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/services/lib/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/services/css/zabuto_calendar.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/services/lib/gritter/css/jquery.gritter.css') ?>" />
    <link href="<?php echo base_url('assets/services/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/services/css/style-responsive.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/services/lib/chart-master/Chart.js') ?>"></script>


</head>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
    }

    /* The popup form - hidden by default */
    .form-popup {
        display: none;
        position: fixed;
        bottom: 100px;
        right: 150px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 500px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text],
    .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus,
    .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #4CAF50;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }
</style>

<body>
    <section id="container">
        <?php echo $headers; ?>
        <?php echo $menu; ?>

        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-9 main-chart">
                        <!--CUSTOM CHART START -->
                        <!-- <div class="border-head">
                            <h3><?php echo $title ?> <br></h3>
                            <p><a href="<?php echo base_url('carcareoffice/report') ?>" class="btn btn-default pull-right">
                                    <span class="fa fa-pencil">&nbsp;ออกรายงาน</span>
                                </a></p>
                        </div> -->
                        <br>
                        <br>
                        <div style="overflow-x:auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:5%;text-align:center">ลำดับ</th>
                                        <th style="width:10%;text-align:center">โต๊ะ</th>
                                        <th style="width:10%;text-align:center">รายการอาหาร</th>
                                        <th style="width:10%;text-align:center">ยอดสุทธิ</th>
                                        <th style="width:10%;text-align:center">วันที่</th>
                                        <th style="width:10%;text-align:center">ใบเสร็จ</th>
                                        <th style="width:10%;text-align:center">สถานะอาหาร</th>
                                        <th style="width:10%;text-align:center">ส่งข้อความ</th>

                                    </tr>


                                </thead>

                                <?php foreach ($read as $value) { ?>
                                    <tbody>
                                        <tr>
                                            <td style="width:5%;text-align:center"><?php echo $value->id_booking ?></td>
                                            <td style="width:10%;text-align:center"><?php echo $value->id_table ?></td>
                                            <td style="width:10%;text-align:center"><button onclick="openForm(<?php echo $value->id_booking ?>)">ดูรายรารอาหาร</button></td>
                                            <td style="width:10%;text-align:right"><?php echo $value->total ?>&nbsp;บาท</td>
                                            <td style="width:10%;text-align:center"><?php echo $value->date ?></td>
                                            <td style="width:10%;text-align:center"><?php echo $value->receipt ?></td>
                                            <td style="width:10%;text-align:center"><?php echo $value->status ?></td>
                                            <td style="width:10%;text-align:center"><a href="<?php echo base_url('curl/index/' . $value->id_booking.'/'. $value->userid) ?>" ><span class="fa fa-commenting-o"></span></a></td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>

                </div>

            </section>
        </section>

        <div class="form-popup" id="myForm">
            <form action="/action_page.php" class="form-container">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%;text-align:center">รายการอาหาร</th>
                            <th style="width:10%;text-align:center">จำนวน</th>
                            <th style="width:10%;text-align:center">ราคา</th>
                            <th style="width:10%;text-align:center">detial</th>
                        </tr>
                    </thead>
                        <tbody>
                        <tr id="tr"></tr>
                        </tbody>
                </table>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>


        <!--footer end-->
    </section>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('assets/services/lib/jquery/jquery.min.js') ?>"></script>

    <script src="<?php echo base_url('assets/services/lib/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url('assets/services/lib/jquery.dcjqaccordion.2.7.js') ?>"></script>
    <script src="<?php echo base_url('assets/services/lib/jquery.scrollTo.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/services/lib/jquery.nicescroll.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/services/lib/jquery.sparkline.js') ?>"></script>
    <!--common script for all pages-->
    <script src="<?php echo base_url('assets/services/lib/common-scripts.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/services/lib/gritter/js/jquery.gritter.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/services/lib/gritter-conf.js') ?>"></script>
    <!--script for this page-->
    <script src="<?php echo base_url('assets/services/lib/sparkline-chart.js') ?>"></script>
    <script src="<?php echo base_url('assets/services/lib/zabuto_calendar.js') ?>"></script>

    <script type="application/javascript">
        function openForm(id) {
            
            document.getElementById("myForm").style.display = "block";
            $.ajax({
                url: "<?php echo site_url('foodthailandoffice/booking/order'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>'+
                            '<td>' + data[i].name_food + '</td>' +
                            '<td>' + data[i].qty + '</td>' +
                            '<td>' + data[i].price + '</td>' +
                            '<td>' + data[i].detial + '</td>' +
                        '</tr>';
                    }
                    $('#tr').first().after(html);
                }
            });
        }

        function closeForm() {
            document.getElementById("myForm").style.display = "none";
        }
        $(document).ready(function() {
            $("#date-popover").popover({
                html: true,
                trigger: "manual"
            });
            $("#date-popover").hide();
            $("#date-popover").click(function(e) {
                $(this).hide();
            });



        });

        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
    <script>
        if (window.self == window.top) {
            (function(i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function() {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o), m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-55234356-6', 'auto');
            ga('send', 'pageview');
        }
    </script>

</body>

</html>