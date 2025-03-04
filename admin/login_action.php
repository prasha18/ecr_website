<?php 
session_start();

include("../includes/connect.php");

$log_succ = "";

$log_err = "";

$_SESSION['login_time'] =""; 

if(isset($_POST['login']))

{

	$user_name =  $_POST['username'];

	$user_pass = $_POST['password'];

	$ip_address = $_SERVER['REMOTE_ADDR'];

	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));

	$log_date = $date->format('Y-m-d H:i:s');

	$dbsel_q1 = mysqli_query($connect,"select * from users where email='$user_name' and pass='$user_pass' and status='1'") or die("select query not working");

	$userlog_cnt = mysqli_num_rows($dbsel_q1);

	if($userlog_cnt>0)

	{

		$sel_res1 = mysqli_fetch_array($dbsel_q1);

		$user_id = $sel_res1['id'];

		$_SESSION['user_log_id'] = $user_id;

		$_SESSION['user_log_email'] = $sel_res1['email'];
		$_SESSION['user_type'] = $sel_res1['user_type'];
		$_SESSION['name'] = $sel_res1['name'];



		$_SESSION['login_time'] = time();
		$log_update = mysqli_query($connect,"update users set log_status='1',login_ip='$ip_address',last_login='$log_date' where id='$user_id'") or die("login date and time update not working!");

		if($log_update)

		{
			if($_SESSION['user_type'] == '1' || $_SESSION['user_type'] == '2'){
				header("Location:blog.php");exit;
			}
if($_SESSION['user_type'] == '3'){ 
					header("Location:contact-us.php");exit;

}
			

			//var_dump($sel_res1);

		}

		else

		{

			header("Location:index.php?log_err=1"); exit;

		}

		

	}

	else

	{

		//$log_err =  "<p style='color:#ff0000'> Invalid user name and password </p> ";

		header("Location:index.php?log_err=1"); exit;

	}

}



if(!empty($_REQUEST['userlog_out']))

{

	$user_id = $_SESSION['user_log_id'];

	$log_update = mysqli_query($connect,"update users set log_status='0' where id='$user_id'") or die("session timeout logout update date and time update not working!");

	if($log_update)

	{

		unset($_SESSION['user_log_id']);

		unset($_SESSION['user_log_email']);

		session_destroy();

		header("Location:index.php");exit;

	}



}



function val_encryt($string) {

    // you may change these values to your own

    $secret_key = 'AnandTechverce';

    $secret_iv = 'my_simple_secret_iv';



    $output = false;

    $encrypt_method = "AES-256-CBC";

    $key = hash( 'sha256', $secret_key );

    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

   

    $output = base64_encode(openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );

    

    return $output;

}



function val_decrypt($string) {

	// you may change these values to your own

	$secret_key = 'AnandTechverce';

	$secret_iv = 'my_simple_secret_iv';



	$output = false;

	$encrypt_method = "AES-256-CBC";

	$key = hash( 'sha256', $secret_key );

	$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	$output = openssl_decrypt( base64_decode($string), $encrypt_method, $key, 0, $iv );



	return $output;

}



function user_log_vals()

{

	if(!isset($_SESSION['user_log_id']))

	{

		header("Location:index.php");

	}

}

function active_status($status)

{

	if($status==1)

	{

		return "Active";

	}

	else if($status==0)

	{

		return "<span style='color:yellow'>Inactive</span>";

	}

	else if($status ==2)

	{

		return "<span style='color:red'>Deleted</span>";

	}

	else

	{

		return "None";

	}

}




if(!empty($_GET['blog_id']))

{

	$blog_id = $_GET['blog_id'];

	$process = $_GET['process'];

	if($process =="delete")

	{

		$dbupd_q1 = mysqli_query($connect,"update blogs set status='2' where id='$blog_id'") or die("mysql delete query not working");

		if($dbupd_q1)

		{

			echo "<span style='color:red'> Your blog deleted successfully!</span>";

		}

		else

		{

			echo "<span style='color:red'> We can not able to delete your record! </span>";

		}

	}

	else if($process =="status_update")

	{

		if($_GET['status_msg']==1)

		{

			$dbupd_q1 = mysqli_query($connect,"update blogs set status='0' where id='$blog_id'") or die("mysql delete query not working");

			if($dbupd_q1)

			{

				echo "<span style='color:orange'> Your blog has been Inactivated! </span>";

			}

			else

			{

				echo "<span style='color:red'> We can not able to activate your record! </span>";

			}

		}

		if($_GET['status_msg']==0)

		{

			$dbupd_q1 = mysqli_query($connect,"update blogs set status='1' where id='$blog_id'") or die("mysql delete query not working");

			if($dbupd_q1)

			{

				echo "<span style='color:green'> Your blog activated successfully! </span>";

			}

			else

			{

				echo "<span style='color:red'> We can not able to activate your record! </span>";

			}

		}

	}

	

}

if(!empty($_GET['comm_ids']))
{

	$comm_ids = $_GET['comm_ids'];

	$process1 = $_GET['process1'];

	if($process1 =="delete1")

	{
		$dbupd_q1 = mysqli_query($connect,"delete from comments where id='$comm_ids'") or die("mysql delete query not working");

		if($dbupd_q1)

		{

			echo "<span style='color:red'> Your record deleted successfully!</span>";

		}

		else

		{

			echo "<span style='color:red'> We can not able to delete your record! </span>";

		}

	}

	else if($process1 =="status_update_com")

	{

		if($_GET['acts']==1)

		{

			$dbupd_q1 = mysqli_query($connect,"update comments set isactive='0' where id='$comm_ids'") or die("mysql delete query not working");

			if($dbupd_q1)

			{

				echo "<span style='color:orange'> Your Comments has been Inactivated! </span>";

			}

			else

			{

				echo "<span style='color:red'> We can not able to activate your record! </span>";

			}

		}

		if($_GET['acts']==0)

		{

			$dbupd_q1 = mysqli_query($connect,"update comments set isactive='1' where id='$comm_ids'") or die("mysql delete query not working");

			if($dbupd_q1)

			{ 

				echo "<span style='color:green'> Your Comments activated successfully! </span>";

			}

			else

			{

				echo "<span style='color:red'> We can not able to activate your record! </span>";

			}

		}

	}
   
}

 $inactive = 60 * 60; // 1 hour = 3600 seconds

// Check if the session has timed out
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];

    if ($session_life > $inactive) {
        // If the session has timed out, destroy it
        session_unset();     // Unset session data
        session_destroy();   // Destroy the session
        header("Location: logout.php"); // Redirect to a logout or login page
        exit();
    }
}

// Update the timeout time for every activity
$_SESSION['timeout'] = time();

// inactive in seconds

// $inactive = 10*60;
// $inactive = 60 * 60;

// if( !isset($_SESSION['timeout']) )

// $_SESSION['timeout'] = time() + $inactive; 

// $session_life = time() - $_SESSION['timeout'];

// if($session_life > $inactive)

// {  

// 	$user_id = $_SESSION['user_log_id'];

// 	$log_update = mysqli_query($db,"update users set log_status='0' where id='$user_id'") or die("session timeout logout update date and time update not working!");

// 	if($log_update)

// 	{

// 		unset($_SESSION['user_log_id']);

// 		unset($_SESSION['user_log_email']);

// 		session_destroy();

// 		header("Location:admin/login.php?ses_exp=1");

// 	}

	    

// }



// $_SESSION['timeout']=time();



?>