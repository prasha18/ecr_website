<?php
include("login_action.php");
user_log_vals();
?>
	
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="vendor/assets/images/favicon.ico">
    <title>LetsFAME</title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="vendor/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="vendor/assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="vendor/dist/css/pages/dashboard1.css" rel="stylesheet">
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet"> 
	
	<link href="vendor/dist/css/style.min.css" rel="stylesheet">
  
    
</head>

<body class="skin-megna fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!--<div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite Hospital</p>
        </div>
    </div>-->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'header.php';?>    
		<!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include 'side_menu.php';?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid"><br>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <div class="row">
                            <div class="col-md-1 align-self-center text-end pe-0">
                                <img src="vendor/assets/images/favicon.ico" alt="user" class="img-fluid">
                            </div>
                            <div class="col-md-11 align-self-center">
                                <span class="text-themecolor">Dashboard</span>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><small class="float-end text-success"><i class="fa fa-sort-asc"></i> 18% High then last month</small> Category</h5>
                                <div class="stats-row">
                                    <div class="stat-item">
                                        <h6>Overall</h6>
                                        <b>80.40%</b></div>
                                        <div class="stat-item">
                                            <h6>Montly</h6>
                                            <b>15.40%</b></div>
                                            <div class="stat-item">
                                                <h6>Day</h6>
                                                <b>5.50%</b></div>
                                            </div>
                                        </div>
                                        <div id="sparkline8" class="minus-mar"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><small class="float-end text-danger"><i class="fa fa-sort-desc"></i> 5% less then last month</small>Product</h5>
                                            <div class="stats-row">
                                                <div class="stat-item">
                                                    <h6>Overall</h6>
                                                    <b>80.40%</b></div>
                                                    <div class="stat-item">
                                                        <h6>Montly</h6>
                                                        <b>15.40%</b></div>
                                                        <div class="stat-item">
                                                            <h6>Day</h6>
                                                            <b>5.50%</b></div>
                                                        </div>
                                                    </div>
                                                    <div id="sparkline9" class="minus-mar"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><small class="float-end text-success"><i class="fa fa-sort-asc"></i> 10% High then last month</small>BLog</h5>
                                                        <div class="stats-row">
                                                            <div class="stat-item">
                                                                <h6>Overall Growth</h6>
                                                                <b>80.40%</b></div>
                                                                <div class="stat-item">
                                                                    <h6>Montly</h6>
                                                                    <b>15.40%</b></div>
                                                                    <div class="stat-item">
                                                                        <h6>Day</h6>
                                                                        <b>5.50%</b></div>
                                                                    </div>
                                                                </div>
                                                                <div id="sparkline10" class="minus-mar"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                                    <!--row -->
                                                    
                                                    
                                                    <div id="morris-area-chart1" style="height: 0px;"></div>
                                                    
                                                    <div id="morris-area-chart2" style="height:0px;"></div>
                                                    
                                                    <!-- row -->
                                                    
                                                    <!-- ============================================================== -->
                                                    <!-- End Right sidebar -->
                                                    <!-- ============================================================== -->
                                                </div>
                                                <!-- ============================================================== -->
                                                <!-- End Container fluid  -->
                                                <!-- ============================================================== -->
                                            </div>
                                            <!-- ============================================================== -->
                                            <!-- End Page wrapper  -->
                                            <!-- ============================================================== -->
                                            <!-- ============================================================== -->
                                            <!-- footer -->
                                            <!-- ============================================================== -->
                                            <!-- ============================================================== -->
                                            <!-- End footer -->
                                            <!-- ============================================================== -->
                                        </div>
                                        <!-- ============================================================== -->
                                        <!-- End Wrapper -->
                                        <!-- ============================================================== -->
                                        <!-- ============================================================== -->
                                        <!-- All Jquery -->
                                        <!-- ============================================================== -->
                                    <script src="vendor/assets/node_modules/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="vendor/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="vendor/dist/js/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="vendor/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="vendor/dist/js/sidebarmenu.js"></script>
<!--stickey kit -->



<!-- wysuhtml5 Plugin JavaScript -->
<script src="vendor/assets/node_modules/tinymce/tinymce.min.js"></script>
  <script src="vendor/assets/node_modules/raphael/raphael-min.js"></script>
                                        <script src="vendor/assets/node_modules/morrisjs/morris.min.js"></script>
                                        <script src="vendor/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
                                        <!-- Popup message jquery -->
                                        <script src="vendor/assets/node_modules/toast-master/js/jquery.toast.js"></script>
                                        <!-- jQuery peity -->
                                        <script src="vendor/assets/node_modules/peity/jquery.peity.min.js"></script>
                                        <script src="vendor/assets/node_modules/peity/jquery.peity.init.js"></script>
                                        <script src="vendor/dist/js/dashboard1.js"></script>
                                    </body>

                                    </html>
									
	