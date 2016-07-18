<?php
// $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

$image_array = get_field('banner_image');
$image = $image_array['url'];

if ( empty($image_array) ) {

	$args = array(
		'post_type'=>'interior_banner',
		'orderby'=>'rand',
		'posts_per_page'=>'1',
		);

	$the_query = new WP_Query( $args );
	if( $the_query->have_posts() ):
		while ( $the_query->have_posts() ) : $the_query->the_post();
	$image =  wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	endwhile;
	endif;
}
?>

<header id="featured-hero" role="banner" style="background-image: url('<?php echo $image; ?>')" ></header>