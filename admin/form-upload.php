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

$data = [
    "request_type" => "MEMBER",
    "device_id" => "string",
    "device_type" => "ANDROID",
    "device_token" => "string",
];

// $maxFileSize = 30 * 1024 * 1024; 
$profmaxFileSize = 500 * 1024;
$covemaxFileSize = 500 * 1024;
$insmaxFileSize = 200 * 1024;
$facemaxFileSize = 200 * 1024;
$youmaxFileSize = 200 * 1024;



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

function fileuploadfapiCallFunction($filePath, $bearer_token) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    $fileData = new CURLFile($filePath['tmp_name'], $filePath['type'], $filePath['name']); 
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
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $decodedResponse = json_decode($response, true);

    if (is_array($decodedResponse) && isset($decodedResponse[0])) {
        $responseData = $decodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}


function coveruploadfapiCallFunction($coverfilePath, $bearer_token) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    $fileData = new CURLFile($coverfilePath['tmp_name'], $coverfilePath['type'], $coverfilePath['name']); 
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
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $coverresponse = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $coverdecodedResponse = json_decode($coverresponse, true);

    if (is_array($coverdecodedResponse) && isset($coverdecodedResponse[0])) {
        $responseData = $coverdecodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        // error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}

function instauploadfapiCallFunction($instafilePath, $bearer_token) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    $fileData = new CURLFile($instafilePath['tmp_name'], $instafilePath['type'], $instafilePath['name']); 
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
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $instaresponse = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $instadecodedResponse = json_decode($instaresponse, true);

    if (is_array($instadecodedResponse) && isset($instadecodedResponse[0])) {
        $responseData = $instadecodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        // error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}


function faceuploadfapiCallFunction($facefilePath, $bearer_token) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    $fileData = new CURLFile($facefilePath['tmp_name'], $facefilePath['type'], $facefilePath['name']); 
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
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $faceresponse = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $facedecodedResponse = json_decode($faceresponse, true);

    if (is_array($facedecodedResponse) && isset($facedecodedResponse[0])) {
        $responseData = $facedecodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        // error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}


function youuploadfapiCallFunction($youfilePath, $bearer_token) {
    $apiUrl = 'https://dev.letsfame.com/api/v1.0/files';

    $fileData = new CURLFile($youfilePath['tmp_name'], $youfilePath['type'], $youfilePath['name']); 
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
        'Authorization: Bearer ' . $bearer_token,  
    ]);

    $youresponse = curl_exec($ch);

    if (curl_errno($ch)) {
        error_log('cURL Error: ' . curl_error($ch));
        curl_close($ch);
        return ['error' => 'API call failed: ' . curl_error($ch)];
    }

    curl_close($ch);

    $youdecodedResponse = json_decode($youresponse, true);

    if (is_array($youdecodedResponse) && isset($youdecodedResponse[0])) {
        $responseData = $youdecodedResponse[0];

        return [
            'file_name' => $responseData['file_name'] ?? 'Unknown File',
            'original_file_name' => $responseData['original_file_name'] ?? 'Unknown',
            'url' => $responseData['url'] ?? '',
            'moderation_required' => $responseData['moderation_required'] ?? false,
            'nsfw_predictions' => $responseData['nsfw_predictions'] ?? null,
            'type' => $responseData['type'] ?? 'Unknown',
        ];
    } else {
        // error_log('File upload failed or response format is not correct. Raw Response: ' . $response);
        return ['error' => 'File upload failed or response format is not correct'];
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_img'])) {
    // Get the token
    $token = apiBaseUrlFunction([
        'request_type' => 'MEMBER',
        'device_id' => 'string',
        'device_type' => 'ANDROID',
        'device_token' => 'string',
    ]);
 
    // Get the uploaded file
    $filePath = $_FILES['profile_img']; 
    $coverfilePath = $_FILES['banner_img']; 
    $instafilePath = $_FILES['insimg']; 
    $facefilePath = $_FILES['faceimg']; 
    $youfilePath = $_FILES['youimg']; 
    
    if ($_FILES['profile_img']['size'] > $profmaxFileSize) {
        // echo json_encode([
        //     'success' => false,
        //     'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        // ]);
        echo"<script>alert('The uploaded file exceeds the maximum allowed size of 500kb.');</script>";

        exit;
    }
     if ($_FILES['banner_img']['size'] > $covemaxFileSize) {
        // echo json_encode([
        //     'success' => false,
        //     'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        // ]);
       echo"<script>alert('The uploaded file exceeds the maximum allowed size of 500kb.');</script>";
        exit;
    }
     if ($_FILES['insimg']['size'] > $insmaxFileSize) {
        // echo json_encode([
        //     'success' => false,
        //     'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        // ]);
        echo"<script>alert('The uploaded file exceeds the maximum allowed size of 200kb.');</script>";

        exit;
    }
     if ($_FILES['faceimg']['size'] > $facemaxFileSize) {
        // echo json_encode([
        //     'success' => false,
        //     'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        // ]);
        echo"<script>alert('The uploaded file exceeds the maximum allowed size of 200kb.');</script>";

        exit;
    }
     if ($_FILES['youimg']['size'] > $youmaxFileSize) {
        // echo json_encode([
        //     'success' => false,
        //     'error_message' => 'The uploaded file exceeds the maximum allowed size of 30MB.'
        // ]);
        echo"<script>alert('The uploaded file exceeds the maximum allowed size of 200kb.');</script>";

        exit;
    }
    

    $response = fileuploadfapiCallFunction($filePath, $token);
    $coverresponse = coveruploadfapiCallFunction($coverfilePath, $token);
    $instaresponse = instauploadfapiCallFunction($instafilePath, $token);
    $faceresponse = faceuploadfapiCallFunction($facefilePath, $token);
    $youresponse = youuploadfapiCallFunction($youfilePath, $token);
    if (isset($response['url'])) {

		$url = $response['url'];
		$coverurl = $coverresponse['url'];
		$instaurl = $instaresponse['url'];
		$faceurlimg = $faceresponse['url'];
		$youurlimg = $youresponse['url'];
		$fullname = htmlentities(($_POST['fullname']),ENT_QUOTES);

		 $profession = htmlentities(($_POST['profession']),ENT_QUOTES);
		 $country_name = htmlentities(($_POST['country_name']),ENT_QUOTES);
		 $state_id = htmlentities(($_POST['state_id']),ENT_QUOTES);
		 $city_id = htmlentities(($_POST['city_id']),ENT_QUOTES);					

		 $content = htmlentities(($_POST['content']),ENT_QUOTES);
		 $insname = htmlentities(($_POST['insname']),ENT_QUOTES);
		 $insurl = htmlentities(($_POST['insurl']),ENT_QUOTES);
		 $inscnt = htmlentities(($_POST['inscnt']),ENT_QUOTES);
		 $facename = htmlentities(($_POST['facename']),ENT_QUOTES);
		 $faceurl = htmlentities(($_POST['faceurl']),ENT_QUOTES);
		 $facecnt = htmlentities(($_POST['facecnt']),ENT_QUOTES);
		 $youname = htmlentities(($_POST['youname']),ENT_QUOTES);
		 $youurl = htmlentities(($_POST['youurl']),ENT_QUOTES);
		 $youcnt = htmlentities(($_POST['youcnt']),ENT_QUOTES);
		 $status = htmlentities(($_POST['status']),ENT_QUOTES);

$sql=$connect->query("INSERT INTO book_artist (name,profession,country,state,city,profile,banner,about,status,insname,insurl,inscnt,facename,faceurl,facecnt,youname,youurl,youcnt,insimg,faceimg,youimg) 
	VALUES ('$fullname', '$profession', '$country_name', '$state_id', '$city_id', '$url', '$coverurl', '$content', '$status', '$insname', '$insurl', '$inscnt', '$facename', '$faceurl', '$facecnt', '$youname', '$youurl', '$youcnt', '$instaurl', '$faceurlimg', '$youurlimg')");

  $last_inserted_id = $connect->insert_id;

	
	 $sql1=$connect->query("UPDATE book_artist_img SET bookid='$last_inserted_id' WHERE bookid='0'");	
	 $sql2=$connect->query("UPDATE book_artist_video SET bookid='$last_inserted_id' WHERE bookid='0'");	
  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      Success 
    </h1>
    <p>Inserted Successfully</p>
    <p>
     
     <?php echo "<script>setTimeout(\"location.href = 'artist.php';\",1500);</script>"; ?>
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
 <?php echo "<script>setTimeout(\"location.href = 'artist.php';\",1500);</script>"; ?>    </p>
  </div>
</div>  
<?php }
	
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