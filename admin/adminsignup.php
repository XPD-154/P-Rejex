<?php

//start database connection

include ("../connection.php");

//start session connection

session_start();


//admin sign up form validation
if(isset($_POST['submit'])){

    //check if an email is inserted
	if(!$_POST['admin_email']){

		$_SESSION['error'] = "please input an email address <br>";
		header('location: adminsignup.php');
		return;
	}
    //check if a password is inserted
	if(!$_POST['admin_password']){

		$_SESSION['error'] = "please input a password <br>";
		header('location: adminsignup.php');
		return;

	}
    if($_POST['admin_password']!==$_POST['admin_password2']){

        $_SESSION['error'] = "please check password <br>";
        header('location: adminsignup.php');
        return;

    }else{

        //insert the values into PRadmin table
		$query = "INSERT INTO PRadmin (admin_email, admin_password) VALUES (:admin_email, :admin_password)";
		$sql = $connection->prepare($query);
		$sql->execute(array(':admin_email'=>$_POST['admin_email'],
							':admin_password'=>$_POST['admin_password']));

        //set last inserted ID as a session variable
        $adminlastID = $connection->lastInsertId();
        $_SESSION['adminID'] = $adminlastID;

        $modifiedPassword = md5(md5($adminlastID.$_POST['admin_password']));

        $query="UPDATE PRadmin SET admin_password = :new_admin_password WHERE adminID = :adminlastID";
        $sql=$connection->prepare($query);
        $sql->execute(array(':new_admin_password'=>$modifiedPassword,
                            ':adminlastID'=>$adminlastID));

        //alert for sucessful added admin details
		$_SESSION['success'] = "Sucessfully signed up!!!";
		header('location: index.php');
		return;

	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P-Rejex Admin</title>
    <link rel="shortcut icon" type="image/jpg" href="../img/Untitled-5.png"> <!--link to favicon-->

    <!--link to boostrap css file-->
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css">

    <!-- Custom fonts for this template-->
    <link href="../dashboard-asserts/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../dashboard-asserts/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <style type="text/css">

    </style>
</head>

<body class="bg-gradient-primary"> <!--color for the entire background-->

    <!--section containing admin sign up form-->
	<section class="container" id="projectForm">
         <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">P-Rejex Admin Sign up</h1>
                </div>

                <!--div containing error alert-->
                <div id="error" class="text-center">
                	<?php
                		if(isset($_SESSION['error'])){

                			echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'.$_SESSION['error'].'!</strong> You should check in on some of those fields below.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                			unset($_SESSION['error']);
                		}
                	?>
                </div>
                <!--end of div containing error alert-->

                <form class="user" method="POST">

                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email address" name="admin_email">
                    </div>
                 	<div class="form-group">
                        <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Password" name="admin_password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="Confirm Password" name="admin_password2">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register</button>
                    <p class="mt-3">Already Register,<a href="adminlogin.php"> Login</a></p>
                </form>
        </div>
	</section>
	<!--end of section containing admin sign up form-->

	<script src="../js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
    <script src="../js/popper.min.js"></script> <!--link to popper js file-->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->

    <!-- Bootstrap core JavaScript-->
    <script src="../dashboard-asserts/vendor/jquery/jquery.min.js"></script>
    <script src="../dashboard-asserts/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../dashboard-asserts/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../dashboard-asserts/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../dashboard-asserts/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../dashboard-asserts/js/demo/chart-area-demo.js"></script>
    <script src="../dashboard-asserts/js/demo/chart-pie-demo.js"></script>
</body>
</html>
