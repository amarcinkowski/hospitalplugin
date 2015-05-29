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

class InfectionsCRUD {
	public static function getInfections($from, $to, $wardId, $class) {
		$em = ( object ) DoctrineBootstrap::getEntityManager ();
		$qb = $em->createQueryBuilder ();
		$qb->select ( 'i' )->from ( 'Hospitalplugin\Entities\\' . $class, 'i' ) /* */
        ->addOrderBy ( 'i.dataRaportu', 'DESC' ) /* */
        ->addOrderBy ( 'i.dataPrzeslania ', 'DESC' ) /* */
        ->where ( /* */
        		$qb->expr ()->between ( 'i.dataRaportu', ':from', ':to' ) ) /* */
        		->setParameters ( array (
				'from' => $from,
				'to' => $to 
		) );
		if ($wardId != 'all') {
			$qb->andWhere ( $qb->expr ()->eq ( 'i.ward', ':ward' ) ) /* */
        			->setParameter ( 'ward', $wardId );
		}
		
		$query = $qb->getQuery ();
		$infections = $query->getResult ();
		
		return $infections;
	}
	public static function updateVerification($id, $weryfikacja) {
		if ($id != null && $weryfikacja != null) {
			$em = ( object ) DoctrineBootstrap::getEntityManager ();
			$infection = $em->getRepository ( 'Hospitalplugin\Entities\Infections' )->find ( $id );
			$infection->setWeryfikacja ( $weryfikacja );
			$em->flush ();
		}
	}
	public static function obj2DB($obj) {
		$id = $obj->id;
		$em = DoctrineBootstrap::getEntityManager();
		$infection = $em->getRepository('Hospitalplugin\Entities\Infections')->find($id);
		$infection->setWeryfikacja($obj->value);
		$em->persist($infection);
		$em->flush();
		echo $id;
	}
}
?>