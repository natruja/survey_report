<?php 
		$user = "rxsys";
		$pass = "ssSS$$55";
		try {
		    $dbh = new PDO('mysql:host=10.11.22.33;dbname=survey', $user, $pass, array(
    																		PDO::ATTR_PERSISTENT => true,
    																		PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION));
		    $dbh->exec("set names utf8");
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		} 
 ?>