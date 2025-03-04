		
		<header id="header" class="fixed-top d-flex align-items-center">
			<nav id="lt-navbar" class="navbar navbar-expand-lg fixed-top text-white"
			style="background-color: #000000; color: #ffffff !important; padding: 17px 0px;">
			<div class="container-fluid d-flex align-items-center px-3">
				<div class="logo me-auto"><a href="index"><img src="assets/img/logo.png" alt="logo" title="logo"
					class="img-fluid"></a></div>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#collapsibleNavbar">
					<i class="fa-solid fa-bars text-white"></i>
				</button>

				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item pt-2">
							<a href="http://karupa.shajaw350.world/" class="nav-link">Home</a>
						</li>
						<li class="nav-item pt-2">
							<a href="aboutus" class="nav-link">About Us</a>
						</li>
						<li class="nav-item pt-2">
							<a href="how-its-work" class="nav-link">How its Works</a>
						</li>
						<li class="nav-item pt-2">
							<a href="plans" class="nav-link">Plans</a>
						</li>
						<!-- <li class="nav-item pt-2">
							<a href="book-artist" class="nav-link">Book Artist</a>
						</li> -->
						<li class="nav-item pt-2">
							<a href="why-use-letsfame" class="nav-link">Read Our Blog</a>
						</li>
						<li class="nav-item pt-2">
							<a href="faq" class="nav-link">FAQ</a>
						</li>
						<li class="nav-item pt-2">
							<a href="contact-us" class="nav-link">Contact Us</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- </div> -->
	</header>
	
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
