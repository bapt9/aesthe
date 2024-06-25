<?php

/**
 * Block Name: Centre_grille
 *
 * 
 * Tuto : Créer le fichier centre_grille.php et l'initialiser dans le fichier function.php. Ensuite, aller dans ACF et créer un groupe de champ "Centre grille" puis créer un champ "object de publication" et selectionner "Centres" dans le type de champ + Un champ "Titre". 
 * Permettre d'en ajouter plusieurs et pour  * finir régler sur : montrer le BLOC quand "Bloc" est égal à "Centres grilles".
 * 
 * Dans le CPT : Centre >> Rajouter 2 champs (Image + description) qui reprend exactement les mêmes noms que dans le code ci-dessous ;)
 */

use GeminiLabs\SiteReviews\Modules\Dump;

?>

<?php
if (is_admin()) :
    echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Centres en grille</div>";
else :
    global $post;
    $featured_posts = get_field('centres');
?>
    <section id="ctn_centres_grilles">
        <div id="ctn_centres_grilles_ctn">
            <?php foreach ($featured_posts as $centre) :
                if ($featured_posts) : setup_postdata($post); ?>
                    <div class="centre__informations centre_grille">
                        <!-- centre image -->
                        <?php $image_centre_grille = get_field("image_du_centre", $centre->ID); ?>
                        <div class="centre__image_grille" style="background:url(<?php echo $image_centre_grille['url'] ?>); background-position:center; background-size: cover;min-height:275px;"></div>
                        <!-- centre informations -->
                        <div class="centre__informations__texte">
                            <div class="centre__informations__contact">
                                <!-- Nom du centre + adresse du centre -->
                                <h3><?php echo get_field("titre", $centre->ID) ?></h3>
                                <?php $contact = get_field("contact", $centre->ID);
                                if ($contact) : ?>
                                    <p class="cicg_txt"> <?php echo $contact["rue"] ?>
                                        <?php echo $contact["ville"] ?>
                                    </p>
                                    <h3 class="mt40">Téléphone : </h3>
                                    <p class="cicg_txt">
                                        <?php echo $contact["telephone"] ?>
                                    </p>
                                <?php endif ?>

                                <!-- Horaires -->
                                <?php $horraires = get_field("horraires", $centre->ID); ?>
                                <?php if ($horraires) : ?>
                                    <h3 class="mt40">Horaires d'ouverture</h3>
                                    <p class="cicg_txt">
                                        <span>Du lundi au vendredi : <?php echo $horraires["lundi_vendredi"] ?></span></br>
                                        <span>Samedi : <?php echo $horraires["samedi"] ?></span>
                                    </p>
                                <?php endif ?>
                                <?php $description = get_field("description", $centre->ID); ?>
                                <p class="cicg_txt mt30"><?php echo $description ?></p>
                                <a style="display:none" href="#" class="centres_grille_lk mt30">Découvrir</a>

                            </div>
                        </div>
                    </div>
            <?php endif;
                wp_reset_postdata();
            endforeach; ?>
        <?php endif ?>
        </div>

    </section>