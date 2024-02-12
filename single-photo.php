<?php get_header(); ?>

<div class="style-pages">
<div class="content-container"> 
    <div class="text-content"> 
        <?php
        // The Loop
        while ( have_posts() ) {
            the_post();
            echo '<h2>' . get_the_title() . '</h2>';
            the_field('reference');
            the_terms(get_the_ID(),'categorie');
            the_terms(get_the_ID(),'format');
            the_field('type');
            echo get_the_date('Y'); 
        }

        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>

    <div class="image-content"> 
        <?php the_post_thumbnail('large'); ?>
    </div>
</div>

<div class="section-contact"> 
    <p>Cette photo vous intéresse ?</p>



</div>
<?php get_footer(); ?>