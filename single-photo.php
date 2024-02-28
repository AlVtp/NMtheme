<?php get_header(); ?>

<div class="style-pages">
    <div class="content-container">
        <div class="text-content">
            <?php
            // The Loop
            while (have_posts()) {
                the_post();
                echo '<h2 class="title-class">' . get_the_title() . '</h2>';
                echo '<div id="reference" class="reference-class">Référence : ';
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
    <?php
    $next_post = get_next_post();
    if (!empty($next_post)) {
        echo get_the_post_thumbnail($next_post->ID, array(75, 75));
    }
    ?>
    <div class="fleches">
        <?php 
        $prev_link = '<img id="fleche-gauche" class="fleche-gauche" src="' . get_template_directory_uri() . '/assets/images/fleche-gauche.png" alt="image précédente">';
        $next_link = '<img id="fleche-droite" class="fleche-droite" src="' . get_template_directory_uri() . '/assets/images/fleche-droite.png" alt="image suivante">';
        previous_post_link('%link', $prev_link);
        next_post_link('%link', $next_link);
        ?>
    </div>
</div>
    </div>

    <div class="photos-related">
        <h3 class="text-sup">
            <p>VOUS AIMEREZ AUSSI</p>
        </h3>
        <div class="photos-sup">
    <?php
    // Get the current post's categories
    $categories = wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'ids'));

    // The Query
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field'    => 'term_id',
                'terms'    => $categories,
            ),
        ),
    );

    $related_photo_query = new WP_Query($args);

    // The Loop
    if ($related_photo_query->have_posts()) {
        while ($related_photo_query->have_posts()) {
            $related_photo_query->the_post();
            $image_url = get_the_post_thumbnail_url(null, 'large');
    ?>
            <img src="<?php echo esc_url($image_url); ?>" alt='photos related'>
    <?php
        }
    }

    wp_reset_postdata();
    ?>
</div>
    </div>
    </div>

    <?php get_footer(); ?>