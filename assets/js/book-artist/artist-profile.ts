import { AccountInfo, Artist, ProfileApiResponse } from "./models/api-response";
import { MediaFile } from "./models/profile.model";

declare var bootstrap: any;

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

let images: any[] = [];
let videos: any[] = [];

let img_idx: number = 0;
let vid_idx: number = 0;
let data: Artist | null = null;

let artist_id: string | null = '';

const renderPortfolioItems = (userProfile: Artist, id: 'lt-portfolio-images' | 'lt-portfolio-videos') => {
    images = [...userProfile.portfolio.IMAGES];
    videos = [...userProfile.portfolio.VIDEOS];


    const portfolioItemsContainer = document.getElementById(id);
    if (portfolioItemsContainer) {
        const mediaRow = document.createElement('div');
        mediaRow.classList.add('lt-scrollable-row', 'row');
        if (id === 'lt-portfolio-images') {
            if (userProfile.portfolio.IMAGES.length > 0) {
                userProfile.portfolio.IMAGES.forEach((media: MediaFile, index: number) => {
                    const mediaDiv = document.createElement('div');
                    if (userProfile.portfolio.VIDEOS.length === 0) {
                        if (userProfile.portfolio.IMAGES.length > 1) {
                            mediaDiv.classList.add('col-md-3', 'pb-1', 'px-2', 'lt-showreel-item', 'position-relative');
                        } else {
                            mediaDiv.classList.add('col-md-3', 'pb-1', 'px-2', 'lt-single-item', 'position-relative');
                        }
                    } else {
                        if (userProfile.portfolio.IMAGES.length > 1) {
                            mediaDiv.classList.add('col-md-6', 'pb-1', 'px-2', 'lt-showreel-item', 'position-relative');
                        } else {
                            mediaDiv.classList.add('col-md-6', 'pb-1', 'px-2', 'lt-single-item', 'position-relative');
                        }
                    }

                    if (mediaDiv) {
                        mediaDiv.innerHTML = `
                            <img id="portfolio-image-${index}" src="${media.url}" alt="Portfolio Image" 
                                title="Portfolio Image" draggable="false" class="lt-portfolio-img">
                            <p class="small lt-post-caption">${media?.name ? media.name : ""}</p>
                        `;

                        setTimeout(() => {
                            const imageElement = document.getElementById(`portfolio-image-${index}`) as HTMLImageElement;
                            if (imageElement) {
                                imageElement.addEventListener('click', () => openSlider(index, 'IMAGE'));
                            }
                        }, 0);
                    }

                    mediaRow.appendChild(mediaDiv);
                });
            }
        } else {
            userProfile.portfolio.VIDEOS.forEach((media: MediaFile, index: number) => {
                const mediaDiv = document.createElement('div');
                if (userProfile.portfolio.IMAGES.length === 0) {
                    if (userProfile.portfolio.VIDEOS.length > 1) {
                        mediaDiv.classList.add('col-md-3', 'px-2', 'pb-1', 'lt-showreel-item', 'position-relative');
                    } else {
                        mediaDiv.classList.add('col-md-3', 'px-2', 'pb-1', 'lt-single-item', 'position-relative');
                    }
                } else {
                    if (userProfile.portfolio.VIDEOS.length > 1) {
                        mediaDiv.classList.add('col-md-6', 'px-2', 'pb-1', 'lt-showreel-item', 'position-relative');
                    } else {
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
                        <p class="small lt-post-caption">${media?.name ? media.name : ""}</p>
                    `;

                    setTimeout(() => {
                        const videoElement = document.getElementById(`portfolio-video-${index}`) as HTMLDivElement;
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
}

const bindData = (data: Artist) => {
    const coverImageContainer = document.getElementById("lt-cover") as HTMLDivElement;

    if (!coverImageContainer) {
        console.error("cover image container not found");
        return;
    }

    const coverImageHTML = `<div class="position-relative">
                <img src="${data?.cover_image}" onclick="openImageModal('${data?.cover_image || ''}')"
                    class="lt-cover-img" alt="Cover Image" title="Cover Image"  draggable="false">
                    
                <div class="position-absolute top-0 start-2 p-3">
                    <a href="bookartist" class="hover-rounded text-white">
                        <i class="bi bi-arrow-left fs-3"></i>
                    </a>
                </div>
            </div>`

    coverImageContainer.innerHTML = coverImageHTML;

    const profileImageContainer = document.getElementById("lt-profile-img") as HTMLDivElement;

    if (!profileImageContainer) {
        console.error("profile image container not found");
        return;
    }

    const profileImageHTML = `<img src="${data?.profile_image}" class="lt-profile-img" alt="Profile Image"
                           onclick="openImageModal('${data?.profile_image || ''}')"  title="Profile Image"  draggable="false">`


    profileImageContainer.innerHTML = profileImageHTML;

    const profileInfoContainer = document.getElementById("lt-profile-info") as HTMLDivElement;

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



    const renderSocialMedia = (icon: string, platform: string, accountInfo: AccountInfo, profile_image: string) => {
        return `
            <div class="d-flex justify-content-between align-items-center gap-3 px-5 pt-4 w-100">
                <div class="d-flex align-items-center gap-3 w-75">
                    <img src="assets/img/book-artist/social-media/${icon}.svg" 
                        alt="${platform} Icon" 
                        title="${platform} Icon" 
                        draggable="false" 
                        width="40px" 
                        height="40px">
                        
                    <img src="${accountInfo?.img || profile_image}" 
                        alt="${accountInfo?.name} Profile Image" 
                        draggable="false" 
                        title="${accountInfo?.name}"
                        width="40px" 
                        height="40px" 
                        class="rounded-circle">
                        
                    <span class="fw-bold"  title="${accountInfo?.url}">${accountInfo?.name?.length <= 10 ? accountInfo?.name : accountInfo?.name.substring(0, 10) + "..."}</span>
                </div>

                <div class="d-flex flex-column align-items-center text-center w-25">
                    <span class="lt-yellow fw-bold">${accountInfo?.followers || 0}</span>
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
    <h5 class="lt-title ls">${data?.name || 'Artist Name'}</h5>

    <!-- Artist Profession and Location -->
    <h6 class="lt-subtitle">
        ${data?.profession || 'Profession'} 
        <i class="bi bi-dot fs-6"></i> Chennai
    </h6>

    <!-- Book Button -->
    <div class="d-flex justify-content-center mt-4">
        <button class="btn btn-md btn-warning book-btn fw-bold" style="width: 75%;" onclick="showModal('requestModal')">
            Book ${data?.name || 'Artist'}
        </button>
    </div>

    <!-- Social Media Section -->
        ${renderSocialMedia('instagram', 'Instagram', data?.followers?.instagram, data?.profile_image)}
        ${renderSocialMedia('youtube', 'YouTube', data?.followers?.youtube, data?.profile_image)}
        ${renderSocialMedia('twitter', 'Twitter', data?.followers?.twitter, data?.profile_image)}

</div>

    `;

    profileInfoContainer.innerHTML = profileInfoHTML;

    const aboutInfo = document.getElementById('lt-bio') as HTMLDivElement;
    aboutInfo.innerHTML = `
                <div class="text-start px-3 text-white mb-3">
                    <p class="lt-title fs-6">About</p>
                    <span id="lt-biography">${data?.biography}</span>
                </div>`;

    const portfolio = document.getElementById('lt-portfolio') as HTMLDivElement;
    const portfolioImg = document.getElementById('lt-port-img') as HTMLDivElement;
    const portfolioVid = document.getElementById('lt-port-vid') as HTMLDivElement;

    if (!data?.portfolio?.IMAGES?.length && !data?.portfolio?.VIDEOS?.length) {
        // No images and no videos
        portfolio.innerHTML = `<div class=''>
                <p class="px-3 text-muted">No Data Available.</p>
            </div>`;
    } else {
        if (data?.portfolio?.IMAGES?.length === 0) {
            portfolioImg?.classList.add('d-none')
            portfolioVid?.classList.remove('col-md-6');
            portfolioVid?.classList.add('col-md-12');
        } else if (data?.portfolio?.VIDEOS?.length === 0) {
            portfolioVid?.classList.add('d-none')
            portfolioImg?.classList.remove('col-md-6');
            portfolioImg?.classList.add('col-md-12');
        }
        // if (!data?.portfolio?.IMAGES?.length) portfolioImg?.classList.add('d-none');
        // if (!data?.portfolio?.VIDEOS?.length) portfolioVid?.classList.add('d-none');
    }

    renderPortfolioItems(data, 'lt-portfolio-images');
    renderPortfolioItems(data, 'lt-portfolio-videos');
    console.log("Artist data : ", data);

}

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
            const data = response.data.map((country: any) => country.country_code)
            const dropdown = document.getElementById("countryCode") as HTMLSelectElement;
            dropdown.innerHTML = "";
            data.forEach((item: string) => {
                const option = document.createElement("option");
                option.text = "+" + item;
                option.value = item;
                dropdown.appendChild(option);
            });
            const countryCode = document.getElementById('countryCode') as HTMLSelectElement;
            if (countryCode) {
                countryCode.value = "91";
            }
        } else {
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

    const spinnerOverlay = document.getElementById('spinnerOverlay') as HTMLDivElement;
    const header = document.getElementById('lt-profile-container') as HTMLDivElement;
    spinnerOverlay.classList.remove('d-none');
    header.classList.add('d-none');

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `${apiUrl}/api/profile_details.php?id=${artist_id}`, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result: ProfileApiResponse = JSON.parse(xhr.responseText);
            if(result?.status === true) {
                data = result?.data || {};
                bindData(data);
                setTimeout(() => {
                    spinnerOverlay.classList.add('d-none');
                    header.classList.remove('d-none');
                }, 1000);
            } else {
                window.location.href = 'bookartist';
            }
        };
    };
    xhr.onerror = function () {
        console.error("Network error");
    };

    xhr.send();
}

loadProfileData();

const next = () => {
    img_idx = (img_idx + 1 + images.length) % images.length;
    vid_idx = (vid_idx - 1 + videos.length) % videos.length;

    // Update image if available
    const image = document.getElementById('lt-slider-image') as HTMLImageElement;
    if (image) {
        image.src = images[img_idx]?.url;
    }

    // Update video if available
    const video = document.getElementById('lt-slider-video') as HTMLVideoElement;
    if (video) {
        video.src = videos[vid_idx]?.url;
        video.load();
    }
};

const previous = () => {
    img_idx = (img_idx - 1 + images.length) % images.length;
    vid_idx = (vid_idx - 1 + videos.length) % videos.length;

    const image = document.getElementById('lt-slider-image') as HTMLImageElement;
    if (image) {
        image.src = images[img_idx]?.url;
    }

    const video = document.getElementById('lt-slider-video') as HTMLVideoElement;
    if (video) {
        video.src = videos[vid_idx]?.url;
        video.load();
    }
};

const openSlider = (idx: number, type: string = 'IMAGE') => {


    const prev_btn = document.getElementById('lt-prev-button') as HTMLElement;
    const next_btn = document.getElementById('lt-next-button') as HTMLElement;

    if (type === 'IMAGE') {
        if (images?.length === 1) {
            if (prev_btn) prev_btn.classList.add('d-none');
            if (next_btn) next_btn.classList.add('d-none');
        } else {
            if (prev_btn) prev_btn.classList.remove('d-none');
            if (next_btn) next_btn.classList.remove('d-none');
        }
    } else {
        if (videos?.length === 1) {
            if (prev_btn) prev_btn.classList.add('d-none');
            if (next_btn) next_btn.classList.add('d-none');
        } else {
            if (prev_btn) prev_btn.classList.remove('d-none');
            if (next_btn) next_btn.classList.remove('d-none');
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

            mediaContainer.innerHTML = ``;  // Clear existing content

            if (type === "IMAGE") {
                img_idx = idx;
                const currentMedia = images[idx];
                const imgElement = document.createElement('img');
                imgElement.src = currentMedia.url;
                imgElement.id = 'lt-slider-image';
                imgElement.classList.add('lt-slider-image');
                imgElement.alt = "Media";
                mediaContainer.appendChild(imgElement);
            } else if (type === "VIDEO") {
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
    } else {
        console.error('Modal element not found!');
    }
};

const openImageModal = (src: string) => {
    const modal = document.getElementById('lt-profile-modal') as HTMLDivElement;
    const image = document.getElementById('lt-modal-image') as HTMLImageElement;
    image.src = src;
    modal.classList.remove('d-none');

    document.body.style.overflow = 'hidden';
    document.body.style.position = 'fixed';
    document.body.style.width = '100%';
}

const closeImageModal = () => {
    const modal = document.getElementById('lt-profile-modal') as HTMLDivElement;
    modal.classList.add('d-none');
    document.body.style.overflow = 'auto';
    document.body.style.position = 'static';
}

let verified: boolean = false;
let wrongNo: boolean = false;

const sendOTP = () => {
    const mobile = document.getElementById('mobileno') as HTMLInputElement;
    const countryCode = document.getElementById('countryCode') as HTMLInputElement;
    if (!verified) {
        if (mobile.value) {
            const otpMobile = document.getElementById('otp-mobile') as HTMLSpanElement;
            otpMobile.innerHTML = `+${countryCode?.value}  ${mobile?.value}`;
            showModal('otpModal');
            triggerOTP();
        } else {
            mobile.focus();
        }
    }
}

const changeMobile = () => {
    verified = false;
    const verifiedIcon = document.getElementById('verifiedIcon') as HTMLImageElement;
    verifiedIcon.style.display = "none";
}


let remainingTime: number = 30;
const resendOtpButton = document.getElementById('resendOtpButton') as HTMLButtonElement;

const triggerOTP = () => {

    const mobile = (document.getElementById('mobileno') as HTMLInputElement)?.value;
    const code = (document.getElementById('countryCode') as HTMLSelectElement)?.value;

    sendTemplateOTP(code, mobile);

    const otpInputs = document.querySelectorAll<HTMLInputElement>('.otp-text');

    otpInputs.forEach(input => {
        input.value = '';
    });


    resendOtpButton.disabled = true;

    let timer = setInterval(() => {
        remainingTime--;
        if (remainingTime > 0) {
            resendOtpButton.innerText = `Resend OTP (${remainingTime}s)`;
        } else {
            resendOtpButton.innerText = "Resend OTP";
        }

        if (remainingTime <= 0) {
            clearInterval(timer);
            resendOtpButton.disabled = false;
            remainingTime = 30;
        }
    }, 1000);
}

const sendTemplateOTP = async (code: string, mobile: string) => {
    const url = `${apiUrl}/api/${code === '91' ? 'send_otp' : 'othercountry'}.php?mobile=${code}${mobile}`;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const result = JSON.parse(xhr.responseText);
            if (result?.status) {
                // sentOtp = otp.toString();
                console.log("data : ", result);
            }
        };
    };

    xhr.onerror = function () {
        console.error("Network error");
    };

    xhr.send();

};

const moveFocus = (currentInput: HTMLInputElement, nextInputIndex: number): void => {
    if (currentInput.value) {
        const nextInput = document.querySelectorAll<HTMLInputElement>('.otp-text')[nextInputIndex];
        if (nextInput) {
            nextInput.focus();
        }
    }
}

const handleBackspace = (event: KeyboardEvent, index: number): void => {
    // const inputElement = event.target as HTMLInputElement;

    if (event.key === "Backspace") {
        const input = document.querySelector(`.otp-text:nth-child(${index})`) as HTMLInputElement;
        if (input) {
            input.value = "";
            const previousInput = document.querySelector(`.otp-text:nth-child(${index - 1})`) as HTMLInputElement;
            if (previousInput) {
                previousInput.focus();
            }
        }
    }
}

const verifyOTP = () => {
    const otpInputs = document.querySelectorAll<HTMLInputElement>('.otp-text');
    const mobile = (document.getElementById('mobileno') as HTMLInputElement)?.value;
    const countryCode = (document.getElementById('countryCode') as HTMLSelectElement)?.value;

    const verificationError = document.getElementById('verificationError') as HTMLParagraphElement;
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
                if (result?.status === true && result?.statusCode === 200) {
                    verified = true;
                    const confirmBtn = document.getElementById('otp-confirm-btn') as HTMLSpanElement;
                    const spinnerBtn = document.getElementById('otp-spinner-text') as HTMLSpanElement;
                    confirmBtn.classList.add('d-none');
                    spinnerBtn.classList.remove('d-none');

                    setInterval(() => {
                        hideModal('otpModal');
                        verified = true;
                        wrongNo = false;
                        const mobileno = document.getElementById('mobileno') as HTMLInputElement;
                        mobileno.disabled = true;
                        const countryCode = document.getElementById('countryCode') as HTMLSelectElement;
                        countryCode.disabled = true;
                        const verifiedIcon = document.getElementById('verifiedIcon') as HTMLImageElement;
                        if (verifiedIcon) {
                            verifiedIcon.style.display = "block";
                        }
                        confirmBtn.classList.remove('d-none');
                        spinnerBtn.classList.add('d-none');
                    }, 3000)
                } else {
                    const verificationError = document.getElementById('verificationError') as HTMLParagraphElement;
                    verificationError.style.display = "block";
                }
            };
        };

        xhr.onerror = function () {
            console.error("Network error");
        };

        xhr.send();
    } else {
        alert('Please fill in all the fields.');
    }
}


const toggleFields = (type: string): void => {
    // const fields = {
    //     // individual: ['name-input', 'dob-input'],
    //     // individual: ['name-input'],
    //     company: ['company-input', 'designation-input', 'linkedin-input']
    // };

    // const allFields = ['name-input', 'company-input', 'designation-input', 'dob-input', 'linkedin-input'];
    const allFields = ['company-input', 'designation-input', 'linkedin-input'];

    allFields.forEach(id => {
        const element = document.getElementById(id) as HTMLDivElement;
        element.style.display = type === 'company' ? 'block' : 'none';
    });
};

const getFormData = (fields: { id: string, errorId: string | null }[], isIndividual: boolean) => {
    const formData: any = { type: isIndividual ? "Individual" : "Company" };

    fields.forEach(({ id, errorId }) => handleInput(id, errorId));

    fields.forEach(({ id }) => {
        formData[id] = (document.getElementById(id) as HTMLInputElement | HTMLTextAreaElement)?.value || '';
    });

    return formData;
};

const submitRequest = () => {

    // const recaptchaResponse = grecaptcha.getResponse();
    // if (!recaptchaResponse) {
    //     alert('Please complete the reCAPTCHA.');
    //     return;
    // }
    const isIndividual = (Array.from(document.querySelectorAll<HTMLInputElement>('input[name="type"]')).find(radio => radio.checked)?.value === "Individual");

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
        const confirmBtn = document.getElementById('confirm-btn') as HTMLSpanElement;
        const spinnerBtn = document.getElementById('spinner-text') as HTMLSpanElement;
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
                }, 2000)
            } else {
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

const handleInput = (id: string, errorId: string | null) => {
    if (typeof errorId === 'string') {

        if (errorId !== 'letsfameUrlError' && errorId !== 'linkedInUrlError') {
            const value = (document.getElementById(id) as HTMLInputElement)?.value;
            const error = document.getElementById(errorId) as HTMLSpanElement;
            error.style.display = value ? "none" : "block";
        }

        if (errorId === 'emailError') {
            const emailInput = document.getElementById('email') as HTMLInputElement;
            const errorMessage = document.getElementById('emailError') as HTMLSpanElement;
            const email = emailInput.value.trim();

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailRegex.test(email)) {
                errorMessage.textContent = '';
                errorMessage.style.display = "none";
                errorMessage.textContent = 'Email ID is required.';
            } else {
                errorMessage.textContent = 'Please enter a valid email address.';
                errorMessage.style.display = "block";
            }
        }

        else if (errorId === 'letsfameUrlError' || errorId === 'linkedInUrlError') {
            const urlInput = (document.getElementById('letsfameUrl') as HTMLInputElement)?.value;
            const errorMessage = document.getElementById('letsfameUrlError') as HTMLSpanElement;
            if (urlInput) {
                const url = urlInput.trim();
                const urlRegex = errorId === 'letsfameUrlError' ? /^https:\/\/www\.letsfame\.com\/.+$/ : /^https:\/\/www\.linkedin\.com\/.+$/;
                errorMessage.style.display = urlRegex.test(url) ? "none" : "block";
            } else {
                errorMessage.style.display = "none";
            }
        }
    }
}

const handleMobile = () => {
    verified = false;
}

const showModal = (id: string) => {
    const modalElement = document.getElementById(id);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.show();
    } else {
        console.error('Modal element not found!');
    }
}

const hideModal = (id: string) => {
    const modalElement = document.getElementById(id);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        modalInstance.hide();

        if (id === "sliderModal") {
            const image = document.getElementById('lt-slider-image') as HTMLImageElement;
            if (image) {
                image.src = '';
            }
            const video = document.getElementById('lt-slider-video') as HTMLVideoElement;
            if (video) {
                video.pause();
                video.src = '';
            }
        }
    } else {
        console.error('Modal element not found!');
    }
}

const handleWrongNo = () => {
    hideModal('otpModal');
    wrongNo = true;
    const mobile = document.getElementById('mobileno') as HTMLInputElement;
    mobile.focus();
    remainingTime = 30;
    resendOtpButton.innerText = "Resend OTP";
    resendOtpButton.disabled = false;
}

const refreshPage = () => {
    setTimeout(() => {
        window.location.reload();
    }, 1000)
}

document.addEventListener("DOMContentLoaded", () => {
    const portfolioVideos = document.getElementById('lt-portfolio-videos') as HTMLDivElement;
    const portfolioContainer = document.getElementById('lt-port-vid') as HTMLDivElement;

    const checkScroll = () => {
        if (!portfolioVideos) return;

        const scrollHeight = portfolioVideos.scrollHeight;
        const clientHeight = portfolioVideos.clientHeight;

        // console.log("scrollHeight:", scrollHeight, "clientHeight:", clientHeight);

        if (scrollHeight > 0 && clientHeight > 0) {
            if (scrollHeight > clientHeight) {
                portfolioContainer.classList.remove('border-end');
                // console.log('Scroll enabled: Removed border-end');
            } else {
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
        if (portfolioVideos.scrollHeight > 0) clearInterval(intervalCheck);
    }, 50);
});


declare global {
    interface Window {
        toggleFields: (element: string) => void;
        sendOTP: (element: string) => void;
        triggerOTP: (mobile: number, code: string) => void;
        handleInput: (id: string, errorId: string) => void;
        submitRequest: () => void;
        moveFocus: (currentInput: HTMLInputElement, nextInputIndex: number) => void;
        verifyOTP: () => void;
        changeMobile: () => void;
        handleWrongNo: () => void;
        handleMobile: () => void;
        sendTemplateOTP: (code: string, mobile: string) => void;
        showModal: (id: string) => void;
        hideModal: (id: string) => void;
        handleBackspace: (event: KeyboardEvent, index: number) => void;
        openImageModal: (id: string) => void;
        closeImageModal: () => void;
        next: () => void;
        refreshPage: () => void;
        previous: () => void;
        openSlider: (index: number) => void;
    }
}

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
