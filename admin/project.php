<?php
//connection
include ("../connection.php");

//session start
session_start();

//link to file containing header
include ("header_ad.php");
?>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

		<!--link to file containing menu and sidebar-->
        <?php include ("menu_sidebar_ad.php"); ?>


                <!--section for success alert-->
                <div id="success" style="padding: 10px;" class="text-center">
                   <?php
                    if(isset($_SESSION['success'])){

                        echo ('<div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <strong>'.$_SESSION['success'].'!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>');
                        unset($_SESSION['success']);
                    }
                   ?> 
                </div>
                <!--end of section for success alert-->

                <!--section containing table for projects--> 
                <div class="container" style="margin: 10px;">

                    <!-- Table Heading -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Project Table</h6>

                            <form style="margin-top: 25px;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" id="myBtn">submit</button>
                                    </div>
                                </div>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">Please input project name<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>      
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project Name</th>
                                            <th>Project Type</th>
                                            <th>Project Location</th>
                                            <th>Project Estimated Budget</th>
                                            <th>Client Unique ID</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project Name</th>
                                            <th>Project Type</th>
                                            <th>Project Location</th>
                                            <th>Project Estimated Budget</th>
                                            <th>Client Unique ID</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php

                                      //determine the page we are currently on using a GET variable, if there is more than one table, all their GET variables should have unique names
                                      if(isset($_GET['page'])){
                                        $page_currently_on=$_GET['page'];
                                      }else{
                                        $page_currently_on=1;
                                      }

                                      //number of records we want to display per page on the table we are on
                                      $no_of_records_displayed_per_page=7;

                                      //determine limit of data to show on any current table page displaying
                                      $limit_to_display=($page_currently_on-1)*$no_of_records_displayed_per_page;
                                      
                                      //determine the total amount of data in the database
                                      $query="SELECT * FROM prproject";
                                      $sql=$connection->prepare($query);
                                      $sql->execute();
                                      $total_rows_available = $sql->rowCount();
                                      
                                      //total number of pages available based on the total number of rows in database
                                      $total_no_pages_available=ceil($total_rows_available/$no_of_records_displayed_per_page);

                                      if(isset($_GET['searchInput'])){

                                            $searchInput = $_GET['searchInput'];
                                            $query="SELECT * FROM prproject WHERE project_name LIKE '%$searchInput%'";
                                            $sql=$connection->prepare($query);
                                            $sql->execute();

                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                
                                                echo"<tr><td>";
                                                echo ($row['projectID']);
                                                echo ("</td><td>");
                                                echo ($row['project_name']);
                                                echo ("</td><td>");
                                                echo ($row['project_type']);
                                                echo ("</td><td>");
                                                echo ($row['project_location']);
                                                echo ("</td><td>");
                                                echo ($row['project_est_bugt']);
                                                echo ("</td><td>");
                                                echo ($row['CLuniqueId']);
                                                echo ("</td><td>");
                                                echo ('<a class="btn btn-primary" href="edit.php?projectID='.$row['projectID'].'">Edit</a>');
                                                echo ("</td><td>");
                                                echo ('<a class="btn btn-danger" href="delete.php?projectID='.$row['projectID'].'">Delete</a>');
                                                echo ("</td></tr>");
                                                
                                            };

                                        }else{

                                            $query="SELECT * FROM prproject LIMIT $limit_to_display, $no_of_records_displayed_per_page";
                                            $sql=$connection->prepare($query);
                                            $sql->execute();

                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                
                                                echo"<tr><td>";
                                                echo ($row['projectID']);
                                                echo ("</td><td>");
                                                echo ($row['project_name']);
                                                echo ("</td><td>");
                                                echo ($row['project_type']);
                                                echo ("</td><td>");
                                                echo ($row['project_location']);
                                                echo ("</td><td>");
                                                echo ($row['project_est_bugt']);
                                                echo ("</td><td>");
                                                echo ($row['CLuniqueId']);
                                                echo ("</td><td>");
                                                echo ('<a class="btn btn-primary" href="edit.php?projectID='.$row['projectID'].'">Edit</a>');
                                                echo ("</td><td>");
                                                echo ('<a class="btn btn-danger" href="delete.php?projectID='.$row['projectID'].'">Delete</a>');
                                                echo ("</td></tr>");
                                                
                                            };

                                        
                                            echo  '<ul class="pagination">';
                                            if($page_currently_on>1){
                                                echo '<li class="page-item"><a class="page-link" href="project.php?page='.($page_currently_on-1).'">Prev</a></li>';
                                            }
                                            
                                            for ($page=1; $page<=$total_no_pages_available; $page++) {

                                                 echo '<li class="page-item"><a class="page-link" href="project.php?page='.$page.'">'.$page.'</a></li>'; 
                                             }
                                            if($page>$page_currently_on){
                                               echo '<li class="page-item"><a class="page-link" href="project.php?page='.($page_currently_on+1).'">Next</a></li>'; 
                                            }
                                            echo  '</ul>';
                                           
                                        }
                                        
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    
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
    <?php include ("user_profile_ad.php"); ?>

    <!--link to file containing footer-->
    <?php include ("footer_ad.php"); ?>

	
	