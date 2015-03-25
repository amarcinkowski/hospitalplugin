<?php
/**
 * migrate
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
use Punction\Entities\PatientZZ;
use Punction\DB\DoctrineBootstrap;

if (! defined('ABSPATH')) {
    define('WP_USE_THEMES', false);
    require ('/var/www/wp/wp-load.php');
}
require_once ('/var/www/vendor/autoload.php');
Logger::configure('../resources/log4php.xml');
/**
 * migration log4php logger
 */
$log = Logger::getLogger("migration");
$log->info("Start!");

global $wpdb;
/**
 */
$query = "
        SELECT
            *
        FROM         $wpdb->posts
        WHERE
            post_type = 'pacjent'
            AND post_status = 'publish'
        ORDER BY
            post_title,
            post_date
        LIMIT    
        35000";

/**
 */
$error = "Error: the query failed...";
/**
 */
$results = $wpdb->get_results($query, ARRAY_A) || wp_die($error);

$db1 = new DoctrineBootstrap();
$entityManager = $db1->getEntityManager();

foreach ($results as /**
 */
$result) {
    /**
     */
    $id = $result['ID'];
    /**
     */
    $title = $result['post_title'];
    /**
     */
    $pesel = implode(get_post_meta($id, 'pesel'));
    /**
     */
    $oddzid = implode(get_post_meta($id, 'oddzial.ID'));
    /**
     */
    
    $numer_historii = implode(get_post_meta($id, 'numer_ksiegi_glownej'));
    /**
     */
    $data_kategoryzacji = implode(get_post_meta($id, 'data_kategoryzacji'));
    /**
     */
    $kategoria_pacjenta = implode(get_post_meta($id, 'kategoria_pacjenta'));
    /**
     */
    $aktywnosc_fizyczna = implode(get_post_meta($id, '1_aktywnosc_fizyczna'));
    /**
     */
    $higiena = implode(get_post_meta($id, '2_higiena'));
    /**
     */
    $odzywianie = implode(get_post_meta($id, '3_odzywianie'));
    /**
     */
    $wydalanie = implode(get_post_meta($id, '4_wydalanie'));
    /**
     */
    $pomiar_objawow_zyciowych = implode(get_post_meta($id, '5_pomiar_objawow_zyciowych'));
    /**
     */
    $leczenie = implode(get_post_meta($id, '6_leczenie'));
    /**
     */
    $edukacja_i_wsparcie_psychiczne = implode(get_post_meta($id, '7_edukacja_i_wsparcie_psychiczne'));
    
    /**
     */
    $patient = new PatientZZ();
    $patient->setName($title);
    if ($data_kategoryzacji == null) {
        $log->warn("Patient " . $id . " missing date. Omitting.");
        continue;
    }
    $patient->setDataKategoryzacji(\DateTime::createFromFormat("d-m-Y", $data_kategoryzacji));
    $patient->setOddzialId($oddzid);
    $patient->setNumerHistorii($numer_historii);
    
    $patient->setPesel($pesel);
    $patient->setKategoriaPacjenta($kategoria_pacjenta);
    $patient->setAktywnoscFizyczna($aktywnosc_fizyczna);
    $patient->setHigiena($higiena);
    $patient->setOdzywianie($odzywianie);
    $patient->setWydalanie($wydalanie);
    $patient->setPomiarObjawowZyciowych($pomiar_objawow_zyciowych);
    $patient->setLeczenie($leczenie);
    $patient->setEdukacjaIWsparciePsychiczne($edukacja_i_wsparcie_psychiczne);
    
    $entityManager->persist($patient);
}
$entityManager->flush();
$log->info("Stop!");
