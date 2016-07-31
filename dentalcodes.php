<!doctype html>
<html lang=en>
<head>
<title>Dental Codes</title>
<link rel="stylesheet" type="text/css" href="dentalcodes.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>



<?php
// This script performs an INSERT query that adds a record to the users table.
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

 $code = trim($_POST['code']);


 $unitcost = trim($_POST['unitcost']);


 $desc = trim($_POST['description']);

 require ('connect-mysql.php'); // Connect to the database. 

 // Make the query 
 
 $q = "INSERT INTO dentalcode (id,code,unitcost, description) VALUES ('','$code','$unitcost','$desc')"; 

 $result = @mysqli_query ($dbcon, $q); // Run the query. 

 if ($result) { // If it ran OK. 
header ("location: admin.php");
 

 exit(); 
//End of SUCCESSFUL SECTION
 }

 else {                             // If the form handler or database table contained errors 
                                   // Display any error message
	 echo '<h2 class="error">System Error</h2>
	 <p class="error">You could not be registered due to a system error. We apologize for any 
	 inconvenience.</p>';

      } // End of if clause ($result)

mysqli_close($dbcon); // Close the database connection.

exit();
 

} // End of the main Submit conditional.
?>


<h2 class="title">Insert Dental codes</h2> 
<!--display the form on the screen-->
<form action="dentalcodes.php" method="post" class="form">

<p><label class="label" for="code">Code</label>
<input  type="text" name="code" size="30" maxlength="30" 
value="<?php if (isset($_POST['code'])) echo $_POST['code']; ?>"></p>

<p><label class="label" for="unitcost">Unit Cost</label>
<input  type="text" name="unitcost" size="30" maxlength="40" 
value="<?php if (isset($_POST['unitcost'])) echo $_POST['unitcost']; ?>"></p>

<p><label class="label" for="description">Description</label>
<input  type="text" name="description" size="30" maxlength="60" 
value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>" > </p>



<p><input id="submit" type="submit" name="submit" value="Register"></p>
</form><!-- End of the page content. -->
</p>




</body>
</html>