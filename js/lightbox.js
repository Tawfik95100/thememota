$(document).ready(function(){
    const $categorie_lightbox = $(".categorie_lightbox");
    const $lightbox = $("#lightbox");
    const $imagelightbox = $("#img_lb");
    const $referencelightbox = $(".ref_lightbox");
    const $ouverturelightbox =$(".lightbox");
    let photo_actuel=0;

    function miseAjour(index){
        const $photos = $('.icon_fullscreen');
        const $photo = $photos.eq(index);

        const categorie_texte = $photo.data('category').toUpperCase();
        const reference_texte = $photo.data('reference').toUpperCase();

        $categorie_lightbox.text(categorie_texte);
        $referencelightbox.text(reference_texte);
        $imagelightbox.attr('src',$photo.data('full'));

        photo_actuel = index

    }

    function ouvertureLightbox(index){
        $ouverturelightbox.css("display","flex");
        miseAjour(index);
        $lightbox.show();
    }

    function fermetureLightbox(){
        $ouverturelightbox.css("display","none");
        $lightbox.hide();
    }

    function clicquePleinecran(){
        const $photos = $(".photo_fullscreen");
        const index = $photos.index($(this).closest(".photo_fullscreen"));
        ouvertureLightbox(index);
    }

    window.imageFull = function(){
        const $photos = $(".photo_fullscreen");
        $photos.off("click",clicquePleinecran);
        $photos.on("click",clicquePleinecran);
    }

    imageFull();

$('.fermeture_lightbox').on('click',fermetureLightbox);
$('.precedente_lb').on('click',function(){
    const $photos = $(".photo_fullscreen");
    photo_actuel = (photo_actuel - 1 + $photos.length )% $photos.length;
    miseAjour(photo_actuel);
}) 
$('.suivante_lb').on('click',function(){
    const $photos = $(".photo_fullscreen");
    photo_actuel = (photo_actuel + 1)% $photos.length;
    miseAjour(photo_actuel);
}) 

})

