<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: conf.php
 * Version: 1.0
 */

//mySQL database settings
$host = 'localhost'; //normally localhost
$username = 'root'; //database username
$password = ''; //database password
$database = 'adressbook'; //database

//can be any folder in the skins directory
$skin = 'alternative';

//connect to database
$con = @ mysql_connect($host,$username,$password);
if (!$con) {
//echo ('Could not connect: ' . mysql_error());
}

//select database
@ mysql_select_db($database, $con);

//This stops SQL Injection in POST vars
foreach ($_POST as $key => $value) {
    $_POST[$key] = mysql_real_escape_string($value);
}

//This stops SQL Injection in GET vars
foreach ($_GET as $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}

?>