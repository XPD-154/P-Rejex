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


                <div class="container">

                    <!-- Table Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Company Result</h1>

                    <?php
                            //else show all results available in connection with the contractor
                            $CNuniqueID = $_SESSION['CNuniqueID'];
                            echo ('<div class="card shadow mb-4">');
                            echo ('<div class="card-body">');
                            echo ('<div class="table-responsive">');
                            echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
                            $query="SELECT * FROM PRprequalification WHERE CNuniqueId = '$CNuniqueID'";
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            echo "<tr>";
                            echo "<th>Project Name</th>";
                            echo "<th>Score</th>";
                            echo "<th>Verdict</th>";
                            echo "</tr>";
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                
                                echo"<tr><td>";
                                echo ($row['project_name']);
                                echo ("</td><td>");
                                echo ($row['score']);
                                echo ("</td><td>");
                                echo ($row['verdict']);
                                echo ("</td></tr><br>");
                                
                            };
                        
                    ?>
                </div>    

            </div>
            <!-- End of Main Content -->

        </div> 
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!--link to file containing user profile modal-->
    <?php include ("user_profile_co.php"); ?>
    
    <!--link to file containing footer file-->
    <?php include ("footer_co.php"); ?>