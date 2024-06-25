<?php
/**
 * Block Name: Two tabs
 *
 *
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Onglets (cliquer pour modifier)</div>";
else: ?>


<section class="twoTabs twoTabs--<?= $block['id'] ?>">
    <?php if( have_rows('onglets') ): ?>
        <ul class="twoTabs__controls">
            <?php while( have_rows('onglets') ): the_row();?>
                <li class="twoTabs__controls__single<?php if(get_row_index()==1):?> active<?php endif;?>">
                    <?php the_sub_field('titre'); ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <div class="twoTabs__content">
            <?php while( have_rows('onglets') ): the_row();?>
                <div class="twoTabs__content__single">
                    <div>
                        <?php the_sub_field('texte');
                        $link = get_sub_field('lien');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="cta" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="mid">
                            <?php
                            $image = get_sub_field('image');
                            if( !empty( $image ) ): ?>
                                <?php echo wp_get_attachment_image( $image['ID'], 'medium' ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
      
</section>



<?php endif; ?>