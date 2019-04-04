<?php
// db credentials 
$servername = 'mysql.metropolia.fi';
$username = 'mattii';
$password = 'mummola';
$dbname = 'mattii';
$port = '3306';
//attempt to connect to dp
$link = mysqli_connect($servername, $username, $password, $dbname, $port);

 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>