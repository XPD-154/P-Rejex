<?php

  //start database connection

  include ("../connection.php");
 

  if (isset($_POST['log_out'])) {
      
      //determine user that enters the visitors log
      $_SESSION['user']=$_SESSION['CNuniqueID'];
      $_SESSION['message']="Logged out";

      //store users activity using this php file
      include 'user_activity_log_cn.php';

      header('location: ../logout.php');
      return;
  }
?>