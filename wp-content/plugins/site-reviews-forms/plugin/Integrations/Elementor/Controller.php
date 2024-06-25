<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Integrations\Elementor;

use Elementor\Controls_Manager;
use GeminiLabs\SiteReviews\Addon\Forms\Application;
use GeminiLabs\SiteReviews\Controllers\AbstractController;
use GeminiLabs\SiteReviews\Helpers\Arr;

class Controller extends AbstractController
{
    /**
     * @param \Elementor\Widget_Base $widget
     * @filter site-reviews/elementor/register/controls
     */
    public function filterElementorWidgetControls(array $sections, $widget): array
    {
        if (!in_array($widget->get_name(), ['site_review', 'site_reviews', 'site_reviews_form'])) {
            return $sections;
        }
        $option = [
            'default' => '',
            'label_block' => true,
            'options' => glsr(Application::class)->posts(),
            'type' => Controls_Manager::SELECT2,
        ];
        if ('site_reviews' === $widget->get_name()) {
            $option['label'] = _x('Use a Custom Form Review Template', 'admin-text', 'site-reviews-forms');
        } else {
            $option['label'] = _x('Use a Custom Form', 'admin-text', 'site-reviews-forms');
        }
        $controls = $sections['settings']['controls'];
        if ('site_review' === $widget->get_name() && array_key_exists('post_id', $controls)) {
            $controls['post_id']['separator'] = 'after';
            $controls = Arr::insertAfter('post_id', $controls, ['form' => $option]);
        } else {
            $controls = Arr::prepend($controls, $option, 'form');
        }
        $sections['settings']['controls'] = $controls;
        return $sections;
    }
}
