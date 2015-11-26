<?php 
include_once('inc/conn.php');

			$sth = $dbh->prepare('SELECT
									COUNT(busy_user.busy_id) as busy
									FROM busy_user');
			$sth->execute(); 
			$busy = $sth->fetch(PDO::FETCH_ASSOC);
			$value_busy = $busy["busy"];
		 
			$sth = $dbh->prepare('SELECT
									COUNT(contact_error.not_contact) as not_contact
									FROM contact_error');
			$sth->execute();
			$not_contact = $sth->fetch(PDO::FETCH_ASSOC);
			$value_not = $not_contact["not_contact"];

		 
			$sth = $dbh->prepare('SELECT
									COUNT(detail_survey.id_survey) as id_survey
									FROM detail_survey');
			$sth->execute();
			$contact = $sth->fetch(PDO::FETCH_ASSOC);
			$value_contact = $contact["id_survey"];

			$sth = $dbh->prepare('SELECT
									COUNT(no_answer.id_no) as no_answer
									FROM no_answer');
			$sth->execute();      		
			$not_as = $sth->fetch(PDO::FETCH_ASSOC);
			$value_as = $not_as["no_answer"];
		 
			  		$jsonData = array();
		 			$jsonData[] = array('name' => 'ไม่สะดวกคุย', 'y' =>$value_busy, 'color' => "#000000");	
		 			$jsonData[] = array('name' => 'ติดต่อไม่ได้', 'y' =>$value_not, 'color' => "#FE2E64");
		 			$jsonData[] = array('name' => 'ติดต่อได้', 'y' =>$value_contact, 'color' => "#0000FF");
		 			$jsonData[] = array('name' => 'ไม่รับสาย', 'y' =>$value_as, 'color' => "#FFFF00");			 			 		 	 
		 
		 print_r(json_encode($jsonData, JSON_NUMERIC_CHECK));
?>