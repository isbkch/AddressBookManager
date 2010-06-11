<?php

ob_start();

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: installheader.php
 * Version: 1.0
 */

?>

<html>
    <head>
        <title>AddressBookManager</title>
        <link rel="stylesheet" href="skins/default/style.css">
    </head>
    <body>
        <?php
        //function to redirect
        function redirect($url) {
            header('Location: ' . $url);
            return true;
        }

?>
