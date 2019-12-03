<?php
//include ($_SERVER["DOCUMENT_ROOT"] . "/elearning/libraries/Database.php");
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
$server = 'localhost';
$user= 'root';
$pass = '';
$mydb = 'quiz';
$con = mysqli_connect($server, $user, $pass, $mydb);
 
// Check connection
if($con === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>