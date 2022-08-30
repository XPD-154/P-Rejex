<?php

//start database connection

include ("connection.php");

//start session connection

session_start();

/*
if (!$_SESSION['forgot_password_admin'] || !$_SESSION['forgot_password']){

      header('location:index.php');
      return;
}
*/

include("header.php");
?>

<!--Contact us message section-->
<section id="contactUsMessageSection">

    <div class="container">
        <div class="p-5">

            <div class="text-center">
              <h3>Reset Password</h3>
            </div>

            <!--section containing Error alerts-->
            <div id="error">
                <?php
                    if(isset($_SESSION['error'])){

                        echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'.$_SESSION['error'].'!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                        unset($_SESSION['error']);
                    }
                ?>
            </div>
            <!--end of section containing Error alerts-->

            <!--section containing Success alerts-->
            <div id="success">
                <?php
                    if(isset($_SESSION['success'])){

                        echo ('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>'.$_SESSION['success'].'!</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

                        unset($_SESSION['success']);
                    }
                ?>
            </div>
            <!--end section containing Success alerts-->

            <?php

                //forgot password admin
                //step 1
                if(isset($_SESSION['forgot_password_admin'])){

                    echo '<form method="POST" style="margin-top: 20px">
                            <div class="form-floating mb-3">
                                <input type="email" name="admin_email" placeholder="Email address" class="form-control" id="floatingInput">
                                <label for="floatingInput">Email Address</label>
                            </div>

                            <div class="input-group mt-3">
                                <button class="btn btn-primary" type="submit" name="f_p_a_submit">Confirm</button>
                            </div>
                        </form>';

                    unset($_SESSION['forgot_password_admin']);
                }

                //step 2
                if(isset($_POST['f_p_a_submit'])){

                        $_SESSION['admin_email'] = $_POST['admin_email'];

                        //select all the columns from PRadmin table where the row is equal to inserted email
                        $query="SELECT * FROM PRadmin WHERE admin_email = :admin_email";
                        $sql=$connection->prepare($query);
                        $sql->execute(array(':admin_email'=>$_POST['admin_email']));
                        $row=$sql->fetch(PDO::FETCH_ASSOC);

                        //check if row exists
                        if($row){

                            $_SESSION['adminID'] = $row['adminID'];

                            echo '<form method="POST" style="margin-top: 20px">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_admin_password_1" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_admin_password_2" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>

                                    <div class="input-group mt-3">
                                        <button class="btn btn-primary" type="submit" name="f_p_confirm">Change</button>
                                    </div>
                                </form>';

                        }else{

                            $_SESSION['error'] = "Account does not exist";
                            header('location: forgot_password.php');
                            return;
                        }

                }

                //step 3
                if(isset($_POST['f_p_confirm'])){

                        //$_SESSION['success'] = "change confirmed!!!";

                        if($_POST['new_admin_password_1'] == $_POST['new_admin_password_2']){

                            //$_SESSION['success'] = "password checked";

                            $modifiedPassword = md5(md5($_SESSION['adminID'].$_POST['new_admin_password_1']));

                            $query="UPDATE PRadmin SET admin_password = :new_admin_password WHERE admin_email = :admin_email";
                            $sql=$connection->prepare($query);
                            $sql->execute(array(':new_admin_password'=>$modifiedPassword,
                                                ':admin_email'=>$_SESSION['admin_email']));

                            //alert for sucessful added admin details
                            $_SESSION['success'] = "Sucessfully updated password!!!";
                            header('location: index.php');
                            return;

                        }else{

                            $_SESSION['error'] = "Re-enter password";
                            header('location: forgot_password.php');
                            return;
                        }

                }
            ?>

        </div>
    </div>

</section>
<!--end of Contact us message section-->


