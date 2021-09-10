<?php

//start database connection

include ("../connection.php");

//start session connection

session_start();  

//creation of database table for projects if it doesnt exist

$query="CREATE TABLE IF NOT EXISTS prproject (
		  projectID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  project_name VARCHAR(50) NOT NULL,
		  project_type VARCHAR(50) NOT NULL,
		  project_location VARCHAR(50) NOT NULL,
		  project_est_bugt VARCHAR(50) NOT NULL,
		  CLuniqueId VARCHAR(50) NOT NULL,
          INDEX(project_name, CLuniqueId),
		  CONSTRAINT f1
		  FOREIGN KEY (CLuniqueId)
		  REFERENCES prclient (CLuniqueId)
		  ON DELETE CASCADE
		  ON UPDATE CASCADE)";
$sql= $connection->prepare($query);
$sql->execute();


//project form validation 
if(isset($_POST['submit'])){

    //check if project name is inserted
	if(!$_POST['project_name']){

		$_SESSION['error'] = "please input project name <br>";
		header('location: addprojectform.php');
		return;
	}
    //check if project type is inserted
	if(!$_POST['project_type']){

		$_SESSION['error'] = "please input project type <br>";
		header('location: addprojectform.php');
		return;
	}
    //check if project location is inserted
	if(!$_POST['project_location']){

		$_SESSION['error'] = "please input project location <br>";
		header('location: addprojectform.php');
		return;
	}
    //check if project estimated budget is inserted
	if(!$_POST['project_est_bugt']){

		$_SESSION['error'] = "please input project estimated budget";
		header('location: addprojectform.php');
		return;

	}else{

        //insert the value into PRprojects table
		$query = "INSERT INTO PRproject (project_name, project_type, project_location, project_est_bugt, CLuniqueId) VALUES (:project_name, :project_type, :project_location, :project_est_bugt, :CLuniqueId)";
		$sql = $connection->prepare($query);
		$sql->execute(array(':project_name'=>$_POST['project_name'],
							':project_type'=>$_POST['project_type'],
							':project_location'=>$_POST['project_location'],
							':project_est_bugt'=>$_POST['project_est_bugt'],
							':CLuniqueId'=>$_SESSION['CLuniqueID']));
		
        //create a session variable for project name based on the uniqueID
        $CLuniqueID = $_SESSION['CLuniqueID'];
        $query="SELECT * FROM PRproject WHERE CLuniqueId = '$CLuniqueID'";
        $sql=$connection->prepare($query);
        $sql->execute();
        while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                        
            $_SESSION['project_name']=$row['project_name'];
        }

        //determine user that enters the visitors log
        if(!$_SESSION['CLuniqueID']){

            $_SESSION['user']="Unregistered user";
            $_SESSION['message']="Attempted adding project";

        }else{

            $_SESSION['user']=$_SESSION['CLuniqueID'];
            $_SESSION['message']="Sucessfully added project";
        }

        //store users activity using this php file
        include 'user_activity_log_cl.php';

        //alert for sucessfully added project
		$_SESSION['success'] = "Sucessfully added project, Please add the Tender for this Project immediately!!!";
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
        <li class="breadcrumb-item active" aria-current="page">Create Project</li>
      </ol>
    </nav>
    <!--end of breadcrumb nav bar-->

    <!--section containing project form-->
	<section class="container" id="projectForm">
         <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create a Project</h1>
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
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Project Name" name="project_name">
                    </div>
                 	<div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Project Type" name="project_type">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Project Location" name="project_location">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Project Estimated Budget" name="project_est_bugt">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-user btn-block">Register Project</button>
                </form>
        </div>
	</section>
	<!--end of section containing project form-->

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