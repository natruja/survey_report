<?php
		include_once('inc/conn.php');
		 
 			$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN title_1 = "Y" THEN 1 ELSE NULL END) as "yes",  
						 		 COUNT(CASE WHEN title_1 = "N" THEN 1 ELSE NULL END) as "no",
						 		 COUNT(CASE WHEN title_1 = "" THEN 1 ELSE NULL END) as "other"						 
							FROM detail_survey');
			$sth->execute();      		
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			$arr 	= array();
			$arr1 	= array();
			 
			$j = 0;
		 	foreach ($result as $key => $value) {	
	 				$yes = $value['yes'];	
		 			$no = $value['no'];
		 			$other = $value['other'];
		 			 $jsonData = array
				        (
				            array("ใช้งานอยู่", $yes),
				            array("ไม่ได้ใช้งานแล้ว" , $no),
				            array("อื่น ๆ " , $other),
				        );
			} 
			
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
		

?>