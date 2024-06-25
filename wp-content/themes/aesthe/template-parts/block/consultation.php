<?php

/**
 * Block Name: Consultation
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Consultation (cliquer pour modifier)</div>";
else : ?>

    <section class="wrapper consultationBlock__<?= get_field('image_position') ?> consultationBlock--<?= $block['id'] ?> ">

        <?php
        $image = get_field('image_consultation');
        $titre = get_field('titre_consultation');
        if (!empty($image)) :
            echo "<div class=\"consultationBlock__imgWrap\">";
            echo wp_get_attachment_image($image['ID'], 'medium');
            echo "</div>";
            echo "<div class=\"consultationBlock__content__" . get_field('image_position') . "\">";
            if (!empty($titre)) : 
            echo "<h2>" . get_field('titre_consultation') . "</h2>";
            endif;
            echo get_field('texte_consultation');
            echo "</div>";

        endif;
        ?>

    </section>

<?php endif; ?>