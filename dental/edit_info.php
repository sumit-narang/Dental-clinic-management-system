<?php
session_start(); #1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 0))
{
header("Location: login.php");
exit();
}
if (isset($_SESSION['user_id'])){
$_POST['id'] = ($_SESSION['user_id']);
}
?>
<!doctype html>
<html lang=en>
<head>
<title>Edit your account</title>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="includes.css">
<style type="text/css">
p { text-align:center; }
label {margin-bottom:5px; margin-top:5px; }
input.fl-left { float:left; margin-bottom:5px; margin-top:5px; padding-bottom:0; }
/*#submit { margin-left:-660px; margin-top:260px; margin-bottom:10px; }*/
#submit { position:absolute; top:595px; left:330px; }
.red { color:red; }
footer { position:absolute; top:600px; left:370px;;}
</style>
</head>
<body>
<div id="container">
<?php include("includes/header_members_account.php"); ?>
<?php include("includes/nav.php"); ?>
<?php include("includes/info-col.php"); ?>
<div id="content"><!--Start of the "edit your account" content-->
<h2>Edit Your Account</h2>
<h3 class="red">For your own security please remember to logout</h3>
<?php
// When the you're your-Account button is clicked the editing interface appears
// Look for a valid user id, either through GET or POST
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) {
$id = $_POST['id'];
} else { // No valid ID, kill the script
echo '<p class="error">This page has been accessed in error.</p>';
include ('includes/footer.php');
exit();
}
require ('mysqli_connect.php');
// Has the form been submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$errors = array();
// Trim the title #2
$tle = trim($_POST['title']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($tle));
// Get string lengths
$strLen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your title.';
}else{
$title = $stripped;
}
// Trim the first name
$name = trim($_POST['fname']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($name));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strLen < 1 ) {
$errors[] = 'You forgot to enter your first name.';
}else{
$fn = $stripped;
}
// Trim the last name
$lnme = trim($_POST['lname']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($lnme));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your last name.';
}else{
$ln = $stripped;
}
//Set the email variable to FALSE #3
$e = FALSE;
// Check that an email address has been entered
if (empty($_POST['email'])) {
$errors[] = 'You forgot to enter your email address.';
}
//remove spaces from beginning and end of the email address and validate it
if (filter_var((trim($_POST['email'])), FILTER_VALIDATE_EMAIL)) {
//A valid email address is then registered
$e = mysqli_real_escape_string($dbcon, (trim($_POST['email'])));
}else{$errors[] = 'Your email is not in the correct format.';
}
// Trim the first address
$add1 = trim($_POST['addr1']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($add1));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your address.';
}else{
$addr1 = $stripped;
}
// Trim the second address
$addr2 = trim($_POST['addr2']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($addr2));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strLen < 1 ) {
$ad2=NULL;
}else{
$addr2 = $stripped;
}
// Trim the city
$ct = trim($_POST['city']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($ct));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your city.';
}else{
$city = $stripped;
}
// Trim the county
$conty = trim($_POST['county']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($conty));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your county.';
}else{
$county = $stripped;
}
// Trim the post code
$pcod = trim($_POST['pcode']);
// Strip HTML and apply escaping
$stripped = mysqli_real_escape_string($dbcon, strip_tags($pcod));
// Get string lengths
$strlen = mb_strlen($stripped, 'utf8');
// Check stripped string
if( $strlen < 1 ) {
$errors[] = 'You forgot to enter your county.';
}else{
$pcode = $stripped;
}
// Has a phone number been entered? #4
if (empty($_POST['phone'])){
$ph=($_POST['phone']);
}
elseif (!empty($_POST['phone'])) {
//Remove spaces, hyphens, letters and brackets
$phone = preg_replace('/\D+/', '', ($_POST['phone']));
$ph=$phone;
}
if (empty($errors)) { // If everything's OK
// make the query
$q = "SELECT user_id FROM users WHERE lname='$ln' AND user_id != $id";
$result = @mysqli_query($dbcon, $q);
if (mysqli_num_rows($result) == 0) {
// Make the update query #5
$q = "UPDATE users SET title='$title', fname='$fn', lname='$ln', email='$e', 
addr1='$addr1', addr2='$addr2', city='$city', county='$county', pcode='$pcode', 
phone='$phone' WHERE user_id=$id LIMIT 1";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_affected_rows($dbcon) == 1) { // If the query was successful
// Echo a message if the edit was satisfactory
echo '<h3>Your Account has Been Updated.</h3>';
} else { // Echo a message if the query failed
echo '<p class="error">The user could not be edited due to a system error. 
We apologize for any inconvenience.</p>'; // Message
echo '<p>' . mysqli_error($dbcon) . '<br />Query: ' . $q . '</p>'; // Debugging message
}
}
} else { // Display the errors
echo '<p class="error">The following error(s) occurred:<br>';
foreach ($errors as $msg) { // Echo each error
echo " - $msg<br/>\n";
}
echo '</p><p>Please try again.</p>';
} // End of the if (empty($errors))section
} // End of the conditionals
// Select the member's information #6
$q = "SELECT title, fname, lname, email, addr1, addr2, city, county, pcode, phone 
FROM users WHERE user_id=$id";
$result = @mysqli_query ($dbcon, $q);
if (mysqli_num_rows($result) == 1) { // If the user id is valid, display the form
// Get the member's information
$row = mysqli_fetch_array ($result, MYSQLI_NUM);
// Create the form #7
echo '<form action="edit_your_account.php" method="post">
<p><label class="label" for="title">Title:</label>
<input class="fl-left" id="title" type="text" name="title" size="30" maxlength="30" 
value="' . $row[0] . '"></p>
<p><label class="label" for="fname">First Name:</label>
<input class="fl-left" id="fname" type="text" name="fname" size="30" maxlength="30" 
value="' . $row[1] . '"></p>
<p><label class="label" for="lname">Last Name:</label>
<input class="fl-left" id="lname" type="text" name="lname" size="30" maxlength="40" 
value="' . $row[2] . '"></p>
<p><label class="label" for="email">Email:</label>
<input class="fl-left" id="email" type="text" name="email" size="30" maxlength="50" 
value="' . $row[3] . '"></p>
<p><label class="label" for="addr1">Address:</label>
<input class="fl-left" id="addr1" type="text" name="addr1" size="30" maxlength="50" 
value="' . $row[4] . '"></p>
<p><label class="label" for="addr2">Address:</label>
<input class="fl-left" id="addr2"type="text" name="addr2" size="30" maxlength="50" 
value="' . $row[5] . '"></p>
<p><label class="label" for="city">City:</label>
<input class="fl-left" id="city" type="text" name="city" size="30" maxlength="30"
value="' . $row[6] . '"></p>
<p><label class="label" for="county">County:</label>
<input class="fl-left" id="county"type="text" name="county" size="30" maxlength="30" 
value="' . $row[7] . '"></p>
<p><label class="label" for="pcode">Post Code:</label>
<input class="fl-left" id="pcode"type="text" name="pcode" size="15" maxlength="15" 
value="' . $row[8] . '"></p>
<p><label class="label" for="phone">Phone:</label>
<input class="fl-left" id="phone" type="text" name="phone" size="15" maxlength="15" 
value="' . $row[9] . '"></p>
<br><br><p><input id="submit" type="submit" name="submit" value="Edit"></p><br>
<input type="hidden" name="id" value="' . $id . '">
</form>';
} else { // The user could not be validated
echo '<p class="error">This page has been accessed in error.</p>';
}
mysqli_close($dbcon);
include ('includes/footer.php');
?>
</div>
</div>
</body>
</html>