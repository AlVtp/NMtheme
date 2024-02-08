<?php
// Enregistrement des styles et scripts
function theme_enqueue_styles() {
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

function theme_enqueue_script() {
    // Enregistrement de la feuille de style principale (style.css)
    wp_enqueue_style('style', get_stylesheet_uri());

    // Ajout du js modale 
    wp_enqueue_script('NM-modale', get_template_directory_uri() . '/assets/js/modale.js', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');

// ajout de taille custom pour les images de la gallerie de la page accueil
function custom_image_sizes() {
    add_image_size('custom-size', 495, 564, false); 
}
add_action('after_setup_theme', 'custom_image_sizes');

?>
