<?php $local = strpos($_SERVER['DOCUMENT_ROOT'], "C:/web/") !== false; ?>
<?php $preprod = strpos($_SERVER['DOCUMENT_ROOT'], "make.thisispam") !== false; ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <?php
    $titre = wp_title('', false);
    $titre = trim($titre);
    if (get_field('meta_title', get_the_ID())) $titre = get_field('meta_title');
    ?>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="facebook-domain-verification" content="yl47nsx11nhdeyzjau5tei2tjqsird" />
    <title><?= $titre; ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    </link>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/Fleya-Light.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/Fleya-Regular.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/AvenirLTStd-Light.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/AvenirLTStd-Roman.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/AvenirLTStd-Oblique.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/AvenirLTStd-Heavy.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link href="<?= get_template_directory_uri(); ?>/assets/fonts/AvenirLTStd-Medium.woff2" rel="preload" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />


    <link href="<?= get_field('favicon', 'options')['url'] ?>" rel="icon" sizes="128x128" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_field('favicon180', 'options')['url'] ?>">

    <script>
        // ie css vars — https://github.com/nuxodin/ie11CustomProperties
        window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');
    </script>

    <link href="<?= get_template_directory_uri(); ?>/style.css" rel="stylesheet">

    <!-- <link href="<?= get_template_directory_uri(); ?>/assets/js/code-min.js" rel="preload" as="script"> -->

    <?php wp_head(); ?>

</head>

<body <?php body_class('slug-' . basename(get_permalink())); ?> <?= ($local || $preprod) ? 'local' : '' ?>>

    <?php
    // iframe Pabau
    // if ($local == false) :
    //     $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    //     $our_website = get_the_permalink();
    //     if ($iPhone > -1 && !isset($_COOKIE['trust_pabau'])) {
    //         setcookie("trust_pabau", "1");
    //         header('Location: https://connect.pabau.com/safari_approve.php?ref=' . urlencode($our_website));
    //     }
    // endif;

    if (get_field('promo_visible', 'option')) {
        echo "<section class=\"announcementBar\">";
        if (have_rows('promotions', 'option')) : while (have_rows('promotions', 'option')) : the_row();
                echo "<div>" . get_sub_field('promotion') . "</div>";
            endwhile;
        endif;
        echo "</section>";
    }
    ?>

    <header class="siteHeader  wrapper  flexJcSB" data-img="<?= get_field('image_soins', 'term_15')['sizes']['thumbnail'] ?>,<?= get_field('image_epilation', 'term_15')['sizes']['thumbnail'] ?>,<?= get_field('image_visage', 'term_15')['sizes']['thumbnail'] ?>,<?= get_field('image_corps', 'term_15')['sizes']['thumbnail'] ?>,<?= get_field('image_cheveux', 'term_15')['sizes']['thumbnail'] ?>">
        <button class="burger"><span></span><span></span><span></span></button>

        <a class="siteHeader__logo" href="<?php bloginfo('url'); ?>/" aria-label="aesthé, médecine esthétique"><?php include('assets/img/logo.svg'); ?></a>

        <div class="siteHeader__nav__container">
            <?php wp_nav_menu(array('container' => 'nav', 'menu_class' => 'siteHeader__nav')); ?>
        </div>

        <div class="siteHeader__more">
            <?php
            $post_id = 'term_15';
            $link = get_field('cta_contact', $post_id);
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a class="cta  cta--ghost siteHeader__contact" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
            <?php
            $link = get_field('cta_prendre_rdv', $post_id);
            if ($link) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a class="cta--header" rel="noopener" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            <?php endif; ?>
            <?php
            // $link = get_field('cta_mon_compte', $post_id);
            // if ($link) :
            //     $link_url = $link['url'];
            //     $link_title = $link['title'];
            //     $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <!-- <a class="siteHeader__connect" rel="noopener" aria-label="connexion member" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php include('wp-content/themes/aesthe/assets/img/profile.svg'); ?></a> -->
            <?php
            // endif; 
            ?>
            <!--            <a class="siteHeader__lang" href="--><? //= get_bloginfo('url') 
                                                                    ?>
            <!--/en/" aria-label="version anglaise">--><?php //include('wp-content/themes/aesthe/assets/img/flag_en.svg'); 
                                                        ?>
            <!--</a>-->
        </div>
        <div class="siteHeader__subNavBG"></div>

    </header>