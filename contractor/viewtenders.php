<?php
  
  //start database connection
  include ("../connection.php");

  //start session connection
  session_start();  

  //logout from dashboard and log that activity
  include ("logout.php");

  //link to file containing header
  include ("header_co.php");
   
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

		<?php include ("menu_sidebar_co.php"); ?>

                <div class="container-fluid">

                    <!-- Table Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Available Tenders</h1>

                    <form style="margin-top: 25px;">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="myBtn">submit</button>
                            </div>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">Please input a Project name, if you dont know Project name, please view Projects from the sidebar button<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>      
                    </form>

                    <?php
                        //check if the search button has been inserted
                        if(isset($_GET['searchInput'])){
                            $searchInput = $_GET['searchInput']; //search input variable for project name
                            echo ('<div class="card shadow mb-4">');
                            echo ('<div class="card-body">');
                            echo ('<div class="table-responsive">');
                            echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
                            $query="SELECT * FROM PRtender WHERE project_name LIKE '%$searchInput%'"; //select all rows where search input variable is similar to the project name from the table
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
                            echo "<th>Prequalification</th>";
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
                                echo ("</td><td>");
                                echo ('<a type="button" class="btn btn-secondary" href="../prequalificationprocess.php?project_name='.$row['project_name'].'">Start</a>');
                                echo ("</td></tr><br>");
                                
                                //create a session variable for log when a client engages the prequalification process
                                $_SESSION['project_name']=$row['project_name'];
                                
                            };

                        }else{

                            //else show all projects available
                            echo ('<div class="card shadow mb-4">');
                            echo ('<div class="card-body">');
                            echo ('<div class="table-responsive">');
                            echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
                            $query="SELECT * FROM PRtender";
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
                            echo "<th>Prequalification</th>";
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
                                echo ("</td><td>");
                                echo ('<a type="button" class="btn btn-secondary" href="../prequalificationprocess.php?project_name='.$row['project_name'].'">Start</a>');
                                echo ("</td></tr><br>");

                                //create a session variable for log when a client engages the prequalification process
                                $_SESSION['project_name']=$row['project_name'];
                                
                            };
                        }
                        
                    ?>
                </div>    

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; P-Rejex 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div> 
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!--link to file containing user profile modal-->
    <?php include ("user_profile_co.php"); ?>
    
    <!--link to file containing footer file-->
    <?php include ("footer_co.php"); ?>