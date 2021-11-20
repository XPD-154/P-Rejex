<?php

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
                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register Project</button>
                </form>
        </div>
	</section>
	<!--end of section containing project form-->

    <!--link to file containing footer-->
    <?php include ("footer_ad.php"); ?>