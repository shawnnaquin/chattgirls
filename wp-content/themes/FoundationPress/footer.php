<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */
?>

		</section>

		<div id="footer-container">
			<footer id="footer">
				<div class="footer-content">
					<div class="small-2 medium-4 large-1 columns">
						<img src="<?php echo get_option('site_logo'); ?>" alt="site logo" role="logo" />
					</div>
					<div class="small-10 medium-8 large-11 columns ">
						<?php wp_nav_menu(array('depth' => 1)); ?>
					</div>
				</div>
				<div class="footer-social">
					<div class="small-12 columns footer-social-icons">
					<?php if ( get_option('facebook') ) : ?>
						<a target="_blank" href="<?php echo get_option('facebook')?>">
							<i class="fa fa-facebook-square" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( get_option('twitter') ) : ?>
						<a target="_blank" href="<?php echo get_option('twitter')?>">
							<i class="fa fa-twitter-square" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					<?php if ( get_option('instagram') ) : ?>
						<a target="_blank" href="<?php echo get_option('instagram')?>">
							<i class="fa fa-instagram" aria-hidden="true"></i>
						</a>
					<?php endif; ?>
					</div>
				</div>

				<div class="small-12 columns footer-social-copyright">Copyright &copy; <?php echo date("Y") ?>&nbsp;<?php echo get_bloginfo('site_title'); ?></div>

				<div class="footer-widgets">
					<?php do_action( 'foundationpress_before_footer' ); ?>
					<?php dynamic_sidebar( 'footer-widgets' ); ?>
					<?php do_action( 'foundationpress_after_footer' ); ?>
				</div>

			</footer>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>

					</div><!-- Close off-canvas wrapper inner -->
				</div><!-- Close off-canvas wrapper -->
			</div><!-- Close off-canvas content wrapper -->
		</div><!-- Close #body -->
	</div> <!-- close SmoothState -->

<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>