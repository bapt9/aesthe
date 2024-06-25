<section class="newsletter  wrapper  half">
    <div class="newsletter__main">
        <p class="newsletter__main__smallTitle">Newsletter</p>
        <p><?php pll_e('RestonsConnectes'); ?></p>
    </div>
    <div class="newsletter__input">
        <p><?php pll_e('ChapeauNewsletterInput'); ?></p>
        <?php echo do_shortcode('[activecampaign form=1 css=0]'); ?>
    </div>
    <!--
	<form class="wrapper  flexJcSB">
		<div class="newsletter__main">
			<h2>Newsletter</h2>
			<p><?php pll_e('RestonsConnectes'); ?></p>
		</div>
		<div class="newsletter__input">
			<p><?php pll_e('ChapeauNewsletterInput'); ?></p>
			
				<input type="text" placeholder="Votre adresse email">
				
				
		</div>
		<div class="newsletter__submit">
			<button class="cta  cta--ghost" type="submit">Inscription</button>
		</div>
	</form>
	-->
</section>


<footer class="footer  wrapper">
    <div class="footer__main  flexJcSB">
        <div>
            <ul>
                <li><strong><?php the_field('titre_colonne_1', 'option'); ?></strong></li>
                <?php if (have_rows('footer_colonne_1', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_1', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <ul>
                <li><strong><?php the_field('titre_colonne_2', 'option'); ?></strong></li>
                <?php if (have_rows('footer_colonne_2', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_2', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <ul>
                <li><strong><?php the_field('titre_colonne_3', 'option'); ?></strong></li>
                <?php if (have_rows('footer_colonne_3', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_3', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <ul>
                <li><strong><?php the_field('titre_colonne_4', 'option'); ?></strong></li>
                <?php if (have_rows('footer_colonne_4', 'option')) : ?>
                    <?php while (have_rows('footer_colonne_4', 'option')) : the_row();
                        $link = get_sub_field('lien');
                        if ($link) :
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                            <li>
                                <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
        </div>
        <div>
            <a href="<?php bloginfo('url'); ?>/contact/" class="cta  cta--ghost">Contactez-nous</a>
            <a target="blank" href="<?= get_field('lien_rdv', 'options')['url'] ?>" class="cta">Prendre rdv</a>
        </div>
    </div>

    <div class="footer__foot  flexJcSB">
        <?php include('wp-content/themes/aesthe/assets/img/logo.svg'); ?>
        <div>
            <a href="<?= get_field('linkedin', 'options') ?>" aria-label="Page aesthé médecine esthétique LinkedIn" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/li.svg'); ?></a>
            <a href="<?= get_field('instagram', 'options') ?>" aria-label="Page aesthé médecine esthétique Instagram" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/ig.svg'); ?></a>
            <a href="<?= get_field('facebook', 'options') ?>" aria-label="Page aesthé médecine esthétique Facebook" target="_blank" rel="noopener nofollow"><?php include('wp-content/themes/aesthe/assets/img/fb.svg'); ?></a>
        </div>
        <div class="footer__legal">
            ©<?= date('Y') ?> aesthé
            <a href="<?= get_bloginfo('url') ?>/confidentialite/">Confidentialité</a>
            <a href="<?= get_bloginfo('url') ?>/legal/">Légal</a>
        </div>
    </div>

</footer>


<div class="form-thx">

    <?php
    if (isset($_POST)) {

        if (@$_POST['c_email'] != '') {


            if ($_POST['c_fake'] != '') die(); // recaptcha

            $nom_champ['c_nom'] = 'Nom';
            $nom_champ['c_prenom'] = 'Prénom';
            $nom_champ['c_email'] = 'Email';
            $nom_champ['c_tel'] = 'Téléphone';
            $nom_champ['c_msg'] = 'Message';

            $headers = 'From: no-reply@lesite.com' . "\n";
            $headers .= 'Reply-To: ' . $_POST['c_email'] . "\n";
            $headers .= 'Content-Type: text/html; charset="utf-8"' . "\n";
            $headers .= 'Content-Transfer-Encoding: 8bit';

            $msg = "";
            foreach ($_POST as $key => $value) if ($value != '') $msg .= $nom_champ[htmlspecialchars($key)] . " => " . htmlspecialchars($value) . "<br>";

            $mail = 'Bonjour, un message sur lesite.com<br><br>' . $msg;

            wp_mail('hello@lesite.com', 'lesite.com', $mail, $headers);
            // wp_mail('jean@pamstudio.co', 'lesite.com', $mail, $headers);

            echo "<script>alert('Nous vous remercions et revenons vers vous prochainement !');</script>";
        }
    }
    ?>
</div>



<div class="grid">
    <ul>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>

<?php wp_footer(); ?>





<!-- rgpd -->
<script type="text/javascript" src="<?= get_template_directory_uri(); ?>/assets/js/tarteaucitron/tarteaucitron.js"></script>

<script type="text/javascript">
    tarteaucitron.init({
        "privacyUrl": "https://aesthe.com/confidentialite/",
        "hashtag": "#rgpd",
        "cookieName": "rgpd",
        "orientation": "bottom",
        "groupServices": false,
        /* Group services by category */
        "showAlertSmall": false,
        /* Show the small banner on bottom right */
        "cookieslist": false,
        /* Show the cookie list */
        "closePopup": false,
        /* Show a close X on the banner */
        "showIcon": false,
        /* Show cookie icon to manage cookies */
        //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
        "iconPosition": "BottomRight",
        /* BottomRight, BottomLeft, TopRight and TopLeft */
        "adblocker": false,
        /* Show a Warning if an adblocker is detected */
        "DenyAllCta": true,
        /* Show the deny all button */
        "AcceptAllCta": true,
        /* Show the accept all button when highPrivacy on */
        "highPrivacy": true,
        /* HIGHLY RECOMMANDED Disable auto consent */
        "handleBrowserDNTRequest": false,
        /* If Do Not Track == 1, disallow all */
        "removeCredit": false,
        /* Remove credit link */
        "moreInfoLink": true,
        /* Show more info link */
        "useExternalCss": true,
        /* If false, the tarteaucitron.css file will be loaded */
        "useExternalJs": false,
        /* If false, the tarteaucitron.js file will be loaded */
        //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */
        "readmoreLink": "https://aesthe.com/confidentialite/",
        /* Change the default readmore link */
        "mandatory": true,
        /* Show a message about mandatory cookies */
    });
</script>

<!-- ANALYTICS -->
<script type="text/javascript">
    tarteaucitron.user.gajsUa = 'G-JL4CCQQTG4';
    tarteaucitron.user.gajsMore = function() {
        /* add here your optionnal _ga.push() */
    };
    (tarteaucitron.job = tarteaucitron.job || []).push('gajs');
</script>

<!-- GOOGLE TAG MANAGER -->
<!-- <script type="text/javascript">
    tarteaucitron.user.googletagmanagerId = 'GTM-5V3M2D8';
    (tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
</script> -->

<!-- SKAZE -->
<script async="async" src="//events.sk.ht/aesthe/lib.js"></script>
<script>
    var skaze = skaze || {};
    skaze.cmd = skaze.cmd || [];
    skaze.cmd.push(function() {
        skaze.init({
            siteIdentifier: "aesthe"
        });
        skaze.pushEvent({
            name: "aesthe - All Page",
            properties: {}
        });
    });
</script>


<!-- GA Universel -->
<!--<script type="text/javascript">-->
<!--    tarteaucitron.user.analyticsUa = 'UA-207934763-1';-->
<!--    tarteaucitron.user.analyticsMore = function () { /* optionnal ga.push() */ };-->
<!--    tarteaucitron.user.analyticsUaCreate = { /* optionnal create configuration */ };-->
<!--    tarteaucitron.user.analyticsAnonymizeIp = true;-->
<!--    tarteaucitron.user.analyticsPageView = { /* optionnal pageview configuration */ };-->
<!--    tarteaucitron.user.analyticsMore = function () { /* optionnal ga.push() */ };-->
<!--    (tarteaucitron.job = tarteaucitron.job || []).push('analytics');-->
<!--</script>-->

<!-- end rgpd -->

<!-- Start of aesthe Zendesk Widget script -->
<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=f2540ec4-431b-4a2f-8b5b-396d1ff466d8"> </script> -->
<!-- End of aesthe Zendesk Widget script -->

<!-- ACTIVECAMPAIGN : Géré plus bas sans tarte au citron -->
<!-- <script type="text/javascript">
    tarteaucitron.user.actid = '225286553';
    (tarteaucitron.job = tarteaucitron.job || []).push('activecampaign');
</script> -->

<!-- activecampaign -->
<script type="text/javascript">
    (function(e, t, o, n, p, r, i) {
        e.visitorGlobalObjectAlias = n;
        e[e.visitorGlobalObjectAlias] = e[e.visitorGlobalObjectAlias] || function() {
            (e[e.visitorGlobalObjectAlias].q = e[e.visitorGlobalObjectAlias].q || []).push(arguments)
        };
        e[e.visitorGlobalObjectAlias].l = (new Date).getTime();
        r = t.createElement("script");
        r.src = o;
        r.async = true;
        i = t.getElementsByTagName("script")[0];
        i.parentNode.insertBefore(r, i)
    })(window, document, "https://diffuser-cdn.app-us1.com/diffuser/diffuser.js", "vgo");
    vgo('setAccount', '225286553');
    vgo('setTrackByDefault', true);
    vgo('process');
</script>

<?php if (is_page('contact')) : ?><script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><?php endif; ?>
<script src="<?= get_template_directory_uri(); ?>/assets/js/code-nitropack-exclude-min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/assets/js/code-min.js"></script>
<script>
    jQuery('p:empty').remove();
</script>
</body>

</html>