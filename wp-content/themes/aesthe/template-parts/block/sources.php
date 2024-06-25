<?php

/**
 * Block Name: Sources
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Sources (cliquer pour modifier)</div>";
else : ?>

    <?php
    global $post;
    $featured_posts = get_field('sources');

    if ($featured_posts) :
        echo "<section class=\"sourcesBlock\">";
        echo "<h2>En savoir plus...</h2>";
        echo "<ul>";
        foreach ($featured_posts as $post) :
            setup_postdata($post);
            echo "<li>";
            echo "<strong><a target=\"_blank\" href=" . $post['lien'] . "> \"" . $post['ancre'] . "\" </a></strong>";
            echo "<span> - " . $post['site'];
            if (!empty($post['date'])) :
                echo " - " . $post['date'];
            endif;
            echo "</span>";
            echo "</li>";
        endforeach;
        wp_reset_postdata();
        echo "</ul>";
        echo "</section>";
    endif;
    ?>

        <?php endif ?>