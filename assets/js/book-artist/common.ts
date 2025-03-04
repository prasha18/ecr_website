// Get the alert icon element
const alertIcon = document.getElementById('alertIcon') as HTMLDivElement;

// Function to show or hide the arrow based on scrollable content
function toggleArrowVisibility() {
    // Check if the content is scrollable (body scroll height exceeds window height)
    if (document.body.scrollHeight > window.innerHeight) {
        // Show the icon if the user scrolls down a bit
        if (window.scrollY > 100) {
            alertIcon.style.display = 'flex';
        } else {
            alertIcon.style.display = 'none';
        }
    } else {
        // Hide the icon if the content isn't scrollable
        alertIcon.style.display = 'none';
    }
}

// Scroll the page to the top when the icon is clicked
alertIcon.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth',
    });
});

// Listen to scroll events to toggle arrow visibility
window.addEventListener('scroll', toggleArrowVisibility);

// Call the function on page load to set initial visibility
toggleArrowVisibility();