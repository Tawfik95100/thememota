<?php
get_header();?>

<main>
    <section class='header'>
<?php
get_template_part('templates_part/hero');
?>
    </section>
              <section class= 'galerie'>
              <?php
              get_template_part('templates_part/galerie_photo');
              ?>
              </section>
</main>

<?php
get_footer();
?>