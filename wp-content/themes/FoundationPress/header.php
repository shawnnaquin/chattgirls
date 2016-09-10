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

	<?php
		global $post;
		$slug = get_post( $post )->post_name;
		$upload_dir = wp_upload_dir();
	?>

	<body <?php body_class(); ?> data-name="<?php echo $slug; ?>" style="background-image:url('<?php echo get_option('background_image'); ?>');">

		<div id="smoothstate">

			<div class="smoothstate-loader js-smoothstate-loader">
				<div class="smoothstate-loader-dots">
					<div class="smoothstate-loader-dots-container">
						<div class="smoothstate-loader-dot one"></div>
						<div class="smoothstate-loader-dot two"></div>
						<div class="smoothstate-loader-dot three"></div>
					</div>
				</div>
			</div>

			<div id="body" <?php body_class(); ?> data-page="<?php echo $post_slug; ?>" >

	<?php
		do_action( 'foundationpress_after_body' );
		if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) :
	?>

				<div class="off-canvas-wrapper">
					<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
						<?php get_template_part( 'parts/mobile-off-canvas' ); ?>

	<?php
		endif;
	?>

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

	<?php
		do_action( 'foundationpress_layout_start' );
	?>

						<header id="masthead" class="site-header" role="banner">

							<div class="logo-text">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</div>

							<div class="title-bar">
								<!-- <div class="title-bar-title">
									<a href="<?php // echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php // bloginfo( 'name' ); ?></a>
								</div> -->
								<!-- <a class="mobile-logo" href="<?php // echo site_url(); ?>"><?php // echo file_get_contents(get_option('site_logo')); ?></a> -->
								<div class="ham">
									<button class="menu-icon" type="button" data-toggle="offCanvas"></button>
								</div>
							</div>


	<?php
		if ( get_option('site_logo_vector') ) {
			$vector = file_get_contents( get_option('site_logo_vector') );
		} else {
			$class = 'no-svg';
		}
	?>

							<div class="js-big-logo big-logo <?php echo $class ?>">
								<a href="<?php echo site_url(); ?>">
									<?php if ( !empty($vector) ) : echo $vector; endif; ?>
									<img src="<?php echo get_option('site_logo'); ?>" alt="site logo" role="logo" />
								</a>
							</div>

							<nav id="site-navigation" class="main-navigation top-bar" role="navigation">

								<div class="top-bar-left">
									<div class="js-small-logo small-logo">
										<a href="<?php echo site_url(); ?>"><img src="<?php echo get_option('site_logo'); ?>" alt="site logo" role="logo" /></a>
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