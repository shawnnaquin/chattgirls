<?php
/*
Template Name: Personnel
*/
// args

get_header(); ?>
<?php get_template_part( 'parts/featured-image' ); ?>
<div role="main">

    <?php do_action( 'foundationpress_before_content' ); ?>

    <!-- TRAINER || 1st query -->
    <?php
    $args = array(
        'post_type'=>'trainer',
        'posts_per_page'=> -1,
        );
    $the_query = new WP_Query( $args );

    ?>

    <div class="row">
        <div class="columns small-12 no-padding">
            <h3>Trainers</h3>
        </div>
    </div>
    <div id="trainers" class="row js-hide-show">
    <?php if( $the_query->have_posts() ): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="js-height small-12 medium-6 large-3 xlarge-2 xxlarge-2 columns no-padding">
            <a class="popup skater" href="#<?php echo get_field('number');?>" style="background-image:url('<?php the_post_thumbnail_url( 'medium' ); ?> ');">
                <div class="overlay">
                </div>
                <div>
                    <h3>
                        <?php echo the_title();?>
                    </h3>
                </div>
            </a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>

    <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>



    <!-- OFFICIAL || 2nd query -->
    <?php
    $args = array(
        'post_type'=>'official',
        'orderby'=>'rand',
        'posts_per_page'=> -1,
        );
    $the_query = new WP_Query( $args );
    ?>
    <div class="row">
        <div class="columns small-12 no-padding">
            <h3>Officials</h3>
        </div>
    </div>
    <div id="officials" class="row js-hide-show">
    <?php if( $the_query->have_posts() ): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="js-height small-12 medium-6 large-3 xlarge-2 xxlarge-2 columns no-padding">
            <a class="popup skater" href="#<?php echo get_field('number');?>" style="background-image:url('<?php the_post_thumbnail_url( 'large' ); ?> ');">
                <div class="overlay">
                </div>
                <div>
                    <h3>
                        <?php echo the_title();?>
                    </h3>
                </div>
            </a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>

    <!-- VOLUNTEER || 3rd query -->
    <?php
    $args = array(
        'post_type'=>'volunteer',
        'orderby'=>'rand',
        'posts_per_page'=> -1,
        );
    $the_query = new WP_Query( $args );
    ?>
    <div class="row">
        <div class="columns small-12 no-padding">
            <h3>Volunteers</h3>
        </div>
    </div>
    <div id="volunteers" class="row js-hide-show">
    <?php if( $the_query->have_posts() ): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="js-height small-12 medium-6 large-3 xlarge-2 xxlarge-2 columns no-padding">
            <a class="popup skater" href="#<?php echo get_field('number');?>" style="background-image:url('<?php the_post_thumbnail_url( 'large' ); ?> ');">
                <div class="overlay">
                </div>
                <div>
                    <h3>
                        <?php echo the_title();?>
                    </h3>
                </div>
            </a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>

    <!-- ANNOUNCER || 4th query -->
    <?php
    $args = array(
        'post_type'=>'announcer',
        'orderby'=>'rand',
        'posts_per_page'=> -1,
        );
    $the_query = new WP_Query( $args );
    ?>
    <div class="row">
        <div class="columns small-12 no-padding">
            <h3>Announcers</h3>
        </div>
    </div>
    <div id="announcers" class="row js-hide-show">
    <?php if( $the_query->have_posts() ): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="js-height small-12 medium-6 large-3 xlarge-2 xxlarge-2 columns no-padding">
            <a class="popup skater" href="#" style="background-image:url('<?php the_post_thumbnail_url( 'large' ); ?> ');">
                <div class="overlay">
                </div>
                <div>
                    <h3>
                        <?php echo the_title();?>
                    </h3>
                </div>
            </a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
    </div>

    <?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer(); ?>


