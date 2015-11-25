<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap/dist/css/bootstrap.css">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<title></title>
	<script src="jquery/jquery.js"></script>
	<script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript" ></script>
	<script src="js/highcharts.js"></script>
 	<script src="js/modules/exporting.js"></script>
 	<script src="js/highcharts-3d.src.js" type="text/javascript" charset="utf-8" async defer></script>
 	<script type="text/javascript" src="js/graph.js"></script>    
</head>
<body>
<br>
<?php 
	include_once('inc/conn.php');				 		
?>
<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						ข้อมูลการโทรที่ติดต่อได้
					</div>
					<div class="panel panel-body">
						<div id="total"></div>
					</div>
					<div class="panel-footer">ROP</div>
				</div>
			</div>
  			<div class="col-lg-4 col-md-12">
  				<div class="panel panel-danger">
  					<div class="panel panel-heading">
						ข้อมูลการโทรที่ติดต่อได้
					</div>
					<div class="panel panel-body">
					<table class="table table-striped table-bordered table-hover">
						<?php 
							$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN title_1 = "Y" THEN 1 ELSE NULL END) as "yes",  
						 		 COUNT(CASE WHEN title_1 = "N" THEN 1 ELSE NULL END) as "no",
						 		 COUNT(CASE WHEN title_1 = "" THEN 1 ELSE NULL END) as "other",
						 		 COUNT(name_last) as total					 
							FROM detail_survey');
							$sth->execute();      		
							$result = $sth->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $key => $value) {	
								$yes = $value["yes"];
								$no = $value["no"];
								$other = $value["other"];
								$total = $value["total"];
								$per_yes =  ($yes / $total);
								$per_no =  ($no / $total);
								$per_oth =  ($other / $total);
								$per_y =  number_format($per_yes, 2, '.', '');
								$per_n =  number_format($per_no, 2, '.', '');
								$per_ot =  number_format($per_oth, 2, '.', '');
								$total_number = $yes + $no + $other;
								$total_1 = $per_yes + $per_no + $per_oth;
								
							}

						?>
						<tbody>
							<tr>
								<td><b>ประเภท</b></td>
								<td><b>ข้อมูลทั้งหมด</b></td>
								<td><b>คิดเป็น</b></td>
							</tr>
							<tr>
								<td>ใช้งานอยู่</td>
								<td><?php echo $yes ?></td>
								<td><?php echo $per_y; ?>%</td>
							</tr>
							<tr>
								<td>ไม่ได้ใช้งานแล้ว</td>
								<td><?php echo $no ?></td>
								<td><?php echo $per_n ?>%</td>
							</tr>
							<tr>
								<td>อื่น ๆ </td>
								<td><?php echo $other ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td align="right">Total</td>
								<td><?php echo $total_number ?></td>
								<td><?php echo $total_1 ?></td>
							</tr>
						</tbody>
					</table>
						
					</div>
  				</div>
  			</div>
		</div>
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="panel panel-success">
				<div class="panel panel-heading">
						ลูกค้าที่ใช้งาน Internet อยู่
				</div>
				<div class="panel panel-body">
					<div id="type_3bb"></div>
				</div>
				<div class="panel-footer">ROP</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
		   <div class="panel panel-danger">
  					<div class="panel panel-heading">
						ลูกค้าที่ใช้งาน Internet อยู่
					</div>
					<div class="panel panel-body">
						<table class="table table-striped table-bordered table-hover">
						<?php 
							$sth = $dbh->prepare('SELECT 
									 		 COUNT(CASE WHEN subtitle_1 = "3bb" THEN 1 ELSE NULL END) as "3bb",  
									 		 COUNT(CASE WHEN subtitle_1 = "ais" THEN 1 ELSE NULL END) as "ais",
									 		 COUNT(CASE WHEN subtitle_1 = "dtac" THEN 1 ELSE NULL END) as "dtac",
									 		 COUNT(CASE WHEN subtitle_1 = "true" THEN 1 ELSE NULL END) as "true",
									 		 COUNT(CASE WHEN subtitle_1 = "tot" THEN 1 ELSE NULL END) as "tot",
									 		 COUNT(CASE WHEN subtitle_1 = "other" THEN 1 ELSE NULL END) as "other",
									 		 COUNT(CASE WHEN subtitle_1 = "" THEN 1 ELSE NULL END) as "blank"							 
							FROM detail_survey
							WHERE title_1 = "Y" ');
							$sth->execute();      		
							$result = $sth->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $key => $value) {	
								$bbb = $value["3bb"];
								$ais = $value["ais"];
								$dtac = $value["dtac"];
								$true = $value["true"];
								$tot = $value["tot"];
								$blank = $value["blank"]; 
								$other = $value["other"]; 	
								$total_isp = $bbb+$ais+$dtac+$true+$tot+$other+$blank;
							}

						?>
						<tbody>
							<tr>
								<td><b>ประเภท</b></td>
								<td><b>ข้อมูลทั้งหมด</b></td>
								<td><b>คิดเป็น</b></td>
							</tr>
							<tr>
								<td>3BB</td>
								<td><?php echo $bbb ?></td>
								<td><?php echo $per_y; ?>%</td>
							</tr>
							<tr>
								<td>True</td>
								<td><?php echo $true ?></td>
								<td><?php echo $per_n ?>%</td>
							</tr>
							<tr>
								<td>TOT</td>
								<td><?php echo $tot ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td>AIS</td>
								<td><?php echo $ais ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td>Dtac</td>
								<td><?php echo $dtac ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td>Blank</td>
								<td><?php echo $blank ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td>Other</td>
								<td><?php echo $other ?></td>
								<td><?php echo $per_ot ?>%</td>
							</tr>
							<tr>
								<td align="right">Total</td>
								<td><?php echo $total_isp ?></td>
								<td><?php echo $total_1 ?></td>
							</tr>
						</tbody>
					</table>
					</div>
  				</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="panel panel-info">
				<div class="panel panel-heading">
						ลูกค้าที่ใช้งาน 3BB แล้วต้องการ Up Speed
				</div>
				<div class="panel panel-body">
					<div id="upspeed_3bb"></div>
				</div>
				<div class="panel-footer">ROP</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
		   <div class="panel panel-danger">
  					<div class="panel panel-heading">
						รายละเอียด
					</div>
					<div class="panel panel-body">
						
					</div>
  				</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-md-12">
			<div class="panel panel-info">
				<div class="panel panel-heading">
						ลูกค้าที่ใช้งานของเจ้าอื่น ๆ 
				</div>
				<div class="panel panel-body">
					<div id="not-3bb"></div>
				</div>
				<div class="panel-footer">ROP</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-12">
		   <div class="panel panel-danger">
  					<div class="panel panel-heading">
						รายละเอียด
					</div>
					<div class="panel panel-body">
						
					</div>
  				</div>
		</div>
	</div>



</div>
		

	 
</body>
</html>