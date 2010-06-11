<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: remove.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'connection.php';

//how many items from each feed
$sql = "SELECT * FROM Users WHERE Username='$user'";
$result = mysql_query($sql,$con);

$result = mysql_fetch_assoc($result);
$result = $result['Level'];

if ($result == 1) {

    $usertodelete = $_GET['user'];

    //delete contacts from database
    $sql = "DELETE FROM Contacts WHERE Owner='$usertodelete';";
    mysql_query($sql,$con);

    //delete user from database
    $sql = "DELETE FROM Users WHERE Username='$usertodelete';";
    mysql_query($sql,$con);



    redirect('users.php');
} else {
    redirect('admin.php');
}

include 'inc/footer.php';

?>
