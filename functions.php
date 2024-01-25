<?php
// Enregistrement des styles et scripts
function theme_enqueue_styles() {
    // Enregistrement de la feuille de style principale (style.css)
    wp_enqueue_style('style', get_stylesheet_uri());

    // Ajout du style 
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/style.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
?>
