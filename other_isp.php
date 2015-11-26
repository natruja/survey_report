<?php 
include_once('inc/conn.php');	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dataTable/jquery.dataTables_themeroller.css">
	<link rel="stylesheet" type="text/css" href="css/dataTable/dataTables.bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dataTable/dataTables.tableTools.css">

	<script src="jquery/jquery.js"></script>
	<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" ></script>
	<script src="js/dataTable/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/dataTable/dataTables.bootstrap.js" type="text/javascript"></script>
	<script src="js/dataTable/dataTables.tableTools.js" type="text/javascript"></script>
	<script>
			  $(document).ready(function() {
			  var table = $('#table').DataTable({
			  			"dom": 'T<"clear">lfrtip',
			  			"tableTools": {
            				"sSwfPath": "swf/flashExport.swf",
            				"aButtons": [ "copy"]
        				},
        				 

			  	});
			  });
	</script>
</head>
<body>
<div class="container-fluid">
<br>
	<div id="row">
		<div class="col-lg-12 col-md-12">
			<div class="page-header">
 			 	<h3>ลูกค้าที่ไม่ได้ใช้งานของ 3BB และ สนใจกลับมาใช้งานต่อ</h3>
			</div>
		<table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%"> 
		<thead>
			<tr>
				<th>No.</th>
				<th>ชื่อ-นามสกุล</th>
				<th>ที่อยู่</th>
				<th>ผู้โทร</th>
				<th>สนใจกลับมาใช้งาน</th>
				<th>เดือนที่ต้องการ</th>
				<th>อื่น ๆ </th>
				<th>ติดต่อกลับ</th>
			</tr>
		</thead>
		<tbody>
			<?php 
					$sth = $dbh->prepare(' SELECT *
						 		 
							FROM detail_survey
							WHERE title_1 = "Y" 
							AND subtitle_1 != "3bb" 
							AND title_2 = "Y" 
							ORDER BY id_survey DESC ');
					$sth->execute();		 
		 			$result =  $sth->fetchAll(PDO::FETCH_ASSOC);
		 			$i = 1;
		 			foreach ($result as $key => $value) {
		 				$title_2 = $value["title_2"];
		 				$month = $value["subtitle_2"];
		 				$other_bbb = $value["subtile2_other"];
		 				$contact_combact = $value["contact_combact"];
		 				switch ($month) {
		 					case 'one_month':
		 					 	$name = "1-2 เดือนนี้";
		 						break;
		 					case 'more_month':
		 					 	$name = "2-3 เดือนนี้";
		 						break;
		 					case 'othe_month':
		 					 	$name = "ไม่แน่ใจ";
		 						break;
		 					default:
		 						 $name = "";
		 						break;
		 				}
		 				switch ($contact_combact) {
		 					case 'Y':
		 						$come_b = "ใช่";
		 						break;
		 					case 'N':
		 						$come_b = "ไม่";
		 						break;
		 					default:
		 						$come_b = "";
		 						break;
		 				}

 			   			  			
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $value["name_last"]; ?></td>
				<td><?php echo $value["address_user"]; ?></td>
				<td><?php echo $value["email_emp"]; ?></td>
				<td><?php echo $title_2 ?></td>
				<td><?php echo $name ?></td>
				<td><?php echo $other_bbb ?></td>
				<td><?php echo $come_b ?></td>
			</tr>
			<?php
			 	$i++;
			 	}
			?>
		</tbody>
	</table>
		</div> 
	</div> 
</div>
	
</body>
</html>