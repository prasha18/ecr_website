<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Montserrat', sans-serif !important;
}
</style>
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
									// print_r($dataname);die;
include("includes/connect.php");
$qry=mysqli_query($connect,"SELECT * FROM blog where bl_url='$dataname'");
$row=mysqli_fetch_row($qry);
 
?>

<!doctype html>
<html lang="en">
<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
      content="<?php echo $row[12]; ?>">
   <meta name="keywords"
      content="<?php echo $row[13]; ?>">
   <meta name="author" content="Ajmal">
   <meta name="p:domain_verify" content="97108a573ee57d532fae349647673743" />
   <title><?php echo $row[11]; ?></title>
   <link rel="shortcut icon" href="assets/img/favicon.ico">
   <!-- Style CSS Start -->
   <meta property='og:title' content="<?php echo $row[11]; ?>" />
   <meta property='og:image' content='' />
   <meta name="robots" content="index, follow" />
   <meta property='og:description'
      content="<?php echo $row[12]; ?>" />
   <meta property='og:url' content='' />
   <link rel="canonical" href="<?php echo $row[14]; ?>">
   <link rel="alternate" href="<?php echo $row[14]; ?>"
      hreflang="en-us">
   <meta property="og:image:type" content="image/png">
   <meta property="og:image:width" content="1024">
   <meta property="og:image:height" content="1024">
   <meta property="og:type" content='website' />
   <link type="text/css" href="../assets/css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap CSS -->
   <link type="text/css" href="../assets/css/style.css" rel="stylesheet"><!-- Style CSS -->
   <link type="text/css" href="../assets/css/step.css" rel="stylesheet"><!-- Style CSS -->
   <link type="text/css" href="../assets/css/nav.css" rel="stylesheet"><!-- Menu CSS -->
   <link type="text/css" href="../assets/css/mediaquery.css" rel="stylesheet"><!-- Mediaquery CSS -->
   <link type="text/css" href="../assets/fonts/font.css" rel="stylesheet"><!-- Font CSS -->
   <link type="text/css" href="../assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"><!-- Icons CSS -->
   <link type="text/css" href="../assets/css/comments.css" rel="stylesheet">
   <link type="text/css" href="../assets/css/tooltip.css" rel="stylesheet">
   <link type="text/css" href="../assets/css/all.min.css" rel="stylesheet"><!-- FontAwesome CSS -->
   <link type="text/css" href="../assets/css/chat.css" rel="stylesheet">
   <link type="text/css" href="../assets/css/search.css" rel="stylesheet">
   <link type="text/css" href="../assets/css/slider.css" rel="stylesheet">
   <script src="../assets/js/jquery.min.js"></script>
   <link href="../assets/css/aos.css" rel="stylesheet">
   <script src="../assets/js/aos.js"></script>
   <script src="../assets/js/skrollr.min.js"></script>
   <script src="../assets/js/index.js"></script>
   <!-- <script src="../assets/js/bodymovin.js"></script> -->
   <!-- Style CSS End -->
   <!-- <script defer src="https://cdn.jsdelivr.net/npm/@finsweet/attributes-autovideo@1/autovideo.js"></script> -->
   <!-- JS Start -->
   <script src="../assets/js/bootstrap.bundle.min.js"></script><!-- Bootstrap Bundle JS -->
   <script src="../assets/js/main-nav.js"></script><!-- Menu Main JS -->
   <script src="../assets/js/all.min.js"></script><!-- FontAwesome JS -->
   <script src="../assets/js/chat.js"></script><!-- FontAwesome JS -->
   <script src="../assets/js/search.js"></script><!-- Search JS -->
   <script src="../assets/js/step.js"></script>
   <script src="../assets/js/slider.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/4.10.2/bodymovin.min.js"></script>
   <!-- <script src="https://www.youtube.com/iframe_api"></script> -->
   <!-- Google tag (gtag.js) -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-185161524-1"></script>
   <!-- <img src=""/> -->
   <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "BlogPosting",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "index2024-big-screen-buzz-the-most-anticipated-movies-in-international-and-indian-cinema"
    },
    "headline": "2024's Most Anticipated International and Indian Cinemas",
    "description": "Discover the cinematic excitement of 2024 with a glimpse into the most anticipated international and Indian films. Stay tuned for a thrilling year at the movies!",
    "image": "index../assets/img/blog/blog-view-12.webp",  
    "author": {
        "@type": "Organization",
        "name": "LetsFame"
    },  
    "publisher": {
        "@type": "Organization",
        "name": "LetsFame",
        "logo": {
        "@type": "ImageObject",
        "url": "index../assets/img/logo.png"
        }
    },
    "datePublished": ""
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
      function getMyOS() {
         let platform = getOS();
         if (platform === 'iOS') {
            window.open("https://apps.apple.com/in/app/letsfame-find-cinema-jobs/id6444732920", '_blank');
         } else if (platform === 'Android') {
            window.open("https://play.google.com/store/apps/details?id=com.letsfame.app", '_blank');
         }
      }
   </script>
</head>
<style>
   .navbar .active {
      color: #f3c060 !important;
   }

   .active {
      color: #f3c060 !important;
   }

   .close-btn {
      padding-top: 16px;
      padding-right: 6px;
   }
</style>

<body>
   <!-- Google Tag Manager (noscript) -->
   <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5M4KV6W" height="0" width="0"
         style="display:none;visibility:hidden"></iframe>
   </noscript>

<!--HEADER START-->
<header id="header" class="fixed-top d-flex align-items-center">
      <nav id="lt-navbar" class="navbar navbar-expand-lg fixed-top text-white"
         style="background-color: #000000; color: #ffffff !important; padding: 17px 0px;">
         <div class="container-fluid d-flex align-items-center px-3">
            <div class="logo me-auto"><a href="../index"><img src="../assets/img/logo.png" alt="logo"
                     title="logo" class="img-fluid"></a></div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
               <i class="fa-solid fa-bars text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item pt-2">
                     <a href="../index" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../aboutus" class="nav-link">About Us</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../how-its-work" class="nav-link">How its Works</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../plans" class="nav-link">Plans</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../why-use-letsfame" class="nav-link active">Read Our Blog</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../faq" class="nav-link">FAQ</a>
                  </li>
                  <li class="nav-item pt-2">
                     <a href="../contact-us" class="nav-link">Contact Us</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!-- </div> -->     
   </header>
<!--HEADER END---->	

   <div class="modal fade" id="signup" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static"
      data-bs-keyboard="false" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content bg-dark">
            <div class="modal-header no-border">
               <div class="close-btn">
                  <img src="../assets/img/close-btn.png" alt="Close button LetsFame" title="Close button LetsFame"
                     data-bs-dismiss="modal" class="img-fluid" height="80%" />
               </div>
            </div>
            <div class="modal-body p-0">
               <div class="w-100">
                  <div class="row">
                     <section class="qrcode-container bg-light">
                        <div class="">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="bg-dark shadow-sm">
                                    <div class="row">
                                       <div class="col-md-4 mob-form-image">
                                          <img src="../assets/img/qr-code-image.png" alt="QR-Code LetsFame"
                                             title="QR-Code LetsFame" class="img-fluid bgimg rounded-start">
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
                                                                  src="../assets/img/ios.svg" alt="img"
                                                                  class="img-fluid"></a>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <a href="https://play.google.com/store/apps/details?id=com.letsfame.app"
                                                               target="_blank" class=""><img
                                                                  src="../assets/img/android.svg" alt="img"
                                                                  class="img-fluid"></a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-5 pt-3">
                                                      <img src="../assets/img/qr-code.svg" alt="QR-Code LetsFame"
                                                         title="QR-Code LetsFame" class="img-fluid qr-code" />
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
									
   <section class="how-its-blog-view py-5 mb-lg-5 mb-3 mt-2">
      <div class="container pt-5 mt-lg-3 mt-0">
         <div class="row">
		
            <div class="col-lg-8 pe-lg-5 pe-auto">
               <div class="pe-lg-4 pe-auto">
                  <h1 class="text-center"><?php echo $row[1];  ?> </h1>

                  <img src="../admin/images/<?php  echo $row[2]; ?>" alt="blog-view-3" title="blog-view-3"
                     class="img-fluid w-100 py-4">
<div class="col-lg-12 col-md-12 pt-4 content-format" >
          <?php 
echo html_entity_decode($row[7]);

		   ?>
          </div>


                                  
               </div>
            </div>
			
            <div class="col-lg-4 pt-lg-auto pt-4">
               <div>
                  <h3 class="main-h3 border-l-3 mb-3">Popular Posts</h3>

     <?php
										$sql1 = "SELECT * FROM blog where bl_status ='Active' ORDER BY bl_id DESC";
										$result1 = $connect->query($sql1);
											foreach ($result1 as $row1) {
    ?>
                  <!-- blog-list-profiles -->
                   <div class="blog-list-item">
                     <div class="bli-img me-3">
                        <a href="<?php  echo $row1['bl_url'] ?>"><img src="../admin/images/<?php  echo $row1['bl_image']; ?>" alt="blog pro 9" title="blog pro 9"
                              class="img-fluid rounded-circle blog-thumb"></a>
                     </div>
                     <div class="bli-content">
<?php if($row1['bl_url'] == $dataname){ ?>
                        <h5><a href="<?php  echo $row1['bl_url'] ?>" class="active"><?php  echo $row1['bl_heading'] ?> </a> </h5>
                        <?php } else { ?>
                         <h5><a href="<?php  echo $row1['bl_url'] ?>"><?php  echo $row1['bl_heading'] ?> </a> </h5>
                         <?php } ?>                        <p class="small-p">
						<?php 
			  $str = $row1['bl_frontcontent'];

   // Get First Ten (10) words from String
   $result = implode(' ', array_slice(str_word_count($str, 2), 0, 10));

   echo $result;
			  
			  ?>
						
						
											</p>
                     </div>
                  </div>

                    <?php } ?>                      
                    
                 

               </div>
               <div class="pt-4 tag-main-border">
                  <h3 class="main-h3 border-l-3 mb-3">Tag</h3>
                  <!-- blog-list-tag -->
                  <ul class="pt-2">
                     <li class="tag-border"><a href="">Musician</a></li>
                     <li class="tag-border"><a href="">Director</a></li>
                     <li class="tag-border"><a href="">Photographer</a></li>
                  </ul>
                  <!-- //blog-list-tag -->
               </div>
            </div>
         </div>
      </div>
   </section>
											

<!--FOOTER START-->
<section class="footer">
	<div class="container pt-5 pb-2" data-aos="zoom-in">
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-3">
				<div class="row">
					<div class="col text-start">
						<ul class="footlist text-white">
								<!-- <li><a href="#" data-bs-toggle="modal" data-bs-target="#login">Sign In</a>
								</li> -->
								<li><a href="../plans">Plans</a>
								</li>
								<li><a href="../contact-us">Contact Us</a>
								</li>
								<li><a href="../user-agreement">User Agreement</a>
								</li>
								<li><a href="../privacy-policy">Privacy Policy</a>
								</li>
								<li><a href="../refund-policy">Refund Policy</a>
								</li>
								<li><a href="../cancellation-policy">Cancellation Policy</a>
								</li>
								<li><a href="../cookie-policy">Cookie Policy</a>
								</li>
								<li><a href="../ads">Advertise on LetsFAME</a></li>
								<!--<li><a href="tel:+916369111697"><i class="fa-solid fa-phone"></i> +91 6369111697</a></li>-->
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 mb-3">
					<div class="connect">
						<h2><span><img alt="letsfame" class="prempro" src="../assets/img/premiumpro.svg"></span>Connecting
						Creative Minds</h2>
						<div class="p-0">
							<!-- <a href="" data-bs-toggle="modal" data-bs-target="#enquiry"><button
								class="subscribe-btn">GET STARTED NOW </button></a> -->
								<a data-bs-toggle="modal" class="desktop-signup" data-bs-target="#signup"><button
									class="subscribe-btn">GET STARTED NOW </button></a>

									<a onclick="getMyOS()" class="mobile-signup"><button
										class="subscribe-btn">GET STARTED NOW </button></a>
						</div>
									<p class="pt-2">Available on the App Store and Google Play</p>
								</div>
								<div class="footer-app mt-4">

									<a target="_blank" href="https://apps.apple.com/in/app/letsfame/id6444732920">
										<div class="phoneapp"><img src="../assets/img/ios.svg" alt="appstore logo" title="appstore logo" class="img-fluid mb-2"></div>
									</a>
									<a target="_blank" href="https://play.google.com/store/apps/details?id=com.letsfame.app">
										<div class="phoneapp"><img src="../assets/img/android.svg" alt="playstore logo" title="playstore logo" class="img-fluid mb-2">
										</div>
									</a>

								</div>
								<div class="follow pt-3">Follow us on :
									<span><a target="_blank" href="https://www.facebook.com/letsfameapp"><img class="socico"
										src="../assets/img/fb.svg" alt="facebook logo" title="facebook logo"></a></span>
										<span><a target="_blank" href="https://www.linkedin.com/company/letsfame/"><img class="socico"
										src="../assets/img/linkedin.png" alt="linkedin logo" title="linkedin logo"></a></span>
										<span><a target="_blank"
											href="https://www.instagram.com/letsfameapp/"><img
											class="socico" src="../assets/img/insta.svg" alt="instagram logo" title="instagram logo"></a></span>
											<span><a target="_blank" href="https://twitter.com/letsfameapp"><img class=""
												style="width: 25px;" src="../assets/img/twitter.svg" alt="twitter logo" title="twitter logo"></a></span>
												<span><a target="_blank"
													href="https://www.youtube.com/channel/UCKhIRTOi86I_B9ZSp9evAAg/featured"><img class=""
													style="width: 25px;" src="../assets/img/youtube.svg" alt="youtube logo" title="youtube logo"></a></span>
												</div>
											</div>
										</div>
									</div>
								</section>
								<section class="copysection center">
									<p>Copyright © <span id="year">2024</span> LetsFAME. <span class="rights">All Rights Reserved.</span>
									</p>
</section>
<!--FOOTER END---->

</body>
	
<script>

document.querySelectorAll(".nav-link").forEach((link) => {
        if (link.href === window.location.href) {
            link.classList.add("active");
            link.setAttribute("aria-current", "page");
        } else {
            var homeLink = document.querySelector(".navbar-nav .nav-item .nav-link[href='index']");
            if (homeLink && window.location.pathname.endsWith('/')) {
                homeLink.classList.add("active");
                homeLink.setAttribute("aria-current", "page");
            }
        }
    });

	</script>
	
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