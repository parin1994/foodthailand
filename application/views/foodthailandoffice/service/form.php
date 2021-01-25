<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Carcare Service</title>

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
                            <div class="border-head">
                                <h3><?php echo $title ?><br></h3>

                            </div>

                            
                            <form role="form" action="<?php echo base_url('foodthailandoffice/services/' . $method . '/' . $con->id_food) ?>" method="post"  enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="hidden" id="email" name="email" value="">


                                    <label for="name_blog">ประเภทการให้บริการ</label>
                                    <input type="text" class="form-control" name="name_food" id="name_food" placeholder="" value="<?php echo $con->name_food ?>">

                                    <label for="title_blog">ราคา</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="" value="<?php echo $con->price ?>">

                                </div>
                                <div class="box-footer">
                                    <a href="<?php echo base_url('foodthailandoffice/services/index') ?>" class="btn btn-primary" type="submit" name="btnsave" id="btnSave ">Save</a>
                                    <a href="<?php echo base_url('foodthailandoffice/services/index') ?>" class="btn btn-danger">Cancel</a>
                                    <input type="hidden" name="method" value="<?php echo $method ?>">
                                    <input type="hidden" name="id" value="">
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                </div>

            </section>
        </section>


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

    <script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
    <script src="liff-starter.js"></script>
    <script>
        window.onload = function(e) {
            liff.init(function(data) {
                initializeApp(data);
            });
        };

        function initializeApp(data) {
            document.getElementById('userid_carcarestore').value = data.context.userId;
        }
    </script>
</body>

</html>