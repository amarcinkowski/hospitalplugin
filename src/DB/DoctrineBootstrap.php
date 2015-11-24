<?php

/**
 * DoctrineBootstrap
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
 * @version   1.0 $Id$ $Format:%H$
 * @link      http://
 * @since     File available since Release 1.0.0
 * PHP Version 5
 */
namespace Hospitalplugin\DB;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
// php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql

/**
 * DoctrineBootstrap
 *
 * @category Wp
 * @package Punction
 * @author Andrzej Marcinkowski <andrzej.max.marcinkowski@gmail.com>
 * @copyright 2014 Wojewódzki Szpital Zespolony, Kalisz
 * @license MIT http://opensource.org/licenses/MIT
 * @version 1.0 $Id$ $Format:%H$
 * @link http://
 * @since File available since Release 1.0.0
 *       
 */
class DoctrineBootstrap {
	
	/**
	 * entity manager
	 *
	 * @var _entityManager EnitytManager
	 */
	private static $_entityManager;
	
	/**
	 * loading envs
	 */
	private static function _loadEnv() {
		if (getenv ( 'DB_NAME' ) != null && getenv ( 'DB_NAME' ) != "") {
			return;
		}
		if (defined ( 'ABSPATH' )) {
			\Dotenv::load ( ABSPATH );
		} else {
			\Dotenv::load ( getenv ( 'HOME' ) );
		}
	}
	private static function getPaths() {
		if (file_exists ( getcwd () . "/src/Entities" )) {
			return array (
					getcwd () . "/src/Entities" 
			);
		} else {
			return array (
					getcwd () . "/vendor/amarcinkowski/hospitalplugin/src/Entities" 
			);
		}
	}
	
	/**
	 *
	 * @return entityManager EntityManager
	 */
	private static function _getInstance() {
		$isDevMode = true;
		$config = Setup::createAnnotationMetadataConfiguration ( self::getPaths (), $isDevMode );
		self::_loadEnv ();
		$conn = array (
				'dbname' => getenv ( 'DB_NAME' ),
				'user' => getenv ( 'DB_USER' ),
				'password' => getenv ( 'DB_PASSWORD' ),
				'host' => getenv ( 'DB_HOST' ),
				'driver' => 'pdo_mysql',
				'charset' => 'utf8',
				'driverOptions' => array (
						1002 => 'SET NAMES utf8' 
				),
				'mapping_types' => 'enum:string' 
		);
		return EntityManager::create ( $conn, $config );
	}
	
	/**
	 * returns enitytManager
	 *
	 * @return EntityManager
	 */
	public static function getEntityManager() {
		if (self::$_entityManager == null) {
			self::$_entityManager = self::_getInstance ();
		}
		return self::$_entityManager;
	}
	public static function getCli() {
		$em = DoctrineBootstrap::getEntityManager ();
		$em->getConnection ()->getDatabasePlatform ()->registerDoctrineTypeMapping ( 'enum', 'string' );
		return ConsoleRunner::createHelperSet ( $em );
	}
}

