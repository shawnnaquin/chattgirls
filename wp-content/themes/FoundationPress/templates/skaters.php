<?php 
/*
Template Name: Skaters
*/
// args

get_header(); ?>
<style>
    .js-height img {
        display:block;
        width:100%;
    }
</style>

<div role="main">

    <?php do_action( 'foundationpress_before_content' ); ?>

    <?php
    $args = array(
        'post_type'=>'skater',
        'orderby'=>'rand',
        'meta_key' => 'display_name',
        'meta_key' => 'number',
        'meta_key' => 'years_with',
        'meta_key' => 'gear',
        'meta_key' => 'occupation',
        'meta_key' => 'likes',
        'meta_key' => 'dislikes',
        'meta_key' => 'prior_athletic',
        'meta_key' => 'why',
        'meta_key' => 'favorite_moment',
        'meta_key' => 'best_thing',
        'meta_key' => 'hardest_thing',
        'posts_per_page'=> -1,
        );
// query
    $the_query = new WP_Query( $args );
    ?>
    <div class="row">
        <?php if( $the_query->have_posts() ): ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="js-height small-12 medium-6 large-4 xlarge-2 xxlarge-2 columns no-padding">
                    <a class="popup skater" href="#<?php echo get_field('number');?>">
                        <div class="overlay">
                            <button class="button bright">View More</button>
                        </div>
                        <div>
                            <h3><?php echo the_title();?> #<?php echo get_field('number');?></h3>
                        </div>
                        <?php the_post_thumbnail( 'large' ); ?>
                    </a>

                    <div id="<?php echo get_field('number');?>" class="zoom-anim-dialog mfp-hide">
                        <div class="featured-skater-widget">

                            <div class="row">
                                <div class="columns small-6 medium-3 large-2 featured-skater-image">
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </div>
                                <div class="small-6 medium-9 large-10 columns featured-skater-name no-padding">
                                    <h3 class="featured-skater-name"><?php if ( get_field('display_name') ): echo get_field('display_name'); else: echo the_title(); endif; ?> <br/>#<?php echo get_field('number'); ?></h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="featured-skater-info">
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Years with CRG:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('years_with');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Gear:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('gear');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Occupation:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('occupation');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Likes:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('likes');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">dislikes:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('dislikes');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Prior Athletic Experience:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('prior_athletic');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Why I Joined Roller Derby:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('why');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns" >
                                        <p class="featured-skater-label">Favorite Roller Derby Moment:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('favorite_moment');?></p>
                                    </div>
                                    <div class="featured-skater-years small-12 medium-4 large-2 columns end" >
                                        <p class="featured-skater-label">Hardest thing about Roller Derby:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('hardest_thing');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php //$sharrre_url = '/join-us'; $data_text = 'Join Us!'; include( $url . '/parts/social.php' );?>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
        <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
    </div>

    <?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer(); ?>


