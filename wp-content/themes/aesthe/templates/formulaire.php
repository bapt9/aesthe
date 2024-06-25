<?php /* Template Name: Formulaire */ ?>

<?php $local = strpos($_SERVER['DOCUMENT_ROOT'], "C:/web/") !== false; ?>
<?php $preprod = strpos($_SERVER['DOCUMENT_ROOT'], "make.thisispam") !== false; ?>

<!DOCTYPE html>
<html class="page-formulaire" <?php language_attributes(); ?>>

<head>
    <?php
    $titre = wp_title('', false);
    $titre = trim($titre);
    if (get_field('meta_title', get_the_ID())) $titre = get_field('meta_title');
    ?>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <meta name="facebook-domain-verification" content="yl47nsx11nhdeyzjau5tei2tjqsird" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-207934763-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-207934763-1', {
            'anonymize_ip': true
        });
    </script>
    <!-- end Global site tag (gtag.js) - Google Analytics -->

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

    <link href="<?= get_field('favicon', 'options')['url'] ?>" rel="icon" sizes="128x128" type="image/png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_field('favicon180', 'options')['url'] ?>">

    <script>
        // ie css vars — https://github.com/nuxodin/ie11CustomProperties
        window.MSInputMethodContext && document.documentMode && document.write('<script src="https://cdn.jsdelivr.net/gh/nuxodin/ie11CustomProperties@4.1.0/ie11CustomProperties.min.js"><\/script>');
    </script>

    <link href="<?= get_template_directory_uri(); ?>/style.css" rel="stylesheet">

    <link href="<?= get_template_directory_uri(); ?>/assets/js/code-min.js" rel="preload" as="script">

    <?php wp_head(); ?>

</head>

<body <?php body_class('slug-' . basename(get_permalink())); ?> <?= ($local || $preprod) ? 'local' : '' ?>>
    <div class="formulaire__header "><?php the_post_thumbnail($size = 'samll'); ?></div>

    <section class="gutenbergSection  wrapper formulaire">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
        <?php endwhile;
        endif;
        ?>
    </section>

</body>