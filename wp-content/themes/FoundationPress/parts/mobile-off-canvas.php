<?php
/**
 * Template part for off canvas menu
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<nav class="off-canvas position-left" id="offCanvas" data-off-canvas data-position="left" role="navigation">
  <?php foundationpress_mobile_nav(); ?>
  <?php $upload_dir = wp_upload_dir(); ?>
  <?php echo '<img src="' . $upload_dir['baseurl'] . '/rollergirls_opt.svg" />'; ?>
</nav>

<div class="off-canvas-content" data-off-canvas-content>
