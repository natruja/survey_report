<?php 
		include_once('inc/conn.php');
		 
 			$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN subtitle_1 = "3bb" THEN 1 ELSE NULL END) as "3bb",  
						 		 COUNT(CASE WHEN subtitle_1 = "ais" THEN 1 ELSE NULL END) as "ais",
						 		 COUNT(CASE WHEN subtitle_1 = "dtac" THEN 1 ELSE NULL END) as "dtac",
						 		 COUNT(CASE WHEN subtitle_1 = "true" THEN 1 ELSE NULL END) as "true",
						 		 COUNT(CASE WHEN subtitle_1 = "tot" THEN 1 ELSE NULL END) as "tot",
						 		 COUNT(CASE WHEN subtitle_1 = "other" THEN 1 ELSE NULL END) as "blank",
						 		 COUNT(CASE WHEN subtitle_1 = "" THEN 1 ELSE NULL END) as "other"							 
							FROM detail_survey
							WHERE title_1 = "Y" ');
			$sth->execute();      		
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$jsonData = array();
		 	foreach ($result as $key => $value) {	
	 				$jsonData[] = array('name' => '3BB', 'y' =>$value['3bb'], 'color' => "#ff9900");	
		 			$jsonData[] = array('name' => 'AIS', 'y' =>$value['ais'], 'color' => "#33cc33");	
		 			$jsonData[] = array('name' => 'Dtac', 'y' =>$value['dtac'], 'color' => "#3399ff");	
		 			$jsonData[] = array('name' => 'True', 'y' =>$value['true'], 'color' => "#cc0000");	
		 			$jsonData[] = array('name' => 'TOT', 'y' =>$value['tot'], 'color' => "#66ffff");	
		 			$jsonData[] = array('name' => 'Other', 'y' =>$value['other'], 'color' => "#003300");
		 			$jsonData[] = array('name' => 'Blank', 'y' =>$value['other'], 'color' => "#F781F3");			 	 
			} 
			
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
?>