<?php
/*
Template Name: Front
*/
?>

<?php get_header();
$skate_left = get_template_directory_uri () . '/assets/images/ui/left.png';
$skate_right = get_template_directory_uri () . '/assets/images/ui/right.png';
?>

<style type="text/css">
	body {
		background-image:url('<?php echo $image_src ?>');
	}
</style>
<div class="slick-wrapper">
        <button type="button" data-role="none" class="slick-pre slick-arrow" aria-label="Previous" role="button">
        	<span>Previous</span>
	        <i class="fa fa-arrow-left" aria-hidden="true"></i>
	        <img src="<?php echo $skate_right; ?>" />
        </button>

        <button type="button" data-role="none" class="slick-nex slick-arrow" aria-label="Next" role="button">
        	<span>Next</span>
	        <i class="fa fa-arrow-right" aria-hidden="true"></i>
	        <img src="<?php echo $skate_right; ?>" />
        </button>

<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<ul class="slick slick-slider-home">

		<?php global $post;
		    $my_query = get_posts('numberposts=-1&post_type=main_banner');
		    foreach($my_query as $post) :
		        setup_postdata($post);
		        $link = get_post_meta($post->ID, 'site-url', true);
		        $subtitle = get_post_meta($post->ID, 'subtitle', true);
		?>
		        <li>
		        	<a href="<?php echo $link; ?>">
						<div class="slick-slide-titles">
							<div class="slick-slide-titles-wrapper">
								<h1><?php the_title(); ?></h1>
								<h2><?php echo $subtitle ?></h2>
							</div>
				        </div>
		        	</a>
		        	<?php the_post_thumbnail('full'); ?>
		        </li>
		<?php endforeach; ?>
		</ul>
</div>
	<div class="front-wrapper js-front-wrapper" >

			<div class="small-12 medium-4 columns no-padding js-spacer" style="display:none; height:1px;"></div>

			<div class="small-12 medium-4 columns no-padding home-left-sidebar js-sidebar" >
				<div>
					<?php get_sidebar(); ?>
				</div>
			</div>

			<div class="small-12 medium-8 large-4 columns no-padding home-middle-sidebar" >
				<?php dynamic_sidebar( 'home_middle_sidebar' ); ?>
			</div>

			<div class="small-12 medium-8 large-4 columns no-padding home-right-sidebar" >
				<?php dynamic_sidebar( 'home_right_sidebar' ); ?>
			</div>
		</div>

		<section class="intro" role="main">
			<div class="fp-intro">

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<footer>
						<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
						<p><?php the_tags(); ?></p>
					</footer>
					<?php do_action( 'foundationpress_page_before_comments' ); ?>
					<?php comments_template(); ?>
					<?php do_action( 'foundationpress_page_after_comments' ); ?>
				</div>

			</div>

		</section>

	<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>


<?php get_footer(); ?>
