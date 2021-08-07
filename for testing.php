<?php

include ("connection.php");

session_start();

//echo $_SESSION['project_name_id'];

$_SESSION['happy']="happy";
$_SESSION['angry']="angry";

?>
<!DOCTYPE html>
<html lang="en"> <!--lang stands for language attribute, en stands for english -->
	<head>
		
		<meta charset="utf-8"> <!--conversion of typed charater into machine readable code-->
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!--viewport is the user's visisble area of a web page, the meta tag allows modification to the viewport, width=device-width sets the width of the page to follow screen width of the device, initial-sacle=1 set the initial zoom level on a page, shrink-to-fit=no prevent contents that are initially bigger than the viewport to be shrink too small-->
	    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!--x-ua compatible is a document mode meta tag that allows choice of what version of Internet Explorer the page should be rendered as-->
	            
	    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"> <!--link to boostrap css file-->
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!--link to font awesome css file-->
	    <link rel="stylesheet" href="bootstrap-social/bootstrap-social.css"> <!--link to boostrap social css file-->
	    <link rel="stylesheet" href="css/style.css">
		<title>P-Rejex</title>
		<style type="text/css">
			
			
		</style>
		
	</head>
	<body>
		
		<form>
			<input type="text" name="" id="new">
			<input type="button" value="submit" id="myButton">
		</form>

		<div id="myDay">
			<div id="myDay1"  class="<?=$_SESSION['angry'];?>"><p>im gonna make you very unhappy</p></div>
			<div id="myDay2" class="<?=$_SESSION['happy'];?>"><p>im full of joy</p></div>
	    </div>
		<script type="text/javascript">

	        var happy = "<?=$_SESSION['happy'];?>";
	        var angry = "<?=$_SESSION['angry'];?>";

	        var newHappy = happy.toLowerCase();
	        var newAngry = angry.toLowerCase();

        	
			document.getElementById("myButton").onclick=function() {

				var inputVal = document.getElementById("new").value;
	        	var lower_case_inputVal = inputVal.toLowerCase();
	        	alert(lower_case_inputVal);

	        	document.getElementById("myDay").style.display= "none";

	        	var myDay1 = document.getElementById("myDay1").toLowerCase()

	        	if(lower_case_inputVal==myDay1){

	        		document.getElementById("myDay1").style.display= "show";

	        	}
	        	//document.getElementsByClassName("myDay")[0].style.visibility = 'hidden';
				

			}

	        /*const project_name_id = "<?php //echo $_SESSION['project_name_id']; ?>";
	        const lower_case_project_name_id = project_name_id.toLowerCase();
	        const myArr = lower_case_project_name_id.split(" ");
	        let x = myArr;
	        alert(x);
	        document.getElementById("demo").innerHTML = myArr;

	        function getvalue(){
	        	var inputVal = document.getElementById("new").value;
	        	var lower_case_inputVal = inputVal.toLowerCase();
	        	//alert(inputVal);
	        	if(myArr.indexOf(lower_case_inputVal) > -1){
	        		alert('match');
	        	}else{
	        		alert('no match');
	        	}
	        }*/
	        
	    </script>

		<script src="js/jquery-3.4.1.js"></script> <!--link to jquery js file-->
		<script src="js/popper.min.js"></script> <!--link to popper js file-->
	    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script> <!--link to boostrap js file-->
	</body>
</html>