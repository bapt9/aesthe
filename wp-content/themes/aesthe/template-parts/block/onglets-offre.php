<?php

/**
 * Block Name: Onglets offre
 *
 *
 */

use GeminiLabs\SiteReviews\Modules\Dump;

if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Onglets Offre (cliquer pour modifier)</div>";
else :
?>
    <div class="wrapper  detailsOffreBlock">
        <ul class="detailsOffreBlock__content">
            <?php
            if (have_rows('onglets')) : $i = 0; ?>
                <?php while (have_rows('onglets')) : the_row(); ?>
                    <li>
                        <h2><?= the_sub_field('titre_onglet') ?></h2>

                        <div class="detailsOffreBlock__single">
                            <p><?= the_sub_field('explication_soin') ?></p>
                            <p class="detailsOffreBlock__single__legende"><?= the_sub_field('legende') ?></p>
                            <ul>
                                <?php
                                if (have_rows('liste')) : $i = 0; ?>
                                    <?php while (have_rows('liste')) : the_row(); ?>
                                        <li class="detailsOffreBlock__single__list">
                                            <?= the_sub_field('liste') ?>
                                        </li>
                                <?php endwhile;
                                endif ?>
                            </ul>
                        </div>
                    </li>
            <?php endwhile;
            endif ?>
        </ul>
    </div>

<?php
endif;
?>