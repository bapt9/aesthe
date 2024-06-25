
<?php
/**
 * Block Name: Bloc Tarifs onglets
 *
 * 
 */
?>

<?php
if(is_admin()): echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\"> Bloc Tarifs onglet (cliquer pour modifier)</div>";
else: ?>




<section class="tarifsTabsBlock  tarifsTabsBlock--<?= $block['id'] ?>  tarifs__item">
	<div class="circle circle--top"></div>

	<?php
	global $post;

	$prefixe_titre = get_field('prefixe_titre', $block['id']);

	// tab
	$cptTemp = 0;
	echo "<div class=\"tarifsTabsBlock__tabs\">";
	if(have_rows('onglets')): while(have_rows('onglets')) : the_row();
		$on = ($cptTemp==0) ? 'on' : '';
		echo "<button class=\"tarifsTabsBlock__tab  $on\" onclick=\"this.parentNode.querySelector('.tarifsTabsBlock__tabs .on').classList.remove('on'); this.classList.add('on'); this.parentNode.parentNode.querySelector('.tarifs__prices.on').classList.remove('on'); this.parentNode.parentNode.querySelectorAll('.tarifs__prices')[Array.prototype.indexOf.call(this.parentNode.children, this)].classList.add('on')\">" . get_sub_field('nom_onglet') ."</button>";
		$cptTemp++;
	endwhile; endif;
	echo "</div>";
	$cptTemp = 0;
	if(have_rows('onglets')): while(have_rows('onglets')) : the_row();
		$on = ($cptTemp==0) ? 'on' : '';

		echo "<div class=\"tarifs__prices  $on\" data-tab=\"".$block['id']."\">";

		$prefixePrix = '';
		$classTemp = '';
		if($prefixe_titre!='') {
			$prefixePrix = "data-label=\"$prefixe_titre\"";
			$classTemp = 'withLabel';
		}
		echo "<ul class=\"offreProduits__soins  $classTemp\" $prefixePrix>";

        $offre = get_sub_field('offre');
        $args = array('post_type' => array( 'soin' ), 'post_status' => array( 'public' ), 'posts_per_page' => '-1', "meta_query" => array(array('key'=>"offre",'value' => $offre->ID,'compare'=> "LIKE")),);
        $queryy = new WP_Query( $args );
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
                <div><?= str_replace($prefixe_titre, '', get_field( 'tarif', get_the_id())); ?> €</div>
            </li>

        <?php } } else { }
        wp_reset_postdata();

		echo "</ul>";
		echo "</div>";
		$cptTemp++;

	endwhile; endif;
	?>

</section>

<?php endif; ?>



