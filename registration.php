<?php
include('include/conn.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//Username and Password sent from here
	$username = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password = md5($password);
	$sql = "INSERT INTO users(username,password) values ('$username', '$password', '0')";
	$result = mysqli_query($conn, $sql);
	echo "Created Succesfully";
}
?>
	
