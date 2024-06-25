<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <!-- <h1 class="post-title"><?php the_title(); ?></h1> -->

        <section class="gutenbergSection  wrapper  single">
            <?php get_template_part('template-parts/block/fil-ariane'); ?>
            <div class="topGuide">
                <div class="topGuide__infos">
                    <h1 class="topGuide__titre"><?= get_the_title() ?></h1>
                    <div class="topGuide__image"> <?php the_post_thumbnail('small'); ?></div>
                    <div class="topGuide__excerpt"> <?php the_excerpt() ?></div>
                </div>
                <div class="topGuide__sommaire">
                    <?php get_template_part('template-parts/block/sommaire'); ?>
                </div>
            </div>
                <?php the_content(); ?>
        </section>
<?php endwhile;
endif; ?>

<?php get_footer(); ?>