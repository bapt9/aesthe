<?php

/**
 * Block Name: Sous menu
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Sous-menu (cliquer pour modifier)</div>";
else :

    global $post;

?>

    <section class="submenuSiblings titre-cta submenuSiblings--<?= $block['id'] . $post->ID ?> larger  <?= (get_field('lien')) ? '' : 'nocta' ?>">

        <!-- ----------------------------------------------------- titre et lien RDV ------------ -->
        <?php if (get_field('titre')) : ?>
            <h1><?= get_field('titre'); ?></h1>
        <?php endif; ?>

        <?php
        $link = get_field('lien');
        if ($link) :
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
            <div class="cta--submenu">
                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
            </div>
        <?php endif; ?>

    </section>

<?php endif; ?>