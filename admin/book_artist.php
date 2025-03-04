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
    <title>LetsFAME</title>

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
		
		.card .card-title {
    position: relative;
    font-weight: 600 !important;
    font-size: 14px;
}    .modal-dialog {
        max-width: 38% !important;
        /* margin: 1.75rem auto; */
    }
    .card-text{
        font-size: 14px;
    line-height: 24px;
    }
    .bg-primary {
    background-color: #D49A5B !important;
}
.modal-content {
   
    width: 125%  !important;
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
                                <span class="text-themecolor">Booked Artist</span>
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
                                    <h4 class="modal-title text-themecolor">Booked Artist Listing</h4>
                                </div>   <div class="align-self-center text-end pe-3"> 
                    </div>
                                                 <?php 
if(isset($_GET['id']))
{
$id=$_GET['id'];

$sql="DELETE FROM form_data WHERE id='$id'";
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
     
     <?php echo "<script>setTimeout(\"location.href = 'company.php';\",1500);</script>"; ?>
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
      <a href="company.php"><button class="button button--error" data-for="js_error-popup">Close</button></a>
    </p>
  </div>
</div>  
<?php }
	
}

?>  
							<div class="table-responsive">
    <table id="example" class="display" style="width:100%">
        <thead class="text-center table-bg-info">
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $sql = "SELECT form_data.*, book_artist.id as bookid, book_artist.name as bookname, book_artist.profession, book_artist.status  
                    FROM form_data  
                    JOIN `book_artist` ON (book_artist.id = form_data.actor_id) 
                    GROUP BY form_data.actor_id  
                    ORDER BY form_data.id DESC";
            $result = $connect->query($sql);

            foreach ($result as $row) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td><?php echo $row['bookname']; ?></td>
                    <td><?php echo $row['profession']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td style="white-space: nowrap;">
                        <!-- Modal Trigger -->
                        <button type="button" class="btn btn-xs btn-info text-white" 
                                data-toggle="modal" 
                                data-target="#exampleModal<?php echo $row['id']; ?>">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>

                        <a href="company.php?id=<?php echo $row['id']; ?>">
                            <button type="button" class="btn btn-xs btn-danger" 
                                    onclick="return confirm('Are you sure to delete this record?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content shadow-lg rounded">
                            <div class="modal-header bg-primary text-white">
                                <h3 class="modal-title" id="exampleModalLabel">User Details</h3>
                                <button type="button" class="btn-close text-white" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body bg-light">
                                <div class="row g-3">
                                    <?php
                                    $ids = $row['actor_id'];
                                    $sql2 = "SELECT * FROM form_data WHERE actor_id = '$ids'";
                                    $result2 = $connect->query($sql2);

                                    foreach ($result2 as $row2) {
                                        if ($row2['type'] == "Company") {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="card border-primary shadow-sm">
                                                    <div class="card-body">
                                                        <h5 class="card-title" style="color: #D49A5B !important;">User Type: <?php echo $row2['type']; ?> </h5>
                                                        <p class="card-text">
                                                            <strong>Name:</strong> <?php echo $row2['name']; ?><br>
                                                            <strong>Phone:</strong> <?php echo $row2['companyName']; ?><br>
                                                            <strong>Email:</strong> <?php echo $row2['email']; ?><br>
                                                            <strong>Designation:</strong> <?php echo $row2['designation']; ?><br>
                                                            <strong>LinkedIn:</strong> <a href="<?php echo $row2['linkedInUrl']; ?>" target="_blank"><?php echo $row2['linkedInUrl']; ?></a><br>
                                                            <strong>Letsfame:</strong> <a href="<?php echo $row2['letsfameUrl']; ?>" target="_blank"><?php echo $row2['letsfameUrl']; ?></a><br>
                                                            <strong>Reason:</strong> <?php echo $row2['reason']; ?><br>
                                                            <strong>Date & Time:</strong> <?php echo $row2['created_at']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } elseif ($row2['type'] == "Individual") {
                                            ?>
                                            <div class="col-md-6">
                                                <div class="card border-success shadow-sm">
                                                    <div class="card-body">
                                                        <h5 class="card-title" style="color: #D49A5B !important;">User Type: <?php echo $row2['type']; ?></h5>
                                                        <p class="card-text">
                                                            <strong>Name:</strong> <?php echo $row2['name']; ?><br>
                                                            <strong>Phone:</strong> <?php echo $row2['companyName']; ?><br>
                                                            <strong>Email:</strong> <?php echo $row2['email']; ?><br>
                                                            <strong>Letsfame:</strong> <a href="<?php echo $row2['letsfameUrl']; ?>" target="_blank"><?php echo $row2['letsfameUrl']; ?></a><br>
                                                            <strong>Reason:</strong> <?php echo $row2['reason']; ?><br>
                                                            <strong>Date & Time:</strong> <?php echo $row2['created_at']; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
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

     <script src="resources/assets/js/bootstrap.min.js"></script>
    <script src="resources/assets/js/jquery.min.js"></script> 
    <script src="resources/assets/js/activeclass.js"></script>


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
