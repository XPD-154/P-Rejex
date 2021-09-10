<?php

//start database connection

include ("../connection.php");

//start session connection

session_start();  

//feedback form validation 
if(isset($_POST['submit'])){

    //check if subject matter is inserted
	if(!$_POST['subject']){

		$_SESSION['error'] = "please input subject matter <br>";
		header('location: messageus.php');
		return;
	}
    //check if message is inserted
	if(!$_POST['message']){

		$_SESSION['error'] = "please input a message <br>";
		header('location: messageus.php');
		return;

	}else{

        //insert the value into PRadminmessage table
		$query = "INSERT INTO PRadminmessage (subject, message, useruniqueId) VALUES (:subject, :message, :useruniqueId)";
		$sql = $connection->prepare($query);
		$sql->execute(array(':subject'=>$_POST['subject'],
							':message'=>$_POST['message'],
							':useruniqueId'=>$_SESSION['CLuniqueID']));
		
        //alert for sucessfully added messge
		$_SESSION['success'] = "Message sent sucessfully !!!";
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
<body class="bg-gradient-info"> <!--color for the entire background-->

	<!--breadcrumb nav bar-->
	<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Client Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Message Us</li>
      </ol>
    </nav>
    <!--end of breadcrumb nav bar-->

    <!--section containing feedback form-->
	<section class="container" id="projectForm">
         <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Message Us</h1>
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
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Subject Matter" name="subject">
                    </div>
                 	<div class="form-group">
                        <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Message" name="message"></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-user btn-block">Send Message</button>

                </form>
        </div>
	</section>
	<!--end of section containing feedback form-->

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