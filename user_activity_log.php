<?php 
	// Include the database configuration file 
	include 'connection.php';

	//check if a registered user is working within the site
	if (isset($_SESSION['user']) && isset($_SESSION['message']) && isset($_SESSION['project_name'])) {
		
		$message=$_SESSION['message'];
		$user=$_SESSION['user'];
		$project=$_SESSION['project_name'];
		

	}else{

		$message="visitation of homepage";
		$user="unregister user";
		$project="";
	}
	 
	// Get current page URL 
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
	$user_current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; 

	// Get server related info 
	$user_ip_address = $_SERVER['REMOTE_ADDR']; 
	$referrer_url = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/'; 
	$user_agent = $_SERVER['HTTP_USER_AGENT']; 

	// Insert visitor activity log into database 
	$query = "INSERT INTO visitor_activity_logs (user_ip_address, user_agent, page_url, referrer_url, user, message, project) VALUES (:user_ip_address, :user_agent, :user_current_url, :referrer_url, :user, :message, :project)"; 
	$sql=$connection->prepare($query);
	$sql->execute(array(':user_ip_address'=>$user_ip_address,
						':user_agent'=>$user_agent,
						':user_current_url'=>$user_current_url,
						':referrer_url'=>$referrer_url,
						':user'=>$user,
						':message'=>$message,
						':project'=>$project));

	
?>