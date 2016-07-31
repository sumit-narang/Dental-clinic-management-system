<!doctype html>
<html lang=en>
<head>
<title>Register page</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="clinic.css">
</head>
<body>
<div id="container">

<div id="content"><!-- Registration handler content starts here -->

<?php
// The link to the database is moved to the top of the PHP code.
require ('connect-mysql.php'); // Connect to the db.
// This query INSERTs a record in the users table.
// Has the form been submitted?

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		$errors = array(); // Initialize an error array.
		// Check for a first name:
		if (empty($_POST['cname'])) {
		$errors[] = 'You forgot to enter the clinic name.';
		} else {
		$cname = mysqli_real_escape_string($dbcon, trim($_POST['cname']));
		}

		

		// Check for age
		if (empty($_POST['location'])) {
		$errors[] = 'You forgot to enter the location.';
		} else {
		$location = mysqli_real_escape_string($dbcon, trim($_POST['location']));
		}

		// Check for sex
		if (empty($_POST['openhr'])) {
		$errors[] = 'You forgot to enter the opening hours';
		} else {
		$openhr= mysqli_real_escape_string($dbcon, trim($_POST['openhr']));
		}

		// Check for an address
		if (empty($_POST['closehr'])) {
		$errors[] = 'You forgot to enter the closing hours.';
		} else {
		$closehr = mysqli_real_escape_string($dbcon, trim($_POST['closehr']));
		}


		// Check for phone no.
		if (empty($_POST['rooms'])) {
		$errors[] = 'You forgot to enter total no. of rooms';
		} else {
		$rooms = mysqli_real_escape_string($dbcon, trim($_POST['rooms']));
		}

		
		if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO clinic (cname,location,openhr,closehr,rooms)
		VALUES ('$cname','$location','$openhr','$closehr','$rooms')";
		$result = @mysqli_query ($dbcon, $q); // Run the query.
		if ($result) { // If it runs
		header ("location: admin.php");
		exit();
		} else { // If it did not run
		// Message:
		echo '<h2 class="error">System Error</h2>
		<p class="error">You could not be registered due to a system error. We apologize 
		for any inconvenience.</p>';
		// Debugging message:
		echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
		} // End of if ($result)
		mysqli_close($dbcon); // Close the database connection.
		// Include the footer and quit the script:
		
		exit();
		} else { // Report the errors.
			echo '<h2 class="error">Error!</h2>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Extract the errors from the array and echo them
		echo " - $msg<br>\n";
		}
		echo '</p><h3 class="error">Please try again.</h3><p><br></p>';
		}// End of if (empty($errors))
} // End of the main Submit conditional.
?>

<h2 class="title">Insert Clinic Information</h2>

<form action="clinic.php" method="post" class="form">

<p><label class="label" for="cname">Clinic Name:</label> 
<input  type="text" name="cname" size="30" maxlength="30" 
value="<?php if (isset($_POST['cname'])) echo $_POST['cname']; ?>"></p>

<p><label class="label" for="location">Location:</label>
<input  type="text" name="location" size="30" maxlength="60" 
value="<?php if (isset($_POST['location'])) echo $_POST['location']; ?>" > </p>

<p><label class="label" for="openhr">Opening Hours:</label>
<input  type="text" name="openhr" size="30" maxlength="60" 
value="<?php if (isset($_POST['openhr'])) echo $_POST['openhr']; ?>" > </p>

<p><label class="label" for="closehr">Closing Hours:</label>
<input  type="text" name="closehr" size="30" maxlength="60" 
value="<?php if (isset($_POST['closehr'])) echo $_POST['closehr']; ?>" > </p>

<p><label class="label" for="rooms">No. Of Rooms:</label>
<input id="email" type="number" name="rooms" size="30" maxlength="60" 
value="<?php if (isset($_POST['rooms'])) echo $_POST['rooms']; ?>" > </p>

<p><input id="submit" type="submit" name="submit" value="Submit"></p>
</form>

</p>
</div>
</div>
</body>
</html>