<?php

//start database connection

include ("connection.php");

//start session connection

session_start();

//creation of database table for prequalification process if it doesnt exist

$query = "CREATE TABLE IF NOT EXISTS PRprequalification (
                            resultID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                            project_name VARCHAR(50) NOT NULL,
                            CNuniqueId VARCHAR(50) NOT NULL,
                            CNcompany_name VARCHAR(50) NOT NULL,
                            CNemail VARCHAR(50) NOT NULL,
                            CNphone_number VARCHAR(50) NOT NULL,
                            score DECIMAL(4,2) NOT NULL,
                            verdict TEXT NOT NULL,
                            INDEX(CNuniqueId, project_name),
                            CONSTRAINT f4  
                            FOREIGN KEY (project_name)   
                            REFERENCES prproject (project_name)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE)";
$sql= $connection->prepare($query);
$sql->execute();

//alter PRprequalification by adding a foreign key to CNuniqueid
try {
    $query="ALTER TABLE PRprequalification add FOREIGN KEY(CNuniqueId) REFERENCES PRcontractor(CNuniqueId)";
    $sql= $connection->prepare($query);
    $sql->execute();
} catch (PDOException $exception) {
    if($exception->errorInfo[2] == 1061) {
        // references already exists
    } else {
        // Another error occurred
    }
}


//create a class to calculate total score after the the questions are answered
class CalculateTotal
{
    //initialize every score as a public member of the class
    public $Q1_score = "";
    public $Q2_score = "";
    public $Q3_score = "";
    public $Q4_score = "";
    public $Q5_score = ""; 
    public $Q6_score = "";
    public $Q7_score = "";
    public $Q8_score = ""; 
    public $Q9_score = "";  
    public $Q10_score = "";
    public $Q11_score = "";
    public $Q12_score = "";
    public $Q13_score = "";
    public $Q14_score = "";
    public $Q15_score = "";
    public $Q16_score = "";
    public $Q17_score = "";
    public $Q18_score = "";
    public $Q19_score = "";
    public $Q20_score = "";
    public $Q21_score = "";
    public $Q22_score = "";
    public $Q23_score = "";
    public $Q24_score = "";
    public $Q25_score = "";
    
    //create a function to get the percentage
    public function getPercentage(){
        return ((($this->Q1_score + $this->Q2_score + $this->Q3_score + $this->Q4_score + $this->Q5_score + $this->Q6_score + $this->Q7_score + $this->Q8_score + $this->Q9_score + $this->Q10_score + $this->Q11_score + $this->Q12_score + $this->Q13_score + $this->Q14_score + $this->Q15_score + $this->Q16_score + $this->Q17_score + $this->Q18_score + $this->Q19_score + $this->Q20_score + $this->Q21_score + $this->Q22_score + $this->Q23_score + $this->Q24_score + $this->Q25_score)/51)*100);

    }
 
}

//a function created for the modification of user input 
function test_input($data) {

            $data = trim($data); // strip unnecessary characters (extra space, tab, newline, etc.) from the user input data
            $data = stripslashes($data); // remove backslashes from the user input data
            $data = htmlspecialchars($data); //convert special characters to HTML entities
            return $data;
         }

//declare percentage score as an empty string
$percentageScore ="";

//declare all score variables as an empty string
$Q1 = $Q2 = $Q3 = $Q4A = $Q4B = $Q5 = $Q6 = $Q7A = $Q7B = $Q7C = $Q8 = $Q9 = $Q10 = $Q11 = $Q12 = $Q13 = $Q14 = $Q15 = $Q16 = $Q17 = $Q18 = $Q19 = $Q20 = $Q21A = $Q21B = $Q21C = $Q21D = $Q21E = $Q21F = $Q22A = $Q22B = $Q22C = $Q22D = $Q22E = $Q22F = $Q23A = $Q23B = $Q23C = $Q23D = $Q23E = $Q23F = $Q24 = $Q25 = "";


//form submission and validation
if(isset($_POST['calculateScore'])) {


    if (empty($_POST['auditedAccounts'])) {

         $_SESSION['error'] .= "A response is required for question on audited accounts <br>";
         

    }else{

        $Q1 = test_input($_POST['auditedAccounts']);

    }

    if (empty($_POST['bankingAgreement'])) {

         $_SESSION['error'] .= "A response is required for question on banking agreement <br>";
         

    }else{

        $Q2 = test_input($_POST['bankingAgreement']);

    }

    if (empty($_POST['obligations'])) {

         $_SESSION['error'] .= "A response is required for question on obligations <br>";
         

    }else{

        $Q3 = test_input($_POST['obligations']);

    }


    if(isset($_POST['TotalDebt']) && isset($_POST['TotalAssets'])){

        $Q4A = test_input($_POST['TotalDebt']);
        $Q4B = test_input($_POST['TotalAssets']);
    }

    if (empty($_POST['creditRating'])) {

         $_SESSION['error'] .= "A response is required for question on credit rating <br>";
         

    }else{

        $Q5 = test_input($_POST['creditRating']);

    }

    if (empty($_POST['employersLiabilityInsurance'])) {  

         $_SESSION['error'] .= "A response is required for question on Employers' liability insurance <br>";
         

    }else{

        $Q6 = test_input($_POST['employersLiabilityInsurance']);
    }


    if (empty($_POST['publicLiabilityInsurance'])) {  

         $_SESSION['error'] .= "A response is required for question on Public liability insurance <br>";
         

    }else{

        $Q7 = test_input($_POST['publicLiabilityInsurance']);

    }

    if (empty($_POST['NumberOfSimilarProjects'])) {

         $_SESSION['error'] .= "A response is required for question on Number Of Similar Projects <br>";
        

    }else{

        $Q8 = test_input($_POST['NumberOfSimilarProjects']);

    }

    if (empty($_POST['numberOfYears'])) {

         $_SESSION['error'] .= "A response is required for question on number of years in the construction business <br>";
         

    }else{

        $Q9 = test_input($_POST['numberOfYears']);

    }

    if (empty($_POST['NumberOfStaff'])) {

         $_SESSION['error'] .= "A response is required for question on Number Of Staff <br>";
         

    }else{

        $Q10 = test_input($_POST['NumberOfStaff']);

    }

    if (empty($_POST['HQofStaff'])) {

         $_SESSION['error'] .= "A response is required for question on Highest Qualification of Staff <br>";
         

    }else{

        $Q11 = test_input($_POST['HQofStaff']);

    }

    if (empty($_POST['contractTerminated'])) {

         $_SESSION['error'] .= "A response is required for question on contract terminated <br>";
         

    }else{

        $Q12 = test_input($_POST['contractTerminated']);

    }

    if (empty($_POST['managementCertification'])) {

         $_SESSION['error'] .= "A response is required for question on management certification <br>";
         

    }else{

        $Q13 = test_input($_POST['managementCertification']);

    }

    if (empty($_POST['managementSystem'])) {

         $_SESSION['error'] .= "A response is required for question on management system <br>";
        

    }else{

        $Q14 = test_input($_POST['managementSystem']);

    }

    if (empty($_POST['HSEpolicy'])) {

         $_SESSION['error'] .= "A response is required for question on HSE policy <br>";
        

    }else{

        $Q15 = test_input($_POST['HSEpolicy']);

    }

    if (empty($_POST['routinelyRecord'])) {

         $_SESSION['error'] .= "A response is required for question on routinely record <br>";
         

    }else{

        $Q16 = test_input($_POST['routinelyRecord']);

    }

    if (empty($_POST['HSEadvice'])) {

         $_SESSION['error'] .= "A response is required for question on HSE advice <br>";
         

    }else{

        $Q17 = test_input($_POST['HSEadvice']);

    }

    if (empty($_POST['environmentalManagementSystem'])) {

         $_SESSION['error'] .= "A response is required for question on Environmental Management System <br>";
         
    }else{

        $Q18 = test_input($_POST['environmentalManagementSystem']);

    }

    if (empty($_POST['BPS1'])) {

         $_SESSION['error'] .= "A response is required for question on BUSINESS AND PROFESSIONAL STANDING question 1 <br>";
         

    }else{

        $Q19 = test_input($_POST['BPS1']);

    }

    if (empty($_POST['BPS2'])) {

         $_SESSION['error'] .= "A response is required for question on BUSINESS AND PROFESSIONAL STANDING question 2 <br>";
         
    }else{

        $Q20 = test_input($_POST['BPS2']);

    }

    if (isset($_POST['reference1Name']) && isset($_POST['reference1ProjectName']) && isset($_POST['reference1Description']) && isset($_POST['reference1DateA']) && isset($_POST['reference1DateC']) && isset($_POST['reference1Value'])) {

        $Q21A = test_input($_POST['reference1Name']);
        $Q21B = test_input($_POST['reference1ProjectName']);
        $Q21C = test_input($_POST['reference1Description']);
        $Q21D = test_input($_POST['reference1DateA']);
        $Q21E = test_input($_POST['reference1DateC']);
        $Q21F = test_input($_POST['reference1Value']);

    }

    if (isset($_POST['reference2Name']) && isset($_POST['reference2ProjectName']) && isset($_POST['reference2Description']) && isset($_POST['reference2DateA']) && isset($_POST['reference2DateC']) && isset($_POST['reference2Value'])) {

        $Q22A = test_input($_POST['reference2Name']);
        $Q22B = test_input($_POST['reference2ProjectName']);
        $Q22C = test_input($_POST['reference2Description']);
        $Q22D = test_input($_POST['reference2DateA']);
        $Q22E = test_input($_POST['reference2DateC']);
        $Q22F = test_input($_POST['reference2Value']);

    }

    if (isset($_POST['reference3Name']) && isset($_POST['reference3ProjectName']) && isset($_POST['reference3Description']) && isset($_POST['reference3DateA']) && isset($_POST['reference3DateC']) && isset($_POST['reference3Value'])) {

        $Q23A = test_input($_POST['reference3Name']);
        $Q23B = test_input($_POST['reference3ProjectName']);
        $Q23C = test_input($_POST['reference3Description']);
        $Q23D = test_input($_POST['reference3DateA']);
        $Q23E = test_input($_POST['reference3DateC']);
        $Q23F = test_input($_POST['reference3Value']);

    }

    if (empty($_POST['externalResources'])) {

         $_SESSION['error'] .= "A response is required for question on external resources <br>";
         
    }else{

        $Q24 = test_input($_POST['externalResources']);

    }

    if (empty($_POST['storage'])) {

         $_SESSION['error'] .= "A response is required for question on storage facilities <br>";
         
    }else{

        $Q25 = test_input($_POST['storage']);

    }
      //check if every score variable is filled up
      if (!empty($Q1) && !empty($Q2) && !empty($Q3) && !empty($Q5) && !empty($Q6) && !empty($Q7) && !empty($Q8) && !empty($Q9) && !empty($Q10) && !empty($Q11) && !empty($Q12) && !empty($Q13) && !empty($Q14) && !empty($Q15) && !empty($Q16) && !empty($Q17) && !empty($Q18) && !empty($Q19) && !empty($Q20) && !empty($Q24) && !empty($Q25)){

        //create a new object
        $obj = new CalculateTotal;

        //assign the object to each member of the class to determine the mark on each variable
        $obj->Q1_score = ($Q1==1) ? 1 : 0;
        $obj->Q2_score = ($Q2==1) ? 1 : 0;
        $obj->Q3_score = ($Q3==1) ? 1 : 0;
        $obj->Q4_score = (isset($Q4A) && isset($Q4B)) ? 1 : 0; 

        if  ($Q5==1){

                $obj->Q5_score =1;

        }elseif($Q5==2){
                
                $obj->Q5_score =2;

        }elseif($Q5==3){
                
                $obj->Q5_score =3;
                
        }elseif($Q5==4){
                
                $obj->Q5_score =4;
                
        }elseif($Q5==5){
                
                $obj->Q5_score =5;
                
        }elseif($Q5==6){
                
                $obj->Q5_score =6;
                
        }elseif($Q5==7){
                
                $obj->Q5_score =7;
                
        }elseif($Q5==8){
                
                $obj->Q5_score =8;
                
        }elseif($Q5==9){
                
                $obj->Q5_score =9;
                
        } 

        $obj->Q6_score = ($Q6==1) ? 1 : 0;
        
        $obj->Q7_score = ($Q7==1) ? 1 : 0;

        if($Q8==0){

            $obj->Q8_score =0;

        }elseif($Q8>0 && $Q8<=2){

            $obj->Q8_score =1;

        }elseif($Q8>2 && $Q8<=4){

            $obj->Q8_score =2;

        }elseif($Q8>4 && $Q8<=6){

            $obj->Q8_score =3;

        }elseif($Q8>6){

            $obj->Q8_score =4;

        }

        if($Q9==0){

            $obj->Q9_score =0;

        }elseif($Q9>0 && $Q9<=2){

            $obj->Q9_score =1;

        }elseif($Q9>2 && $Q9<=4){

            $obj->Q9_score =2;

        }elseif($Q9>4 && $Q9<=6){

            $obj->Q9_score =3;

        }elseif($Q9>6){

            $obj->Q9_score =4;

        } 

        if($Q10<50){

            $obj->Q10_score =1;

        }elseif($Q10>50 && $Q10<=200){

            $obj->Q10_score =2;

        }elseif($Q10>200 && $Q10<=400){

            $obj->Q10_score =3;

        }elseif($Q10>400 && $Q10<=600){

            $obj->Q10_score =4;

        }elseif($Q10>600){

            $obj->Q10_score =5;

        }

        if  ($Q11==1){

                $obj->Q11_score =1;

        }elseif($Q11==2){
                
                $obj->Q11_score =2;

        }elseif($Q11==3){
                
                $obj->Q11_score =3;
                
        }elseif($Q11==4){
                
                $obj->Q11_score =4;
                
        }elseif($Q11==5){
                
                $obj->Q11_score =5;
                
        }elseif($Q11==6){
                
                $obj->Q11_score =6;
                
        }elseif($Q11==7){
                
                $obj->Q11_score =7;
                
        }elseif($Q11==8){
                
                $obj->Q11_score =8;
                
        }elseif($Q11==9){
                
                $obj->Q11_score =9;
                
        }  

        $obj->Q12_score = ($Q12==2) ? 1 : 0; 
        $obj->Q13_score = ($Q13==1) ? 1 : 0;
        $obj->Q14_score = ($Q14==1) ? 1 : 0; 
        $obj->Q15_score = ($Q15==1) ? 1 : 0;
        $obj->Q16_score = ($Q16==1) ? 1 : 0;
        $obj->Q17_score = ($Q17==1) ? 1 : 0;
        $obj->Q18_score = ($Q18==1) ? 1 : 0;
        $obj->Q19_score = ($Q19==2) ? 1 : 0;
        $obj->Q20_score = ($Q20==2) ? 1 : 0;
        $obj->Q21_score = (isset($Q21A) && isset($Q21B) && isset($Q21C) && isset($Q21D) && isset($Q21E) && isset($Q21F)) ? 1 : 0;
        $obj->Q22_score = (isset($Q22A) && isset($Q22B) && isset($Q22C) && isset($Q22D) && isset($Q22E) && isset($Q22F)) ? 1 : 0;
        $obj->Q23_score = (isset($Q23A) && isset($Q23B) && isset($Q23C) && isset($Q23D) && isset($Q23E) && isset($Q23F)) ? 1 : 0;
        $obj->Q24_score = ($Q24==2) ? 1 : 0;
        $obj->Q25_score = ($Q25==1) ? 1 : 0;

        //calculate percentage score
        $percentageScore .= $obj->getPercentage();

        //determine the verdict based on score
        if($percentageScore>60){

            $verdict="Qualified";

        }elseif($percentageScore<60 && $percentageScore>=1){

            $verdict="Disqualified";

        }

        //insert the information into the PRprequalification table
        $query = "INSERT INTO PRprequalification (project_name, CNuniqueId, CNcompany_name, CNemail, CNphone_number, score, verdict) VALUES (:project_name, :CNuniqueId, :CNcompany_name, :CNemail, :CNphone_number, :score, :verdict)";
        $sql = $connection->prepare($query);
        $sql->execute(array(':project_name'=>$_GET['project_name'],
                            ':CNuniqueId'=>$_SESSION['CNuniqueID'],
                            ':CNcompany_name'=>$_SESSION['CNcompany_name'],
                            ':CNemail'=>$_SESSION['CNemail'],
                            ':CNphone_number'=>$_SESSION['CNphone_number'],
                            ':score'=>$percentageScore,
                            ':verdict'=>$verdict));
        
            

    }

};


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
    <link rel="shortcut icon" type="image/jpg" href="img/Untitled-5.png"> <!--link to favicon-->

    <!--link to boostrap css file-->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"> 

    <!-- Custom fonts for this template-->
    <link href="dashboard-asserts/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="dashboard-asserts/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
    	
    </style>
</head>
<body class="bg-gradient-warning"> <!--color for the entire background-->

                <!--breadcrumb nav bar-->
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="contractor/index.php">Contractor Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Prequalification</li>
                  </ol>
                </nav>
                <!--end of breadcrumb nav bar-->

                <!--section containing prequalification process form-->
                <section class="container-fluid" id="prequalificationForm">
                     <div class="p-5">
                            
                            <!--div containing error alert-->
                            <div id="error" class="text-center">
                                <?php
                                    if(isset($_SESSION['error'])){

                                        echo ('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>'.$_SESSION['error'].'!</strong> You should check in on some of those fields below.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                        unset($_SESSION['error']);
                                    }
                                ?>
                            </div>
                            <!--end of div containing error alert-->

                            <form class="user" method="POST">
                                
                                <div id="financialSection" class="prequalificationSection">
                                    
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Financial Section</h1>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-lg-6">
                                            <label for="auditedAccounts">Can a copy of the most recent audited accounts for your organization covering either the most recent three year period of trading, or if trading for less than three years, the period that is available?</label> 
                                        </div>

                                        <div  class="col-12 col-lg-2 form-inline">
                                            <select id="auditedAccounts" name="auditedAccounts" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q1) && $Q1 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q1) && $Q1 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12 col-lg-6">
                                                   <label for="auditedAccountsInput">if yes, please provide sample documentation</label>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <input type="file" class="form-control-file" id="auditedAccountsInput" name="auditedAccountsInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="bankingAgreement">Has your organisation met the terms of its banking facilities and loan agreement (if any) during the past year</label> 
                                        </div>

                                        <div  class="col-12 col-sm-2 form-inline">
                                            <select id="bankingAgreement" name="bankingAgreement" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q2) && $Q2 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q2) && $Q2 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="obligations">Has your organisation met all its obligations to pay its creditors and staff during the past year</label>
                                        </div>

                                        <div  class="col-12 col-sm-2 form-inline">
                                            <select id="obligations" name="obligations" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q3) && $Q3 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q3) && $Q3 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <div class="col-12 col-sm-3 mb-2">
                                                <input type="text" class="form-control form-control-user" id="TotalDebt" name="TotalDebt" placeholder="Total Debt" value="<?php if($Q4A!=""){echo $Q4A;}?>"> <span class="badge rounded-pill bg-danger">impt</span>
                                            </div>

                                            <div  class="col-12 col-sm-3">
                                                <input type="text" class="form-control form-control-user" id="TotalAssets" name="TotalAssets" placeholder="Total Assets" value="<?php if($Q4B!=""){echo $Q4B;}?>"> <span class="badge rounded-pill bg-danger">impt</span>
                                            </div>
                                            <div  class="col-12 col-sm-4">
                                                <?php
                                                        if (!empty($_POST['TotalAssets']) && !empty($_POST['TotalAssets'])){

                                                            $TotalAssets = $_POST['TotalAssets'];
                                                            $TotalDebt = $_POST['TotalDebt'];
                                                            $DebitRatio = $TotalDebt/$TotalAssets;

                                                            echo " <label for='DebitRatio'>Debit Ratio is given below:</label><input type='text' class='form-control' id='DebitRatio' name='DebitRatio' value= '{$DebitRatio}'>";
                                                                   
                                                                
                                                        }
                                                ?>
                                            </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="creditRating">Credit Rating of Company</label>
                                        </div>
                                        <div class="col-12 col-sm-6 form-inline">
                                             <select class="form-select m-1" id="creditRating" name="creditRating">
                                                    <option disabled selected>select credit rating</option>
                                                    <option value="1" <?php echo (isset($Q5) && $Q5 === '1') ? 'selected':'';?>>In Default, with Little Possibility of Recovery (Between CC and C)</option>
                                                    <option value="2" <?php echo (isset($Q5) && $Q5 === '2') ? 'selected':'';?>>In or Near Default, with Possibility of Recovery (Between CC and C)</option>
                                                    <option value="3" <?php echo (isset($Q5) && $Q5 === '3') ? 'selected':'';?>>Very High Credit Risk (Between CCC+ and CCC-)</option>
                                                    <option value="4" <?php echo (isset($Q5) && $Q5 === '4') ? 'selected':'';?>>High Credit Risk (Between B+ and B-)</option>
                                                    <option value="5" <?php echo (isset($Q5) && $Q5 === '5') ? 'selected':'';?>>Substantial Credit Risk (Between BB+ to BB-)</option>
                                                    <option value="6" <?php echo (isset($Q5) && $Q5 === '6') ? 'selected':'';?>>Moderate Credit Risk (Between BBB+ and BBB-)</option>
                                                    <option value="7" <?php echo (isset($Q5) && $Q5 === '7') ? 'selected':'';?>>Low Credit Risk (Between A+ and A-)</option>
                                                    <option value="8" <?php echo (isset($Q5) && $Q5 === '8') ? 'selected':'';?>>Very Low Credit Risk (AA+)</option>
                                                    <option value="9" <?php echo (isset($Q5) && $Q5 === '9') ? 'selected':'';?>>Minimal Credit Risk (AAA)</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>    
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-3">
                                             <p>Insurance statement and Certificates</p>
                                        </div>

                                        <div class="col-12 col-sm-9">

                                            <div class="row">
                                                <div class="col-12 col-sm-3">
                                                    <p>Do you as a Contractor hold Employers Liability Insurance?</p>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <select id="employersLiabilityInsurance" name="employersLiabilityInsurance" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q6) && $Q6 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q6) && $Q6 === '2') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <p>If “Yes” please state value in Naira:</p>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <input type="text" name="employersLiabilityInsuranceAmount" class="form-control form-control-user">
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-12 col-sm-3">
                                                    <p>Do you as a Contractor hold Public Liability Insurance?</p>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <select id="publicLiabilityInsurance" name="publicLiabilityInsurance" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q7) && $Q7 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q7) && $Q7 === '2') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <p>If “Yes” please state value in Naira:</p>
                                                </div>
                                                <div class="col-12 col-sm-3">
                                                    <input type="text" name="publicLiabilityInsuranceAmount" class="form-control form-control-user">
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div id="experienceSection" class="prequalificationSection">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Experience Section</h1>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="NumberOfSimilarProjects">Number of Similar Projects Handled</label>
                                        </div>
                                        <div class="col-12 col-sm-6 form-inline">
                                            <input type="number" class="form-control form-control-user m-1" id="NumberOfSimilarProjects" name="NumberOfSimilarProjects" value="<?php if($Q8!=""){echo $Q8;}?>"> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="numberOfYears">State the number of years in the construction business and verify by submittion of the certificate of registration for business</label>
                                        </div>
                                        <div class="col-12 col-sm-3 form-inline">
                                            <input type="number" class="form-control form-control-user m-1" id="numberOfYears" name="numberOfYears" value="<?php if($Q9!=""){echo $Q9;}?>"> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                        <div class="col-12 col-sm-2">
                                            <input type="file" class="form-control-file" id="numberOfYearsInput" name="numberOfYearsInput">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <p>Please provide details of three recent contracts that are relevant to the project. Where possible at least one should be from the public sector</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive"> 
                                        <table class= "table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                  <th scope= "col" > # </th>
                                                  <th scope= "col" >Reference 1</th>
                                                  <th scope= "col" >Reference 2</th>
                                                  <th scope= "col" >Reference 3</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
                                                <tr>
                                                  <th scope= "row">Client Organisation (Name)</th>
                                                    <td><input type="text" class="form-control form-control-user" id="reference1Name" name="reference1Name" value="<?php if($Q21A!=""){echo $Q21A;}?>"></td>
                                                    <td><input type="text" class="form-control form-control-user" id="reference2Name" name="reference2Name" value="<?php if($Q22A!=""){echo $Q22A;}?>"></td>
                                                    <td><input type="text" class="form-control form-control-user" id="reference3Name" name="reference3Name" value="<?php if($Q23A!=""){echo $Q23A;}?>"></td>
                                                </tr>
                                                <tr>
                                                  <th scope= "row">Name of Project and Geographic Location</th>
                                                    <td><input type="text" class="form-control form-control-user" id="reference1ProjectName" name="reference1ProjectName" value="<?php if($Q21B!=""){echo $Q21B;}?>"></td>
                                                    <td><input type="text" class="form-control form-control-user" id="reference2ProjectName" name="reference2ProjectName" value="<?php if($Q22B!=""){echo $Q22B;}?>"></td>
                                                    <td><input type="text" class="form-control form-control-user" id="reference3ProjectName" name="reference3ProjectName" value="<?php if($Q23B!=""){echo $Q23B;}?>"></td>
                                                </tr>
                                                <tr>
                                                  <th scope= "row">Brief Description of Project (health clinics, schools, community centres, offices,.)</th>
                                                    <td><textarea class="form-control form-control-user" id="reference1Description" name="reference1Description" value="<?php if($Q21C!=""){echo $Q21C;}?>"></textarea></td>
                                                    <td><textarea class="form-control form-control-user" id="reference2Description" name="reference2Description" value="<?php if($Q22C!=""){echo $Q22C;}?>"></textarea></td>
                                                    <td><textarea class="form-control form-control-user" id="reference3Description" name="reference3Description" value="<?php if($Q23C!=""){echo $Q23C;}?>"></textarea></td>
                                                </tr>
                                                <tr>
                                                  <th scope= "row">Date Contract was Awarded</th>
                                                    <td>
                                                      <div class="input-group">
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">Date</span>
                                                        </div>
                                                        <input type="date" class="form-control form-control-user" id="reference1DateA" name="reference1DateA" value="<?php if($Q21D!=""){echo $Q21D;}?>">
                                                      </div>
                                                   </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Date</span>
                                                            </div>
                                                            <input type="date" class="form-control form-control-user" id="reference2DateA" name="reference2DateA" value="<?php if($Q22D!=""){echo $Q22D;}?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-12 input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Date</span>
                                                            </div>
                                                            <input type="date" class="form-control form-control-user" id="reference3DateA" name="reference3DateA" value="<?php if($Q23D!=""){echo $Q23D;}?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                  <th scope="row">Date Contract was Completed</th>
                                                    <td>
                                                      <div class="input-group">
                                                         <div class="input-group-append">
                                                            <span class="input-group-text">Date</span>
                                                        </div>
                                                        <input type="date" class="form-control form-control-user" id="reference1DateC" name="reference1DateC" value="<?php if($Q21E!=""){echo $Q21E;}?>">
                                                      </div>
                                                   </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Date</span>
                                                            </div>
                                                            <input type="date" class="form-control form-control-user" id="reference2DateC" name="reference2DateC" value="<?php if($Q22E!=""){echo $Q22E;}?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-12 input-group">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">Date</span>
                                                            </div>
                                                            <input type="date" class="form-control form-control-user" id="reference3DateC" name="reference3DateC" value="<?php if($Q23E!=""){echo $Q23E;}?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                  <th scope= "row">Value</th>
                                                    <td>
                                                        <div class="col-12 input-group">
                                                             <div class="input-group-append">
                                                                <span class="input-group-text">&#8358</span>
                                                            </div>
                                                            <input type="number" class="form-control form-control-user" id="reference1Value" name="reference1Value" value="<?php if($Q21F!=""){echo $Q21F;}?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-12 input-group">
                                                             <div class="input-group-append">
                                                                <span class="input-group-text">&#8358</span>
                                                            </div>
                                                            <input type="number" class="form-control form-control-user" id="reference2Value" name="reference2Value" value="<?php if($Q22F!=""){echo $Q22F;}?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-12 input-group">
                                                             <div class="input-group-append">
                                                                <span class="input-group-text">&#8358</span>
                                                            </div>
                                                            <input type="number" class="form-control form-control-user" id="reference3Value" name="reference3Value" value="<?php if($Q23F!=""){echo $Q23F;}?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                             
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div id="managementSection" class="prequalificationSection">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Management Section</h1>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="NumberOfStaff">Number of staff</label>
                                        </div>
                                        <div class="col-12 col-sm-3 form-inline">
                                            <input type="number" class="form-control form-control-user m-1" id="NumberOfStaff" name="NumberOfStaff" value="<?php if($Q10!=""){echo $Q10;}?>"> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="HQofStaff">Highest Qualification of Staff</label>
                                        </div>
                                        <div class="col-12 col-sm-4 form-inline">
                                             <select class="form-select m-1" id="HQofStaff" name="HQofStaff">
                                                    <option disabled selected>select qualification</option>
                                                    <option value="1" <?php echo (isset($Q11) && $Q11 === '1') ? 'selected':'';?>>No Qualification</option>
                                                    <option value="2" <?php echo (isset($Q11) && $Q11 === '2') ? 'selected':'';?>>FSLC</option>
                                                    <option value="3" <?php echo (isset($Q11) && $Q11 === '3') ? 'selected':'';?>>WACE or NECO</option>
                                                    <option value="4" <?php echo (isset($Q11) && $Q11 === '4') ? 'selected':'';?>>OND</option>
                                                    <option value="5" <?php echo (isset($Q11) && $Q11 === '5') ? 'selected':'';?>>HND</option>
                                                    <option value="6" <?php echo (isset($Q11) && $Q11 === '6') ? 'selected':'';?>>BSc</option>
                                                    <option value="7" <?php echo (isset($Q11) && $Q11 === '7') ? 'selected':'';?>>PGD</option>
                                                    <option value="8" <?php echo (isset($Q11) && $Q11 === '8') ? 'selected':'';?>>MSc</option>
                                                    <option value="9" <?php echo (isset($Q11) && $Q11 === '9') ? 'selected':'';?>>PhD</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>    
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="contractTerminated">Has your organisation had any contract terminated for poor performance in the last three years, or any contracts where damages have been claimed by the contracting authority?</label>
                                        </div>

                                        <div  class="col-12 col-sm-2 form-inline">
                                            <select id="contractTerminated" name="contractTerminated" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q12) && $Q12 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q12) && $Q12 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                             <label for="contractTerminatedReason">If "YES" please give details?</label>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <textarea class="form-control form-control-user" id="contractTerminatedReason" name="contractTerminatedReason"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div id="qualityAssuranceSection" class="prequalificationSection">
                                    
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Quality Assurance Section</h1>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="managementCertification">Does your organisation hold a recognised quality management certification for example BS/EN/ISO 9000 or equivalent</label>
                                        </div>

                                        <div  class="col-12 col-sm-2 form-inline">
                                            <select id="managementCertification" name="managementCertification" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q13) && $Q13 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q13) && $Q13 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label for="managementSystem">If not, does your organisation have a quality management system?</label>
                                        </div>

                                        <div  class="col-12 col-sm-2 form-inline">
                                            <select id="managementSystem" name="managementSystem" class="form-select m-1">
                                                <option disabled selected>select answer</option>
                                                <option value="1" <?php echo (isset($Q14) && $Q14 === '1') ? 'selected':'';?>>yes</option>
                                                <option value="2" <?php echo (isset($Q14) && $Q14 === '2') ? 'selected':'';?>>no</option>
                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="HSEsection" class="prequalificationSection">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">HSE Section</h1>
                                    </div>

                                    <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="HSEpolicy">Does your organisation have a written health and safety at work policy?</label>
                                                </div>

                                                <div  class="col-12 col-sm-2 form-inline">
                                                    <select id="HSEpolicy" name="HSEpolicy" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q15) && $Q15 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q15) && $Q15 === '2') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                    
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                           <label for="HSEpolicyD">if yes, please provide sample documentation</label>
                                                        </div>
                                                        <div class="col-12 col-sm-6" >
                                                            <input type="file" class="form-control-file" id="HSEpolicyD" name="HSEpolicyD">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="routinelyRecord">Do you routinely record and review accidents/incidents and undertake follow-up action?</label>
                                                </div>

                                                <div  class="col-12 col-sm-2 form-inline">
                                                    <select id="routinelyRecord" name="routinelyRecord" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q16) && $Q16 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q16) && $Q16 === '3') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                    
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6">
                                                           <label for="routinelyRecordD">if yes, please provide sample documentation</label>
                                                        </div>
                                                        <div class="col-12 col-sm-6" >
                                                            <input type="file" class="form-control-file" id="routinelyRecordD" name="routinelyRecordD">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                     <label for="HSEadvice">Do you have access to competent H&S advice/assistance-both general and construction/sector related?</label>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-6 form-inline">
                                                            <select id="HSEadvice" name="HSEadvice" class="form-select m-1">
                                                                <option disabled selected>select answer</option>
                                                                <option value="1" <?php echo (isset($Q17) && $Q17 === '1') ? 'selected':'';?>>yes</option>
                                                                <option value="2" <?php echo (isset($Q17) && $Q17 === '2') ? 'selected':'';?>>no</option>
                                                            </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                            <div class="col-12 col-sm-6">
                                                <label for="environmentalManagementSystem">Does your organisation have an environmental management system?</label>
                                            </div>

                                            <div  class="col-12 col-sm-2 form-inline">
                                                <select id="environmentalManagementSystem" name="environmentalManagementSystem" class="form-select m-1">
                                                    <option disabled selected>select answer</option>
                                                    <option value="1" <?php echo (isset($Q18) && $Q18 === '1') ? 'selected':'';?>>yes</option>
                                                    <option value="2" <?php echo (isset($Q18) && $Q18 === '2') ? 'selected':'';?>>no</option>
                                                </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                
                                            </div>
                                        </div>
                                            
                                </div>


                                <div id="businessSection" class="prequalificationSection">

                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Historical Non-Performance</h1>
                                        </div>

                                        <div class="form-group row text-justify">
                                            <div class="col-12 col-sm-9">
                                                <label for="BPS1">Has your company or any of its Directors and Executive Officers been the subject of criminal or civil court action  (including for bankruptcy or insolvency) in respect of the business activ ities currently engaged in, for which the outcome was a judgement against you or them?</label>
                                            </div>

                                            <div  class="col-12 col-sm-3 form-inline">
                                                <select id="BPS1" name="BPS1" class="form-select m-1">
                                                    <option disabled selected>select answer</option>
                                                    <option value="1" <?php echo (isset($Q19) && $Q19 === '1') ? 'selected':'';?>>yes</option>
                                                    <option value="2" <?php echo (isset($Q19) && $Q19 === '2') ? 'selected':'';?>>no</option>
                                                </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                
                                            </div>
                                        </div>

                                        <div class="form-group row text-justify">
                                            <div class="col-12 col-sm-9">
                                                <label for="BPS2">If your company or any of its Directors and/or Executive Officers are the subject of ongoing or pending criminal or civil court action (including for bankruptcy or insolvency) in respect of the business activities currently engaged in, have all claims been properly notified in accordance with the suppliers Product Liability Insurance policy requirements and been accepted by insurers?</label>
                                            </div>

                                            <div  class="col-12 col-sm-3 form-inline">
                                                <select id="BPS2" name="BPS2" class="form-select m-1">
                                                    <option disabled selected>select answer</option>
                                                    <option value="1" <?php echo (isset($Q20) && $Q20 === '1') ? 'selected':'';?>>yes</option>
                                                    <option value="2" <?php echo (isset($Q20) && $Q20 === '2') ? 'selected':'';?>>no</option>
                                                </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                
                                            </div>
                                        </div>
                                </div>

                                <div id="resourcesSection" class="prequalificationSection">

                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Resources</h1>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="externalResources">Does the Contractor use external resources?</label>
                                                </div>

                                                <div  class="col-12 col-sm-2 form-inline">
                                                    <select id="externalResources" name="externalResources" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q24) && $Q24 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q24) && $Q24 === '2') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                    
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                     <label for="externalResourcesReason">If "YES", provide clarification;</label>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <textarea class="form-control form-control-user" id="externalResourcesReason" name="externalResourcesReason"></textarea>
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                    <label for="storage">Does the Contractor has a Storage/Warehousing?</label>
                                                </div>

                                                <div  class="col-12 col-sm-2 form-inline">
                                                    <select id="storage" name="storage" class="form-select m-1">
                                                        <option disabled selected>select answer</option>
                                                        <option value="1" <?php echo (isset($Q25) && $Q25 === '1') ? 'selected':'';?>>yes</option>
                                                        <option value="2" <?php echo (isset($Q25) && $Q25 === '2') ? 'selected':'';?>>no</option>
                                                    </select> <span class="badge rounded-pill bg-danger">impt</span>
                                                    
                                                </div>
                                        </div>

                                        <div class="form-group row">
                                                <div class="col-12 col-sm-6">
                                                     <label for="storageReason">If "YES", please provide the capacity (in m2):</label>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <textarea class="form-control form-control-user" id="storageReason" name="storageReason"></textarea>
                                                </div>
                                        </div>

                                        
                                </div>
                                
                                <button type="submit" name="calculateScore" class="btn btn-warning btn-user btn-block">Submit</button>
                            </form>

                            <div id="percentageScore" style="margin-top: 50px;">
                                <?php 

                                      if($percentageScore>60){

                                            echo '<div id="submitSection">
                                                    <a class="btn btn-success" href="contractor/index.php" id="navBarAnchorBtn">Congratulations on the successful completion of the process. Details of your company will be sent to the project client</a>
                                                  </div>';

                                        }elseif($percentageScore<60 && $percentageScore>=1){

                                            echo '<div id="submitSection">
                                                    <a class="btn btn-danger" href="contractor/index.php" id="navBarAnchorBtn">Thank for your participation, but you failed to meet up with the requirements</a>
                                                  </div>';
                                        }
                                ?> 
                            </div>
                    </div>
            </section>
            <!--end of section containing prequalification form-->

    <script src="js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
    <script src="js/popper.min.js"></script> <!--link to popper js file-->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->

    <!-- Bootstrap core JavaScript-->
    <script src="dashboard-asserts/vendor/jquery/jquery.min.js"></script>
    <script src="dashboard-asserts/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="dashboard-asserts/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="dashboard-asserts/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="dashboard-asserts/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="dashboard-asserts/js/demo/chart-area-demo.js"></script>
    <script src="dashboard-asserts/js/demo/chart-pie-demo.js"></script>
</body>
</html>