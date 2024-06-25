<?php
/**
 * Block Name: Réductions
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Réductions (cliquer pour modifier)</div>";
else: ?>



	<section class="wrapper  discountBlock  discountBlock--<?= $block['id'] ?>">

        <div class="discountBlock__slide">
            <?php
            global $post;
            $featured_posts = get_field('reduction');
            if($featured_posts):
                foreach($featured_posts as $post):
                    setup_postdata($post);

                    echo "<div class=\"discountBlock__item\">";
                        echo "<div class=\"discountBlock__cover\">";
                            echo wp_get_attachment_image( get_field('image', get_the_ID())['ID'], 'medium' );
                            echo "<p class=\"discountBlock__details__titre__white\">".get_field('titre', get_the_ID())."</p>";
                        echo "</div>";
                        echo "<div class=\"discountBlock__details\">";
                            if(get_field('titre_2', get_the_ID())) echo "<p class=\"discountBlock__details__titre\">".get_field('titre_2', get_the_ID())."</p>";
                            echo "<div class=\"discountBlock__dates\">".get_field('dates', get_the_ID())."</div>";
                            echo get_field('description', get_the_ID())."<br>";
                            // if (!empty(get_field('lien'))) :
                            echo "<a class=\"cta\" href=\"".get_field('lien', get_the_ID())['url']."\">".get_field('lien', get_the_ID())['title']."</a>";
                            // endif ;
                            echo "</div>";

                    echo "</div>";
                    
                endforeach;
                wp_reset_postdata();
            endif;
            ?>
        </div>
	</section>



<?php endif; ?>
