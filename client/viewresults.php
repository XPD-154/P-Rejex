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
                <h1 class="h3 mb-2 text-gray-800">Prequalification Results Table</h1>

                <form style="margin-top: 25px;">
                    <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary" id="myBtn">submit</button>
                            </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">Please input a Project Name<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>      
                </form>

                <?php
                        //check if the search button has been inserted
                        if(isset($_GET['searchInput'])){
                            $searchInput = $_GET['searchInput']; //search input variable for project name
                            echo ('<div class="card shadow mb-4">');
                            echo ('<div class="card-body">');
                            echo ('<div class="table-responsive">');
                            echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
                            $query="SELECT * FROM PRprequalification WHERE project_name LIKE '%$searchInput%'"; //select all rows where search input variable is similar to the project name from the table
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            echo "<tr>";
                            echo "<th>Project Name</th>";
                            echo "<th>Contractng Company Name</th>";
                            echo "<th>Contractng Company Email</th>";
                            echo "<th>Contractng Company Contact</th>";
                            echo "<th>Score</th>";
                            echo "<th>Verdict</th>";
                            echo "</tr>";
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                
                                echo"<tr><td>";
                                echo ($row['project_name']);
                                echo ("</td><td>");
                                echo ($row['CNcompany_name']);
                                echo ("</td><td>");
                                echo ($row['CNemail']);
                                echo ("</td><td>");
                                echo ($row['CNphone_number']);
                                echo ("</td><td>");
                                echo ($row['score']);
                                echo ("</td><td>");
                                echo ($row['verdict']);
                                echo ("</td></tr><br>");
                                
                            };

                        }else{

                            //else show all projects available
                            echo ('<div class="card shadow mb-4">');
                            echo ('<div class="card-body">');
                            echo ('<div class="table-responsive">');
                            echo ('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">');
                            $query="SELECT * FROM PRprequalification";
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            echo "<tr>";
                            echo "<th>Project Name</th>";
                            echo "<th>Contractng Company Name</th>";
                            echo "<th>Contractng Company Email</th>";
                            echo "<th>Contractng Company Contact</th>";
                            echo "<th>Score</th>";
                            echo "<th>Verdict</th>";
                            echo "</tr>";
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                
                                echo"<tr><td>";
                                echo ($row['project_name']);
                                echo ("</td><td>");
                                echo ($row['CNcompany_name']);
                                echo ("</td><td>");
                                echo ($row['CNemail']);
                                echo ("</td><td>");
                                echo ($row['CNphone_number']);
                                echo ("</td><td>");
                                echo ($row['score']);
                                echo ("</td><td>");
                                echo ($row['verdict']);
                                echo ("</td></tr><br>");
                                
                            };

                        }
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