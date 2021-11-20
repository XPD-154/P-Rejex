<?php
  
    //start database connection

    include ("../connection.php");

    //start session connection

    session_start();  

    //logout from dashboard and log that activity

    include ("logout.php"); 

    //retrive information from contractor table 

    $CNuniqueID=$_SESSION['CNuniqueID'];
    $query="SELECT * FROM PRcontractor WHERE CNuniqueId = '$CNuniqueID' LIMIT 1";
    $sql=$connection->prepare($query);
    $sql->execute();
    while($row=$sql->fetch(PDO::FETCH_ASSOC)){

        $_SESSION['CNcompany_name'] = $row['CNcompany_name'];
        $_SESSION['CNemail'] = $row['CNemail'];
        $_SESSION['CNphone_number'] = $row['CNphone_number'];
    }

    //link to header file
    include ("header_co.php");
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!--link to file containing menu and sidebar-->
		<?php include ("menu_sidebar_co.php"); ?>

                <!--section for introductory banner-->
                <section id="contractorBanner">
                    <div class="banner-text">
                        <h1>Welcome to P-Rejex</h1>
                        <hr>
                        <p>Lets help you get your dream projects and contracts in the quickest and most efficient manner</p>
                    </div>
                </section>
                <!--end of section for introductory banner-->

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

                <!--section containing error alert-->
                <div id="error" style="padding: 10px;" class="text-center">
                    <?php 

                    if(isset($_SESSION['error'])){

                        echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                  <strong>'.$_SESSION['error'].'!</strong>check results
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                               </div>');
                        unset($_SESSION['error']);
                    }
                    
                    ?>          
                </div>
                <!--end of section containing error alert-->

                <!--section containing accordion for contractor--> 
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

    <!--link to file containing user profile modal--> 
    <?php include ("user_profile_co.php"); ?>

    <!--link to file containing footer file-->
    <?php include ("footer_co.php"); ?>