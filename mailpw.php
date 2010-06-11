<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: mailpw.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'connection.php';

function genRandomString() {

    $length = 8;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = "";

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}

$email = $_POST['email'];

//check if user exists already
$sql = "SELECT * FROM Users WHERE Email='$email';";
$result = mysql_query($sql,$con);
$num_rows = mysql_num_rows($result);

while($row = mysql_fetch_array( $result )) {

//email details
    $to  = $row['Email'];
    $from = '-f' . 'noreply@mysite.com';
    $subject = 'Password Reminder';

    $message = 'Your new password is: ';
    $newgenpass = genRandomString();
    $message .= $newgenpass;

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    mail($to, $subject, $message, $headers, $from);

    $newpass = md5($newgenpass);

    $sql = "UPDATE Users SET Password = '$newpass' WHERE Email = '$to';";
    mysql_query($sql,$con);

}

redirect('login.php');

include 'inc/footer.php';

?>
