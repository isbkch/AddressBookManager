<?php

/*
 * Title: AddressBookManager
 * Description: Simple multi-user contact manager
 * Author: Ilyas bakouch
 * Page: profile.php
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    redirect('admin.php');
}

$result = mysql_query("SELECT * FROM Contacts WHERE id = '$id'") or die(mysql_error());

//echo out contacts in database
while($row = mysql_fetch_array( $result )) {
    $owner = $row['Owner'];
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
?>

</div>

<div id="head">Profile</div><br />
<div id="content">

<div id="breadcrumbs">
<div id="breadcrumblinks">

    <?php
if ($owner == $user) {

    ?>

 <div id="bold">Profile</div>
   &raquo; <?php echo $name . ' ' . $surname; ?>

</div>
</div>

    <div id="contact">
   <ul>

<div id="contacthead">

<li><div id="h"><?php echo $name . ' ' . $surname ?></div></li>

</div>

<div id="userlist">
<div id="profile">
<br />

<li id="name"><?php echo $name . ' ' . $surname; ?> </li>

<li id="dob"><?php echo $dob; ?></li>
<li id="address"><?php echo $addressone . ', ' . $addresstwo . ', ' . $addressthree . ', ' . $postcode; ?><div class="right">&raquo; <a href="http://maps.google.com/?q=<?php echo $addressone . ', ' . $addresstwo . ', ' . $addressthree . ', ' . $postcode; ?>" >View on Google Maps</a></div></li>


<li id="phone"><?php echo $number; ?> </li>
<li id="email"><?php echo $email; ?><div class="right">&raquo; <a href="mailto:<?php echo $email; ?>">Email User</a></div></li>
<li id="web"><?php echo $homepage; ?><div class="right">&raquo; <a href="<?php echo $homepage; ?>">Visit Site</a></div></li>
<li id="info"><?php echo $info; ?></li>

<br />
<div id="reglinks" style="text-align: center;"><a href="admin.php">&laquo; Back to Contacts</a></div>
<br />
</div>
</div>

</div>

<?php

    include 'inc/footer.php';

} else {

?>

<div id="bold">Profile</div> 
&raquo; <?php echo $name . ' ' . $surname; ?>

 </div>
</div>

  <div id="contact">
 <ul>

<div id="contacthead">

<li><div id="h"><?php echo $name . ' ' . $surname; ?></div></li>';


  </div>

  <div id="userlist">
<div id="profile">
 <br />

<div id="#errorcontainer">
  <div id="error">
  You do not have permission to view this profile!
  </div>
 </div>
    
<br />
 </div>
 </div>

</div>

<?php

    include 'footer.php';
}

?>
