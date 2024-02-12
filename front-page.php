<?php get_header(); ?>

<div class="hero-banner">
        <div class="photoHero">
        <img src="/wp-content/themes/NMtheme/assets/images/header.webp" alt='photo hero'>

            <h2>PHOTOGRAPHE EVENT</h2>
        </div>
    </div>

    <div class="style-pages">

<?php
// The Query
$args = array(
    'post_type' => 'photo', //  type de publication personnalisé
    'posts_per_page' => -8, // affiche toutes les publications personnalisées
);

$projets_query = new WP_Query($args);

// The Loop
if ($projets_query->have_posts()) {
    while ($projets_query->have_posts()) {
        $projets_query->the_post();
?>

        <div class="photos">
            <?php 
            $media = get_attached_media('image');
            foreach($media as $image) {
                echo wp_get_attachment_image($image->ID, 'custom-size');
            }
            ?>
        </div>

<?php
    }
} else {

    echo 'Aucune photo trouvée.';
}

wp_reset_postdata();
?>

</div>

<?php get_footer(); ?>