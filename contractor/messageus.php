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
							':useruniqueId'=>$_SESSION['CNuniqueID']));
		
        //alert for sucessfully added messge
		$_SESSION['success'] = "Message sent sucessfully !!!";
		header('location: index.php');
		return;

	}

}

//link to file containing header file 
include ("header_co.php");
?>
<body class="bg-gradient-dark"> <!--color for the entire background-->

	<!--breadcrumb nav bar-->
	<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Contractor Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Message Us</li>
      </ol>
    </nav>
    <!--end of breadcrumb nav bar-->

    <!--section containing message form-->
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
                    <button type="submit" name="submit" class="btn btn-dark btn-user btn-block">Send Message</button>

                </form>
        </div>
	</section>
	<!--end of section containing message form-->

    <!--link to file containing footer file-->
	<?php include ("footer_co.php"); ?>