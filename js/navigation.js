console.log('ok nav');
jQuery(document).ready(function ($) {
    $(".fleche-gauche, .fleche-droite").hover(
      function () {
        const thumbnailUrl = $(this).data("thumbnail-url");
        $(".apercu").css(
          "background-image",
          "url('" + thumbnailUrl + "')"
        );
      },
      function () {
        $(".apercu").css("background-image", "none");
      });
  
    $(".fleche-gauche, .fleche-droite").on("click", function () {
      const targetUrl = $(this).data("target-url");
     window.location.href = targetUrl;
    });
  });