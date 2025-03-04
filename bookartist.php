<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LetsFAME - Book Artist</title>
    <link rel="shortcut icon" href="assets/img/favicon.ico">
    <meta name="robots" content="index, follow" />\
    <link rel="canonical" href="https://www.letsfame.com/book-artist">
    <link rel="alternate" href="https://www.letsfame.com/book-artist" hreflang="en-us">

    <!-- Style CSS Start -->
    <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/book-artist/font.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/book-artist/lt-style.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-header.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-artist.scss">

    <!-- Scripts -->
    <script src="assets/js/bootstrap.bundle.min.js" defer></script>

    <script type="module" src="assets/js/book-artist/dist/list-artists.js" defer></script>
    <script type="module" src="assets/js/book-artist/dist/common.js" defer></script>

</head>

<style>
    body {
        background: radial-gradient(circle, rgba(92, 28, 48, 1), rgba(19, 4, 72, 1));
        font-family: "Montserrat", serif !important;

    }

    .spinner-overlay {
        background: rgba(0, 0, 0, 0.5);
    }
</style>

<body>
    <div id="spinnerOverlay" class="spinner-overlay d-none">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div> <span class="text-warning ms-2">Loading...</span>
    </div>

    <header class="lt-header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light text-dark">
            <div class="container-fluid d-flex align-items-center justify-content-between px-3">

                <div class="title d-flex align-items-center">
                    <a href="index" class="hover-rounded">
                        <i class="bi bi-arrow-left me-2"></i>
                    </a>
                    <span>Book Artists</span>
                </div>

                <div class="search-container w-100">
                    <div class="input-container position-relative">
                        <input type="text" class="form-control ps-3" placeholder="Search" id="searchInput"
                            onkeydown="searchArtist(event)">
                        <i class="bi bi-search search-icon position-absolute top-50 start-1 translate-middle-y"></i>
                        <i class="bi bi-x-circle clear-icon position-absolute end-0 translate-middle-y d-none cursor-pointer"
                            onclick="clearSearch()" id="clearButton"></i>
                    </div>
                </div>
            </div>
        </nav>
        <div id="tabs-container" class="pt-2 bg-white w-100"></div>
    </header>
    <div class="container lt-artist-container" id="tab-content-container">
        
    </div>

    <!-- <div class="modal fade" id="professionModal" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered request-dialog">
            <div class="modal-content text-center p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="customModalLabel">Profession</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div> -->
    <div id="alertIcon" class="alert-icon">
        <i class="bi bi-arrow-up fw-bold"></i>
    </div>
</body>

</html>