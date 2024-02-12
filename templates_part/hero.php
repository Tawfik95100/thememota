<div class = 'entete'>

<h1>PHOTOGRAPHE EVENT</h1>

<?php

$image_aleatoire = array(
    "post_type" => "photos",
    "posts_per_page" => 1,
    "orderby" => "rand",
);

$image_query= new WP_Query($image_aleatoire);

if($image_query -> have_posts()) {
    while($image_query -> have_posts()) {
        $image_query -> the_post();
        echo get_the_post_thumbnail(get_the_ID(), "full");
    } wp_reset_postdata();
}
?>
</div>