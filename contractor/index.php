<?php
  
    //start database connection

    include ("../connection.php");

    //start session connection

    session_start();  

    $CNuniqueID=$_SESSION['CNuniqueID'];
    $query="SELECT * FROM PRcontractor WHERE CNuniqueId = '$CNuniqueID' LIMIT 1";
    $sql=$connection->prepare($query);
    $sql->execute();
    while($row=$sql->fetch(PDO::FETCH_ASSOC)){

        $_SESSION['CNcompany_name'] = $row['CNcompany_name'];
        $_SESSION['CNemail'] = $row['CNemail'];
        $_SESSION['CNphone_number'] = $row['CNphone_number'];
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
    <style type="text/css">

       
    </style>
    
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

		<!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../img/Untitled-5.png" id="navBarAnchorImg" style="width: 35px; height: 35px;">
                </div>
                <div class="sidebar-brand-text mx-3">P-Rejex Contractor</div>
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
                Activities
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClient"
                    aria-expanded="true" aria-controls="collapseClient">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Project</span>
                </a>
                <div id="collapseClient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Projects Information:</h6>
                        <a class="collapse-item" href="viewprojects.php">View Projects</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContractor"
                    aria-expanded="true" aria-controls="collapseContractor">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tender</span>
                </a>
                <div id="collapseContractor" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Tenders Information:</h6>
                        <a class="collapse-item" href="viewtenders.php">View Tender</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interactions
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Prequalification</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">PQ Information:</h6>
                        <a class="collapse-item" href="viewresults.php">View Result</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Message Us</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Content:</h6>
                        <a class="collapse-item" href="messageus.php">Message Us</a>
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

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><b>User ID: </b><?php echo $_SESSION['CNuniqueID']; ?></span>
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

                <!--section for introductory banner-->
                <section id="contractorBanner">
                    <div class="banner-text">
                        <h1>Welcome to P-Rejex</h1>
                        <hr>
                        <p>Lets help you get your dream projects and contracts in the quickest and most efficient manner</p>
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

                <!--section containing accordion for client--> 
                <section class="container" id="contractorAccordion">
                    <center>
                        <h1>What exactly can i do as a Contractor?</h1>
                        <hr>
                        <p>simple steps to take</p>
                    </center>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Number 1
                          </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                          <div class="accordion-body">
                            <strong>Concerning Projects and Tenders:</strong> Check to see available projects/tenders from the sidebar and ensure your eligibility!!!
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Number 2
                          </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                          <div class="accordion-body">
                            <strong>Concerning Prequalification:</strong> Next, having examining the Tender documentation available and assertained your eligibility, engage the Prequalification process with the start button besides the tender.<br> Any attempt to retake the prequalification more than once for a particular project results in disqualification. 
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Number 3
                          </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                          <div class="accordion-body">
                            <strong>Concerning Results:</strong> Check result of evaluation or Prequalification process from the sidebar.....Thank you for your time.
                          </div>
                        </div>
                      </div>
                    </div>
                </section>
                <!--section containing accordion for client--> 

                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                  <h2 class="text-center">Testimonials</h2>
                  <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        It is a technique for guaranteeing that a contractor can execute the allocated venture as per the customer and undertaking goals. Prequalification and offer assessments are right now utilized in numerous nations. In Nigeria, for example, this activity is named the "Due Process" and includes various kinds of rules to assess the general reasonableness of contractual workers
                        <div class="text-center">
                            <div>
                                <div>
                                    <img class="img-profile rounded-circle" src="../img/igho.png" style="height: 40px; width: 40px;">
                                </div>
                                <div>
                                    <strong>Eddy Kate</strong><br>Researcher, XYZ Inc.
                                </div>
                            </div>
                            <i class="fa fa-twitter fa-lg"></i>
                        </div> 
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        It is a technique for guaranteeing that a contractor can execute the allocated venture as per the customer and undertaking goals. Prequalification and offer assessments are right now utilized in numerous nations. In Nigeria, for example, this activity is named the "Due Process" and includes various kinds of rules to assess the general reasonableness of contractual workers
                        <div class="text-center">
                            <div>
                                <div>
                                    <img class="img-profile rounded-circle" src="../img/igho.png" style="height: 40px; width: 40px;">
                                </div>
                                <div>
                                    <strong>Eddy Kate</strong><br>Researcher, XYZ Inc.
                                </div>
                            </div>
                            <i class="fa fa-twitter fa-lg"></i>
                        </div> 
                    </div>
                    <div class="carousel-item">
                        It is a technique for guaranteeing that a contractor can execute the allocated venture as per the customer and undertaking goals. Prequalification and offer assessments are right now utilized in numerous nations. In Nigeria, for example, this activity is named the "Due Process" and includes various kinds of rules to assess the general reasonableness of contractual workers
                        <div class="text-center">
                            <div>
                                <div>
                                    <img class="img-profile rounded-circle" src="../img/igho.png" style="height: 40px; width: 40px;">
                                </div>
                                <div>
                                    <strong>Eddy Kate</strong><br>Researcher, XYZ Inc.
                                </div>
                            </div>
                            <i class="fa fa-twitter fa-lg"></i>
                        </div> 
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
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
                            $CNuniqueID=$_SESSION['CNuniqueID'];
                            $query="SELECT * FROM PRcontractor WHERE CNuniqueId = '$CNuniqueID' LIMIT 1";
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                echo "Company Name: ".$row['CNcompany_name']."<br>";
                                echo "Company Email: ".$row['CNemail']."<br>";
                                echo "Company Phone Number: ".$row['CNphone_number']."<br>";

                                $_SESSION['CNcompany_name'] = $row['CNcompany_name'];
                                $_SESSION['CNemail'] = $row['CNemail'];
                                $_SESSION['CNphone_number'] = $row['CNphone_number'];
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