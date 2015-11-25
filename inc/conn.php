<?php 
		$user = "root";
		$pass = "";
		try {
		    $dbh = new PDO('mysql:host=127.0.0.1;dbname=survey', $user, $pass, array(
    																		PDO::ATTR_PERSISTENT => true,
    																		PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION));
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		} 
 ?>