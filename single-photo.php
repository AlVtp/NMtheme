<?php get_header(); ?>

<?php
$args = array(
    'post_type' => 'photo',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'categorie', 'format',
            'field'    => 'reference', 'type', 'image',
            'terms'    => 'photo',)
    )
);
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
    while ( $query->have_posts() ) {
        $query->the_post();
        echo '<h2>' . get_the_title() . '</h2>';
        the_content();
    }
} else {
    // no posts found
    echo 'No posts found';
}
/* Restore original Post Data */
wp_reset_postdata();
?>

<?php get_footer(); ?>