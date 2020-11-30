<?php
/**
 * Template part for displaying the entry content.
 *
 * @package Ordinary
 */

?>

    <div class="entry-content">
        <?php
        the_content( sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ordinary' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ) );

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ordinary' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <div class="entry-divider"></div>
    <?php if ( is_singular() ) : ?>
        <footer class="entry-footer">
        <?php ordinary_entry_footer(); ?>
        </footer><!-- .entry-footer -->
     <?php endif; ?>
