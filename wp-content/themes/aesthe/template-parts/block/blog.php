<?php
/**
 * Block Name: Blog
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Blog (cliquer pour modifier)</div>";
else: ?>

<?php global $post; ?>

	<section class="wrapper  blogBlock  blogBlock--<?= $block['id'] ?>">
        <h2><?= (get_field('titre_bloc')) ? get_field('titre_bloc') : 'Les articles qui vous<br>interesseront' ?></h2>
        <div class="flexJcSB  fourth">
            <?php
            
            $featured_posts = get_field('conseils');
            if($featured_posts):
                foreach($featured_posts as $post):
                    setup_postdata($post);
                    echo "<a class=\"blogPosts__post\" href=\"".get_the_permalink()."\">";
                    echo "<div class=\"blogPosts__thumb\">";
                    the_post_thumbnail('blogThumb');
                    include('wp-content/themes/aesthe/assets/img/postHover.svg');
                    echo "</div>";
                    echo "<div class=\"blogPosts__info\">";
                        echo "<div class=\"blogPosts__postTitleDate\">";
                            echo "<h4>".get_the_title()."</h4>";
                            echo "<div class=\"blogPosts__date date\">".date('d.m.y')."</div>";
                        echo "</div>";
                        echo "<div class=\"blogPosts__excerpt\">";
                            the_excerpt();
                        echo "</div>";
                    echo "</div>";
                    
                    echo "</a>";
                endforeach;
                wp_reset_postdata();
            endif;
            ?>
        </div>
	</section>



<?php endif; ?>
