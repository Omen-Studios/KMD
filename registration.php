<?php

session_start();
header('location:index.php');

$con = mysqli_connect('localhost', 'dllroot', 'Darklite53');
mysqli_select_db($con, "dllogbook");

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where username = '$name'";

$result = mysqli_query($con,$s);

$num = mysqli_num_rows($result);

if($num == 1){
    echo"User Already Exists!";
}else{
    $reg = "insert into users(username,password,staffposition) values ('$name','$pass','0')";
    mysqli_query($con, $reg);
    echo"User Registered Successfully";
}

?>