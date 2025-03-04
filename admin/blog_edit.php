<?php
include("login_action.php");
user_log_vals();

	$id=$_GET['id'];

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
    <title>LetsFAME Blog</title>
    <!-- This page CSS -->
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <link href="vendor/assets/node_modules/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet">
	 <link rel="stylesheet" href="vendor/popup_style.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
    /* Import Montserrat font from Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    /* Set the font family for Summernote */
    .note-editable {
        font-family: 'Montserrat', sans-serif; /* Use Montserrat font family */
    }
</style>
</head>

<body class="skin-megna fixed-layout">   
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
		<?php include 'header.php';?>  
        <!-- End Topbar header --> 

        <!-- Left Sidebar - style you can find in sidebar.scss  --> 
        <?php include 'side_menu.php';?> 
        <!-- End Left Sidebar - style you can find in sidebar.scss  --> 
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
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
                                <span class="text-themecolor">Blog</span>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-7 align-self-center text-end pe-3"> 
                        <a href="blog.php" class="btn btn-info text-white"><i class="fa fa-undo" aria-hidden="true"></i>  Back</a> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                       
                        <div class="card"> 
                            <div class="card-body">
                                <div class="pb-3">
                                </div>  
                               
									
  
        <h4 class="modal-title text-themecolor"> Edit Blog</h4>
    </div>
	<div class="modal-body pt-0">
		<form method="post"  enctype="multipart/form-data">  
           <div class="row card pt-0">
            <div class="col-lg-12 card-body pt-0">

	<?php
if(isset($_POST['update'])) 
{
		 $bltitle = htmlentities(($_POST['bltitle']),ENT_QUOTES);
		 		 $blurl = htmlentities(($_POST['blurl']),ENT_QUOTES);

		 $category = htmlentities(($_POST['category']),ENT_QUOTES);
		 $scucategory = htmlentities(($_POST['scucategory']),ENT_QUOTES);
		 $datetimes = $_POST['datetimes'];
		 $frontcontent = htmlentities(($_POST['frontcontent']),ENT_QUOTES);
		 $editarea = htmlentities(($_POST['editarea']),ENT_QUOTES);
		 $edtstatus = $_POST['edtstatus'];
		 
		 $metatag = htmlentities(($_POST['metatag']),ENT_QUOTES);
		 $metadesc = htmlentities(($_POST['metadesc']),ENT_QUOTES);
		 $metakeyowrd = htmlentities(($_POST['metakeyowrd']),ENT_QUOTES);
		 $metaurl = htmlentities(($_POST['metaurl']),ENT_QUOTES);
		 
		 
		 
				$clean_string =  str_replace(' ', '-', strtolower($blurl));

		 
if(!empty($_FILES["picture"]["name"])){
$filename = $_FILES["picture"]["name"];
    $tempname = $_FILES["picture"]["tmp_name"];  
        $folder = "images/".$filename;
move_uploaded_file($tempname, $folder);
}else{
		 $filename = $_POST['edtimg1'];
}



 $sql=$connect->query("UPDATE blog SET bl_heading='$bltitle',bl_cate='$category',bl_subcate='$scucategory',bl_blogdate='$datetimes',bl_frontcontent='$frontcontent',bl_description='$editarea',bl_status='$edtstatus',bl_image='$filename',bl_url='$clean_string',metatag='$metatag',metadesc='$metadesc',metakeyowrd='$metakeyowrd',metaurl='$metaurl' WHERE bl_id='$id'");


 if ($sql) {	  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Updated Successfully</p>
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

?>

			
<?php 

$sql = "SELECT * FROM blog where bl_id=$id";

$result = $connect->query($sql);
foreach ($result as $geteditbloglist) {
    ?>
                <div class="row">
                    <div class="col-md-12 pt-3">
								<h4 class="card-title">Blog Content  <span style="color:red;">*</span></h4>  
									<textarea id="summernote" name="editarea" required><?php echo $geteditbloglist['bl_description'];  ?></textarea>
							</div> 				
                    <div class="col-md-6 pt-3">
                        <h4 class="card-title">Blog Title   <span style="color:red;">*</span></h4>
                        <input type="text" name="bltitle" value="<?php echo $geteditbloglist['bl_heading'];  ?>" class="form-control" required>
                    </div>
							 <div class="col-md-4 pt-3">
								<h4 class="card-title">Image  <span style="color:red;">*</span></h4> 
								<input type="file" name="picture" class="form-control" >
								<input type="hidden" name="edtimg1" value="<?php echo $geteditbloglist['bl_image'];  ?>" class="form-control" >							  
								
							</div> 
							<div class="col-md-2 pt-3">
								<img src="images/<?php echo $geteditbloglist['bl_image'];  ?>" alt="img" class="img-fluid list-img">
							</div> 
							<div class="col-md-6 pt-3">
                                    <h4 class="card-title">First Name  <span style="color:red;">*</span></h4>
                                    <input type="text" name="category" value="<?php echo $geteditbloglist['bl_cate'];  ?>" class="form-control" required>   
                                </div>                                
                                <div class="col-md-6 pt-3">
                                    <h4 class="card-title">Profession  <span style="color:red;">*</span></h4>
                                    <input type="text" name="scucategory" value="<?php echo $geteditbloglist['bl_subcate'];  ?>" class="form-control" required>   
                                </div>
                                <div class="col-md-6 pt-3">
                                    <h4 class="card-title">Url  <span style="color:red;">*</span></h4>
                                    <input type="text" name="blurl"  value="<?php echo $geteditbloglist['bl_url'];  ?>" class="form-control" required>   
                                </div>
                                <div class="col-md-6 pt-3">
                                    <h4 class="card-title">Date  <span style="color:red;">*</span></h4>
                                    <input type="date" name="datetimes" value="<?php echo $geteditbloglist['bl_blogdate'];  ?>" class="form-control" required>   
                                </div>      
							<div class="col-md-12 pt-3">
								<h4 class="card-title">Blog Front Content  <span style="color:red;">*</span></h4>
											<input type="text" name="frontcontent" value="<?php echo $geteditbloglist['bl_frontcontent'];  ?>" class="form-control" required>   

							</div>				
							
							
						<div class="col-md-6 pt-3">
                                    <h4 class="card-title">Meta Tag Title  <span style="color:red;">*</span></h4> 
                                    <input type="text" name="metatag" placeholder="Meta Tag Title" value="<?php echo $geteditbloglist['metatag'];  ?>"  class="form-control" required>
                                </div>
									<div class="col-md-6 pt-3">
                                    <h4 class="card-title">Meta Tag Description  <span style="color:red;">*</span></h4> 
                                    <input type="text" name="metadesc" placeholder="Meta Tag Description" value="<?php echo $geteditbloglist['metadesc'];  ?>"  class="form-control" required>
                                </div> 
								<div class="col-md-6 pt-3">
                                    <h4 class="card-title">Meta Tag Keywords  <span style="color:red;">*</span></h4> 
                                    <input type="text" name="metakeyowrd" placeholder="Meta Tag Keywords" value="<?php echo $geteditbloglist['metakeyowrd'];  ?>"   class="form-control" required>
                                </div>
									<div class="col-md-6 pt-3">
                                    <h4 class="card-title">Canonical URL  <span style="color:red;">*</span></h4> 
                                    <input type="text" name="metaurl" placeholder="Canonical URL" value="<?php echo $geteditbloglist['metaurl'];  ?>"  class="form-control" required>
                                </div> 
                    <div class="col-md-6 pt-3">
                        <h4 class="card-title">Status  <span style="color:red;">*</span></h4> 
                        <select class="form-select" name="edtstatus" required>
						<option selected disabled>select Status</option>				
					        <option value="Active" <?php if($geteditbloglist['bl_status']=="Active"){echo "selected";} ?>>Active</option> 
                            <option value="In Active" <?php if($geteditbloglist['bl_status']=="In Active"){echo "selected";} ?>>In Active</option>  
                        </select> 
                    </div>
				
                    <div class="col-md-6 pt-5 text-end"> 
                        <button class="btn btn-info text-white px-4" name="update" type="submit"><i class="pe-1 fa fa-save"></i> Update </button> 
                    </div>
                </div>           
<?php } ?>
            </div>
        </div>
    </form>
</div>

</div>
</div>
									
</div> 

										
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div> 

<!-- //Add BlogThe Modal -->


<!-- //Edit BlogThe Modal -->
</div> 

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
<script src="vendor/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="vendor/assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="vendor/dist/js/custom.min.js"></script>
<script src="vendor/assets/node_modules/datatables/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
<!-- Date Picker Plugin JavaScript -->
<script src="vendor/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
    // Date Picker
    jQuery('.mydatepicker').datepicker();
</script>
<!-- wysuhtml5 Plugin JavaScript -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
<script src="vendor/script.js"></script>
<link href="vendor/style.js" rel="stylesheet">


<script>
$(document).ready(function() {
   $('#summernote').summernote({
      height: 300, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
      focus: true // set focus to editable area after initializing summernote
   });
});
</script>
</body>

</html>

								<?php 
// 								} 
// else {
//   echo '<script>window.location.href="login.php"</script>';	
// }
?>