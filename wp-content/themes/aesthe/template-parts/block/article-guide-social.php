<?php
/**
 * Block Name: Top social
 *
 * 
 */
?>



<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Top réseaux sociaux</div>";
else: ?>

<section class="postTop">
    <div class="postTop__content">
        <div class="postTop__social">
            <p>Partager</p>
            <?php
            echo "<a href=\"javascript:;\" onclick=\"window.open('https://www.facebook.com/sharer/sharer.php?u=".urlencode(get_the_permalink())."', 'sharer', 'toolbar=0,status=0,width=548,height=325');\"> "; include('wp-content/themes/aesthe/assets/img/facebookCircle.svg'); echo "</a>";
            
            echo "<a href=\"javascript:;\" onclick=\"window.open('https://twitter.com/intent/tweet?text=".urlencode("À lire d'urgence → ".get_the_permalink()) . "', 'sharer', 'toolbar=0,status=0,width=548,height=325');\"> "; include('wp-content/themes/aesthe/assets/img/twitterCircle.svg'); echo "</a>";
            
            echo "<a href=\"javascript:;\" onclick=\"window.open('https://www.linkedin.com/shareArticle?mini=true&url=".urlencode(get_the_permalink())."title=".urlencode(strip_tags(get_the_title()))."&summary=".urlencode("Aesthe")."', '', 'width=626,height=436');\">"; include('wp-content/themes/aesthe/assets/img/linkedinCircle.svg'); echo "</a>"; 
            ?>
        </div>     
    </div>
</section>

<?php endif; ?>