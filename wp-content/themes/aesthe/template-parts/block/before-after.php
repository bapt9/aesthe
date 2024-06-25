<?php

/**
 * Block Name: Before after
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Before after (cliquer pour modifier)</div>";
else : ?>


    <section class="beforeAfter beforeAfter--<?= $block['id'] ?>">
        <div class="beforeAfter__text">
            <h2>
                <?php the_field('titre') ?>
            </h2>
            <p>
                <?php the_field('texte') ?>
            </p>
            <?php
            $link = get_field('lien');
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a class="cta" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
        </div>
        <div class="beforeAfter__image">

            <div class="beforeAfter__image__container">
                <figure class="beforeAfter__image__before" style="">
                    <?php
                    $image_before = get_field('image_before');
                    if (!empty($image_before)) : ?>
                        <?php echo wp_get_attachment_image($image_before['ID'], 'medium'); ?>

                    <?php endif;

                    $image_after = get_field('image_after'); ?>
                    <div class="beforeAfter__image__after" style="background-image: url(<?php echo esc_url($image_after['url']); ?>)">
                        <div class="beforeAfter__image__text">
                            Avant Après
                        </div>
                    </div>

                </figure>
                <input type="range" min="0" max="100" value="50" id="beforeAfter__range">
            </div>

        </div>
    </section>

<?php endif; ?>