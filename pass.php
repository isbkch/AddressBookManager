<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: pass.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'connection.php';

$user = $_POST['user'];
$oldpass = md5($_POST['oldpass']);
$newpass = md5($_POST['newpass']);
$newpasstwo = md5($_POST['newpasstwo']);

$sql = "SELECT * FROM Users WHERE Username='$user' AND Password='$oldpass';";
$result = mysql_query($sql,$con);
$num_rows = mysql_num_rows($result);

//error check the variables
if ($newpass != $newpasstwo) {
    redirect('admin.php?op=8&error=1');
} else if ($num_rows < 1) {
        redirect('admin.php?op=8&error=2');
    } else if ($newpass == '') {
            redirect('admin.php?op=8&error=3');
        } else {

        //update
            $sql = "UPDATE Users SET Password = '$newpass' WHERE Username = '$user' AND Password = '$oldpass';";
            mysql_query($sql,$con);

            redirect('admin.php');
        }

include 'inc/footer.php';

?>
