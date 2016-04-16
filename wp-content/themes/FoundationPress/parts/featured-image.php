<?php 
    
$image = get_field('banner_image');

?>

	<header id="featured-hero" role="banner" <?php if( !empty($image) ): ?> style="background-image: url('<?php echo $image ?>')" <?php endif; ?> >
	</header>
	