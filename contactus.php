<?php

//start database connection

include ("connection.php");

//start session connection

session_start();

//store users activity using this php file

include 'user_activity_log.php';

//Login form validation for client

if(isset($_POST['clientSubmit'])){

	//check if an email is inserted 
	if(!$_POST['CLemail']){

		$_SESSION['error'] = "Input your email";
	  	header('location: index.php');
		return;
	}
	//check if a password is inserted
	if(!$_POST['CLpassword']){

		$_SESSION['error'] = "Input your password";
	  	header('location: index.php');
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

				$_SESSION['user']="Unregister user";
				$_SESSION['message']="Attempted to login as a client";

			}else{

				$_SESSION['user']=$_SESSION['CLuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'client/user_activity_log_cl.php';

			//Welcome back alert
			$_SESSION['success']="Welcome back!!!";
			header('location: client/index.php');
			return;
			
		}else{

			//determine user that enters the visitors log
			if(!$_SESSION['CLuniqueID']){

				$_SESSION['user']="Unregister user";
				$_SESSION['message']="Attempted to login as a client";

			}else{

				$_SESSION['user']=$_SESSION['CLuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'client/user_activity_log_cl.php';
			$_SESSION['error'] = "The email/password combination could not be found";
			header('location: index.php');
			return;
		}

		
	}else{

		//determine user that enters the visitors log
		if(!$_SESSION['CLuniqueID']){

			$_SESSION['user']="Unregister user";
			$_SESSION['message']="Attempted to login as a client";

		}else{

			$_SESSION['user']=$_SESSION['CLuniqueID'];
			$_SESSION['message']="Logged in";
		}

		//store users activity using this php file
		include 'client/user_activity_log_cl.php';

		$_SESSION['error'] = "The email/password combination could not be found";
		header('location: index.php');
		return;
	}

}
}



//login form validation for contractor

if(isset($_POST['contractorSubmit'])){

	//check if an email is inserted
	if(!$_POST['CNemail']){

		$_SESSION['error'] = "Input your email";
	  	header('location: index.php');
		return;
	}
	//check if a password is inserted
	if(!$_POST['CNpassword']){

		$_SESSION['error'] = "Input your password";
	  	header('location: index.php');
		return;
	}else{

	//select all columns from PRcontractor table where inserted email matches	
	$query = "SELECT * FROM PRcontractor WHERE CNemail = :email";
	$sql = $connection->prepare($query);
	$sql->execute(array(':email'=>$_POST['CNemail']));
	$row = $sql->fetch(PDO::FETCH_ASSOC);

	if(isset($row)){

		$modifiedPassword = md5(md5($row['contractorID']).$_POST['CNpassword']);

		//check if modified password matches password in the password column selected
		if($modifiedPassword==$row['CNpassword']){

			//if the user indicates a desire to be remebered, by checking remember me, create session for the ID of user
			if($_POST['contractorLoginCheck']=='1'){

				$_SESSION['contractorID']=$row['contractorID'];
			}

			//set the uniqueID of user to be seen on contractor dashboard by setting it as a session variable
			$lastRowID=$row['contractorID'];
			$query="SELECT * FROM PRcontractor WHERE contractorID = '$lastRowID' LIMIT 1";
			$sql=$connection->prepare($query);
			$sql->execute();
			while($row=$sql->fetch(PDO::FETCH_ASSOC)){

				$_SESSION['CNuniqueID'] = $row['CNuniqueId'];
			}

			//determine user that enters the visitors log
			if(!$_SESSION['CNuniqueID']){

				$_SESSION['user']="Unregister user";
				$_SESSION['message']="Attempted to login as a contractor";

			}else{

				$_SESSION['user']=$_SESSION['CNuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'contractor/user_activity_log_cn.php';

			//Welcome back alert
			$_SESSION['success']="Welcome back!!!";
			header('location: contractor/index.php');
			return;

		}else{

			//determine user that enters the visitors log
			if(!$_SESSION['CNuniqueID']){

				$_SESSION['user']="Unregister user";
				$_SESSION['message']="Attempted to login as a contractor";

			}else{

				$_SESSION['user']=$_SESSION['CNuniqueID'];
				$_SESSION['message']="Logged in";
			}

			//store users activity using this php file
			include 'contractor/user_activity_log_cn.php';

			$_SESSION['error'] = "The email/password combination could not be found";
			header('location: index.php');
			return;
		}

		
	}else{

		//determine user that enters the visitors log
		if(!$_SESSION['CNuniqueID']){

			$_SESSION['user']="Unregister user";
			$_SESSION['message']="Attempted to login as a contractor";

		}else{

			$_SESSION['user']=$_SESSION['CNuniqueID'];
			$_SESSION['message']="Logged in";
		}

		//store users activity using this php file
		include 'contractor/user_activity_log_cn.php';
			
		$_SESSION['error'] = "The email/password combination could not be found";
		header('location: index.php');
		return;
	}
}
}

//creation of database table for user feedback if it doesnt exist

$query = "CREATE TABLE IF NOT EXISTS PRfeedback (
    userID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    area_code VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    contact_me TEXT NOT NULL
)";
$sql= $connection->prepare($query);
$sql->execute();

//validation and submission for feedback form

if(isset($_POST['submit'])){

		//check if first name is inserted
	    if (!$_POST['first_name']){

	  		$_SESSION['error'] = "Input your first name";
	  		header('location: contactus.php');
			return;
	  	}
	  	//check if second name is inserted
  		if (!$_POST['last_name']){

	  		$_SESSION['error'] = "Input your last name";
	  		header('location: contactus.php');
			return;

	  	}
	  	//check if area code is inserted
	  	if (!$_POST['area_code']){

	  		$_SESSION['error'] = "Input your area code";
	  		header('location: contactus.php');
			return;
	  	}
	  	//check if phone number is inserted
	  	if (!$_POST['phone_number']){

	  		$_SESSION['error'] = "Input your phone number";
	  		header('location: contactus.php');
			return;

	  	}
	  	//check if email is inserted
	  	if (!$_POST['email']){

	  		$_SESSION['error'] = "Input your email address";
	  		header('location: contactus.php');
			return;

	  	}
	  	//check if a feedback is inserted
	  	if (!$_POST['message']){

	  		$_SESSION['error'] = "Input your feedback";
	  		header('location: contactus.php');
			return;

	  	}else{

	  		//insert values into PRfeedback table
	  		$query = "INSERT INTO PRfeedback (first_name, last_name, area_code, phone_number, email, message) VALUES (:first_name, :last_name, :area_code, :phone_number, :email, :message)";
			$sql = $connection->prepare($query);
			$sql->execute(array(
					':first_name'=>$_POST['first_name'],
					':last_name'=>$_POST['last_name'],
					':area_code'=>$_POST['area_code'],
					':phone_number'=>$_POST['phone_number'],
					':email'=>$_POST['email'],
					':message'=>$_POST['message']));

			//select last ID of feedback inserted
			$lastID = $connection->lastInsertId();

			if(isset($_POST['contact_me'])){

				//use last ID select to denote the method by which a user has indicated to be contacted
				$query = "UPDATE PRfeedback  SET contact_me = :contact_me WHERE userID = '$lastID' LIMIT 1";
				$sql = $connection->prepare($query);
				$sql->execute(array(':contact_me'=>$_POST['contact_me']));
			}

			//success alert
			$_SESSION['success'] = "feedback sent successfully";
			header('location: contactus.php');
			return;
	  	}

	  	
	}

?>
<!DOCTYPE html>
<html lang="en"> <!--lang stands for language attribute, en stands for english -->
<head>
	<meta charset="utf-8"> <!--conversion of typed charater into machine readable code-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--viewport is the user's visisble area of a web page, the meta tag allows modification to the viewport, width=device-width sets the width of the page to follow screen width of the device, initial-sacle=1 set the initial zoom level on a page, shrink-to-fit=no prevent contents that are initially bigger than the viewport to be shrink too small-->
	<meta http-equiv="x-ua-compatible" content="ie=edge"> <!--x-ua compatible is a document mode meta tag that allows choice of what version of Internet Explorer the page should be rendered as-->
	
	<link rel="shortcut icon" type="image/jpg" href="img/Untitled-5.png"> <!--link to favicon-->           
	<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"> <!--link to boostrap css file-->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!--link to font awesome css file-->
	<link rel="stylesheet" href="bootstrap-social/bootstrap-social.css"> <!--link to boostrap social css file-->
	<link rel="stylesheet" href="css/style.css"><!--link to css stylesheet for project-->
	<title>P-Rejex</title>
</head>
<body id="contactus">

	<header>

			<!--Navigation bar-->
			<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navBarColor">
			  	<div class="container-fluid">
				    <a class="navbar-brand" href="#"><img src="img/Untitled-5.png" id="navBarLogo"> P-ReJex</a>
				    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				     	 <span class="navbar-toggler-icon"></span>
				    </button>
				    <div class="collapse navbar-collapse" id="navbarContent">
					      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
						        <li class="nav-item">
						          <a class="nav-link" aria-current="page" href="index.php">About Us</a>
						        </li>
						        <li class="nav-item">
						          <a class="nav-link active" href="#">Contact Us</a>
						        </li>
						        <li class="nav-item dropdown">
						          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						            Sign up
						          </a>
						          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						            <li><a class="dropdown-item" href="client/clientsignup.php"><span class="fa fa-user"></span> Client</a></li>
						            <li><hr class="dropdown-divider"></li>
						            <li><a class="dropdown-item" href="contractor/contractorsignup.php"><span class="fa fa-file"></span> Contractor</a></li>
						          </ul>
						        </li> 
					      </ul>
					      <div>
					      		<a class="btn btn-success" href="" data-bs-toggle="modal" data-bs-target="#loginModal"><span class="fa fa-sign-in"></span> Login</a>
					      		<a href="admin/index.php" class="btn btn-primary"><span class="fa fa-user"></span> Admin</a>
					      </div>
				    </div>
			    </div>
			</nav>
			<!--end of navigation bar-->

		</header>

		<main class="container">

			<!--contact us intro section-->
			<section id="contactUsIntroSection">
					   <div class="row">
						   <div class="col-12">
				               <h3>Contact Us</h3>
				           </div>
			       	   </div>

			       	   <div class="row" style="margin-top: 40px;">
				           <div class="col-12">
				              <h3>Location Information</h3>
				           </div>
				           <div class="col-12 col-sm-1">
				           	
				           </div>
				           <div class="col-12 col-sm-4">
				                   <h5>Our Address</h5>
				                    <address style="font-size: 100%">
						              Babcock University<br>
						              Ilisan-Remo, Ogun State<br>
						              NIGERIA<br>
						              <i class="fa fa-phone"></i>: +852 1234 5678<br>
						              <i class="fa fa-fax"></i>: +852 8765 4321<br>
						              <i class="fa fa-envelope"></i>:
				                        <a href="mailto:rejex@gmail.com">rejex@gmail.com</a>
						           </address>
				            </div>
				            <div class="col-12 col-sm-6 offset-sm-1">
				                <h5>Map of our Location</h5>
				                <div id="map"></div> <!--div containing map-->
				            </div>
				            <div class="col-12 col-sm-11 offset-sm-1">
				               <div class="btn-group" role="group">
				                    <a role="button" class="btn btn-primary" href="tel:+85212345678"><i class="fa fa-phone"></i> Call</a>
				                    <a role="button" class="btn btn-success" href="#"><i class="fa fa-whatsapp"></i> Whatsapp</a>
				                    <a role="button" class="btn btn-info" href="mailto:confusion@gmail.com"><i class="fa fa-envelope-o"></i> Email</a>
				               </div>
				            </div>
			        	</div>
			</section>
			<!--end of contact us intro section-->

			<!--contact us message section-->
			<section id="contactUsMessageSection">
				<div class="row">
					<div class="col-12">
		              <h3>Send us your Feedback</h3>
		            </div>
		            <div class="col-12 col-sm-6">

		            	<!--section containing error alerts-->
						<div id="error">
							<?php 
								if(isset($_SESSION['error'])){

									echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'.$_SESSION['error'].'!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'); 

									unset($_SESSION['error']);
								} 
							?>
						</div>
						<!--end of section containing error alerts-->

						<!--section containing success alerts-->
						<div id="success">
							<?php 
								if(isset($_SESSION['success'])){

									echo ('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>'.$_SESSION['success'].'!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
													
									unset($_SESSION['success']);
								}
							 ?>
						</div>
						<!--end section containing success alerts-->

						<form method="POST" style="margin-top: 20px">
							<div class="form-floating mb-3">
								<input type="text" name="first_name" placeholder="first name" class="form-control" id="floatingInput">
								<label for="floatingInput">First Name</label>
							</div>
							<div class="form-floating">
								<input type="text" name="last_name" placeholder="last name" class="form-control" id="floatingInput">
								<label for="floatingInput">Last Name</label>
							</div>
							<div class="row mt-3">
								<div class="col-4 col-sm-6">
									<div class="form-floating">
										<input type="text" name="area_code" placeholder="area code" class="form-control" id="floatingInput">
										<label for="floatingInput">Area Code</label>
									</div>
								</div>
								<div class="col-8 col-sm-6">
									<div class="form-floating">
										<input type="text" name="phone_number" placeholder="phone number" class="form-control" id="floatingInput">
										<label for="floatingInput">Telephone</label>
									</div>
								</div>
							</div>
							<div class="form-floating mt-3">
								<input type="email" name="email" placeholder="email" class="form-control" id="floatingInput">
								<label for="floatingInput">Email</label>
							</div>
							<div class="form-floating mt-3">
						      <select class="form-select" id="floatingSelectGrid" name="contact_me" aria-label="Floating label select example">
						        <option disabled selected>If yes, choose preferred means</option>
						        <option value="Telephone">Telephone</option>
						        <option value="Email">Email</option>
						      </select>
						      <label for="floatingSelectGrid"><b>May we contact you</b></label>
						    </div>
						    <div class="form-floating mt-3">
							  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="message" style="height: 100px"></textarea>
							  <label for="floatingTextarea2">Message</label>
							</div>
							<div class="input-group mt-3">
								<button class="btn btn-primary" type="submit" name="submit">Send Message</button>
							</div>
						</form>
					</div>
				</div>

			</section>
			<!--contact us message section-->
			
		</main>
	
	<!--login modal for homepage logon button-->
	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="loginModalLabel">Log In
	        	<?php

	        		//error alert for login modal if present
					if(isset($_SESSION['error'])){

						echo ('<p style="color:red">'.$_SESSION['error']."</p>\n");
						unset($_SESSION['error']);
					}
				?>
	        </h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body" id="loginModalBody">
	         <ul class="nav nav-tabs" id="loginTab" role="tablist">
				  <li class="nav-item" role="presentation">
				    <button class="nav-link active" id="loginClient-tab" data-bs-toggle="tab" data-bs-target="#loginClient" type="button" role="tab" aria-controls="loginClient" aria-selected="true">Client</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="loginContractor-tab" data-bs-toggle="tab" data-bs-target="#loginContractor" type="button" role="tab" aria-controls="loginContractor" aria-selected="false">Contractor</button>
				  </li>
			</ul>
			<div class="tab-content" id="myTabContent" style="margin-top: 10px;">
			  <div class="tab-pane fade show active" id="loginClient" role="tabpanel" aria-labelledby="loginClient-tab">
			  	
			  	<!--client login tab-->
			  	<form method="POST">
					<div class="input-group mb-3">
					  <span class="input-group-text">Email</span>
					  <input type="email" class="form-control" name="CLemail">
					</div>
					<div class="input-group mb-3">
					  <span class="input-group-text">Password</span>
					  <input type="password" class="form-control" name="CLpassword">
					</div>
					<div class="input-group mb-3">
						<div class="form-check">
							<input type="checkbox" id="clientLoginCheck" name="clientLoginCheck" value=1 class="form-check-input">
							<label for="clientLoginCheck" class="form-check-label">Remember me</label>
							<input type="hidden" name="loginCheckForm" value="1">
					    </div>
					</div>
					<div class="input-group mb-3">
					  <button class="btn btn-primary" type="submit" name="clientSubmit">Log In</button>
					</div>                        
				</form>
			  </div>
			  <div class="tab-pane fade" id="loginContractor" role="tabpanel" aria-labelledby="loginContractor-tab">
			  	
			  	<!--contractor login tab-->
			  	<form method="POST">
					<div class="input-group mb-3">
					  <span class="input-group-text">Email</span>
					  <input type="email" class="form-control" name="CNemail">
					</div>
					<div class="input-group mb-3">
					  <span class="input-group-text">Password</span>
					  <input type="password" class="form-control" name="CNpassword">
					</div>
					<div class="input-group mb-3">
						<div class="form-check">
							<input type="checkbox" id="contractorLoginCheck" name="contractorLoginCheck" value=1 class="form-check-input">
							<label for="contractorLoginCheck" class="form-check-label">Remember me</label>
							<input type="hidden" name="loginCheckForm" value="0">
					    </div>
					</div>
					<div class="input-group mb-3">
						<button class="btn btn-primary" type="submit" name="contractorSubmit">Log In</button>
					</div>                        
				</form>
			  </div>
			</div>
	      </div>
	    </div>
	  </div>
	</div>
	<!--end of login modal for homepage logon button-->

	<?php include("footer.php");?> <!--footer section-->

	<script src="js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
	<script src="js/popper.min.js"></script> <!--link to popper js file-->
	<script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->
</body>
</html>