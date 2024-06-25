<?php
/**
 * Block Name: Engagements
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Engagements (cliquer pour modifier)</div>";
else: ?>



<h2 class="h2--engagements"><?= (get_field('titre_alternatif')) ? get_field('titre_alternatif') : 'Nos engagements' ?></h2>

<section class="engagements engagements--<?= $block['id'] ?>">

    <?php
    global $post;
    $cptTemp = 1;
    if(have_rows('engagement')): while(have_rows('engagement')) : the_row();
        echo "<div class=\"engagements__item\">";
        echo "<div class=\"engagements__number\">$cptTemp</div>";
        echo "<div class=\"engagements__text\">".get_sub_field('text')."</div>";
        echo "</div>";
        $cptTemp++;
    endwhile; else : endif;
    ?>
</section>



<?php endif; ?>