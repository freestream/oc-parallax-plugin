<?php namespace Freestream\Parallax;

use Backend;
use System\Classes\PluginBase;

/**
 * Parallax Plugin Information File.
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Parallax',
            'description' => 'Manage and create multiple parallax sliders that you can view on any page.',
            'author'      => 'Freestream',
            'icon'        => 'icon-th-large'
        ];
    }

    /**
     * Registers available components.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Freestream\Parallax\Components\Parallax'    => 'parallax'
        ];
    }

    /**
     * Registers a new navigation item.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'gallery' => [
                'label'     => 'Parallax',
                'url'       => Backend::url('freestream/parallax/parallaxes'),
                'icon'      => 'icon-th-large',
                'sideMenu'  => [
                    'gallery'   => [
                        'label'     => 'Parallax',
                        'icon'      => 'icon-th-large',
                        'url'       => Backend::url('freestream/parallax/parallaxes'),
                    ],
                ]
            ]
        ];
    }
}
