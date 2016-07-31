<!doctype html>
<html lang=en>
<head>
<title>Register page</title>
<meta charset=utf-8><!--important prerequisite for escaping problem characters-->
<link rel="stylesheet" type="text/css" href="dentist.css">
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
		if (empty($_POST['name'])) {
		$errors[] = 'You forgot to enter your name.';
		} else {
		$name = mysqli_real_escape_string($dbcon, trim($_POST['name']));
		}

		

		// Check for age
		if (empty($_POST['age'])) {
		$errors[] = 'You forgot to enter your age.';
		} else {
		$age = mysqli_real_escape_string($dbcon, trim($_POST['age']));
		}

		// Check for sex
		if (empty($_POST['sex'])) {
		$errors[] = 'You forgot to enter your sex.';
		} else {
		$sex= mysqli_real_escape_string($dbcon, trim($_POST['sex']));
		}

		// Check for an address
		if (empty($_POST['address'])) {
		$errors[] = 'You forgot to enter your address.';
		} else {
		$address = mysqli_real_escape_string($dbcon, trim($_POST['address']));
		}


		// Check for phone no.
		if (empty($_POST['phone'])) {
		$errors[] = 'You forgot to enter your phone no.';
		} else {
		$phone = mysqli_real_escape_string($dbcon, trim($_POST['phone']));
		}

		

		// Check for an email address
		if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
		} else {
		$email= mysqli_real_escape_string($dbcon, trim($_POST['email']));
		}



		// Check for dentist type
		if (empty($_POST['dtype'])) {
		$errors[] = 'You forgot to select your dentist type';
		} else {
		$dtype= mysqli_real_escape_string($dbcon, trim($_POST['dtype']));
		}


		

		
		if (empty($errors)) { // If it runs
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO dentist (did, name, sex, age, phone, address, email, dtype, registration_date)
		VALUES (' ', '$name', '$sex', '$age', '$phone', '$address', '$email','$dtype' , NOW() )";
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

<h2 class="title">Insert Dentist Information</h2>

<form action="dentist.php" method="post" class="form">

<p><label class="label" for="name">Name:</label> 
<input  type="text" name="name" size="30" maxlength="30" 
value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"></p>

<p><label class="label" for="sex">Sex:</label>
<input  type="text" name="sex" size="30" maxlength="60" 
value="<?php if (isset($_POST['sex'])) echo $_POST['sex']; ?>" > </p>

<p><label class="label" for="age">Age:</label>
<input  type="number" name="age" size="30" maxlength="60" 
value="<?php if (isset($_POST['age'])) echo $_POST['age']; ?>" > </p>

<p><label class="label" for="phone">Phone No:</label>
<input  type="tel" pattern="[789][0-9]{9}" name="phone" size="30" maxlength="60" 
value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" > </p>

<p><label class="label" for="address">Address:</label>
<input  type="text" name="address" size="30" maxlength="60" 
value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" > </p>

<p><label class="label" for="email">Email:</label>
<input id="email" type="text" name="email" size="30" maxlength="60" 
value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" > </p>


<p><label class="label" for="dtype">Dentist Type:</label><select name="dtype" value="<?php if (isset($_POST['dtype'])) echo $_POST['dtype']; ?>">
  <option>Permanent</option>
  <option>Trainee</option>
  <option>Visiting</option>
  
</select></p>






<p><input id="submit" type="submit" name="submit" value="Register"></p>
</form>

</p>
</div>
</div>
</body>
</html>