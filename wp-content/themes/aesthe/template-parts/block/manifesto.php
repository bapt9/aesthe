<?php
/**
 * Block Name: Manifesto
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Manifesto</div>";
else: ?>




<section class="manifesto manifesto--<?= $block['id'] ?>">
    <div class="manifesto__backgroundWrap">
        <div class="manifesto__background">
            <svg viewBox="0 0 1028 997" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1025 996C1034.33 872.667 919.001 614.8 383.001 570C-286.999 514 257.001 184 257.001 110C257.001 50.8 86.3336 13.3333 1 2" stroke="white" stroke-width="3"/>
            </svg>

            <div class="circle circle--white"></div>

        </div>        
    </div>
    <div class="manifesto__content">
        <h2><?= get_field('titre')?></h2>
        <div><?= get_field('texte')?></div>
    </div>
    <div class="manifesto__image">
        <?php echo wp_get_attachment_image( get_field('photo')['ID'], 'medium' ); ?>
    </div>
    <div class="circle circle--orange"></div>
</section>



<?php endif; ?>