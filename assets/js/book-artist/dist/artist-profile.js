var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// declare const grecaptcha: any;
// class RecaptchaHandler {
//     verifyCallback(response: string) {
//         console.log('reCAPTCHA Response Token:', response);
//     }
//     renderRecaptcha() {
//         grecaptcha.render('recaptcha-container', {
//             sitekey: '6Ldf0qQqAAAAAG5vdH_FfhI64sw5mkM7Ml_aKKJe',
//             callback: (response: string) => this.verifyCallback(response),
//         });
//     }
// }
// const handler = new RecaptchaHandler();
// handler.renderRecaptcha();
// const apiUrl = 'https://lafs-atv.com/letsfame-admin';
const apiUrl = 'https://www.letsfame.com';
let images = [];
let videos = [];
let img_idx = 0;
let vid_idx = 0;
let data = null;
let artist_id = '';
const renderPortfolioItems = (userProfile, id) => {
    images = [...userProfile.portfolio.IMAGES];
    videos = [...userProfile.portfolio.VIDEOS];
    const portfolioItemsContainer = document.getElementById(id);
    if (portfolioItemsContainer) {
        const mediaRow = document.createElement('div');
        mediaRow.classList.add('lt-scrollable-row', 'row');
        if (id === 'lt-portfolio-images') {
            if (userProfile.portfolio.IMAGES.length > 0) {
                userProfile.portfolio.IMAGES.forEach((media, index) => {
                    const mediaDiv = document.createElement('div');
                    if (userProfile.portfolio.VIDEOS.length === 0) {
                        if (userProfile.portfolio.IMAGES.length > 1) {
                            mediaDiv.classList.add('col-md-3', 'pb-1', 'px-2', 'lt-showreel-item', 'position-relative');
                        }
                        else {
                            mediaDiv.classList.add('col-md-3', 'pb-1', 'px-2', 'lt-single-item', 'position-relative');
                        }
                    }
                    else {
                        if (userProfile.portfolio.IMAGES.length > 1) {
                            mediaDiv.classList.add('col-md-6', 'pb-1', 'px-2', 'lt-showreel-item', 'position-relative');
                        }
                        else {
                            mediaDiv.classList.add('col-md-6', 'pb-1', 'px-2', 'lt-single-item', 'position-relative');
                        }
                    }
                    if (mediaDiv) {
                        mediaDiv.innerHTML = `
                            <img id="portfolio-image-${index}" src="${media.url}" alt="Portfolio Image" 
                                title="Portfolio Image" draggable="false" class="lt-portfolio-img">
                            <p class="small lt-post-caption">${(media === null || media === void 0 ? void 0 : media.name) ? media.name : ""}</p>
                        `;
                        setTimeout(() => {
                            const imageElement = document.getElementById(`portfolio-image-${index}`);
                            if (imageElement) {
                                imageElement.addEventListener('click', () => openSlider(index, 'IMAGE'));
                            }
                        }, 0);
                    }
                    mediaRow.appendChild(mediaDiv);
                });
            }
        }
        else {
            userProfile.portfolio.VIDEOS.forEach((media, index) => {
                const mediaDiv = document.createElement('div');
                if (userProfile.portfolio.IMAGES.length === 0) {
                    if (userProfile.portfolio.VIDEOS.length > 1) {
                        mediaDiv.classList.add('col-md-3', 'px-2', 'pb-1', 'lt-showreel-item', 'position-relative');
                    }
                    else {
                        mediaDiv.classList.add('col-md-3', 'px-2', 'pb-1', 'lt-single-item', 'position-relative');
                    }
                }
                else {
                    if (userProfile.portfolio.VIDEOS.length > 1) {
                        mediaDiv.classList.add('col-md-6', 'px-2', 'pb-1', 'lt-showreel-item', 'position-relative');
                    }
                    else {
                        mediaDiv.classList.add('col-md-6', 'px-2', 'pb-1', 'lt-single-item', 'position-relative');
                    }
                    // if (userProfile.portfolio.VIDEOS.length > 4) {
                    //     const portfolioVid = document.getElementById('lt-port-vid') as HTMLDivElement;
                    //     portfolioVid.classList.remove('border-end');
                    // }
                }
                if (mediaDiv) {
                    mediaDiv.innerHTML = `
                        <img src="${media.type === 'VIDEO' ? media.thumbnails : media.url}" alt="Portfolio Image" title="Portfolio Image" 
                            draggable="false" class="lt-portfolio-img">
                        ${media.type === 'VIDEO' ? `
                            <div class="lt-video-btn text-center" id="portfolio-video-${index}">
                                <img class="w-100 cursor-pointer" src="assets/img/book-artist/play.svg" 
                                    alt="Portfolio Video Thumbnail" title="Portfolio Video Thumbnail" 
                                    draggable="false" />
                            </div>` : ''}
                        <p class="small lt-post-caption">${(media === null || media === void 0 ? void 0 : media.name) ? media.name : ""}</p>
                    `;
                    setTimeout(() => {
                        const videoElement = document.getElementById(`portfolio-video-${index}`);
                        if (videoElement) {
                            videoElement.addEventListener('click', () => openSlider(index, 'VIDEO'));
                        }
                    }, 0);
                }
                mediaRow.appendChild(mediaDiv);
            });
        }
        portfolioItemsContainer.appendChild(mediaRow);
    }
};
const bindData = (data) => {
    var _a, _b, _c, _d, _e, _f, _g, _h, _j, _k, _l;
    const coverImageContainer = document.getElementById("lt-cover");
    if (!coverImageContainer) {
        console.error("cover image container not found");
        return;
    }
    const coverImageHTML = `<div class="position-relative">
                <img src="${data === null || data === void 0 ? void 0 : data.cover_image}" onclick="openImageModal('${(data === null || data === void 0 ? void 0 : data.cover_image) || ''}')"
                    class="lt-cover-img" alt="Cover Image" title="Cover Image"  draggable="false">
                    
                <div class="position-absolute top-0 start-2 p-3">
                    <a href="bookartist" class="hover-rounded text-white">
                        <i class="bi bi-arrow-left fs-3"></i>
                    </a>
                </div>
            </div>`;
    coverImageContainer.innerHTML = coverImageHTML;
    const profileImageContainer = document.getElementById("lt-profile-img");
    if (!profileImageContainer) {
        console.error("profile image container not found");
        return;
    }
    const profileImageHTML = `<img src="${data === null || data === void 0 ? void 0 : data.profile_image}" class="lt-profile-img" alt="Profile Image"
                           onclick="openImageModal('${(data === null || data === void 0 ? void 0 : data.profile_image) || ''}')"  title="Profile Image"  draggable="false">`;
    profileImageContainer.innerHTML = profileImageHTML;
    const profileInfoContainer = document.getElementById("lt-profile-info");
    if (!profileInfoContainer) {
        console.error("Profile info container not found");
        return;
    }
    //     <div class="d-flex justify-content-between align-items-center gap-3 px-5 pt-4 w-100">
    //     <div class="d-flex align-items-center gap-3 w-100">
    //         <img src="assets/img/book-artist/social-media/${icon}.svg" 
    //             alt="${platform} Icon" 
    //             title="${platform} Icon" 
    //             draggable="false" 
    //             width="${icon === 'twitter' ? '35px' : '40px'}" 
    //             height="${icon === 'twitter' ? '35px' : '40px'}">
    //         <img src="${accountInfo?.img}" 
    //             alt="${platform} Profile Image" 
    //             title="${platform} Profile" 
    //             draggable="false" 
    //             width="40px" 
    //             height="40px" 
    //             class="rounded-circle">
    //         <div class="d-flex text-start flex-column">
    //             <a href="${accountInfo?.url}" target="_blank" class="text-decoration-none text-white">
    //                 <span class="fw-bold" title="${accountInfo?.url}">${accountInfo?.name?.length <= 25 ? accountInfo?.name : accountInfo?.name.substring(0, 10) + "..."}</span>
    //                 </a>
    //                 <span class="lt-yellow small fw-bold"> ${accountInfo?.followers || 0} ${icon === "youtube" ? "Subscribers" : "Followers"}</span>
    //         </div>
    //     </div>
    // </div>
    const renderSocialMedia = (icon, platform, accountInfo, profile_image) => {
        var _a;
        return `
            <div class="d-flex justify-content-between align-items-center gap-3 px-5 pt-4 w-100">
                <div class="d-flex align-items-center gap-3 w-75">
                    <img src="assets/img/book-artist/social-media/${icon}.svg" 
                        alt="${platform} Icon" 
                        title="${platform} Icon" 
                        draggable="false" 
                        width="40px" 
                        height="40px">
                        
                    <img src="${(accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.img) || profile_image}" 
                        alt="${accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.name} Profile Image" 
                        draggable="false" 
                        title="${accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.name}"
                        width="40px" 
                        height="40px" 
                        class="rounded-circle">
                        
                    <span class="fw-bold"  title="${accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.url}">${((_a = accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.name) === null || _a === void 0 ? void 0 : _a.length) <= 10 ? accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.name : (accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.name.substring(0, 10)) + "..."}</span>
                </div>

                <div class="d-flex flex-column align-items-center text-center w-25">
                    <span class="lt-yellow fw-bold">${(accountInfo === null || accountInfo === void 0 ? void 0 : accountInfo.followers) || 0}</span>
                    <span class="text-white" style="font-size: 0.9rem;">${icon === "youtube" ? "Subscribers" : "Followers"}</span>
                </div>
            </div>
        `;
    };
    // const renderSocialMedia = (icon: string, platform: string, accountInfo: AccountInfo) => {
    //     return `
    //         <div class="d-flex justify-content-between align-items-center">
    //             <!-- Left Section -->
    //             <div class="d-flex align-items-center gap-3 flex-grow-1">
    //                 <img src="assets/img/book-artist/social-media/${icon}.svg" 
    //                     alt="${platform} Icon" 
    //                     title="${platform} Icon" 
    //                     draggable="false" 
    //                     width="${icon === 'twitter' ? '35px' : '40px'}" 
    //                     height="${icon === 'twitter' ? '35px' : '40px'}">
    //                 <img src="${accountInfo?.img}" 
    //                     alt="${accountInfo?.name} Profile Image" 
    //                     draggable="false" 
    //                     title="${accountInfo?.name}"
    //                     width="40px" 
    //                     height="40px" 
    //                     class="rounded-circle">
    //                 <a href="${accountInfo?.url}" target="_blank" class="text-decoration-none text-white flex-grow-1" style="min-width: 150px; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
    //                     <span class="fw-bold" title="${accountInfo?.url}">${accountInfo?.name || 'Unknown'}</span>
    //                 </a>
    //             </div>
    //             <!-- Right Section -->
    //             <div class="d-flex align-items-center justify-content-center w-25 text-center">
    //                 <div>
    //                     <span class="lt-yellow fw-bold d-block" style="min-width: 60px;">${accountInfo?.followers || 0}</span>
    //                     <span class="text-white" style="font-size: 0.9rem;">${icon === "youtube" ? "Subscribers" : "Followers"}</span>
    //                 </div>
    //             </div>
    //         </div>
    //     `;
    // };
    const profileInfoHTML = `
        <div class="text-center text-white">
    <!-- Artist Name -->
    <h5 class="lt-title ls">${(data === null || data === void 0 ? void 0 : data.name) || 'Artist Name'}</h5>

    <!-- Artist Profession and Location -->
    <h6 class="lt-subtitle">
        ${(data === null || data === void 0 ? void 0 : data.profession) || 'Profession'} 
        <i class="bi bi-dot fs-6"></i> Chennai
    </h6>

    <!-- Book Button -->
    <div class="d-flex justify-content-center mt-4">
        <button class="btn btn-md btn-warning book-btn fw-bold" style="width: 75%;" onclick="showModal('requestModal')">
            Book ${(data === null || data === void 0 ? void 0 : data.name) || 'Artist'}
        </button>
    </div>

    <!-- Social Media Section -->
        ${renderSocialMedia('instagram', 'Instagram', (_a = data === null || data === void 0 ? void 0 : data.followers) === null || _a === void 0 ? void 0 : _a.instagram, data === null || data === void 0 ? void 0 : data.profile_image)}
        ${renderSocialMedia('youtube', 'YouTube', (_b = data === null || data === void 0 ? void 0 : data.followers) === null || _b === void 0 ? void 0 : _b.youtube, data === null || data === void 0 ? void 0 : data.profile_image)}
        ${renderSocialMedia('twitter', 'Twitter', (_c = data === null || data === void 0 ? void 0 : data.followers) === null || _c === void 0 ? void 0 : _c.twitter, data === null || data === void 0 ? void 0 : data.profile_image)}

</div>

    `;
    profileInfoContainer.innerHTML = profileInfoHTML;
    const aboutInfo = document.getElementById('lt-bio');
    aboutInfo.innerHTML = `
                <div class="text-start px-3 text-white mb-3">
                    <p class="lt-title fs-6">About</p>
                    <span id="lt-biography">${data === null || data === void 0 ? void 0 : data.biography}</span>
                </div>`;
    const portfolio = document.getElementById('lt-portfolio');
    const portfolioImg = document.getElementById('lt-port-img');
    const portfolioVid = document.getElementById('lt-port-vid');
    if (!((_e = (_d = data === null || data === void 0 ? void 0 : data.portfolio) === null || _d === void 0 ? void 0 : _d.IMAGES) === null || _e === void 0 ? void 0 : _e.length) && !((_g = (_f = data === null || data === void 0 ? void 0 : data.portfolio) === null || _f === void 0 ? void 0 : _f.VIDEOS) === null || _g === void 0 ? void 0 : _g.length)) {
        // No images and no videos
        portfolio.innerHTML = `<div class=''>
                <p class="px-3 text-muted">No Data Available.</p>
            </div>`;
    }
    else {
        if (((_j = (_h = data === null || data === void 0 ? void 0 : data.portfolio) === null || _h === void 0 ? void 0 : _h.IMAGES) === null || _j === void 0 ? void 0 : _j.length) === 0) {
            portfolioImg === null || portfolioImg === void 0 ? void 0 : portfolioImg.classList.add('d-none');
            portfolioVid === null || portfolioVid === void 0 ? void 0 : portfolioVid.classList.remove('col-md-6');
            portfolioVid === null || portfolioVid === void 0 ? void 0 : portfolioVid.classList.add('col-md-12');
        }
        else if (((_l = (_k = data === null || data === void 0 ? void 0 : data.portfolio) === null || _k === void 0 ? void 0 : _k.VIDEOS) === null || _l === void 0 ? void 0 : _l.length) === 0) {
            portfolioVid === null || portfolioVid === void 0 ? void 0 : portfolioVid.classList.add('d-none');
            portfolioImg === null || portfolioImg === void 0 ? void 0 : portfolioImg.classList.remove('col-md-6');
            portfolioImg === null || portfolioImg === void 0 ? void 0 : portfolioImg.classList.add('col-md-12');
        }
        // if (!data?.portfolio?.IMAGES?.length) portfolioImg?.classList.add('d-none');
        // if (!data?.portfolio?.VIDEOS?.length) portfolioVid?.classList.add('d-none');
    }
    renderPortfolioItems(data, 'lt-portfolio-images');
    renderPortfolioItems(data, 'lt-portfolio-videos');
    console.log("Artist data : ", data);
};
function fetchDataWithBase64EncodedData() {
    const username = "LetsFamez91";
    const password = "4h1r198a14s217i18t81";
    const encodedData = btoa(username + ":" + password);
    const url = `https://dev.letsfame.com/api/v1.0/reference_data/countries?page=0&size=300`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Authorization", "Basic " + encodedData);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            const response = JSON.parse(xhr.responseText);
            const data = response.data.map((country) => country.country_code);
            const dropdown = document.getElementById("countryCode");
            dropdown.innerHTML = "";
            data.forEach((item) => {
                const option = document.createElement("option");
                option.text = "+" + item;
                option.value = item;
                dropdown.appendChild(option);
            });
            const countryCode = document.getElementById('countryCode');
            if (countryCode) {
                countryCode.value = "91";
            }
        }
        else {
            console.error("Request failed with status", xhr.status);
        }
    };
    xhr.onerror = function () {
        console.error("Network error");
    };
    // Prepare the POST data
    const postData = JSON.stringify({
        data: encodedData
    });
    xhr.send(postData);
}
fetchDataWithBase64EncodedData();
const loadProfileData = () => {
    const queryString = window.location.search;
    const params = new URLSearchParams(queryString);
    if (params) {
        artist_id = params.get('id');
    }
    const spinnerOverlay = document.getElementById('spinnerOverlay');
    const header = document.getElementById('lt-profile-container');
    spinnerOverlay.classList.remove('d-none');
    header.classList.add('d-none');
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}/api/profile_details.php?id=${artist_id}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            if ((result === null || result === void 0 ? void 0 : result.status) === true) {
                data = (result === null || result === void 0 ? void 0 : result.data) || {};
                bindData(data);
                setTimeout(() => {
                    spinnerOverlay.classList.add('d-none');
                    header.classList.remove('d-none');
                }, 1000);
            }
            else {
                window.location.href = 'bookartist';
            }
        }
        ;
    };
    xhr.onerror = function () {
        console.error("Network error");
    };
    xhr.send();
};
loadProfileData();
const next = () => {
    var _a, _b;
    img_idx = (img_idx + 1 + images.length) % images.length;
    vid_idx = (vid_idx - 1 + videos.length) % videos.length;
    // Update image if available
    const image = document.getElementById('lt-slider-image');
    if (image) {
        image.src = (_a = images[img_idx]) === null || _a === void 0 ? void 0 : _a.url;
    }
    // Update video if available
    const video = document.getElementById('lt-slider-video');
    if (video) {
        video.src = (_b = videos[vid_idx]) === null || _b === void 0 ? void 0 : _b.url;
        video.load();
    }
};
const previous = () => {
    var _a, _b;
    img_idx = (img_idx - 1 + images.length) % images.length;
    vid_idx = (vid_idx - 1 + videos.length) % videos.length;
    const image = document.getElementById('lt-slider-image');
    if (image) {
        image.src = (_a = images[img_idx]) === null || _a === void 0 ? void 0 : _a.url;
    }
    const video = document.getElementById('lt-slider-video');
    if (video) {
        video.src = (_b = videos[vid_idx]) === null || _b === void 0 ? void 0 : _b.url;
        video.load();
    }
};
const openSlider = (idx, type = 'IMAGE') => {
    const prev_btn = document.getElementById('lt-prev-button');
    const next_btn = document.getElementById('lt-next-button');
    if (type === 'IMAGE') {
        if ((images === null || images === void 0 ? void 0 : images.length) === 1) {
            if (prev_btn)
                prev_btn.classList.add('d-none');
            if (next_btn)
                next_btn.classList.add('d-none');
        }
        else {
            if (prev_btn)
                prev_btn.classList.remove('d-none');
            if (next_btn)
                next_btn.classList.remove('d-none');
        }
    }
    else {
        if ((videos === null || videos === void 0 ? void 0 : videos.length) === 1) {
            if (prev_btn)
                prev_btn.classList.add('d-none');
            if (next_btn)
                next_btn.classList.add('d-none');
        }
        else {
            if (prev_btn)
                prev_btn.classList.remove('d-none');
            if (next_btn)
                next_btn.classList.remove('d-none');
        }
    }
    const modalElement = document.getElementById("sliderModal");
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.show();
        // Delay rendering the media to ensure modal is visible
        setTimeout(() => {
            const mediaContainer = document.getElementById('lt-slider-media');
            if (!mediaContainer) {
                console.error('lt-slider-media element not found!');
                return;
            }
            mediaContainer.innerHTML = ``; // Clear existing content
            if (type === "IMAGE") {
                img_idx = idx;
                const currentMedia = images[idx];
                const imgElement = document.createElement('img');
                imgElement.src = currentMedia.url;
                imgElement.id = 'lt-slider-image';
                imgElement.classList.add('lt-slider-image');
                imgElement.alt = "Media";
                mediaContainer.appendChild(imgElement);
            }
            else if (type === "VIDEO") {
                vid_idx = idx;
                const currentMedia = videos[idx];
                const videoElement = document.createElement('video');
                videoElement.controls = true;
                videoElement.autoplay = true;
                videoElement.id = 'lt-slider-video';
                videoElement.classList.add('lt-slider-video');
                const sourceElement = document.createElement('source');
                sourceElement.src = currentMedia.url;
                sourceElement.type = 'video/mp4';
                videoElement.appendChild(sourceElement);
                mediaContainer.appendChild(videoElement);
            }
        }, 100);
    }
    else {
        console.error('Modal element not found!');
    }
};
const openImageModal = (src) => {
    const modal = document.getElementById('lt-profile-modal');
    const image = document.getElementById('lt-modal-image');
    image.src = src;
    modal.classList.remove('d-none');
    document.body.style.overflow = 'hidden';
    document.body.style.position = 'fixed';
    document.body.style.width = '100%';
};
const closeImageModal = () => {
    const modal = document.getElementById('lt-profile-modal');
    modal.classList.add('d-none');
    document.body.style.overflow = 'auto';
    document.body.style.position = 'static';
};
let verified = false;
let wrongNo = false;
const sendOTP = () => {
    const mobile = document.getElementById('mobileno');
    const countryCode = document.getElementById('countryCode');
    if (!verified) {
        if (mobile.value) {
            const otpMobile = document.getElementById('otp-mobile');
            otpMobile.innerHTML = `+${countryCode === null || countryCode === void 0 ? void 0 : countryCode.value}  ${mobile === null || mobile === void 0 ? void 0 : mobile.value}`;
            showModal('otpModal');
            triggerOTP();
        }
        else {
            mobile.focus();
        }
    }
};
const changeMobile = () => {
    verified = false;
    const verifiedIcon = document.getElementById('verifiedIcon');
    verifiedIcon.style.display = "none";
};
let remainingTime = 30;
const resendOtpButton = document.getElementById('resendOtpButton');
const triggerOTP = () => {
    var _a, _b;
    const mobile = (_a = document.getElementById('mobileno')) === null || _a === void 0 ? void 0 : _a.value;
    const code = (_b = document.getElementById('countryCode')) === null || _b === void 0 ? void 0 : _b.value;
    sendTemplateOTP(code, mobile);
    const otpInputs = document.querySelectorAll('.otp-text');
    otpInputs.forEach(input => {
        input.value = '';
    });
    resendOtpButton.disabled = true;
    let timer = setInterval(() => {
        remainingTime--;
        if (remainingTime > 0) {
            resendOtpButton.innerText = `Resend OTP (${remainingTime}s)`;
        }
        else {
            resendOtpButton.innerText = "Resend OTP";
        }
        if (remainingTime <= 0) {
            clearInterval(timer);
            resendOtpButton.disabled = false;
            remainingTime = 30;
        }
    }, 1000);
};
const sendTemplateOTP = (code, mobile) => __awaiter(void 0, void 0, void 0, function* () {
    const url = `${apiUrl}/api/${code === '91' ? 'send_otp' : 'othercountry'}.php?mobile=${code}${mobile}`;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            if (result === null || result === void 0 ? void 0 : result.status) {
                // sentOtp = otp.toString();
                console.log("data : ", result);
            }
        }
        ;
    };
    xhr.onerror = function () {
        console.error("Network error");
    };
    xhr.send();
});
const moveFocus = (currentInput, nextInputIndex) => {
    if (currentInput.value) {
        const nextInput = document.querySelectorAll('.otp-text')[nextInputIndex];
        if (nextInput) {
            nextInput.focus();
        }
    }
};
const handleBackspace = (event, index) => {
    // const inputElement = event.target as HTMLInputElement;
    if (event.key === "Backspace") {
        const input = document.querySelector(`.otp-text:nth-child(${index})`);
        if (input) {
            input.value = "";
            const previousInput = document.querySelector(`.otp-text:nth-child(${index - 1})`);
            if (previousInput) {
                previousInput.focus();
            }
        }
    }
};
const verifyOTP = () => {
    var _a, _b;
    const otpInputs = document.querySelectorAll('.otp-text');
    const mobile = (_a = document.getElementById('mobileno')) === null || _a === void 0 ? void 0 : _a.value;
    const countryCode = (_b = document.getElementById('countryCode')) === null || _b === void 0 ? void 0 : _b.value;
    const verificationError = document.getElementById('verificationError');
    verificationError.style.display = "none";
    let otp = '';
    otpInputs.forEach(input => {
        otp += input.value;
    });
    const url = `${apiUrl}/api/verifyotp.php?mobile=${countryCode}${mobile}&otp=${otp}`;
    if (otp.length === otpInputs.length) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const result = JSON.parse(xhr.responseText);
                if ((result === null || result === void 0 ? void 0 : result.status) === true && (result === null || result === void 0 ? void 0 : result.statusCode) === 200) {
                    verified = true;
                    const confirmBtn = document.getElementById('otp-confirm-btn');
                    const spinnerBtn = document.getElementById('otp-spinner-text');
                    confirmBtn.classList.add('d-none');
                    spinnerBtn.classList.remove('d-none');
                    setInterval(() => {
                        hideModal('otpModal');
                        verified = true;
                        wrongNo = false;
                        const mobileno = document.getElementById('mobileno');
                        mobileno.disabled = true;
                        const countryCode = document.getElementById('countryCode');
                        countryCode.disabled = true;
                        const verifiedIcon = document.getElementById('verifiedIcon');
                        if (verifiedIcon) {
                            verifiedIcon.style.display = "block";
                        }
                        confirmBtn.classList.remove('d-none');
                        spinnerBtn.classList.add('d-none');
                    }, 3000);
                }
                else {
                    const verificationError = document.getElementById('verificationError');
                    verificationError.style.display = "block";
                }
            }
            ;
        };
        xhr.onerror = function () {
            console.error("Network error");
        };
        xhr.send();
    }
    else {
        alert('Please fill in all the fields.');
    }
};
const toggleFields = (type) => {
    // const fields = {
    //     // individual: ['name-input', 'dob-input'],
    //     // individual: ['name-input'],
    //     company: ['company-input', 'designation-input', 'linkedin-input']
    // };
    // const allFields = ['name-input', 'company-input', 'designation-input', 'dob-input', 'linkedin-input'];
    const allFields = ['company-input', 'designation-input', 'linkedin-input'];
    allFields.forEach(id => {
        const element = document.getElementById(id);
        element.style.display = type === 'company' ? 'block' : 'none';
    });
};
const getFormData = (fields, isIndividual) => {
    const formData = { type: isIndividual ? "Individual" : "Company" };
    fields.forEach(({ id, errorId }) => handleInput(id, errorId));
    fields.forEach(({ id }) => {
        var _a;
        formData[id] = ((_a = document.getElementById(id)) === null || _a === void 0 ? void 0 : _a.value) || '';
    });
    return formData;
};
const submitRequest = () => {
    var _a;
    // const recaptchaResponse = grecaptcha.getResponse();
    // if (!recaptchaResponse) {
    //     alert('Please complete the reCAPTCHA.');
    //     return;
    // }
    const isIndividual = (((_a = Array.from(document.querySelectorAll('input[name="type"]')).find(radio => radio.checked)) === null || _a === void 0 ? void 0 : _a.value) === "Individual");
    const individualFields = [
        { id: 'name', errorId: 'nameError' },
        { id: 'mobileno', errorId: 'phoneError' },
        { id: 'email', errorId: 'emailError' },
        { id: 'countryCode', errorId: null },
        // { id: 'dob', errorId: 'dobError' },
        { id: 'letsfameUrl', errorId: 'letsfameUrlError' },
        { id: 'reason', errorId: 'reasonError' }
    ];
    const companyFields = [
        { id: 'name', errorId: 'nameError' },
        { id: 'companyName', errorId: 'companyNameError' },
        { id: 'mobileno', errorId: 'phoneError' },
        { id: 'countryCode', errorId: null },
        { id: 'email', errorId: 'emailError' },
        { id: 'designation', errorId: 'designationError' },
        { id: 'letsfameUrl', errorId: 'letsfameUrlError' },
        { id: 'linkedInUrl', errorId: 'linkedInUrlError' },
        { id: 'reason', errorId: 'reasonError' }
    ];
    const fields = isIndividual ? individualFields : companyFields;
    const data = getFormData(fields, isIndividual);
    data.actor_id = artist_id;
    console.log("Form data: ", JSON.stringify(data, null, 2));
    const requiredFields = isIndividual
        // ? ['name', 'countryCode', 'mobileno', 'email', 'dob', 'reason']
        ? ['name', 'countryCode', 'mobileno', 'email', 'reason']
        : ['companyName', 'countryCode', 'mobileno', 'email', 'designation', 'reason'];
    const isValid = requiredFields.every(field => data[field] && data[field] !== '' && verified);
    if (isValid) {
        const confirmBtn = document.getElementById('confirm-btn');
        const spinnerBtn = document.getElementById('spinner-text');
        confirmBtn.classList.add('d-none');
        spinnerBtn.classList.remove('d-none');
        const xhr = new XMLHttpRequest();
        xhr.open("POST", `${apiUrl}/api/submit_details.php`, true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                setTimeout(() => {
                    hideModal('requestModal');
                    showModal('successModal');
                    confirmBtn.classList.remove('d-none');
                    spinnerBtn.classList.add('d-none');
                }, 2000);
            }
            else {
                console.error("Request failed with status", xhr.status);
            }
        };
        xhr.onerror = function () {
            console.error("Network error");
        };
        const payload = JSON.stringify(data);
        xhr.send(payload);
    }
};
const handleInput = (id, errorId) => {
    var _a, _b;
    if (typeof errorId === 'string') {
        if (errorId !== 'letsfameUrlError' && errorId !== 'linkedInUrlError') {
            const value = (_a = document.getElementById(id)) === null || _a === void 0 ? void 0 : _a.value;
            const error = document.getElementById(errorId);
            error.style.display = value ? "none" : "block";
        }
        if (errorId === 'emailError') {
            const emailInput = document.getElementById('email');
            const errorMessage = document.getElementById('emailError');
            const email = emailInput.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(email)) {
                errorMessage.textContent = '';
                errorMessage.style.display = "none";
                errorMessage.textContent = 'Email ID is required.';
            }
            else {
                errorMessage.textContent = 'Please enter a valid email address.';
                errorMessage.style.display = "block";
            }
        }
        else if (errorId === 'letsfameUrlError' || errorId === 'linkedInUrlError') {
            const urlInput = (_b = document.getElementById('letsfameUrl')) === null || _b === void 0 ? void 0 : _b.value;
            const errorMessage = document.getElementById('letsfameUrlError');
            if (urlInput) {
                const url = urlInput.trim();
                const urlRegex = errorId === 'letsfameUrlError' ? /^https:\/\/www\.letsfame\.com\/.+$/ : /^https:\/\/www\.linkedin\.com\/.+$/;
                errorMessage.style.display = urlRegex.test(url) ? "none" : "block";
            }
            else {
                errorMessage.style.display = "none";
            }
        }
    }
};
const handleMobile = () => {
    verified = false;
};
const showModal = (id) => {
    const modalElement = document.getElementById(id);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.show();
    }
    else {
        console.error('Modal element not found!');
    }
};
const hideModal = (id) => {
    const modalElement = document.getElementById(id);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();
        if (id === "sliderModal") {
            const image = document.getElementById('lt-slider-image');
            if (image) {
                image.src = '';
            }
            const video = document.getElementById('lt-slider-video');
            if (video) {
                video.pause();
                video.src = '';
            }
        }
    }
    else {
        console.error('Modal element not found!');
    }
};
const handleWrongNo = () => {
    hideModal('otpModal');
    wrongNo = true;
    const mobile = document.getElementById('mobileno');
    mobile.focus();
    remainingTime = 30;
    resendOtpButton.innerText = "Resend OTP";
    resendOtpButton.disabled = false;
};
const refreshPage = () => {
    setTimeout(() => {
        window.location.reload();
    }, 1000);
};
document.addEventListener("DOMContentLoaded", () => {
    const portfolioVideos = document.getElementById('lt-portfolio-videos');
    const portfolioContainer = document.getElementById('lt-port-vid');
    const checkScroll = () => {
        if (!portfolioVideos)
            return;
        const scrollHeight = portfolioVideos.scrollHeight;
        const clientHeight = portfolioVideos.clientHeight;
        // console.log("scrollHeight:", scrollHeight, "clientHeight:", clientHeight);
        if (scrollHeight > 0 && clientHeight > 0) {
            if (scrollHeight > clientHeight) {
                portfolioContainer.classList.remove('border-end');
                // console.log('Scroll enabled: Removed border-end');
            }
            else {
                portfolioContainer.classList.add('border-end');
                // console.log('No scroll: Added border-end');
            }
        }
    };
    // Delay to ensure rendering
    setTimeout(() => {
        // console.log("Initial Check After Timeout");
        checkScroll();
    }, 200);
    window.addEventListener('resize', () => {
        // console.log("Resize event");
        checkScroll();
    });
    const observer = new MutationObserver(() => {
        // console.log("Mutation detected");
        checkScroll();
    });
    if (portfolioVideos) {
        observer.observe(portfolioVideos, { childList: true, subtree: true });
    }
    // Optional: Trigger additional checks after a short interval for dynamic data
    const intervalCheck = setInterval(() => {
        // console.log("Periodic Check");
        checkScroll();
        // Clear the interval once proper dimensions are calculated
        if (portfolioVideos.scrollHeight > 0)
            clearInterval(intervalCheck);
    }, 50);
});
window.toggleFields = toggleFields;
window.sendOTP = sendOTP;
window.triggerOTP = triggerOTP;
window.submitRequest = submitRequest;
window.handleInput = handleInput;
window.moveFocus = moveFocus;
window.verifyOTP = verifyOTP;
window.changeMobile = changeMobile;
window.handleBackspace = handleBackspace;
window.handleWrongNo = handleWrongNo;
window.showModal = showModal;
window.hideModal = hideModal;
window.handleMobile = handleMobile;
window.sendTemplateOTP = sendTemplateOTP;
window.openImageModal = openImageModal;
window.closeImageModal = closeImageModal;
window.openSlider = openSlider;
window.next = next;
window.previous = previous;
window.refreshPage = refreshPage;
export {};
