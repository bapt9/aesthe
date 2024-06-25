<?php
$post_type = get_post_type($post->ID);
$post_type_obj = get_post_type_object($post_type);
$label = $post_type_obj->labels->singular_name;
$post_taxo = get_the_terms($post->ID, 'type');
$text = get_the_excerpt();
?>
<section class="container__cardNew">
    <article class="cardNew">
        <div class="cardNew__slide__1">
            <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
            <div class="cardNew__circle"></div>
        </div>
        <div class="cardNew__slide__2">
            <div class="cardNew__slide__2__head">
                <h3><?php the_title() ?></h3>
            </div>
            <div class="cardNew__slide__2__content">
                <p class="cardNew__slide__2__text ">
                    <?php
                    echo wp_trim_words($text, 18);
                    ?>
                </p>
                <a href="<?php the_permalink() ?>">
                    <button class="cardNew__slide__2__button cta--card">
                        Découvrir
                    </button>
                </a>
            </div>
        </div>
    </article>
</section>