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
    <link rel="icon" type="image/png" sizes="16x16" href="vendor/assets/images/favicon.png">
    <title>LetsFAME Blog</title>
    <!-- page css -->
    <link href="vendor/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet"> 
	 <link rel="stylesheet" href="vendor/popup_style.css"> 

</head>

<body class="skin-default card-no-border">
  
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(vendor/assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
 
	<form method="post" action="login_action.php"  enctype="multipart/form-data" autocomplete="off">  
<h1 class="text-center"><img src="vendor/assets/images/logo-light-icon.png" alt="homepage" class="light-logo img-fluid  w-75 py-3"></h1>
 <?php 
			if(!empty($_REQUEST['ses_exp'])) { echo "<p style='color:#ff0000'> Your session has been expired! </p>"; }
		  ?>
		   <?php
			if(!empty($_REQUEST['log_err'])) { echo "<p style='color:#ff0000'> Invalid user name and password </p>"; }
		  ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" placeholder="Username" required> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" placeholder="Password" required> </div>
                                </div>
                               
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn w-100 btn-lg btn-info btn-rounded text-white" name="login" type="submit">Log In</button>
                                    </div>
                                </div>
                                
                            </form>
                            
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- ============================================================== -->
                <!-- End Wrapper -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- All Jquery -->
                <!-- ============================================================== -->
                <script src="vendor/assets/node_modules/jquery/dist/jquery.min.js"></script>
                <!-- Bootstrap tether Core JavaScript -->
                <script src="vendor/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <!--Custom JavaScript -->
                <script type="text/javascript">
                    $(function() {
                        $(".preloader").fadeOut();
                    });
                    $(function() {
                        $('[data-bs-toggle="tooltip"]').tooltip()
                    });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
                    $('#to-recover').on("click", function() {
                        $("#loginform").slideUp();
                        $("#recoverform").fadeIn();
                    });
                </script>
                
            </body>

            </html>