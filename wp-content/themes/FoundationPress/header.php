<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-144x144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-114x114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-72x72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/apple-touch-icon-precomposed.png">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> data-page="home">
	<?php do_action( 'foundationpress_after_body' ); ?>
	
	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<?php get_template_part( 'parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>
	<?php $upload_dir = wp_upload_dir(); ?>
	<div class="loader">
		<?php echo '<img src="' . $upload_dir['baseurl'] . '/skater.png" />'; ?>
		<?php echo '<img src="' . $upload_dir['baseurl'] . '/skater.png" />'; ?>
	</div>
	<header id="masthead" class="site-header" role="banner">
		<div class="ham">
			<button class="menu-icon" type="button" data-toggle="offCanvas"></button>
		</div>
		<div class="title-bar" data-responsive-toggle="site-navigation">
			<div class="title-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div>
		
		
		<div class="logo">
			<?php echo file_get_contents($upload_dir['baseurl'] . "/rollergirls_opt.svg")?>
		</div>

		<div class="logo-text">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div>

		<nav id="site-navigation" class="main-navigation top-bar" role="navigation">

			<!-- </div> -->
<!-- 			<div class="top-bar-left">
				<ul class="menu">
					<li class="logo"></li>
					<li class="home"></li>
				</ul>
			</div> -->
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'topbar' ) : ?>
					<?php get_template_part( 'parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
	</header>

	<div class="your-class">
	<?php
		$media_items = get_attachments_by_media_tags('media_tags=featured&return_type=li');
		if ($media_items) {
		    echo $media_items;
		}
	?>
	</div>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' ); ?>
