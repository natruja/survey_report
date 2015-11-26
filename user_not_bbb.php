<?php 
include_once('inc/conn.php');
		 
 			$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN title_2 = "Y" THEN 1 ELSE NULL END) as "Y",
						 		 COUNT(CASE WHEN title_2 = "N" THEN 1 ELSE NULL END) as "N",
						 		 COUNT(CASE WHEN title_2 = "" THEN 1 ELSE NULL END) as "blank"
							FROM detail_survey
							WHERE title_1 = "Y" 
							AND subtitle_1 != "3bb" 
							 ');
			$sth->execute();      		
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$jsonData = array();
		 	foreach ($result as $key => $value) {	
	 				 	
		 			$jsonData[] = array('name' => 'Yes', 'y' =>$value['Y'], 'color' => "#00FF00");	
		 			$jsonData[] = array('name' => 'NO', 'y' =>$value['N'], 'color' => "#BEF781");
		 			$jsonData[] = array('name' => 'Blank', 'y' =>$value['blank'], 'color' => "#CEF6D8");			 			 		 	 
			} 
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
?>