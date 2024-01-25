<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>

<body>

    <header class="header">
        <nav id="nav" role="navigation">
            <a href="<?php echo home_url( '/' ); ?>">
                <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"
                alt="Logo">        
            </a>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'Menu',
                    'menu_id' => 'Menu',
                )
            );
            ?>
        </nav>
    </header>
</body>
