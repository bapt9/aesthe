<?php

/**
 * Block Name: articles lies 
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Sommaire (cliquer pour modifier)</div>";
else :
    global $post;
    // var_dump($post);
?>
        <ul class="sommaire">
            <?php if (have_rows('sommaire')) : ?>
            <p class="sommaire__top">Sommaire</p>
            <?php
            $i = 1;
                while (have_rows('sommaire')) : the_row();
                    $link = get_sub_field('liens');
            ?>
                    <nav>
                        <span><?= $i++ . "." ?></span>
                        <a href="<?= $link["url"] ?>">
                            <p class="sommaire__titre"><?= $link["title"] ?></p>
                        </a>
                    </nav>
            <?php
                endwhile;
            endif
            ?>
        </ul>
<?php endif ?>