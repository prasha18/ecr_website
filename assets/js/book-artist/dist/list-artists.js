var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// const apiUrl = 'https://lafs-atv.com/letsfame-admin';
const apiUrl = 'https://www.letsfame.com';
const spinnerOverlay = document.getElementById('spinnerOverlay');
const header = document.getElementById('tab-content-container');
spinnerOverlay.classList.remove('d-none');
header.classList.add('d-none');
setTimeout(() => {
    spinnerOverlay.classList.add('d-none');
    header.classList.remove('d-none');
}, 1000);
let pageIndex = 1;
let pageSize = 15;
let members = [];
let isLoading = false;
let tab_name = "All";
let data;
let tabs = [];
let searchTerm = "";
const searchInput = document.getElementById('searchInput');
const clearButton = document.getElementById('clearButton');
searchInput.addEventListener('input', () => {
    if (searchInput.value.trim() !== '') {
        clearButton.classList.remove('d-none');
    }
    else {
        clearButton.classList.add('d-none');
    }
});
const clearSearch = () => {
    searchInput.value = '';
    searchTerm = '';
    clearButton.classList.add('d-none');
    searchInput.focus();
    pageIndex = 1;
    tab_name = "All";
    renderTabContent();
    const div = document.getElementById('tabs-container');
    div.style.pointerEvents = 'auto';
};
const contentContainer = document.getElementById("tab-content-container");
// const seachResults = `<h1 class="text-white">Search Results</h1>`;
// contentContainer.appendChild(seachResults);
let cardRow = document.createElement("div");
cardRow.className = "row mt-3";
const xhr = new XMLHttpRequest();
xhr.open("GET", "assets/json/book-artist/profession.json", true);
xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        const result = JSON.parse(xhr.responseText);
        console.log("data : ", result);
        tabs = (result === null || result === void 0 ? void 0 : result.map((elem) => (Object.assign(Object.assign({}, elem), { visible: true })))) || [];
        renderTabsAndContent(tabs);
    }
    ;
};
xhr.send();
const renderTabsAndContent = (tabs) => {
    if (tabs.length > 0) {
        const tabsContainer = document.getElementById("tabs-container");
        const navTabs = document.createElement("ul");
        navTabs.className = "nav-tabs-container nav nav-tabs nav-tabs-bordered d-flex";
        const visibleTabs = tabs.slice(0, 10);
        // const dropdownTabs = tabs.slice();
        const navItem = document.createElement("li");
        navItem.className = "nav-item";
        const button = document.createElement("button");
        button.className = `nav-link text-muted text-dark active`;
        button.textContent = "All";
        button.setAttribute("data-bs-toggle", "tab");
        button.addEventListener("click", () => {
            setActiveTab("All", tabs);
        });
        navItem.appendChild(button);
        navTabs.appendChild(navItem);
        if (visibleTabs.length > 0) {
            visibleTabs.forEach((tab, index) => {
                if (tab.visible) {
                    const navItem = document.createElement("li");
                    navItem.className = "nav-item";
                    const button = document.createElement("button");
                    button.className = `nav-link text-muted text-dark`;
                    button.textContent = tab.name;
                    button.setAttribute("data-bs-toggle", "tab");
                    button.addEventListener("click", () => {
                        // const allChips = document.querySelectorAll('.lt-badge');
                        // allChips.forEach(chip => {
                        //     chip.classList.remove('active');
                        // });
                        setActiveTab(tab.name, tabs);
                    });
                    navItem.appendChild(button);
                    navTabs.appendChild(navItem);
                }
            });
        }
        // Add the "More" dropdown for remaining tabs
        // if (dropdownTabs.length > 0) {
        //     const dropdownItem = document.createElement("li");
        //     dropdownItem.className = "nav-item dropdown lt-dropdown";
        //     const dropdownButton = document.createElement("button");
        //     dropdownButton.className = "nav-link dropdown-toggle small";
        //     dropdownButton.setAttribute("data-bs-toggle", "modal");
        //     dropdownButton.setAttribute("data-bs-target", "#professionModal");
        //     dropdownButton.textContent = "More";
        //     const modalBody = document.querySelector("#professionModal .modal-body");
        //     if (modalBody) {
        //         const chipContainer = document.createElement("div");
        //         chipContainer.className = "d-flex flex-wrap";
        //         modalBody.appendChild(chipContainer);
        //         const chip = document.createElement("span");
        //         chip.className = "lt-badge rounded-pill m-1 p-2 active";
        //         chip.textContent = "All";
        //         const width = "All".length * 8;
        //         chip.style.minWidth = `${Math.max(width, 60)}px`;
        //         chip.style.maxWidth = "150px";
        //         chip.addEventListener("click", () => {
        //             hideModal("professionModal");
        //             const allChips = chipContainer.querySelectorAll('.lt-badge');
        //             allChips.forEach(chip => {
        //                 chip.classList.remove('active');
        //             });
        //             chip.classList.add('active');
        //             setActiveTab("All", tabs);
        //         });
        //         chipContainer.appendChild(chip);
        //         dropdownTabs.forEach((tab: ProfessionData) => {
        //             const chip = document.createElement("span");
        //             chip.className = "lt-badge rounded-pill m-1 p-2";
        //             chip.textContent = tab.name;
        //             const width = tab.name.length * 8;
        //             chip.style.minWidth = `${Math.max(width, 60)}px`;
        //             chip.style.maxWidth = "150px";
        //             chip.addEventListener("click", () => {
        //                 hideModal("professionModal");
        //                 const allChips = chipContainer.querySelectorAll('.lt-badge');
        //                 allChips.forEach(chip => {
        //                     chip.classList.remove('active');
        //                 });
        //                 chip.classList.add('active');
        //                 setActiveTab(tab.name, tabs);
        //             });
        //             chipContainer.appendChild(chip);
        //         });
        //     }
        //     dropdownItem.appendChild(dropdownButton);
        //     navTabs.appendChild(dropdownItem);
        // }
        tabsContainer.appendChild(navTabs);
        renderTabContent();
    }
};
const cache = new Map();
let isDataLoading = false;
const renderTabContent = () => __awaiter(void 0, void 0, void 0, function* () {
    // Prevent triggering if data is still loading
    if (isLoading) {
        console.log("Already loading data. Skipping...");
        return; // Prevent duplicate API calls
    }
    // Reset members when pageIndex is 1 (i.e., for the first page load or new search)
    if (pageIndex === 1) {
        contentContainer.innerHTML = "";
        members = [];
    }
    isLoading = true;
    const baseUrl = `${apiUrl}/api/list_artise_api.php?page=${pageIndex}&pageSize=10`;
    const url = searchTerm ? `${baseUrl}&search=${searchTerm}` : `${baseUrl}${tab_name === 'All' ? '' : `&profession=${tab_name}`}`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onreadystatechange = function () {
        var _a;
        console.log("HTTP Status:", xhr.status);
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const result = JSON.parse(xhr.responseText);
                const data = ((_a = result === null || result === void 0 ? void 0 : result.data) === null || _a === void 0 ? void 0 : _a.posts) || [];
                if (data.length === 0 && pageIndex === 1) {
                    const noData = `
                    <div class='text-center no-data-container'>
                        <img src="assets/img/book-artist/warning.svg" width="80px" class="mb-3"/>
                        <h1 class="no-data">NO RESULTS</h1>
                        <h1 class="no-data">FOUND</h1>
                    </div>
                    `;
                    contentContainer.innerHTML = noData;
                    console.log("No data available to load.");
                    isLoading = false;
                    return;
                }
                if (data.length === 0) {
                    console.log("No more data to load.");
                    isLoading = false;
                    return; // Avoid incrementing pageIndex if there's no more data
                }
                // Append new data to the members array
                members = [...members, ...data];
                // Removing duplicates from merged array
                members = [...new Set(members.map(a => a.id))].map(id => members.find(a => a.id === id)).filter((a) => a !== undefined);
                console.log("Updated members array:", members);
                // Increment pageIndex only if data is loaded successfully
                pageIndex++;
                contentContainer.innerHTML = ""; // Clear the container only once
                // Add search results header if search term is present
                const searchResults = document.createElement("h3");
                searchResults.className = searchTerm ? "text-white px-3" : "text-white px-3 d-none";
                searchResults.textContent = "Search Results";
                searchResults.setAttribute("id", "searchResults");
                contentContainer.appendChild(searchResults);
                // Render the members as cards
                members.forEach((card) => {
                    var _a, _b, _c, _d, _e, _f, _g;
                    const cardCol = document.createElement("div");
                    cardCol.className = "col-md-4 bg-white shadow py-3 px-3 lt-card";
                    const cardHTML = `
                        <div class="d-flex align-items-center py-2">
                            <div class="col-4">
                                <img src="${card.profile_image}" alt="${card.name}" title="${card.name}" draggable="false" class="img-fluid rounded-circle lt-prof-img">
                            </div>
                            <div class="col-8 ps-3">
                                <a href="artist-profile?id=${card.id}" class="hover-rounded text-white">
                                    <p class="lt-name mb-0">${((_a = card.name) === null || _a === void 0 ? void 0 : _a.length) <= 15 ? card.name : `${card.name.substring(0, 15)}...`}</p>
                                </a>
                                <p class="lt-profession mb-1">${card.profession}</p>
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <div class="text-start">
                                        <img src="assets/img/book-artist/social-media/instagram.svg" width="16px" alt="Instagram Icon" draggable="false">
                                        <small class="lt-social-media">${((_c = (_b = card === null || card === void 0 ? void 0 : card.followers) === null || _b === void 0 ? void 0 : _b.instagram) === null || _c === void 0 ? void 0 : _c.followers) || 0}</small>
                                    </div>
                                    <div class="text-start">
                                        <img src="assets/img/book-artist/social-media/youtube.svg" width="16px" alt="YouTube Icon" draggable="false">
                                        <small class="lt-social-media">${((_e = (_d = card === null || card === void 0 ? void 0 : card.followers) === null || _d === void 0 ? void 0 : _d.youtube) === null || _e === void 0 ? void 0 : _e.followers) || 0}</small>
                                    </div>
                                    <div class="text-start">
                                        <img src="assets/img/book-artist/social-media/twitter-black.svg" width="12px" alt="Twitter Icon" draggable="false">
                                        <small class="lt-social-media">${((_g = (_f = card === null || card === void 0 ? void 0 : card.followers) === null || _f === void 0 ? void 0 : _f.twitter) === null || _g === void 0 ? void 0 : _g.followers) || 0}</small>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-sm book-btn w-100 position-relative" onclick="navigatePage(${card.id})">
                                        <span id="btnText-${card.id}" class="lt-btn-text">Book</span>
                                        <div id="spinner-${card.id}" class="spinner-border spinner-border-sm text-light d-none" role="status"></div>
                                    </button>
                                </div>
                            </div>
                        </div>`;
                    cardCol.innerHTML = cardHTML;
                    cardRow.appendChild(cardCol);
                    contentContainer.appendChild(cardRow);
                });
            }
            catch (error) {
                console.error("Error parsing response data:", error);
                isLoading = false;
            }
        }
        else {
            console.error("Failed to fetch data. HTTP Status:", xhr.status);
            isLoading = false;
        }
    };
    xhr.send();
});
// const renderTabContent = async () => {
//     // if (isDataLoading) {
//     //     console.log("Already loading data. Skipping...");
//     //     return; // Prevent duplicate API calls
//     // }
//     // isDataLoading = true;
//     if (pageIndex === 1) {
//         contentContainer.innerHTML = "";
//         members = [];
//     }
//     // // If data is already cached, use it
//     // if (cache.has(pageIndex)) {
//     //     console.log("Using cached data for pageIndex:", pageIndex);
//     //     const cachedData = cache.get(pageIndex);
//     //     processData(cachedData);
//     //     isDataLoading = false;
//     //     return;
//     // }
//     cardRow = document.createElement("div");
//     cardRow.className = "row mt-3 pb-3";
//     isLoading = true;
//     const baseUrl = `${apiUrl}/api/list_artise_api.php?page=1&pageSize=15`;
//     const url = searchTerm ? `${baseUrl}&search=${searchTerm}` : `${baseUrl}${tab_name === 'All' ? '' : `&profession=${tab_name}`}`
//     const xhr = new XMLHttpRequest();
//     xhr.open("GET", url, true);
//     xhr.onreadystatechange = function () {
//         console.log("HTTP Status:", xhr.status);
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             try {
//                 isLoading = false;
//                 const result = JSON.parse(xhr.responseText);
//                 data = result?.data?.posts || [];
//                 if (data.length === 0 && pageIndex === 1) {
//                     const noData = `
//                     <div class='text-center no-data-container'>
//                         <img src="assets/img/book-artist/warning.svg" width="80px" class="mb-3"/>
//                         <h1 class="no-data">NO RESULTS</h1>
//                         <h1 class="no-data">FOUND</h1>
//                     </div>
//                     `;
//                     contentContainer.innerHTML = noData;
//                     console.log("No data available to load.");
//                     return;
//                 }
//                 if (data.length === 0) {
//                     console.log("No more data to load.");
//                     return; // Avoid incrementing pageIndex if there's no more data
//                 }
//                 pageIndex++; // Increment pageIndex only when there is data
//                 // members = ;
//                 members = [...members, ...data];
//                 // Removing duplicates from merged array
//                 members = [...new Set(members)];
//                 // console.log(members);
//                 console.log(members);
//                 console.log("Updated members array:", members);
//                 contentContainer.innerHTML = ""; // Clear the container only once
//                 const searchResults = document.createElement("h3");
//                 searchResults.className = searchTerm ? "text-white px-3" : "text-white px-3 d-none";
//                 searchResults.textContent = "Search Results";
//                 searchResults.setAttribute("id", "searchResults");
//                 contentContainer.appendChild(searchResults);
//                 members.forEach((card) => {
//                     const cardCol = document.createElement("div");
//                     cardCol.className = "col-md-4 bg-white shadow py-3 px-3 lt-card";
//                     const cardHTML = `
//                         <div class="d-flex align-items-center py-2">
//                             <div class="col-4">
//                                 <img src="${card.profile_image}" alt="${card.name}" title="${card.name}" draggable="false" class="img-fluid rounded-circle lt-prof-img">
//                             </div>
//                             <div class="col-8 ps-3">
//                                 <a href="artist-profile?id=${card.id}" class="hover-rounded text-white">
//                                     <p class="lt-name mb-0">${card.name?.length <= 15 ? card.name : `${card.name.substring(0, 15)}...`}</p>
//                                 </a>
//                                 <p class="lt-profession mb-1">${card.profession}</p>
//                                 <div class="d-flex justify-content-between align-items-center gap-2">
//                                     <div class="text-start">
//                                         <img src="assets/img/book-artist/social-media/instagram.svg" width="16px" alt="Instagram Icon" draggable="false">
//                                         <small class="lt-social-media">${card?.followers?.instagram?.followers || 0}</small>
//                                     </div>
//                                     <div class="text-start">
//                                         <img src="assets/img/book-artist/social-media/youtube.svg" width="16px" alt="YouTube Icon" draggable="false">
//                                         <small class="lt-social-media">${card?.followers?.youtube?.followers || 0}</small>
//                                     </div>
//                                     <div class="text-start">
//                                         <img src="assets/img/book-artist/social-media/twitter-black.svg" width="12px" alt="Twitter Icon" draggable="false">
//                                         <small class="lt-social-media">${card?.followers?.twitter?.followers || 0}</small>
//                                     </div>
//                                 </div>
//                                 <div class="d-flex justify-content-center mt-2">
//                                     <button class="btn btn-sm book-btn w-100 position-relative" onclick="navigatePage(${card.id})">
//                                         <span id="btnText-${card.id}" class="lt-btn-text">Book</span>
//                                         <div id="spinner-${card.id}" class="spinner-border spinner-border-sm text-light d-none" role="status"></div>
//                                     </button>
//                                 </div>
//                             </div>
//                         </div>`;
//                     cardCol.innerHTML = cardHTML;
//                     cardRow.appendChild(cardCol);
//                     contentContainer.appendChild(cardRow);
//                 });
//             } catch (error) {
//                 console.error("Error parsing response data:", error);
//                 isLoading = false;
//             }
//         } else {
//             console.error("Failed to fetch data. HTTP Status:", xhr.status);
//             isLoading = false;
//         }
//     };
//     xhr.send();
// };
const processData = (data) => {
    pageIndex++; // Increment pageIndex only when there is data
    members = [...members, ...data];
    console.log("Updated members array:", members);
    contentContainer.innerHTML = ""; // Clear the container only once
    members.forEach((card) => {
        var _a, _b, _c, _d, _e, _f;
        const cardCol = document.createElement("div");
        cardCol.className = "col-md-4 bg-white shadow py-3 px-3 lt-card";
        const cardHTML = `
            <div class="d-flex align-items-center py-2">
                <div class="col-4">
                    <img src="${card.profile_image}" alt="${card.name}" title="${card.name}" loading="lazy" draggable="false" class="img-fluid rounded-circle lt-prof-img">
                </div>
                <div class="col-8 px-2">
                    <p class="fw-bold mb-1">${card.name}</p>
                    <p class="small text-muted mb-1">${card.profession}</p>
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div class="text-start">
                            <img src="assets/img/book-artist/social-media/instagram.svg" alt="Instagram Icon" loading="lazy" draggable="false">
                            <small>${((_b = (_a = card === null || card === void 0 ? void 0 : card.followers) === null || _a === void 0 ? void 0 : _a.instagram) === null || _b === void 0 ? void 0 : _b.followers) || 0}</small>
                        </div>
                        <div class="text-start">
                            <img src="assets/img/book-artist/social-media/youtube.svg" alt="YouTube Icon" loading="lazy" draggable="false">
                            <small>${((_d = (_c = card === null || card === void 0 ? void 0 : card.followers) === null || _c === void 0 ? void 0 : _c.youtube) === null || _d === void 0 ? void 0 : _d.followers) || 0}</small>
                        </div>
                        <div class="text-start">
                            <img src="assets/img/book-artist/social-media/twitter-black.svg" alt="Twitter Icon" loading="lazy" draggable="false">
                            <small>${((_f = (_e = card === null || card === void 0 ? void 0 : card.followers) === null || _e === void 0 ? void 0 : _e.twitter) === null || _f === void 0 ? void 0 : _f.followers) || 0}</small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        <button class="btn btn-sm fw-bold book-btn w-100 position-relative" onclick="navigatePage(${card.id})">
                            <span id="btnText-${card.id}">Book</span>
                            <div id="spinner-${card.id}" class="spinner-border spinner-border-sm text-light d-none" role="status"></div>
                        </button>
                    </div>
                </div>
            </div>`;
        cardCol.innerHTML = cardHTML;
        cardRow.appendChild(cardCol);
        contentContainer.appendChild(cardRow);
    });
};
const searchArtist = (event) => {
    if (event.key === "Enter" || event.keyCode === 13) {
        const div = document.getElementById('tabs-container');
        searchTerm = event.target.value.trim();
        if (event.target.value.trim() === '') {
            div.style.pointerEvents = 'auto';
        }
        else {
            div.style.pointerEvents = 'none';
        }
        setActiveTab("All", tabs);
    }
};
function handleScroll() {
    const scrollPosition = window.scrollY + window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;
    if (scrollPosition >= documentHeight - 100 && !isLoading) {
        renderTabContent();
    }
}
function attachScrollListener() {
    window.addEventListener('scroll', handleScroll);
}
attachScrollListener();
const setActiveTab = (activeTab, tabs) => {
    const allTabs = document.querySelectorAll("#tabs-container .nav-link, .dropdown-item");
    allTabs.forEach((tab) => {
        if (!tab || !tab.textContent) {
            console.warn("Tab or its textContent is null");
            return;
        }
        const isActive = tab.textContent.trim() === activeTab;
        tab.classList.toggle("active", isActive);
        tab.classList.toggle("fw-bold", isActive);
    });
    const _activeTab = tabs.find(tab => tab.name === activeTab);
    pageIndex = 1; // Start from the first page
    members = []; // Clear the existing members array
    // Clear the content container
    const contentContainer = document.getElementById('tab-content-container');
    if (contentContainer) {
        contentContainer.innerHTML = '';
    }
    tab_name = _activeTab ? _activeTab.name : activeTab;
    renderTabContent();
    if (tab_name !== "All") {
        searchInput.value = '';
        clearButton.classList.add('d-none');
    }
};
const navigatePage = (id) => {
    const buttonText = document.getElementById(`btnText-${id}`);
    const spinner = document.getElementById(`spinner-${id}`);
    buttonText.classList.add("d-none");
    spinner.classList.remove("d-none");
    setTimeout(() => {
        spinner.classList.add("d-none");
        buttonText.classList.remove("d-none");
        window.location.href = `artist-profile?id=${id}`;
    }, 1000);
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
    }
    else {
        console.error('Modal element not found!');
    }
};
window.navigatePage = navigatePage;
window.showModal = showModal;
window.hideModal = hideModal;
window.searchArtist = searchArtist;
window.clearSearch = clearSearch;
export {};
