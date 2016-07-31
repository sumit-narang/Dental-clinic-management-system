<!doctype html>
<html lang=en>
<head>
<title>Edit a record</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">

</head>

<body>
<div id="container">

	
<div id="content"><!--Start of the edit page content-->
<h2>Edit a Record</h2>

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
        if (empty($_POST['code'])) {
		$errors[] = 'You forgot to enter the dental code.';
		} else {
		$code = mysqli_real_escape_string($dbcon, trim($_POST['code']));
		}


		// Look for the unit cost
		if (empty($_POST['unitcost'])) {
		$errors[] = 'You forgot to enter the unit cost.';
		} else {
		$unitcost = mysqli_real_escape_string($dbcon, trim($_POST['unitcost']));
		}


		// Look for the descriptions
		if (empty($_POST['description'])) {
		$errors[] = 'You forgot to enter the description.';
		} else {
		$description = mysqli_real_escape_string($dbcon, trim($_POST['description']));
		}


		if (empty($errors)) 
		{ // If everything is OK, make the update query 
		// Check that the email is not already in the users table
		$q = "UPDATE dentalcode SET code='$code', unitcost='$unitcost', description='$description' WHERE id=$id LIMIT 1";
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


$q = "SELECT * FROM dentalcode WHERE id=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) 
{   // Valid user ID, display the form.
	// Get the user's information
	$row = mysqli_fetch_array ($result, MYSQLI_NUM);
	// Create the form
	echo '<form action="editcode.php" method="post">
	<p><label class="label" for="code">Dental Code:</label>
	<input class="fl-left" id="fname" type="text" name="code" size="30" maxlength="30" 
	value="' . $row[1] . '"></p>
	<br><p><label class="label" for="unitcost">Unit Cost:</label>
	<input class="fl-left" type="text" name="unitcost" size="30" maxlength="40" 
	value="' . $row[2] . '"></p>
	<br><p><label class="label" for="description">Descriptions:</label>
	<input class="fl-left" type="text" name="description" size="30" maxlength="50" 
	value="' . $row[3] . '"></p>
	<br><p><input id="submit" type="submit" name="submit" value="Edit"></p>
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