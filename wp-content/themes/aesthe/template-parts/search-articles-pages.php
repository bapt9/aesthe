<article class="article" style="margin-right: 1rem">
    <?php
    echo "<a style='padding-bottom: 1rem;'  class=\"searchPosts__post\" href=\"" . get_the_permalink() . "\">";
    echo "<div class=\"searchPosts__thumb\">";
    the_post_thumbnail('postThumb');
    echo "</div>";
    echo "<div class=\"searchPosts__info\">";
    echo "<div class=\"searchPosts__postTitleDate\">";
    echo "<h4>" . get_the_title() . "</h4>";
    // echo "<div class=\"searchPosts__date date\">" . date('d.m.y') . "</div>";
    echo "</div>";
    echo "<div class=\"searchPosts__excerpt\">";
    the_excerpt();
    echo "</div>";
    echo "</div>";
    echo "</a>";
    ?>
</article>