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
 	<script type="text/javascript" src="js/export-th.js"></script> 
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
						<div class="panel panel-default">
								<div class="panel panel-heading">
									จำนวนทั้งหมด
								</div>
									<div class="panel panel-body">
								 		<div id="all-contact">
								 	</div>
								</div>
								<div class="panel-footer">ROP</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12">
						<div class="panel panel-danger">
								<div class="panel panel-heading">
									ภาพรวมการติดต่อลูกค้า
								</div>
								<div class="panel panel-body">
								 	<table class="table table-striped table-bordered table-hover"> 
								 		<?php 
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

												$lcg_value = $value_busy + $value_not + $value_contact + $value_as;
												$per_busy = round(($value_busy / $lcg_value)  * 10000 ) / 100;
												$per_not = round(($value_not / $lcg_value)  * 10000 ) / 100;
												$per_contact = round(($value_contact / $lcg_value)  * 10000 ) / 100;
												$per_as = round(($value_as / $lcg_value)  * 10000 ) / 100;
												$per_value = round(($lcg_value / $lcg_value)  * 10000 ) / 100;


								 		?>
								 		<tbody>
								 		<tr>
								 				<td><b>รายละเอียดการโทร</b></td>
								 				<td><b>จำนวน</b></td>
								 				<td><b>คิดเป็น</b></td>
								 			</tr>
								 			<tr>
								 				<td>ไม่สะดวกคุย</td>
								 				<td><?php echo $value_busy ?></td>
								 				<td><?php echo $per_busy ?>%</td>
								 			</tr>
								 			<tr>
								 				<td>ติดต่อไม่ได้</td>
								 				<td><?php echo $value_not ?></td>
								 				<td><?php echo $per_not ?>%</td>
								 			</tr>
								 			<tr>
								 				<td>ติดต่อได้</td>
								 				<td><?php echo $value_contact ?></td>
								 				<td><?php echo $per_contact ?>%</td>
								 			</tr>
								 			<tr>
								 				<td>ไม่รับสาย</td>
								 				<td><?php echo $value_as ?></td>
								 				<td><?php echo $per_as ?>%</td>
								 			</tr>
								 			<tr>
								 				<td align="right">Total</td>
								 				<td><?php echo $lcg_value ?></td>
								 				<td><?php echo $per_value ?>%</td>
								 			</tr>
								 		</tbody>
								 	</table>
								</div>
								<div class="panel-footer">ROP</div>
						</div>
					</div>
				</div>





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
								$per_yes = round(($yes / $total)  * 10000 ) / 100;
								$per_no =  round(($no / $total) * 10000) / 100;
								$per_oth =  round(($other / $total) * 10000) / 100;



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
								<td><?php echo $total_1 ?>%</td>
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
								$total_ttt =   round(($bbb / $total_isp)  * 10000 ) / 100;
								$total_true = round(($true / $total_isp)  * 10000 ) / 100;
								$total_tot = round(($tot / $total_isp)* 10000 ) / 100;
								$total_ais = round(($ais / $total_isp)* 10000 ) / 100;
								$total_dtac = round(($dtac / $total_isp)* 10000 ) / 100;
								$total_blnk = round(($blank / $total_isp)* 10000 ) / 100;
								$total_other = round(($other / $total_isp)* 10000 ) / 100;
							   
								$per_ttt = number_format($total_ttt, 2, '.', '');
								$per_true = number_format($total_true, 2, '.', '');
								$per_tot = number_format($total_tot, 2, '.', '');
								$per_ais = number_format($total_ais, 2,'.','');
								$per_dtac = number_format($total_dtac, 2,'.','');
								$per_blank = number_format($total_blnk, 2,'.','');
								$per_other = number_format($total_other, 2,'.','');
							 
								$total_isp_aver = $per_ttt + $per_true + $per_tot + $per_ais + $per_dtac + $per_blank + $per_other; 
												    
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
								<td><?php echo $per_ttt; ?>%</td>
							</tr>
							<tr>
								<td>True</td>
								<td><?php echo $true ?></td>
								<td><?php echo $per_true ?>%</td>
							</tr>
							<tr>
								<td>TOT</td>
								<td><?php echo $tot ?></td>
								<td><?php echo $per_tot ?>%</td>
							</tr>
							<tr>
								<td>AIS</td>
								<td><?php echo $ais ?></td>
								<td><?php echo $per_ais ?>%</td>
							</tr>
							<tr>
								<td>Dtac</td>
								<td><?php echo $dtac ?></td>
								<td><?php echo $per_dtac ?>%</td>
							</tr>
							<tr>
								<td>Blank</td>
								<td><?php echo $blank ?></td>
								<td><?php echo $per_blank ?>%</td>
							</tr>
							<tr>
								<td>Other</td>
								<td><?php echo $other ?></td>
								<td><?php echo $per_other ?>%</td>
							</tr>
							<tr>
								<td align="right">Total</td>
								<td><?php echo $total_isp ?></td>
								<td><?php echo $total_isp_aver ?>%</td>
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
						ลูกค้าที่ใช้งาน 3BB แล้วต้องการ Up Speed
					</div>
					<div class="panel panel-body">
						<table class="table table-striped table-bordered table-hover">
						<?php 
							$sth = $dbh->prepare('SELECT 
						 		 COUNT(CASE WHEN 3bb_upspeed = "Y" THEN 1 ELSE NULL END) as "Y",
						 		 COUNT(CASE WHEN 3bb_upspeed = "N" THEN 1 ELSE NULL END) as "N",
						 		 COUNT(CASE WHEN 3bb_upspeed = "" THEN 1 ELSE NULL END) as blank
							FROM detail_survey
							WHERE title_1 = "Y" 
							AND subtitle_1 = "3bb" ');
							$sth->execute();      		
							$result = $sth->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $key => $value) {	
								 $Yes_value = $value["Y"];
								 $No_value = $value["N"];
								 $blank = $value["blank"];
								 $upspeed = $Yes_value + $No_value + $blank;

								$Yes_total =   round(($Yes_value / $upspeed)  * 10000 ) / 100;
								$No_total =   round(($No_value / $upspeed)  * 10000 ) / 100;
								$Upspeed_blank =   round(($blank / $upspeed)  * 10000 ) / 100;
								$per_up_ye = number_format($Yes_total, 2, '.', '');
								$per_up_no = number_format($No_total, 2, '.', '');
								$per_up_blank = number_format($Upspeed_blank, 2, '.', '');

								$total_upspeed =  $per_up_ye + $per_up_no + $per_up_blank;
							}

						?>
						<tbody>
							<tr>
								<td><b>ประเภท</b></td>
								<td><b>ข้อมูลทั้งหมด</b></td>
								<td><b>คิดเป็น</b></td>
							</tr>
							<tr>
								<td><font color="red"><u>ต้อง</u></font> การอัพสปีด</td>
								<td><?php echo $Yes_value ?></td>
								<td><?php echo $per_up_ye; ?>%</td>
							</tr>
							<tr>
								<td><font color="red"><u>ไม่</u></font> ต้องการอัพสปีด</td>
								<td><?php echo $No_value ?></td>
								<td><?php echo $per_up_no ?>%</td>
							</tr>
							<tr>
								<td>อื่น ๆ</td>
								<td><?php echo $blank ?></td>
								<td><?php echo $per_up_blank ?>%</td>
							</tr>
				
							<tr>
								<td align="right">Total</td>
								<td><?php echo $upspeed ?></td>
								<td><?php echo $total_upspeed ?>%</td>
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
						ลูกค้าที่ไม่ได้ใช้งานของ 3BB แล้วในปัจจุบัน แต่สนใจกลับมาใช้งานของ 3BB อีกในอนาคต
					</div>
					<div class="panel panel-body">
						<table class="table table-striped table-bordered table-hover">
						<?php 
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
							foreach ($result as $key => $value) {	
								 $Yes_value = $value["Y"];
								 $No_value = $value["N"];
								 $blank = $value["blank"];
								 $upspeed = $Yes_value + $No_value + $blank;

								$Yes_total =   round(($Yes_value / $upspeed)  * 10000 ) / 100;
								$No_total =   round(($No_value / $upspeed)  * 10000 ) / 100;
								$Upspeed_blank =   round(($blank / $upspeed)  * 10000 ) / 100;
								$per_up_ye = number_format($Yes_total, 2, '.', '');
								$per_up_no = number_format($No_total, 2, '.', '');
								$per_up_blank = number_format($Upspeed_blank, 2, '.', '');

								$total_upspeed =  $per_up_ye + $per_up_no + $per_up_blank;
							}

						?>
						<tbody>
							<tr>
								<td><b>ประเภท</b></td>
								<td><b>ข้อมูลทั้งหมด</b></td>
								<td><b>คิดเป็น</b></td>
							</tr>
							<tr>
								<td><font color="red"><u>ต้อง</u></font> กลับมาใช้งานใหม่</td>
								<td><?php echo $Yes_value ?></td>
								<td><?php echo $per_up_ye; ?>%</td>
							</tr>
							<tr>
								<td><font color="red"><u>ไม่</u></font> ต้องการใช้งานต่อ</td>
								<td><?php echo $No_value ?></td>
								<td><?php echo $per_up_no ?>%</td>
							</tr>
							<tr>
								<td>อื่น ๆ </td>
								<td><?php echo $blank ?></td>
								<td><?php echo $per_up_blank ?>%</td>
							</tr>
				
							<tr>
								<td align="right">Total</td>
								<td><?php echo $upspeed ?></td>
								<td><?php echo $total_upspeed ?>%</td>
							</tr>
						</tbody>
					</table>
					</div>
  				</div>
		</div>
	</div>



</div>
		

	 
</body>
</html>