<?php get_header(); ?>

<?php

global $post;
$current_post = $post;
$post_category = get_the_category($post->ID);

$cats = array();

foreach ($post_category as $pc) :
    $cats[] = $pc->name;
endforeach;

if (have_posts()) : while (have_posts()) : the_post(); ?>
        <section class="gutenbergSection  wrapper">
            <!-- <div class="offrePage"> -->

            <?php the_content(); ?>

            <!-- </div> -->
        </section>
<?php endwhile;
endif;
?>
<?php get_footer(); ?>