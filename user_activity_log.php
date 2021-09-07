<?php 
	// Include the database configuration file 
	include 'connection.php';


	//create the table for visitors activities
	$query="CREATE TABLE IF NOT EXISTS `visitor_activity_logs` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`user_ip_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
		`user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		`page_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
		`referrer_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
		`user` varchar(50) COLLATE utf8_unicode_ci,
		`message` varchar(255) COLLATE utf8_unicode_ci,
		`project` varchar(255) COLLATE utf8_unicode_ci,
		`created_on` datetime NOT NULL DEFAULT current_timestamp(),
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
	$sql=$connection->prepare($query);
	$sql->execute();

	$message="visitation of homepage";
	$user="unregister user";
	 
	// Get current page URL 
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
	$user_current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; 

	// Get server related info 
	$user_ip_address = $_SERVER['REMOTE_ADDR']; 
	$referrer_url = !empty($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'/'; 
	$user_agent = $_SERVER['HTTP_USER_AGENT']; 

	// Insert visitor activity log into database 
	$query = "INSERT INTO visitor_activity_logs (user_ip_address, user_agent, page_url, referrer_url, user, message) VALUES (:user_ip_address, :user_agent, :user_current_url, :referrer_url, :user, :message)"; 
	$sql=$connection->prepare($query);
	$sql->execute(array(':user_ip_address'=>$user_ip_address,
						':user_agent'=>$user_agent,
						':user_current_url'=>$user_current_url,
						':referrer_url'=>$referrer_url,
						':user'=>$user,
						':message'=>$message));

	/*$query = "INSERT INTO visitor_activity_logs (user_ip_address, user_agent, page_url, referrer_url) VALUES (:user_ip_address, :user_agent, :user_current_url, :referrer_url)"; 
	$sql=$connection->prepare($query);
	$sql->execute(array(':user_ip_address'=>$user_ip_address,
						':user_agent'=>$user_agent,
						':user_current_url'=>$user_current_url,
						':referrer_url'=>$referrer_url))*/
?>