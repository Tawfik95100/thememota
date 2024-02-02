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
?>

<main class='main'>



<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post();
	?>
<h1 class='titre'>
	<?php the_title();?>
</h1> 
<section class='container'>
<?php the_content();?>
</section>
	<?php
endwhile; // End of the loop.
?>

</main>

<?php
get_footer();
?>

