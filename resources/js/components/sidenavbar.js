document.addEventListener("DOMContentLoaded", function () {
    var menu_btn = document.querySelector("#menu-btn");
    var sidebar = document.querySelector("#sidebar");
    if (window.innerWidth < 700) {
        sidebar.classList.toggle("active-nav");
        document.querySelector("#sideContainer").classList.toggle("active-nav");
    }
    menu_btn.addEventListener("click", () => {
        sidebar.classList.toggle("active-nav");
        document.querySelector("#sideContainer").classList.toggle("active-nav");
        if (window.innerWidth < 480) {
            var main = document.getElementsByTagName("main")[0];
            var footer = document.getElementById("footer");
            if (main.style.display === "none") {
                main.style.display = "block";
                footer.style.display = "block";
            } else {
                main.style.display = "none";
                footer.style.display = "none";
            }
        }

    });

});
