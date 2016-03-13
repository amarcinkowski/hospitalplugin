<?php
/**
 * ScriptsAndStyles
 *
 * THIS MATERIAL IS PROVIDED AS IS, WITH ABSOLUTELY NO WARRANTY EXPRESSED
 * OR IMPLIED. ANY USE IS AT YOUR OWN RISK.
 *
 * Permission is hereby granted to use or copy this program
 * for any purpose, provided the above notices are retained on all copies.
 * Permission to modify the code and to distribute modified code is granted,
 * provided the above notices are retained, and a notice that the code was
 * modified is included with the above copyright notice.
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\WP;

/**
 * ScriptsAndStyles
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class ScriptsAndStyles
{

    private $scripts;

    private $styles;

    private $pages;

    private $path;

    /**
     * init
     */
    public function init($path, $pages, $scripts, $styles, $type = 'admin')
    {
        if ($type == 'admin') {
            $action = 'admin_enqueue_scripts';
        } else {
            $action = 'wp_enqueue_scripts';
        }
        $this->path = $path;
        $this->pages = $pages;
        $this->scripts = $scripts;
        $this->styles = $styles;
        add_action($action, array(
            $this,
            'hospitalPluginStyles'
        ));
        add_action($action, array(
            $this,
            'hospitalPluginScripts'
        ));
        add_action($action, array(
            $this,
            'removeCustomScripts'
        ));
    }

    /**
     * hospitalRegisterStyle
     * @param $file
     */
    public function hospitalRegisterStyle($file)
    {
        wp_register_style('hospital_admin_style' . $file, $this->path . '/css/' . $file, array(), '1', 'all');
        wp_enqueue_style('hospital_admin_style' . $file);
    }

    /**
     * hospitalRegisterScript
     * @param unknown $file
     * @param unknown $required
     */
    public function hospitalRegisterScript($file, $required = null, $hook = null)
    {
        wp_enqueue_script('hospital_admin_script' . $file, $this->path . '/js/' . $file, $required);
    }

    /**
     * hospitalLocalizeScript
     * @param unknown $file
     * @param unknown $data
     */
    public function hospitalLocalizeScript($file, $data)
    {
        $json_dates = json_encode($data);
        $params = array(
            'my_arr' => $json_dates
        );
        wp_localize_script('hospital_admin_script' . $file, 'php_params', $params);
    }

    /**
     * hospitalPluginStyles
     */
    public function hospitalPluginStyles($hook)
    {
        if (in_array($hook, $this->pages)) {
            foreach ($this->styles as $style) {
                self::hospitalRegisterStyle($style);
            }
        }
    }

    /**
     * hospitalPluginScripts
     * @param string $hook hook to the page
     */
    public function hospitalPluginScripts($hook)
    {
        $jQ = array(
            'jquery'
        );
        if (in_array($hook, $this->pages)) {
            foreach ($this->scripts as $script) {
                self::hospitalRegisterScript($script, $jQ, $hook);
            }
        }
    }

    /**
     */
    public function removeCustomScripts()
    {
        wp_dequeue_style('google-webfonts');
        wp_dequeue_script('wplms-events-gmaps-js');
    }
}

