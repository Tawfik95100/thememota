console.log('modale');

const formulaire = $(".background_color_modale");
const lien_contact = $("#menu-item-25");
const bouttoncontact = $(".bouttoncontact");
const reference = $("#reference")

const openModal = () => {
  formulaire.css("display", "flex");
  if(
    bouttoncontact.attr("data-reference") && 
    bouttoncontact.attr("data-reference").trim() !== ""
      ){
        reference.val(bouttoncontact.attr("data-reference"));
      }
  };

const closeModal = () => {
  formulaire.css("display", "none");
};

if (window.location.pathname === "/contact/") {
  openModal();
}

jQuery(document).ready(function($) {
  lien_contact.on("click", (event) => {
    event.preventDefault();
    openModal();
  });

  bouttoncontact.on("click", (event) => {
    event.preventDefault();
    openModal();
  });

  $(window).on("click", (event) => {
    if (event.target === formulaire[0]) {
      closeModal();
    }
  });
});