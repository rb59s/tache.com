document.addEventListener("DOMContentLoaded", function () {

  const menuHamburger = document.querySelector(".menu");
  const navLinks = document.querySelector(".nav");
  const croix = document.getElementById("croix");

  if (menuHamburger && navLinks) {
    menuHamburger.addEventListener("click", function () {
      navLinks.classList.toggle("visible");
    });
  }

  if (croix && navLinks) {
    croix.addEventListener("click", function () {
      navLinks.classList.remove("visible");
    });
  }

  const trigger = document.querySelector(".localisation");
  const menu = document.querySelector(".account-menu");

  if (trigger && menu) {
    trigger.addEventListener("click", function (e) {
      e.stopPropagation();
      menu.style.display = (menu.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function (e) {
      if (!menu.contains(e.target) && !trigger.contains(e.target)) {
        menu.style.display = "none";
      }
    });
  }
});