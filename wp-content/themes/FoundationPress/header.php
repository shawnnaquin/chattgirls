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
	<body <?php body_class(); ?> >
	<?php do_action( 'foundationpress_after_body' ); ?>
	
	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>


	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
			<?php get_template_part( 'parts/mobile-off-canvas' ); ?>
			<?php endif; ?>			

	<?php $upload_dir = wp_upload_dir(); ?>
	<div class="page-loader-wrapper js-page-loader-wrapper">
		<div class="page-loader-container js-page-loader-container">
			<div class="loader">
				<?php echo '<img src="' . $upload_dir['baseurl'] . '/skater_opt.svg" />'; ?>
				<?php echo '<img src="' . $upload_dir['baseurl'] . '/skater_opt.svg" />'; ?>
			</div>
			<div class="bar" role="bar">
				<div class="peg"></div>
			</div>
		</div>
	</div><!-- / page-loader-wrapper -->

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="ham">
			<button class="menu-icon" type="button" data-toggle="offCanvas"></button>
		</div>
		<div class="title-bar" data-responsive-toggle="site-navigation">
			<div class="title-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div>
		
		
		<div class="js-big-logo logo">
			<a href="<?php echo site_url(); ?>"><?php echo file_get_contents($upload_dir['baseurl'] . "/rollergirls_opt.svg"); ?></a>
		</div>

		<div class="logo-text">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div>

		<nav id="site-navigation" class="main-navigation top-bar" role="navigation">

			<!-- </div> -->
<!-- 			
				<ul class="menu">
					<li class="logo"></li>
					<li class="home"></li>
				</ul>
			</div> -->
			<div class="top-bar-left">
				<div class="js-small-logo logo">
					<a href="<?php echo site_url(); ?>"><?php echo file_get_contents($upload_dir['baseurl'] . "/rollergirls_opt.svg"); ?></a>
				</div>
			</div>
			<div class="top-bar-right">
				<?php foundationpress_top_bar_r(); ?>

				<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) == 'topbar' ) : ?>
					<?php get_template_part( 'parts/mobile-top-bar' ); ?>
				<?php endif; ?>
			</div>
		</nav>
	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' ); ?>
