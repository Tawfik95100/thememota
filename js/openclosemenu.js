console.log('menu burger');

const hamburgerIcon = document.querySelector(".openmenu");
const crossIcon = document.querySelector(".closemenu");
const mobileMenu = document.querySelector(".mobile");
const body = document.querySelector("body");

function toggleMobileMenu(open) {
  mobileMenu.classList.toggle("open", open);
  hamburgerIcon.style.display = open ? "none" : "block";
  crossIcon.style.display = open ? "block" : "none";
  body.style.overflow = open ? "hidden" : "scroll";
}

hamburgerIcon.addEventListener("click", () => toggleMobileMenu(true));

crossIcon.addEventListener("click", () => toggleMobileMenu(false));