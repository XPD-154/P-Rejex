<?php

 //start database connection

 include ("../connection.php");

 //start session connection

 session_start();

 //client form validation and submission

 if(isset($_POST['submit'])){

 		//check if company name is inserted
	    if (!$_POST['CLcompanyName']){

	  		$_SESSION['error'] = "Input your company name";
	  		header('location: clientsignup.php');
			return;
	  	}
	  	//check if the contact line for the company is inserted
  		if (!$_POST['CLphone']){

	  		$_SESSION['error'] = "Input a contact line for the company";
	  		header('location: clientsignup.php');
			return;

	  	}
	  	//check if the an email is inserted
	  	if (!$_POST['CLnewEmail']){

	  		$_SESSION['error'] = "Input an email for the company";
	  		header('location: clientsignup.php');
			return;
	  	}
	  	//check if a password is inserted
	  	if (!$_POST['CLnewPassword']){

	  		$_SESSION['error'] = "Input password";
	  		header('location: clientsignup.php');
			return;

	  	}
	  	//check if password is the same with the one above
	  	if ($_POST['CLnewPassword2']!=$_POST['CLnewPassword']){

	  		$_SESSION['error'] = "Check inputted password";
	  		header('location: clientsignup.php');
			return;

	  	}else{

	  			//check if email address already exist in the database
	  			$query = "SELECT * FROM PRclient WHERE CLemail = :email";
				$sql = $connection->prepare($query);
				$sql->execute(array(':email'=>$_POST['CLnewEmail']));
				$count = $sql->rowCount();

				if($count > 0){

					$_SESSION['error'] = "email address already been taken";
			  		header('location: clientsignup.php');
					return;

				}else{

					//insert values into PRclient table
					$query = "INSERT INTO PRclient (CLemail, CLpassword, CLcompany_name, CLphone_number) VALUES (:email, :password, :companyname, :phone)";
					$sql = $connection->prepare($query);
					$sql->execute(array(
							':email'=>$_POST['CLnewEmail'],
							':password'=>$_POST['CLnewPassword'],
							':companyname'=>$_POST['CLcompanyName'],
							':phone'=>$_POST['CLphone']));

					//retain the last ID of the client inserted
					$lastID = $connection->lastInsertId();

					if(!$sql){

						//verify if the insertion of values was successful
						$_SESSION['error'] = "Could not sign you up-please try again later";
				  		header('location: clientsignup.php');
						return;

					} else {

						//modify the password and update table based on lastID
						$modifiedPassword = md5(md5($lastID).$_POST['CLnewPassword']);
						$query = "UPDATE PRclient SET CLpassword = :password WHERE clientID = '$lastID' LIMIT 1";
						$sql = $connection->prepare($query);
						$sql->execute(array(':password'=>$modifiedPassword));

						//create a uniqueID and update table based on lastID
						$uniqueID="CL"."00".$lastID;
						$query="UPDATE PRclient SET CLuniqueId = :uniqueID WHERE clientID = '$lastID' LIMIT 1";
						$sql = $connection->prepare($query);
						$sql->execute(array(':uniqueID'=>$uniqueID));

						//create a session variable for uniqueID 
						$query="SELECT * FROM prclient WHERE clientID = '$lastID' LIMIT 1";
						$sql=$connection->prepare($query);
						$sql->execute();
						while($row=$sql->fetch(PDO::FETCH_ASSOC)){

							$_SESSION['CLuniqueID'] = $row['CLuniqueId'];
						}

						//if the client indicates a williness to be remembered, create session variable from the lastID
						if($_POST['clientSignUpCheck']=='1'){

							$_SESSION['clientID']=$lastID;
						}

						$_SESSION['success']="Successfully signed in";
						header('location: index.php');
						return;
					}
				}
	  	}
	  }

?>
<!DOCTYPE html>
<html lang="en"> <!--lang stands for language attribute, en stands for english -->
<head>
	<meta charset="utf-8"> <!--conversion of typed charater into machine readable code-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--viewport is the user's visisble area of a web page, the meta tag allows modification to the viewport, width=device-width sets the width of the page to follow screen width of the device, initial-sacle=1 set the initial zoom level on a page, shrink-to-fit=no prevent contents that are initially bigger than the viewport to be shrink too small-->
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!--x-ua compatible is a document mode meta tag that allows choice of what version of Internet Explorer the page should be rendered as-->
    
    <link rel="shortcut icon" type="image/jpg" href="../img/Untitled-5.png"> <!--link to favicon-->        
    <link rel="stylesheet" href="../bootstrap-5.0.2-dist/css/bootstrap.min.css"> <!--link to boostrap css file-->
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css"> <!--link to font awesome css file-->
    <link rel="stylesheet" href="../bootstrap-social/bootstrap-social.css"> <!--link to boostrap social css file-->
    <link rel="stylesheet" href="../css/style.css"><!--link to css stylesheet for project-->
    <title>P-Rejex</title>
    
</head>
<body>

	<div class="container-fluid" id="clientSignUpSection">

		<header class="row" id="clientSignUpSubSection1">
			
			<!--navigation breadcrumb-->
			<div id="clientSignUpSubSection2">
				<nav style="--bs-breadcrumb-divider: '>';" id="clientSignUpBreadCrum" aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
				    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
				  </ol>
				</nav>
			</div>
			<!--end of navigation breadcrumb-->

			<div class="col-12 text-center" id="clientSignUpSubSection3">
				<h1>Welcome to P-Rejex</h1>
				<p><strong>Efficiently carry out prequalification on behalf of intending Clients</strong></p>
			</div>
		</header>

		<main class="row">
			<div class="col-2 col-sm-4" id="clientSignUpSubSection4"></div>
			<div class="col-8 col-sm-4" id="clientSignUpSubSection5">

				<div class="text-center mb-5">
					<h4>Register with</h4>
				</div>
				
				<!--section containing error alert-->
				<div id="error">
					<?php 

					if(isset($_SESSION['error'])){

						echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert">
								  <strong>'.$_SESSION['error'].'!</strong> You should check in on some of those fields below.
								  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							   </div>');
						unset($_SESSION['error']);
					}
					
					?>			
				</div>
				<!--end of section containing error alert-->
				
				<form method="POST">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="CLcompanyName" id="floatingInput" placeholder="company name">
						<label for="floatingInput">Company Name</label>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" name="CLphone" id="floatingInput" placeholder="phone number">
						<label for="floatingInput">Contact Line</label>
					</div>
					<div class="form-floating mb-3">
						<input type="email" class="form-control" name="CLnewEmail" id="floatingInput" placeholder="email">
						<label for="floatingInput">Email</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" name="CLnewPassword" id="floatingInput" placeholder="#">
						<label for="floatingInput">Password</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" name="CLnewPassword2" id="floatingInput" placeholder="#">
						<label for="floatingInput">Confirm Password</label>
					</div>
					<div class="form-floating mb-3">
						<div class="form-check">
							<input type="checkbox" id="clientSignUpCheck" name="clientSignUpCheck" value=1 class="form-check-input">
							<label for="clientSignUpCheck" class="form-check-label">Stay Signed In</label>
							<input type="hidden" name="SignUpCheckForm" value="1">
						</div>
					</div>
					<div class="input-group mb-3 d-grid gap-2">
						<button class="btn btn-primary" type="submit" name="submit">Sign Up</button>
					</div> 	
					<div class="input-group mb-3">
						<p>Already have an account? <a href="clientlogin.php"> Login</a></p>
					</div>		                       
				</form>
			</div>
			<div class="col-2 col-sm-4" id="clientSignUpSubSection4"></div>
		</main>

	</div>

	<!--footer-->
	<footer class="footer py-5">
	    <div class="container">
	      <div class="row">
	        <div class="col-8 mx-auto text-center mt-1">
	          <p class="mb-0 text-secondary">
	            Copyright © <script>
	              document.write(new Date().getFullYear())
	            </script> P-Rejex
	          </p>
	        </div>
	      </div>
	    </div>
	 </footer>
	 <!--end of footer-->

	<script src="../js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
	<script src="../js/popper.min.js"></script> <!--link to popper js file-->
    <script src="../bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->
</body>
</html>