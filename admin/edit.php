<?php

//connection
include ("../connection.php");

//session start
session_start();

//check for client table
if(isset($_GET['CLuniqueId']) && isset($_POST['update'])) {

        $CLuniqueId=$_POST['CLuniqueId'];

        if($CLuniqueId!=""){

        	$query="UPDATE prclient SET CLemail=:CLemail, CLcompany_name=:CLcompany_name, CLphone_number=:CLphone_number WHERE CLuniqueId = :CLuniqueId";
			$sql=$connection->prepare($query);
			$sql->execute(array(':CLemail'=>$_POST['CLemail'],
								':CLcompany_name'=>$_POST['CLcompany_name'],
								':CLphone_number'=>$_POST['CLphone_number'],
								':CLuniqueId'=>$CLuniqueId));
			$_SESSION['success']="Record Updated";
			header('location: index.php');
			return;

        }else{

        	$_SESSION['error']="Update unsucessful";
            header('location: edit.php');
            return;
        }

}

//check for contractor table
if(isset($_GET['CNuniqueId']) && isset($_POST['update'])) {

        $CNuniqueId=$_POST['CNuniqueId'];

        if($CNuniqueId!=""){

        	$query="UPDATE prcontractor SET CNemail=:CNemail, CNcompany_name=:CNcompany_name, CNphone_number=:CNphone_number WHERE CNuniqueId = :CNuniqueId";
			$sql=$connection->prepare($query);
			$sql->execute(array(':CNemail'=>$_POST['CNemail'],
								':CNcompany_name'=>$_POST['CNcompany_name'],
								':CNphone_number'=>$_POST['CNphone_number'],
								':CNuniqueId'=>$CNuniqueId));
			$_SESSION['success']="Record Updated";
			header('location: index.php');
			return;

        }else{

        	$_SESSION['error']="Update unsucessful";
            header('location: edit.php');
            return;
        }

}

//check for project table
if(isset($_GET['projectID']) && isset($_POST['update'])) {

        $projectID=$_POST['projectID'];

        if($projectID!=""){

        	$query="UPDATE prproject SET project_name=:project_name, project_type=:project_type, project_est_bugt=:project_est_bugt, project_location=:project_location WHERE projectID = :projectID";
			$sql=$connection->prepare($query);
			$sql->execute(array(':project_name'=>$_POST['project_name'],
								':project_type'=>$_POST['project_type'],
								':project_location'=>$_POST['project_location'],
								':project_est_bugt'=>$_POST['project_est_bugt'],
								':projectID'=>$projectID));
			$_SESSION['success']="Record Updated";
			header('location: index.php');
			return;

        }else{

        	$_SESSION['error']="Update unsucessful";
            header('location: edit.php');
            return;
        }

}

//check for tender table
if(isset($_GET['tenderID']) && isset($_POST['update'])) {

        $tenderID=$_POST['tenderID'];

        if($tenderID!=""){

        	$query="UPDATE prtender SET project_name=:project_name, introduction=:introduction, scope_of_work=:scope_of_work, eligibility_criteria=:eligibility_criteria, list_of_work_for_tender=:list_of_work_for_tender, tender_evaluation_procedure_and_method=:tender_evaluation_procedure_and_method, submission_closing_date=:submission_closing_date, bid_opening_date=:bid_opening_date, any_other_information=:any_other_information, disclaimer=:disclaimer WHERE tenderID = :tenderID";
			$sql=$connection->prepare($query);
			$sql->execute(array(':project_name'=>$_POST['project_name'],
								':introduction'=>$_POST['introduction'],
								':scope_of_work'=>$_POST['scope_of_work'],
								':eligibility_criteria'=>$_POST['eligibility_criteria'],
								':list_of_work_for_tender'=>$_POST['list_of_work_for_tender'],
								':tender_evaluation_procedure_and_method'=>$_POST['tender_evaluation_procedure_and_method'],
								':submission_closing_date'=>$_POST['submission_closing_date'],
								':bid_opening_date'=>$_POST['bid_opening_date'],
								':any_other_information'=>$_POST['any_other_information'],
								':disclaimer'=>$_POST['disclaimer'],
								':tenderID'=>$tenderID));
			$_SESSION['success']="Record Updated";
			header('location: index.php');
			return;

        }else{

        	$_SESSION['error']="Update unsucessful";
            header('location: edit.php');
            return;
        }

}

//check for and reply from admin message table
if(isset($_GET['messageID']) && isset($_POST['update'])){

	$useruniqueId=$_POST['useruniqueId'];

    if($useruniqueId!=""){
		//insert values into PRmessage table
		$query = "INSERT INTO PRmessage (useruniqueOutId, subjectOut, messageOut) VALUES (:useruniqueOutId, :subjectOut, :messageOut)";
		$sql = $connection->prepare($query);
		$sql->execute(array(
				':useruniqueOutId'=>$_POST['useruniqueId'],
				':subjectOut'=>$_POST['subjectOut'],
				':messageOut'=>$_POST['messageOut']));

		$_SESSION['success']="Message Sent";
		header('location: index.php');
		return;

    }else{

    	$_SESSION['error']="Message sent unsucessfully<br>";
        header('location: edit.php');
        return;
    }
}

//link to file containing header
include ("header_ad.php");
?>
<body class="bg-gradient-primary"> <!--color for the entire background-->

	<!--breadcrumb nav bar-->
	<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Admin Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </nav>
    <!--end of breadcrumb nav bar-->

    <!--section containing project form-->
	<section class="container" id="projectForm">
         <div class="p-5">

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
                	<?php

                		//check for client
	                	if(isset($_GET['CLuniqueId'])) {

	                		$query="SELECT * FROM prclient WHERE CLuniqueId = :CLuniqueId";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':CLuniqueId'=>$_GET['CLuniqueId']));
                            $row=$sql->fetch(PDO::FETCH_ASSOC);

		                	echo '<div class="text-center">';
			                echo '<h1 class="h4 text-gray-900 mb-4">Update Client Information</h1>';
			                echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="clientName">Company Name</label>';
		                    echo '<input type="text" id="clientName" class="form-control form-control-user" name="CLcompany_name" value="'.$row['CLcompany_name'].'">';
		                    echo '</div>';
		                 	echo '<div class="form-group">';
		                 	echo '<label for="clientPhone">Company Contact Line</label>';
		                    echo '<input type="text" id="clientPhone" class="form-control form-control-user" name="CLphone_number" value="'.$row['CLphone_number'].'">';
		                    echo '</div>';
		                    echo '<div class="form-group">';
		                    echo '<label for="clientEmail">Company Email</label>';
		                    echo '<input type="text" id="clientEmail" class="form-control form-control-user" name="CLemail" value="'.$row['CLemail'].'">';
		                    echo '</div>';

		                    echo '<input type="hidden" name="CLuniqueId" value="'.$row['CLuniqueId'].'">';

		                    echo '<button type="submit" name="update" class="btn btn-primary btn-user btn-block">Update</button>';
		                }

		                //check for contractor
		                if(isset($_GET['CNuniqueId'])) {

	                		$query="SELECT * FROM prcontractor WHERE CNuniqueId = :CNuniqueId";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':CNuniqueId'=>$_GET['CNuniqueId']));
                            $row=$sql->fetch(PDO::FETCH_ASSOC);

		                	echo '<div class="text-center">';
			                echo '<h1 class="h4 text-gray-900 mb-4">Update Contractor Information</h1>';
			                echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="contractorName">Company Name</label>';
		                    echo '<input type="text" id="contractorName" class="form-control form-control-user" name="CNcompany_name" value="'.$row['CNcompany_name'].'">';
		                    echo '</div>';
		                 	echo '<div class="form-group">';
		                 	echo '<label for="contractorPhone">Company Contact Line</label>';
		                    echo '<input type="text" id="contractorPhone" class="form-control form-control-user" name="CNphone_number" value="'.$row['CNphone_number'].'">';
		                    echo '</div>';
		                    echo '<div class="form-group">';
		                    echo '<label for="contractorEmail">Company Email</label>';
		                    echo '<input type="text" id="contractorEmail" class="form-control form-control-user" name="CNemail" value="'.$row['CNemail'].'">';
		                    echo '</div>';

		                    echo '<input type="hidden" name="CNuniqueId" value="'.$row['CNuniqueId'].'">';

		                    echo '<button type="submit" name="update" class="btn btn-primary btn-user btn-block">Update</button>';
		                }

		                //check for project
		                if(isset($_GET['projectID'])) {

	                		$query="SELECT * FROM prproject WHERE projectID = :projectID";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':projectID'=>$_GET['projectID']));
                            $row=$sql->fetch(PDO::FETCH_ASSOC);

		                	echo '<div class="text-center">';
			                echo '<h1 class="h4 text-gray-900 mb-4">Update Project Information</h1>';
			                echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="projectName">Project Name</label>';
		                    echo '<input type="text" id="projectName" class="form-control form-control-user" name="project_name" value="'.$row['project_name'].'">';
		                    echo '</div>';

		                 	echo '<div class="form-group">';
		                 	echo '<label for="projectType">Project Type</label>';
		                    echo '<input type="text" id="projectType" class="form-control form-control-user" name="project_type" value="'.$row['project_type'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="projectLocation">Project Location</label>';
		                    echo '<input type="text" id="projectLocation" class="form-control form-control-user" name="project_location" value="'.$row['project_location'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="projectEstBugt">Estimate Budget</label>';
		                    echo '<input type="text" id="projectEstBugt" class="form-control form-control-user" name="project_est_bugt" value="'.$row['project_est_bugt'].'">';
		                    echo '</div>';

		                    echo '<input type="hidden" name="projectID" value="'.$row['projectID'].'">';

		                    echo '<button type="submit" name="update" class="btn btn-primary btn-user btn-block">Update</button>';
		                }

		                //check for tender
		                if(isset($_GET['tenderID'])) {

	                		$query="SELECT * FROM prtender WHERE tenderID = :tenderID";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':tenderID'=>$_GET['tenderID']));
                            $row=$sql->fetch(PDO::FETCH_ASSOC);

		                	echo '<div class="text-center">';
			                echo '<h1 class="h4 text-gray-900 mb-4">Update Tender Information</h1>';
			                echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="projectName">Project Name</label>';
		                    echo '<input type="text" id="projectName" class="form-control form-control-user" name="project_name" value="'.$row['project_name'].'">';
		                    echo '</div>';

		                 	echo '<div class="form-group">';
		                 	echo '<label for="introduction">Introduction</label>';
		                    echo '<input type="text" id="introduction" class="form-control form-control-user" name="introduction" value="'.$row['introduction'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="scopeOfWork">Scope of Work</label>';
		                    echo '<input type="text" id="scopeOfWork" class="form-control form-control-user" name="scope_of_work" value="'.$row['scope_of_work'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="eligibilityCriteria">Eligibility Criteria</label>';
		                    echo '<input type="text" id="eligibilityCriteria" class="form-control form-control-user" name="eligibility_criteria" value="'.$row['eligibility_criteria'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="listOfWorkForTender">List of Work for Tender</label>';
		                    echo '<input type="text" id="listOfWorkForTender" class="form-control form-control-user" name="list_of_work_for_tender" value="'.$row['list_of_work_for_tender'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="tenderEvaluationProcedureAndMethod">Tender Evaluation Procedure and Method</label>';
		                    echo '<input type="text" id="tenderEvaluationProcedureAndMethod" class="form-control form-control-user" name="tender_evaluation_procedure_and_method" value="'.$row['tender_evaluation_procedure_and_method'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="submissionClosingDate">Submission Closing Date</label>';
		                    echo '<input type="text" id="submissionClosingDate" class="form-control form-control-user" name="submission_closing_date" value="'.$row['submission_closing_date'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="bidOpeningDate">Bid Opening Date</label>';
		                    echo '<input type="text" id="bidOpeningDate" class="form-control form-control-user" name="bid_opening_date" value="'.$row['bid_opening_date'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="anyOtherInformation">Any Other Information</label>';
		                    echo '<input type="text" id="anyOtherInformation" class="form-control form-control-user" name="any_other_information" value="'.$row['any_other_information'].'">';
		                    echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="disclaimer">Disclaimer</label>';
		                    echo '<input type="text" id="disclaimer" class="form-control form-control-user" name="disclaimer" value="'.$row['disclaimer'].'">';
		                    echo '</div>';

		                    echo '<input type="hidden" name="tenderID" value="'.$row['tenderID'].'">';

		                    echo '<button type="submit" name="update" class="btn btn-primary btn-user btn-block">Update</button>';
		                }

		                //check for admin inbox message reply
	                	if(isset($_GET['messageID'])) {

	                		$query = "UPDATE pradminmessage SET status = :status WHERE messageID = :messageID LIMIT 1";
							$sql = $connection->prepare($query);
							$sql->execute(array(':status'=>'read',
												':messageID'=>$_GET['messageID']));

	                		$query="SELECT * FROM pradminmessage WHERE messageID = :messageID";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':messageID'=>$_GET['messageID']));
                            $row=$sql->fetch(PDO::FETCH_ASSOC);

		                	echo '<div class="text-center">';
			                echo '<h1 class="h4 text-gray-900 mb-4">Reply</h1>';
			                echo '</div>';

		                    echo '<div class="form-group">';
		                    echo '<label for="subjectOut">Subject</label>';
		                    echo '<input type="text" id="subjectOut" class="form-control form-control-user" name="subjectOut" value="RE: '.$row['subject'].'">';
		                    echo '</div>';
		                 	echo '<div class="form-group">';
		                 	echo '<label for="messageOut">Message</label>';
		                    echo '<textarea type="text" class="form-control form-control-user" id="messageOut" placeholder="Message" name="messageOut"></textarea>';
		                    echo '</div>';

		                    echo '<input type="hidden" name="useruniqueId" value="'.$row['useruniqueId'].'">';

		                    echo '<button type="submit" name="update" class="btn btn-primary btn-user btn-block">Send</button>';
		                }


                	?>
                </form>
        </div>
	</section>
	<!--end of section containing project form-->

    <!--link to file containing footer-->
    <?php include ("footer_ad.php"); ?>
