<?php
/**
 * Block Name: Valeur
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Valeur (cliquer pour modifier)</div>";
else: ?>


<section class="bulletListBlock bulletListBlock--<?= $block['id'] ?>">
    <div class="circle circle--nude"></div>
    <h2><?= get_field('titre'); ?></h2>
    <div>
        <div class="bulletListBlock__part">
            <?php echo wp_get_attachment_image( get_field('photo_1')['ID'], 'medium' ); ?>
            <?php if (have_rows('liste_a_puces_1')) : ?>
                <ul>
                   <?php while (have_rows('liste_a_puces_1')) : the_row(); ?>
                        <li><?= get_sub_field('item') ?></li>
                   <?php endwhile; ?> 
                </ul>
            <?php endif; ?>         
        </div>
        <div class="bulletListBlock__part">
            <?php echo wp_get_attachment_image( get_field('photo_2')['ID'], 'medium' ); ?>
            <?php if (have_rows('liste_a_puces_2')) :  ?>
                <ul>
                   <?php while (have_rows('liste_a_puces_2')) : the_row(); ?>
                        <li><?= get_sub_field('item') ?></li>
                   <?php endwhile; ?> 
                </ul>
            <?php endif; ?>
        </div>          
    </div>
      
</section>



<?php endif; ?>