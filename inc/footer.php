<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: footer.php
 * Version: 1.0
 */

//close database connection
mysql_close($con);

if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $logged_in = true;
} else {
    $logged_in = false;
}

?>

<div id="foot">
    <div id="notice">&copy <a href="http://www.coccy-agency.com/">CoccyAgency</a></div>
</div>
</div>

<br />

</body>
</html>

<?php
ob_flush();
?>

