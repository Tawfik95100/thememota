<footer>
    <?php
    wp_nav_menu(['theme_location' => 'footer']);
    get_template_part('templates_part/modale');
    get_template_part('templates_part/lightbox');
    ?>
</footer>

<?php wp_footer()?>
</body>
</html>