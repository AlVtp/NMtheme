<?php get_header(); ?>

<div class="hero-banner">
        <div class="photoHero">
        <?php
    // The Query
    $args = array(
        'post_type' => 'photo', // custom post type
        'posts_per_page' => 1, // get only one post
        'orderby' => 'rand' // order by random
    );

    $random_photo_query = new WP_Query($args);

    // The Loop
    if ($random_photo_query->have_posts()) {
        while ($random_photo_query->have_posts()) {
            $random_photo_query->the_post();
            $image_url = get_the_post_thumbnail_url();
    ?>
        <img src="<?php echo esc_url($image_url); ?>" alt='photo hero'>
    <?php
        }
    } else {
        // Fallback image in case no photo post is found
        echo '<img src="/wp-content/themes/NMtheme/assets/images/header.webp" alt="photo hero">';
    }

    wp_reset_postdata();
    ?>
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