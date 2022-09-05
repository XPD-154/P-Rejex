<?php

//start database connection

include ("connection.php");

//start session connection

session_start();

include("header.php");
?>


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

                    $_SESSION['forgot_password'] = "stay";

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
                //forgot password client
                //step 1
                elseif(isset($_SESSION['forgot_password_cl'])){

                    $_SESSION['forgot_password'] = "stay";

                    echo '<form method="POST" style="margin-top: 20px">
                            <div class="form-floating mb-3">
                                <input type="email" name="CLemail" placeholder="Email address" class="form-control" id="floatingInput">
                                <label for="floatingInput">Email Address</label>
                            </div>

                            <div class="input-group mt-3">
                                <button class="btn btn-primary" type="submit" name="f_p_cl_check">Confirm</button>
                            </div>
                        </form>';

                    unset($_SESSION['forgot_password_cl']);
                }
                //forgot password contractor
                //step 1
                elseif(isset($_SESSION['forgot_password_cn'])){

                    $_SESSION['forgot_password'] = "stay";

                    echo '<form method="POST" style="margin-top: 20px">
                            <div class="form-floating mb-3">
                                <input type="email" name="CNemail" placeholder="Email address" class="form-control" id="floatingInput">
                                <label for="floatingInput">Email Address</label>
                            </div>

                            <div class="input-group mt-3">
                                <button class="btn btn-primary" type="submit" name="f_p_cn_check">Confirm</button>
                            </div>
                        </form>';

                    unset($_SESSION['forgot_password_cn']);
                }
                //check if any variable for insert password has been inserted
                elseif(!isset($_SESSION['forgot_password'])){

                    header('location:index.php');
                    return;
                }

                //forgot password admin
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

                            echo '<form method="POST" style="margin-top: 20px" onsubmit="return validateForm()" name="Form">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_admin_password_1" id="new_admin_password_1" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="new_admin_password_2" id="new_admin_password_2" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>
                                    <div class="input-group mt-3">
                                        <button class="btn btn-primary" type="submit" name="f_p_confirm">Change</button>
                                    </div>
                                </form>';

                            //validation for password
                            echo '<script type="text/javascript">

                                    function validateForm(){
                                        var a=document.forms["Form"]["new_admin_password_1"].value;
                                        var b=document.forms["Form"]["new_admin_password_2"].value;

                                        if (a=="" || b==""){
                                            var errorEntered = "Please Fill All Required Field";
                                            document.getElementById("error").innerHTML= errorEntered;
                                            return false;
                                        }
                                        if (a!==b){
                                            var errorEntered = "Please check password";
                                            document.getElementById("error").innerHTML= errorEntered;
                                            return false;
                                        }
                                    }

                                </script>';

                        }else{

                            $_SESSION['error'] = "Account does not exist";
                            header('location: forgot_password.php');
                            return;
                        }

                }
                //forgot password admin
                //step 3
                if(isset($_POST['f_p_confirm'])){


                    $modifiedPassword = md5(md5($_SESSION['adminID'].$_POST['new_admin_password_1']));

                    //update the PRadmin with new password
                    $query="UPDATE PRadmin SET admin_password = :new_admin_password WHERE admin_email = :admin_email";
                    $sql=$connection->prepare($query);
                    $sql->execute(array(':new_admin_password'=>$modifiedPassword,
                                        ':admin_email'=>$_SESSION['admin_email']));

                    //alert for sucessful added admin details
                    $_SESSION['success'] = "Sucessfully updated password!!!";
                    header('location: index.php');
                    return;



                }

                //forgot password client
                //step 2
                if(isset($_POST['f_p_cl_check'])){

                        $_SESSION['CLemail'] = $_POST['CLemail'];

                        //select all the columns from PRclient table where the row is equal to inserted email
                        $query="SELECT * FROM PRclient WHERE CLemail = :CLemail";
                        $sql=$connection->prepare($query);
                        $sql->execute(array(':CLemail'=>$_POST['CLemail']));
                        $row=$sql->fetch(PDO::FETCH_ASSOC);

                        //check if row exists
                        if($row){

                            $_SESSION['clientID'] = $row['clientID'];

                            echo '<form method="POST" style="margin-top: 20px" onsubmit="return validateForm()" name="Form">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="NewCLpassword_1" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="NewCLpassword_2" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>

                                    <div class="input-group mt-3">
                                        <button class="btn btn-primary" type="submit" name="f_p_cl_confirm">Change</button>
                                    </div>
                                </form>';

                            //validation for password
                            echo '<script type="text/javascript">

                                function validateForm(){
                                    var a=document.forms["Form"]["NewCLpassword_1"].value;
                                    var b=document.forms["Form"]["NewCLpassword_2"].value;

                                    if (a=="" || b==""){
                                        var errorEntered = "Please Fill All Required Field";
                                        document.getElementById("error").innerHTML= errorEntered;
                                        return false;
                                    }
                                    if (a!==b){
                                        var errorEntered = "Please check password";
                                        document.getElementById("error").innerHTML= errorEntered;
                                        return false;
                                    }
                                }

                            </script>';

                        }else{

                            $_SESSION['error'] = "Account does not exist";
                            header('location: forgot_password.php');
                            return;
                        }

                }
                //forgot password client
                //step 3
                if(isset($_POST['f_p_cl_confirm'])){

                    $modifiedPassword = md5(md5($_SESSION['clientID']).$_POST['NewCLpassword_1']);

                    //update the PRclient with new password
                    $query="UPDATE PRclient SET CLpassword = :NewCLpassword WHERE CLemail = :CLemail";
                    $sql=$connection->prepare($query);
                    $sql->execute(array(':NewCLpassword'=>$modifiedPassword,
                                        ':CLemail'=>$_SESSION['CLemail']));

                    //alert for sucessful added admin details
                    $_SESSION['success'] = "Sucessfully updated password!!!";
                    header('location: index.php');
                    return;

                }

                //forgot password contractor
                //step 2
                if(isset($_POST['f_p_cn_check'])){

                        $_SESSION['CNemail'] = $_POST['CNemail'];

                        //select all the columns from PRadmin table where the row is equal to inserted email
                        $query="SELECT * FROM PRcontractor WHERE CNemail = :CNemail";
                        $sql=$connection->prepare($query);
                        $sql->execute(array(':CNemail'=>$_POST['CNemail']));
                        $row=$sql->fetch(PDO::FETCH_ASSOC);

                        //check if row exists
                        if($row){


                            $_SESSION['contractorID'] = $row['contractorID'];

                            echo '<form method="POST" style="margin-top: 20px" onsubmit="return validateForm()" name="Form">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="NewCNpassword_1" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" name="NewCNpassword_2" placeholder="Password" class="form-control" id="floatingInput">
                                        <label for="floatingInput">Password</label>
                                    </div>

                                    <div class="input-group mt-3">
                                        <button class="btn btn-primary" type="submit" name="f_p_cn_confirm">Change</button>
                                    </div>
                                </form>';

                            //validation for password
                            echo '<script type="text/javascript">

                                    function validateForm(){
                                        var a=document.forms["Form"]["NewCNpassword_1"].value;
                                        var b=document.forms["Form"]["NewCNpassword_2"].value;

                                        if (a=="" || b==""){
                                            var errorEntered = "Please Fill All Required Field";
                                            document.getElementById("error").innerHTML= errorEntered;
                                            return false;
                                        }
                                        if (a!==b){
                                            var errorEntered = "Please check password";
                                            document.getElementById("error").innerHTML= errorEntered;
                                            return false;
                                        }
                                    }

                                </script>';


                        }else{

                            $_SESSION['error'] = "Account does not exist";
                            header('location: forgot_password.php');
                            return;
                        }

                }
                //forgot password contractor
                //step 3
                if(isset($_POST['f_p_cn_confirm'])){

                    $modifiedPassword = md5(md5($_SESSION['contractorID']).$_POST['NewCNpassword_1']);

                    //update the PRcontractor with new password
                    $query="UPDATE PRcontractor SET CNpassword = :NewCNpassword WHERE CNemail = :CNemail";
                    $sql=$connection->prepare($query);
                    $sql->execute(array(':NewCNpassword'=>$modifiedPassword,
                                        ':CNemail'=>$_SESSION['CNemail']));

                    //alert for sucessful added admin details
                    $_SESSION['success'] = "Sucessfully updated password!!!";
                    header('location: index.php');
                    return;

                }
            ?>

        </div>
    </div>

</section>


