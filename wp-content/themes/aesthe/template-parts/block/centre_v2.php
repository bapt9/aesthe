<?php

/**
 * Block Name: Centre_v2
 *
 * 
 */

use GeminiLabs\SiteReviews\Modules\Dump;

?>

<?php
if (is_admin()) :
    echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Centre v2</div>";
else :
    global $post;
    $featured_posts = get_field('centres');
?>
    <section class="wrapper centreBackground centreBlock--<?= $block['id'] ?>">
        <div class="centre" id="custom_swiper_centrev2">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($featured_posts as $centre) :
                        if ($featured_posts) : setup_postdata($post); ?>

                            <div class="swiper-slide centre__informations">
                                <div class="centre__informations__map">
                                    <?php echo get_field("maps", $centre->ID) ?>
                                </div>
                                <div class="centre__informations__texte">
                                    <div class="centre__informations__contact">
                                        <h2><?php echo get_field("arrondissement", $centre->ID) ?></h2>
                                        <h3><?php echo get_field("titre", $centre->ID) ?></h3>
                                        <?php $contact = get_field("contact", $centre->ID);
                                        if ($contact) : ?>
                                            <p> <?php echo $contact["rue"] ?></br>
                                                <?php echo $contact["ville"] ?></br>
                                                <?php echo $contact["telephone"] ?>
                                            </p>
                                        <?php endif ?>
                                    </div>
                                    <div class="centre__informations__acces">
                                        <div class="centre__informations__acces__logos">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                                                <circle cx="15" cy="15" r="13" stroke-width="2" stroke="#25303B" fill="white" />
                                                <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" fill="#25303B" font-weight="bold" font-size="17px">M</text>
                                            </svg>
                                            <?php $acces = get_field("acces", $centre->ID);
                                            if ($acces) :
                                                foreach ($acces["logos_metros"] as $logo) : ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                                                        <circle cx="15" cy="15" r="13" fill="<?php echo $logo["couleur"] ?>" />
                                                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" fill="<?php echo $logo["couleur_numero"] ?>" font-weight="bold" font-size="17px"><?php echo $logo["numero"] ?></text>
                                                    </svg>
                                            <?php endforeach;
                                            endif; ?>
                                        </div>
                                        <?php if ($acces) : ?>
                                            <span><?php echo $acces["informations_acces"] ?></span>
                                        <?php endif ?>
                                    </div>
                                    <div class="centre__informations__horraires">
                                        <?php $horraires = get_field("horraires", $centre->ID);
                                        if ($horraires) : ?>
                                            <span>Du lundi au vendredi : <?php echo $horraires["lundi_vendredi"] ?></span></br>
                                            <span>Samedi : <?php echo $horraires["samedi"] ?></span>
                                        <?php endif ?>
                                    </div>

                                    <!-- LIENS WEB -->
                                    <div class="centre__liens__web">
                                        <div class="centre__liens__nous-ecrire">
                                            <?php if (get_field("lien_ecrire", $centre->ID)) : ?>
                                                <a href="<?php the_field("lien_ecrire", $centre->ID) ?>">Nous écrire</a>
                                            <?php endif ?>
                                        </div>
                                        <div class="centre__liens__centres">
                                            <?php if (get_field("lien_centres", $centre->ID)) : ?>
                                                <a href="<?php echo esc_url(get_field("lien_centres", $centre->ID)); ?>">Voir tous nos centres</a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                    <?php endif;
                        wp_reset_postdata();
                    endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Swiper JS -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <!-- Initialize Swiper -->
            <script>
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            </script>
        </div>
    </section>
<?php endif ?>