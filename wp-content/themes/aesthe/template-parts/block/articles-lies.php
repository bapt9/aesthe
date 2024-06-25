<?php

/**
 * Block Name: articles lies 
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Articles liés (cliquer pour modifier)</div>";
else :
    global $post;
    $current_post = $post;
    $featured_posts = get_field('articles');
    $articles = array();

    setup_postdata($post);
    if ($featured_posts) :
        $cpt = 0;
        foreach ($featured_posts as $post) :
            $articles[$cpt]["titre"] = $post->post_title;
            $articles[$cpt]["excerpt"] = $post->post_excerpt;
            $cpt++;
        endforeach;
        wp_reset_postdata();
    endif;
?>
    <ul class="articlesLies">
        <h5 class="articlesLies__top">Articles associés</h5>
        <?php
        $i = 1;
        foreach ($articles as $k => $article) : ?>
            <li>
                <span>
                    <?= $i++ . "." ?>
                </span>
                <div>
                    <h2 class="articlesLies__titre"><?= $article["titre"] ?></h2>
                    <p class="articlesLies__excerpt"><?= wp_trim_words($article["excerpt"], 20) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif ?>