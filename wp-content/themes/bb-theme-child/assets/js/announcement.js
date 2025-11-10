/*
 * Close the announcement bar generated from the "Site Details" dashboard menu
 */
 
document.addEventListener('DOMContentLoaded', function () {
    
    const closeBtn = document.querySelector('.announcement-close');
    const announcementBar = document.getElementById('announcement-bar');

    if (closeBtn && announcementBar) {
        closeBtn.addEventListener('click', function () {
            announcementBar.style.display = 'none';
        });
    }
});