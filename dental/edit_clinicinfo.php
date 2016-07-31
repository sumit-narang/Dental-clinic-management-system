<!doctype html>
<html lang=en>
<head>
<title>Edit a record</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="Clinic.css">

</head>

<body>
<div id="container">

	
<div id="content"><!--Start of the edit page content-->
<h2></h2>

<?php
		// After clicking the Edit link in the found_record.php page, the editing interface appears
		// The code looks for a valid user ID, either through GET or POST #1
		if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
		$id = $_GET['id'];
		} 
		elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission
		$id = $_POST['id'];
		} 
		else { // If no valid ID, stop the script
		echo '<p class="error">This page has been accessed in error</p>';
		exit();
		}

require ('connect-mysql.php');
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		$errors = array();


		// Look for the dental codes
        if (empty($_POST['cname'])) {
		$errors[] = 'You forgot to enter clinic name';
		} else {
		$cname = mysqli_real_escape_string($dbcon, trim($_POST['cname']));
		}


		


		// Look for the descriptions
		if (empty($_POST['location'])) {
		$errors[] = 'You forgot to enter the location.';
		} else {
		$location = mysqli_real_escape_string($dbcon, trim($_POST['location']));
		}


		// Look for the descriptions
		if (empty($_POST['openhr'])) {
		$errors[] = 'You forgot to enter the opening hours.';
		} else {
		$openhr = mysqli_real_escape_string($dbcon, trim($_POST['openhr']));
		}


       // Look for the descriptions
		if (empty($_POST['closehr'])) {
		$errors[] = 'You forgot to enter the closing hours.';
		} else {
		$closehr = mysqli_real_escape_string($dbcon, trim($_POST['closehr']));
		}


        // Look for the descriptions
		if (empty($_POST['rooms'])) {
		$errors[] = 'You forgot to enter the total no. of rooms.';
		} else {
		$rooms = mysqli_real_escape_string($dbcon, trim($_POST['rooms']));
		}


		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE clinic SET cname='$cname', location='$location',openhr='$openhr',closehr='$closehr',rooms='$rooms' WHERE cid=$id LIMIT 1";
		$result = @mysqli_query ($dbcon, $q);
		if (mysqli_affected_rows($dbcon) == 1) { // If it ran OK
		// Echo a message if the edit was satisfactory
		echo '<h3>The user has been edited.</h3>';
		} else { // Echo a message if the query failed
		echo '<p class="error">The user could not be edited due to a system error. 
		We apologize for any inconvenience.</p>'; // Error message.
		echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		
		exit();
		} else   { // Display the errors.
		echo '<p class="error">The following error(s) occurred:<br />';
        
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
		echo " - $msg<br>\n";
	    }
		echo '</p><p>Please try again.</p>';
		} // End of if (empty($errors))section
}        // End of the conditionals
         // Select the record 


$q = "SELECT cid,cname,location,openhr,closehr,rooms FROM clinic WHERE cid=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="edit_clinicinfo.php" method="post">
	<p><label class="label" for="cname">Clinic Name:</label>
	<input class="fl-left" id="name" type="text" name="cname" size="30" maxlength="30" 
	value="' . $row[1] . '"></p>
	
	<p><label class="label" for="location">Location:</label>
	<input class="fl-left" type="text" name="location" size="30" maxlength="50" 
	value="' . $row[2] . '"></p>
	<p><label class="label" for="openhr">Opening Hours:</label>
	<input class="fl-left" type="text" name="openhr" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>
	<p><label class="label" for="closehr">Closing Hours:</label>
	<input class="fl-left" type="text" name="closehr" size="30" maxlength="50" 
	value="' . $row[4] . '"></p>
	<p><label class="label" for="rooms">Total Rooms:</label>
	<input class="fl-left" type="text" name="rooms" size="30" maxlength="50" 
	value="' . $row[5] . '"></p>
	

	<p><input id="submit" type="submit" name="submit" value="Edit"></p>
	<br><input type="hidden" name="id" value="' . $id . '" /> 
	</form>';
} 
else { // The record could not be validated
	  echo '<p class="error">This page has been accessed in error</p>';
	 }
mysqli_close($dbcon);

?>
</div>
</div>
</body>
</html>