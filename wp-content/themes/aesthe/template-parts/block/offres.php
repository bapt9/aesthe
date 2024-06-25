<?php

/**
 * Block Name: Offres
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Offres (cliquer pour modifier)</div>";
else : ?>


    <section class="offres offres--<?= $block['id'] ?>">

        <?php if (have_rows('offres')) : ?>
            <ul class="offres__controls">
                <?php while (have_rows('offres')) : the_row(); ?>
                    <li class="<?php if (get_row_index() == 1) : ?> active<?php endif; ?>">
                        <div class="offres__single__name">
                            <?php the_sub_field('nom'); ?>
                        </div>
                        <p>
                            <?php the_sub_field('catchphrase'); ?>
                        </p>
                    </li>
                <?php endwhile; ?>
            </ul>
            <div class="offres__content">
                <?php while (have_rows('offres')) : the_row(); ?>
                    <div class="offres__single">
                        <div class="offres__single__content">
                            <div class="offres__single__content__top">
                                <h3><?php the_sub_field('nom'); ?></h3>
                                <p><?php the_sub_field('catchphrase'); ?></p>
                            </div>
                            <p class="offres__single__text">
                                <?php the_sub_field('texte'); ?>
                            </p>

                            <?php if (have_rows('avantages')) : ?>
                                <ul class="offres__single__avantages">
                                    <?php while (have_rows('avantages')) : the_row(); ?>
                                        <li>
                                            <?php the_sub_field('avantage'); ?>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>

                            <?php $link = get_sub_field('lien');
                            if ($link) :
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                                <a class="cta" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            <?php endif; ?>


                            <?php if (get_sub_field('temoignage_texte')) : ?>
                                <div class="offres__single__testimonyWrap">
                                    <p class="offres__single__testimonyTitle">
                                        <?php _e('Témoignage'); ?>
                                    </p>
                                    <p class="offres__single__testimony">
                                        <?php the_sub_field('temoignage_texte'); ?>
                                    </p>
                                    <div class="offres__single__testimony__author">
                                        <p>
                                            <?php the_sub_field('temoignage_nom'); ?>
                                        </p>
                                        <?php
                                        $image = get_sub_field('temoignage_photo');
                                        if (!empty($image)) : ?>
                                            <?php echo wp_get_attachment_image($image['ID'], 'medium'); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <?php endif; ?>
                        </div>
                        <div class="offres__single__image">

                            <?php
                            $image = get_sub_field('image');
                            if (!empty($image)) : ?>
                                <?php echo wp_get_attachment_image($image['ID'], 'medium'); ?>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </section>

<?php endif; ?>