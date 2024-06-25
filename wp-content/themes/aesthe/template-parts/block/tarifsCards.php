<?php

/**
 * Block Name: Cartes tarifs
 *
 * 
 */
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Cartes tarifs (cliquer pour modifier)</div>";
else :

    global $post;
    $get_cat = get_the_category($post->ID);
    $cat_epil = "";

    foreach ($get_cat as $c) :
        if ($c->cat_name == "Epilation laser") :
            $cat_epil = $c->cat_name;
        endif;
    endforeach;

    $tcards = array();
    $featured_posts = get_field('tarif_card');

    if ($featured_posts) : $tcpt = 0;
        foreach ($featured_posts as $post) : setup_postdata($post);
            $tcards[$tcpt]['ID'] = $post->ID;
            $tcards[$tcpt]['title'] = $post->post_title;
            $tcards[$tcpt]['offres'] = get_field('offers_card', $post->ID);
            $tcards[$tcpt]['button'] = get_field('offer_button', $post->ID);
            $tcards[$tcpt]['lien_epil'] = get_field('lien_carte_epilation', $post->ID);

            // var_dump($tcards[$tcpt]['button']);
            $tcpt++;
        endforeach;
        wp_reset_postdata();
    endif;

    $col_1 = array();
    $col_2 = array();
    $col_3 = array();

    foreach ($tcards as $i => $array) {
        if ($i === 0  || $i === 3 || $i === 6) :  $col_1[] = $array;
        elseif ($i === 1 || $i === 4 || $i === 7) : $col_2[] = $array;
        elseif ($i === 2 || $i === 5 || $i === 8) : $col_3[] = $array;
        endif;
    }

?>
    <section class="tarifsCards tarifsCards--<?= $block['id'] ?>">

        <div class="tarifsCard__col  col_1">
            <?php foreach ($col_1 as $card) :
                // var_dump($card);
            ?>
                <article class="tarifsCard">
                    <h3 class="tarifsCard__title"><?= $card['title'] ?></h3>
                    <div class="tarifsCard__offers">
                        <?php foreach ($card['offres'] as $o) : ?>
                            <?php if (!empty($o['offer_link'])) : ?>
                                <a target="_blank" href="<?php echo $o['offer_link']["url"] ?>">
                                <?php endif; ?>
                                <div class="tarifsCard__offer <?php if (!empty($o['offer_link'])) : echo ' linked';
                                                                endif; ?>">
                                    <div class="tarifsCard__offer__separator"></div>
                                    <div class="tarifsCard__offer__infos">
                                        <h6 class="tarifsCard__offer__title"><?= $o['title_offer'] ?></h6>
                                        <?php if (!empty($o['duration'])) : echo "<span>" . $o['duration'] . "</span></br>";
                                        endif ?>
                                        <span><?= $o['details'] ?></span>
                                    </div>
                                    <div class="tarifsCard__offer__price">
                                        <?= $o['price'] ?>
                                    </div>
                                </div>
                                <?php if (!empty($o['offer_link'])) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach ?>
                        <?php if ($card['button'] === true && $cat_epil != "Epilation laser") :
                        ?>
                            <a target="_blank" href="<?php
                                                        if (!empty($card['lien_epil'])) : echo $card['lien_epil']["url"];
                                                        endif; ?>">
                                <button class='button__offer'> Voir l'offre </button>
                            </a>
                        <?php
                        endif ?>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>

        <div class="tarifsCard__col col_2">
            <?php foreach ($col_2 as $card) : ?>
                <article class="tarifsCard">
                    <h3 class="tarifsCard__title"><?= $card['title'] ?></h3>
                    <div class="tarifsCard__offers">
                        <?php foreach ($card['offres'] as $o) : ?>
                            <?php if (!empty($o['offer_link'])) : ?>
                                <a target="_blank" href="<?php echo $o['offer_link']["url"] ?>">
                                <?php endif; ?>
                                <div class="tarifsCard__offer <?php if (!empty($o['offer_link'])) : echo ' linked';
                                                                endif; ?>">
                                    <div class="tarifsCard__offer__separator"></div>
                                    <div class="tarifsCard__offer__infos">
                                        <h6 class="tarifsCard__offer__title"><?= $o['title_offer'] ?></h6>
                                        <?php if (!empty($o['duration'])) : echo "<span>" . $o['duration'] . "</span></br>";
                                        endif ?>
                                        <span><?= $o['details'] ?></span>
                                    </div>
                                    <div class="tarifsCard__offer__price">
                                        <?= $o['price'] ?>
                                    </div>
                                </div>
                                <?php if (!empty($o['offer_link'])) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach ?>
                        <?php if ($card['button'] === true && $cat_epil != "Epilation laser") :
                        ?>
                            <a target="_blank" href="<?php
                                                        if (!empty($card['lien_epil'])) : echo $card['lien_epil']["url"];
                                                        endif; ?>">
                                <button class='button__offer'> Voir l'offre </button>
                            </a>
                        <?php
                        endif ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="tarifsCard__col col_3">
            <?php foreach ($col_3 as $card) : ?>
                <article class="tarifsCard">
                    <h3 class="tarifsCard__title"><?= $card['title'] ?></h3>
                    <div class="tarifsCard__offers">
                        <?php foreach ($card['offres'] as $o) : ?>
                            <?php if (!empty($o['offer_link'])) : ?>
                                <a target="_blank" href="<?php echo $o['offer_link']["url"] ?>">
                                <?php endif; ?>
                                <div class="tarifsCard__offer <?php if (!empty($o['offer_link'])) : echo ' linked';
                                                                endif; ?>">
                                    <div class="tarifsCard__offer__separator"></div>
                                    <div class="tarifsCard__offer__infos">
                                        <h6 class="tarifsCard__offer__title"><?= $o['title_offer'] ?></h6>
                                        <?php if (!empty($o['duration'])) : echo "<span>" . $o['duration'] . "</span></br>";
                                        endif ?>
                                        <span><?= $o['details'] ?></span>
                                    </div>
                                    <div class="tarifsCard__offer__price">
                                        <?= $o['price'] ?>
                                    </div>
                                </div>
                                <?php if (!empty($o['offer_link'])) : ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach ?>
                        <?php if ($card['button'] === true && $cat_epil != "Epilation laser") :
                        ?>
                            <a target="_blank" href="<?php
                                                        if (!empty($card['lien_epil'])) : echo $card['lien_epil']["url"];
                                                        endif; ?>">
                                <button class='button__offer'> Voir l'offre </button>
                            </a>
                        <?php
                        endif ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

    </section>
<?php endif; ?>