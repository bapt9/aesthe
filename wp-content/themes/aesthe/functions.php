<?php

/*
TO DO
Hide WP version strings from scripts and styles
Hide WP version strings from generator meta tag 
*/

use GeminiLabs\SiteReviews\Modules\Dump;

remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');
remove_filter('the_sub_field', 'wpautop');
add_theme_support('align-wide');
add_theme_support('menus');
add_theme_support('post-thumbnails');
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds — <link rel="alternate"...
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link — <link rel="EditURI"...
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file. — <link rel="wlwmanifest...
remove_action('wp_head', 'index_rel_link'); // index link — ???
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post. — meta name="generator
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version — meta name="generator
remove_action('wp_head', 'print_emoji_detection_script', 7); // remove emojis
remove_action('wp_print_styles', 'print_emoji_styles'); // remove emojis

// add_filter('next_posts_link_attributes', 'posts_link_attributes'); // AJOUT CLASSE AUX LIENS PAGER PRECEDENTS/SUIVANTS
// add_filter('previous_posts_link_attributes', 'posts_link_attributes'); // AJOUT CLASSE AUX LIENS PAGER PRECEDENTS/SUIVANTS
function posts_link_attributes()
{
  return 'class="liens-pager"';
} // AJOUT CLASSE AUX LIENS PAGER PRECEDENTS/SUIVANTS

//function remove_menu_items() {
////    global $menu; $restricted = array(__('Comments'), __('Tools'), __('Plugins'), __('Media'), __('Appearance'), __('Settings')); end ($menu); while (prev($menu)){ $value = explode(' ',$menu[key($menu)][0]); if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){ unset($menu[key($menu)]);} }
//}


//if(is_user_logged_in()) {
//    if(get_userdata(get_current_user_id())->data->user_login!='pam' && get_userdata(get_current_user_id())->data->user_login!='jean' && get_userdata(get_current_user_id())->data->user_login!='admin') {
//        add_action('admin_menu', 'remove_menu_items'); // enlever commentaires du backend
//        add_filter('acf/settings/show_admin', '__return_false');
//        $role = get_role('administrator');
//        $role->remove_cap('delete_pages');
//        $role->remove_cap('delete_others_pages');
//    }
//}


//function remove_menu_items_for_all() { global $menu; $restricted = array(__('Comments')); end ($menu); while (prev($menu)){ $value = explode(' ',$menu[key($menu)][0]); if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){ unset($menu[key($menu)]);} } }

//add_action('admin_menu', 'remove_menu_items_for_all'); // enlever commentaires du backend


function remove_h1_from_editor($settings)
{
  $settings['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Preformatted=pre;';
  return $settings;
}


function my_login_logo_one()
{
  echo "<style type=\"text/css\">";
  echo "body.login div#login h1 a { background-image: url(" . get_template_directory_uri() . "/assets/img/pammngrmm.png);padding-bottom: 30px; }";
  echo "</style>";
}

add_action('login_enqueue_scripts', 'my_login_logo_one');

function my_admin_add_js()
{
  if (is_admin()) :
    // hans yeah!
    // aussi déterminable avec $screen = get_current_screen() puis screen->parent_file
    global $pagenow;
    if ($pagenow == "users.php") :
?>
      <script>
        var dom_target = document.getElementsByClassName("wp-header-end");
        var newElement = document.createElement('div');
        newElement.innerHTML = "Il est important de garder un mot de passe complexe, ce qui renforce la sécurité et baisse le risque de piratage.<br />Le changement de mot de passe par un plus simple dégage la responsabilité du studio en cas de piratage du site.<br />Tout frais de correction sera donc à la charge du client.";
        dom_target[0].parentNode.insertBefore(newElement, dom_target[0]);
      </script>
<?php
    endif;
  endif;
}

function add_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
function hide_wp_update_nag()
{
  remove_action('admin_notices', 'update_nag', 3);
}


/* function filter_ptags_on_images($content){ $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\2\3', $content); return $content; } */

show_admin_bar(false); // masque admin bar

if (is_admin()) {

  // add_filter('the_content', 'filter_ptags_on_images'); // enleve <p> autour des images inserées avec wysiwyg

  add_action('admin_menu', 'hide_wp_update_nag'); // hide message update mise à jour wp
  add_filter('sanitize_file_name', 'remove_accents'); // SUPPRIME LES ACCENTS DES MEDIAS

  add_filter('upload_mimes', 'add_mime_types'); // AUTORISE SVG EN BACKOFFICE

  // Code utile uniquement dans l'administration

  add_action('admin_footer', 'my_admin_add_js');
  add_filter('tiny_mce_before_init', 'remove_h1_from_editor');
  // Réglages permaliens
  if (get_option('medium_size_w') == 300) update_option('medium_size_w', '1000');
  if (get_option('medium_size_h') == 300) update_option('medium_size_h', '2500');
  if (get_option('large_size_w') == 1024) update_option('large_size_w', '2000');
  if (get_option('large_size_h') == 1024) update_option('large_size_h', '3500');
  if (get_option('uploads_use_yearmonth_folders') != '') update_option('uploads_use_yearmonth_folders', '');
} else {
  // Code utile uniquement dans le front-end
}




function getPageIDbySlug($the_slug)
{
  if (get_page_by_path($the_slug)) return get_page_by_path($the_slug)->ID;
}



// Ajout tailles médias pour éviter background img ou object-fit
// add_image_size( 'home-carousel', 1830, 645, true); // true = crop
// add_image_size( 'home-bloc-trois', 570, 375, true); // true = crop
// add_image_size( 'custom-size', 220, 220, array( 'left', 'top' ) );


// wp_insert_post(array('post_title' => $title_tmp, 'post_content' => $content_tmp, 'post_type' => 'formulaire', 'post_status' => 'publish'));

// $role->remove_cap('delete_published_pages');

// ACTIVER SESSIONS
/*
add_action('init', 'monprefixe_session_start', 1);
function monprefixe_session_start() {
  if(!session_id())  @session_start();
}
*/

add_action('init', 'create_post_type');
function create_post_type()
{
  register_post_type(
    'centre',
    array(
      'labels' => array(
        'name' => __('Centre'),
        'singular_name' => __('Centre')
      ),
      'public' => true,
      'supports' => array('title'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'centre', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-multisite',
    )
  );

  register_post_type(
    'presse',
    array(
      'labels' => array(
        'name' => __('Presse'),
        'singular_name' => __('Presse')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'presse', 'with_front' => true),
      'menu_icon' => 'dashicons-testimonial',
    )
  );

  register_post_type(
    'tarifs',
    array(
      'labels' => array(
        'name' => __('Tarifs'),
        'singular_name' => __('Tarifs')
      ),
      'public' => true,
      // 'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'tarifs', 'with_front' => true),
      'menu_icon' => 'dashicons-money-alt',
    )
  );

  register_post_type(
    'conseils',
    array(
      'labels' => array(
        'name' => __('Conseils'),
        'singular_name' => __('Conseils')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'medecine-esthetique-visage/conseils-visage', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'conseils-corps',
    array(
      'labels' => array(
        'name' => __('Conseils corps'),
        'singular_name' => __('Conseil corps')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'medecine-esthetique-corps/conseils-corps', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'conseils-cheveux',
    array(
      'labels' => array(
        'name' => __('Conseils cheveux'),
        'singular_name' => __('Conseils cheveux')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'cheveux/conseils-cheveux', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'conseils-detatouage',
    array(
      'labels' => array(
        'name' => __('Conseils détatouage'),
        'singular_name' => __('Conseils détatouage')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'detatouage/conseils-detatouage', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'conseils-medicales',
    array(
      'labels' => array(
        'name' => __('Conseils tech. médicale'),
        'singular_name' => __('Conseils tech. médicale')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'conseils-techniques-medicales', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'conseils-epilation',
    array(
      'labels' => array(
        'name' => __('Conseils épilation'),
        'singular_name' => __('Conseils épilation')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'epilation-laser/conseils-epilation-laser', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );

  register_post_type(
    'actualites',
    array(
      'labels' => array(
        'name' => __('Actualités'),
        'singular_name' => __('Actualité')
      ),
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest'       => true,
      'hierarchical'        => false,
      'public'              => true,
      'has_archive'         => false,
      'show_ui'         => true,
      'rewrite' => array('slug' => 'actualites', 'with_front' => true),
      'menu_icon' => 'dashicons-admin-post',
    )
  );


  register_post_type(
    'offre',
    array(
      'labels' => array(
        'name' => __('Offres'),
        'singular_name' => __('Offre')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'offres', 'with_front' => true),
      'menu_icon' => 'dashicons-store',
      'taxonomies'  => array('post_tag', 'category'),
    ),
  );

  register_taxonomy(
    'type',
    'offre',
    array(
      'label' => 'Type',
      'labels' => array(
        'name' => 'Type',
        'singular_name' => 'Type',
        'all_items' => "Tous les types d'offre",
        'edit_item' => "Éditer le type d'offre",
        'view_item' => "Voir le type d'offre",
        'update_item' => "Mettre à jour le type d'offre",
        'add_new_item' => "Ajouter une catégorie",
        'new_item_name' => "Nouveeu type d'offre",
        'search_items' => "Rechercher parmi les types d'offre",
        'popular_items' => "Types d'offre les plus utilisées"
      ),
      'hierarchical' => true
    )
  );
  register_taxonomy_for_object_type('type', 'offre');


  register_post_type(
    'soin',
    array(
      'labels' => array(
        'name' => __('Soins'),
        'singular_name' => __('Soin')
      ),
      'public' => true,
      'supports' => array('title', 'editor'),
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'soins', 'with_front' => true),
      'menu_icon' => 'dashicons-list-view',
      'taxonomies'  => array('category'),
    )
  );

  register_post_type(
    'testimonial',
    array(
      'labels' => array(
        'name' => __('Témoignages'),
        'singular_name' => __('Témoignage')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'rewrite' => array('slug' => 'temoignages', 'with_front' => true),
      'menu_icon' => 'dashicons-testimonial'
    )
  );

  register_post_type(
    'tech-meds',
    array(
      'labels' => array(
        'name' => __('Techniques médicales'),
        'singular_name' => __('Technique médicale')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'page-attributes'), // Ajout de 'page-attributes' pour activer la hiérarchie
      'show_in_rest' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'techniques-medicales', 'with_front' => true),
      'menu_icon' => 'dashicons-image-filter',
      //'taxonomies'  => array('category', 'post_tag'),
      'hierarchical' => true, // Activation de la hiérarchie
    )
  );


  register_post_type(
    'reduction',
    array(
      'labels' => array(
        'name' => __('Réductions'),
        'singular_name' => __('Réduction')
      ),
      'public' => true,
      'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
      'show_in_rest' => false,
      'has_archive' => false,
      'menu_icon' => 'dashicons-tag'
    )
  );
}

// with_front  à false n'utilise pas le “Structure personnalisée” des Permaliens
// cf https://www.quemalabs.com/blog/how-to-add-blog-in-front-of-your-url/
// cf http://www.ecap-partner.com/


// Ajout de tailles d'images

add_image_size('blogThumb', 820, 570, true);
add_image_size('card', 600, 360, true);
add_image_size('cardMini', 410, 220, true);


/* ACF */

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path)
{
  $path = get_stylesheet_directory() . '/_includes/acf-pro/';
  return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir)
{
  $dir = get_stylesheet_directory_uri() . '/_includes/acf-pro/';
  return $dir;
}

// 3. Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once(get_stylesheet_directory() . '/_includes/acf-pro/acf.php');



// modifie path json acf
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/_includes/acf-json';
  return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/_includes/acf-json';
  return $paths;
}

if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    'page_title'  => 'Options',
    'menu_title'  => 'Options Pam',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));


  acf_add_options_sub_page(array(
    'page_title'  => 'Réglages blocs transverses',
    'menu_title'  => 'Réglages blocs transverses',
    'parent_slug' => 'theme-general-settings',
  ));
}


// AJOUTER ACF
function register_acf_blocks()
{


  // block Centre (affichage en grille 2024)
  acf_register_block(array(
    'name'              => 'Centre_grille',
    'title'             => __('Centre_grille'),
    'render_template'   => '/template-parts/block/centre_grille.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Centre_grille'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));
  // block Centre v2
  acf_register_block(array(
    'name'              => 'Centre_v2',
    'title'             => __('Centre_v2'),
    'render_template'   => '/template-parts/block/centre_v2.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Centre_v2'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block Top Offre
  acf_register_block(array(
    'name'              => 'Top Offre',
    'title'             => __('Top Offre'),
    'render_template'   => '/template-parts/block/top-offre.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Top Offre'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block Détails Offre
  acf_register_block(array(
    'name'              => 'Details Offre',
    'title'             => __('Details Offre'),
    'render_template'   => '/template-parts/block/details-offre.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Details Offre'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block Onglets Offre
  acf_register_block(array(
    'name'              => 'Onglets Offre',
    'title'             => __('Onglets Offre'),
    'render_template'   => '/template-parts/block/onglets-offre.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Onglets Offre'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block Before After v2
  acf_register_block(array(
    'name'              => 'Before After v2',
    'title'             => __('Before After v2'),
    'render_template'   => '/template-parts/block/before-after-offre.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Before After v2'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block cards badges confiance
  acf_register_block(array(
    'name'              => 'Badges de confiance',
    'title'             => __('Badges de confiance'),
    'render_template'   => '/template-parts/block/badgesConfiance.php',
    'icon'              => 'dashicons-money-alt',
    'keywords'          => array('Badges confiance', 'tarfisCards'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block cards tarifs
  acf_register_block(array(
    'name'              => 'Cartes tarifs',
    'title'             => __('Cartes tarifs'),
    'render_template'   => '/template-parts/block/tarifsCards.php',
    'icon'              => 'dashicons-money-alt',
    'keywords'          => array('Cartes tarifs', 'tarfisCards'),
    'mode'              => 'auto',
    'category'          => 'formatting',

  ));

  // block sommaire
  acf_register_block(array(
    'name'              => 'Sommaire',
    'title'             => __('Sommaire'),
    'render_template'   => '/template-parts/block/sommaire.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Sommaire'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block top guide conseils
  acf_register_block(array(
    'name'              => 'Top guide',
    'title'             => __('Top guide'),
    'render_template'   => '/template-parts/block/top-guide.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Top guide'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block faq v2
  acf_register_block(array(
    'name'              => 'Faq_v2',
    'title'             => __('Faq_v2'),
    'render_template'   => '/template-parts/block/faq_v2.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Faq_v2'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block fil d'ariane
  acf_register_block(array(
    'name'              => 'Fil ariane',
    'title'             => __('Fil ariane'),
    'render_template'   => '/template-parts/block/fil-ariane.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Fil ariane'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));


  // block siblings
  acf_register_block(array(
    'name'              => 'Siblings',
    'title'             => __('Siblings'),
    'render_template'   => '/template-parts/block/siblings.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('Siblings'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block des sources
  acf_register_block(array(
    'name'              => 'Sources',
    'title'             => __('Sources'),
    'render_template'   => '/template-parts/block/sources.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('sources'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));


  // blocks pour la page consultation
  acf_register_block(array(
    'name'              => 'Consultation',
    'title'             => __('Consultation'),
    'render_template'   => '/template-parts/block/consultation.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('consultation'),
    'mode'              => 'auto',
    'category'          => 'formatting',
  ));

  // block pour les articles de presse
  acf_register_block(array(
    'name'              => 'presse',
    'title'             => __('Presse'),
    'render_template'   => '/template-parts/block/presse.php',
    'icon'              => 'dashicons-media-default',
    'keywords'          => array('presse', 'article'),
    'mode'              => 'auto',
    'category'          => 'formatting',

  ));

  acf_register_block(array(
    'name'              => 'article social',
    'title'             => __('Article social'),
    'description'       => __('Article social'),
    'render_template'   => '/template-parts/block/article-guide-social.php',
    'category'          => 'formatting',
    'icon'              => 'welcome-write-blog',
    'mode'              => 'auto',
    'keywords'          => array('blog', 'top', 'haut', 'article'),
  ));

  acf_register_block(array(
    'name'              => 'centre',
    'title'             => __('Centre'),
    'description'       => __('centre'),
    'render_template'   => '/template-parts/block/centre.php',
    'category'          => 'formatting',
    'icon'              => 'admin-home',
    'mode'              => 'auto',
    'keywords'          => array('centre', 'shop', 'retail'),
  ));

  acf_register_block(array(
    'name'              => 'blog',
    'title'             => __('Blog'),
    'description'       => __('Blog'),
    'render_template'   => '/template-parts/block/blog.php',
    'category'          => 'formatting',
    'icon'              => 'admin-news',
    'mode'              => 'auto',
    'keywords'          => array('blog', 'actu', 'news'),
  ));

  acf_register_block(array(
    'name'              => 'retailMap',
    'title'             => __('Points de vente'),
    'description'       => __('Points de vente'),
    'render_template'   => '/template-parts/block/retail-map.php',
    'category'          => 'formatting',
    'icon'              => 'admin-news',
    'mode'              => 'auto',
    'keywords'          => array('map', 'carte', 'points'),
  ));

  acf_register_block(array(
    'name'              => 'testi',
    'title'             => __('Témoignages'),
    'description'       => __('Témoignage'),
    'render_template'   => '/template-parts/block/testimonial.php',
    'category'          => 'formatting',
    'icon'              => 'testimonial',
    'mode'              => 'auto',
    'keywords'          => array('témoign', 'temoign', 'testi'),
  ));


  // bloc utilisé pour toutes les listes de card en général (techniques médicales, offres...)
  acf_register_block(array(
    'name'              => 'tech-meds',
    'title'             => __('Liste de cartes'),
    'description'       => __('Liste de cartes'),
    'render_template'   => '/template-parts/block/tech-meds.php',
    'category'          => 'formatting',
    'icon'              => 'image-filter',
    'mode'              => 'auto',
    'keywords'          => array('tech', 'médical', 'cartes', 'card', 'list'),
  ));

  // bloc utilisé pour toutes les slides de cards
  acf_register_block(array(
    'name'              => 'slider-cards',
    'title'             => __('Slider de cartes'),
    'description'       => __('Slider de cartes'),
    'render_template'   => '/template-parts/block/slider-cards.php',
    'category'          => 'formatting',
    'icon'              => 'image-filter',
    'mode'              => 'auto',
    'keywords'          => array('tech', 'médical', 'cartes', 'card', 'slide'),
  ));

  // acf_register_block(array(
  //   'name'              => 'tarif',
  //   'title'             => __('Bloc Tarifs'),
  //   'description'       => __('Bloc Tarifs'),
  //   'render_template'   => '/template-parts/block/tarifsBlock.php',
  //   'category'          => 'formatting',
  //   'icon'              => 'image-filter',
  //   'mode'              => 'auto',
  //   'keywords'          => array('tarif', 'prix', 'price'),
  // ));

  // acf_register_block(array(
  //   'name'              => 'tarifTabs',
  //   'title'             => __('Bloc Tarifs onglets'),
  //   'description'       => __('Bloc Tarifs onglets'),
  //   'render_template'   => '/template-parts/block/tarifsTabsBlock.php',
  //   'category'          => 'formatting',
  //   'icon'              => 'image-filter',
  //   'mode'              => 'auto',
  //   'keywords'          => array('tarif', 'prix', 'price'),
  // ));

  acf_register_block(array(
    'name'              => 'doctor',
    'title'             => __('Avis du Médecin'),
    'description'       => __('Avis du Médecin'),
    'render_template'   => '/template-parts/block/doctor.php',
    'category'          => 'formatting',
    'icon'              => 'testimonial',
    'mode'              => 'auto',
    'keywords'          => array('doc', 'méde', 'avis'),
  ));

  acf_register_block(array(
    'name'              => 'discount',
    'title'             => __('Réductions'),
    'description'       => __('Réduction'),
    'render_template'   => '/template-parts/block/discount.php',
    'category'          => 'formatting',
    'icon'              => 'tag',
    'mode'              => 'auto',
    'keywords'          => array('réduc', 'promo'),
  ));

  acf_register_block(array(
    'name'              => 'valeur',
    'title'             => __('Valeur'),
    'description'       => __('Valeur'),
    'render_template'   => '/template-parts/block/valeur.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('list', 'point', 'exp', 'bullet', 'val',),
  ));

  acf_register_block(array(
    'name'              => 'simple-tabs',
    'title'             => __('Simple tabs'),
    'description'       => __('Simple tabs'),
    'render_template'   => '/template-parts/block/simple-tabs.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('tabs', 'onglet'),
  ));

  acf_register_block(array(
    'name'              => 'two-tabs',
    'title'             => __('Deux onglets'),
    'description'       => __('Deux onglets'),
    'render_template'   => '/template-parts/block/two-tabs.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('tabs', 'onglet'),
  ));

  acf_register_block(array(
    'name'              => 'submenu-siblings',
    'title'             => __('Sous menu'),
    'description'       => __('Sous menu'),
    'render_template'   => '/template-parts/block/submenu-siblings.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('submenu', 'menu'),
  ));

  acf_register_block(array(
    'name'              => 'offres',
    'title'             => __('Offres'),
    'description'       => __('Offres'),
    'render_template'   => '/template-parts/block/offres.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('offres', 'onglet'),
  ));

  acf_register_block(array(
    'name'              => 'zone-traiter',
    'title'             => __('Zones à traiter'),
    'description'       => __('Zones à traiter'),
    'render_template'   => '/template-parts/block/zone-traiter.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('zones', 'onglet'),
  ));

  // acf_register_block(array(
  //   'name'              => 'before-after',
  //   'title'             => __('Before after'),
  //   'description'       => __('Before after'),
  //   'render_template'   => '/template-parts/block/before-after.php',
  //   'category'          => 'formatting',
  //   'icon'              => 'list-view',
  //   'mode'              => 'auto',
  //   'keywords'          => array('before', 'after', 'avant', 'après'),
  // ));

  acf_register_block(array(
    'name'              => 'diagrammes',
    'title'             => __('Diagrammes'),
    'description'       => __('Diagrammes'),
    'render_template'   => '/template-parts/block/diagrammes-new.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('diagrammes'),
  ));

  acf_register_block(array(
    'name'              => 'steps',
    'title'             => __('Étapes'),
    'description'       => __('Étapes'),
    'render_template'   => '/template-parts/block/steps.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('étapes', 'liste'),
  ));

  acf_register_block(array(
    'name'              => 'homeTop',
    'title'             => __('Haut page accueil'),
    'description'       => __('Haut page accueil'),
    'render_template'   => '/template-parts/block/homeTop.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('home', 'accueil'),
  ));

  acf_register_block(array(
    'name'              => 'engagements',
    'title'             => __('Engagements'),
    'description'       => __('Engagements'),
    'render_template'   => '/template-parts/block/engagements.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('engag'),
  ));

  acf_register_block(array(
    'name'              => 'universTop',
    'title'             => __('Haut page univers'),
    'description'       => __('Haut page univers'),
    'render_template'   => '/template-parts/block/universTop.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('univers', 'world'),
  ));

  acf_register_block(array(
    'name'              => 'universHeart',
    'title'             => __('Univers Coeur Aesthe'),
    'description'       => __('Univers Coeur Aesthe'),
    'render_template'   => '/template-parts/block/universHeart.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('univers', 'world', 'coeur', 'heart'),
  ));

  acf_register_block(array(
    'name'              => 'manifesto',
    'title'             => __('Manifesto'),
    'description'       => __('Manifesto'),
    'render_template'   => '/template-parts/block/manifesto.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('univers', 'manifesto'),
  ));

  acf_register_block(array(
    'name'              => 'universPrices',
    'title'             => __('Univers Prix justes'),
    'description'       => __('Univers Prix justes'),
    'render_template'   => '/template-parts/block/universPrices.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('univers', 'world', 'prices', 'prix'),
  ));

  acf_register_block(array(
    'name'              => 'keywords',
    'title'             => __('Mots-clés'),
    'description'       => __('Mots-clés'),
    'render_template'   => '/template-parts/block/keywords.php',
    'category'          => 'formatting',
    'icon'              => 'list-view',
    'mode'              => 'auto',
    'keywords'          => array('mot', 'key'),
  ));
}

// Check if function exists and hook into setup.
if (function_exists('acf_register_block')) {
  add_action('acf/init', 'register_acf_blocks');
}

//  ajouter des cathégories aux pages
function add_categories_to_pages()
{
  register_taxonomy_for_object_type('category', 'page');
}
add_action('init', 'add_categories_to_pages');

//  ajouter des tags aux pages
function add_tags_to_pages()
{
  register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tags_to_pages');

//  ajouter des excerpts aux pages
function add_excerpts_to_pages()
{
  add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpts_to_pages');

// function isMobile() {
//   return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
// }

// // remove les {id} automatique des blocs
// if(isMobile()){
remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);
remove_filter('render_block', 'gutenberg_render_layout_support_flag', 10, 2);
// }

/*
// AJOUT BOUTON A COTE D'AJOUTER
add_action('admin_head-edit.php', 'addCustomExportButton');

function addCustomExportButton() {
    global $current_screen;
    if ('inscription-landing' != $current_screen->post_type) return;
    ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var le_a = document.createElement('a');
            le_a.setAttribute('class', 'page-title-action');
            le_a.setAttribute('href', 'options-general.php?page=simple_csv_exporter_settings&export=csv');
            le_a.appendChild(document.createTextNode('Exporter'));
            document.querySelector('.wrap').insertBefore(le_a, document.querySelector('.wp-header-end'));
        });
        </script>
    <?php
}
*/

/*
// Allow Contributors to Upload Files
// https://wpchannel.com/autoriser-contributeurs-envoyer-fichiers-wordpress/
function wpc_allow_contributors_upload_files() {
  if (current_user_can('contributor') && !current_user_can('upload_files'))
  add_action('admin_init', 'allow_contributor_uploads');
   
  function allow_contributor_uploads() {
    $contributor = get_role('contributor');
    $contributor->add_cap('upload_files');
  }
}
*/


/*

// Création des colonnnes personnalisées
function wpc_colonne($columns) {
 return array_merge( $columns, 
 array('thumb' => __('Photo')) );
}
add_filter('manage_posts_columns' , 'wpc_colonne');



// Affichage des données
add_action('manage_posts_custom_column', 'data_colonne');
function data_colonne($name) {
 global $post;
 switch ($name) {
case 'thumb':
 if(get_field('photo',$post->ID))
 {
 ?>
 <img src="<?= get_field('photo',$post->ID)['sizes']['thumbnail']; ?>" width="100" />
 <?php
 }
 else
 {
 _e('Pas de photo.','twentyeleven');
 }
 break;
 }
 }

*/


/* ajout sélecteur taxo type produit */

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
/*
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
  global $typenow;
  $post_type = 'produit'; // change to your post type
  $taxonomy  = 'type'; // change to your taxonomy
  if ($typenow == $post_type) {
    $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $info_taxonomy = get_taxonomy($taxonomy);
    wp_dropdown_categories(array(
      'show_option_all' => __("Show All {$info_taxonomy->label}"),
      'taxonomy'        => $taxonomy,
      'name'            => $taxonomy,
      'orderby'         => 'name',
      'selected'        => $selected,
      'show_count'      => true,
      'hide_empty'      => true,
    ));
  };
}
*/
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
/*
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
  global $pagenow;
  $post_type = 'produit'; // change to your post type
  $taxonomy  = 'type'; // change to your taxonomy
  $q_vars    = &$query->query_vars;
  if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
    $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
    $q_vars[$taxonomy] = $term->slug;
  }
}
*/





/**
 * Adjust API endpoint availability to hide user info
 * masque author auteurs sur url headless
 */
function my_api_endpoint_setup($endpoints)
{
  if (isset($endpoints['/wp/v2/users'])) {
    unset($endpoints['/wp/v2/users']);
  }
  if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
    unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
  }
  return $endpoints;
}
add_filter('rest_endpoints', 'my_api_endpoint_setup');


function is_post_type($type)
{
  global $wp_query;
  if ($type == get_post_type($wp_query->post->ID))
    return true;
  return false;
}


// Remove Gutenberg Block Library CSS from loading on the frontend
function smartwp_remove_wp_block_library_css()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS

  wp_enqueue_script('salvattore', get_template_directory_uri() . '/assets/js/yeah/salvattore.min.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);


// remove editor for the "Presse" posts
function remove_editors()
{
  remove_post_type_support('presse', 'editor');
  remove_post_type_support('tarifs', 'editor');
  remove_post_type_support('presse', 'excerpt');
}
add_action('init', 'remove_editors');


//  Exemple Monnoyeur : disabling the Gutenberg editor according to POST id
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
  if ($post_type === 'soin') return false;
  return $current_status;
}

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
  return 20;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

/*
// CSS BACKOFFICE CUSTOM BACKEND

add_action('admin_head', 'backend_css');

function backend_css() {
    if($_GET['post']==7 || $_GET['post']==9 || $_GET['post']==13) echo '<style>.edit-post-visual-editor.editor-styles-wrapper { display: none }</style>';
    echo "<style>.bottom_links, .bottom_links+div { display:none}</style>";
}
*/


// enleve tous les accès headless + liste users
// remove_action('rest_api_init', 'create_initial_rest_routes', 99);


// if (function_exists('acf_add_options_page')) {

// acf_add_options_page(array(
//   'page_title'  => 'Options',
//   'menu_title'  => 'Options Pam',
//   'menu_slug'   => 'theme-general-settings',
//   'capability'  => 'edit_posts',
//   'redirect'    => false
// ));

/*
  acf_add_options_sub_page(array(
    'page_title'  => 'Contact Settings',
    'menu_title'  => 'Contact',
    'parent_slug' => 'theme-general-settings',
  ));
  */
// }







add_theme_support('editor-color-palette', array(
  array(
    'name'  => __('Nude', 'aesthe'),
    'slug'  => 'aesthe-nude',
    'color' => '#FFF5ED',
  ),

  array(
    'name'  => __('Orange', 'aesthe'),
    'slug'  => 'aesthe-orange',
    'color' => '#FF8347',
  ),
  array(
    'name'  => __('Bleu', 'aesthe'),
    'slug'  => 'aesthe-blue',
    'color' => '#061CA6',
  ),
  array(
    'name'  => __('Bleu clair', 'aesthe'),
    'slug'  => 'aesthe-blueLight',
    'color' => '#B7E2FF',
  ),
  array(
    'name'  => __('Rouge', 'aesthe'),
    'slug'  => 'aesthe-coral',
    'color' => '#FF4750',
  ),
  array(
    'name'  => __('Jaune', 'aesthe'),
    'slug'  => 'aesthe-yellow',
    'color' => '#FFE140',
  ),
  array(
    'name'  => __('Violet', 'aesthe'),
    'slug'  => 'aesthe-purple',
    'color' => '#5D23D0',
  )
));

// add hook to retrieve submenu siblings
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
{
  if (isset($args->sub_menu)) {
    $root_id = 0;

    // find the current menu item
    foreach ($sorted_menu_items as $menu_item) {
      if ($menu_item->current) {
        // set the root id based on whether the current menu item has a parent or not
        $root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
        break;
      }
    }

    // find the top level parent
    if (!isset($args->direct_parent)) {
      $prev_root_id = $root_id;
      while ($prev_root_id != 0) {
        foreach ($sorted_menu_items as $menu_item) {
          if ($menu_item->ID == $prev_root_id) {
            $prev_root_id = $menu_item->menu_item_parent;
            // don't set the root_id to 0 if we've reached the top of the menu
            if ($prev_root_id != 0) $root_id = $menu_item->menu_item_parent;
            break;
          }
        }
      }
    }

    $menu_item_parents = array();
    foreach ($sorted_menu_items as $key => $item) {
      // init menu_item_parents
      if ($item->ID == $root_id) $menu_item_parents[] = $item->ID;

      if (in_array($item->menu_item_parent, $menu_item_parents)) {
        // part of sub-tree: keep!
        $menu_item_parents[] = $item->ID;
      } else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
        // not part of sub-tree: away with it!
        unset($sorted_menu_items[$key]);
      }
    }

    return $sorted_menu_items;
  } else {
    return $sorted_menu_items;
  }
}

/**************
 **************
 * PLUGIN :
 * SITE REVIEWS
 **************
 **************
 */

/**
 * This removes the nonce check for logged-in users when submitting a review.
 * Nonces can be problematic when your pages are cached, and for this reason it's commonly suggested to * not cache pages for logged in users.
 * However, if caching is required on your site for logged in users, then this snippet will remove the * Nonce check when a user submits a review.
 * @see http://developer.wordpress.org/plugins/security/nonces/
 */
add_filter('site-reviews/router/admin/unguarded-actions', function ($actions) {
  $actions[] = 'submit-review';
  return $actions;
});


/**
 * Hides the review form after a review has been submitted
 * Paste this in your active theme's functions.php file
 *
 * @param string $script
 * @return string
 */
add_filter('site-reviews/enqueue/public/inline-script/after', function ($javascript) {
  return $javascript . "
    GLSR.Event.on('site-reviews/form/handle', function (response, formEl) {
        if (false !== response.errors) return;
        formEl.classList.add('glsr-hide-form');
        formEl.insertAdjacentHTML('afterend', '<p>' + response.message + '</p>');
    });";
});

/**
 * Enables the Custom Fields metabox to display the values of the submitted custom fields
 * Paste this in your active theme's functions.php file.
 * @return void
 */
add_action('admin_init', function () {
  add_post_type_support('site-review', 'custom-fields');
});

/**
 * Modifies the properties of the schema created by Site Reviews.
 * Change "LocalBusiness" to the schema type you wish to change (i.e. Product)
 * Paste this in your active theme's functions.php file.
 * @param array $schema
 * @return array
 */
add_filter('site-reviews/schema/Product', function ($schema) {
  // modify the $schema array here.
  if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/acide-hyaluronique/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/skinbooster/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/profhilo/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/radiesse/#product"
  ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "350",
      'highPrice' => "450",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/fils-tenseurs/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "1000",
      'highPrice' => "1800",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/mesotherapie/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "150",
      'highPrice' => "180",
      'priceCurrency' => "EUR",
    ];
  } else if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-fractionne/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-pigmentaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-pigmentaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/laser-vasculaire/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/rejuvenation-laser/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/le-laser-clearsilk/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/ipl/#product"
  ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "240",
      'highPrice' => "600",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/laser-forever-young-bbl/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "200",
      'highPrice' => "560",
      'priceCurrency' => "EUR",
    ];
  } else if ($schema['@id'] == "https://aesthe.com/techniques-medicales/laser-halo/#product") {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "500",
      'highPrice' => "900",
      'priceCurrency' => "EUR",
    ];
  } else if (
    $schema['@id'] == "https://aesthe.com/techniques-medicales/peeling/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/microneedling/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/pdt-phototherapie-dynamique/#product" ||
    $schema['@id'] == "https://aesthe.com/techniques-medicales/hydrafacial/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/hydra-plus/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/soin-reparateur/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/glow-express/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/glow-plus/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/soin-keratoregulateur/#product" ||
    $schema['@id'] == "https://aesthe.com/offres/clear-plus/#product"
  ) {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "120",
      'highPrice' => "250",
      'priceCurrency' => "EUR",
    ];
  } else {
    $schema['offers'] = [
      '@type' => "AggregateOffer",
      'lowPrice' => "0",
      'highPrice' => "1000",
      'priceCurrency' => "EUR",
    ];
  }
  return $schema;
});

/* Précompsitions de blocs Gutenberg */
if (function_exists('register_block_pattern')) {

  if (function_exists('register_block_pattern_category')) register_block_pattern_category('aesthe', array('label' => __('aesthe')));

  register_block_pattern(
    'aesthe',
    array(
      'title'       => __('Photo titre paragraphe cta'),
      'categories'  => array('aesthe'),
      'description' => __('Photo titre paragraphe cta'),
      'content'     => '<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:image {\"id\":47,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-full\"><img src=\"http://localhost:8888/aesthe/wp-content/uploads/post.jpg\" alt=\"\" class=\"wp-image-47\"/></figure>\n<!-- /wp:image --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading -->\n<h2>Lorem ipsum</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:buttons -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"aesthe-orange\"} -->\n<div class=\"wp-block-button\"><a class=\"wp-block-button__link has-aesthe-orange-background-color has-background\">Titre du cta</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->',
    )
  );
}


/**
 * Reusable Blocks accessible in backend
 * @link https://www.billerickson.net/reusable-blocks-accessible-in-wordpress-admin-area
 *
 */
function be_reusable_blocks_admin_menu()
{
  add_menu_page('Blocs réutilisables', 'Blocs Gutenberg', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
}
add_action('admin_menu', 'be_reusable_blocks_admin_menu');

// remove private before titles
add_filter('private_title_format', function ($format) {
  return '%s';
});

//add params to canonical (page avis)
add_filter('wpseo_canonical', 'add_params_to_canonical');

function add_params_to_canonical($canonical)
{
  if (is_page(1925) && 'avis' != basename($_SERVER['REQUEST_URI'])) {

    return $canonical . basename($_SERVER['REQUEST_URI']);
  }

  return $canonical;
}


/* poly lang */

// recup langue en cours : pll_current_language()
add_action('init', function () {
  pll_register_string('RestonsConnectes', 'RestonsConnectes', 'aesthe');
  pll_register_string('ChapeauNewsletterInput', 'ChapeauNewsletterInput', 'aesthe');
  pll_register_string('VoirAvis', 'VoirAvis', 'aesthe');

  pll_register_string('ReviewsResumeNote', 'ReviewsResumeNote', 'site-reviews');
  pll_register_string('ReviewsDonnezAvis', 'ReviewsDonnezAvis', 'site-reviews');
  pll_register_string('ReviewsAvisVerifie', 'ReviewsAvisVerifie', 'site-reviews');
  pll_register_string('ReviewsAvisVerifieTexte', 'ReviewsAvisVerifieTexte', 'site-reviews');
  pll_register_string('ReviewsExplication', 'ReviewsExplication', 'site-reviews');
  pll_register_string('ReviewsBirthdate', 'ReviewsBirthdate', 'site-reviews');
  pll_register_string('ReviewsTechMeds', 'ReviewsTechMeds', 'site-reviews');
  pll_register_string('ReviewsTest', 'ReviewsTest', 'site-reviews');
});



add_filter('pll_the_languages_args', function ($args) {
  $args['display_names_as'] = 'slug';
  return $args;
});


function new_main_menu()
{
  register_nav_menu('main-menu', __('Main Menu'));
}
add_action('init', 'new_main_menu');



// Microdonnée avec RANK MATH
add_filter('rank_math/json_ld', function ($data, $jsonld) {
  if (!have_rows('faq_champs')) {
    return $data;
  }
  $data['faqs'] = [
    '@type' => 'FAQPage',
  ];
  while (have_rows('faq_champs')) {
    the_row();
    $data['faqs']['mainEntity'][] = [
      '@type' => 'Question',
      'name' => esc_attr(get_sub_field('faq_question')),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => esc_attr(get_sub_field('faq_reponse')),
      ],
    ];
  }
  return $data;
}, 10, 2);

// racourcit print_r
function printr($data)
{
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}
