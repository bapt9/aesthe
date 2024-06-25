<?php
/**
 * Block Name: UniversTop
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Haut de page Univers</div>";
else: ?>




<section class="universTop universTop--<?= $block['id'] ?>">
    <div class="universTop__wrap">
        <div class="universTop__img">
            <?php echo wp_get_attachment_image( get_field('image_de_fond')['ID'], 'large' ); ?>
        </div>
        <div class="universTop__title"><h1><?= get_field('titre')?></h1></div>        
    </div>
    <div class="circle circle--orange"></div>
</section>




<?php endif; ?>