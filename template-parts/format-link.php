<?php
/**
 * Template part for displaying link posts
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Ordinary
 */

 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta"><?php ordinary_posted_on(); ?></div><!-- .entry-meta -->
        <?php endif; ?>

        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title"><a href="' . esc_url( ordinary_get_first_link() ) . '" rel="bookmark">', ' &rarr;</a></h1>' );

        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( ordinary_get_first_link() ) . '" rel="bookmark">', ' &rarr;</a></h2>' );
        endif; ?>
    </header><!-- .entry-header -->

    <?php ordinary_post_thumbnail(); ?>

    <?php get_template_part('template-parts/entry', 'content'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
