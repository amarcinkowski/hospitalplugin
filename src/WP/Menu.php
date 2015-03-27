<?php
/**
 * Menu
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
 * @version   1.0 $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\WP;

/**
 * Menu
 *
 * @category  Wp
 * @package   Punction
 * @author    Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license   MIT http://opensource.org/licenses/MIT
 * @version   1.0  $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 *
 */
class Menu
{

    private $menus;

    private $url;

    private $unregister;

    /**
     * init
     */
    public function init($menus, $url, $unregister = null)
    {
        $this->menus = $menus;
        $this->url = $url;
        $this->unregister = $unregister;
        add_action('admin_menu', array(
            $this,
            'registerPages'
        ));
    }

    /**
     * register menu pages
     */
    public function registerPages()
    {
        foreach ($this->menus as $menu) {
            $this->registerPage($menu['title'], $menu['cap'], $menu['link'], $menu['class'], $menu['callback'], $menu['type']);
        }
        $this->hideMenu();
    }

    /**
     * hide unused
     */
    public function hideMenu()
    {
        foreach ($this->unregister as $menu) {
            remove_submenu_page($menu['url'], $menu['page']);
        }
    }

    /**
     * register using add_submenu_page
     */
    private function registerPage($title, $capabilities, $url_param, $class, $callback, $type)
    {
        if ($type == 'submenu') {
            add_submenu_page($this->url, $title, $title, $capabilities, $url_param, array(
                $class,
                $callback
            ));
        } else {
            add_menu_page($title, $title, $capabilities, $url_param, array(
                $class,
                $callback
            ));
        }
    }
}
