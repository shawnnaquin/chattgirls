

<?php
/*
Template Name: Front
*/
$image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<?php
get_header(); ?>
<style type="text/css">
body {
	background-image:url('<?php echo $image_src ?>');
}
</style>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

	<div class="slick slick-slider-home">
		<?php
			$media_items = get_attachments_by_media_tags('media_tags=featured&return_type=li');
			if ($media_items) {
			    echo $media_items;
			}
		?>
	</div>
	<div class="js-add-equalizer" >
	<div class="small-12 medium-4 columns no-padding js-add-equalizer-watch home-left-sidebar" >
		<div>
			<?php get_sidebar(); ?>
		</div>
	</div>

	<div class="small-12 medium-8 large-4 columns no-padding js-add-equalizer-watch home-middle-sidebar" >
		<?php dynamic_sidebar( 'home_middle_sidebar' ); ?>
	</div>

	<div class="small-12 medium-8 large-4 columns no-padding js-add-equalizer-watch home-right-sidebar" >
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
