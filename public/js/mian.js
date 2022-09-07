document.addEventListener('keydown', (e) => {
    if (e.keyCode === 81 && e.altKey) {
        window.location = "/history-pengunjung"
    }
    if (e.keyCode === 75 && e.altKey) {
        window.location = "/"
    }
})
document.addEventListener("DOMContentLoaded", function (event) {



    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                if (toggle.getAttribute("src") == "/images/icon/menu.svg") {
                    toggle.src = "/images/icon/x.svg";
                } else {
                    toggle.src = "/images/icon/menu.svg";
                };
                nav.classList.toggle('muncul')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink))

    // Your code to run since DOM is loaded and ready

    // const logoSidbar = document.getElementById('logo')
    // const imgSidbar = document.getElementById('logo-img')
    // const getImgUrl = imgSidbar.getAttribute('src');
    // const pattern = new RegExp('sengked', "gi")
    // if (pattern.test(getImgUrl)) {
    //     imgSidbar.style.width = '170px'
    //     logoSidbar.style.width = '40px'
    // }
});
