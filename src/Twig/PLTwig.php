<?php

namespace Hospitalplugin\Twig;

use Hospitalplugin\Twig\EscapePLCharsExtension;

class PLTwig {
	/**
	 * Loads Twig with polish settings.
	 * 
	 * @param string $viewsDir        	
	 * @return void|\Twig_Environment
	 */
	public static function load($viewsDir) {
		if (! class_exists ( 'Twig_Loader_Filesystem' )) {
			echo 'Twig not activated. Make sure you activate the plugin in
    <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
			return;
		}
		\Twig_Autoloader::register ();
		try {
			$loader = new \Twig_Loader_Filesystem ( $viewsDir );
			$twig = new \Twig_Environment ( $loader, array () );
			// 'debug' => true
			// 'cache' => '/tmp/'
			$twig->getExtension ( 'core' )->setTimezone ( 'Europe/Warsaw' ); //
			$twig->addExtension ( new EscapePLCharsExtension () );
			return $twig;
		} catch ( Exception $e ) {
			echo "ERR: " . $e;
		}
	}
}