<?php
/**
 * Block Name: UniversPrices
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Univers prix justes</div>";
else: ?>




<section class="universPrices universPrices--<?= $block['id'] ?>">
    <div class="universPrices__img">
        <?php echo wp_get_attachment_image( get_field('image')['ID'], 'medium' ); ?>
    </div>
    <div class="universPrices__content">
        <div class="circle circle--nude"></div>
        <h2><?= get_field('titre')?></h2>
        <div class="universPrices__text"><?= get_field('texte')?></div>
        <a class="cta" href="<?= get_field('bouton')['url']?>"><?= get_field('bouton')['title']?></a>
    </div>
</section>



<?php endif; ?>