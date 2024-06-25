<?php
/**
 * Block Name: Keywords
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Mots clés (cliquer pour modifier)</div>";
else: ?>


<section class="keywords keywords--<?= $block['id'] ?>">
    <svg viewBox="0 0 373 217" fill="none" xmlns="http://www.w3.org/2000/svg"><ellipse cx="264" cy="108.5" rx="109" ry="108.5" fill="#BAEAFF"/><path fill-rule="evenodd" clip-rule="evenodd" d="M88.9817 80.3149C134.398 87.6321 160.66 72.6521 171.428 51.995C171.544 51.7718 171.658 51.5481 171.771 51.3237C212.061 97.3152 210.261 167.449 166.333 211.604L83.1663 128.864L37.1298 83.0643C52.0098 78.5339 69.2656 77.1384 88.9817 80.3149ZM34.7263 80.6732L-0.00012207 46.1251C45.8617 0.0265337 120.275 -0.300096 166.207 45.3956C167.369 46.5518 168.502 47.7265 169.605 48.9186C169.338 49.4856 169.059 50.049 168.767 50.6083C158.781 69.7664 134.042 84.5361 89.4589 77.3531C68.5945 73.9916 50.3719 75.6367 34.7263 80.6732Z" fill="#0B219F"/></svg>
    <div class="keywords__text">
        
        <p><?= get_field('titre') ?></p>

        <?php
        echo "<div class=\"keywords__items  fleya\">";
        if( have_rows('mots') ): while( have_rows('mots') ) : the_row();
            echo "<div class=\"keywords__item\">";
            echo get_sub_field('mot');
            echo "</div>";
        endwhile; endif;
        echo "</div>";
        ?>        
    </div>
</section>

<?php endif; ?>
