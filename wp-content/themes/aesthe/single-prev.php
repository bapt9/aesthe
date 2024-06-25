<?php get_header(); ?>


<div class="site-main wrapper">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?>>
                <div class="circle circle--left"></div>
                <div class="circle circle--right"></div>
                <div class="post-content">
                  <?php the_content(); ?>
            </div>
    <?php endwhile; ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>