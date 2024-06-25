<?php

/**
 * Block Name: Slider cards
 *
 * 
 */
?>

<?php
if (is_admin()) :
    echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Slider de cartes (cliquer pour modifier)</div>";
else :

?>

    <section class="sliderCardsSlider">
        <div class="sliderCards__controls">
            <li class="sliderCards__controls  --prev" aria-disabled>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/prev.svg" alt="">
            </li>
            <li class="sliderCards__controls  --next" aria-disabled>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/next.svg" alt="">
            </li>
        </div>
        <?php
        global $post;
        $featured_posts = get_field('techniques_offres');
        $get_titles = get_field('titre_slider');
        if ($featured_posts) :
            if ($get_titles) :
        ?>
                <h2><?= $get_titles ?></h2>
            <?php endif ?>
            <div class="sliderCards">
            <?php
            foreach ($featured_posts as $post) :
                setup_postdata($post);
                echo "<div class='sliderCards__cards'>";
                get_template_part('template-parts/card');
                echo "</div>";
            endforeach;
        endif; ?>
            <?php
            wp_reset_postdata();
            ?>
            </div>
    </section>
<?php endif; ?>