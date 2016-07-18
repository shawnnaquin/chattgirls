<?php
/**
* The template for displaying pages
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages and that
* other "pages" on your WordPress site will use a different template.
*
* @package WordPress
* @subpackage FoundationPress
* @since FoundationPress 1.0.0
*/

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div id="page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="small-12 medium-6 medium-push-6 large-8 large-push-4 columns no-padding ">
				<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
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
				</article>
			</div>
			<div class="small-12 medium-6 medium-pull-6 large-4 large-pull-8 columns no-padding js-sidebar">
				<?php get_sidebar(); ?>
			</div>
		<?php endwhile;?>
	<?php do_action( 'foundationpress_after_content' ); ?>
</div>

<?php get_footer(); ?>
