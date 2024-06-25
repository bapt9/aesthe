<?php

/**
 * Block Name: Top guide
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Top guide (cliquer pour modifier)</div>";
else :
    // global $post;
    // $top = $post->post_content;
    // var_dump($post);
?>
    <section class="wrapper  topGuide  topGuideBlock--<?= $block['id'] ?>">
        <!-- <h1 class="topGuide__titre"><?= get_the_title() ?></h1> -->

        <?php
                // $image = wp_get_attachment_image($image_id);
                // echo "<div>" . $image . "</div>";
        ?>
    </section>
<?php endif ?>