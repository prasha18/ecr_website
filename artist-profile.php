<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Letsfame - Artist Profile</title>
    <!-- Style CSS Start -->
    <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/book-artist/lt-style.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-artist.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-modal.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-slider.scss">
    <link rel="stylesheet" href="assets/css/book-artist/lt-request.scss">
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <script src="assets/js/bootstrap.bundle.min.js" defer></script>
    <script type="module" src="assets/js/book-artist/dist/artist-profile.js" defer></script>
    <script type="module" src="assets/js/book-artist/dist/common.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<style>
    body {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #333;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat Regular', sans-serif !important;
        height: 100vh;
        display: flex;
        overflow-x: hidden;
    }

    .border-end {
        border-right: 6px solid #ad9b9b !important;
    }
</style>

<body>
    <div id="spinnerOverlay" class="spinner-overlay d-none">
        <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div> <span class="text-warning ms-2">Loading...</span>
    </div>

    <div id="lt-profile-container" class="lt-profile-container">
        <div class="row position-relative" id="lt-cover">
        </div>
        <div class="row position-relative lt-profile-bg">
            <div class="lt-profile-image position-absolute" id="lt-profile-img"></div>
            <!-- <div class="col-md-4" id="lt-profile-info"></div> -->
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-10 offset-md-1 d-flex justify-content-center align-items-center" id="lt-profile-info">
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-2 py-4">
                <div id="lt-bio"></div>
                <h5 class="text-white fw-bold ls px-3 mb-3">Portfolio</h5>
                <div class="row w-100" id="lt-portfolio">
                    <div class="col-md-6 border-end" id="lt-port-vid">
                        <div class="d-flex justify-content-start align-items-center fs-4 px-3 mb-3">
                            <img src="assets/img/book-artist/showreel.svg" class="me-1" width="25px" alt="Showreel Icon"
                                title="Showreel Icon" loading="lazy" draggable="false">
                            <span class="lt-title fs-6">Showreel</span>
                        </div>
                        <div class="lt-scrollable-container portfolio-container pt-1" id="lt-portfolio-videos"></div>
                    </div>
                    <div class="col-md-6" id="lt-port-img">
                        <div class="d-flex justify-content-start align-items-center fs-4 px-3 mb-3">
                            <img src="assets/img/book-artist/photo.svg" class="me-1" width="25px" alt="Showreel Icon"
                                title="Showreel Icon" loading="lazy" draggable="false">
                            <span class="lt-title fs-6">Photos</span>
                        </div>
                        <div class="lt-scrollable-container portfolio-container pt-1" id="lt-portfolio-images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lt-form-modal d-none" id="lt-profile-modal">
        <div class="lt-form-content" style="align-items: center;">
            <div class="text-end lt-close-btn">
                <i class="bi bi-x text-white fs-4 cursor-pointer" onclick="closeImageModal()"></i>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row p-0">
                        <img id="lt-modal-image" loading="lazy" draggable="false" src="" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- REQUEST MODAL STARTS HERE -->
    <div class="modal fade" id="requestModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered position-relative mt-5">
            <div class="modal-content px-4 py-2">
                <button type="button" class="btn-close lt-btn-close rounded-circle" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body">
                    <h5 class="fw-bold">Enter Details About You</h5>
                    <label for="type" class="col-form-label pb-0 mb-1 pb-0 mb-1">Are You Individual or Company</label>
                    <div class="row">
                        <div class="d-block d-flex gap-3">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="type" id="individual"
                                    value="Individual" onchange="toggleFields('individual')" checked>
                                <label class="form-check-label" for="radio1">
                                    Individual
                                </label>
                            </div>
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="type" id="company" value="Company"
                                    onchange="toggleFields('company')">
                                <label class="form-check-label" for="radio2">
                                    Company
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="name-input">
                        <label for="name" class="col-form-label pb-0 mb-1 ">What is Your Name </label>

                        <div class="mb-2 position-relative">
                            <i class="bi bi-person lt-input-icon fs-5 ms-3 position-absolute"
                                style="left: 15px; top: 50%; transform: translateY(-50%);"></i>
                            <input type="text" class="form-control form-control-sm ps-5 rounded-input" id="name"
                                placeholder="Name" autocomplete="off" oninput="handleInput('name', 'nameError')" />
                        </div>
                        <span class="text-danger small" id="nameError" style="display: none;">Name is required.</span>
                    </div>


                    <div class="row" style="display: none" id="company-input">
                        <label for="name" class="col-form-label pb-0 mb-1">What is Your Company Name? </label>
                        <div class="mb-2 position-relative">
                            <i class="bi bi-person lt-input-icon fs-5  ms-3"></i>
                            <input type="text" class="form-control form-control-sm ps-5 rounded-input" id="companyName"
                                placeholder="Company Name" autocomplete="off"
                                oninput="handleInput('companyName', 'companyNameError')" />
                        </div>
                        <span class="text-danger small" id="companyNameError" style="display: none;">Company Name is
                            required.</span>
                    </div>

                    <div class="row">
                        <label for="mobileno" class="col-form-label pb-0 mb-1">What is Your Phone Number </label>
                        <div class="mb-2 position-relative">
                            <div class="d-flex align-items-center position-relative">
                                <img src="assets/img/book-artist/phone.svg" loading="lazy" alt="phone" title="phone"
                                    width="14px" class="position-absolute top-50 translate-middle-y phone-icon"
                                    draggable="false" />
                                <select id="countryCode"
                                    class="form-select form-select-sm position-absolute start-0 h-100"
                                    onchange="changeMobile()">
                                    <option></option>
                                </select>

                                <input type="tel" class="form-control form-control-sm rounded-input" id="mobileno"
                                    placeholder="Phone Number" autocomplete="off" style="padding-left: 110px;"
                                    oninput="handleInput('mobileno', 'phoneError'), handleMobile()" />
                            </div>

                            <img src="assets/img/book-artist/verified-icon.svg" loading="lazy" alt="phone" title="phone"
                                width="18px" class="position-absolute top-50 translate-middle-y verified-icon"
                                id="verifiedIcon" draggable="false" />
                        </div>
                        <span class="text-danger small" id="phoneError" style="display: none;">Phone Number is
                            required.</span>
                    </div>

                    <div class="row">
                        <label for="email" class="col-form-label pb-0 mb-1">What is Your Email ID </label>
                        <div class="mb-2 position-relative">
                            <i class="bi bi-envelope lt-input-icon fs-5 ms-3"></i>
                            <input type="email" class="form-control form-control-sm me-2 px-5 rounded-input" id="email"
                                placeholder="Ex: yourname@example.com" autocomplete="off" onfocus="sendOTP()"
                                oninput="handleInput('email', 'emailError')" />
                        </div>
                        <span class="text-danger small" id="emailError" style="display: none;">Email ID is
                            required.</span>
                    </div>

                    <!-- <div class="row" id="dob-input">
                        <label for="age" class="col-form-label pb-0 mb-1">What is Your Age </label>
                        <div class="mb-2 position-relative">
                            <i class="bi bi-calendar4 lt-input-icon fs-5 ms-3"></i>
                            <input type="text" class="form-control form-control-sm ps-5 rounded-input" id="dob"
                                placeholder="Date Of Birth" style="padding-left: 40px" autocomplete="off"
                                onchange="handleInput('dob', 'dobError')" onfocus="sendOTP()" />
                        </div>
                        <span class="text-danger small" id="dobError" style="display: none;">Age is required.</span>
                    </div> -->

                    <div class="row" style="display: none" id="designation-input">
                        <label for="email" class="col-form-label pb-0 mb-1">What is Your Designation in the Company?
                        </label>
                        <div class="mb-2 position-relative">
                            <img src="assets/img/book-artist/designation.svg" loading="lazy" width="19px"
                                class="ms-3 lt-input-icon" alt="designation" title="designation" draggable="false" />
                            <input type="text" class="form-control form-control-sm me-2 px-5 rounded-input"
                                id="designation" placeholder="Your Designation" autocomplete="off"
                                oninput="handleInput('designation', 'designationError')" onfocus="sendOTP()" />
                        </div>
                        <span class="text-danger small" id="designationError" style="display: none;">Designation is
                            required.</span>
                    </div>

                    <div class="row" style="display: none" id="linkedin-input">
                        <label for="linkedInUrl" class="col-form-label pb-0 mb-1">Your LinkedIn Profile URL (If
                            Any)</label>
                        <div class="mb-2 position-relative">
                            <i class="bi bi-link-45deg lt-input-icon fw-normal fs-4 ms-3"></i>
                            <input type="url" class="form-control form-control-sm me-2 px-5 rounded-input"
                                id="linkedInUrl" placeholder="Ex: https://www.linkedin.com/" autocomplete="off"
                                oninput="handleInput('linkedInUrl', 'linkedInUrlError')" onfocus="sendOTP()" />
                        </div>
                        <span class="text-danger small" id="linkedInUrlError" style="display: none;">Please enter the
                            valid url.</span>
                    </div>

                    <div class="row" id="letsfame-input">
                        <label for="letsfameUrl" class="col-form-label pb-0 mb-1">Your LetsFame Profile URL (If
                            Any)</label>
                        <div class="mb-2 position-relative">
                            <i class="bi bi-link-45deg lt-input-icon fw-normal fs-4 ms-3"></i>
                            <input type="url" class="form-control form-control-sm me-2 px-5 rounded-input"
                                id="letsfameUrl" placeholder="Ex: https://www.letsfame.com/" autocomplete="off"
                                onfocus="sendOTP()" oninput="handleInput('letsfameUrl', 'letsfameUrlError')" />
                        </div>
                        <span class="text-danger small" id="letsfameUrlError" style="display: none;">Please enter
                            the valid url.</span>
                    </div>

                    <div class="mb-2">
                        <label for="reason" class="col-form-label pb-0 mb-1">Why You Want to Book This Artist </label>
                        <textarea class="form-control form-control-sm" rows="2" id="reason" autocomplete="off"
                            placeholder="Ex : Have been working for 10 years as a cinematographer ...."
                            oninput="handleInput('reason', 'reasonError')" onfocus="sendOTP()"></textarea>
                    </div>
                    <span class="text-danger small mb-2" id="reasonError" style="display: none;">Reason is
                        required.</span>

                    <!-- <div id="recaptcha-container"></div> -->
                    <!-- <div class="g-recaptcha" data-sitekey="6Ldf0qQqAAAAAG5vdH_FfhI64sw5mkM7Ml_aKKJe"></div> -->

                    <!-- <div class="g-recaptcha" data-sitekey="6Ldf0qQqAAAAAG5vdH_FfhI64sw5mkM7Ml_aKKJe"></div> -->

                    <div class="d-flex">
                        <button type="submit" class="btn btn-light w-100 fw-bold" onclick="submitRequest()">
                            <span id="confirm-btn">CONFIRM MY REQUEST</span>
                            <div id="spinner-text" class="spinner-border spinner-border-sm text-warning d-none"
                                role="status"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- REQUEST MODAL STARTS HERE -->

    <!-- OTP MODAL STARTS HERE -->
    <div class="modal fade" id="otpModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        style="background-color: rgba(72, 68, 68, 0.9);">
        <div class="modal-dialog  position-relative mt-5 d-flex justify-content-center align-items-center">
            <div class="modal-content bg-color px-4 py-3 text-center mt-5">
                <div class="modal-body otp">
                    <h5 class="fw-bold text-light">Verify OTP</h5>
                    <img src="assets/img/book-artist/otp-mobile.svg" loading="lazy" alt="Otp mobile" title="Otp mobile"
                        width="80px" class="my-3" draggable="false">
                    <p class="text-light">Please enter the OTP sent to your mobile number
                        <span class="fw-bold" id="otp-mobile"></span>
                    </p>
                    <div class="d-flex justify-content-center gap-3 my-3 input-color">
                        <input type="text" class="form-control otp-text text-center fs-4" maxlength="1"
                            oninput="moveFocus(this, 1)" onkeydown="handleBackspace(event, 1)" />
                        <input type="text" class="form-control otp-text text-center fs-4" maxlength="1"
                            oninput="moveFocus(this, 2)" onkeydown="handleBackspace(event, 2)" />
                        <input type="text" class="form-control otp-text text-center fs-4" maxlength="1"
                            oninput="moveFocus(this, 3)" onkeydown="handleBackspace(event, 3)" />
                        <input type="text" class="form-control otp-text text-center fs-4" maxlength="1"
                            oninput="moveFocus(this, 4)" onkeydown="handleBackspace(event, 4)" />
                        <input type="text" class="form-control otp-text text-center fs-4" maxlength="1"
                            oninput="moveFocus(this, 5)" onkeydown="handleBackspace(event, 5)" />
                    </div>

                    <p class="text-danger mb-3 fw-bold" id="verificationError" style="display: none;">
                        <i class="bi bi-exclamation-circle-fill text-danger"></i>
                        Verification failed! Please enter the correct OTP
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <button class="btn btn-light w-100 my-1 fw-bold py-2 verify-btn" onclick="verifyOTP()">
                            <span id="otp-confirm-btn">Verify OTP</span>
                            <div id="otp-spinner-text" class="spinner-border spinner-border-sm text-warning d-none"
                                role="status"></div>
                        </button>
                        <!-- <button class="btn btn-light w-100 my-1 fw-bold py-2 verify-btn" onclick="verifyOTP()">Verify
                            OTP</button> -->
                    </div>
                    <button class="btn btn-transparent border border-white mt-3 w-100 fw-bold py-2 mb-2"
                        id="resendOtpButton" onclick="triggerOTP()">Resend OTP</button>
                    <span class="cursor-pointer text-decoration-underline" onclick="handleWrongNo()">Entered a wrong
                        number?</span>
                </div>
            </div>
        </div>
    </div>
    <!-- OTP MODAL ENDS HERE -->

    <!-- SUCCESS MODAL STARTS HERE -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="customModalLabel">
        <div class="modal-dialog modal-dialog-centered request-dialog">
            <div class="modal-content text-center p-4">
                <img src="assets/img/book-artist/request-tick.svg" alt="request-tick" class="img-fluid mx-auto "
                    style="width: 100px;" loading="lazy" title="request-tick" draggable="false">
                <p class="fw-bold m-0 fs-5 pt-4">We Have Received </p>
                <p class="fw-bold m-0 fs-5 mb-2">Your Request</p>
                <p class="mb-4">Our Team Will Contact You Shortly</p>
                <button class="btn btn-lg btn-light mb-3 " data-bs-dismiss="modal" onclick="refreshPage()">OK</button>
            </div>
        </div>
    </div>
    <!-- Modal Structure -->
    <div class="modal" id="sliderModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-none">
                <div class="lt-media-slider">
                    <i class="bi bi-x-lg lt-close-button" onclick="hideModal('sliderModal')"></i>

                    <i class="bi bi-caret-left-fill fs-1 lt-prev-button" id="lt-prev-button" onclick="previous()"></i>

                    <div class="lt-media-container" id="lt-slider-media"></div>

                    <i class="bi bi-caret-right-fill fs-1 lt-next-button" id="lt-next-button" onclick="next()"></i>
                </div>
            </div>
        </div>
    </div>

    <div id="alertIcon" class="alert-icon">
        <i class="bi bi-arrow-up fw-bold"></i>
    </div>

    <!-- SUCCESS MODAL ENDS HERE -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- <script src="https://www.google.com/recaptcha/api.js?render=6Ldf0qQqAAAAAG5vdH_FfhI64sw5mkM7Ml_aKKJe" async defer></script> -->

</body>

</html>