<?php
/**
 * Block Name: Avis du medecin
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Avis du médecin (cliquer pour modifier)</div>";
else: ?>



	<section class="  doctorBlock  doctorBlock--<?= $block['id'] ?>">
        <div class="circle  circle--blueLight"></div>
        <div class="doctorBlock__content" >
            <div>
                <?php echo wp_get_attachment_image( get_field('photo')['ID'], 'cardMini' ); ?>
                <h3><?= get_field('titre')?></h3>
                <p><?= get_field('texte')?></p>                 
            </div>
           
        </div>
	</section>



<?php endif; ?>