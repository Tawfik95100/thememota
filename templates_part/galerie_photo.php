<div id='galerie_photo'>

<?php

$galerie_photo = array(
    "post_type" => 'photos',
    "posts_per_page" => 8,
    "orderby" => 'date',
    "order" => 'ASC',
    );

$image_query = new wp_query($galerie_photo);

if ($image_query -> have_posts());
while($image_query -> have_posts()) {
    $image_query -> the_post();
get_template_part('templates_part/photo_block', get_post_format());
}

?>
</div>