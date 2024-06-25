<?php
/**
 * Block Name: Points de vente avec map
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Points de vente / map (cliquer pour modifier)</div>";
else: ?>



	<section class="wrapper  retailMapBlock  retailMapBlock--<?= $block['id'] ?>">

        <div class="retailMapBlock__infos">
            <?php if (have_rows('point_de_vente')) : $i=0; ?>
                <?php while (have_rows('point_de_vente')) : the_row(); ?>
                    <button class="retailMapBlock__item" data-latitude="<?= get_sub_field('latitude');?>" data-longitude="<?= get_sub_field('longitude');?>">
                        <h4><?= get_sub_field('nom') ?></h4>
                        <div class="retailMapBlock__text">
                            <p class="retailMapBlock__label">Adresse</p>
                            <a target="blank" href="https://maps.google.com/?q=<?= get_sub_field('latitude') ?>,<?= get_sub_field('longitude') ?>">
                                <p><?= get_sub_field('adresse_1') ?><br><?= get_sub_field('adresse_2') ?></p>
                                <p><?= get_sub_field('code_postal') ?> <?= get_sub_field('ville') ?></p>                                
                            </a>
                            <p><?= get_sub_field('telephone') ?></p>
                        </div>
                        <div class="retailMapBlock__text">
                            <p class="retailMapBlock__label">Horaires d'ouverture</p>
                            <p><?= get_sub_field('horaires_douverture') ?></p>
                            
                        </div>
                        
                    </button>


                <?php $i++; endwhile; ?>
            <?php endif; ?>
        </div>
        
        <div class="retailMapBlock__map">
            <div id="map"></div>
        </div>
        
	</section>

<?php endif; ?>
