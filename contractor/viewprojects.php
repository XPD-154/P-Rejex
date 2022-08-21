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

                    <!-- Heading -->
                    <h1 class="m-0 font-weight-bold text-secondary">Available Projects</h1>

                    <form style="margin-top: 25px;">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="search" name="searchInput" id="myInput">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary" id="myBtn">submit</button>
                            </div>
                        </div>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">Please input a location<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                    </form>
                    <?php

                        //check if the search button has been inserted
                        if(isset($_GET['searchInput'])){
                            $searchInput = $_GET['searchInput']; //search input variable for project location
                            echo ('<div style="display: flex; flex-wrap: wrap;">');
                            $query="SELECT * FROM PRproject WHERE project_location LIKE '%$searchInput%'"; //select all cards where search input variable is similar to the project location on the card
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                echo ('<div class="card border-dark mb-3 ml-3" style="width: 18rem;">');
                                echo ('<div class="card-header">Project</div>');
                                echo ('<div class="card-body text-dark">');
                                echo ('<h5 class="card-title">');
                                echo ('Title: '.$row['project_name']);
                                echo ('</h5>');
                                echo ('<p class="card-text">');
                                echo ('Type: '.$row['project_type']);
                                echo ("<br>");
                                echo ('Location: '.$row['project_location']);
                                echo ("<br>");
                                echo ('Estimated Budget: '.$row['project_est_bugt']);
                                echo ('</p></div></div>');
                            }
                            echo ('</div>');

                        }else{

                            //else show all projects available
                            echo ('<div style="display: flex; flex-wrap: wrap;">');
                            $query="SELECT * FROM PRproject";
                            $sql=$connection->prepare($query);
                            $sql->execute();
                            while($row=$sql->fetch(PDO::FETCH_ASSOC)){

                                echo ('<div class="card border-dark mb-3 ml-3" style="width: 18rem;">');
                                echo ('<div class="card-header">Project</div>');
                                echo ('<div class="card-body text-dark">');
                                echo ('<h5 class="card-title">');
                                echo ('Title: '.$row['project_name']);
                                echo ('</h5>');
                                echo ('<p class="card-text">');
                                echo ('Type: '.$row['project_type']);
                                echo ("<br>");
                                echo ('Location: '.$row['project_location']);
                                echo ("<br>");
                                echo ('Estimated Budget: '.$row['project_est_bugt']);
                                echo ('</p></div></div>');
                            }
                            echo ('</div>');
                        }

                    ?>
                </div>

            </div>
            <!-- End of Main Content -->

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
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!--link to file containing user profile modal-->
    <?php include ("user_profile_co.php"); ?>

    <!--link to file containing footer file-->
    <?php include ("footer_co.php"); ?>
