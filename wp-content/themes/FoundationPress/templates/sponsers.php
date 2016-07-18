<?php

/*
Template Name: Sponsors

*/

get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div id="page" role="main">
    <?php do_action( 'foundationpress_before_content' ); ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="small-12 medium-6 medium-push-6 large-8 large-push-4 columns no-padding ">
                <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">

                    <?php

                        do_action( 'foundationpress_page_before_entry_content' );
                        $pagename = $post->post_name;
                    ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php

                        $args = array(
                            'post_type'=>'sponsor',
                            'meta_key' => 'link',
                            'meta_key' => 'sponsor',
                            'posts_per_page'=> -1,
                        );

                        $the_query = new WP_Query( $args );
                    ?>

                    <div class="sponsor-list">
                    <?php if( $the_query->have_posts() ): ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post();
                            $selected = get_field('sponsor');
                            if ( in_Array($pagename, $selected) ) :
                        ?>
                                <div class="small-12 large-4 columns">
                                    <div class="sponsor">
                                        <a class="sponsor-logo-link" href="<?php echo get_field('link'); ?>" target="_blank">
                                            <div class="sponsor-image">
                                                <?php the_post_thumbnail() ?>
                                            </div>
                                            <div class="overlay">
                                                <?php the_title(); ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </div>

                    <?php wp_reset_query(); ?>

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