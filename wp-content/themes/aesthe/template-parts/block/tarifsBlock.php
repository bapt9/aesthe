
<?php
/**
 * Block Name: Bloc Tarifs
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\"> Bloc Tarifs (cliquer pour modifier)</div>";
else: ?>




<section class="tarifsBlock">

	<?php
	global $post;

	$current_post = $post;

	$featured_posts = get_field('offres');
	if( $featured_posts ): ?>
		<div class="tarifs__offers" data-columns>
		    <?php foreach( $featured_posts as $post ):
		    	$post_taxo = get_the_terms( $post->ID, 'type'  );


		        // Setup this post for WP functions (variable must be named $post).
		        setup_postdata($post); ?>

		    	<div class="tarifs__item">
		    		<div class="circle"></div>
		    		<div class="tarifs__infos">
		    			<div>
			    			<p>Offre</p>
			    			<h3><?php the_title()?></h3>
		    			</div>
                        <?php
                        if(141 == $current_post->ID){
                        $link = get_field('lien_offre', get_the_id());
                        $status = get_page_by_path($post->post_name, OBJECT, get_post_type($post));
                        if( $link ):
                            $link_url = $link['url'];
                            $link_target = $link['target'] ? $link['target'] : '_self';?>
                            <a class="cta cta--ghost" href="<?= $link_url; ?>" target="<?= $link_target; ?>">Voir l'offre</a>
                        <?php elseif ($status->post_status != "private"):?>
		    			    <a class="cta cta--ghost" href="<?php the_permalink() ?>">Voir l'offre</a>
                        <?php
                        endif;
                        }
                        ?>

		    		</div>
		    		<div class="tarifs__prices">		                        
		    			<ul class="offreProduits__soins">

							
							<?php // boucle soins (consultation anti-acné, en finir avec l'acné...)
							$argss = array('post_type' => array( 'soin' ), 'post_status' => array( 'public' ), 'posts_per_page' => '-1', "meta_query" => array(array('key'=>"offre",'value' => get_the_ID(),'compare'=> "LIKE")),);
							$queryy = new WP_Query( $argss );
							if($queryy->have_posts()) { while ( $queryy->have_posts() ) {
								$queryy->the_post();?>

					            <li>
                                <?php
                                $link = get_field('lien_soin', get_the_id());
                                if( $link ):
                                $link_url = $link['url'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                    <p><a href="<?= $link_url; ?>" target="<?= $link_target; ?>"><?= the_title(); ?></a></p>
                                <?php else: ?>
                                    <p><?= the_title(); ?></p>
                                <?php endif; ?>
		                            <?= the_field( 'tarif', get_the_id()); ?> €
		                        </li>

							<?php } } else { }
							wp_reset_postdata();?>

						</ul>
					</div>

		    	</div>
		    <?php endforeach; ?>			
		</div>


	    <?php 
	    // Reset the global post object so that the rest of the page works correctly.
	    wp_reset_postdata(); ?>
	<?php endif; ?>   

</section>

<?php endif; ?>



