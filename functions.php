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

    // Ajout du js lightbox 
    wp_enqueue_script('NM-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array(), '1.0');

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
    $order = 'DESC'; // default order

    if ($orderby === 'date : à partir des plus anciennes') {
        $orderby = 'date';
        $order = 'ASC';
    } elseif ($orderby === 'date : à partir des plus récentes') {
        $orderby = 'date';
        $order = 'DESC';
    }

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1; // get the page number from the AJAX request
    $posts_per_page = 8; // number of photos per page
    $offset = ($page - 1) * $posts_per_page; // calculate the offset

    // Build the WP_Query args
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => $posts_per_page,
        'offset' => $offset,
        'orderby' => $orderby,
        'order' => $order
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
        $post = get_post(); 
        if (has_post_thumbnail()) {
            echo '<div class="image-container">';
            the_post_thumbnail('large');
            echo '<div class="hover">';
            echo '<img id="fullscreen" class="fullscreen-hover" src="' . get_template_directory_uri() . '/assets/images/icone-fullscreen.png" alt="Fullscreen Icon">';
            echo '<img class="eye-hover" src="' . get_template_directory_uri() . '/assets/images/icone-oeil.png" alt="Eye Icon">';
            echo '<div class="id">';
            the_title('<h2>', '</h2>');
            echo '</div>';
            echo '<div class="categorie">';
            echo get_the_term_list($post->ID, 'categorie', '<p>', ', ', '</p>');
            echo '</div>';
            echo '</div>'; 
            echo '</div>'; 
        }
    }
} else {
        echo '<div class="no-photos">Toutes les images sont chargées sur la page.</div>';
    }

    wp_die();
}
?>
