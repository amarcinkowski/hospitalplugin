<?php

/**
 * PatientCRUD
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
namespace Hospitalplugin\Entities;

use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;
use Hospitalplugin\Twig\EscapePLCharsExtension;
use Hospitalplugin\Entities\WardCRUD;
use Hospitalplugin\Twig\PLTwig;

class HospitalForm {
	public static function load($yaml, $class, $dir) {
		try {
			$em = DoctrineBootstrap::getEntityManager ();
			
			$userId = $userId = wp_get_current_user ()->ID;
			$ward = WardCRUD::getWardForUser ( $userId );
			$user = $em->find ( "\Hospitalplugin\Entities\User", $userId );
			
			if (! empty ( $_POST )) {
				$args = $_POST;
				$i = new $class ( $args );
				$i->setWard ( $ward );
				$i->setUser ( $user );
				$em->persist ( $i );
				$em->flush ();
			} else {
				$object = \Hospitalplugin\utils\YAML2Object::getObject ( $yaml );
				echo PLTwig::load ( $dir )->render ( 'form.twig', array (
						'infections' => $object 
				) );
			}
		} catch ( Exception $e ) {
			echo "ERR: " . $e;
		}
	}
}
?>