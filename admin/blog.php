<?php

include("login_action.php");
user_log_vals();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LetsFAME Blog</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="vendor/assets/images/favicon.png">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="vendor/popup_style.css"> 

    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            white-space: nowrap;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        body {
            margin: 0;
            font-family: var(--bs-font-sans-serif);
            font-size: 11.5px;
    font-weight: 400;
    line-height: 1.05;
            color: #212529;
            background-color: #edf1f5;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }
    </style>
</head>

<body class="skin-megna fixed-layout">   
    <div id="main-wrapper">
        <!-- Topbar header -->
        <?php include 'header.php';?>  
        <!-- End Topbar header --> 

        <!-- Left Sidebar -->
        <?php include 'side_menu.php';?> 
        <!-- End Left Sidebar --> 

        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <div class="row">
                            <div class="col-md-1 align-self-center text-end pe-0">
                                <img src="vendor/assets/images/favicon.ico" alt="user" class="img-fluid">
                            </div>
                            <div class="col-md-11 align-self-center">
                                <span class="text-themecolor">Blogs</span>
                            </div>
							
                        </div> 
                    </div>
                </div>

                <!-- Table Section -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card"> 
                            <div class="card-body">
                                <div class="pb-3">
                                    <h5 class="modal-title text-themecolor">Blogs Listing</h5>
                                </div>   <div class="align-self-center text-end pe-3"> 
                        <a href="blog_add.php"  class="btn btn-info text-white"><i class="pe-1 fa fa-plus-circle"></i> Add Blog</a> 
                    </div>
                                                 <?php 
if(isset($_GET['id']))
{
$id=$_GET['id'];

$sql="DELETE FROM blog  WHERE bl_id='$id'";
$run = mysqli_query($connect, $sql);

 if ($run) {	  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Deleted Successfully</p>
    <p>
     
     <?php echo "<script>setTimeout(\"location.href = 'blog.php';\",1500);</script>"; ?>
    </p>
  </div>
</div>
<?php  }  
      else{
        ?>

   <div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Error 
    </h1>
    <p>Failed Successfully</p>
    <p>
      <a href="blog.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>  
<?php }
	
}

?>    <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                        <thead class="text-center table-bg-info">
                                            <tr>
                                                 <th>S.No</th>
                                                <th>Blog Title</th>
                                                <th>Blog Front Content</th>  
                                                <th>Blog Image</th>  
                                                <th>Date</th>  
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                       <tbody>
										                                        <?php $i=1;
										$sql = "SELECT * FROM blog ORDER BY bl_id DESC";
$result = $connect->query($sql);
foreach ($result as $row) {
    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $i; ?></td>
                                            <td><?php  echo $row['bl_heading'] ?></td>
                                            <td><?php  echo $row['bl_frontcontent']; ?></td>
                                            <td><img src="images/<?php  echo $row['bl_image']; ?>" alt="img" class="img-fluid list-img"></td>
                                            <td><?php  echo $row['bl_datetime']; ?></td>
                                            <td><?php  echo $row['bl_status']; ?></td>
                                            <td style="white-space: nowrap;">
                                                <a href="blog_edit.php?id=<?php echo $row['bl_id']?>"><button type="button" class="btn btn-xs btn-primary" ><i class="fas fa-pencil-alt"></i></button></a>
                                                <a href="blog.php?id=<?php echo $row['bl_id']?>" ><button type="button" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fa fa-trash"></i></button></a>
                                           
                                                
                                                </td>
                                        </tr>
                                       <?php $i++;   
}
?>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/assets/node_modules/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="vendor/assets/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "ordering": true,
                "autoWidth": false,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                "order": [[0, 'asc']],
                "language": {
                    "search": "Filter records:",
                    "lengthMenu": "Display _MENU_ records per page"
                }
            });
        });
    </script>
</body>

</html>
