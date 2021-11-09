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

                <!--section for introductory banner-->
                <section id="clientBanner">
                    <div class="banner-text">
                        <h1>Welcome to P-Rejex</h1>
                        <hr>
                        <p>Lets help you get your projects and tender offers out there</p>
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
                <section class="container" id="clientAccordion">
                    <center>
                        <h1>What exactly can i do as a Client?</h1>
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
                            <strong>Concerning Projects:</strong> Simple start by creating a Project by clicking on the button on the side bar. Another button on the sidebar can be used to view projects created. Please make sure to create tender for Project create immediately!!!
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
                            <strong>Concerning Tenders:</strong> Next create a Tender to be published for the contractor's viewing by clicking on the button on the sidebar. it should contain the following;<br>
                                <ul>
                                    <li>Introduction</li>
                                    <li>Scope of Work</li>
                                    <li>Eligibility Criteria</li>
                                    <li>List of Works for Tender</li>
                                    <li>Tender Evaluation Procedure and Method</li>
                                    <li>Submission Closing Date</li>
                                    <li>Bid Opening Date</li>
                                    <li>Any Other Information</li>
                                    <li>Disclaimer</li>
                                </ul>
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
                            <strong>Concerning Results:</strong> Check result of evaluation or Prequalification process before finally awarding.....Thank you for your time
                          </div>
                        </div>
                      </div>
                    </div>
                </section>
                <!--end of section containing accordion for client--> 

                <!--testimonial carousel-->
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
                <!--end of testimonial carousel-->

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

    <!--reference to file containing scroll button at the buttom, logout button and profile button on top-->
    <?php include("user_profile_cl.php"); ?>

    <!--reference to footer-->
    <?php include("footer_cl.php"); ?>