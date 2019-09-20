<?php
//Database Connection
$servername = "localhost";
$username = "dllroot";
$password = "Darklite53";
$db="dllogbook";
//Check Connection
$conn = new mysqli($servername, $username, $password, $db);
if(!$conn){
 die ("Error on the Connection" . $conn->connect_error);
}
?>