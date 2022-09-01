<?php

//start database connection

include ("../connection.php");

//start session connection

session_start();

//forgot password client

if(isset($_POST['forgot_password_cl'])){

    $_SESSION['forgot_password_cl'] = $_POST['forgot_password_cl'];
    header('location: ../forgot_password.php');
    return;
}

//Login form validation for client

if(isset($_POST['clientSubmit'])){

	//check if an email is inserted
	if(!$_POST['CLemail']){

		$_SESSION['error'] = "Input your email";
	  	header('location: clientlogin.php');
		return;
	}
	//check if a password is inserted
	if(!$_POST['CLpassword']){

		$_SESSION['error'] = "Input your password";
	  	header('location: clientlogin.php');
		return;

	}else{

	//select all columns from PRclient table where inserted email matches
	$query = "SELECT * FROM PRclient WHERE CLemail = :email";
	$sql = $connection->prepare($query);
	$sql->execute(array(':email'=>$_POST['CLemail']));
	$row = $sql->fetch(PDO::FETCH_ASSOC);

	if(isset($row)){

		$modifiedPassword = md5(md5($row['clientID']).$_POST['CLpassword']);

		//check if modified password matches password in the password column selected
		if($modifiedPassword==$row['CLpassword']){

			//if the user indicates a desire to be remebered, by checking remember me, create session for the ID of user
			if($_POST['clientLoginCheck']=='1'){

				$_SESSION['clientID']=$row['clientID'];
			}

			//set the uniqueID of user to be seen on client dashboard by setting it as a session variable
			$lastRowID=$row['clientID'];
			$query="SELECT * FROM prclient WHERE clientID = '$lastRowID' LIMIT 1";
			$sql=$connection->prepare($query);
			$sql->execute();
			while($row=$sql->fetch(PDO::FETCH_ASSOC)){

				$_SESSION['CLuniqueID'] = $row['CLuniqueId'];
			}

			//determine user that enters the visitors log
			if(!$_SESSION['CLuniqueID']){

				$_SESSION['user']="Unregistered user";
				$_SESSION['message']="Attempted to login";

			}else{

				$_SESSION['user']=$_SESSION['CLuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'user_activity_log_cl.php';

			//Welcome back alert
			$_SESSION['success']="Welcome back!!!";
			header('location: index.php');
			return;

		}else{

			//determine user that enters the visitors log
			if(!$_SESSION['CLuniqueID']){

				$_SESSION['user']="Unregistered user";
				$_SESSION['message']="Attempted to login";

			}else{

				$_SESSION['user']=$_SESSION['CLuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'user_activity_log_cl.php';

			$_SESSION['error'] = "The email/password combination could not be found";
			header('location: clientlogin.php');
			return;
		}


	}else{

		//determine user that enters the visitors log
		if(!$_SESSION['CLuniqueID']){

			$_SESSION['user']="Unregistered user";
			$_SESSION['message']="Attempted to login";

		}else{

			$_SESSION['user']=$_SESSION['CLuniqueID'];
			$_SESSION['message']="Logged in";
		}

		//store users activity using this php file
		include 'user_activity_log_cl.php';

		$_SESSION['error'] = "The email/password combination could not be found";
		header('location: clientlogin.php');
		return;
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
    <link rel="stylesheet" href="../css/style.css"> <!--link to css stylesheet for project-->
    <title>P-Rejex</title>

</head>
<body>
	<div id="clientLogInPage">
		<div class="row">
			<div class="col-12 col-sm-6">

				<!--navigation breadcrumb-->
				<div id="clientLoginSection3">
					<nav style="--bs-breadcrumb-divider: '>';" id="clientLoginBreadCrum" aria-label="breadcrumb">
					  <ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
					    <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
					  </ol>
					</nav>
				</div>
				<!--end of navigation breadcrumb-->

				<div id="clientLogInPageSubSection1" class="container">
					<h3>Welcome Back</h3>
					<p>Enter your email and password to login</p>

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
						<div class="mb-3">
						  <label for="CLemail" class="form-label">Email</label>
						  <input type="email" class="form-control" id="CLemail" name="CLemail">
						</div>
						<div class="mb-4">
						  <label for="CLpassword" class="form-label">Password</label>
						  <input type="password" class="form-control" id="CLpassword" name="CLpassword">
						</div>
						<div class="form-check form-switch mb-4">
						  <input class="form-check-input" type="checkbox" id="clientLoginCheck" name="clientLoginCheck" value=1>
						  <label class="form-check-label" for="clientLoginCheck">Remember me</label>
						  <input type="hidden" name="loginCheckForm" value="1">
						</div>
						<div class="d-grid gap-2 mb-3">
						  <button class="btn btn-primary" type="submit" name="clientSubmit">Log In</button>
						</div>
						<div class="input-group mb-3 text-center">
							<p>Don't have an account? <a href="clientsignup.php"> Sign up</a></p>
							<button class="btn btn-link" type="submit" name="forgot_password_cl">Forgot Password</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-12 col-sm-6">
				<div id="clientLogInPageSubSection2"></div>
			</div>
		</div>
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

	<script src="js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
	<script src="js/popper.min.js"></script> <!--link to popper js file-->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->
</body>
</html>
