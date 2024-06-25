<?php
/**
 * Block Name: Testi
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Témoignages (cliquer pour modifier)</div>";
else: ?>
	<section class="testiBlock  <?= (get_field('grande_taille')) ? 'big' : '' ?>  testiBlock--<?= $block['id'] ?>">


        <div class="testiBlock__sliderWrap">
            <h2>CE QU’ILS DISENT DE NOUS…</h2>
            <div class="testiBlock__slider">
                <?php
                global $post;
                $featured_posts = get_field('temoignages');
                if($featured_posts): ?>
                    <?php foreach($featured_posts as $post): 
                        setup_postdata($post); ?>
                        <div class="testiBlock__slide">
                            <div><?php the_field( 'temoignage', get_the_ID()); ?></div>
                            <div class="testiBlock__name"> <?php the_field( 'nom' , get_the_ID()); ?>, <?php the_field( 'description' , get_the_ID()); ?></div>
                        </div>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
            </div>
            <?php if(!empty(get_field('testi_lien'))) : ?>
            <a href="<?= get_field('testi_lien', 'option')['url'] ?>" class="cta"><?= get_field('testi_lien', 'option')['title'] ?></a>
            <?php endif ?>
        </div>



        <div class="testiBlock__imgWrap">
            <div class="circle  circle--purple"></div>
            <div class="circle  circle--coral"></div>
            <img class="testiBlock__img  testiBlock__img--0" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[0]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[0]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--1" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[1]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[1]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--2" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[2]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[2]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--3" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[3]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[3]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--4" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[4]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[4]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--5" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[5]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[5]['alt'] ?>">
            <img class="testiBlock__img  testiBlock__img--6" loading="lazy" src="<?= get_field('photos_bloc_temoignages', 'options')[6]['sizes']['medium'] ?>" alt="<?= get_field('photos_bloc_temoignages', 'options')[6]['alt'] ?>">            
        </div>

        

        
	</section>



<?php endif; ?>
