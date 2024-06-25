<article class="article" style="margin-right: 1rem">
    <?php
    echo "<a style='padding-bottom: 1rem;'  class=\"blogPosts__post\" href=\"" . get_the_permalink() . "\">";
    echo "<div class=\"blogPosts__thumb\">";
    the_post_thumbnail('blogThumb');
    include('wp-content/themes/aesthe/assets/img/postHover.svg');
    echo "</div>";
    echo "<div class=\"blogPosts__info\">";
    echo "<div class=\"blogPosts__postTitleDate\">";
    echo "<h4>" . get_the_title() . "</h4>";
    echo "<div class=\"blogPosts__date date\">" . date('d.m.y') . "</div>";
    echo "</div>";
    echo "<div class=\"blogPosts__excerpt\">";
    the_excerpt();
    echo "</div>";
    echo "</div>";
    echo "</a>";
    ?>
</article>