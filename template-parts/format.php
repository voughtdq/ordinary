<?php
/**
 * Template part for displaying format posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ordinary
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta"><?php ordinary_posted_on(); ?></div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php ordinary_post_thumbnail(); ?>

    <?php get_template_part('template-parts/entry', 'content'); ?>
</article><!-- #post-<?php the_ID(); ?> -->
