<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Service</title>

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="<?php echo base_url('assets/services/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/services/lib/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url('assets/services/lib/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/services/css/zabuto_calendar.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/services/lib/gritter/css/jquery.gritter.css') ?>" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/services/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/services/css/style-responsive.css') ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/services/lib/chart-master/Chart.js') ?>"></script>

    <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->



        <?php echo $headers; ?>


        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <?php echo $menu; ?>

        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                    <div class="col-lg-9 main-chart">
                        <!--CUSTOM CHART START -->
                        <div class="border-head">
                            <h3><?php echo $title ?> <br></h3>
                            <p><a href="<?php echo base_url('foodthailandoffice/services/create') ?>" class="btn btn-default pull-right">
                                    <span class="fa fa-plus"> เพิ่ม</span>
                                </a></p>
                        </div>
                        <br>
                        <br>
                        <div style="overflow-x:auto;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th style="width:10%;text-align:center">รูป</th> -->
                                        <th style="width:10%;text-align:center">เมนูอาหาร</th>
                                        <th style="width:10%;text-align:center">ราคา</th>
                                        <th style="width:10%;text-align:center">แก้ไข</th>
                                        <th style="width:10%;text-align:center">ลบ</th>
                                    </tr>


                                </thead>

                                <?php foreach ($read as $value) { ?>
                                    <tbody>
                                        <tr>

                                            <td style="width:10%;text-align:center"><?php echo $value->name_food ?></td>
                                            <td style="width:10%;text-align:right"><?php echo $value->price ?>&nbsp;บาท</td>

                                            <td style="width:10%;text-align:center"><a href="<?php echo base_url('foodthailandoffice/services/update/' . $value->id_food) ?>" id="edit" class="btn btn-primary"><span class="fa fa-edit"></span></a></td>
                                            <td style="width:10%;text-align:center"><button type="button" class="btn btn-danger" data-href="<?php echo $value->id_food ?>" id="delete" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash"></span></button>

                                            </td>
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


        <!--footer end-->
    </section>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                ยืนยันการลบ
                </div>
                <div class="modal-body">
                    คุณต้องการลบหรือไม่ ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-danger btn-ok clickDelete">ลบ</a>
                </div>
            </div>
        </div>
    </div>

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
        $(document).ready(function() {
            $("#date-popover").popover({
                html: true,
                trigger: "manual"
            });
            $("#date-popover").hide();
            $("#date-popover").click(function(e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function() {
                    return myDateFunction(this.id, false);
                },
                action_nav: function() {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [{
                        type: "text",
                        label: "Special event",
                        badge: "00"
                    },
                    {
                        type: "block",
                        label: "Regular event",
                    }
                ]
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

    <script>
        $(function() {

            $('#confirm-delete').on('show.bs.modal', function(e) {
                console.log('test');
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
            $('.clickDelete').on('click', function(e) {
                console.log('test1');
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('foodthailandoffice/services/delete') ?>" + '/' + $(this).attr('href'),
                    data: '',
                    dataType: "json",
                    success: function(obj) {
                        location.reload();
                    }
                });
            });
            
            $('#nav-marketing, #nav-profileuser').addClass('active');


            $('#visible').on('click', '.click-visible', function(e) {
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url('clinicoffice/blog/visible') ?>" + '/' + $(this).data('id_blog') + '/' + $(this).data('visible'),
                    data: '',
                    dataType: "json",
                    success: function(obj) {
                        location.reload();
                    }
                });
            });



        });
    </script>
</body>

</html>