<?php
/**
 * @version 4.0
 */

namespace GeminiLabs\SiteReviews\Addon\Forms;

class Notice
{
    protected array $notices = [];

    /**
     * @param string|array|\WP_Error $message
     */
    public function add(string $type, $message): self
    {
        if (is_wp_error($message)) {
            $message = $message->get_error_message();
        }
        if (is_array($message)) {
            $message = array_reduce($message, function ($carry, $line) {
                return $carry.wpautop($line);
            }, '');
        }
        $this->notices[] = [
            'message' => $message,
            'type' => $type,
        ];
        return $this;
    }

    /**
     * @param string|array|\WP_Error $message
     */
    public function addError($message): self
    {
        return $this->add('error', $message);
    }

    /**
     * @param string|array|\WP_Error $message
     */
    public function addSuccess($message): self
    {
        return $this->add('success', $message);
    }

    /**
     * @param string|array|\WP_Error $message
     */
    public function addWarning($message): self
    {
        return $this->add('warning', $message);
    }

    public function build(): string
    {
        return array_reduce($this->get(), function ($carry, $args) {
            return $carry.sprintf('<div class="glsr-notice notice notice-%s is-dismissible">%s</div>',
                $args['type'],
                $args['message']
            );
        }, '');
    }

    public function get(): array
    {
        $notices = array_map('unserialize', array_unique(array_map('serialize', $this->notices)));
        usort($notices, function ($a, $b) {
            $order = ['error', 'warning', 'info', 'success'];
            return array_search($a['type'], $order) - array_search($b['type'], $order);
        });
        return $notices;
    }

    public function render(): void
    {
        echo $this->build();
    }
}
