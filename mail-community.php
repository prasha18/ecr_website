<?php
include("includes/connect.php");

$recaptchaResponse = $_POST['g-recaptcha-response'];

    $secretKey = '6LfX6GMqAAAAADJmmBEk9jmtLgjuE1kCn6Thn310';

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseData = json_decode($response, true);

    if ($responseData && $responseData['success']) {
	$res = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfX6GMqAAAAADJmmBEk9jmtLgjuE1kCn6Thn310&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']));



$emails = array("contact@letsfame.com");

foreach ($emails as $value) {
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.sendgrid.com/v3/mail/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"personalizations": [{"to": [{"email": "'.$value.'"}]}],"from": {"email": "support@letsfame.com"},"subject": " Enquiry from LetsFame Community Event","content": [{"type": "text/html", "value": "<h2>Customer Details</h2><strong>Name : </strong>'.$_POST['name'].'<br><br><strong>Email : </strong>'.$_POST['mail'].'<br><br><strong>Phone : </strong>'.$_POST['phone'].'<br><br><strong>Profession : </strong>'.$_POST['profession']. '<br><br><strong>Letsfame Profile link  : </strong>'.$_POST['link'].'"}]}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
	   'Authorization: Bearer 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'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$profession = $_POST['profession'];
$link = $_POST['link'];

$sql=$connect->query("INSERT INTO community (name, phone, mail, profession, link) VALUES ('$name', '$phone', '$mail', '$profession', '$link')");


echo "<script type='text/javascript'> window.location='thankyou';</script>";
}
else {
        echo "<script>alert('Please complete the reCAPTCHA.');</script>";
        echo "<script type='text/javascript'> window.location='pk';</script>";

    }

?>