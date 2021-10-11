<?php

//start database connection

include ("connection.php");

//start session connection

session_start();

//store users activity using this php file

include 'user_activity_log.php';

//creation of database table for client if it doesnt exist

$query = "CREATE TABLE IF NOT EXISTS PRclient (
    clientID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CLemail VARCHAR(50) NOT NULL,
    CLpassword VARCHAR(50) NOT NULL,
    CLcompany_name VARCHAR(50) NOT NULL,
    CLphone_number VARCHAR(50) NOT NULL,
    CLuniqueId VARCHAR(50) NOT NULL,
    INDEX(CLuniqueId)
)";
$sql= $connection->prepare($query);
$sql->execute();


//creation of database table for contractor if it doesnt exist

$query = "CREATE TABLE IF NOT EXISTS PRcontractor (
    contractorID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CNemail VARCHAR(50) NOT NULL,
    CNpassword VARCHAR(50) NOT NULL,
    CNcompany_name VARCHAR(50) NOT NULL,
    CNphone_number VARCHAR(50) NOT NULL,
    CNuniqueId VARCHAR(50) NOT NULL,
    INDEX(CNuniqueId)
)";
$sql = $connection->prepare($query);
$sql->execute();

//creation of database table for admin message if it doesnt exist

$query="CREATE TABLE IF NOT EXISTS PRadminmessage (
		  messageID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  useruniqueId VARCHAR(50) NOT NULL,
		  subject TEXT NOT NULL,
		  message TEXT NOT NULL)";
$sql= $connection->prepare($query);
$sql->execute();

//Login form validation for client in modal

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

			//store users activity using this file
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

			//store users activity using this file
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

			//store users activity using this file
			include 'client/user_activity_log_cl.php';

		$_SESSION['error'] = "The email/password combination could not be found";
		header('location: index.php');
		return;
	}

}
}



//login form validation for contractor modal

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

			//store users activity using this file
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

			//store users activity using this file
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

		//store users activity using this file
		include 'contractor/user_activity_log_cn.php';

		$_SESSION['error'] = "The email/password combination could not be found";
		header('location: index.php');
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
    <link rel="shortcut icon" type="image/jpg" href="img/Untitled-5.png"> <!--link to favicon-->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"> <!--link to boostrap css file-->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!--link to font awesome css file-->
    <link rel="stylesheet" href="bootstrap-social/bootstrap-social.css"> <!--link to boostrap social css file-->
    <link rel="stylesheet" href="css/style.css"> <!--link to css stylesheet for project-->
	<title>P-Rejex</title>
	
</head>
<body id="homepage">

	<header>
		<!--Navigation bar for homepage-->
		<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="navBarColor">
		  	<div class="container-fluid">
			    <a class="navbar-brand" href="#"><img src="img/Untitled-5.png" id="navBarLogo"> P-ReJex</a>
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			     	 <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarContent">
				      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					        <li class="nav-item">
					          <a class="nav-link active" aria-current="page" href="#">About Us</a>
					        </li>
					        <li class="nav-item">
					          <a class="nav-link" href="contactus.php">Contact Us</a>
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
		<!--End of Navigation bar for homepage-->
	</header>

	<main>

		<!--Introductory Carousel for homepage-->
		<section id="introductionSection">
			<div id="introductionCarousel" class="carousel slide" data-bs-ride="carousel">
			  <div class="carousel-inner">
			    <div class="carousel-item active" data-bs-interval="10000">
			    	<div class="carousel-caption">
			    		<h1>Welcome to P-Rejex</h1>
			    		<hr>
			    		<h4>Home of Prequalification</h4>
			    	</div>
			      	<img src="img/sol-tZw3fcjUIpM-unsplash.jpg" class="d-block w-100" alt="welcome">
			    </div>
			    <div class="carousel-item" data-bs-interval="2000">
			    	<div class="carousel-caption">
			    		<h1>Prequalification made easy</h1>
			    		<hr>
			    		<h4>Let us assit you as a client to get the best contractor for your project</h4>
			    	</div>
			      	<img src="img/frank-mckenna-9sJMyPKlKhw-unsplash.jpg" class="d-block w-100" alt="client">
			    </div>
			    <div class="carousel-item" data-bs-interval="2000">
			    	<div class="carousel-caption">
			    		<h1>Getting the job done quickly and effectively</h1>
			    		<hr>
			    		<h4>Let us assit you as a contractor to get your dream project</h4>
			    	</div>
			      	<img src="img/mason-kimbarovsky-qEwJFHU3uOE-unsplash.jpg" class="d-block w-100" alt="contractor">
			    </div>
			  </div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#introductionCarousel" data-bs-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Previous</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#introductionCarousel" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Next</span>
			  </button>
			</div>
		</section>
		<!--End of Introductory Carousel for homepage-->

		<!--section containing about us-->
		<section id="aboutUsSection" class="container">
			<div class="row">
				<div class="col-12">
					<center>
						<img src="img/person_4.jpg" alt="collabo" id="aboutUsImg" class="shadow-lg">
						<h1><i>"Why Choose Us"</i></h1>
					</center>
				</div>
			</div>

			<div class="row align-items-stretch" id="featuresSection">
               <div class="col-12 col-md-4 col-lg-4 mb-3">
	                <div class="card shadow-lg">
	                    <h3 class="card-header bg-light"><i class="fa fa-tasks fa-lg"></i> Prequalification</h3>
	                    <div class="card-body justify-content-center">
	                        <p>Prequalification is a procedure of deciding a contractor's capacity to meet the particular necessities for a project including a wide scope of models and data</p>
	                        <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="By Contacting us via mobile, email or our online support">learn more</button>
	                    </div>
	                </div>
	            </div>

	            <div class="col-12 col-md-4 col-lg-4 mb-3">
	                <div class="card shadow-lg">
	                    <h3 class="card-header bg-info text-white"><i class="fa fa-bell fa-lg"></i> Project Broadcasting</h3>
	                    <div class="card-body justify-content-center">
	                        <p>Project advertisement, a notice or announcement in a public medium promoting a product, service, or event for easy application, tendering and bidding</p>
	                        <button type="button" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="By Contacting us via mobile, email or our online support">learn more</button>
	                    </div>
	                </div>
	            </div>

	            <div class="col-12 col-md-4 col-lg-4 mb-3">
	                <div class="card shadow-lg">
	                    <h3 class="card-header bg-success text-white"><i class="fa fa-clipboard fa-lg"></i> Project Consulting</h3>
	                    <div class="card-body justify-content-center">
	                        <p>Project analysis can be used to estimate the economic or engineering viability of projects by performing lifecycle analysis of project performance and maintenance</p>
	                        <button type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="By Contacting us via mobile, email or our online support">learn more</button>
	                    </div>
	                </div>
	            </div>                        
		    </div>	
		</section>
		<!--end of section containing about us-->

		<!--section containing tab information about our team-->
		<section id="ourTeamSection" class="container">
			<div class="justify-content-center text-center">
	        	<h2>Our Team</h2>
	        	<p>We are a team of highly skilled researchers and solution provider from the School of Computing and Engineering Sciences, Babcock University, Nigeria</p>
        	</div>

	        <ul class="nav nav-tabs" id="ourTeamTab" role="tablist">
			  <li class="nav-item" role="presentation">
			    <button class="nav-link active" id="prof-tab" data-bs-toggle="tab" data-bs-target="#prof" type="button" role="tab" aria-controls="prof" aria-selected="true">Lead Researcher</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="enoch-tab" data-bs-toggle="tab" data-bs-target="#enoch" type="button" role="tab" aria-controls="enoch" aria-selected="false">Researcher</button>
			  </li>
			  <li class="nav-item" role="presentation">
			    <button class="nav-link" id="iru-tab" data-bs-toggle="tab" data-bs-target="#iru" type="button" role="tab" aria-controls="iru" aria-selected="false">Researcher</button>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="prof" role="tabpanel" aria-labelledby="prof-tab">
			  	<h4><img src="img/ogbonna.jpg" id="ourTeamImg">Dr. Raymond Okoro</h4>
			    <small>Lead Researcher</small>
			    <p>A Expert in Software Engineering and Project Management</p>
			  </div>
			  <div class="tab-pane fade" id="enoch" role="tabpanel" aria-labelledby="enoch-tab">
			  	<h4><img src="img/Enoch.jpg" id="ourTeamImg"> Oyerinde Enoch</h4>
			    <small>Researcher</small>
			    <p>Master's Degree student of Babcock University, in addition to being a front and backend developer</p>
			  </div>
			  <div class="tab-pane fade" id="iru" role="tabpanel" aria-labelledby="iru-tab">
			  	<h4><img src="img/igho.png" id="ourTeamImg"> Igho-Iggue Iruesiri</h4>
			    <small>Researcher</small>
			    <p>Master's Degree student of Babcock University, in addition to being a front and backend developer</p>
			  </div>
			</div>
		</section>
		<!--end of section containing tab information about our team-->

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