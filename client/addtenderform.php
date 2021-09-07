<?php
//start database connection

include ("../connection.php");

//start session connection

session_start();

// create table for tender if it doesnt exist

$query="CREATE TABLE IF NOT EXISTS prtender (
			tenderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
			project_name VARCHAR(50) NOT NULL,
			introduction TEXT NOT NULL,
			scope_of_work TEXT NOT NULL,
			eligibility_criteria TEXT NOT NULL,
  			list_of_work_for_tender TEXT NOT NULL,
			tender_evaluation_procedure_and_method TEXT NOT NULL,
  			submission_closing_date TEXT NOT NULL,
  			bid_opening_date TEXT NOT NULL,  
			any_other_information TEXT NOT NULL, 
			disclaimer TEXT NOT NULL,
			CLuniqueId VARCHAR(50) NOT NULL,
			CLtenderuniqueId VARCHAR(50) NOT NULL, 
			INDEX (CLuniqueId, project_name),
			CONSTRAINT f2  
			FOREIGN KEY (project_name)   
			REFERENCES prproject (project_name)
			ON DELETE CASCADE
			ON UPDATE CASCADE)";
$sql= $connection->prepare($query);
$sql->execute();

//alter PRtender by adding a foreign key to CLuniqueid
try {
    $query="ALTER TABLE PRtender add FOREIGN KEY(CLuniqueId) REFERENCES prclient(CLuniqueId)";
    $sql= $connection->prepare($query);
    $sql->execute();
} catch (PDOException $exception) {
    if($exception->errorInfo[2] == 1061) {
        // references already exists
    } else {
        // Another error occurred
    }
}

//tender form validation
if (isset($_POST["submit"])){

	 //assign all the post to variables
	 $introduction = $_POST['introduction'];
	 $scope_of_work = $_POST['scope_of_work'];
	 $eligibility_criteria = $_POST['eligibility_criteria'];
	 $list_of_work_for_tender = $_POST['list_of_work_for_tender'];
	 $tender_evaluation_procedure_and_method = $_POST['tender_evaluation_procedure_and_method'];
	 $submission_closing_date = $_POST['submission_closing_date'];
	 $bid_opening_date = $_POST['bid_opening_date'];
	 $any_other_information = $_POST['any_other_information'];
	 $disclaimer = $_POST['disclaimer'];

	 	//check if introduction is inserted
	  	if (!$introduction){

	  		$_SESSION['error'] ="an introduction is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if scope of work is inserted
	  	if (!$scope_of_work){

	  		$_SESSION['error'] ="Scope of Work is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if eligibility criteria is inserted
	  	if (!$eligibility_criteria){

	  		$_SESSION['error'] ="an Eligibility Criteria is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if list of work for tender is inserted
	  	if (!$list_of_work_for_tender){

	  		$_SESSION['error'] ="List of Work for Tender is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if tender evaluation procedure and method is inserted
	  	if (!$tender_evaluation_procedure_and_method){

	  		$_SESSION['error'] ="Tender Evaluation Procedure and Method is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if submission closing date is inserted
	  	if (!$submission_closing_date){

	  		$_SESSION['error'] ="Submission Closing Date is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if bid opening date is inserted
	  	if (!$bid_opening_date){

	  		$_SESSION['error'] ="Bid Opening Date is required <br>";
	  		header('location: addtenderform.php');
			return;
	  	}
	  	//check if any other information is inserted
	  	if (!$any_other_information){

	  		 $_SESSION['error'] ="Any Other Information is required <br>";
	  		 header('location: addtenderform.php');
			 return;
	  	}
	  	//check if disclaimer is inserted
	  	if (!$disclaimer){

	  		$_SESSION['error'] ="Disclaimer is required <br>";
	  		header('location: addtenderform.php');
			return;

	  	} else {

	  		 //insert values into table
	  		 $query= "INSERT INTO PRtender (project_name, introduction, scope_of_work, eligibility_criteria, list_of_work_for_tender, tender_evaluation_procedure_and_method, submission_closing_date, bid_opening_date, any_other_information, disclaimer, CLuniqueId) VALUES (:project_name, :introduction, :scope_of_work, :eligibility_criteria, :list_of_work_for_tender, :tender_evaluation_procedure_and_method, :submission_closing_date, :bid_opening_date, :any_other_information, :disclaimer, :CLuniqueId)";
	  		 $sql = $connection->prepare($query);
			 $sql->execute(array(':project_name'=>$_SESSION['project_name'],
								':introduction'=>$introduction,
								':scope_of_work'=>$scope_of_work,
								':eligibility_criteria'=>$eligibility_criteria,
								':list_of_work_for_tender'=>$list_of_work_for_tender,
								':tender_evaluation_procedure_and_method'=>$tender_evaluation_procedure_and_method,
								':submission_closing_date'=>$submission_closing_date,
								':bid_opening_date'=>$bid_opening_date,
								':any_other_information'=>$any_other_information,
								':disclaimer'=>$disclaimer,
								':CLuniqueId'=>$_SESSION['CLuniqueID']));

			 //retain the last inserted ID of tender
			 $lasttenderID = $connection->lastInsertId();

			 //use last the last inserted ID to update table and add uniqueID
			 $uniquetenderID="CLT"."00".$lasttenderID;
			 $query="UPDATE PRtender SET CLtenderuniqueId = :uniquetenderID WHERE tenderID = '$lasttenderID' LIMIT 1";
			 $sql = $connection->prepare($query);
			 $sql->execute(array(':uniquetenderID'=>$uniquetenderID));

			 //determine user that enters the visitors log
	         if(!$_SESSION['CLuniqueID']){

	            $_SESSION['user']="Visitor";
	            $_SESSION['message']="Attempted adding project";

	         }else{

	            $_SESSION['user']=$_SESSION['CLuniqueID'];
	            $_SESSION['message']="Sucessfully added tender";
	         }

	         //store users activity using this php file
	         include 'user_activity_log_cl.php';

			 $_SESSION['success'] = "Sucessfully added Tender";
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
			        <li class="breadcrumb-item active" aria-current="page">Create Tender</li>
			      </ol>
			    </nav>
			    <!--end of breadcrumb nav bar-->

			    <!--section containing project form-->
				<section class="container" id="tenderForm">
	                 <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create a Tender</h1>
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
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Introduction" name="introduction"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Scope of Work" name="scope_of_work"></textarea>
                                </div>
                             	<div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Eligibility Criteria" name="eligibility_criteria"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="List of Work for Tender" name="list_of_work_for_tender"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Tender Evaluation Procedure and Method" name="tender_evaluation_procedure_and_method"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Submission Closing Date" name="submission_closing_date"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Bid Opening Date" name="bid_opening_date"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Any Other Information" name="any_other_information"></textarea>
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Disclaimer" name="disclaimer"></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-info btn-user btn-block">Register Tender</button>
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