<?php

/**
 * Block Name: Siblings
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Siblings (cliquer pour modifier)</div>";
else :

    global $post;
    $current_post = $post;

    $args = array(
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_parent'    => $post->ID,
        'order'          => 'ASC',
        'orderby'        => 'menu_order'
    );

    $submenu_posts = new WP_Query($args);

    $current_ID = $post->ID;

    if (!empty($post->post_parent) || $post->post_parent != 0) {
        $args = array(
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_parent'    => $post->post_parent,
            'order'          => 'ASC',
            'orderby'        => 'menu_order'
        );
        $submenu_posts = new WP_Query($args);
    }

?>

    <section class="submenuSiblings submenuSiblings--<?= $block['id'] . $post->ID ?> larger  <?= (get_field('lien')) ? '' : 'nocta' ?>">
        <nav<?php if (!$submenu_posts->have_posts()) : ?> class="bread-centered" <?php endif; ?>>
            <?php if ($submenu_posts->have_posts()) : ?>

                <div class="siblings">
                    <h3>À VOIR AUSSI...</h3>
                    <ul>
                        <?php while ($submenu_posts->have_posts()) : $submenu_posts->the_post(); ?>
                            <?php if (get_the_ID() !== $current_ID) : ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?= get_the_title() ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif;
            wp_reset_postdata(); ?>
            </nav>

    </section>

<?php endif; ?>