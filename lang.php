<?php

/*
 * Title: AddressBookManager
 * Author: Ilyas bakouch
 * Page: lang.php
 * Description: Fichier qui offre � l'utilisation la possibilit� de choisir la langue du site
 * Version: 1.0
 */
 	 
/*
    // si aucune langue n'est d�clar�e on tente de reconnaitre la langue par d�faut du navigateur
    $lang = substr($HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'],0,2); 
*/

if(isset($HTTP_COOKIE_VARS['lang'])) {
    $lang = $HTTP_COOKIE_VARS['lang'];
    include('lang/'.$lang.'-lang.php');
} else {
    if ($_GET['lang']=='fr') {           // si la langue est 'fr' (fran�ais) on inclut le fichier fr-lang.php
        include('lang/fr-lang.php');
    }else if ($_GET['lang']=='en') {      // si la langue est 'en' (anglais) on inclut le fichier en-lang.php
        include('lang/en-lang.php');
    }else {                       // si aucune langue n'est d�clar�e on inclut le fichier fr-lang.php par d�faut
        include('lang/fr-lang.php');
    }
    //d�finition de la dur�e du cookie (1 an)
    $expire = 365*24*3600; 
    $lang = $_GET['lang'];

    //enregistrement du cookie au nom de lang
    setcookie("lang", $lang, time() + $expire);
}
	 
?>