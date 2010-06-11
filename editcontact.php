<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: editcontact.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'conf.php';

//if no cookie is set, set one
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
} 

echo '<div id="content">';

//get variables from address bar
$id = $_POST['id'];
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$dob = $_POST['dob'];
$addressone = $_POST['addressone'];
$addresstwo = $_POST['addresstwo'];
$addressthree = $_POST['addressthree'];
$postcode = $_POST['postcode'];
$number = $_POST['number'];
$email = $_POST['email'];
$homepage = $_POST['homepage'];
$info = $_POST['info'];

//update database with new data
$sql = "UPDATE Contacts SET Owner = '$user', Name = '$fname', Surname = '$sname', Dob = '$dob', Addressone = '$addressone', Addresstwo = '$addresstwo', Addressthree = '$addressthree', Postcode = '$postcode', Number = '$number', Email = '$email', Homepage = '$homepage', Info = '$info' WHERE id = '$id';";
mysql_query($sql,$con);

//redirect to admin page
redirect('admin.php');

include 'inc/footer.php';

?>
