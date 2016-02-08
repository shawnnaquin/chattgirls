<?php
/*
Template Name: Front
*/
get_header(); ?>

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

	<div class="after-slick home_middle_sidebar middle-item-wrapper small-12 medium-8 columns">
		<?php dynamic_sidebar( 'home_middle_sidebar' ); ?>
	</div>

	<div class="after-slick middle-item-wrapper small-12 medium-4 columns">
		<div class="middle-item">
			<?php get_sidebar(); ?>
		</div>
	</div>

<section class="intro" role="main">
	<div class="fp-intro">

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
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
