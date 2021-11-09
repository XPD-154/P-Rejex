<?php

  //start database connection
  include ("../connection.php");

  //start session connection
  session_start();  

  //logout from dashboard and log that activity
  include ("logout.php");

  //reference to header file
  include("header_cl.php");
?>

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

    <!--reference to file containing scroll button at the buttom, logout button and profile button on top-->
    <?php include("user_profile_cl.php"); ?>

    <!--reference to footer-->
	<?php include("footer_cl.php"); ?>