<?php
/**
 * Block Name: Etapes
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Etapes (cliquer pour modifier)</div>";
else: ?>


<section class="steps steps--<?= $block['id'] ?>">
    <h2>
        <?php the_field('titre');?>
    </h2>
    <?php if( have_rows('etapes') ): ?>
        <div class="steps__list">
            <?php while( have_rows('etapes') ): the_row();?>
                <div class="steps__single steps__single--<?php echo sanitize_title(get_sub_field('nom'));?>">
                    <div class="steps__single__name">
                        <?php the_sub_field('nom');?>
                    </div>
                    <p>
                        <?php the_sub_field('texte');?>
                    </p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>



<?php endif; ?>