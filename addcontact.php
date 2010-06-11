<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: addcontact.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'conf.php';

echo '<div id="content">';

//if no cookie is set, set one
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}

//get variables from address bar
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

//insert new data into database
$sql = "INSERT INTO Contacts (Owner,Name,Surname,Dob,Addressone,Addresstwo,Addressthree,Postcode,Number,Email,Homepage,Info) VALUES('$user','$fname','$sname','$dob','$addressone','$addresstwo','$addressthree','$postcode','$number','$email','$homepage','$info');";
mysql_query($sql,$con);

//redirect to admin page
redirect('admin.php');

include 'inc/footer.php';

?>