<?php
/**
 * Block Name: Simple tabs
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Onglets (cliquer pour modifier)</div>";
else: ?>


<section class="simpleTabs simpleTabs--<?= $block['id'] ?>">
    <div class="circle"></div>
    <h2> <?= get_field('titre'); ?></h2>
    <?php if( have_rows('onglets') ): ?>
        <ul class="simpleTabs__controls">
            <?php while( have_rows('onglets') ): the_row();?>
                <li class="simpleTabs__controls__single<?php if(get_row_index()==1):?> active<?php endif;?>">
                    <?php the_sub_field('nom'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <div class="simpleTabs__content">
            <?php while( have_rows('onglets') ): the_row();?>
                <div class="simpleTabs__content__single">
                    <p>
                        <?php the_sub_field('texte'); ?>
                    </p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
      
</section>



<?php endif; ?>