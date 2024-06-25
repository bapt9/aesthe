<?php

/**
 * Block Name: Centre
 *
 * 
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Centre (cliquer pour modifier)</div>";
else : ?>

    <section class="wrapper  centre">
        <div class="centre__cover">

            <?php
            $image = get_field('centre', 'option');
            if (!empty($image)) : ?>
                <?php echo wp_get_attachment_image($image['ID'], 'large'); ?>
            <?php endif; ?>
            <p class="h2"><?php the_field('centre_titre', 'option'); ?></p>
        </div>
        <div class="centre__main">
            <div>
                <h2 class="h1  fleya">
                    <?php the_field('centre_sous_titre', 'option'); ?>
                </h2>
                <?php the_field('centre_texte', 'option'); ?>
                <?php
                $link = get_field('centre_lien', 'option');
                if ($link) :
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                    <a class="cta" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
            <div class="centre__imgWrap">
                <?php
                $image_petite = get_field('centre_petite', 'option');
                $image_petite_url = $image_petite['url']; ?>
                <img src="<?= $image_petite_url ?>" alt="">
            </div>
            <div class="centre__imgWrap">
                <?php
                $image_plan = get_field('plan', 'option');
                $image_plan_url = $image_plan['url']; ?>
                <img src="<?= $image_plan_url ?>" alt="">
            </div>
            <!-- <div style="border-radius: 50px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.136758540863!2d2.3579154!3d48.8556025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671fd7c14bf85%3A0x12aa5b1fa0f52cef!2s29%20Rue%20Fran%C3%A7ois%20Miron%2C%2075004%20Paris!5e0!3m2!1sfr!2sfr!4v1660819183311!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> -->
        </div>
    </section>

<?php endif; ?>