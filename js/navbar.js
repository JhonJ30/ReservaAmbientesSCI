function loadPage(url) {
    document.getElementById('iframeContent').src = url;

    let clickedLink = event.target;
    let navLinks = document.querySelectorAll('.navMenu a');

    navLinks.forEach(function(link) {
        link.classList.remove('active');
        link.classList.add('inactive');
    });

    clickedLink.classList.remove('inactive');
    clickedLink.classList.add('active');
}
