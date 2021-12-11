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

//check for contractor table
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

                	?>
                </form>
        </div>
	</section>
	<!--end of section containing project form-->

    <!--link to file containing footer-->
    <?php include ("footer_ad.php"); ?>