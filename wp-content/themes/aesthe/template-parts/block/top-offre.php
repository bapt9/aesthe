<?php

/**
 * Block Name: Top offre
 *
 *
 */

use GeminiLabs\SiteReviews\Modules\Dump;

if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Top Offre (cliquer pour modifier)</div>";
else :

    global $post;

    $image = get_field('photo');
    $titre_offre = get_the_title($post->ID);

    // récupération des déclinaisons soins dans un tableau
    $soins = array();
    $featured_posts = get_field('declinaisons_soins');
    if ($featured_posts) : setup_postdata($post);
        $cpt = 0;
        foreach ($featured_posts as $post) :
            $soins[$cpt]["titre"] = get_field('titre_declinaison', $post->ID);
            $soins[$cpt]["tarif"] = get_field('tarif', $post->ID);
            $soins[$cpt]["prix"] = preg_replace("/[^0-9]/", "", $soins[$cpt]["tarif"]);
            $soins[$cpt]["presentation"] = get_field('presentation', $post->ID);
            $soins[$cpt]["url_RDV"] = get_field('lien_rdv', $post->ID)['url'];
            $soins[$cpt]["sous_titre"] = get_field('sous_titre', $post->ID);
            $cpt++;            
        endforeach;
        wp_reset_postdata();
    endif;
    
?>
    <section class="topOffre topOffre__top">
        <div class="topOffre__imgWrap">
            <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
        </div>

        <!-- CODE MICRODNNEES -->
        <!-- <meta itemprop="highPrice" <?php if ($soins[0]["prix"]) : ?> content="<?= $soins[0]["prix"] ?>" <?php endif; ?> />
        <meta itemprop="lowPrice" <?php if ($soins[0]["prix"]) : ?> content="<?= $soins[0]["prix"] ?>" <?php endif; ?> />
        <meta itemprop="priceCurrency" content="EUR" /> -->
        <!-- FIN CODE MICRODNNEES -->

        <!-- BLOCK FICHES SOINS -->
        <div class="topOffre__titre">
            <h1><?= $titre_offre ?></h1>

            <!-- BOUTTONS FICHES SOINS -->
            <div class="topOffre__controls">
                <div class="topOffre__controls__container">
                    <?php if (count($soins) > 1) : ?>
                        <span>Sélectionnez un soin</span>
                        <ul class="topOffre__controls">
                            <?php foreach ($soins as $k => $soin) : ?>
                                <li class=" <?php if ($k == 0) : ?>active<?php endif; ?>"><?= $soin["titre"] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- DESCRIPTIONS FICHES SOINS -->
            <div class="topOffre__content">
                <?php foreach ($soins as $k => $soin) : ?>
                    <div class="topOffre__single" itemtype="https://schema.org/Product" itemscope>
                        <meta itemprop="name" content="<?= $soin["titre"] ?>" />
                        <meta itemprop="description" content="<?= $soin["presentation"] ?>" />
                        <p style="text-transform: uppercase"><?= $soin["sous_titre"] ?><strong> <?= $soin["titre"] ?></strong></p>
                        <div itemprop="offers" itemtype="https://schema.org/AggregateOffer" itemscope>
                            PRIX : <strong><?= $soin["tarif"] ?></strong>
                            <meta itemprop="lowPrice" content="<?= $soin["prix"] ?>" />
                            <meta itemprop="priceCurrency" content="EUR" />
                        </div>
                        <p><?= $soin["presentation"]; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- BOUTTON RDV -->
            <?php foreach ($soins as $k => $soin) : ?>
                <a class="topOffre__single__button <?php if ($k == 0) : ?>on<?php endif; ?>" href="<?= $soin["url_RDV"] ?>">
                    <button>Prendre rdv</button>
                </a>
            <?php endforeach; ?>
        </div>
        <!-- FIN BLOCK FICHES SOINS -->
    </section>

<?php endif; ?>