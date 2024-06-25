<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section class="gutenbergSection  wrapper">

            <!-- <h1 class="post-title"><?php the_title(); ?></h1> -->
            <?php the_content(); ?>

        </section>
<?php endwhile;

endif;
?>

<?php get_footer(); ?>