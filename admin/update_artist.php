 <link href="vendor/dist/css/pages/login-register-lock.css" rel="stylesheet">
    <link href="vendor/dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/dist/css/sub-style.css" rel="stylesheet">
    <link href="vendor/assets/icons/font-awesome/css/all.min.css" rel="stylesheet"> 
	 <link rel="stylesheet" href="vendor/popup_style.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	
	 <link href="vendor/assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="vendor/assets/node_modules/select2/dist/js/select2.min.js"></script> 
<?php
session_start();
include("../includes/connect.php");
ini_set("display_errors", 1);
error_reporting(E_ALL);

// API Token Function
function apiBaseUrlFunction($data) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/members/guest/token';
    $username = 'LetsFamez91';
    $password = '4h1r198a14s217i18t81';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch);
        curl_close($ch);
        exit;
    }

    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['bearer_token'])) {
        return $responseData['bearer_token'];
    } else {
        echo 'Failed to authenticate. Response: ' . $response;
        exit;
    }
}

// File Upload Function
function fileUploadApiCall($file, $token) {
    if (empty($file['tmp_name'])) {
        return null; // Return null if no file is uploaded
    }

    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';
    $fileData = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
    $postData = [
        'file' => $fileData,
        'moderation_required' => true,
        'type' => 'IMAGE',
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: multipart/form-data',
        'Authorization: Bearer ' . $token,
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return null; // Return null on failure
    }

    curl_close($ch);
    $decodedResponse = json_decode($response, true);

    return $decodedResponse[0]['url'] ?? null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get API Token
     $token = apiBaseUrlFunction([
        'request_type' => 'MEMBER',
        'device_id' => 'string',
        'device_type' => 'ANDROID',
        'device_token' => 'string',
    ]);
  if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === UPLOAD_ERR_OK) {
        $profileUrl = fileUploadApiCall($_FILES['profile_img'], $token);
    } else {
        $profileUrl = isset($_POST['edtprofile']) ? $_POST['edtprofile'] : '';
    }
if (isset($_FILES['banner_img']) && $_FILES['banner_img']['error'] === UPLOAD_ERR_OK) {
		$bannerUrl = fileUploadApiCall($_FILES['banner_img'], $token);
    } else {
        $bannerUrl = isset($_POST['edtbanner']) ? $_POST['edtbanner'] : '';
    }
	if (isset($_FILES['insimg']) && $_FILES['insimg']['error'] === UPLOAD_ERR_OK) {
		$instaUrl = fileUploadApiCall($_FILES['insimg'], $token);
    } else {
        $instaUrl = isset($_POST['edtinsimg']) ? $_POST['edtinsimg'] : '';
    }
	if (isset($_FILES['faceimg']) && $_FILES['faceimg']['error'] === UPLOAD_ERR_OK) {
		$facebookUrl = fileUploadApiCall($_FILES['faceimg'], $token);
    } else {
        $facebookUrl = isset($_POST['edtfaceimg']) ? $_POST['edtfaceimg'] : '';
    }
	if (isset($_FILES['youimg']) && $_FILES['youimg']['error'] === UPLOAD_ERR_OK) {
		$youtubeUrl = fileUploadApiCall($_FILES['youimg'], $token);
    } else {
        $youtubeUrl = isset($_POST['edtyouimg']) ? $_POST['edtyouimg'] : '';
    }

	$fullname = htmlentities(($_POST['fullname']),ENT_QUOTES);

		 $profession = htmlentities(($_POST['profession']),ENT_QUOTES);
		 $country_name = htmlentities(($_POST['country_name']),ENT_QUOTES);
		 $state_id = htmlentities(($_POST['state_id']),ENT_QUOTES);
		 $city_id = htmlentities(($_POST['city_id']),ENT_QUOTES);				

		 $content = htmlentities(($_POST['content']),ENT_QUOTES);
		 
		 
		 if($_POST['insname'] == ""){
		 $insname = htmlentities(($_POST['fullname']),ENT_QUOTES);
		 }else {
		  $insname = htmlentities(($_POST['insname']),ENT_QUOTES);
		 }
		 if($_POST['facename'] == ""){
		 $facename = htmlentities(($_POST['fullname']),ENT_QUOTES);
		 }else {
		 $facename = htmlentities(($_POST['facename']),ENT_QUOTES);
		 }
		 if($_POST['youname'] == ""){
		 $youname = htmlentities(($_POST['fullname']),ENT_QUOTES);
		 }else {
		 $youname = htmlentities(($_POST['youname']),ENT_QUOTES);
		 }
		 
		 
		 
		 
		 $insurl = "0";
		 $inscnt = htmlentities(($_POST['inscnt']),ENT_QUOTES);
		 $faceurl = "0";
		 $facecnt = htmlentities(($_POST['facecnt']),ENT_QUOTES);
		 $youurl = "0";
		 $youcnt = htmlentities(($_POST['youcnt']),ENT_QUOTES);
		 $status = htmlentities(($_POST['status']),ENT_QUOTES);


if(isset($_POST['id'])){
   $ids = htmlentities(($_POST['id']),ENT_QUOTES);
   $sql = $connect->query("
    UPDATE book_artist 
    SET 
        name = '$fullname',
        profession = '$profession',
        country = '$country_name',
        state = '$state_id',
        city = '$city_id',
        profile = '$profileUrl',
        banner = '$bannerUrl',
        about = '$content',
        status = '$status',
        insname = '$insname',
        insurl = '$insurl',
        inscnt = '$inscnt',
        facename = '$facename',
        faceurl = '$faceurl',
        facecnt = '$facecnt',
        youname = '$youname',
        youurl = '$youurl',
        youcnt = '$youcnt',
        insimg = '$instaUrl',
        faceimg = '$facebookUrl',
        youimg = '$youtubeUrl'
    WHERE id = '$ids'
"); 
}
else {	
	 $sql = $connect->query("
    INSERT INTO book_artist 
    (
        name,
        profession,
        country,
        state,
        city,
        profile,
        banner,
        about,
        status,
        insname,
        insurl,
        inscnt,
        facename,
        faceurl,
        facecnt,
        youname,
        youurl,
        youcnt,
        insimg,
        faceimg,
        youimg
    ) 
    VALUES 
    (
        '$fullname',
        '$profession',
        '$country_name',
        '$state_id',
        '$city_id',
        '$profileUrl',
        '$bannerUrl',
        '$content',
        '$status',
        '$insname',
        '$insurl',
        '$inscnt',
        '$facename',
        '$faceurl',
        '$facecnt',
        '$youname',
        '$youurl',
        '$youcnt',
        '$instaUrl',
        '$facebookUrl',
        '$youtubeUrl'
    )
");
$ids = $connect->insert_id;
}

 $sql1=$connect->query("UPDATE book_artist_img SET bookid='$ids' WHERE bookid='0'");	
	 $sql2=$connect->query("UPDATE book_artist_video SET bookid='$ids' WHERE bookid='0'");


    if ($sql) {
        echo "
        <div class='popup popup--icon -success js_success-popup popup--visible'>
            <div class='popup__background'></div>
            <div class='popup__content'>
                <h3 class='popup__content__title'>Success</h3>
                <p>Updated Successfully</p>
                <script >location.href = 'artist.php';</script>
            </div>
        </div>";
    } else {
        echo "
        <div class='popup popup--icon -error js_error-popup popup--visible'>
            <div class='popup__background'></div>
            <div class='popup__content'>
                <h3 class='popup__content__title'>Error</h3>
                <p>Update Failed</p>
                <script >location.href = 'artist.php';</script>
            </div>
        </div>";
    }
}
?>


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