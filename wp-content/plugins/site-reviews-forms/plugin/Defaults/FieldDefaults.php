<?php

namespace GeminiLabs\SiteReviews\Addon\Forms\Defaults;

use GeminiLabs\SiteReviews\Addon\Forms\Application;
use GeminiLabs\SiteReviews\Contracts\PluginContract;
use GeminiLabs\SiteReviews\Defaults\DefaultsAbstract;

class FieldDefaults extends DefaultsAbstract
{
    /**
     * The values that should be cast before sanitization is run.
     * This is done before $sanitize and $enums.
     */
    public array $casts = [
        'hidden' => 'bool',
        'required' => 'bool',
    ];

    /**
     * The values that should be sanitized.
     * This is done after $casts and before $enums.
     */
    public array $sanitize = [
        'after' => 'text',
        'class' => 'attr-class',
        'description' => 'text-html',
        'format' => 'text',
        'handle' => 'text',
        'id' => 'id',
        'label' => 'text-html',
        'maxlength' => 'min:0',
        'minlength' => 'min:0',
        'name' => 'name',
        'options' => 'array-consolidate',
        'placeholder' => 'text',
        'tag' => 'key',
        'tag_label' => 'text',
        'text' => 'text',
        'type' => 'name',
        // 'value' => 'string', // disabled because checkbox field value can be an array
    ];

    protected function app(): PluginContract
    {
        return glsr(Application::class);
    }

    protected function defaults(): array
    {
        return [
            'class' => '',
            'format' => '',
            'label' => '',
            'name' => '',
            'options' => [],
            'type' => '',
            'value' => '',
        ];
    }

    /**
     * Normalize provided values, this always runs first.
     */
    protected function normalize(array $values = []): array
    {
        unset($values['expanded']);
        return $values;
    }
}
