<?php

session_start();
/**header('location:login.php');**/



$con = mysqli_connect('localhost', 'dllroot', 'Darklite53');
mysqli_select_db($con, "dllogbook");

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where username = '$name' && password = '$pass'";

$result = mysqli_query($con,$s);

$num = mysqli_num_rows($result);
$userProfile = mysqli_fetch_assoc($result);
$badge = $userProfile['badge'];
$_SESSION['badge'] = $badge;
$picture = $userProfile['image'];
$_SESSION['image'] = $picture;
$staff = $userProfile['staffposition'];
$_SESSION['staffposition'] = $staff;
$_SESSION['verified'] = $verify;
$verify = "Account Not Verified";


if($num == 1 && $staff != 0){
    $_SESSION['username'] = $name;
    header('location:home.php');
}else{
	//confirm("Account Not Active");
	$_SESSION['verified'] = $verify;
	header('location:index.php');
}

?>