<?php 

include_once('inc/conn.php');
		 
 			$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN 3bb_upspeed = "Y" THEN 1 ELSE NULL END) as "Y",
						 		 COUNT(CASE WHEN 3bb_upspeed = "N" THEN 1 ELSE NULL END) as "N"
							FROM detail_survey
							WHERE title_1 = "Y" 
							AND subtitle_1 = "3bb" ');
			$sth->execute();      		
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$jsonData = array();
		 	foreach ($result as $key => $value) {	
	 				 	
		 			$jsonData[] = array('name' => 'Yes', 'y' =>$value['Y'], 'color' => "#33cc33");	
		 			$jsonData[] = array('name' => 'NO', 'y' =>$value['N'], 'color' => "#3399ff");		 			 		 	 
			} 
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
?>