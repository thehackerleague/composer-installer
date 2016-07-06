<?php
namespace THL\Installer;

class ThlInstaller extends BaseInstaller
{
    protected $locations = array(
        'module' => 'Modules/{$vendor}/{$name}/',
        'theme' => 'Themes/{$vendor}/{$name}/'
    );

    /**
     * Format package name.
     *
     * For package type asgard-module, cut off a trailing '-plugin' if present.
     *
     * For package type asgard-theme, cut off a trailing '-theme' if present.
     *
     */
    public function inflectPackageVars($vars)
    {
        $vars['vendor'] = ucfirst($vars['vendor']);

        if ($vars['type'] === 'thl-module') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'thl-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

    protected function inflectPluginVars($vars)
    {
        $vars['name'] = ucfirst(preg_replace('/-module/', '', $vars['name']));

        return $vars;
    }

    protected function inflectThemeVars($vars)
    {
        $vars['name'] = ucfirst(preg_replace('/-theme$/', '', $vars['name']));

        return $vars;
    }
}
