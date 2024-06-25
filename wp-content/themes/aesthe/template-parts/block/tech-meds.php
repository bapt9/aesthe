<?php
/**
 * Block Name: Tech meds
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Liste de cartes (cliquer pour modifier)</div>";
else: ?>



<!-- Cartes techniques et cartes offres de la page "offres" -->
<!-- Cartes techniques et cartes offres de la page "offres/xxx" -->
<?php
    $type = get_field('techniques_offres');

    if(get_field('is_slideshow')): ?>

	<section class="techMedsWrapper techMedsBlock is-slideshow techMedsBlock--<?= $block['id'] ?>">

        <div class="controls-container">
            <div class="prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></div>
            <div class="next"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></div>
        </div>

        <div class="techMedsSlideshow  third">
            <?php
            global $post;

            if( have_rows('techniques_rep')):
                while( have_rows('techniques_rep')): the_row();?>
                 <div class="techMedsSlide">
                   <?php
                    $post = get_sub_field('technique');

                    if($post){
                        setup_postdata($post);

                        get_template_part('template-parts/card',
                            null,
                            array(
                                'technique'   => get_sub_field('technique'),
                                'recto'   => get_sub_field('recto_carte'),
                                'verso'   => get_sub_field('verso_carte'),
                            )
                        );
                    }?>

                    </div>
                <?php endwhile;
                wp_reset_postdata();

                echo "<div class=\"techMedsSlide--endFix\"></div>";
            endif; ?>
        </div>
        
	</section>
<?php else: ?>
	<section class="wrapper  techMedsBlock  techMedsBlock--<?= $block['id'] ?>">

        <div class="techMedsGrid">
            <?php
            global $post;

            if( have_rows('techniques_rep') ):

                while( have_rows('techniques_rep') ): the_row();?>

                    <?php

                    $post = get_sub_field('technique');


                    if($post){
                        setup_postdata($post);

                        get_template_part('template-parts/card',
                            null,
                            array(
                                'technique'   => get_sub_field('technique'),
                                'recto'   => get_sub_field('recto_carte'),
                                'verso'   => get_sub_field('verso_carte'),
                            )
                        );
                    }

                endwhile;

                wp_reset_postdata();
            endif; ?>
        </div>

	</section>
<?php endif; ?>


<?php endif; ?>
