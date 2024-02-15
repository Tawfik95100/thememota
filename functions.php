<?php
function thememota_supports() {
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menu('header','En tête');
    register_nav_menu('footer','Pied de page');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme','thememota_supports');

function enqueue_jquery() {
 wp_enqueue_script('jquery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'enqueue_jquery');

function thememota_supports_scripts(){
    wp_enqueue_style('style',get_template_directory_uri() . '/style/style.css');
    wp_enqueue_script('menu_mobile', get_template_directory_uri() . '/js/openclosemenu.js', array(), '1.0.0', true);
    wp_enqueue_script('modale', get_template_directory_uri() . '/js/modale.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '1.0.0', true);
    wp_localize_script('ajax', 'ajax_object', array('ajaxurl'=> admin_url('admin-ajax.php')));

    wp_enqueue_script('select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0', true);
    wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0');
    wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre_custom.js', array('jquery'), '1.0.0', true);
    }
add_action('wp_enqueue_scripts', 'thememota_supports_scripts');


function load_more_plus(){
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripcslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 8;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()){
            $photos->the_post();
            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean();
        echo $output;
    }
    else{
        ob_clean();
        echo 'aucune_photo';
    }
    die();
    
}

add_action('wp_ajax_nopriv_load_more','load_more_plus');
add_action('wp_ajax_load_more', 'load_more_plus');

function filtre_et_trie_photos(){
    $filter = $_POST['filter'];

    // Déterminer l'ordre de tri en fonction de la valeur du filtre années
    $sort_order = 'DESC'; // Par défaut, trier par les plus récentes

    if(isset($filter['annees'])) {
        if($filter['annees'] === 'anciennes') {
            $sort_order = 'ASC'; // Si l'utilisateur choisit "A partir des plus anciennes"
        }
    }

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'orderby' => 'date', // Tri par date
        'order' => $sort_order, // Ordre de tri (DESC pour le plus récent, ASC pour le plus ancien)
        'tax_query' => array(
            'relation' => 'AND',
        )
    );

    // Ajoute chaque filtre à la tax query si elle est définie
    if(!empty($filter['categorie'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field'    => 'slug',
            'terms'    => $filter['categorie'],
        );
    }

    if(!empty($filter['format'])){
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field'    => 'slug',
            'terms'    => $filter['format'],
        );
    }

    $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            get_template_part('templates_part/photo_block', null);
        }
        wp_reset_postdata();
    } else {
        echo '<p class="selectionFiltre">Aucune photo ne correspond aux critères de recherche spécifiés.</p>';
    }

    die();
}

add_action('wp_ajax_filter_photos', 'filtre_et_trie_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filtre_et_trie_photos');
