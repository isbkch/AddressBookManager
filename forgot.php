<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: forgot.php
 * Version: 1.0
 */

include 'inc/header.php';
require_once 'connection.php';

//if there has been an error, get the error code
$errornumber = $_GET['error'];

?>

<div id="menu">

</div>

<div id="head">Register</div><br />
<div id="content">

    <div id="breadcrumbs">
        <div id="breadcrumblinks">

            <div id="bold">Register</div>
            &raquo; Forgot Your Password?
        </div>
    </div>

    <?php

    //select database
    @ mysql_select_db($database, $con);

    //if its not a database error, is it a human error?
    if ($errornumber == 1) {
        echo '<br /><div id="error">Passwords did not match!</div>';
    } else if ($errornumber == 2) {
            echo '<br /><div id="error">Username was blank!</div>';
        } else if ($errornumber == 3) {
                echo '<br /><div id="error">Password was blank!</div>';
            } else if ($errornumber == 4) {
                    echo '<br /><div id="error">Email was blank!</div>';
                } else if ($errornumber == 5) {
                        echo '<br /><div id="error">Username already exists!</div>';
                    }

    //if theres no database error
    if ($myerror == false) {
        ?>
    <br /><div id="container">
        <form action="mailpw.php" method="post">
            <fieldset><legend>Install</legend>
                <label for="email">E-Mail:</label>
                <input type="text" name="email" /><br />
                <input type="submit" value="Reset Password" />
            </fieldset>
        </form>
        <?php } ?>

    </div><br />


    <div id="foot">
        <div id="notice">&copy <a href="http://www.coccy-agency.com/">CoccyAgency</a></div>
    </div>

</div>
</body>
</html>

<?php
ob_flush();
?>