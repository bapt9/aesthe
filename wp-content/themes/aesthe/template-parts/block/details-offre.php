<?php

/**
 * Block Name: Details offre
 *
 *
 */

use GeminiLabs\SiteReviews\Modules\Dump;

if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Détails Offre (cliquer pour modifier)</div>";
else : ?>

    <div class="topOffre__pres">
        <?php if (have_rows('presentation')) : $i = 0; ?>
            <?php while (have_rows('presentation')) : the_row(); ?>
                <h2><?php the_sub_field('titre_pres'); ?></h2>
                <p><?php the_sub_field('presentation'); ?></p>
                <p class="topOffre__single__legende"><?php the_sub_field('legende'); ?></p>
            <?php endwhile; ?>
        <?php endif; ?>
        <div class=" topOffre__diagrammes">
            <?php get_template_part('template-parts/diagrammes-new'); ?>
        </div>
    </div>
    </div>
<?php
endif ?>