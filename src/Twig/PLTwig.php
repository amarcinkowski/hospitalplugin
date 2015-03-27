<?php

namespace Hospitalplugin\Twig;

use Hospitalplugin\Twig\EscapePLCharsExtension;

class PLTwig {
	
	public static function load() {
		if (! class_exists ( 'Twig_Loader_Filesystem' )) {
			echo 'Twig not activated. Make sure you activate the plugin in
    <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
			return;
		}
		\Twig_Autoloader::register ();
		try {
			$loader = new \Twig_Loader_Filesystem ( __DIR__ . '/../views/' );
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