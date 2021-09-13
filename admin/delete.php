<?php
//connection
include ("../connection.php");
//session start
session_start();

if(isset($_GET['user'])){

        if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $user=$_POST['user'];

        if($delete!="" && $user!=""){

            $query="DELETE FROM visitor_activity_logs WHERE user = :user";
            $sql=$connection->prepare($query);
            $sql->execute(array(':user'=>$user));
            $_SESSION['success']="Sucessfully deleted";
            header('location: index.php');
            return;
        }else{
            
            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }

}
if(isset($_GET['CLuniqueId'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $CLuniqueId=$_POST['CLuniqueId'];

        if($delete!="" && $CLuniqueId!=""){

            $query="DELETE FROM prclient WHERE CLuniqueId = :CLuniqueId";
            $sql=$connection->prepare($query);
            $sql->execute(array(':CLuniqueId'=>$CLuniqueId));
            $_SESSION['success']="Sucessfully deleted";
            header('location: client.php');
            return;
        }else{
            
            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" type="text/css" href="../css/style.css"> <!--link to css stylesheet for project-->
    
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

		<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../img/Untitled-5.png" id="navBarAnchorImg" style="width: 35px; height: 35px;">
                </div>
                <div class="sidebar-brand-text mx-3">P-Rejex Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Users
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClient"
                    aria-expanded="true" aria-controls="collapseClient">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Clients</span>
                </a>
                <div id="collapseClient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Projects Information:</h6>
                        <a class="collapse-item" href="addprojectform.php">Add Project</a>
                        <a class="collapse-item" href="viewprojects.php">View Projects</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContractor"
                    aria-expanded="true" aria-controls="collapseContractor">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Contractors</span>
                </a>
                <div id="collapseContractor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tenders Information:</h6>
                        <a class="collapse-item" href="addtenderform.php">Add Tender</a>
                        <a class="collapse-item" href="viewtenders.php">View Tender</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Activities
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Projects</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">PQ information:</h6>
                        <a class="collapse-item" href="viewresults.php">View Results</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTender"
                    aria-expanded="true" aria-controls="collapseTender">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tenders</span>
                </a>
                <div id="collapseTender" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Content:</h6>
                        <a class="collapse-item" href="messageus.php">Message</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePreq"
                    aria-expanded="true" aria-controls="collapsePreq">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Prequalification</span>
                </a>
                <div id="collapsePreq" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Content:</h6>
                        <a class="collapse-item" href="messageus.php">Message</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">
                                    <?php
                                        $query = "SELECT * FROM PRadminmessage";
                                        $sql = $connection->prepare($query);
                                        $sql->execute();
                                        $rowCount = $sql->rowCount();
                                        echo $rowCount;
                                    ?>
                                </span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <?php
                                    $query = "SELECT * FROM PRadminmessage LIMIT 4";
                                    $sql = $connection->prepare($query);
                                    $sql->execute();
                                    while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                        echo '<a class="dropdown-item d-flex align-items-center" href="#">';
                                        echo '<div class="font-weight-bold">';
                                        echo ('<div class="text-truncate">'.$row['message'].'</div>');
                                        echo ('<div class="small text-gray-500">'.$row['useruniqueId'].'</div>');
                                        echo '</div></a>';

                                    };
                                    
                                ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>User ID: </b><?php echo $_SESSION['adminID']; ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->


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

                <!--section for error alert-->
                <div id="error" style="padding: 10px;" class="text-center">
                   <?php
                    if(isset($_SESSION['error'])){

                        echo ('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <strong>'.$_SESSION['error'].'!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>');
                        unset($_SESSION['error']);
                    }
                   ?> 
                </div>
                <!--end of section for error alert-->

                <!--section with form for the confirmation of delete-->
                <div class="container">
	                <form method="POST">
	                	<?php

                            if(isset($_GET['user'])) {

                                $query="SELECT * FROM visitor_activity_logs WHERE user = :user";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':user'=>$_GET['user']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this user log information?</h3>';
                                echo '<p>User ID: '.$row['user'].'</p>';
                                echo '<p>Message: '.$row['message'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="user" value="'.$row['user'].'">';

                            }
                            if(isset($_GET['CLuniqueId'])) {
                                
                                $query="SELECT * FROM prclient WHERE CLuniqueId = :CLuniqueId";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':CLuniqueId'=>$_GET['CLuniqueId']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this client information?</h3>';
                                echo '<p>Client ID: '.$row['CLuniqueId'].'</p>';
                                echo '<p>Company Name: '.$row['CLcompany_name'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="CLuniqueId" value="'.$row['CLuniqueId'].'">';
                            }
    						
                        ?>
					</form>
				</div>
				<!--end section with form for the confirmation of delete-->
               
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
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
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
                            //populate the information about user based on the uniqueID
                            $adminID=$_SESSION['adminID'];
                            $query="SELECT * FROM pradmin WHERE adminID = '$adminID' LIMIT 1";
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                echo "Admin Email: ".$row['admin_email']."<br>";
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

	
	