<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: connection.php
 * Version: 1.0
 */

include 'conf/conf.php';

//execute an sql statement so we can find out if there are any problems with the connection..
$sql= 'DESC Users;';
@ mysql_query($sql,$con);

//...if there are problems
if (mysql_errno()) {

//table_name doesn't exist
    $ferror = true;
} else if (!mysql_errno()) {

    //table exist - continue as normal
    }

?>