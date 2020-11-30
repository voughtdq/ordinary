<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ordinary
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            if ( ! has_post_format() ) :
                get_template_part( 'template-parts/content', get_post_type() );
            else :
                if ( 'link' === get_post_format() ) :
                    get_template_part( 'template-parts/format', get_post_format() );
                else :
                    get_template_part( 'template-parts/format' );
                endif;
            endif;

the_post_navigation( array(
    'prev_text' => __('Older: %title'),
    'next_text' => __('Newer: %title'),

) );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
