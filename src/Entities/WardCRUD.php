<?php
/**
 * WardCRUD
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

use Hospitalplugin\Entities\Ward;
use Hospitalplugin\DB\DoctrineBootstrap;
use Hospitalplugin\utils\Utils;

class WardCRUD
{

    /**
     */
    public static function getWardIdForUser($userId)
    {
        return WardCRUD::getWardForUser($userId)->getId();
    }
    
    public static function addWard($ward) {
    	$entityManager = (object) DoctrineBootstrap::getEntityManager();
    	$entityManager->persist($ward);
    	$entityManager->flush();
    }

    /**
     * @param $userId int
     * 
     * @return Ward Ward ward
     *
     */
    public static function getWardForUser($userId)
    {
        $entityManager = (object) DoctrineBootstrap::getEntityManager();
        $user = $entityManager->getRepository('Hospitalplugin\Entities\User')->findOneById($userId);
        return $user->getWard();
    }
    
    public static function getWardById($id)
    {
        $entityManager = (object) DoctrineBootstrap::getEntityManager();
        $ward = $entityManager->getRepository('Hospitalplugin\Entities\Ward')->findOneById($id);
        return $ward;
    }

    public static function getWardsArray()
    {
        if (WardCRUD::$wardsArray == null) {
            $entityManager = (object) DoctrineBootstrap::getEntityManager();
            $query = $entityManager->createQuery('select w FROM Hospitalplugin\Entities\Ward w');
            $wards = $query->getResult();
            WardCRUD::$wardsArray = $wards;
        }
        return WardCRUD::$wardsArray;
    }
}