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

    <?php
// Get all terms of the 'categorie' taxonomy
$categories = get_terms(['taxonomy' => 'categorie']);

// Get all terms of the 'format' taxonomy
$formats = get_terms(['taxonomy' => 'format']);

// Get all orderby options
$orderby_options = ['ID', 'author', 'title', 'name', 'type', 'date', 'modified', 'rand'];
?>

<div class="filters">

<select id="category-filter">
    <option value="">CATÉGORIES</option>
    <?php foreach ($categories as $category) : ?>
        <option value="<?php echo $category->slug; ?>"><?php echo $category->name; ?></option>
    <?php endforeach; ?>
</select>

<select id="format-filter">
    <option value="">FORMATS</option>
    <?php foreach ($formats as $format) : ?>
        <option value="<?php echo $format->slug; ?>"><?php echo $format->name; ?></option>
    <?php endforeach; ?>
</select>

<select id="orderby-filter">
    <option value="">TRIER PAR</option>
    <?php foreach ($orderby_options as $option) : ?>
        <option value="<?php echo $option; ?>"><?php echo ucfirst($option); ?></option>
    <?php endforeach; ?>
</select>
</div>

<div id="photos-container">
    <!-- Photos will be loaded here -->
</div>
<div class="buton-container">
<button id="load-more">Charger plus</button>
</div>

<script>
var page = 1; // keep track of the current page

jQuery(document).ready(function($) {
    function loadPhotos() {
        var category = $('#category-filter').val();
        var format = $('#format-filter').val();
        var orderby = $('#orderby-filter').val();

        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            data: {
                action: 'filter_photos',
                category: category,
                format: format,
                orderby: orderby,
                page: page // add the current page to the AJAX request
            },
            type: 'POST',
            success: function(data) {
                $('#photos-container').append(data); // append the new photos to the container
            }
        });
    }

    $('#category-filter, #format-filter, #orderby-filter').change(function() {
        page = 1; // reset the page number
        $('#photos-container').empty(); // clear the photo container
        loadPhotos();
    });

    $('#load-more').click(function() {
        page++; // increment the page number
        loadPhotos();
    });

    // Load photos on page load
    loadPhotos();
});
</script>
    

</div>

<?php get_footer(); ?>