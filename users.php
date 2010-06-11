<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: users.php
 * Version: 1.0
 */

include 'inc/header.php';
include 'connection.php';

//Welcome note
echo '<div id="menu">';
if ($logged_in == true) {
    echo 'Welcome, ' . $user . '! <a href="admin.php">Contacts</a> | <a href="logout.php">Log Out</a>';
} else {
    echo 'Welcome, Guest! <a href="login.php">Log In</a>';
}

//how many items from each feed
$sql = "SELECT * FROM Users WHERE Username='$user'";
$result = mysql_query($sql,$con);

$result = mysql_fetch_assoc($result);
$result = $result['Level'];

if ($result == 1) {
    ?>

</div>

<div id="head">Users</div><br />
<div id="content">

    <div id="breadcrumbs">
        <div id="breadcrumblinks">

            <div id="bold">Users</div>

        </div>
    </div>

    <div id="feed">
        <ul>

            <div id="contacthead">

                <li><div id="h">Users</div></li>


            </div>

            <div id="userlist">
                <div id="users">
                    <br />
                    <ul>

                            <?php

                            //how many items from each feed
                            $sql = "SELECT * FROM Users";
                            $result = mysql_query($sql,$con);

                            $num_rows = mysql_num_rows($result);
                            if ($num_rows < 2) {
                                echo '<div id="nousers" style="text-align: center;"><br />Sorry, No Users Exist!<br /><br /></div>';
                            } else {
                                while($row = mysql_fetch_assoc($result)) {
                                    $cuser = $row['Username'];
                                    $email = $row['Email'];
                                    if ($cuser != $user) {
                                        echo '<li>' . $cuser . ': <a href="mailto:' . $email . '">Email User</a> - <a href="remove.php?user=' . $cuser . '">Delete User</a></li>';
                                    }
                                }
                            }
                            ?>
                    </ul>
                    <br />
                </div>
            </div>

    </div>

    <?php

    } else {
        redirect('admin.php');
    }

    include 'inc/footer.php';
?>
