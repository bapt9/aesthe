<?php

/**
 * Block Name: Presse
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Presse (cliquer pour modifier)</div>";
else : ?>

    <?php global $post;
    $related_args = array(
        'post_type' => 'presse',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );
    $related = new WP_Query($related_args);

    if ($related->have_posts()) :
    ?>
        <section class="wrapper  pressBlock  pressBlock--<?= $block['id'] ?>">
            <h1>L'espace presse</h1>
            <h2><?= (get_field('titre_bloc')) ? get_field('titre_bloc') : 'Les articles qui <br>parlent de nous' ?></h2>

            <div class="flexAlignLeft  fourth">

                <?php while ($related->have_posts()) : $related->the_post();

                    setup_postdata($post); ?>
                    <a class="pressPosts__post" target="_blank" href="<?php the_field('lien', get_the_ID()) ?>">
                    <?php
                    echo "<div class=\"pressPosts__thumb\">";
                    the_post_thumbnail('pressThumb');
                    // include('wp-content/themes/aesthe/assets/img/postHover.svg');
                    echo "</div>";
                    echo "<div class=\"pressPosts__info\">";
                    echo "<div class=\"pressPosts__postTitleDate\">";
                    echo "<h3>" . get_the_title() . "</h3>";
                    echo "<div class=\"pressPosts__date date\">" . the_field('date', get_the_ID()) . "</div>";
                    echo "</div>";
                    the_field('paragraphe', get_the_ID());
                    echo "</div>";
                    echo "</a>";

                endwhile; ?>

                <?php
            endif;
            wp_reset_postdata();
                ?>
            </div>
        </section>

    <?php endif; ?>