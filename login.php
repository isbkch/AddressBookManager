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

//Redirection vers la page d'administration si le user is logged in...
if ($logged_in == true) {
    redirect('admin.php');
} else {
    ?>


<div id="menu">

</div>

<div id="head"><?php echo TXT_LOGIN_TITRE; ?></div><br /> 

<div id="content">

    <div id="breadcrumbs">
        <div id="breadcrumblinks">

            <div id="bold"><?php echo TXT_LOGIN_MENU_ADMINISTRATION; ?></div>
            &raquo; <?php echo TXT_LOGIN_TITRE; ?>
        </div>
    </div>

    <div id="container"><br />

        <form action="admin.php" method="post">
            <fieldset id="login_fieldset">
            	<legend><?php echo TXT_LOGIN_TITRE; ?></legend>
                <label for="name"><?php echo TXT_LOGIN_USERNAME; ?>:</label>
                <input type="text" name="name" /><br />
                <label for="pass"><?php echo TXT_LOGIN_PASSWD; ?>:</label>
                <input type="password" name="pass" /><br /><br />
                <input type="submit" value="<?php echo TXT_LOGIN_TITRE; ?>" /><br />
            </fieldset>
        </form>
        <br />
    </div>

    <div id="reglinks"><a href="register.php">&raquo; <?php echo TXT_LOGIN_REGISTER; ?></a><br /><a href="forgot.php">&raquo; <?php echo TXT_LOGIN_FORGOT_PASSWD; ?></a><br /><br /></div>

    <div id="foot">
        <div id="notice">&copy <a href="http://www.coccy-agency.com/">CoccyAgency</a></div>
    </div>
    <?php } ?>

</body>
</html>

<?php
ob_flush();
?>