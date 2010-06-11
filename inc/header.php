<?php

ob_start();

session_start();

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: header.php
 * Version: 1.0
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>

<?php 

include 'connection.php';

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $logged_in = true;
} else {
    $logged_in = false;
}
include '/lang.php';
?>

<title>ContactManager</title>
<link rel="stylesheet" href="skins/<?php echo $skin; ?>/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php

//function to redirect
function redirect($url) {
        header('Location: ' . $url);
    return true;
}

?>