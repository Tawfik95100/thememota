<?php
$photo_titre = get_the_title();
$reference = get_field('reference');
$categories =get_the_terms(get_the_ID(),'categorie');
$nomcategorie = $categories[0]->name;
$photo = get_the_post_thumbnail_url(null,'large');
$post_url = get_permalink();
?>

<div class='bloc_affichage'>
    <img class= 'image' src="<?php echo esc_url($photo); ?>" alt="<?php echo esc_attr($photo_titre);?>">
    <div class='survol_photo'>
        <h2 class='referencephoto'> <?php echo esc_html($reference);?> </h2>
        <h3 class='categorie_photo'> <?php echo esc_html($nomcategorie); ?> </h3>
        <div > <a class='icon_eye' href="<?php echo esc_url($post_url);?>">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon_eye.svg" alt="voire plus">
         </a>  
        </div>
              <div class='icon_fullscreen' data-full='<?php echo esc_url($photo);?>' data-category='<?php echo esc_attr($nomcategorie);?>' date-reference='<?php echo esc_attr($reference);?>' >
               <img class='photo_fullscreen' src="<?php echo esc_url(get_template_directory_uri());?>/assets/images/icon_fullscreen.svg" alt="plein ecran">
              </div>
    </div>

</div>