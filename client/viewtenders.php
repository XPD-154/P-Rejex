<?php

  //start database connection
  include ("../connection.php");

  //start session connection
  session_start();  

  //logout from dashboard and log that activity
  include ("logout.php");
    
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P-Rejex</title>
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
</head>


<body id="page-top">

	<!-- Page Wrapper -->
    <div id="wrapper">

		<?php include ("menu_sidebar_cl.php"); ?>

                <!-- Begin Table Content for displaying projects -->
                <div class="container-fluid">

                <!-- Table Heading -->
                <h1 class="h3 mb-2 text-gray-800">Projects Table</h1>
                <p class="mb-4">Tables showing projects offered by <?= $_SESSION['CLuniqueID'] ?> </p>

               	<?php

	               	$CLuniqueID=$_SESSION['CLuniqueID'];
	               	echo ('<div class="card shadow mb-4">');
	               	echo ('<div class="card-body">');
	               	echo ('<div class="table-responsive">');
					echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
					$query="SELECT * FROM PRtender WHERE CLuniqueId = '$CLuniqueID'";
					$sql=$connection->prepare($query);
					$sql->execute();
					echo "<tr>";
					echo "<th>Project Name</th>";
					echo "<th>Introduction</th>";
					echo "<th>Scope of Work</th>";
					echo "<th>Eligibility Criteria</th>";
                    echo "<th>List of Work for Tender</th>";
                    echo "<th>Tender Evaluation Procedure and Method</th>";
                    echo "<th>Submission Closing Date</th>";
                    echo "<th>Bid Opening Date</th>";
                    echo "<th>Any Other Information</th>";
                    echo "<th>Disclaimer</th>";
					echo "</tr>";
					while($row=$sql->fetch(PDO::FETCH_ASSOC)){
						
						echo"<tr><td>";
						echo ($row['project_name']);
						echo ("</td><td>");
						echo ($row['introduction']);
						echo ("</td><td>");
						echo ($row['scope_of_work']);
						echo ("</td><td>");
                        echo ($row['eligibility_criteria']);
                        echo ("</td><td>");
                        echo ($row['list_of_work_for_tender']);
                        echo ("</td><td>");
                        echo ($row['tender_evaluation_procedure_and_method']);
                        echo ("</td><td>");
                        echo ($row['submission_closing_date']);
                        echo ("</td><td>");
                        echo ($row['bid_opening_date']);
                        echo ("</td><td>");
                        echo ($row['any_other_information']);
                        echo ("</td><td>");
						echo ($row['disclaimer']);
						echo ("</td></tr><br>");
						
					};
				?>

                </div>
                <!-- end of Table Content -->


			</div>
            <!-- End of Main Content -->

        </div> 
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST">
                        <button type="submit" name="log_out" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of Logout Modal-->

    <!-- Modal for user profile-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php
                $CLuniqueID=$_SESSION['CLuniqueID'];
                $query="SELECT * FROM prclient WHERE CLuniqueId = '$CLuniqueID' LIMIT 1";
                $sql=$connection->prepare($query);
                $sql->execute();
                while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                    echo "Company Name: ".$row['CLcompany_name']."<br>";
                    echo "Company Email: ".$row['CLemail']."<br>";
                    echo "Company Phone Number: ".$row['CLphone_number']."<br>";
                }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--end of Modal for user profile-->

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
