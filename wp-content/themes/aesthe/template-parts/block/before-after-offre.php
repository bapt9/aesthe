<?php

/**
 * Block Name: Before After v2

 *
 *
 */


if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Before after V2 (cliquer pour modifier)</div>";
else : ?>

    <section class="pageOffre avantApres">
        <div class="pageOffre avantApres">
            <h2>
                <?php the_field('titre') ?>

            </h2>
        </div>
        <div class="pageOffre avantApres__image">

            <!-- <div class="avantApres__rond"></div> -->
            <div class="pageOffre avantApres__image__container">
                <figure class="pageOffre avantApres__image__before">
                    <?php
                    $image_before = get_field('image_after');
                    if (!empty($image_before)) : ?>
                        <?php echo wp_get_attachment_image($image_before['ID'], 'medium'); ?>

                    <?php endif;

                    $image_after = get_field('image_before'); ?>
                    <div class="pageOffre avantApres__image__after" style="background-image: url(<?php echo esc_url($image_after['url']); ?>)">
                        <div class="pageOffre avantApres__image__text">
                            <?php the_field('texte_rond') ?>
                        </div>
                    </div>

                </figure>
                <input type="range" min="0" max="100" value="50" id="avantApres__range">
            </div>

            <p><?= the_field('legende') ?></p>
        </div>
    </section>

<?php endif; ?>