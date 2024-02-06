<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage thememota
 * @since theme mota 1.0
 */

get_header();
//acf
$photo = get_field('photo');
$reference = get_field('reference');
$type = get_field('type');
$title = get_the_title();

//taxonomie
$categories =get_the_terms(get_the_ID(),'categorie');
$format =get_the_terms(get_the_ID(),'format');
$annees =get_the_terms(get_the_ID(),'annees');
$nomcategorie = $categories[0]->name;

$next_photo = get_next_post();
$previous_photo = get_previous_post();
$previous_thumbnail = $previous_photo ? get_the_post_thumbnail_url($previous_photo->ID,'thumbnail'):'';
$next_thumbnail = $next_photo ? get_the_post_thumbnail_url($next_photo->ID,'thumbnail'):'';

?>

<section class='album'>
    <div class='global_photo'>
        <div class='picture' data-reference='<?php echo esc_attr($reference);?>'>
                <img src="<?php echo esc_url($photo);?>" alt="<?php echo esc_attr($title);?>">
        </div>
        <div class=detail_photo>
            <h2> <?php echo esc_html($title);?> </h2>
            <?php 
            if($reference){
                echo '<p> Référence : ' . esc_html($reference) . ' </p>';
            }

            if($categories){
                echo '<p> Catégorie : ';
                foreach($categories as $categorie ) {
                    echo esc_html($categorie ->name) . ' ';
                }
                echo ' </p>';
            }

            if($format){
                echo '<p> Format : ';
                foreach($format as $format ) {
                    echo esc_html($format ->name) . ' ';
                }
                echo ' </p>';
            }

            if($type){
                echo '<p> Type : ' . esc_html($type) . ' </p>';
            }

            if($annees){
                echo '<p> Années : ';
                foreach($annees as $annee ) {
                    echo esc_html($annee ->name) . ' ';
                }
                echo ' </p>';
            }

            ?>
        </div>
    </div>

    <div class='prisecontact'>
        <div class='contact'>
            <p class='question'>Cette photo vous intéresse ?</p>
            <button class='bouttoncontact' data-reference='<?php echo $reference;?>'>Contact</button>
        </div>
             <div class='navphoto'>
                  <div class='apercu'></div>  
                      <div class=fleches>
                      <?php if (!empty($previous_photo)) : ?>
            <img class="fleche fleche-gauche" src="<?php echo get_theme_file_uri() . '/assets/images/flechegauche.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previous_thumbnail; ?>" data-target-url="<?php echo esc_url(get_permalink($previous_photo->ID)); ?>">
        <?php endif; ?>

        <?php if (!empty($next_photo)) : ?>
            <img class="fleche fleche-droite" src="<?php echo get_theme_file_uri() . '/assets/images/flechedroite.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $next_thumbnail; ?>" data-target-url="<?php echo esc_url(get_permalink($next_photo->ID)); ?>">
        <?php endif; ?>
                      </div> 
             </div>
    </div>

<div class='suggestion'>
    <div class='aimerez'>
        <h3>Vous aimerez AUSSI</h3>
    </div>
        <div class='cardphoto'>
            <?php 
            $categories = get_the_terms(get_the_ID(),'categorie');
            if($categories && !is_wp_error($categories))
            {
                $categorie_id= wp_list_pluck($categories,'term_id');
                $args = array(
                    'post_type'=> 'photos',
                    'posts_per_page'=> 2,
                    'orderby'=>'rand',
                    'post__not_in'=>array(get_the_ID()),
                    'tax_query' =>array(
                        array(
                          'taxonomy' =>'categorie',
                          'field'=>'term_id',
                          'terms'=>$categorie_id,
                        ),
                    ),
                );
                $compteur = 0 ;
                $images_similaire = new wp_query($args) ;
                while($images_similaire -> have_posts()){
                    $images_similaire -> the_post();
                    $photo = get_the_post_thumbnail_url(null,'large');
                    $reference = get_field('reference');
                    $nomcategorie = isset($categories[0]) ? $categories[0] -> name :'';
                    get_template_part('templates_part/photo_block');
                    $compteur ++ ;
                }
                if ( $compteur === 0 ){ 
                    echo ' <p> Pas de photo similaire dans la categorie: '. $nomcategorie .' </p> ';
                }
            }
            ?>
        
        </div>
</div>

</section>

<?php
get_footer();
?>