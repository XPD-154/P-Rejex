<?php
//connection
include ("../connection.php");
//session start
session_start();

//delete from log activity table
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

//delete from client table
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

//delete from contractor table
if(isset($_GET['CNuniqueId'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $CNuniqueId=$_POST['CNuniqueId'];

        if($delete!="" && $CNuniqueId!=""){

            $query="DELETE FROM prcontractor WHERE CNuniqueId = :CNuniqueId";
            $sql=$connection->prepare($query);
            $sql->execute(array(':CNuniqueId'=>$CNuniqueId));
            $_SESSION['success']="Sucessfully deleted";
            header('location: contractor.php');
            return;

        }else{

            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }
}

//delete from project table
if(isset($_GET['projectID'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $projectID=$_POST['projectID'];

        if($delete!="" && $projectID!=""){

            $query="DELETE FROM prproject WHERE projectID = :projectID";
            $sql=$connection->prepare($query);
            $sql->execute(array(':projectID'=>$projectID));
            $_SESSION['success']="Sucessfully deleted";
            header('location: project.php');
            return;

        }else{

            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }
}

//delete from tender table
if(isset($_GET['tenderID'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $tenderID=$_POST['tenderID'];

        if($delete!="" && $tenderID!=""){

            $query="DELETE FROM prtender WHERE tenderID = :tenderID";
            $sql=$connection->prepare($query);
            $sql->execute(array(':tenderID'=>$tenderID));
            $_SESSION['success']="Sucessfully deleted";
            header('location: tender.php');
            return;

        }else{

            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }
}

//delete from prequalification table
if(isset($_GET['resultID'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $resultID=$_POST['resultID'];

        if($delete!="" && $resultID!=""){

            $query="DELETE FROM prtender WHERE resultID = :resultID";
            $sql=$connection->prepare($query);
            $sql->execute(array(':resultID'=>$resultID));
            $_SESSION['success']="Sucessfully deleted";
            header('location: prequalification.php');
            return;

        }else{

            $_SESSION['error']="Delete unsucessful";
            header('location: delete.php');
            return;
        }
    }
}

//delete from pradminmessage table (admin inbox)
if(isset($_GET['messageID'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $messageID=$_POST['messageID'];

        if($delete!="" && $messageID!=""){

            $query="DELETE FROM pradminmessage WHERE messageID = :messageID";
            $sql=$connection->prepare($query);
            $sql->execute(array(':messageID'=>$messageID));
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

//delete from prmessage table (admin outbox)
if(isset($_GET['messageOutID'])) {

    if(isset($_POST['delete'])){

        $delete=$_POST['delete'];
        $messageOutID=$_POST['messageOutID'];

        if($delete!="" && $messageOutID!=""){

            $query="DELETE FROM prmessage WHERE messageOutID = :messageOutID";
            $sql=$connection->prepare($query);
            $sql->execute(array(':messageOutID'=>$messageOutID));
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
                            //fetch to display information for activity logs table
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

                            //fetch to display information for client table
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

                            //fetch to display information for contractor table
                            if(isset($_GET['CNuniqueId'])) {

                                $query="SELECT * FROM prcontractor WHERE CNuniqueId = :CNuniqueId";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':CNuniqueId'=>$_GET['CNuniqueId']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this contractor information?</h3>';
                                echo '<p>Client ID: '.$row['CNuniqueId'].'</p>';
                                echo '<p>Company Name: '.$row['CNcompany_name'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="CNuniqueId" value="'.$row['CNuniqueId'].'">';
                            }

                            //fetch to display information for project table
                            if(isset($_GET['projectID'])) {

                                $query="SELECT * FROM prproject WHERE projectID = :projectID";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':projectID'=>$_GET['projectID']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this project information?</h3>';
                                echo '<p>Project ID: '.$row['projectID'].'</p>';
                                echo '<p>Project Name: '.$row['project_name'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="projectID" value="'.$row['projectID'].'">';
                            }

                            //fetch to display information for tender table
                            if(isset($_GET['tenderID'])) {

                                $query="SELECT * FROM prtender WHERE tenderID = :tenderID";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':tenderID'=>$_GET['tenderID']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this tender information?</h3>';
                                echo '<p>Tender ID: '.$row['tenderID'].'</p>';
                                echo '<p>Project Name: '.$row['project_name'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="tenderID" value="'.$row['tenderID'].'">';
                            }

                            //fetch to display information for prequalification table
                            if(isset($_GET['resultID'])) {

                                $query="SELECT * FROM prprequalification WHERE resultID = :resultID";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':resultID'=>$_GET['resultID']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this prequalification result?</h3>';
                                echo '<p>Result ID: '.$row['resultID'].'</p>';
                                echo '<p>Company Name: '.$row['CNcompany_name'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="resultID" value="'.$row['resultID'].'">';
                            }

                            //fetch to display information for pradminmessage table (inbox)
                            if(isset($_GET['messageID'])) {

                                $query="SELECT * FROM pradminmessage WHERE messageID = :messageID";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':messageID'=>$_GET['messageID']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this message?</h3>';
                                echo '<p>User ID: '.$row['useruniqueId'].'</p>';
                                echo '<p>Subject: '.$row['subject'].'</p>';
                                echo '<p>Message: '.$row['message'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="Delete">';
                                echo '<input type="hidden" name="messageID" value="'.$row['messageID'].'">';
                            }

                            //fetch to display information for prmessage table (outbox)
                            if(isset($_GET['messageOutID'])) {

                                $query="SELECT * FROM prmessage WHERE messageOutID = :messageOutID";
                                $sql=$connection->prepare($query);
                                $sql->execute(array(':messageOutID'=>$_GET['messageOutID']));
                                $row=$sql->fetch(PDO::FETCH_ASSOC);

                                echo '<h3>Are you sure you want to delete this message?</h3>';
                                echo '<p>User ID: '.$row['useruniqueOutId'].'</p>';
                                echo '<p>Subject: '.$row['subjectOut'].'</p>';
                                echo '<p>Message: '.$row['messageOut'].'</p>';
                                echo '<input class="btn btn-primary" type="submit" name="delete" value="delete">';
                                echo '<input type="hidden" name="messageOutID" value="'.$row['messageOutID'].'">';
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


    <!--link to file containing user profile modal-->
    <?php include ("user_profile_ad.php"); ?>

    <!--link to file containing footer-->
    <?php include ("footer_ad.php"); ?>
