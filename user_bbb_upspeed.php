<?php 

include_once('inc/conn.php');
		 
 			$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN 3bb_upspeed = "Y" THEN 1 ELSE NULL END) as "Y",
						 		 COUNT(CASE WHEN 3bb_upspeed = "N" THEN 1 ELSE NULL END) as "N",
						 		  COUNT(CASE WHEN 3bb_upspeed = "" THEN 1 ELSE NULL END) as "blank"
							FROM detail_survey
							WHERE title_1 = "Y" 
							AND subtitle_1 = "3bb" ');
			$sth->execute();      		
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$jsonData = array();
		 	foreach ($result as $key => $value) {	
	 				 	
		 			$jsonData[] = array('name' => 'Yes', 'y' =>$value['Y'], 'color' => "#0080FF");	
		 			$jsonData[] = array('name' => 'NO', 'y' =>$value['N'], 'color' => "#81BEF7");	
		 			$jsonData[] = array('name' => 'Blank', 'y' =>$value['blank'], 'color' => "#81F7F3");	 			 		 	 
			} 
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
?>