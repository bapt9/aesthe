<?php
    $breadcrumb_parents[] = array(
        get_the_title(6575),
        get_permalink(6575)
    );

    $breadcrumb_parents[] = array(
        $current_post->post_title,
        get_permalink($current_post->ID)
    );

    $numItems = count($breadcrumb_parents);

    $category = get_the_terms($post->ID, 'type');

?>

    <div class="<?= $category[0]->slug; ?>">
        <!--  en-ête a supprimer -->

        <section class="offreBanner topBanner">
            <div class="wrapper">

                <div class="offreBanner__card ">
                    <?php get_template_part('template-parts/card'); ?>

                </div>


                <div class="offreBanner__titleWrap">

                    <div class="breadcrumb">
                        <a href="<?= get_home_url(); ?>/"><?php _e('Accueil') ?></a>
                        <?php
                        $i = 0;
                        foreach ($breadcrumb_parents as $parent) :
                            if (++$i === $numItems) : ?>
                                <svg width="9" height="6" viewBox="0 0 4 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6C1.933 6 3.5 4.65685 3.5 3C3.5 1.34315 1.933 0 0 0V6Z" fill="#5D23D0" />
                                </svg> <span title="<?= $parent[0] ?>"><?= wp_trim_words($parent[0], 2) ?></span>
                            <?php else : ?>
                                <!--                    <svg width="7" height="7" viewBox="0 0 4 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 2.99993L0.5 5.59801L0.5 0.401855L4 2.99993Z" fill="#5D23D0"/></svg>-->
                                <svg width="9" height="6" viewBox="0 0 4 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 6C1.933 6 3.5 4.65685 3.5 3C3.5 1.34315 1.933 0 0 0V6Z" fill="#5D23D0" />
                                </svg> <a title="<?= $parent[0] ?>" href="<?= $parent[1]; ?>"><?= wp_trim_words($parent[0], 2) ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <h1 class="h1"><?php the_title(); ?></h1>
                </div>
                <div class="offreBanner__line"></div>
                <div class="offreBanner__intro"><?= get_field('introduction') ?></div>

            </div>
        </section>

        <!-- fin en-ête a supprimer -->

        <section class="offreProduits">
            <?php if (have_rows('produits')) : $i = 0; ?>
                <?php while (have_rows('produits')) : the_row(); ?>
                    <div class="offreProduits__item">
                        <div class="circle circle--left"></div>
                        <div class="offreProduits__imgWrap">
                            <?php echo wp_get_attachment_image(get_sub_field('photo')['ID'], 'medium'); ?>
                            <div class="offreProduits__docWrap offreProduits__docWrap<?= $i ?>">
                                <button onclick="document.querySelector('.offreProduits__docWrap<?= $i ?>' ).classList.remove('docVisible')"><?php include('wp-content/themes/aesthe/assets/img/close.svg'); ?></button>
                                <div>
                                    <h2>Avis du médecin</h2>
                                    <p><?= get_sub_field('avis_medecin') ?></p>
                                </div>

                            </div>
                        </div>

                        <div class="offreProduits__content">
                            <h2 class="h2"><?= get_sub_field('nom') ?></h2>
                            <div class="offreProduits__infos">
                                <div class="offreProduits__left"><?= get_sub_field('texte') ?></div>
                                <div class="offreProduits__right">
                                    <?php
                                    $featured_posts = get_sub_field('soins');
                                    if ($featured_posts) : ?>
                                        <ul class="offreProduits__soins">
                                            <?php foreach ($featured_posts as $post) :

                                                // Setup this post for WP functions (variable must be named $post).
                                                setup_postdata($post); ?>
                                                <li>
                                                    <div>
                                                        <p><?php the_title(); ?></p>
                                                        <p><?php the_field('tarif'); ?></p>
                                                    </div>

                                                    <a class="cta" href="<?= get_field('lien_rdv')['url'] ?>">Prendre rdv</a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php
                                        // Reset the global post object so that the rest of the page works correctly.
                                        wp_reset_postdata(); ?>
                                    <?php endif; ?>
                                    <div class="offreProduits__reviews">Avis clients</div>
                                    <div class="offreProduits__advices">
                                        <button>
                                            <p>Contre-indications éventuelles</p>
                                            <div class="offreProduits__advices--appear"><?= get_sub_field('contre_indications') ?></div>
                                        </button>
                                        <button>
                                            <p>Précautions avant ou après le traitement</p>
                                            <div class="offreProduits__advices--appear"><?= get_sub_field('precautions') ?></div>
                                        </button>
                                        <button>
                                            <p>Éviction sociale</p>
                                            <div class="offreProduits__advices--appear"><?= get_sub_field('eviction') ?></div>
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <button class="offreProduits__docButton" onclick=" if(document.querySelector('.offreProduits__docWrap<?php echo ($i) ?>' ).classList.contains('docVisible')){ document.querySelector('.offreProduits__docWrap<?php echo ($i) ?>' ).classList.remove('docVisible') } else {document.querySelector('.offreProduits__docWrap<?php echo ($i) ?>' ).classList.add('docVisible')}">Avis du médecin</button>
                            <div class="offreProduits__circles">
                                <?php if (have_rows('indicateurs')) : ?>
                                    <?php while (have_rows('indicateurs')) : the_row(); ?>
                                        <div class="offreProduits__circleItem">
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle style="transform:rotate(-90deg); transform-origin: center; " cx="13.5" cy="13.5" r="12" stroke="#D9D9D9" stroke-width="1" />
                                            </svg>
                                            <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle stroke-dasharray="75" stroke-dashoffset="<?= 75 / 100 * (100 - get_sub_field('pourcentage')) ?> " style="transform:rotate(-90deg); transform-origin: center;" cx="13.5" cy="13.5" r="12" stroke="black" stroke-width="3" />
                                            </svg>
                                            <div>
                                                <p><?= get_sub_field('titre') ?></p>
                                                <p><?= get_sub_field('chiffre') ?></p>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                endwhile; ?>
            <?php endif; ?>
        </section>

    </div>