<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: logout.php
 * Version: 1.0
 */

include 'inc/header.php';

session_destroy();

//redirect to the home page
redirect('index.php');

?>

</body>
</html>

<?php
ob_flush();
?>
