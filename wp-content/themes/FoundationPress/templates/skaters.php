<?php
/*
Template Name: Skaters
*/
// args

get_header(); ?>
<?php get_template_part( 'parts/featured-image' ); ?>
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
        'orderby' => 'menu_order',
        'order'     => 'ASC',
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
        'meta_key' => 'action_shot',
        'posts_per_page'=> -1,
        );
// query
    $the_query = new WP_Query( $args );
    ?>
    <div class="row">

    <!-- preload images -->
    <?php if( $the_query->have_posts() ): ?>
        <div style="display:none; height:0; width:0; opacity:0; visibility:hidden;">
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $img = get_field('action_shot'); ?>
                    <img src="<?php echo $img['sizes']['large']; ?>" alt="hidden" />
                    <img src="<?php echo $img['sizes']['xlarge']; ?>" alt="hidden" />
                    <img src="<?php echo $img['sizes']['xxlarge']; ?>" alt="hidden" />

        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <!-- end preload -->

        <?php if( $the_query->have_posts() ): ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <?php $img = get_field('action_shot'); ?>

                <style>

                    .featured-skater-widget.number-<?php echo get_field('number'); ?> {
                        background-image:url('<?php echo $img['sizes']['large']; ?>');
                    }

                    @media screen and (min-width:1200px) {
                        .featured-skater-widget.number-<?php echo get_field('number'); ?> {
                            background-image:url('<?php echo $img['sizes']['xlarge']; ?>');
                        }
                    }

                    @media screen and (min-width:1400px) {
                        .featured-skater-widget.number-<?php echo get_field('number'); ?> {
                            background-image:url('<?php echo $img['sizes']['xxlarge']; ?>');
                        }
                    }

                </style>

                <div class="js-height small-12 medium-6 large-3 xlarge-2 xxlarge-2 columns no-padding">

                    <a class="skater" href="#<?php echo get_field('number');?>" style="background-image:url('<?php the_post_thumbnail_url( 'large' ); ?> ');">
                        <div class="overlay">
                            <button class="button bright">View More</button>
                        </div>
                        <div>
                            <h3>
                                <?php echo the_title();?> #<?php echo get_field('number');?>
                                <button class="large button bright">View More</button>
                            </h3>
                        </div>
                    </a>

                    <div id="popup-<?php echo get_field('number');?>" class="mfp-hide popup">
                        <div class="featured-skater-widget-wrapper">
                        <div class="featured-skater-widget number-<?php echo get_field('number'); ?>" >

                            <!-- <div class="row"> -->
                                <div class="small-12 columns featured-skater-name no-padding">
                                    <h3 class="featured-skater-name">
                                    <?php echo the_title(); ?>
                                    <br/>#<?php echo get_field('number'); ?></h3>
                                </div>
                            <!-- </div> -->

                            <!-- <div class="row"> -->
                                <div class="featured-skater-info">

                                <?php if ( get_field('years_with') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Years with CRG:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('years_with');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('gear') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Gear:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('gear');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('occupation') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Occupation:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('occupation');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('likes') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Likes:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('likes');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('dislikes') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">dislikes:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('dislikes');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('prior_athletic') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Prior Athletic Experience:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('prior_athletic');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('why') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Why I Joined Roller Derby:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('why');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('favorite_moment') ) : ?>
                                    <div class="featured-skater-years small-12" >
                                        <p class="featured-skater-label">Favorite Roller Derby Moment:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('favorite_moment');?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ( get_field('hardest_thing') ) : ?>
                                    <div class="featured-skater-years small-12 end" >
                                        <p class="featured-skater-label">Hardest thing about Roller Derby:</p>
                                        <p class="featured-skater-answer"><?php echo get_field('hardest_thing');?></p>
                                    </div>
                                <?php endif; ?>

                                </div>
                            <!-- </div> -->
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


