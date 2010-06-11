<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: adduser.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'conf.php';

//get the variables passed
$new_username = $_POST["uname"];
$new_email = $_POST["email"];
$new_password = $_POST["pass"];
$new_passwordtwo = $_POST["passtwo"];

//check if user exists already
$sql = "SELECT * FROM Users WHERE Username='$new_username';";
$result = mysql_query($sql,$con);
$num_rows = mysql_num_rows($result);

//error check the variables
if ($new_password != $new_passwordtwo) {
    redirect('register.php?error=1');
} else if ($new_username == '') {
        redirect('register.php?error=2');
    } else if ($new_password == '') {
            redirect('register.php?error=3');
        } else if ($new_email == '') {
                redirect('register.php?error=4');
            } else if ($num_rows > 0) {
                    redirect('register.php?error=5');
                } else {

                    $new_password = md5($new_password);

                    $sql = "INSERT INTO Users (Username,Password,Email,Level) VALUES('$new_username','$new_password','$new_email','0');";
                    mysql_query($sql,$con);

                    $sql = "INSERT INTO Contacts (Owner,Name,Surname,Dob,Addressone,Addresstwo,Addressthree,Postcode,Number,Email,Homepage,Info) VALUES('$new_username','Google','UK','01/01/2010','Belgrave House','76 Buckingham Palace Road','London','SW1W 9TQ','+44 (0)20-7031-3000','info@google.co.uk','http://www.google.co.uk/','This is just an example contact!');";
                    mysql_query($sql,$con);

                    //redirect to login page
                    redirect('login.php');
                }

//close connection
mysql_close($con);

?>

</body>
</html>

<?php
ob_flush();
?>