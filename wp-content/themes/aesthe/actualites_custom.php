<?php

/*
Template Name: Actualités CPT
*/

get_header(); ?>

<div class="circle circle--left"></div>
<section class="blogTop wrapper">
    <h1 class=" h1">
        <?php single_post_title(); ?>
    </h1>
    <!-- <?php get_search_form(); ?> -->
</section>

<section class="blogMostRead wrapper">
    <h2 class="blogMostRead__title h2">Les articles les + lus</h2>
    <div class="blogMostRead__posts">

        <?php
        $args = array(
            'post_type' => array('conseils-corps', 'conseils', 'conseils-cheveux', 'conseils-detatouage', 'conseils-medicales', 'conseils-epilation', 'actualites'),
            'post_status' => array('publish'),
            'posts_per_page' => '-1',
            'order' => 'DESC'
        );
        /* mobile_key_visual_position */
        $query = new WP_Query($args);
        ?>
        <?php if ($query->have_posts()) {
            $cpt = 0;
            while ($query->have_posts()) {
                $query->the_post();
                if ($cpt <= 2) {
                    ?>
                    <a class="blogMostRead__post" href="<?= get_the_permalink() ?>">
                        <div class="blogMostRead__postImg">
                            <?php wp_get_attachment_image(the_post_thumbnail(), 'medium'); ?>
                        </div>
                        <div class="blogMostRead__postTitle ">
                            <div class="blogMostRead__date date">
                            <?php echo get_the_date('d.m.y'); ?>
                            </div>
                            <h4>
                                <?php the_title(); ?>
                            </h4>
                        </div>
                    </a>

                <?php }
                $cpt++;
            }
        } ?>
    </div>
</section>



<?php if ($query->have_posts()):
    $cpt = 0; ?>
    <section class="blogPosts wrapper custom_post_pw">
        <?php while ($query->have_posts()):
            $query->the_post();

            ?>
            <a class="blogPosts__post" href="<?php the_permalink(); ?>">
                <div class="blogPosts__thumb">
                    <?php if ($cpt = 0) {
                        wp_get_attachment_image(the_post_thumbnail(), 'medium');
                    } else {
                        wp_get_attachment_image(the_post_thumbnail(), 'blogThumb');
                    } ?>
                    <?php include('wp-content/themes/aesthe/assets/img/postHover.svg'); ?>
                </div>
                <div class="blogPosts__info">
                    <div class="blogPosts__postTitleDate">
                        <h4>
                            <?php the_title(); ?>
                        </h4>
                        <div class="blogPosts__date date">
                            <?php echo get_the_date('d.m.y'); ?>
                        </div>
                    </div>
                    <div class="blogPosts__excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>

            </a>
            <?php $cpt++;
        endwhile; ?>
    </section>
<?php endif; ?>



<section class="blogNav wrapper">
    <?php the_posts_pagination(); ?>
</section>




<?php get_footer(); ?>