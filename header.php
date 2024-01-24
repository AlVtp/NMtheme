<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php blankslate_schema_type(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper" class="hfeed">
<header id="header" class="header">
	<div class="navbar">
	<div class="logo">
	<a href="http://nathalie-mota.local/" aria-label="Page d'accueil de Nathalie Mota">
				<img src="/Logo.png" alt="Logo Nathalie Mota">

    <div class="menu">
        <a href="#">ACCUEIL</a>
        <a href="#">À PROPOS</a>
        <a href="#">CONTACT</a>
    </div>
	</div>
	</div>
<div id="branding">
<div id="site-title" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
<?php
if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; }
echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" itemprop="url"><span itemprop="name">' . esc_html( get_bloginfo( 'name' ) ) . '</span></a>';
if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; }
?>
</div>
<div id="site-description"<?php if ( !is_single() ) { echo ' itemprop="description"'; } ?>><?php bloginfo( 'description' ); ?></div>
</div>


</header>
<div id="container">
<main id="content" role="main">
			<a href="http://nathalie-mota.local/" aria-label="Page d'accueil de Nathalie Mota">
				<img src="/Logo.png" alt="Logo Nathalie Mota">
			</a>
			