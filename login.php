<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: login.php
 * Version: 1.0
 */

$logged_in = false;

if (isset($_SESSION["user"])) {
    $logged_in = true;
} 

include 'inc/header.php';

//if user is logged in redirect to admin page...
if ($logged_in == true) {
    redirect('admin.php');
} else {
    ?>


<div id="menu">

</div>

<div id="head">Login</div><br />

<div id="content">

    <div id="breadcrumbs">
        <div id="breadcrumblinks">

            <div id="bold">Administration</div>
            &raquo; Login
        </div>
    </div>

    <div id="container"><br />

        <form action="admin.php" method="post">
            <fieldset><legend>Login</legend>
                <label for="name">Username:</label>
                <input type="text" name="name" /><br />
                <label for="pass">Password:</label>
                <input type="password" name="pass" /><br /><br />
                <input type="submit" value="Login" /><br />
            </fieldset>
        </form>
        <br />
    </div>

    <div id="reglinks"><a href="register.php">&raquo; Register</a><br /><a href="forgot.php">&raquo; Forgot Your Password?</a><br /><br /></div>

    <div id="foot">
        <div id="notice">&copy <a href="http://www.coccy-agency.com/">CoccyAgency</a></div>
    </div>
    <?php } ?>

</body>
</html>

<?php
ob_flush();
?>