<?php get_header(); ?>

<div class="allOffers wrapper">
    <h1 class="h1">L'offre de soins aesthé</h1>

    <?php
    $terms = get_terms(array("taxonomy" => "type" ));
    foreach ($terms as $term) : // boucle catégories (belle peau, en un clin d'œil...)?> 

        <section class="allOffers__category <?= $term->slug; ?>">
            <h2 class="allOffers__catTitle h2 "><?= $term->name; ?></h2>
            <div class="allOffers__offers ">

    
                    <?php // boucle offres (Éclat de peau, anti-acné...)
                    $args = array('post_type' => array( 'offre' ), 'post_status' => array( 'public' ), 'posts_per_page' => '-1', 'tax_query' => array(array ('taxonomy' => 'type', 'field' => 'slug', 'terms' => $term->slug) ) );
                    $query = new WP_Query( $args );
                    if($query->have_posts()) { while ( $query->have_posts() ) {
                        $query->the_post();
                        get_template_part('template-parts/card');
                     } } else { }
                    wp_reset_postdata();?>
            </div>
        </section>
        <?php
    endforeach;
    ?>
</div>


<?php get_footer(); ?>