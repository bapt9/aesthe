<?php
/**
 * @version 3.0
 */

namespace GeminiLabs\SiteReviews\Addon\Forms;

class Gatekeeper
{
    public string $name;
    public array $dependencies;

    protected array $errors = [];
    protected Notice $notice;
    protected array $noticeWhitelist;
    protected bool $useNoticeWhitelist;

    public function __construct(string $file, array $dependencies = [], bool $useNoticeWhitelist = false)
    {
        require_once ABSPATH.'wp-admin/includes/plugin.php';
        $addon = get_file_data($file, [
            'id' => 'Text Domain',
            'name' => 'Plugin Name'
        ]);
        $this->name = $addon['name'];
        $this->dependencies = $this->parseDependencies($dependencies);
        $this->notice = new Notice();
        $this->noticeWhitelist = [
            'post_type=site-review' => filter_input(INPUT_SERVER, 'QUERY_STRING'),
            'wp-admin/plugins.php' => filter_input(INPUT_SERVER, 'PHP_SELF'),
        ];
        $this->useNoticeWhitelist = wp_validate_boolean($useNoticeWhitelist);
    }

    /**
     * @action current_screen
     */
    public function activatePlugin(): void
    {
        $action = filter_input(INPUT_GET, 'action');
        $plugin = filter_input(INPUT_GET, 'plugin');
        $trigger = filter_input(INPUT_GET, 'trigger');
        if ('activate' !== $action || 'notice' !== $trigger || empty($plugin)) {
            return;
        }
        check_admin_referer('activate-plugin_'.$plugin);
        $result = activate_plugin($plugin, '', is_network_admin(), true);
        if (is_wp_error($result)) {
            wp_die($result->get_error_message());
        }
        wp_safe_redirect(wp_get_referer());
        exit;
    }

    /**
     * Must be called before "admin_init".
     */
    public function allows(): bool
    {
        if ($this->hasPendingDependencies()) {
            $this->setNotice();
            return false;
        }
        return true;
    }

    /**
     * @action admin_init
     */
    public function createDependenciesNotice(): void
    {
        if ($errors = $this->getDependencyErrors()) {
            $message = _nx_noop('%s requires the latest version of', '%s requires the latest version of the following plugins:', 'admin-text', 'site-reviews-forms');
            $message = sprintf(translate_nooped_plural($message, count($errors), 'site-reviews-forms'), '<strong>'.$this->name.'</strong>');
            $this->notice->addWarning([
                $message.' '.$this->buildPluginLinks($errors),
                $this->buildPluginActions($errors),
            ]);
        }
    }

    /**
     * @action admin_init
     */
    public function createUnsupportedNotice(): void
    {
        if ($errors = $this->getUnsupportedErrors()) {
            $message = _nx_noop('%s needs an update to work with', '%s needs an update to work with the following plugins:', 'admin-text', 'site-reviews-forms');
            $message = sprintf(translate_nooped_plural($message, count($errors), 'site-reviews-forms'), '<strong>'.$this->name.'</strong>');
            $this->notice->addError([
                $message.' '.$this->buildPluginLinks($errors),
            ]);
        }
    }

    /**
     * @action admin_notices
     */
    public function displayNotice(): void
    {
        $this->notice->render();
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function hasPendingDependencies(): bool
    {
        foreach ($this->dependencies as $plugin => $data) {
            if (!$this->isPluginInstalled($plugin)) {
                continue;
            }
            if (!$this->isPluginVersionSupported($plugin)) {
                continue;
            }
            if (!$this->isPluginVersionValid($plugin)) {
                continue;
            }
            $this->isPluginActive($plugin);
        }
        return $this->hasErrors();
    }

    public function isPluginActive($plugin): bool
    {
        $isActive = is_plugin_active($plugin) || array_key_exists($plugin, $this->getMustUsePlugins());
        return $this->catchError($plugin, 'inactive', $isActive);
    }

    public function isPluginInstalled($plugin): bool
    {
        $isInstalled = array_key_exists($plugin, $this->getPlugins());
        return $this->catchError($plugin, 'not_found', $isInstalled);
    }

    public function isPluginVersionSupported($plugin): bool
    {
        $unsupportedVersion = $this->getValue($this->dependencies, $plugin, 'UnsupportedVersion');
        $installedVersion = $this->getValue($this->getPlugins(), $plugin, 'Version');
        $isVersionValid = empty($unsupportedVersion) || version_compare($installedVersion, $unsupportedVersion, '<');
        return $this->catchError($plugin, 'unsupported_version', $isVersionValid);
    }

    public function isPluginVersionValid($plugin): bool
    {
        $requiredVersion = $this->getValue($this->dependencies, $plugin, 'Version');
        $installedVersion = $this->getValue($this->getPlugins(), $plugin, 'Version');
        $isVersionValid = version_compare($installedVersion, $requiredVersion, '>=');
        return $this->catchError($plugin, 'wrong_version', $isVersionValid);
    }

    protected function buildActionForInactive(string $plugin): string
    {
        if (!current_user_can('activate_plugins')) {
            return '';
        }
        $data = $this->getPluginData($plugin);
        $url = self_admin_url(sprintf('plugins.php?action=activate&plugin=%s&plugin_status=%s&paged=%s&s=%s&trigger=notice',
            $data['plugin'],
            filter_input(INPUT_GET, 'plugin_status'),
            filter_input(INPUT_GET, 'paged'),
            filter_input(INPUT_GET, 's')
        ));
        $url = wp_nonce_url($url, 'activate-plugin_'.$data['plugin']);
        return $this->buildButton($url, __('Activate'), $data['name']);
    }

    protected function buildActionForNotFound(string $plugin): string
    {
        if (!current_user_can('install_plugins')) {
            return '';
        }
        $data = $this->getPluginData($plugin);
        $url = self_admin_url(sprintf('update.php?action=install-plugin&plugin=%s&trigger=notice', $data['slug']));
        $url = wp_nonce_url($url, 'install-plugin_'.$data['slug']);
        return $this->buildButton($url, __('Install'), $data['name']);
    }

    protected function buildActionForWrongVersion(string $plugin): string
    {
        if (!current_user_can('update_plugins')) {
            return '';
        }
        $data = $this->getPluginData($plugin);
        $url = self_admin_url(sprintf('update.php?action=upgrade-plugin&plugin=%s&trigger=notice', $data['plugin']));
        $url = wp_nonce_url($url, 'upgrade-plugin_'.$data['plugin']);
        return $this->buildButton($url, __('Update'), $data['name']);
    }

    protected function buildButton(string $href, string $action, string $pluginName): string
    {
        return sprintf('<a href="%s" class="button button-small">%s %s</a>', $href, $action, $pluginName);
    }

    protected function buildLink(string $plugin): string
    {
        $data = $this->getPluginData($plugin);
        return sprintf('<span class="plugin-%s"><a href="%s">%s</a></span>',
            $data['slug'],
            $data['pluginuri'],
            $data['name']
        );
    }

    protected function buildPluginActions(array $errors): string
    {
        $actions = [];
        foreach ($errors as $plugin => $error) {
            $value = ucwords(str_replace(['-', '_'], ' ', $error));
            $value = str_replace(' ', '', $value);
            $method = 'buildActionFor'.$value;
            if (method_exists($this, $method)) {
                $actions[] = call_user_func([$this, $method], $plugin);
            }
        }
        return implode(' ', $actions);
    }

    protected function buildPluginLinks(array $errors): string
    {
        $plugins = array_keys($errors);
        array_walk($plugins, function (&$plugin) {
            $plugin = $this->buildLink($plugin);
        });
        return implode(', ', $plugins);
    }

    protected function canDisplayNotice(): bool
    {
        if (!is_admin()) {
            return false;
        }
        if (!$this->useNoticeWhitelist) {
            return true;
        }
        foreach ($this->noticeWhitelist as $needle => $haystack) {
            if (false !== strpos($haystack, $needle)) {
                return true;
            }
        }
        return false;
    }

    protected function catchError(string $plugin, string $errorType, bool $isValidResult): bool
    {
        if (!$isValidResult) {
            $this->errors[$plugin] = $errorType;
        }
        return $isValidResult;
    }

    protected function getDependencyErrors(): array
    {
        return array_filter($this->errors, function ($error) {
            return in_array($error, ['inactive', 'not_found', 'wrong_version']);
        });
    }

    protected function getMustUsePlugins(): array
    {
        $plugins = get_mu_plugins();
        if (in_array('Bedrock Autoloader', array_column($plugins, 'Name'))) {
            $autoloadedPlugins = get_site_option('bedrock_autoloader');
            if (!empty($autoloadedPlugins['plugins'])) {
                return array_merge($plugins, $autoloadedPlugins['plugins']);
            }
        }
        return $plugins;
    }

    protected function getPluginData(string $plugin): array
    {
        $plugins = $this->isPluginInstalled($plugin)
            ? $this->getPlugins()
            : $this->dependencies;
        $data = $this->getValue($plugins, $plugin);
        if (!is_array($data)) {
            wp_die(sprintf('Plugin information not found for: %s', $plugin));
        }
        $data['plugin'] = $plugin;
        $data['slug'] = substr($plugin, 0, strrpos($plugin, '/'));
        return array_change_key_case($data);
    }

    protected function getPlugins(): array
    {
        return array_merge(get_plugins(), $this->getMustUsePlugins());
    }

    protected function getUnsupportedErrors(): array
    {
        return array_filter($this->errors, function ($error) {
            return 'unsupported_version' === $error;
        });
    }

    /**
     * @return array|string
     */
    protected function getValue(array $data, string $slug, string $key = '')
    {
        $value = '';
        if (isset($data[$slug])) {
            $value = $data[$slug];
        }
        return !empty($key) && isset($value[$key])
            ? $value[$key]
            : $value;
    }

    protected function parseDependencies(array $dependencies)
    {
        $keys = ['Name', 'Version', 'UnsupportedVersion', 'PluginURI'];
        $results = [];
        foreach ($dependencies as $plugin => $data) {
            $values = array_pad(explode('|', $data), 4, '');
            $results[$plugin] = array_combine($keys, $values);
        }
        return $results;
    }

    protected function setNotice(): void
    {
        if (!$this->canDisplayNotice() || !$this->hasErrors()) {
            return;
        }
        add_action('current_screen', [$this, 'activatePlugin']);
        add_action('admin_init', [$this, 'createDependenciesNotice']);
        add_action('admin_init', [$this, 'createUnsupportedNotice']);
        add_action('admin_notices', [$this, 'displayNotice']);
    }
}
