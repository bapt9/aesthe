<?php
/**
 * Block Name: Zone à traiter
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Zone à traiter (cliquer pour modifier)</div>";
else: ?>


    <section class="wrapper  zoneBlock  zoneBlock--<?= $block['id'] ?>">

        <h2>
            <?php the_field('titre') ?>
        </h2>

        <?php if( have_rows('zones') ): ?>
            <div class="zoneBlock__controls__container">
                <ul class="zoneBlock__controls">
                    <?php while( have_rows('zones') ): the_row();?>
                        <li class="<?php if(get_row_index()==1):?> active<?php endif;?>">
                            <?php the_sub_field('nom'); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
            <div class="zoneBlock__content<?php if(get_field('afficher_zones_lien') && is_user_logged_in()): ?> show-links<?php endif; ?>">
                <?php while( have_rows('zones') ): the_row();?>
                    <div class="zoneBlock__single">
                        <div class="zoneBlock__single__text">
                            <p>
                                <?php the_sub_field('description', false, false);?>
                            </p>
                            <div class="zoneBlock__single__buttons">
                                <?php
                                $link = get_sub_field('lien');
                                if( $link ):
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <a class="cta" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>

                                <?php if( have_rows('liens') ): ?>
                                    <?php while( have_rows('liens') ): the_row();?>

                                        <?php
                                        $link = get_sub_field('lien');
                                        if( $link ):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="cta" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="zoneBlock__single__image">
                            <?php
                                $image = get_sub_field('image');
                                $traces = get_sub_field('traces');
                                $i = 1;
                            ?>
                            <div class="zoneBlock__single__traces">
                                <img class="photo" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <img class="traces" src="<?php echo esc_url($traces['url']); ?>" alt="<?php echo esc_attr($traces['alt']); ?>" />

                                <?php if( have_rows('zones_liens') ): ?>
                                    <?php while( have_rows('zones_liens') ): the_row();?>
                                        <div class="zone-point" style="top: <?php the_sub_field('top_mobile')?>%;left: <?php the_sub_field('left_mobile')?>%;">
                                            <?php echo $i; ?>
                                        </div>
                                    <?php $i++;
                                    endwhile; ?>
                                <?php endif; ?>

                            </div>
                            <?php if( have_rows('zones_liens') ): ?>
                            <ul>
                                <?php
                                $i = 1;
                                while( have_rows('zones_liens') ): the_row();?>
                                <li>
                                    <?php
                                    $link = get_sub_field('lien');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="zone-lien" style="top: <?php the_sub_field('top_desktop')?>%;left: <?php the_sub_field('left_desktop')?>%;" href="<?php echo esc_url( $link_url ); ?>"><?php echo $i.". ".get_sub_field('nom'); ?></a>
                                    <?php else: ?>
                                        <span class="zone-lien zone-lien--span" style="top: <?php the_sub_field('top_desktop')?>%;left: <?php the_sub_field('left_desktop')?>%;"><?php echo $i.". ".get_sub_field('nom'); ?></span>
                                    <?php endif; ?>
                                </li>
                                <?php $i++;
                                endwhile; ?>
                            </ul>
                            <?php endif; ?>


                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>


    </section>


<?php endif; ?>
