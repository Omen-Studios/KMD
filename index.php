<?php
session_start();
include("include/conn.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//Username and Password sent from here
	$username = mysqli_real_escape_string($conn, $_POST['user']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$password = md5($password);
	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$query = mysqli_query($conn, $sql);
	$res = mysqli_num_rows($query);
	$result = mysqli_query($conn,$sql);

	
	$userProfile = mysqli_fetch_assoc($result);
	$staff = $userProfile['staffposition'];
	$_SESSION['staffposition'] = $staff;
	$picture = $userProfile['image'];
	$_SESSION['image'] = $picture;
	$loads = $userProfile['loadcount'];
	$_SESSION['loadcount'] = $loads;
	$quota = $userProfile['quota'];
	$_SESSION['quota'] = $quota;
	
	
	if($staff == 2){
		$position = "Driver";
	}elseif($staff == 3){
		$position = "Senior Driver";
	}elseif($staff == 4){
		$position = "Instructor";
	}elseif($staff == 5){
		$position = "Logistics Manager (EU)";
	}elseif($staff == 6){
		$position = "Logistics Manager (NA)";
	}elseif($staff == 7){
		$position = "Company Director";
	}else{
		$position = "Unset";
	}
	$_SESSION['role'] = $position;
	
	
	if($res == 1 && $staff >= 2){
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $username;
		$_SESSION['password'] = $password;
		header('location:home.php');
	}elseif($res == 0){
		echo('<script type="text/javascript">alert("You have entered an invalid User or Password")</script>');
		session_destroy();
	}elseif($res == 1 && $staff <= 0){
		echo('<script type="text/javascript">alert("Your account has not yet been verified.")</script>');
		session_destroy();
	}elseif($res == 1 && $staff <= 1){
		echo('<script type="text/javascript">alert("You are currently SUSPENDED. Please see Logistics Manager.")</script>');
		session_destroy();
	}else{
		echo('<script type="text/javascript">alert("An Unknown Error Has Occured: EC-W02: Permissions)</script>');
	}
}


if(isset($_SESSION['verified'])){
	echo '<script type="text/javascript">alert("Unfortunately, your account has not yet been verified by Management, please try again later.");</script>';
	session_destroy();
}
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>VTL - Internal Logbook - Login System</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form action="<?php $_SERVER['PHP_SELF'];?>" class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="user" aria-describedby="emailHelp" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                    </div>
                    <!--<div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>-->
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
				  <div class="text-center">
                    <h1 class="h6 text-gray-900 mb-4">New Driver? Register Here</h1>
                  </div>
					<form action="register.php" class="user">
				  <button class="btn btn-primary btn-user btn-block">
                      Register
                    </button>
					</form>
					<hr>
                  <div class="text-center">
                    Designed by Darklite Software
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
