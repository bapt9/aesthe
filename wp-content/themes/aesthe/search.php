<?php

/** 
 * Search result page
 */

get_header();

global $wp_query;

// echo "<pre>";
// print_r($wp_query);
// wp_die();

// The Query
$tech_meds = [];
$articles = [];

if ($wp_query->have_posts()) :
    $posts = $wp_query->posts;
    foreach ($posts as $post) :
        $post_type = get_post_type($post->ID);
        if ($post_type == "offre" || $post_type == "tech-meds") :
            $tech_meds[] = $post;
        elseif ($post_type == "post" || $post_type = "page") :
            $articles[] = $post;
        endif;
    endforeach;
endif;
?>

<div class="searchPage">
    <!-- SECTION  TECHNIQUES ET OFFRES -->

    <?php if (count($tech_meds) > 0) : ?>

        <section class="searchPage__cardsTech-med sliderCardsSlider">
            <h2>Découvrir les soins</h2>
            <div class="searchPage__title">
                correspondants à ma recherche : <span> <?= get_query_var('s') ?><span>
            </div>
            <div class="sliderCards__controls">
                <li class="sliderCards__controls  --prev"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/prev.svg" alt=""></li>
                <li class="sliderCards__controls  --next"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt=""></li>
            </div>
            <div class="sliderCards">
                <?php
                global $post;
                foreach ($tech_meds as $post) :
                    setup_postdata($post);
                    echo "<div class='sliderCards__card'>";
                    get_template_part('template-parts/card');
                    echo "</div>";
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- SECTION CARD CONSULT -->
    <section class="searchPage__cardConsult">
        <div class="texteExplicatif">Chez aesthé, tout nouveau patient bénéficie d'une consultation personnalisée et gratuite avec l'un de nos médecins. Cet échange permet d'exposer au médecin les besoins de votre peau, de votre visage ou toutes vos interrogations concernant nos soins et nos techniques. Notre équipe est à votre écoute pour définir avec vous le protocole de soins qui vous conviendra.</div>
        <article class="cardNew">
            <div class="cardNew__slide__1" style="background-image: url(https://aesthe.com/wp-content/uploads/Copie-de-DSC05635-scaled.jpg)">
                <div class="cardNew__circle"></div>
            </div>
            <div class="cardNew__slide__2">
                <div class="cardNew__slide__2__head">
                    <h3>Ma consultation personnalisée</h3>
                </div>
                <div class="cardNew__slide__2__content">
                    <p class="cardNew__slide__2__text">
                        Chez aesthé, tout patient fait systématiquement l’objet d’une consultation approfondie avec l’un de nos médecins.
                    </p>
                    <button class="cardNew__slide__2__button cta cta--card cta--ghost">
                        <a href="https://aesthe.com/offres/consultation-medicale-aesthe/">
                            Découvrir</a>
                    </button>
                </div>
            </div>
        </article>
    </section>

    <!-- SECTION DES ARTICLES -->
    <section class="wrapper searchPage__articlesResult">
        <?php
        if (count($articles) > 0) :
            echo '<h2 style="margin-bottom: 1rem; margin-top: 2rem">Lire les articles</h2>';
        endif;
        foreach ($articles as $post) :
            require((dirname(__FILE__)) . '/template-parts/search-articles-pages.php');
        endforeach; ?>

    </section>
</div>

<?php get_footer(); ?>