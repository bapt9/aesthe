<?php
/**
 * ╔═╗╔═╗╔╦╗╦╔╗╔╦  ╦  ╔═╗╔╗ ╔═╗
 * ║ ╦║╣ ║║║║║║║║  ║  ╠═╣╠╩╗╚═╗
 * ╚═╝╚═╝╩ ╩╩╝╚╝╩  ╩═╝╩ ╩╚═╝╚═╝.
 *
 * Plugin Name:       Site Reviews: Review Forms
 * Plugin URI:        https://niftyplugins.com/plugins/site-reviews-forms
 * Description:       Create review forms with custom fields and review templates.
 * Version:           2.0.4
 * Author:            Paul Ryley
 * Author URI:        https://niftyplugins.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Text Domain:       site-reviews-forms
 * Domain Path:       languages
 * Update URI:        https://niftyplugins.com
 */
defined('WPINC') || die;

require_once __DIR__.'/autoload.php';
require_once __DIR__.'/compatibility.php';

$gatekeeper = new GeminiLabs\SiteReviews\Addon\Forms\Gatekeeper(__FILE__, [
    'site-reviews/site-reviews.php' => 'Site Reviews|7.0.7|8|https://wordpress.org/plugins/site-reviews',
]);
if ($gatekeeper->allows()) {
    add_action('site-reviews/addon/register', function ($app) {
        $app->register(GeminiLabs\SiteReviews\Addon\Forms\Application::class);
    });
}
add_action('site-reviews/addon/update', function ($app) {
    $app->update(GeminiLabs\SiteReviews\Addon\Forms\Application::class, __FILE__);
});
