<?php
/**
 * Block Name: Tech meds
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Sélection offres (cliquer pour modifier)</div>";
else: ?>




<!--
    <div class="card">
        <button class="card__verso"><svg width="13" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.025 4.825L10.85 0l1.2 1.175-4.85 4.85 4.85 4.8-1.2 1.225L6.025 7.2 1.2 12.05 0 10.875l4.825-4.85L0 1.225 1.225 0l4.8 4.825z" fill="#4032B8"/></svg></button>
        <div class="card__titleBlock">
            <p class="card__header">Technique</p>
            <h4 class="h4">Acide Hyaluronique</h4>      
        </div>
        <div class="card__recto">Nos soins pontuels pour une beauté décomplexée</div>
        <div class="card__img card__recto"></div>       
        <div class="card__verso">
            <div >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit purus morbi et lectus. Pulvinar mollis ipsum commodo purus sit nisl nisl morbi. Ornare vel varius suspendisse est at orci arcu vulputate. Aliquam viverra velit at vel eget dignissim elit lorem.</div>
            <a class="cta cta--ghost" href="#">Découvrir</a>        
        </div>  
    </div>
-->

	<section class="wrapper  offresCardsBlock  offresCardsBlock--<?= $block['id'] ?>">

        <div class="cards__grid">
            <?php
            global $post;
            
            if( have_rows('offres_rep') ):

                while( have_rows('offres_rep') ): the_row();?>

                    <?php

                    $post = get_sub_field('offre');

                    setup_postdata($post);

                    get_template_part('template-parts/card',
                        null,
                        array(
                            'technique'   => get_sub_field('offre'),
                            'recto'   => get_sub_field('recto_carte'), 
                            'verso'   => get_sub_field('verso_carte'), 
                        )
                    );

                endwhile;

                wp_reset_postdata();
            endif; ?>
        </div>

	</section>

<?php if(get_field('is_slideshow')): ?>

    <section class="cardsSlideshowWrapper offresCardsBlock  offresCardsBlock--<?= $block['id'] ?>">

        <div id="controls-container">
            <div class="prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></div>
            <div class="next"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></div>
        </div>

        <div class="cardsSlideshow  third">
            <?php
            global $post;

            if( have_rows('techniques_rep') ):

                while( have_rows('techniques_rep') ): the_row();?>

                    <div class="cardsSlideshowSlide">

                    <?php

                    $post = get_sub_field('technique');

                    setup_postdata($post);

                    get_template_part('template-parts/card',
                        null,
                        array(
                            'technique'   => get_sub_field('technique'),
                            'recto'   => get_sub_field('recto_carte'),
                            'verso'   => get_sub_field('verso_carte'),
                        )
                    );?>

                    </div><?php

                endwhile;

                wp_reset_postdata();
            endif; ?>
        </div>
        
    </section>
<?php else: ?>
    <section class="wrapper  offresCardsBlock  offresCardsBlock--<?= $block['id'] ?>">

        <div class="cards__grid">
            <?php
            global $post;

            if( have_rows('techniques_rep') ):

                while( have_rows('techniques_rep') ): the_row();?>

                    <?php

                    $post = get_sub_field('technique');

                    setup_postdata($post);

                    get_template_part('template-parts/card',
                        null,
                        array(
                            'technique'   => get_sub_field('technique'),
                            'recto'   => get_sub_field('recto_carte'),
                            'verso'   => get_sub_field('verso_carte'),
                        )
                    );

                endwhile;

                wp_reset_postdata();
            endif; ?>
        </div>

    </section>
<?php endif; ?>

<?php endif; ?>
