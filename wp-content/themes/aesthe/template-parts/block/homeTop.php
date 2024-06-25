<?php

/**
 * Block Name: HomeTop
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Haut de page</div>";
else : ?>

    <section class="homeTop homeTop--<?= $block['id'] ?>">
        <!-- <svg class="homeTop__circle" width="205" height="335" viewBox="0 0 205 335" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M205 4.21387V330.786C192.944 333.544 180.392 335 167.5 335C74.9923 335 0 260.008 0 167.5C0 74.9923 74.9923 0 167.5 0C180.392 0 192.944 1.45648 205 4.21387Z" fill="#5E2BD0" />
        </svg> -->
        <div class="homeTop__image  homeTop__image--0">
        <?php
        //  echo wp_get_attachment_image(get_field('photo_gauche')['ID'], 'medium'); ?>
        </div>
        <div class="homeTop__image  homeTop__image--1">
            <?php echo wp_get_attachment_image(get_field('photo')['ID'], 'medium'); ?>
        </div>
        <div class="homeTop__text">
            <?php include('wp-content/themes/aesthe/assets/img/logoBl.svg'); ?>
            <div class="homeTop__searchForm">
                <div class="searchForm__text">
                    <strong>L'excellence médicale au service de toutes les beautés. </strong></br>
                    Faites confiance à nos médecins pour prendre soin de votre peau et de votre visage.

                </div>
                <div class="searchForm__get">
                    <?php get_search_form(); ?>
                </div>
            </div>


            <!-- CTA -->
            <!-- <div class="homeTop__ctas">

               <?php
                $link = get_field('lien_univers');
                if ($link) :
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="cta cta--ghost" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
            <a class="cta" rel="noopener" href="<?= get_field('lien_rdv', 'options')['url'] ?>" target="_blank">Prendre rdv</a>
        </div> -->
        </div>

    </section>

<?php endif; ?>