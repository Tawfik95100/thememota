<div id="dropdownbox">
  <?php
  $taxonomies = [
      'categorie' => 'CATÉGORIES',
      'format'    => 'FORMATS',
      'annees' => 'TRIER PAR',
  ];

  foreach ($taxonomies as $taxonomy_slug => $label) {
      $terms = get_terms($taxonomy_slug);

      if (!is_wp_error($terms) && !empty($terms)) {
          echo "<select id='{$taxonomy_slug}' class='custom-select taxonomy-select'>";
          echo "<option value=''>{$label}</option>";

          if ($taxonomy_slug === 'annees') {
             
              echo "<option value='recentes'>A partir des plus récentes</option>";
              echo "<option value='anciennes'>A partir des plus anciennes</option>";
          } else {
              
              foreach ($terms as $term) {
                  echo "<option value='{$term->slug}'>{$term->name}</option>";
              }
          }

          echo "</select>";
      }
  }

  ?>
</div>



<div id='galerie_photo'>

<?php

$galerie_photo = array(
    "post_type" => 'photos',
    "posts_per_page" => 8,
    "orderby" => 'date',
    "order" => 'ASC',
    );

$image_query = new WP_Query($galerie_photo);

wp_localize_script('ajax', 'chargement', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'query_vars' => json_encode($galerie_photo)
));


if ($image_query->have_posts()) :

set_query_var('photo_block_args', array('context' => 'front-page'));

while($image_query->have_posts()) :
    $image_query->the_post();
get_template_part('templates_part/photo_block', get_post_format());
?>

<?php
endwhile;
wp_reset_postdata();
else :
    echo 'pss de photo';
endif;
?>

<div class="chargerplus">
<button class="charger_plus" data-page="1" data-url="<?php echo admin_url( 'admin-ajax.php' ); ?>">Charger plus</button>
</div>
</div>