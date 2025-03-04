   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <style>
  .submenu-content {
    display: none;
    list-style: none;
    padding-left: 20px;
}

.submenu-content li {
    margin-bottom: 5px;
}

.submenu .submenu-toggle {
    cursor: pointer;
}
.submenu-content .active a {
    color: #D49A5B !important;
    // border-left: 3px solid #D49A5B !important;
   // background: #D49A5B1a !important;
}
.sidebar-nav ul li ul {
    padding-left: 4px !important;
}
.sidebar-nav ul li ul li a {
    padding: 7px 35px 7px 35px !important;
}
.dataTables_wrapper .dataTables_filter input {
   
    margin-bottom: 10px !important;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    margin-top: 10px  !important;
}


.submenu .submenu-toggle.active + .submenu-content {
    display: block;
}

</style>
    <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
					 <?php
					 $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
					 <?php if($_SESSION['user_type'] == '1' || $_SESSION['user_type'] == '2'  || $_SESSION['user_type'] == '3'){ ?>
                         <li class="<?= ($activePage == 'admin_dashboard') ? 'active':''; ?>">
                            <a class="waves-effect waves-dark" href="admin_dashboard.php" aria-expanded="false">
                                <i class="fas fa-chart-pie text-info"></i>
                                <span class="hide-menu fw-bold text-info">Dash Board</span>
                            </a>
                        </li> 
					 <?php } ?>
					  <?php if($_SESSION['user_type'] == '1' || $_SESSION['user_type'] == '2'){ ?>
                         <li class="<?= ($activePage == 'blog') ? 'active':''; ?>">
                            <a class="waves-effect waves-dark" href="blog.php" aria-expanded="false">
								<i class="ti-layout-media-right-alt"></i>      
								<span class="hide-menu fw-bold text-info">Blog</span>
                            </a>
                        </li>
						<?php } ?>
					<?php if($_SESSION['user_type'] == '1' || $_SESSION['user_type'] == '3'){ ?>						
						<li class="submenu <?= ($activePage == 'contact-us') ? 'active' : ''; ?>">
							<a href="#" class="submenu-toggle has-arrow waves-effect waves-dark" style="color: #D49A5B !important;font-weight: 700 !important;">
								<i class="fa fa-cog" aria-hidden="true"></i> 
								<span>Enquiry List</span>
							</a>
							<ul class="submenu-content" style="<?= ($activePage == 'contact-us') ? 'display: block;' : 'display: none;'; ?>">
								<li class="<?= ($activePage == 'contact-us') ? 'active' : ''; ?>">
									<a href="contact-us.php">Contact us</a>
								</li>
								<li class="<?= ($activePage == 'ads') ? 'active' : ''; ?>">
									<a href="ads.php">Ads</a>
								</li>
								<li class="<?= ($activePage == 'pk') ? 'active' : ''; ?>">
									<a href="pk.php">pk</a>
								</li>
								<li class="<?= ($activePage == 'short_film') ? 'active' : ''; ?>">
									<a href="short_film.php">Short Film Contest
</a>
								</li>
							</ul>
						</li>
						<li class="<?= ($activePage == 'blog') ? 'active':''; ?>">
                            <a class="waves-effect waves-dark" href="artist.php" aria-expanded="false">
								<i class="ti-layout-media-right-alt"></i>      
								<span class="hide-menu fw-bold text-info">Artist</span>
                            </a>
                        </li>					
						<li class="<?= ($activePage == 'blog') ? 'active':''; ?>">
                            <a class="waves-effect waves-dark" href="book_artist.php" aria-expanded="false">
								<i class="ti-layout-media-right-alt"></i>      
								<span class="hide-menu fw-bold text-info">Book Artist</span>
                            </a>
                        </li>	
                        	<li class="<?= ($activePage == 'blog') ? 'active':''; ?>">
                            <a class="waves-effect waves-dark" href="company.php" aria-expanded="false">
								<i class="ti-layout-media-right-alt"></i>      
								<span class="hide-menu fw-bold text-info">Company</span>
                            </a>
                        </li>
					<?php } ?>
					</ul>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
		
		
<script>
	$(document).ready(function () {
    // Toggle submenu on click
    $('.submenu-toggle').on('click', function (e) {
        e.preventDefault();
        const submenu = $(this).next('.submenu-content');
        submenu.slideToggle();
        $(this).toggleClass('active');
    });

    // Automatically open submenus with active links
    $('.submenu-content .active').closest('.submenu-content').show();
    $('.submenu-content .active').closest('.submenu').find('.submenu-toggle').addClass('active');
});


</script>		