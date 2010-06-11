<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: index.php
 * Version: 1.0
 */

include 'connection.php';
include 'inc/header.php';

//if we havn't had an database error
if ($ferror == false) {

//check if we're logged in any if any cookies are set
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        $logged_in = true;
    } else {
        $logged_in = false;
    }

    if ($logged_in) {
        redirect('admin.php');
    } else {
        redirect('login.php');
    }

    include 'inc/footer.php';

} else {

//if database error...
    ?>
<div id="menu">

</div>

<div id="head">Install</div><br />

<div id="content">

    <div id="breadcrumbs">
        <div id="breadcrumblinks">

            <div id="bold">Install</div>
        </div>
    </div>

    <div id="er"><br />You must run the <a href="install.php">Installer</a> First!<br /><br /></div>


    <div id="foot">
        <div id="notice">&copy <a href="http://www.coccy-agency.com/">CoccyAgency</a></div>
    </div>

    <?php

    }

    ob_flush();
?>
