<?php

/**
 * Block Name: Badges de confiance
 *
 *
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Badges de confiance (cliquer pour modifier)</div>";
else :

    $images = get_field('logos');
    $size = 'thumbnail';

?>

    <ul class="sliderBadgesGallery">
        <?php
        foreach ($images as $image) :
            echo "<li class='sliderBadgesGallery__logo'>" . wp_get_attachment_image($image['ID'], $size) . "</li>";
        endforeach;
        ?>
    </ul>

<?php endif; ?>