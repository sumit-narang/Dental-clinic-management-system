<!doctype html>
<html lang=en>
<head>
<title>View dental codes</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="cliniceditadmin.css">
<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
<div id="container">

<div id="content"><!-- Start of the content of the table of users page. -->
<h2 class="page">Clinic Information</h2>


<?php
// This script retrieves all the records from the users table.
require('connect-mysql.php'); // Connect to the database.
// Make the query: 

$q = "SELECT cname AS cname, location AS location,openhr AS openhr,closehr AS closehr,rooms AS rooms,cid  FROM clinic";

$result = @mysqli_query ($dbcon, $q); // Run the query.

if ($result) { // If it ran OK, display the records

					// Table header. 
				echo '<table class="table">
				<tr class="heading"><td class="col head"><b>Clinic Name</b></td><td class="col head"><b>Location</b></td><td class="col head"><b>Opening Hours</b></td><td class="col head"><b>Closing Hours</b></td>
				<td class="col head"><b>Total Rooms</b></td><td class="last"><b>Edit</b></td></tr>';
				// Fetch and print all the records: 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo '<tr class="heading2"><td class="col">' . $row['cname'] . '</td><td class="col">'.  $row['location'] . '</td>
				<td class="col">'.  $row['openhr'] . '</td><td class="col">'.  $row['closehr'] . '</td>
				<td class="col">'.  $row['rooms'] . '</td>
				<td class="last1"><a href="edit_clinicinfo.php?id=' . $row['cid'] . '">Edit</a></td>
                </tr>'; }
				echo '</table>'; // Close the table so that it is ready for displaying.
				mysqli_free_result ($result); // Free up the resources.
			   } 

else { // If it did not run OK.
		// Error message:
		echo '<p class="error">The current users could not be retrieved. We apologize 
		for any inconvenience.</p>';
		// Debug message:
		echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
     } // End of if ($result)

mysqli_close($dbcon); // Close the database connection.
?>

</div><!-- End of the user’s table page content -->

</div>
</body>
</html>