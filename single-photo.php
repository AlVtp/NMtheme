<?php get_header(); ?>

<div class="style-pages">
    <div class="content-container">
        <div class="text-content">
            <?php
            // The Loop
            while (have_posts()) {
                the_post();
                echo '<h2 class="title-class">' . get_the_title() . '</h2>';
                echo '<div class="reference-class">Référence : ';
                the_field('reference');
                echo '</div>';
                echo '<div class="category-class">Catégorie : ';
                the_terms(get_the_ID(), 'categorie');
                echo '</div>';
                echo '<div class="format-class">Format : ';
                the_terms(get_the_ID(), 'format');
                echo '</div>';
                echo '<div class="type-class">Type : ';
                the_field('type');
                echo '</div>';
                echo '<div class="date-class">Année : ' . get_the_date('Y') . '</div>';
            }
echo "<pre>";
 print_r(get_the_terms(get_the_ID(), 'categorie'));
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
        </div>

        <div class="image-content">
            <?php the_post_thumbnail('large'); ?>
        </div>
    </div>

    <div class="section-contact-carrousel">
        <div class="section-gauche">
            <p>Cette photo vous intéresse ?</p>
            <button id="contact-btn">Contact</button>
        </div>

        <div class="section-droite">
            <p>carrousel</p>
        </div>
    </div>

    <div class="photos-related">
        <h3 class="text-sup">
            <p>VOUS AIMEREZ AUSSI</p>
        </h3>
        <div class="photos-sup">
        <?php
    // The Query
    $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 2, 
        'orderby' => 'categorie' 
    );

    $related_photo_query = new WP_Query($args);

    // The Loop
    if ($related_photo_query->have_posts()) {
        while ($related_photo_query->have_posts()) {
            $related_photo_query->the_post();
            $image_url = get_the_post_thumbnail_url();
    ?>
        <img src="<?php echo esc_url($image_url); ?>" alt='photos related'>
    <?php
        }
    } 

    wp_reset_postdata();
    ?>

        </div>
    </div>


    <?php get_footer(); ?>