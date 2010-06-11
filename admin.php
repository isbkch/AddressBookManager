<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: admin.php
 * Version: 1.0
 */

ob_start();
session_start();

include 'connection.php';

$user = $_POST["name"];
$pass = $_POST["pass"];
$remember = $_POST["remember"];

//hash password
$pass = md5($pass);

//ask database for users that match the credentials given
$sql = "SELECT * FROM Users WHERE Username='$user' AND Password='$pass';";
$result = mysql_query($sql,$con);
$num_rows = mysql_num_rows($result);

//if no cookie is set, set one
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
} 

//function to redirect
function redirect($url) {
    header('Location: ' . $url);
    return true;
}

//if the user exists or the user is already logged in
if (($num_rows > 0) || isset($_SESSION["user"])) {
//set cookie for an hour
    $logged_in = true;

    $_SESSION['user'] = $user;

} else {
//redirect to the login page as credentials were incorrect
    redirect('login.php');
}

//instead of including the header

?>
<html>
    <head>
        <title>ContactManager</title>
        <link rel="stylesheet" href="skins/<?php echo $skin; ?>/style.css">
    </head>
    <body>
        <div id="menu">

            <?php

            //Welcome note
            if ($logged_in == true) {
            //content
                echo "Welcome, " . $user . "! <a href=\"index.php\">Contacts</a> | <a href=\"logout.php\">Log Out</a>";
            }

            ?>


        </div>

        <div id="head">Contacts</div><br />
        <div id="content">

            <?php
            //what page should we be at?
            $op = $_GET["op"];

            ?>
            <div id="breadcrumbs">
                <div id="breadcrumblinks">

                    <div id="bold">Contacts</div>

                    <?php

                    //generate breadcrumb
                    if ($op == 0) {
                        echo '&raquo; <a href="admin.php?op=0">My Contacts</a>';
                    } else if ($op == 1) {
                            echo '&raquo; <a href="admin.php?op=0">My Contacts</a> &raquo; <a href="admin.php?op=1">Add Contact</a>';
                        } else if ($op == 2) {
                                echo '&raquo; <a href="admin.php?op=0">My Contacts</a> &raquo; Delete Contact?';
                            } else if ($op == 3) {
                                    echo '&raquo; <a href="admin.php?op=3">About</a>';
                                } else if ($op == 4) {
                                        echo '&raquo; <a href="admin.php?op=0">My Contacts</a> &raquo; Contact Deleted!';
                                    } else if ($op == 5) {
                                            echo '&raquo; <a href="admin.php?op=0">My Contacts</a> &raquo; Edit Contact';
                                        } else if ($op == 8) {
                                                echo '&raquo; <a href="admin.php?op=0">My Contacts</a> &raquo; Change Password';
                                            }
                    ?>

                </div>
            </div>

            <?php

            //how many items from each feed
            $sql = "SELECT * FROM Users WHERE Username='$user'";
            $result = mysql_query($sql,$con);

            $result = mysql_fetch_assoc($result);
            $result = $result['Level'];

            if ($result == 1) {

            //admin menu
                ?>
            <div id="adminmenu">
                <a href="admin.php?op=0">My Contacts</a> &nbsp; &bull; &nbsp; <a href="users.php">User List</a> &nbsp; &bull; &nbsp; <a href="admin.php?op=8">Change Password</a> &nbsp; &bull; &nbsp; <a href="admin.php?op=3">About</a>
            </div>
            <br />

            <?php

            } else {

                ?>
            <div id="adminmenu">
                <a href="admin.php?op=0">My Contacts</a> &nbsp; &bull; &nbsp; <a href="admin.php?op=8">Change Password</a> &nbsp; &bull; &nbsp; <a href="admin.php?op=3">About</a>
            </div>
            <br />

            <?php

            }

            //if the installer still exists, ask to remove
            if (file_exists('install.php')) {
                ?>
            <div id="#errorcontainer">
                <div id="error">
                    Please remove the install.php and installdb.php file's from the root directory! With these file's still in place anyone can create an administrator account!
                </div>
                <br /></div>
            <?php
            }

            //show the page
            switch($op) {
            //My Feeds
                case 0:

                    echo '<div id="contactstable">';

                    //get all contacts
                    $result = mysql_query("SELECT * FROM Contacts WHERE Owner = '$user'") or die(mysql_error());

                    //start table
                    echo '<table id="contacttable" border="0">';
                    echo '<tr> <th>Name</th> <th>Email</th> <th>Edit</th> <th>Delete</th> </tr>';

                    //echo out contacts in database
                    while($row = mysql_fetch_array( $result )) {

                    // echo out the contents of each row into a table
                        echo '<tr id="item"><td id="link">';
                        echo '<a href="profile.php?id=' . $row['id'] . '">' . $row['Name'] . ' ' . $row['Surname'] . '</a>';
                        echo '</td><td id="link">';
                        echo '<a href="mailto:' . $row['Email'] . '">' . $row['Email'] . '</a>' ;
                        echo '</td><td id="icon">';
                        echo '<a href="admin.php?op=5&editid=' . $row['id'] .'"><img src="skins/' . $skin . '/images/edit.png" border="0" title="Edit ' . $row['Title'] . '" /></a>';
                        echo '</td><td id="icon">';
                        echo '<a href="admin.php?op=2&delid=' . $row['id'] .'"><img src="skins/' . $skin . '/images/delete.png" border="0" title="Delete ' . $row['Title'] . '" /></a>';
                        echo "</td></tr>";
                    }

                    //end table
                    echo "</table><br />";

                    //add new feed link
                    echo '<div id="btncontain"><div id="newcontact"><a href="admin.php?op=1">Add Contact</a></div></div>';

                    echo '<br /><br /></div>';

                    break;

                //Add Feeds
                case 1:

                //form to add a new feed
                    echo '<div id="container">';
                    echo '<form action="addcontact.php" method="post">';
                    echo '<fieldset><legend>Add Contact</legend>';
                    echo '<label for="fname">Name:</label>';
                    echo '<input type="text" name="fname" /><br />';
                    echo '<label for="sname">Surname:</label>';
                    echo '<input type="text" name="sname" /><br />';
                    echo '<label for="dob">DOB:</label>';
                    echo '<input type="text" name="dob" /><br />';
                    echo '<label for="addressone">Street:</label>';
                    echo '<input type="text" name="addressone" /><br />';
                    echo '<label for="addresstwo">Town:</label>';
                    echo '<input type="text" name="addresstwo" /><br />';
                    echo '<label for="addressthree">County:</label>';
                    echo '<input type="text" name="addressthree" /><br />';
                    echo '<label for="postcode">Post Code:</label>';
                    echo '<input type="text" name="postcode" /><br />';
                    echo '<label for="number">Tel:</label>';
                    echo '<input type="text" name="number" /><br />';
                    echo '<label for="email">Email:</label>';
                    echo '<input type="text" name="email" /><br />';
                    echo '<label for="homepage">Homepage:</label>';
                    echo '<input type="text" name="homepage" /><br />';
                    echo '<label for="info">Info:</label>';
                    echo '<input type="text" name="info" /><br />';
                    echo '<input type="submit" value="Add" />';
                    echo '</fieldset>';
                    echo '</form>';
                    echo '</div><br />';

                    break;

                //Remove Feeds
                case 2:

                    echo '<div id="deletefeed">';

                    $id = $_GET['delid'];

                    $result = mysql_query("SELECT * FROM Contacts WHERE id = '$id'") or die(mysql_error());

                    //echo out contacts in database
                    while($row = mysql_fetch_array( $result )) {

                        $name = $row['Name'];
                        $surname = $row['Surname'];

                        //check if we should delete feed
                        echo 'Are you sure you want to delete <b>' . $name . ' ' . $surname . '</b>?<br /><br />';
                        echo '<a href="admin.php?op=4&delid=' . $id . '">Yes</a> <a href="admin.php">No</a>';
                        echo '</div><br />';
                    }



                    break;

                //About
                case 3:

                //about box
                    echo '<div id="about">';
                    echo 'AddressBookManager <br />&copy <a href="http://www.coccy-agency.com/">Coccy</a><br /><br />';
                    echo '</div><br />';

                    break;

                //Remove feed
                case 4:

                    echo '<div id="feeddeleted">';

                    $id = $_GET['delid'];

                    //delete from database
                    $sql = "DELETE FROM Contacts WHERE id='$id';";
                    mysql_query($sql,$con);

                    echo 'Contact Deleted!';
                    echo '</div><br />';

                    //redirect to admin page
                    redirect('admin.php');

                    break;

                //edit feed
                case 5:

                    $id = $_GET['editid'];

                    $result = mysql_query("SELECT * FROM Contacts WHERE id = '$id'") or die(mysql_error());

                    //echo out contacts in database
                    while($row = mysql_fetch_array( $result )) {

                        $name = $row['Name'];
                        $surname = $row['Surname'];
                        $dob = $row['Dob'];
                        $addressone = $row['Addressone'];
                        $addresstwo = $row['Addresstwo'];
                        $addressthree = $row['Addressthree'];
                        $postcode = $row['Postcode'];
                        $number = $row['Number'];
                        $email = $row['Email'];
                        $homepage = $row['Homepage'];
                        $info = $row['Info'];
                    }

                    //form to edit feed details
                    echo '<div id="container">';
                    echo '<form action="editcontact.php" method="post">';
                    echo '<fieldset><legend>Edit Contact</legend>';

                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                    echo '<label for="fname">Name:</label>';
                    echo '<input type="text" name="fname" value="' . $name . '" /><br />';
                    echo '<label for="sname">Surname:</label>';
                    echo '<input type="text" name="sname" value="' . $surname . '" /><br />';
                    echo '<label for="dob">DOB:</label>';
                    echo '<input type="text" name="dob" value="' . $dob . '" /><br />';
                    echo '<label for="addressone">Street:</label>';
                    echo '<input type="text" name="addressone" value="' . $addressone . '" /><br />';
                    echo '<label for="addresstwo">Town:</label>';
                    echo '<input type="text" name="addresstwo" value="' . $addresstwo . '" /><br />';
                    echo '<label for="addressthree">County:</label>';
                    echo '<input type="text" name="addressthree" value="' . $addressthree . '" /><br />';
                    echo '<label for="postcode">Post Code:</label>';
                    echo '<input type="text" name="postcode" value="' . $postcode . '" /><br />';
                    echo '<label for="number">Tel:</label>';
                    echo '<input type="text" name="number" value="' . $number . '" /><br />';
                    echo '<label for="email">Email:</label>';
                    echo '<input type="text" name="email" value="' . $email . '" /><br />';
                    echo '<label for="homepage">Homepage:</label>';
                    echo '<input type="text" name="homepage" value="' . $homepage . '" /><br />';
                    echo '<label for="info">Info:</label>';
                    echo '<input type="text" name="info" value="' . $info . '" /><br />';
                    echo '<input type="submit" value="Update Contact" />';

                    echo '</fieldset>';
                    echo '</form>';
                    echo '<br />';
                    echo '</div>';

                    break;

                //change password
                case 8:

                    $error = $_GET['error'];

                    if ($error == 1) {
                        echo '<div id="error">New Passwords Don\'t Match!</div><br />';
                    } else if ($error == 2) {
                            echo '<div id="error">Old Password Incorrect!</div><br />';
                        } else if ($error == 3) {
                                echo '<div id="error">Password Cannot Be Blank!</div><br />';
                            }


                    //form to make changes to password
                    echo '<div id="container">';
                    echo '<form action="pass.php" method="post">';
                    echo '<fieldset><legend>Change Password</legend>';
                    echo '<input type="hidden" name="user" value="' . $user . '" />';
                    echo '<label for="oldpass">Old Password:</label>';
                    echo '<input type="password" name="oldpass" /><br />';
                    echo '<label for="newpass">New Password:</label>';
                    echo '<input type="password" name="newpass" /><br />';
                    echo '<label for="newpasstwo">Retype New Password:</label>';
                    echo '<input type="password" name="newpasstwo" /><br />';

                    echo '<br />';
                    echo '</fieldset>';
                    echo '<br /><input type="submit" value="Save Changes" />';
                    echo '</form>';
                    echo '<br />';

                    echo '</div>';

                    break;

                //any other option
                default:

                //the user has altered the url and the page doesnt exist, redirect to the main admin page
                    echo 'Sorry, this page does not exist! You will be re-directed back to the main administration page in 3 seconds.';
                    redirect('admin.php');
                    break;
            }

            include 'inc/footer.php';

?>