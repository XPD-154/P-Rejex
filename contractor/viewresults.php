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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h1 class="m-0 font-weight-bold text-secondary">Company Result</h1>

                            <form style="margin-top: 25px;">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary" id="myBtn">submit</button>
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
                                            <th>Project Name</th>
                                            <th>Score</th>
                                            <th>Verdict</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                      //else show all results available in connection with the contractor
                                      $CNuniqueID = $_SESSION['CNuniqueID'];

                                      //determine the page we are currently on using a GET variable, if there is more than one table, all their GET variables should have unique names
                                      if(isset($_GET['page'])){
                                        $page_currently_on=$_GET['page'];
                                      }else{
                                        $page_currently_on=1;
                                      }

                                      //number of records we want to display per page on the table we are on
                                      if(isset($_POST['no_of_records_displayed_per_page'])){
                                            $no_of_records_displayed_per_page=$_POST['no_of_records_displayed_per_page'];
                                      }else{
                                            $no_of_records_displayed_per_page=5;
                                      }

                                      //determine limit of data to show on any current table page displaying
                                      $limit_to_display=($page_currently_on-1)*$no_of_records_displayed_per_page;
                                      
                                      //determine the total amount of data in the database
                                      $query="SELECT * FROM prprequalification";
                                      $sql=$connection->prepare($query);
                                      $sql->execute();
                                      $total_rows_available = $sql->rowCount();
                                      
                                      //total number of pages available based on the total number of rows in database
                                      $total_no_pages_available=ceil($total_rows_available/$no_of_records_displayed_per_page);

                                      if(isset($_GET['searchInput'])){

                                            $searchInput = $_GET['searchInput'];
                                            $query="SELECT * FROM prprequalification WHERE project_name LIKE '%$searchInput%' AND CNuniqueId = '$CNuniqueID' ORDER BY resultID DESC";
                                            $sql=$connection->prepare($query);
                                            $sql->execute();

                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                
                                                echo"<tr><td>";
                                                echo ($row['project_name']);
                                                echo ("</td><td>");
                                                echo ($row['score']);
                                                echo ("</td><td>");
                                                echo ($row['verdict']);
                                                echo ("</td></tr>");
                                                
                                            };

                                        }else{

                                            $query="SELECT * FROM prprequalification WHERE CNuniqueId = '$CNuniqueID' ORDER BY resultID DESC LIMIT $limit_to_display, $no_of_records_displayed_per_page";
                                            $sql=$connection->prepare($query);
                                            $sql->execute();

                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                
                                                echo"<tr><td>";
                                                echo ($row['project_name']);
                                                echo ("</td><td>");
                                                echo ($row['score']);
                                                echo ("</td><td>");
                                                echo ($row['verdict']);
                                                echo ("</td></tr>");
                                                
                                            };
                                           
                                        }
                                        
                                    ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-md-7">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
                                            <li class="<?php if($page_currently_on <= 1){ echo 'disabled'; } ?> page-item">
                                                <a class="page-link" href="<?php if($page_currently_on <= 1){ echo '#'; } else { echo "?page=".($page_currently_on - 1); } ?>">Prev</a>
                                            </li>
                                            <li class="<?php if($page_currently_on >= $total_no_pages_available){ echo 'disabled'; } ?> page-item">
                                                <a class="page-link" href="<?php if($page_currently_on >= $total_no_pages_available){ echo '#'; } else { echo "?page=".($page_currently_on + 1); } ?>">Next</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="?page=<?php echo $total_no_pages_available; ?>">Last</a></li>
                                        </ul>
                                    </div>
                                    <div class="input-group mb-3 col-8 col-md-4">   
                                      <input id="page" type="number" maxlength="1" class="form-control" min="1" max="<?php echo $total_no_pages_available; ?>"   

                                      placeholder="<?php echo $page_currently_on."/".$total_no_pages_available; ?>" required>   

                                      <button class="btn btn-secondary" onClick="go2Page();">Go</button>   
                                    </div>
                                    <div class="col-4 col-md-1">
                                        <form method="POST">
                                            <select class="custom-select mr-sm-2" id="no_of_records_displayed_per_page" name="no_of_records_displayed_per_page" onchange="javascript: submit()">
                                                <option selected value="5" <?php if (isset($_POST['no_of_records_displayed_per_page']) && $_POST['no_of_records_displayed_per_page'] == 5) { echo ' selected="selected"'; } ?>>5</option>
                                                <option value="10" <?php if (isset($_POST['no_of_records_displayed_per_page']) && $_POST['no_of_records_displayed_per_page'] == 10) { echo ' selected="selected"'; } ?>>10</option>
                                                <option value="20" <?php if (isset($_POST['no_of_records_displayed_per_page']) && $_POST['no_of_records_displayed_per_page'] == 20) { echo ' selected="selected"'; } ?>>20</option>
                                                <option value="50" <?php if (isset($_POST['no_of_records_displayed_per_page']) && $_POST['no_of_records_displayed_per_page'] == 50) { echo ' selected="selected"'; } ?>>50</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span>Copyright &copy; P-Rejex <script>document.write(new Date().getFullYear());</script></span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

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