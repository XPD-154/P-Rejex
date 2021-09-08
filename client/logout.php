<?php

  //start database connection

  include ("../connection.php");
 

  if (isset($_POST['log_out'])) {
      
      //determine user that enters the visitors log
      $_SESSION['user']=$_SESSION['CLuniqueID'];
      $_SESSION['message']="Logged out";

      //store users activity using this php file
      include 'user_activity_log_cl.php';

      header('location: ../logout.php');
      return;
  }
?>