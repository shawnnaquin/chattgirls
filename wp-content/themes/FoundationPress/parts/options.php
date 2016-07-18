<?php
$args = array(
    'post_type'=> array( 'skater', 'trainer', 'official', 'volunteer', 'coach' ),
    'orderby' => 'menu_order',
    'meta_query' => array(
        'key' => 'public_contact',
        'value' => 'yes'
    ),
    'meta_key' => 'contact_email',
    'meta_key' => 'contact_role',
    'posts_per_page'=> -1,
    );
// query
$the_query = new WP_Query( $args );
?>
    <option data-realname="please select" value="<?php echo get_option('admin_email'); ?>" selected="selected" disabled="disabled">
        Please select a contact&hellip;
    </option>

    <option data-realname="General" value="<?php echo get_option('admin_email'); ?>">
        General Inquiry
    </option>

    <?php if( $the_query->have_posts() ): ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <option data-realname="<?php the_title(); ?>" value="<?php echo get_field('contact_email'); ?>">
            <?php echo get_field('contact_role'); ?>
        </option>

        <?php endwhile; ?>
    <?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

<?php

    $args = array(
        'post_type'=> 'skater',
        'orderby' => 'menu_order',
        'meta_query' => array(
            'key' => 'public_contact',
            'value' => 'yes'
        ),
        'meta_key' => 'secondary_contact_email',
        'meta_key' => 'secondary_contact_role',
        'posts_per_page'=> -1,
        );

    // query
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ):
        while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
        <option data-realname="<?php the_title(); ?>" value="<?php echo get_field('secondary_contact_email'); ?>">
            <?php echo get_field('secondary_contact_role'); ?>
        </option>

        <?php endwhile; ?>
    <?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


<?php

    $args = array(
        'post_type'=> 'skater',
        'orderby' => 'menu_order',
        'meta_query' => array(
            'key' => 'public_contact',
            'value' => 'yes'
        ),
        'meta_key' => 'third_contact_email',
        'meta_key' => 'third_contact_role',
        'posts_per_page'=> -1,
        );

    // query
    $the_query = new WP_Query( $args );
    if( $the_query->have_posts() ):
        while ( $the_query->have_posts() ) : $the_query->the_post();
    ?>
        <option data-realname="<?php the_title(); ?>" value="<?php echo get_field('third_contact_email'); ?>">
            <?php echo get_field('third_contact_role'); ?>
        </option>

        <?php endwhile; ?>
    <?php endif; ?>
<?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


<option data-realname="Volunteers" value="Volunteers@ChattanoogaRollerGirls.com">
    Volunteers
</option>
