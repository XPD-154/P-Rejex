<?php

//creation of database table for client if it doesnt exist
$query = "CREATE TABLE IF NOT EXISTS PRclient (
    clientID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CLemail VARCHAR(50) NOT NULL,
    CLpassword VARCHAR(50) NOT NULL,
    CLcompany_name VARCHAR(50) NOT NULL,
    CLphone_number VARCHAR(50) NOT NULL,
    CLuniqueId VARCHAR(50) NOT NULL,
    INDEX(CLuniqueId)
)";
$sql= $connection->prepare($query);
$sql->execute();


//creation of database table for contractor if it doesnt exist
$query = "CREATE TABLE IF NOT EXISTS PRcontractor (
    contractorID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    CNemail VARCHAR(50) NOT NULL,
    CNpassword VARCHAR(50) NOT NULL,
    CNcompany_name VARCHAR(50) NOT NULL,
    CNphone_number VARCHAR(50) NOT NULL,
    CNuniqueId VARCHAR(50) NOT NULL,
    INDEX(CNuniqueId)
)";
$sql = $connection->prepare($query);
$sql->execute();

//creation of database table for admin message inbox if it doesnt exist
$query="CREATE TABLE IF NOT EXISTS PRadminmessage (
		  messageID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  useruniqueId VARCHAR(50) NOT NULL,
		  subject TEXT NOT NULL,
		  message TEXT NOT NULL,
		  status TEXT NOT NULL)";
$sql= $connection->prepare($query);
$sql->execute();

//creation of database table for admin message outbox if it doesnt exist
$query="CREATE TABLE IF NOT EXISTS PRmessage (
		  messageOutID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  useruniqueOutId VARCHAR(50) NOT NULL,
		  subjectOut TEXT NOT NULL,
		  messageOut TEXT NOT NULL,
		  statusOut TEXT NOT NULL)";
$sql= $connection->prepare($query);
$sql->execute();

//create the table for visitors activities
$query="CREATE TABLE IF NOT EXISTS `visitor_activity_logs` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_ip_address` varchar(50) NOT NULL,
	`user_agent` varchar(255) NOT NULL,
	`page_url` varchar(255) NOT NULL,
	`referrer_url` varchar(255) DEFAULT NULL,
	`user` varchar(50),
	`message` varchar(255),
	`project` varchar(255),
	`created_on` datetime NOT NULL DEFAULT current_timestamp(),
	PRIMARY KEY (`id`))";
$sql=$connection->prepare($query);
$sql->execute();

//creation of database table for projects if it doesnt exist
$query="CREATE TABLE IF NOT EXISTS prproject (
		  projectID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
		  project_name VARCHAR(50) NOT NULL,
		  project_type VARCHAR(50) NOT NULL,
		  project_location VARCHAR(50) NOT NULL,
		  project_est_bugt VARCHAR(50) NOT NULL,
		  CLuniqueId VARCHAR(50) NOT NULL,
          INDEX(project_name, CLuniqueId),
		  CONSTRAINT f1
		  FOREIGN KEY (CLuniqueId)
		  REFERENCES prclient (CLuniqueId)
		  ON DELETE CASCADE
		  ON UPDATE CASCADE)";
$sql= $connection->prepare($query);
$sql->execute();

// create table for tender if it doesnt exist
$query="CREATE TABLE IF NOT EXISTS prtender (
			tenderID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
			project_name VARCHAR(50) NOT NULL,
			introduction TEXT NOT NULL,
			scope_of_work TEXT NOT NULL,
			eligibility_criteria TEXT NOT NULL,
  			list_of_work_for_tender TEXT NOT NULL,
			tender_evaluation_procedure_and_method TEXT NOT NULL,
  			submission_closing_date TEXT NOT NULL,
  			bid_opening_date TEXT NOT NULL,  
			any_other_information TEXT NOT NULL, 
			disclaimer TEXT NOT NULL,
			CLuniqueId VARCHAR(50) NOT NULL,
			CLtenderuniqueId VARCHAR(50) NOT NULL, 
			INDEX (CLuniqueId, project_name),
			CONSTRAINT f2  
			FOREIGN KEY (project_name)   
			REFERENCES prproject (project_name)
			ON DELETE CASCADE
			ON UPDATE CASCADE)";
$sql= $connection->prepare($query);
$sql->execute();

//alter PRtender by adding a foreign key to CLuniqueid
try {
    $query="ALTER TABLE PRtender add FOREIGN KEY(CLuniqueId) REFERENCES prclient(CLuniqueId)";
    $sql= $connection->prepare($query);
    $sql->execute();
} catch (PDOException $exception) {
    if($exception->errorInfo[2] == 1061) {
        // references already exists
    } else {
        // Another error occurred
    }
}

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

//creation of database table for admin if it doesnt exist
$query="CREATE TABLE IF NOT EXISTS PRadmin(
                adminID INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                admin_email VARCHAR(50) NOT NULL,
                admin_password VARCHAR(50) NOT NULL)" ;
$sql=$connection->prepare($query);
$sql->execute();