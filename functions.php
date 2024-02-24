<?php
// Enregistrement des styles et scripts
function theme_enqueue_styles()
{
    // Enregistrement de la feuille de style principale (style.css)
    wp_enqueue_style('style', get_stylesheet_uri());

    // Ajout du style 
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

// Déclaration du menu header
register_nav_menu('headerm', 'Menu Principal');

// Déclaration du menu footer
register_nav_menu('footerm', 'Menu Footer');

function theme_enqueue_script()
{
    // Enregistrement de la feuille de style principale (style.css)
    wp_enqueue_style('style', get_stylesheet_uri());

    // Ajout du js modale 
    wp_enqueue_script('NM-modale', get_template_directory_uri() . '/assets/js/modale.js', array(), '1.0');

    // Ajout de jQuery
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');

// ajout de taille custom pour les images de la gallerie de la page accueil
function custom_image_sizes()
{
    add_image_size('custom-size', 495, 564, false);
    add_image_size('filtered-photo', 800, 800, true);
    add_image_size('photo-grid', 560, 560, true); 
}
add_action('after_setup_theme', 'custom_image_sizes');



add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos() {
    $category = $_POST['category'];
    $format = $_POST['format'];
    $orderby = $_POST['orderby'];

    // Build the WP_Query args
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => -1,
        'orderby' => $orderby
    ];

    // Add taxonomy query if category is set
    if (!empty($category)) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $category
        ];
    }

    // Add taxonomy query if format is set
    if (!empty($format)) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format
        ];
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Display the photo directly
            if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            }
        }
    } else {
        echo 'No photos found.';
    }

    wp_die();
}
?>