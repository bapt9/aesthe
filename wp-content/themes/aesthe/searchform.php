<form class="site-search" method="get" id="form">
  <?php include('wp-content/themes/aesthe/assets/img/magnifying-glass.svg'); ?>
  <input type="text" value="<?php the_search_query() ?>" name="s" id="s" placeholder="Recherche par mots-clés">
  <button type="submit">OK</button>
</form>