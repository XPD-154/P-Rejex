<?php

  include ("../connection.php");

  session_start(); 


?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>P-Rejex Admin</title>
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
<body>

                                <!--section containing table for client--> 
                                <div class="container" style="margin: 10px;">

                                    <!-- Table Heading -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Client Table</h6>

                                            <form style="margin-top: 25px;">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary" id="myBtn">submit</button>
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">Please input Company Name<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>      
                                            </form>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Company Name</th>
                                                            <th>Email</th>
                                                            <th>Contact Line</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Company Name</th>
                                                            <th>Email</th>
                                                            <th>Contact Line</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                        //determine the page we are currently on
                                                      if(isset($_GET['page'])){
                                                        $page_currently_on=$_GET['page'];
                                                      }else{
                                                        $page_currently_on=1;
                                                      }

                                                      //number of records we want to display per page we are on
                                                      $no_of_records_displayed_per_page=2;

                                                      //determine limit of data to show on any current page displaying
                                                      $limit_to_display=($page_currently_on-1)*$no_of_records_displayed_per_page;
                                                      
                                                      //determine the amount of data in the database
                                                      $query="SELECT * FROM prclient";
                                                      $sql=$connection->prepare($query);
                                                      $sql->execute();
                                                      $total_rows_available = $sql->rowCount();
                                                      
                                                      //total number of pages available based on rows in database
                                                      $total_no_pages_available=ceil($total_rows_available/$no_of_records_displayed_per_page);

                                                      if(isset($_GET['searchInput'])){

                                                            $searchInput = $_GET['searchInput'];
                                                            $query="SELECT * FROM prclient WHERE CLcompany_name LIKE '%$searchInput%'";
                                                            $sql=$connection->prepare($query);
                                                            $sql->execute();

                                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                                
                                                                echo"<tr><td>";
                                                                echo ($row['CLuniqueId']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLcompany_name']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLemail']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLphone_number']);
                                                                echo ("</td></tr>");
                                                                
                                                            };

                                                        }else{

                                                            $query="SELECT * FROM prclient LIMIT $limit_to_display, $no_of_records_displayed_per_page";
                                                            $sql=$connection->prepare($query);
                                                            $sql->execute();

                                                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                                
                                                                echo"<tr><td>";
                                                                echo ($row['CLuniqueId']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLcompany_name']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLemail']);
                                                                echo ("</td><td>");
                                                                echo ($row['CLphone_number']);
                                                                echo ("</td></tr>");
                                                                
                                                            };

                                                            $v=1;
                                                            echo  '<ul class="pagination">';
                                                            echo '<li class="page-item"><a class="page-link" href="test.php?page='.$page_currently_on-$v.'">Prev</a></li>';

                                                            for ($page=1; $page<=$total_no_pages_available; $page++) {

                                                                 echo '<li class="page-item"><a class="page-link" href="test.php?page='.$page.'">'.$page.'</a></li>'; 
                                                             }

                                                            echo '<li class="page-item"><a class="page-link" href="test.php?page='.$page_currently_on+$v.'">Next</a></li>';
                                                            echo  '</ul>'; 
                                                    
                                                        }
                                                        
                                                    ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!--section containing table for contractor--> 
                                <div class="container" style="margin: 10px;">

                                    <!-- Table Heading -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Contractor Table</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Company Name</th>
                                                            <th>Email</th>
                                                            <th>Contact Line</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Company Name</th>
                                                            <th>Email</th>
                                                            <th>Contact Line</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <?php
                                                        //determine the page we are currently on
                                                      if(isset($_GET['page2'])){
                                                        $page_currently_on2=$_GET['page2'];
                                                      }else{
                                                        $page_currently_on2=1;
                                                      }

                                                      //number of records we want to display per page we are on
                                                      $no_of_records_displayed_per_page=2;

                                                      //determine limit of data to show on any current page displaying
                                                      $limit_to_display=($page_currently_on2-1)*$no_of_records_displayed_per_page;
                                                      
                                                      //determine the amount of data in the database
                                                      $query="SELECT * FROM prcontractor";
                                                      $sql=$connection->prepare($query);
                                                      $sql->execute();
                                                      $total_rows_available = $sql->rowCount();
                                                      
                                                      //total number of pages available based on rows in database
                                                      $total_no_pages_available=ceil($total_rows_available/$no_of_records_displayed_per_page);
                                                        $query="SELECT * FROM prcontractor LIMIT $limit_to_display, $no_of_records_displayed_per_page";
                                                        $sql=$connection->prepare($query);
                                                        $sql->execute();

                                                        while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                                            
                                                            echo"<tr><td>";
                                                            echo ($row['CNuniqueId']);
                                                            echo ("</td><td>");
                                                            echo ($row['CNcompany_name']);
                                                            echo ("</td><td>");
                                                            echo ($row['CNemail']);
                                                            echo ("</td><td>");
                                                            echo ($row['CNphone_number']);
                                                            echo ("</td></tr>");
                                                            
                                                        };
                                                        
                                                    ?>
                                                    </tbody>
                                                </table>
                                                <?php
                                                    $v=1;
                                                    echo  '<ul class="pagination">';
                                                    echo '<li class="page-item"><a class="page-link" href="test.php?page2='.$page_currently_on2-$v.'">Prev</a></li>';

                                                    for ($page2=1; $page2<=$total_no_pages_available; $page2++) {

                                                         echo '<li class="page-item"><a class="page-link" href="test.php?page2='.$page2.'">'.$page2.'</a></li>'; 
                                                     }

                                                    echo '<li class="page-item"><a class="page-link" href="test.php?page2='.$page_currently_on2+$v.'">Next</a></li>';
                                                    echo  '</ul>'; 
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

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