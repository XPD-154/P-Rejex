<?php
  
  //start database connection

  include ("../connection.php");

  //start session connection

  session_start(); 

  //creation of database table for admin if it doesnt exist

  $query="CREATE TABLE IF NOT EXISTS PRadmin(
                    adminID INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    admin_email VARCHAR(50) NOT NULL,
                    admin_password VARCHAR(50) NOT NULL)" ;
  $sql=$connection->prepare($query);
  $sql->execute();

  if (!$_SESSION['adminID']){

      header('location:adminlogin.php');
      return;
  }

  //link to file containing header
  include ("header_ad.php");
?>

<body id="page-top" onload="displayCalendar()">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!--link to file containing menu and sidebar-->
		<?php include ("menu_sidebar_ad.php"); ?>

                <!--section for introductory banner-->
                <section id="adminBanner">
                    <div class="banner-text">
                        <h1>Welcome to P-Rejex</h1>
                        <hr>
                        <p>Admin Dashboard</p>
                    </div>
                </section>
                <!--end of section for introductory banner-->

                <!--section for success alert upon adding project-->
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
                <!--end of section for success alert upon adding project-->

                <!-- Content Row -->
                <section class="container">
                    <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-12 col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Clients</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                        $query = "SELECT * FROM PRclient";
                                                        $sql = $connection->prepare($query);
                                                        $sql->execute();
                                                        $rowCount = $sql->rowCount();
                                                        echo $rowCount;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-12 col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-secondary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                    Contractors</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php
                                                        $query = "SELECT * FROM PRcontractor";
                                                        $sql = $connection->prepare($query);
                                                        $sql->execute();
                                                        $rowCount = $sql->rowCount();
                                                        echo $rowCount;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-12 col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Projects
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                            <?php
                                                                $query = "SELECT * FROM PRproject";
                                                                $sql = $connection->prepare($query);
                                                                $sql->execute();
                                                                $rowCount = $sql->rowCount();
                                                                echo $rowCount;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-12 col-xl-3 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tender
                                                </div>
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                            <?php
                                                                $query = "SELECT * FROM PRtender";
                                                                $sql = $connection->prepare($query);
                                                                $sql->execute();
                                                                $rowCount = $sql->rowCount();
                                                                echo $rowCount;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="progress progress-sm mr-2">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
                <!-- End of Content Row -->

                <section class="container">
                        <div class="row">

                                <!--section containing table for user log--> 
                                <div class="col-12 col-xl-6 col-md-6 mb-4">

                                    <!-- Table Heading -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Users Log Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>User IP Address</th>
                                                            <th>User</th>
                                                            <th>Message</th>
                                                            <th>Project</th>
                                                            <th>Time</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>User IP Address</th>
                                                            <th>User</th>
                                                            <th>Message</th>
                                                            <th>Project</th>
                                                            <th>Time</th>
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
                                                        $no_of_records_displayed_per_page=4;

                                                        //determine limit of data to show on any current table page displaying
                                                        $limit_to_display=($page_currently_on-1)*$no_of_records_displayed_per_page;
                                                          
                                                        //determine the total amount of data in the database
                                                        $query="SELECT * FROM visitor_activity_logs";
                                                        $sql=$connection->prepare($query);
                                                        $sql->execute();
                                                        $total_rows_available = $sql->rowCount();
                                                          
                                                        //total number of pages available based on the total number of rows in database
                                                        $total_no_pages_available=ceil($total_rows_available/$no_of_records_displayed_per_page);

                                                        $query="SELECT * FROM visitor_activity_logs ORDER BY created_on DESC LIMIT $limit_to_display, $no_of_records_displayed_per_page";
                                                        $sql=$connection->prepare($query);
                                                        $sql->execute();
                                                        while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                            echo"<tr><td>";
                                                            echo ($row['user_ip_address']);
                                                            echo ("</td><td>");
                                                            echo ($row['user']);
                                                            echo ("</td><td>");
                                                            echo ($row['message']);
                                                            echo ("</td><td>");
                                                            echo ($row['project']);
                                                            echo ("</td><td>");
                                                            echo ($row['created_on']);
                                                            echo ("</td><td>");
                                                            echo ('<a href="delete.php?user='.$row['user'].'">Delete</a>');
                                                            echo ("</td></tr>");
                                                        }
                                                        
                                                        echo  '<ul class="pagination">';
                                                        if($page_currently_on>1){
                                                            echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page_currently_on-1).'">Prev</a></li>';
                                                        }
                                                        
                                                        for ($page=1; $page<=$total_no_pages_available; $page++) {

                                                             echo '<li class="page-item"><a class="page-link" href="index.php?page='.$page.'">'.$page.'</a></li>'; 
                                                         }
                                                        if($page>$page_currently_on){
                                                           echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page_currently_on+1).'">Next</a></li>'; 
                                                        }
                                                        echo  '</ul>';

                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--end of section containing table for user log-->

                                <!--section containing table for calender--> 
                                <div class="col-12 col-xl-6 col-md-6 mb-4">

                                    <!-- Table Heading -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Calender</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div id="calendar"></div> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--end of section containing table for calender-->

                        </div> 
                </section>


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