<?php

/**
 * Block Name: Diagrammes
 *
 * 
 */
?>


<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Diagrammes (cliquer pour modifier)</div>";
else : ?>

    <section class="newDiagrammes">
        <?php if (have_rows('diagrammes')) : ?>
            <?php while (have_rows('diagrammes')) : the_row(); ?>
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" stroke="#D9D9D9" />

                        <path class="circle" stroke-dasharray="<?php the_sub_field('pourcentage'); ?>, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" stroke="<?php the_sub_field('couleur'); ?>" />

                        <text x="18" y="16" class="nom"><?php the_sub_field('nom'); ?></text>
                        <text x="18" y="23" class="ligne"><?php the_sub_field('deuxieme_ligne'); ?></text>

                    </svg>
                </div>
            <?php endwhile; ?>
        <?php endif ?>
    </section>

<?php endif; ?>