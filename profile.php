 
<?php
 
// Program to display URL of current page.
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https";
else
      $link = "http";
     
// Here append the common URL characters.
$link .= "://";
     
// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];
     
// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];
     
// Print the link
 $link;


    //$link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $dataname = end($link_array);

 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content='The first professional networking website & app for the entertainment industry, media jobs, film industry jobs, and casting network connecting global professionals.'>
    <meta name="keywords"
        content="professional networking app, cinema jobs, film industry jobs, media jobs, best casting app for android, casting network Websites, film industry careers, LetsFame">
    <meta name="author" content="Mansoor H">
    <meta name="p:domain_verify" content="97108a573ee57d532fae349647673743" />
    <title>LetsFAME - World's 1st networking & talent hiring platform for the entertainment industry</title>
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <!-- Style CSS Start -->
    <meta property='og:title'
        content="LetsFAME - World's 1st networking & talent hiring platform for the entertainment industry" />
    <meta property='og:image' content='' />
    <meta name="robots" content="index, follow" />
    <meta property='og:description'
        content='The first professional networking website & app for the entertainment industry, media jobs, film industry jobs, and casting network connecting global professionals.' />
    <meta property='og:url' content='index' />
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    <meta property="og:type" content='website' />
    <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap CSS -->
    <link type="text/css" href="assets/css/style.css" rel="stylesheet"><!-- Style CSS -->
    <link type="text/css" href="assets/css/step.css" rel="stylesheet"><!-- Style CSS -->
    <link type="text/css" href="assets/css/nav.css" rel="stylesheet"><!-- Menu CSS -->
    <link type="text/css" href="assets/css/mediaquery.css" rel="stylesheet"><!-- Mediaquery CSS -->
    <link type="text/css" href="assets/fonts/font.css" rel="stylesheet"><!-- Font CSS -->
    <link type="text/css" href="assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"><!-- Icons CSS -->
    <link type="text/css" href="assets/css/comments.css" rel="stylesheet">
    <link type="text/css" href="assets/css/tooltip.css" rel="stylesheet">
    <link type="text/css" href="assets/css/all.min.css" rel="stylesheet"><!-- FontAwesome CSS -->
    <link type="text/css" href="assets/css/chat.css" rel="stylesheet">
    <link type="text/css" href="assets/css/search.css" rel="stylesheet">
    <link type="text/css" href="assets/css/slider.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <link href="assets/css/aos.css" rel="stylesheet">
    <link href="assets/css/video.css" rel="stylesheet">
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/skrollr.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script><!-- Bootstrap Bundle JS -->
    <script src="assets/js/main-nav.js"></script><!-- Menu Main JS -->
    <script src="assets/js/all.min.js"></script><!-- FontAwesome JS -->
    <script src="assets/js/chat.js"></script><!-- FontAwesome JS -->
    <script src="assets/js/search.js"></script><!-- Search JS -->
    <script src="assets/js/step.js"></script>
    <script src="assets/js/slider.js"></script>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	    <script src="assets/js/magnificPopup.js"></script>

  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
	    <script src="assets/js/jquery.magnific-popup.min"></script>

  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.10.2/bodymovin.min.js"></script>
    <!-- <script src="https://www.youtube.com/iframe_api"></script> -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-185161524-1"></script>
    <script type="application/ld+json">
		{
		  "@context": "https://schema.org",
		  "@type": "EntertainmentBusiness",
		  "name": "LetsFame",
		  "image": "https://letsfame.com/assets/img/phone5.png",
		  "@id": "Hire a ProfessionalforEntertainmentIndustry",
		  "url": "index",
		  "telephone": "",
		  "address": {
			"@type": "PostalAddress",
			"streetAddress": "No. 25, Dr. Radhakrishnan salai, Mylapore",
			"addressLocality": "Chennai",
			"postalCode": "600004",
			"addressCountry": "IN"
		  },
		  "geo": {
			"@type": "GeoCoordinates",
			"latitude": 13.043006265209643,
			"longitude": 80.25639908683165
		  } ,
		  "sameAs": [
			"https://www.facebook.com/Letsfameofficial/",
			"https://twitter.com/letsfameoffl?s=20",
			"https://www.instagram.com/letsfameapp/",
			"https://www.youtube.com/channel/UCKhIRTOi86I_B9ZSp9evAAg/featured"
		  ] 
		}
		</script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-185161524-1');
    </script>
    <script src="https://www.youtube.com/player_api"></script>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || []; w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            }); var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5M4KV6W');</script>
    <!-- End Google Tag Manager -->
    <script>
        $(document).ready(function () {
            var s = skrollr.init();
            if (s.isMobile()) {
                s.destroy();
            }
        });
        $(window).on('load', function () {
            // Re-initialize the Skrollr instance on page load

        });

        let platform = getOS();
        if (platform === 'iOS') {
            window.location.href="https://apps.apple.com/in/app/letsfame/id6444732920";
        } else if (platform === 'Android') {
            window.location.href="https://play.google.com/store/apps/details?id=com.letsfame.app";
        }

         function showForm(url, name, index){
            document.getElementById('photo-modal').style.display = "block";
            document.getElementById('photo-src').src=url;
            document.getElementById('photo-name').textContent=name;
        }

        function closeForm(){
            document.getElementById('photo-modal').style.display = "none";
        }

        function showProfile(url){
            document.getElementById('profile-modal').style.display = "block";
            document.getElementById('profile-src').src=url;
        }

        function closeProfile(){
            document.getElementById('profile-modal').style.display = "none";
        }

        function showCover(url){
            document.getElementById('cover-modal').style.display = "block";
            document.getElementById('cover-src').src=url;
        }

        function closeCover(){
            document.getElementById('cover-modal').style.display = "none";
        }

        function showAchievement(title, date, desc,url, index ){
            document.getElementById('achievement-modal').style.display = "block";
            document.getElementById('achievement-src').src=url;
            document.getElementById('achievement-name').textContent=title;
            let achievement_date = date.split("-")
            document.getElementById('achievement-date').textContent = achievement_date[2]+"-"+achievement_date[1]+"-"+achievement_date[0];
            document.getElementById('achievement-desc').textContent=desc;
        }

        function closeAchievement(){
            document.getElementById('achievement-modal').style.display = "none";
        }

        function showVideo(url, name, index){
            document.getElementById('video-modal').style.display = "block";
            document.getElementById('video-url').src = url;
            document.getElementById('video-name').textContent=name;
        }

        function closeVideo(){
            document.getElementById('video-url').src = '';
            document.getElementById('video-modal').style.display = "none";
            location.reload();
        }

        function getMyOS() {
            var userAgent = window.navigator.userAgent,
                platform = window.navigator?.userAgentData?.platform || window.navigator.platform,
                macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
                windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
                iosPlatforms = ['iPhone', 'iPad', 'iPod'],
                os = null;
        
            if (macosPlatforms.indexOf(platform) !== -1) {
            os = 'Mac OS';
            } else if (iosPlatforms.indexOf(platform) !== -1) {
            os = 'iOS';
            } else if (windowsPlatforms.indexOf(platform) !== -1) {
            os = 'Windows';
            } else if (/Android/.test(userAgent)) {
            os = 'Android';
            } else if (/Linux/.test(platform)) {
            os = 'Linux';
            }
            if (os === 'iOS') {
				window.open("https://apps.apple.com/in/app/letsfame-find-cinema-jobs/id6444732920", '_blank');
			} else if (os === 'Android') {
				window.open("https://play.google.com/store/apps/details?id=com.letsfame.app", '_blank');
			}
        }
    </script>
    <?php
            // $apiUrl = 'http://18.136.144.240:8180/api/v1.0/members/guest/token';
            $apiUrl = 'https://api.letsfame.com/api/v1.0/members/guest/token';

            $data = json_encode([
                "request_type" => "MEMBER", 
                "device_id" => "string", 
                "device_type" => "ANDROID", 
                "device_token" => "string",
            ]);
            
            // Basic Authentication username and password
            // development
            // $username = 'LetsFamez91';
            // $password = 'Password@1';

            //live
            $username = 'LetsFamez91';
            $password = 'BlackpanthersWaytoLetsfamezApp';

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json', // Set the content type based on your API's requirements
            ]);
            
            // Set Basic Authentication credentials
            curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
            
            // Execute the cURL session and store the response
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL Error: ' . curl_error($ch);
            }
            
            // Close the cURL session
            curl_close($ch);
            
            // Handle the API response (e.g., print it)
          
            $responseData = json_decode($response, true);

            // Check if decoding was successful
            if ($responseData !== null) {
                // Access the bearer_token
                $bearerToken = $responseData['bearer_token'];

                $name = $dataname;

                // API Endpoint URL
                // $apiUrl = 'http://18.136.144.240:8180/api/v2.0/members?query='.$name;
                // $apiUrl = 'https://api.letsfame.com/api/v2.0/members?query='.$name;
                

                $apiUrl = 'https://api.letsfame.com/api/v2.0/members?filter_by=username:eq:'.$name;
                // Initialize cURL session
                $ch = curl_init();
                
                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json', 
                    'Authorization: Bearer '. $bearerToken, 
                ]);
                // Execute the cURL session and store the response
                $response = curl_exec($ch);
                
                // Check for cURL errors
                if (curl_errno($ch)) {
                    echo 'cURL Error: ' . curl_error($ch);
                }
                
                // Close the cURL session
                curl_close($ch);
                $userData = json_decode($response, true);

                //   echo "<pre>";print_r($userData);echo"</pre>";

            } else {
                echo 'Failed to decode JSON response.';
            }

    
            ?>
</head>
<style>
.modal-header {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: start;
    align-items: flex-start;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 0rem 0rem !important;
    border-bottom: 1px solid black !important;
    border-top-left-radius: 0.3rem;
    border-top-right-radius: 0.3rem;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    /* background-color: #fff; */
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 0px;
}
.mfp-figure figure img{max-height:80vh !important;}
    .navbar .active {
        color: #f3c060 !important;
    }

    /* .active {
        color: #f3c060 !important;
    } */

    .close-btn {
        padding-top: 16px;
        padding-right: 6px;
    }

    * {
    box-sizing: border-box;
  }
  
  /* body {
    margin: 0;
    font-family: Arial;
  } */
  
  /* .header {
    text-align: center;
    padding: 32px;
  } */
  
  .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    /* padding: 0px 0px 0px; */
    margin-bottom: -10px;
}
  
  /* Create four equal columns that sits next to each other */
  .column {
    -ms-flex: 25%; /* IE10 */
    flex: 25%;
    max-width: 25%;
    padding: 0 4px;
  }
  
  .column img {
    margin-top: 8px;
    vertical-align: middle;
    width: 100%;
  }
  
  /* Responsive layout - makes a two column-layout instead of four columns */
  @media screen and (max-width: 800px) {
    .column {
      -ms-flex: 50%;
      flex: 50%;
      max-width: 50%;
    }
    	.form-content-video {
    align-items: center;
    width: inherit !important;
}
  }
  
  /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
  @media screen and (max-width: 600px) {
    .column {
      -ms-flex: 100%;
      flex: 100%;
      max-width: 100%;
    }
    	.form-content-video {
    align-items: center;
    width: inherit !important;
}
  }
.form-modal {
    position: fixed;
    top: 0;
    background-color: #3e3d3df7;
    left: 0;
    z-index: 9999;
    height: 100vh;
    overflow-y: scroll;
    display: flex;
    width: 100%;
}
  .form-content {
  width: 400px;
  max-width: 100%;
  background-color: white;
  padding: 20px;
  margin: auto;
  position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
  }

  .cover-form-content {
  width: 700px;
  max-width: 100%;
  background-color: white;
  padding: 20px;
  margin: auto;
  position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
  }


  .form-content-video {
    align-items: center;
    width: 717px;
    /* height: 600px; */
    /* max-width: 61%; */
    /* background-color: darkcyan; */
    /* padding: 20px; */
    margin: auto;
    }
  
  .form-header {
    display: flex;
    padding: 10px 0;
  }
  
  .form-header .btn-close {
    margin-left: auto;
    color: #000000;
    border-radius: 50%;
    padding: 15px;
   	 font-size: 40px;
    background: transparent url("assets/img/close_button.png") center/1em auto no-repeat;

  }

  .modal-header .btn-close {
    margin-left: auto;
    color: #000000;
    border-radius: 50%;
    padding: 15px;
   	 font-size: 40px;
    background: transparent url("assets/img/close_button.png") center/1em auto no-repeat;

  }
  
  .error{
    color: red;
  }

  .profileimg{object-fit: cover;
    height: 250px;
    max-width: 100%;
  }
  
  .video-play-btn1 {
    position: absolute;
    top: 36%;
    left: 50%;
    font-size: 48px;
    margin-right: -50%;
    transform: translate(-50%, -50%);
}

.image-container {
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    object-fit: cover;
}

</style>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5M4KV6W" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>

    <section class="profile-container bg-light" style="margin-top: 20px;">
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 bg-white rounded p-0 px-0 shadow-sm">
                <!-- ======= Profile View Start ======= -->
                <section>
                    <div class="container mt-3 mb-5">
                        <div class="row">
                            <div class="profile-heading">
                                <div class="bg-white email-logo col-md-12 p-3 text-center">
                                    <img src="assets/img/email-logo.png" alt="" class="">
                                </div>
								 <?php  if(isset($userData['data'][0])){ ?>
                                <div class="profile-banner mt-2 mb-5">
                                    
                                    <?php if(key_exists('cover_image',$userData['data'][0]) && $userData['data'][0]["cover_image"] !== '') {?>
                                        <a href="<?php echo $userData['data'][0]['cover_image']; ?>">
                                            <img src='<?php echo $userData['data'][0]['cover_image'] ?>'
                                            alt="" class="profileimg">
                                        </a>
                                    <?php } else { ?>   
                                        <img src='assets/img/profile-cover.jpg'
                                        alt="cover-image" class="img-fluid">
                                    <?php } ?> 

                                    <?php if(key_exists('profile_image',$userData['data'][0]) && $userData['data'][0]["profile_image"] !== '') {?>
                                        <a href="<?php echo $userData['data'][0]['profile_image']; ?>">
                                            <div class="profile-logo"><img style="width: 150px;"
                                                    src='<?php echo $userData['data'][0]['profile_image'] ?>'
                                                    class="img-fluid rounded-circle image-container">
                                            </div>
                                        </a>
                                    <?php } else { ?>   
                                        <div class="profile-logo"><img style="width: 150px;"
                                                src='assets/img/profile-pic.png'
                                                class="img-fluid rounded-circle image-container">
                                        </div>
                                    <?php } ?>   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-12 col-xs-12 pt-0">
                            <!-- <h5>
                                {{ users?.name }}</h5> -->
                            <div class="justify-content-center">
                                <span class="h5"><b><?php echo $userData['data'][0]['name'] ?></b></span>
                                <!-- <span class="fw-bold h5">{{ users?.name }}</span> -->
                                <?php if($userData['data'][0]['user_verified'] == "true"){  ?>
                                    <img src="assets/img/verified-icon.svg" class=" img-fluid pb-1"/>
                                <?php } ?>
                                <?php if($userData['data'][0]['membership'] === "PREMIUM"){  ?>
                                    <img src="assets/img/premium-icon.svg" class="pb-1 img-fluid " width="15px"/>
                                <?php } ?>
                                <?php if($userData['data'][0]['membership'] === "PREMIUM_PRO"){  ?>
                                    <img src="assets/img/premiumpro.svg" class="pb-1 img-fluid " width="17px"/>
                                <?php } ?>
                            </div>
                               
                            <p class="text-muted mb-0"><?php echo $userData['data'][0]['profession'] ?> &#8226; <?php echo $userData['data'][0]['city'] ?> </p>
                         
                            <?php if($userData['data'][0]['metric_count']['noOfConnections'] !==0 && $userData['data'][0]['metric_count']['noOfFollowers']!==0){ ?>
                           <p class="text-muted mb-0"><a
                                        class="fw-bold yellow" style="color:#F3C060;"><?php echo $userData['data'][0]['metric_count']['noOfConnections'] ?> Connections  .  <?php echo $userData['data'][0]['metric_count']['noOfFollowers'] ?> Followers</a> </p>
						<?php } else if($userData['data'][0]['metric_count']['noOfConnections'] ==0 && $userData['data'][0]['metric_count']['noOfFollowers']!==0) { ?>
						 <p class="text-muted mb-0"><a
                                        class="fw-bold yellow" style="color:#F3C060;"> <?php echo $userData['data'][0]['metric_count']['noOfFollowers'] ?> Followers</a> </p>
						<?php } else if($userData['data'][0]['metric_count']['noOfConnections'] !==0 && $userData['data'][0]['metric_count']['noOfFollowers']==0) { ?>
<p class="text-muted mb-0"><a
                                        class="fw-bold yellow" style="color:#F3C060;"><?php echo $userData['data'][0]['metric_count']['noOfConnections'] ?> Connections  </a> </p>
						<?php } else { ?>
						 <p class="text-muted mb-0"><a
                                        class="fw-bold yellow" style="color:#F3C060;"> </a></p>
						<?php } ?>
                        </div>
                    </div>
                    <div class="container"><br>
                        <div class="profile-heading border-bottom pb-2 mb-3">
                           <h5>About</h5>
                        </div>
                        <div class="profile-heading mb-3 border-bottom">
                                    <p class="text-justify"><?php echo $userData['data'][0]['biography'] ?>.</p>

                                    <h5>Reach out to <?php echo $userData['data'][0]['name'] ?> for ?</h5>
                               
                        </div>

                        <div class="profile-heading mb-3 border-bottom">
                            <div class="row">
                                <div class="col-md-12 pt-2 mb-2">
                                    <div class="skill-list">
                                        <ul>
                                        <?php 
                                            foreach($userData['data'][0]['intrested_skills'] as $skill){
                                                  ?>
                                            <li>
                                                <a class="active"><?php echo $skill ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                           
                                    <h5>Skills</h5>
                               
                        </div>

                        <div class="profile-heading">
                            <div class="row">
                                <div class="col-md-12 pt-2">
                                    <div class="skill-list">
                                        <ul>
                                        <?php 
                                            foreach($userData['data'][0]['known_skills'] as $skill){
                                                  ?>
                                            <li>
                                                <a class="active"><?php echo $skill ?></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php if(count($userData['data'][0]['showreels']) > 0) { ?>
                            <div class="profile-heading border-bottom pb-2 mb-3">
                                <div class="row">
                                    <div class="col pt-3">
                                        <h5>Portfolio</h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        
                       
                        <?php $i = 0;  foreach($userData['data'][0]['showreels'] as $showreels){ 
                            if ($showreels['showreel_type'] =="SHOWREEL"){
                            if($i == 0){?>
                                 <div class="profile-heading mb-2">
                                <div class="row">
                                <h6 class="mb-2">Showreels</h6>
                                <?php } ?>
								
                               	<div class="col-md-3">
                                    <div class="showreel-item">
										  <a onclick="showVideo('<?php echo $showreels['url']; ?>', '<?php echo $showreels['name']; ?>', '<?php echo $i; ?>')">
                                            <img class="img-tile" src="<?php echo $showreels['thumbnails'][0]['url']; ?>"/>
                                            <div class="video-play-btn text-center">
                                                <img class="w-50" src="assets/img/play-button.png"/>
                                            </div>
                                        </a>
										  </div>
										  <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
										  </div>
                            <?php $i++; } } if($i > 0){?>
                                </div>
                        </div>
                        <?php } ?>
                       
                                           
                        <?php  $i=0; foreach($userData['data'][0]['showreels'] as $showreels){ 
                            if ($showreels['showreel_type'] =="PHOTO"){
                                if($i == 0){ ?>
                                   <div class="profile-heading mb-2">
                                        <div class="row">  
                                        <h6 class="mb-2">Photos</h6>
                                <?php } ?>
                                    <div class="w3-third">
                                        <a href="<?php echo $showreels['url']; ?>" >
                                            <img src="<?php echo $showreels['url']; ?>" class="img-fluid w-100 rounded-3 show-image-tile">
                                        </a>
                                        <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                <?php $i++; } } if($i > 0){ ?>
                                    </div>
                        </div>
                        <?php } ?>
                        
                       <div class="profile-heading mb-2">
                            <div class="row">
                            <?php $i=0; foreach($userData['data'][0]['showreels'] as $showreels){ 
                                if ($showreels['showreel_type'] == "SCRIPT"){
                                if($i == 0){?>
                                    <h6 class="mb-2">Scripts</h6>
                                <?php } ?>
                                    <div class="col-md-3">
                                        <div class="showreel-item">
                                            <a href="<?php echo $showreels['url']; ?>" target="_blank" class="text-dark">
                                                <img class="audio-bg img-tile" src="assets/img/pdf-thumbnail-svg.svg"/>
                                            </a>
                                        </div>
                                        <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                    <?php  $i++; } } if($i > 0){ ?>
                                
                            <?php } ?>
                            </div>
                        </div>

                       
                         <?php  $i=0; foreach($userData['data'][0]['showreels'] as $showreels){ 
                                if ($showreels['showreel_type'] =="MUSIC_VIDEO"){
                                    if($i == 0){?>
                                    <div class="profile-heading mb-2">
                                        <div class="row">
                                        <h6 class="mb-2">Music Video</h6>
                                    <?php } ?>
                                   <div class="col-md-3">
                                        <div class="showreel-item">
                                            
											
											 <a onclick="showVideo('<?php echo $showreels['url']; ?>', '<?php echo $showreels['name']; ?>', '<?php echo $i; ?>')">
                                                <img class="img-tile" src="<?php echo $showreels['thumbnails'][0]['url']; ?>"/>
                                                <div class="video-play-btn text-center">
                                                    <img class="w-50" src="assets/img/play-button.png"/>
                                                </div>
                                            </a>
											
											
											
                                        </div>
                                        <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                <?php $i++; } } if($i > 0){?>
                                    </div>
                        </div>
                        <?php } ?>
                        
                        
                        <?php  $i=0; foreach($userData['data'][0]['showreels'] as $showreels){ 
                               if ($showreels['showreel_type'] =="COVER_VIDEO"){
                                    if($i == 0){?>
                                        <div class="profile-heading mb-2">
                                            <div class="row">
                                            <h6 class="mb-2">Cover Video</h6>
                                                <?php } ?>
                                                <div class="col-md-3">
                                                    <div class="showreel-item">
                                                        
														
													<a onclick="showVideo('<?php echo $showreels['url']; ?>', '<?php echo $showreels['name']; ?>', '<?php echo $i; ?>')">
                                                            <img class="img-tile" src="<?php echo $showreels['thumbnails'][0]['url']; ?>"/>
                                                            <div class="video-play-btn text-center">
                                                                <img class="w-50" src="assets/img/play-button.png"/>
                                                            </div>
                                                        </a>
														
														
                                                    </div>
                                                    <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                                </div>
                                        <?php $i++; } }
                                    if($i > 0){?>
                                </div>
                            </div>
                        <?php } ?>
                            

                        <!-- Song Lyrics Start-->
                        
                           <?php  $i=0; foreach($userData['data'][0]['showreels'] as $showreels){ 
                            if ($showreels['showreel_type'] =="SONG_LYRIC"){
                                 if($i == 0){ ?>
                                    <div class="profile-heading mb-2">
                                        <div class="row">
                                        <h6 class="mb-2">Song Lyrics </h6>

                                    <?php } if ($showreels['showreel_type'] =="SONG_LYRIC" && $showreels['type'] =="AUDIO"){?>
                                        <div class="col-md-3">
                                        <div class="showreel-item">
                                            <a href="<?php echo $showreels['url']; ?>" target="_blank" class="text-dark">
                                                <img class="audio-bg img-tile" src="assets/img/music-thumbnail-svg.svg"/>
                                            </a>
                                        </div>
                                        <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                <?php }  
                                   else if ($showreels['showreel_type'] =="SONG_LYRIC" && $showreels['type'] =="DOCUMENT"){
                                     ?>
                                    <div class="col-md-3">
                                        <div class="showreel-item">
                                            <a href="<?php echo $showreels['url']; ?>" target="_blank" class="text-dark">
                                                <img class="audio-bg img-tile" src="assets/img/pdf-thumbnail-svg.svg"/>
                                            </a>
                                        </div>
                                        <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                <?php  } $i++; } } if($i > 0){?>
                            </div>
                        </div>
                        <?php }  ?>
                        <!-- Song Lyrics End-->

                        <!-- Sound Design Reel Start-->
                        
                        <?php $i=0;   foreach($userData['data'][0]['showreels'] as $showreels){ 
                            if ($showreels['showreel_type'] =="SOUND_DESIGN_REEL"){
                            if($i == 0){
                                ?>
                                <div class="profile-heading mb-3">
                                    <div class="row">
                                    <h6 class="mb-2">Sound Design Reels</h6>
                                    <?php } 
                                    if ($showreels['showreel_type'] =="SOUND_DESIGN_REEL" && $showreels['type'] =="VIDEO"){?>
										<div class="col-md-3">
                                            <div class="showreel-item">
												<a onclick="showVideo('<?php echo $showreels['url']; ?>', '<?php echo $showreels['name']; ?>', '<?php echo $i; ?>')">
                                                    <img class="img-tile black-bg" src="<?php echo $showreels['thumbnails'][0]['url']; ?>"/>
                                                    <div class="video-play-btn1 text-center">
                                                        <img class="w-50" src="assets/img/play-button.png"/>
                                                    </div>
                                                </a>
										<p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                        </div>
                                    </div>
                                    <?php } if ($showreels['showreel_type'] =="SOUND_DESIGN_REEL" && $showreels['type'] =="AUDIO"){?>
                                    <div class="col-md-3">
                                        <div class="showreel-item">
                                            <a href="<?php echo $showreels['url']; ?>" target="_blank" class="text-dark">
                                                <img class="audio-bg img-tile" src="assets/img/music-thumbnail-svg.svg" />
                                            </a>
                                        </div>
                                    <p class="text-center mt-2 fw-bold"><small><?php echo $showreels['name']; ?></small></p>
                                    </div>
                                    <?php } $i++;  }}  if($i > 0){?>
                            </div>
                        </div>
                        <?php } ?>





                        <?php if(key_exists('achievements',$userData['data'][0])){?>
                            <h5>Achievements</h5><hr><?php }  ?>  
                            <div class="profile-heading mb-3">
                                        <div class="row">  
                            <?php if(key_exists('achievements',$userData['data'][0])){
                            $i=0;  foreach($userData['data'][0]['achievements'] as $achievement){ 
                                if($i == 0) {
                                    ?>
                                    
                                            <?php } ?>
                                        <?php if(count($achievement['files']) > 0) {?>
                                            <p class="profile-achievement">
                                                <a href="<?php echo $achievement['files'][0]['url']; ?>">
                                                    <img src="<?php echo $achievement['files'][0]['url']; ?>" alt="Pineapple" style="width:120px;height:120px;margin-left:15px;  float: right;">
                                                </a>
                                                <b><?php echo $achievement['title']; ?></b><br>
                                                <?php echo $achievement['date']; ?><br>
                                                <?php echo $achievement['awarded_by']; ?><br>
                                                <?php echo $achievement['description']; ?>
                                            </p>
                                        <?php } else { ?>
                                            <p class="profile-achievement">
                                                <a style="margin-right:15px">
                                                    <b><?php echo $achievement['title']; ?></b><br>
                                                    <?php echo $achievement['date']; ?><br>
                                                    <?php echo $achievement['awarded_by']; ?><br>
                                                    <?php echo $achievement['description']; ?>
                                                </a>
                                            </p>										
						                <?php } ?>
                        <?php $i++; }
                        } 
                            if( $i > 0) {?>
                        
                        <?php } ?>
                        </div>
                        </div>
                                <?php if(key_exists('projects',$userData['data'][0])){
                                    if(count($userData['data'][0]['projects']) > 0){?>
                                    <div class="profile-heading pb-3" >
                                        <div class="row">
                                            <div class="col-md-12 pt-2 pb-2">
                                                <div class="col ps-0 text-start">
                                                    <h5 class="border-bottom pb-2 mb-3">Projects Worked</h5>
                                                </div>
                                    <?php }} ?>
                                    <?php  
                                    if(key_exists('projects',$userData['data'][0])){
                                    if(count($userData['data'][0]['projects']) > 0){
                                     foreach($userData['data'][0]['projects'] as $project){ ?>
                                        <div class="w-100 pb-3 position-relative">
                                            <h6 class="mt-3 mb-0  pb-2"><?php echo $project['project_name']; ?></h6>
                                            <p class="mb-0"><?php echo $project['designation']; ?></p>
                                            <small class="text-muted m-p-0"><?php echo $project['from']; ?>-<?php echo $project['to']; ?></small>
                                            <p class="mb-0"><?php echo $project['description']; ?></p>
                                        </div>

                                        <div class="row">
                                        <?php   foreach($project["references"] as $reference){ ?>
                                            <div class="col-md-12 mb-3">
                                                <h5>Reference(s)</h5>
                                                <div class="d-flex">
                                                    <i class="fa-regular fa-user h4 yellow pt-2"></i>
                                                    <div class="d-flex flex-column ms-2">
                                                        <div class="mb-0"><small class="text-muted">Reference
                                                                Name</small>
                                                        </div>
                                                        <h6 class="mb-0"><?php echo $reference["reference_name"] ?></h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex">
                                                    <i class="bi bi-tag h4 yellow pt-2"></i>
                                                    <div class="d-flex flex-column ms-2">
                                                        <div class="mb-0"><small class="text-muted">Reference
                                                                Designation</small></div>
                                                        <h6 class="mb-0"><?php echo $reference["designation"]; ?></h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if(key_exists('mobile_no',$reference) && $reference["mobile_no"] !== '') { ?>
                                            <div class="col-md-12 mb-3">
                                                <div class="d-flex">
                                                    <i class="fa-solid fa-mobile-screen-button h4 yellow pt-2"></i>
                                                    <div class="d-flex flex-column ms-3">
                                                        <div class="mb-0"><small class="text-muted">Mobile Number</small></div>
                                                        <h6 class="mb-0">**********</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if(key_exists('email_id',$reference) && $reference["email_id"] !== '') { ?>
                                                <div class="col-md-12 mb-3">
                                                    <div class="d-flex">
                                                        <i class="fa-regular fa-envelope h4 yellow pt-2"></i>
                                                        <div class="d-flex flex-column ms-2">
                                                            <div class="mb-0"><small class="text-muted">Email Address</small>
                                                            </div>
                                                            <h6 class="mb-0">**********</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php  } ?>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12 mb-3 profile-preview-link">
                                                <?php  if(count($project["links"]) > 0){ ?>
                                                <h5 >Links</h5>
                                                <?php   }  ?>
                                                <ul>
                                                    <?php   foreach($project["links"] as $link){ 
                                                        if($link['name'] ==='IMDB'){
                                                        ?>
                                                        <li >
                                                            <a href="<?php echo $link["value"]; ?>"  target="_blank">
                                                                <img src="assets/img/imdb.png" alt="" class="img-fluid">
                                                            </a>
                                                        </li>
                                                    <?php   }  ?>
                                                    <?php   if($link['name'] ==='Youtube'){        ?>
                                                        <li>
                                                            <a href="<?php echo $link['value'] ?>" target="_blank">
                                                                <img src="assets/img/youtube.png" alt="" class="img-fluid">
                                                            </a>
                                                        </li>
                                                    <?php   }  ?>
                                                    <?php   if($link['name'] ==='Vimeo'){        ?>
                                                        <li>
                                                            <a href="<?php echo $link['value'] ?>" target="_blank">
                                                                <img src="assets/img/vimeo.png" alt="" class="img-fluid">
                                                            </a>
                                                        </li>
                                                    <?php   }  ?>
                                                    <?php   if($link['name'] ==='Cloud'){        ?>
                                                        <li>
                                                            <a href="<?php echo $link['value'] ?>" target="_blank">
                                                                <img src="assets/img/soundcloud.png" alt="" class="img-fluid">
                                                            </a>
                                                        </li>
                                                    <?php   } } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php }} } }
                                    if(key_exists('projects',$userData['data'][0])){
                                    if(count($userData['data'][0]['projects']) > 0){?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } } ?>
                      
                            <?php  
                            if(key_exists('educations',$userData['data'][0])){ 
                            if(count($userData['data'][0]['educations']) > 0){ ?>
                              <div class="profile-heading">
                                <div class="row">
                                    <div class="col text-start">
                                        <h5 class="border-bottom pb-2 mb-3">Education</h5>
                                    </div>
                            <?php  }} 
                            if(key_exists('educations',$userData['data'][0])){ 
                            if(count($userData['data'][0]['educations']) > 0){
                                foreach($userData['data'][0]['educations'] as $education){?>
                                    <div class="col-md-12 pb-2 mb-3 pt-2">
                                        <div class="d-flex">
                                            <div class="education-image"><i class="bi bi-mortarboard h1 yellow"></i></div>
                                            <div class="d-flex flex-column ms-2 pb-2">
                                                <div class="mb-0">
                                                    <h6 class="mb-0"><?php  echo $education["degree"] ?></h6>
                                                </div>
                                                <p class="mb-0"><?php  echo $education["institute"] ?></p>
                                                <small class="text-muted m-p-0"><?php  echo $education["from"] ?> - <?php  echo $education["to"] ?></small>
                                            </div>
                                        </div>
                                    </div>
                                <?php } }  } if(key_exists('educations',$userData['data'][0])){ 
                                    if(count($userData['data'][0]['educations']) > 0){?>
                            </div>
                        </div>
                        <?php } } ?>
                        <div class="profile-heading pb-2 mb-3">
                            <div class="row">
                                <div class="col-md-12  mb-3">
                                    <div class="col text-start">
                                    <h5 class="border-bottom pb-2 mb-3" style="margin-left: -12px;">Contact Information</h5>
                                    </div>
                                    <div class="d-flex">
                                        <i class="fa-regular fa-user h4 yellow pt-2"></i>
                                        <div class="d-flex flex-column ms-2">
                                            <div class="mb-0"><small class="text-muted">Your Profile</small></div>
                                            <h6 class="mb-0 text-break break-sentence">https://www.letsfame.com/<?php  echo $userData["data"][0]['username'] ?> </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="d-flex">
                                        <i class="fa-solid fa-mobile-screen-button h4 yellow pt-2"></i>
                                        <div class="d-flex flex-column ms-3">
                                            <div class="mb-0"><small class="text-muted">Mobile Number</small></div>
                                            <h6 class="mb-0">**********</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="d-flex">
                                        <i class="fa-regular fa-envelope h4 yellow pt-2"></i>
                                        <div class="d-flex flex-column ms-2">
                                            <div class="mb-0"><small class="text-muted">Email Address</small></div>
                                            <h6 class="mb-0">**********</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
						 <?php } else { ?>
                              <?php echo "<script>location.href = 'profile-not-found';</script>"; ?>
                         <?php } ?>
                        <div class="row mb-5">
                            <div class="col-md-8 offset-md-2 text-center border-top pt-3">
                                <p>Welcome to LetsFAME. Join the community of millions of artists & film professionals around the World!</p>
                                <h6>Available on the App Store and Google Play</h6>
                                <div class="row">
                                    <div class="col my-2 text-center">
                                        <a target="_blank" href="https://apps.apple.com/in/app/letsfame/id6444732920">
                                            <img src="assets/img/ios.svg" alt="img"
                                                    class="img-fluid mb-2 me-2">
                                        </a>
                                        <a target="_blank"
                                            href="https://play.google.com/store/apps/details?id=com.letsfame.app&pli=1">
                                            <img src="assets/img/android.svg" alt="img"
                                                    class="img-fluid mb-2">
                                        </a>
                                    </div>
                                    <!-- <div class="col my-2 text-center">
                                        
                                    </div> -->
                                </div>
                                <div class="row">
                                <div class="col-md-4 offset-md-4 text-center my-2">
                                    <a data-bs-toggle="modal" class="form-btn desktop-signup" data-bs-target="#signup">
                                        <div class="signup">JOIN US</div>
                                    </a>
                                    <a onclick="getMyOS()" class="form-btn  mobile-signup">
                                        <div class="signup">JOIN US</div>
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>


<div class="form-modal" id="photo-modal" style="display:none;">
    <div class="form-content">
        <div class="form-header">
            <button class="btn btn-close" onclick="closeForm()"></button>
        </div>
         <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-body table-responsive">
                   <div class="row position-relative">
                        <img class="img-fluid p-3 lightbox-image-fit" id="photo-src"/>
                    </div>
                </div>
             </div>
          </div>
         </div>
         <div class="row form-footer">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h4 class="form-modal-title applicant-count text-center" id="photo-name"><b></b></h4>
            </div>
            <div class="col-md-1"></div>
        </div>
  </div>
</div>

<div class="form-modal" id="profile-modal" style="display:none;">
    <div class="form-content">
        <div class="form-header">
            <button class="btn btn-close" onclick="closeProfile()"></button>
        </div>
         <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-body table-responsive">
                   <div class="row position-relative">
                        <img class="img-fluid p-3 lightbox-image-fit" id="profile-src"/>
                    </div>
                </div>
             </div>
          </div>
         </div>
  </div>
</div>


<div class="form-modal" id="cover-modal" style="display:none;">
    <div class="cover-form-content">
        <div class="form-header">
            <button class="btn btn-close" onclick="closeCover()"></button>
        </div>
         <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-body table-responsive">
                   <div class="row position-relative">
                        <img class="img-fluid p-3 lightbox-image-fit" id="cover-src"/>
                    </div>
                </div>
             </div>
          </div>
         </div>
  </div>
</div>

<div class="form-modal" id="achievement-modal" style="display:none;">
    <div class="form-content">
        <div class="form-header">
            <button class="btn btn-close" onclick="closeAchievement()"></button>
        </div>
         <div class="row">
          <div class="col-md-12">
             <div class="card">
                <div class="card-body table-responsive">
                   <div class="row position-relative">
                        <img class="img-fluid p-3 lightbox-image-fit" id="achievement-src"/>
                    </div>
                </div>
             </div>
          </div>
         </div>
         <div class="row form-footer">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h4 class="form-modal-title applicant-count text-center" id="achievement-name"><b></b></h4>
                <h6 class="form-modal-title applicant-count text-center text-muted" id="achievement-date"></h6>
                <h6 class="form-modal-title applicant-count text-center text-muted" id="achievement-desc"></h6>
            </div>
            <div class="col-md-1"></div>
        </div>
  </div>
</div>

<div class="form-modal" id="video-modal" style="display:none;">
    <div class="form-content-video" style="align-items: center;margin-top: 88px;
">
        <div class="form-header">
            <button class="btn btn-close" onclick="closeVideo()"></button>
        </div>
         <div class="row">
          <div class="col-md-12">
             <div class="card bg-dark">
                <div class="card-body table-responsive">
                   <div class="">
                        <video style="height: 400px;margin-bottom: -1%;" controls autoplay
                            id="video-url" class="video_resolution"
                            width="100%"
                            height="125px"></video>
                    </div>
                </div>
             </div>
          </div>
         </div>
        
  </div>
</div>


<div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header no-border">
                    <div class="close-btn">
                        <img src="assets/img/close-btn.png" alt="Close button LetsFame" title="Close button LetsFame" data-bs-dismiss="modal" class="img-fluid" height="80%" />
                    </div>
                </div>
                <div class="modal-body p-0">
                    <div class="w-100">
                        <div class="row">
                            <section class="qrcode-container">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="bg-dark shadow-sm">
                                                <div class="row">
                                                    <div class="col-md-4 mob-form-image">
                                                        <img src="assets/img/qr-code-image.png" alt="QR-Code LetsFame" title="QR-Code LetsFame"
                                                            class="img-fluid bgimg rounded-start">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="qr-code-popup mt-5">
                                                            <h3 class="text-white">World’s 1st
                                                                professional networking &
                                                                talent hiring app for the
                                                                Entertainment World</h3>
                                                            <div class="my-3 imgwidth pt-5">
                                                                <div class="row">
                                                                    <div class="col-md-7">
                                                                        <h5 class="text-white">Download Our
                                                                            Mobile App to Experience the Full Potential
                                                                            of the Platform</h5>
                                                                        <h6 class="mb-3 text-white">Downloads Available
                                                                            on</h6>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <a href="https://apps.apple.com/in/app/letsfame/id6444732920"
                                                                                    target="_blank" class="me-2"><img
                                                                                        src="assets/img/ios.svg"
                                                                                        alt="img" class="img-fluid"></a>

                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <a href="https://play.google.com/store/apps/details?id=com.letsfame.app"
                                                                                    target="_blank" class=""><img
                                                                                        src="assets/img/android.svg"
                                                                                        alt="img" class="img-fluid"></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 pt-3">
                                                                        <img src="assets/img/qr-code.png" alt="QR-Code LetsFame" title="QR-Code LetsFame"
                                                                            class="img-fluid qr-code" />
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">

    $(function () {
        AOS.init({
            duration: 1200
        });

        $('.js-load-more').on('click', function () {
            var $content = $(this).next('.js-more-content');

            $content.animate({
                height: 750,
            }, 500);
        });

        onElementHeightChange(document.body, function () {
            AOS.refresh();
        });
    });

    function onElementHeightChange(elm, callback) {
        var lastHeight = elm.clientHeight
        var newHeight;

        (function run() {
            newHeight = elm.clientHeight;
            if (lastHeight !== newHeight) callback();
            lastHeight = newHeight;

            if (elm.onElementHeightChangeTimer) {
                clearTimeout(elm.onElementHeightChangeTimer);
            }

            elm.onElementHeightChangeTimer = setTimeout(run, 200);
        })();
    }
    document.addEventListener("DOMContentLoaded", function () {

        el_autohide = document.querySelector('.autohide');

        // add padding-top to bady (if necessary)
        //navbar_height = document.querySelector('.navbar').offsetHeight;
        //document.body.style.paddingTop = navbar_height + 'px';

        if (el_autohide) {

            var last_scroll_top = 0;
            window.addEventListener('scroll', function () {
                let scroll_top = window.scrollY;
                if (scroll_top < last_scroll_top) {
                    el_autohide.classList.remove('scrolled-down');
                    el_autohide.classList.add('scrolled-up');
                } else {
                    el_autohide.classList.remove('scrolled-up');
                    el_autohide.classList.add('scrolled-down');
                }
                last_scroll_top = scroll_top;

            });
            // window.addEventListener

        }
        // if

    });
// DOMContentLoaded  end
</script>

</html>