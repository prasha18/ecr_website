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

$name = $_POST['name'];
$phone = $_POST['phone'];
$mail = $_POST['mail'];
$profession = $_POST['profession'];
$shortfilm = $_POST['shortfilm'];
$duration = $_POST['duration'];
$directed = $_POST['directed'];
$yourmessage = $_POST['yourmessage'];
$link = $_POST['link'];
$youtubelink = $_POST['youtubelink'];
$checkagree = $_POST['checkagree'];

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
  CURLOPT_POSTFIELDS =>'{"personalizations": [{"to": [{"email": "'.$value.'"}]}],"from": {"email": "support@letsfame.com"},"subject": " Enquiry from LetsFame Short Film Contest","content": [{"type": "text/html", "value": "<h2>Short Film Contest Details</h2><strong>Name : </strong>'.$name.'<br><br><strong>Email : </strong>'.$mail.'<br><br><strong>Phone : </strong>'.$phone.'<br><br><strong>Profession : </strong>'.$profession. '<br><br><strong>Short Film Name  : </strong>'.$shortfilm.'<br><br><strong>Duration  : </strong>'.$duration.'<br><br><strong>Directed By   : </strong>'.$directed.'<br><br><strong>Cast & Crew Details  : </strong>'.$yourmessage.'<br><br><strong>Letsfame Profile link  : </strong>'.$link.'<br><br><strong>Short film drive link / youtube link  : </strong>'.$youtubelink.'<br><br><strong>Agree to the Terms  : </strong>'.$checkagree.'"}]}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
	   'Authorization: Bearer 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'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
 // echo $response;
}



$sql=$connect->query("INSERT INTO short_filem (name, phone, mail, profession, shortfilm, duration, directed, yourmessage, link, youtubelink, checkagree) VALUES ('$name', '$phone', '$mail', '$profession', '$shortfilm', '$duration', '$directed', '$yourmessage', '$link', '$youtubelink', '$checkagree')");


echo "<script type='text/javascript'> window.location='thankyou';</script>";
}
else {
        echo "<script>alert('Please complete the reCAPTCHA.');</script>";
        echo "<script type='text/javascript'> window.location='short-film-contest';</script>";

    }

?>