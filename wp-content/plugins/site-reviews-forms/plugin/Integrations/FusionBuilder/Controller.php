<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Integrations\FusionBuilder;

use GeminiLabs\SiteReviews\Addon\Forms\Application;
use GeminiLabs\SiteReviews\Controllers\AbstractController;
use GeminiLabs\SiteReviews\Helpers\Arr;

class Controller extends AbstractController
{
    /**
     * @filter site-reviews/fusion-builder/controls/site_review
     */
    public function filterSiteReviewControls(array $parameters): array
    {
        $option = $this->optionForm(esc_attr_x('Use a Custom Review Form Template', 'admin-text', 'site-reviews-forms'));
        $parameters = Arr::insertAfter('post_id', $parameters, ['form' => $option]);
        return $parameters;
    }

    /**
     * @filter site-reviews/fusion-builder/controls/site_reviews
     */
    public function filterSiteReviewsControls(array $parameters): array
    {
        $option = $this->optionForm(esc_attr_x('Use a Custom Review Form Template', 'admin-text', 'site-reviews-forms'));
        $parameters = Arr::prepend($parameters, $option, 'form');
        return $parameters;
    }

    /**
     * @filter site-reviews/fusion-builder/controls/site_reviews_form
     */
    public function filterSiteReviewsFormControls(array $parameters): array
    {
        $option = $this->optionForm(esc_attr_x('Use a Custom Review Form', 'admin-text', 'site-reviews-forms'));
        $parameters = Arr::prepend($parameters, $option, 'form');
        $parameters['hide']['dependency'] = [
            [
                'element' => 'form',
                'operator' => 'is_empty',
            ],
        ];
        return $parameters;
    }

    protected function optionForm(string $heading, string $description = ''): array
    {
        $forms = glsr(Application::class)->posts(-1, esc_attr_x('- Use Default Form -', 'admin-text', 'site-reviews-forms'));
        if (count($forms) > 50) {
            $option = [
                'ajax' => 'fusion_search_query',
                'ajax_params' => [
                    'post_type' => ['name' => Application::POST_TYPE],
                ],
                'default' => '',
                'heading' => $heading,
                'max_input' => 1,
                'param_name' => 'form',
                'placeholder_text' => esc_attr_x('Select or Leave Blank', 'admin-text', 'site-reviews-forms'),
                'type' => 'ajax_select',
                'value' => '',
            ];
        } else {
            $option = [
                'default' => '',
                'heading' => $heading,
                'param_name' => 'form',
                'type' => 'select',
                'value' => $forms,
            ];
        }
        if (!empty($description)) {
            $option['description'] = $description;
        }
        return $option;
    }
}
