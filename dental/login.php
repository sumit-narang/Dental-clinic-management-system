
<!doctype html>
<html lang=en>
<head>
<title>The Login page</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="login.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="top"><img src="download.png" width="40" height="40" class="logo">
		<p class="logotext">Dental Clinic</p></div>
<div id="container">

<div id="content"><!-- Start of the login page content. -->

<?php
		// This section processes submissions from the login form
		// Check if the form has been submitted:
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				//connect to database
				require ('connect-mysql.php'); 
				// Validate the email address
				if (!empty($_POST['email'])) {
				$e = mysqli_real_escape_string($dbcon, $_POST['email']);
				} else {
				$e = FALSE;
				echo '<p class="error">You forgot to enter your email address.</p>';
				}
				// Validate the password
				if (!empty($_POST['password'])) {
				$p = mysqli_real_escape_string($dbcon, $_POST['password']);
				} else {
				$p = FALSE;
				echo '<p class="error">You forgot to enter your password.</p>';
				}


				if ($e && $p)
				{           //if no problems 
							// Retrieve the user_id, first_name and user_level for that email/password combination
							$q = "SELECT userid, user_level FROM signup WHERE (email='$e' AND password='$p')";
							// Run the query and assign it to the variable $result
							$result = @mysqli_query ($dbcon, $q);
							// Count the number of rows that match the email/password combination

                             

							if (@mysqli_num_rows($result) == 1) 
							{       //if one database row (record) matches the input:-
									// Start the session, fetch the record and insert the three values in an array
                                    
                                    
									session_start(); 
									$_SESSION = mysqli_fetch_array ($result, MYSQLI_ASSOC);
									// Ensure that the user level is an integer.
									$_SESSION['user_level'] = (int) $_SESSION['user_level'];
									$_SESSION['userid'];
									// Use a ternary operation to set the URL 
									
									$url = ($_SESSION['user_level'] === 1) ? 'admin.php' : 'index1.html';
									header('Location: ' . $url); // Make the browser load either the members’ or the admin page
									exit(); // Cancel the rest of the script
									mysqli_free_result($result);
									mysqli_close($dbcon);
							} 

							else { // No match was made.
									echo '<p class="error">The e-mail address and password entered do not match our records 
									<br>Perhaps you need to register, just click the Register button on the header menu</p>';
							       }

				} 
				else { // If there was a problem.
				        echo '<p class="error">Please try again.</p>';
				       }
				mysqli_close($dbcon);
		} // End of SUBMIT conditional.
?>

<!-- Display the form fields--> 
<div id="loginfields">
<?php include ('loginpage.php'); ?>
</div><br>

</div>
</div>
</body>
</html>