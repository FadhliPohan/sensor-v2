<?php
session_start();
?>
<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	title: {
		text: "Soil Moisture"
		
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
	
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//grafik trapesium
			{ x: 0, y: 1 },
			{ x: 10, y: 1 },
			{ x: 20, y: 1 },
			{ x: 30.5, y: 0.4 },
			{ x: 40, y: 0 },	
		]
	},
	{
	//nilai bawah
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//Grafik segitiga I
			{ x: 20, y: 0 },
			{ x: 30.5, y: 0.4 },
			{ x: 42.5, y: 1},
			{ x: 55.5, y: 0.4 },
			{ x: 65, y: 0},	
		]
	},
{


		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//Trapesium 2
			{ x: 50, y: 0 },
			{ x: 55.5, y: 0.4 },
			{ x: 75, y: 1},
			{ x: 80, y: 1},
			{ x: 90, y: 1 },
			{ x: 100, y: 1 },
		]
	}	
	]
};
$("#chartContainer2").CanvasJSChart(options);








//Better to construct options first and then pass it as a parameter\

//Representasi Kurva Pada Variabel Temperature
var options2 = {
	title: {
		text: "Temperature"
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
		type: "line", 
		dataPoints: [//grafik trapesium
			{ x: 0, y: 1 },
			{ x: 2.5, y: 1 },
			{ x: 5, y: 1 },
			{ x: 6.25, y: 1 },
			{ x: 10, y: 0.4 },
			{ x: 12.5, y: 0 },
		]
	},
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [ //Grafik segitiga I
			{ x: 6.25, y: 0 },
			{ x: 10, y: 0.4 },
			{ x: 13.75, y: 1},
			{ x: 17.5, y: 0.4 },
			{ x: 21.25, y: 0 },
		]
	},
{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [ //Segitiga 2
			{ x: 15, y: 0},
			{ x: 17.5, y: 0.4 },
			{ x: 21.875, y: 1 },
			{ x: 26.25, y: 0.4 },
			{ x: 28.75, y: 0 },
		]
	},
	{


		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [ //segitiga 3
			{ x: 23.75, y: 0 },
			{ x: 26.25, y: 0.4 },
			{ x: 30.625 , y: 1},
			{ x: 35, y: 0.4 },
			{ x: 37.5 , y: 0},
		]
	},
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [ //Trapesium 2
			{ x: 32.5, y: 0 },
			{ x: 35, y: 0.4 },
			{ x: 41.25, y: 1},
			{ x: 42.5, y: 1 },
			{ x: 45, y: 1 },
			{ x: 47.5, y: 1 },
			{ x: 50, y: 1  }
		]
	}	
	]
};
$("#chartContainer").CanvasJSChart(options2);










var options3 = {
	title: {
		text: "Humidity"
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
	
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//grafik trapesium
			{ x: 0, y: 1 },
			{ x: 10, y: 1 },
			{ x: 15, y: 0.4 },
			{ x: 20, y: 0 },
			
			
		]
	},
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//Grafik segitiga I
			{ x: 10, y: 0 },
			{ x: 15, y: 0.4 },
			{ x: 25, y: 1 },
			{ x: 35, y: 0.4 },
			{ x: 40, y: 0 },	
		]
	},
{

		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//Segitiga 2
			{ x: 30, y: 0},
			{ x: 35, y: 0.4 },
			{ x: 50, y: 1 },
			{ x: 65, y: 0.4 },
			{ x: 70, y: 0 },
			
			
		]
	},
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//segitiga 3
			{ x: 60, y: 0 },
			{ x: 65, y: 0.4 },
			{ x: 75, y: 1 },
			{ x: 85, y: 0.4 },
			{ x: 90 , y: 0 },
			
			
		]
	},
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//Trapesium 2
			{ x: 80, y: 0 },
			{ x: 85, y: 0.4 },
			{ x: 90, y: 1 },
			{ x: 100, y: 1},
		]
	}	
	]
};
$("#chartContainer3").CanvasJSChart(options3);




















//Better to construct options first and then pass it as a parameter
var options5 = {
	title: {
		text: "Light Intensity"
	},
	animationEnabled: true,
	exportEnabled: true,
	data: [
	{
	
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//grafik trapesium
			{ x: 0, y: 1 },
			{ x: 2500, y: 1 },
			{ x: 5000, y: 1 },
			{ x: 7500, y: 1 },
			{ x: 10500, y: 0.4 },
			{ x: 12500, y: 0 },
			
		]
	},
	{
	//nilai bawah
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
		
			//Grafik segitiga I
			{ x: 7500, y: 0 },
			{ x: 12000, y: 0.4 },
			{ x: 20000, y: 1},
			{ x: 27500, y: 0.4 },
			{ x: 32500, y: 0 },
			
		]
	},
{


		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//Segitiga 2
			{ x: 27500, y: 0},
			{ x: 32000, y: 0.4 },
			{ x: 40000, y: 1 },
			{ x: 47500, y: 0.4 },
			{ x: 52500, y: 0 },
			
		]
	},
	
	{
		type: "line", //change it to line, area, column, pie, etc
		dataPoints: [
			//Trapesium 2
			{ x: 47500, y: 0 },
			{ x: 48000, y: 0.4 },
			{ x: 49000, y: 1},
			{ x: 50500, y: 1 },
			{ x: 55500, y: 1 },
			{ x: 58500, y: 1 },
			{ x: 60000, y: 1  }
		]
	}	
	]
};
$("#chartContainer5").CanvasJSChart(options5);



}
</script>
<!--
tabel dalam database yang digunakan dalamperhitungan
1.tb rule
2.tb rule duration
3.tb rul kondisi4.tb hasil_2
4.tb hasil





-->
<?php
include "head.php";


?>
<?php 
include "sidebar.php";
function get_ket($suhu,$nilai){
	$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='$suhu' and nilai='".$nilai."' GROUP BY is_sub_golongan,keterangan_nilai");
	$set="SELECT * FROM `tb_rule` WHERE is_golongan='$suhu' and nilai='".$nilai."' GROUP BY is_sub_golongan,keterangan_nilai";
					while($row=mysql_fetch_array($sql)){
					$data=$row['keterangan_nilai'];	
					}
					return $set;
}
function nilai_parameter_a($is_sub_golongan,$keterangan,$suhu,$keterangan_nilai,$golongan,$ket_nilai){
	$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='$golongan' and nilai='".$suhu."' and keterangan_nilai='".$keterangan_nilai."' GROUP BY is_sub_golongan,keterangan_nilai");
					while($row=mysql_fetch_array($sql)){
						$sql2=mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '$golongan'
											AND keterangan =  '".$keterangan."'
											AND is_sub_golongan='".$is_sub_golongan."'
											");
						




						while($row2=mysql_fetch_array($sql2)){
							$nilai_a=$row2['nilai_bawah'];
							$nilai_c=$row2['nilai_atas'];
							
						$nilai_tengah_awal=$nilai_c-$nilai_a;
						$nilai_tengah_pros=$nilai_tengah_awal / 2;
						$nilai_tengah_akhir=$row2['nilai_bawah']+$nilai_tengah_pros;
							if($row['is_sub_golongan'] == 1){
													if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
													
													$Formula="(d-x) / (d-c)";
													$hasil=($row2['nilai_atas']-$suhu) / ($row2['nilai_atas']-$nilai_tengah_akhir);
												
													}else if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$Formula="(x-a) / (b-a)";
														$hasil=@(($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']));
													}else{
														$Formula="0";
														$hasil=0;
													}
												
											}else{
													if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$Formula="(x-a) / (b-a)";
														$hasil=($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']);
													}else if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
														$Formula="(c-x) / (c-b)";
														$hasil=@(($nilai_c-$suhu) / ($nilai_c-$nilai_tengah_akhir));
													}else{
														$Formula="0";
														$hasil=0;
													}
											}
					
						
						}
							if($row['is_sub_golongan'] == 1){
								if($ket_nilai == "a"){
									return $nilai_a;
								}else if($ket_nilai == "b"){
									return $nilai_c;
								}else if($ket_nilai == "c"){
									return number_format($nilai_tengah_akhir,2);
								}
								else if($ket_nilai == "r"){
									return $Formula;
								}
								else if($ket_nilai == "h"){
									return number_format($hasil,2);
								}		
							}else{
								if($ket_nilai == "a"){
									return $nilai_a;
								}else if($ket_nilai == "b"){
									return number_format($nilai_tengah_akhir,2);
								}else if($ket_nilai == "c"){
									return number_format($nilai_c,2);
								}
								else if($ket_nilai == "r"){
									return $Formula;
								}
								else if($ket_nilai == "h"){
									return number_format($hasil,2);
								}
							}
					
					}
}
?>


<!DOCTYPE html>
<script>



</script>

    <div class="main-panel">
		

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
      <div class="container-fluid">
		<div class="panel panel-default">
				<div class="datatable">
				<div class="container">
				 
				  <ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#menu1">Temperature</a></li>
					<li><a data-toggle="tab" href="#menu2">Soil Moisture</a></li>
					<li><a data-toggle="tab" href="#menu3">Humidity</a></li>
					<li><a data-toggle="tab" href="#menu4">Light Intensity</a></li>
					<li><a data-toggle="tab" href="#menu5">Result</a></li>
				  </ul>

				  <div class="tab-content">
				    <div id="menu1" class="tab-pane fade in active"><br /><br />
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<!-- PERHITUNGAN UNTUK INSEIDE TEMPERATURE -------------------------------------------------------------------------------------------->
					  <div class="col-md-12">
					  
					<table class="table table-bordered" style="width:300px">
						<tr>
							<td>TEMPERATURE</td>
							<td><?php echo $_POST['suhu']; ?></td>
							
						</tr>
						
					</table>
						<div style="height:60px;width:800px;background-color:white;z-index: 99;margin-top:30px; position: absolute"></div>
						<div id="chartContainer" style="height: 370px;width:800px;"></div>
					 
					
					</div>
					
								<table class='table table-bordered'>
									<tr>
										<td>Membership Function</td>
									</tr>									
									<?php
									mysql_query("delete from tb_hasil");
									mysql_query("delete from tb_hasil_2");
									$suhu=$_POST['suhu'];
									$nomor=1;
									$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='0' and nilai='".$_POST['suhu']."' GROUP BY is_sub_golongan,keterangan_nilai");
									while($row=mysql_fetch_array($sql)){
										$sql2=mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
															FROM  `tb_rule` 
															WHERE is_golongan =  '0'
															AND keterangan =  '".$row['keterangan']."'
															AND is_sub_golongan='".$row['is_sub_golongan']."'
															");
									while($row2=mysql_fetch_array($sql2)){
							$nilai_a=number_format($row2['nilai_bawah'],2);
							$nilai_c=number_format($row2['nilai_atas'],2);
							
						$nilai_tengah_awal=$nilai_c-$nilai_a;
						$nilai_tengah_pros=$nilai_tengah_awal / 2;
						$nilai_tengah_akhir=number_format($row2['nilai_bawah']+$nilai_tengah_pros,2);
							if($row['is_sub_golongan'] == 1){
													if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
													
													$Formula="(d-x) / (d-c)";
													$hasil=($row2['nilai_atas']-$suhu) / ($row2['nilai_atas']-$nilai_tengah_akhir);
												
													}else if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$Formula="(x-a) / (b-a)";
														$hasil=@(($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']));
													}else{
														$Formula="0";
														$hasil=0;
													}
												
											}else{
													if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$Formula="(x-a) / (b-a)";
														$hasil=($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']);
													}else if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
														$Formula="(c-x) / (c-b)";
														$hasil=@(($nilai_c-$suhu) / ($nilai_c-$nilai_tengah_akhir));
													}else{
														$Formula="0";
														$hasil=0;
													}
											}
					mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','0','".$_POST['suhu']."','".$row['keterangan_nilai']."','".number_format($hasil,2)."')");
										
						
						}
										
											
										
										$nomor++;
									}
									?>
								</table>
								
								
								
								
				
				<table class="table table-bordered" style="width:900px">
					
					<?php
						$nomor=1;
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='0' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						if($row['is_sub_golongan'] == 1){
												$nama_golongan="Trapezoid"; //menentukan dia masuk ke kurva mana
												$nilai_b="D";
											}else{
												$nama_golongan="Triangle";
												$nilai_b="B";
											}
						echo"
						<tr>
						<td colspan='5' style='background-color:silver'>".$row['keterangan_nilai']."</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>(A)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['suhu'],$row['keterangan_nilai'],0,"a")."</td>
							<td>(C)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['suhu'],$row['keterangan_nilai'],0,"c")."</td>
							<td>($nilai_b)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['suhu'],$row['keterangan_nilai'],0,"b")."</td>
							<td>(Formula)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['suhu'],$row['keterangan_nilai'],0,"r")."</td>
							<td>(Result)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['suhu'],$row['keterangan_nilai'],0,"h")."</td>
							
						</tr>
						";
						
					}
					?>
				</table>
				
				
				
					</div>
					
				<!-- PERHITUNGAN UNTUK INSEIDE TEMPERATURE -------------------------------------------------------------------------------------------->
					

























































<!-- PERHITUNGAN UNTUK SOIL MOISTURE -------------------------------------------------------------------------------------------->
					
					
					 <div id="menu2" class="tab-pane fade in ">
					 <br />
					   <div class="col-md-12">
					<table class="table table-bordered" style="width:300px">
						<tr>
							<td>SOIL MOISTURE</td>
							<td><?php echo $_POST['sm']; ?>
						</tr>
					</table>


					<div style="height:60px;width:800px;background-color:white;z-index: 99;margin-top:30px; position: absolute"></div>
						
			<div id="chartContainer2" style="height: 370px;width:800px;"></div>
					 </div>
					 
				<table class='table table-bordered'>
						
					<?php
					$nomor=1;
					$suhu=$_POST['sm'];
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='1' and nilai='".$_POST['sm']."' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						$sql2=mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '1'
											AND keterangan =  '".$row['keterangan']."'
											AND is_sub_golongan='".$row['is_sub_golongan']."'
											");
								while($row2=mysql_fetch_array($sql2)){
							$nilai_a=number_format($row2['nilai_bawah'],2);
							$nilai_c=number_format($row2['nilai_atas'],2);
							
						$nilai_tengah_awal=$nilai_c-$nilai_a;
						$nilai_tengah_pros=$nilai_tengah_awal / 2;
						$nilai_tengah_akhir=number_format($row2['nilai_bawah']+$nilai_tengah_pros,2);
							if($row['is_sub_golongan'] == 1){
													if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
													
													$rumus="(d-x) / (d-c)";
													$hasil=($row2['nilai_atas']-$suhu) / ($row2['nilai_atas']-$nilai_tengah_akhir);
												
													}else if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=@(($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']));
													}else{
														$rumus="0";
														$hasil=0;
													}
												
											}else{
													if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']);
													}else if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
														$rumus="(c-x) / (c-b)";
														$hasil=@(($nilai_c-$suhu) / ($nilai_c-$nilai_tengah_akhir));
													}else{
														$rumus="0";
														$hasil=0;
													}
											}
					mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','1','".$_POST['sm']."','".$row['keterangan_nilai']."','".number_format($hasil,2)."')");
										
						
						}
						$nomor++;
					}
					?>
					</table>
					
					 				
				<br /><br /><br />
				<table class="table table-bordered" style="width:900px">
					<tr>
										<td>Membership Function</td>
									</tr>	
					
					<?php
						$nomor=1;
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='1' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						if($row['is_sub_golongan'] == 1){
												$nama_golongan="Trapezoid";
													$nilai_b="D";
											}else{
												$nama_golongan="Triangle";
													$nilai_b="B";
											}
						echo"
						<tr>
						<td colspan='5' style='background-color:silver'>".$row['keterangan_nilai']."</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>(A)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['sm'],$row['keterangan_nilai'],1,"a")."</td>
							<td>(C)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['sm'],$row['keterangan_nilai'],1,"c")."</td>
							<td>($nilai_b)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['sm'],$row['keterangan_nilai'],1,"b")."</td>
							<td>(Formula)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['sm'],$row['keterangan_nilai'],1,"r")."</td>
							<td>(Result)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['sm'],$row['keterangan_nilai'],1,"h")."</td>
							
						</tr>
						";
		
					}
					?>
				</table>
				
					 
					 </div>
	<!-- PERHITUNGAN UNTUK SOIL MOISTURE -------------------------------------------------------------------------------------------->
	


















































<!-- PERHITUNGAN UNTUK HUMIDITY -------------------------------------------------------------------------------------------->
	
	
					 <div id="menu3" class="tab-pane fade in ">
					 
					<h4></h2><br />
					  <div class="col-md-12">
						<table class="table table-bordered" style="width:300px">
						<tr>
							<td>HUMIDITY</td>
							<td><?php echo $_POST['hm']; ?>
						</tr>
					</table>
					<div style="height:60px;width:800px;background-color:white;z-index: 99;margin-top:30px; position: absolute"></div>
						
					<div id="chartContainer3" style="height: 370px;width:900px;"></div>
					 </div>
					
				<table class='table table-bordered'>
					
					<?php
					$nomor=1;
					$suhu=$_POST['hm'];
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='2' and nilai='".$_POST['hm']."' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						$sql2=mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '2'
											AND keterangan =  '".$row['keterangan']."'
											AND is_sub_golongan='".$row['is_sub_golongan']."'
											");
							while($row2=mysql_fetch_array($sql2)){
							$nilai_a=number_format($row2['nilai_bawah'],2);
							$nilai_c=number_format($row2['nilai_atas'],2);
							
						$nilai_tengah_awal=$nilai_c-$nilai_a;
						$nilai_tengah_pros=$nilai_tengah_awal / 2;
						$nilai_tengah_akhir=number_format($row2['nilai_bawah']+$nilai_tengah_pros,2);
							if($row['is_sub_golongan'] == 1){
													if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
													
													$rumus="(d-x) / (d-c)";
													$hasil=($row2['nilai_atas']-$suhu) / ($row2['nilai_atas']-$nilai_tengah_akhir);
												
													}else if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=@(($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']));
													}else{
														$rumus="0";
														$hasil=0;
													}
												
											}else{
													if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']);
													}else if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
														$rumus="(c-x) / (c-b)";
														$hasil=@(($nilai_c-$suhu) / ($nilai_c-$nilai_tengah_akhir));
													}else{
														$rumus="0";
														$hasil=0;
													}
											}
					mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','2','".$_POST['hm']."','".$row['keterangan_nilai']."','".number_format($hasil,2)."')");
										
						
						}
						$nomor++;
					}
					?>
					</table>
					
					 
						
								
				<br /><br /><br />
				<table class="table table-bordered" style="width:900px">
					<tr>
										<td>Membership Function</td>
									</tr>
				
					<?php
						$nomor=1;
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='2' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						if($row['is_sub_golongan'] == 1){
												$nama_golongan="Trapezoid";
													$nilai_b="D";
											}else{
												$nama_golongan="Triangle";
													$nilai_b="B";
											}
						echo"
						<tr>
						<td colspan='5' style='background-color:silver'>".$row['keterangan_nilai']."</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>(A)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"a")."</td>
							<td>(C)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"c")."</td>
							<td>($nilai_b)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"b")."</td>
							<td>(Formula)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"r")."</td>
							<td>(Result)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"h")."</td>
							
						</tr>
						";
						
					}
					?>
				</table>
				
					 </div>
					 
	<!-- PERHITUNGAN UNTUK HUMIDITY -------------------------------------------------------------------------------------------->
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 


<!-- PERHITUNGAN UNTUK LIGHT -------------------------------------------------------------------------------------------->
	
	
					 <div id="menu4" class="tab-pane fade in ">
					 
					<h4></h2><br />
					  <div class="col-md-12">
						<table class="table table-bordered" style="width:300px">
						<tr>
							<td>LIGHT INTENSITY</td>
							<td><?php echo $_POST['li']; ?>
						</tr>
					</table>
<div style="height:60px;width:800px;background-color:white;z-index: 99;margin-top:30px; position: absolute"></div>
						
					<div id="chartContainer5" style="height: 370px;width:900px;"></div>
					 </div>
					
				<table class='table table-bordered'>
						
					<?php
					$nomor=1;
					$suhu=$_POST['li'];
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='3' and nilai='".$_POST['li']."' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						$sql2=mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '3'
											AND keterangan =  '".$row['keterangan']."'
											AND is_sub_golongan='".$row['is_sub_golongan']."'
											");
							while($row2=mysql_fetch_array($sql2)){
							$nilai_a=$row2['nilai_bawah'];
							$nilai_c=$row2['nilai_atas'];
							
						$nilai_tengah_awal=$nilai_c-$nilai_a;
						$nilai_tengah_pros=$nilai_tengah_awal / 2;
						$nilai_tengah_akhir=$row2['nilai_bawah']+$nilai_tengah_pros;
						if($row['is_sub_golongan'] == 1){
													if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
													
													$rumus="(d-x) / (d-c)";
													$hasil=($row2['nilai_atas']-$suhu) / ($row2['nilai_atas']-$nilai_tengah_akhir);
												
													}else if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=@(($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']));
													}else{
														$rumus="0";
														$hasil=0;
													}
												
											}else{
													if($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir){
														$rumus="(x-a) / (b-a)";
														$hasil=($suhu-$row2['nilai_bawah']) / ($nilai_tengah_akhir-$row2['nilai_bawah']);
													}else if($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']){
														$rumus="(c-x) / (c-b)";
														$hasil=@(($nilai_c-$suhu) / ($nilai_c-$nilai_tengah_akhir));
													}else{
														$rumus="0";
														$hasil=0;
													}
											}
					mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','3','".$_POST['li']."','".$row['keterangan_nilai']."','".number_format($hasil,2)."')");
										
						
						}
						$nomor++;
					}
					?>
					</table>
					
					 
						
								
				<br /><br /><br />
				<table class="table table-bordered" style="width:900px">
					<tr>
										<td>Membership Function</td>
									</tr>
				
					<?php
						$nomor=1;
					$sql=mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='3' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
					while($row=mysql_fetch_array($sql)){
						if($row['is_sub_golongan'] == 1){
												$nama_golongan="Trapezoid";
													$nilai_b="D";
											}else{
												$nama_golongan="Triangle";
													$nilai_b="B";
											}
											if($row['keterangan_nilai'] == "gelap"){
												$ket="Dark";
											}else if($row['keterangan_nilai'] == "redup"){
												$ket="Rather Dim";
											}else if($row['keterangan_nilai'] == "agak_terang"){
												$ket="Rather Bright";
											}else if($row['keterangan_nilai'] == "terang"){
												$ket="Bright";
											}else{
												$ket=$row['keterangan_nilai'];
											}
						echo"
						<tr>
						<td colspan='5' style='background-color:silver'>".$ket."</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>(A)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['li'],$row['keterangan_nilai'],3,"a")."</td>
							<td>(C)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['li'],$row['keterangan_nilai'],3,"c")."</td>
							<td>($nilai_b)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['li'],$row['keterangan_nilai'],3,"b")."</td>
							<td>(Formula)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['li'],$row['keterangan_nilai'],3,"r")."</td>
							<td>(Result)=".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['li'],$row['keterangan_nilai'],3,"h")."</td>
							
						</tr>
						";
						
					}
					?>
				</table>
				
					 </div>
					 
	<!-- PERHITUNGAN UNTUK LIGHT -------------------------------------------------------------------------------------------->
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
					 
	 
					 
					 
					  <div id="menu5" class="tab-pane fade in ">
					  
					  
				
					
										 
				
<!-- PERHITUNGAN UNTUK FUZYFICATION -------------------------------------------------------------------------------------------->
	
					<hr />
					<h4>FUZZYCATION</h1>
					<table class='table table-bordered' style="width:930px">
						<?php
						$ra=0;
						function get_rule_kondisi($kondisi_1,$kondisi_2,$kondisi_3){
							$sql=mysql_query("SELECT * from tb_rule_kondisi where kondisi_1 LIKE '%$kondisi_1%' and kondisi_2 LIKE '".$kondisi_2."'  and kondisi_3 LIKE '".$kondisi_3."' ");
								while($row=mysql_fetch_array($sql)){
									$kondisi=$row['hasil'];
								}
								return $kondisi;
						}
							$sql=mysql_query("SELECT * from tb_hasil where golongan='0' ");
								while($row=mysql_fetch_array($sql)){
										
							
									
									echo"
										
									";
									$sql2=mysql_query("SELECT * from tb_hasil where golongan='1' ");
								while($row_6=mysql_fetch_array($sql2)){
									$sql3=mysql_query("SELECT * from tb_hasil where golongan='2' ");
										while($row_7=mysql_fetch_array($sql3)){
												$sql4=mysql_query("SELECT * from tb_hasil where golongan='3' ");
													while($row_8=mysql_fetch_array($sql4)){
														if($row_8['keterangan'] == "gelap"){
												$ket="Dark";
											}else if($row_8['keterangan'] == "redup"){
												$ket="Rather Dim";
											}else if($row_8['keterangan'] == "agak_terang"){
												$ket="Rather Bright";
											}else if($row_8['keterangan'] == "terang"){
												$ket="Bright";
											}else{
												$ket=$row_8['keterangan'];
											}
											/*
														echo"
														<tr>
															<td>".$row['keterangan']." </td> <td>".$row_6['keterangan']."</td> <td>".$row_7['keterangan']." <td>".$ket."</td>
															<td>".get_rule_kondisi($row['keterangan'],$row_6['keterangan'],$row_7['keterangan'],$row_8['keterangan'])."</td>
														</tr>
														";
											*/
											echo"
														<tr>
															<td>".$row['keterangan']." </td>
															<td>".$row['hasil']." </td> 															
															<td>".$row_6['keterangan']."</td> 
															<td>".$row_6['hasil']."</td> 
															
															<td>".$row_7['keterangan']."</td>
															<td>".$row_7['hasil']."</td>
															
															<td>".$ket."</td>
															<td>".$row_8['hasil']."</td>
															
														</tr>
														";
													}
										}
								}
									
							$ra++;
							}
						?>
					</table>
					<hr />
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
										 
				
<!-- PERHITUNGAN UNTUK APPLICATION -------------------------------------------------------------------------------------------->
	
						<h4>APPLICATION</h1>
					<table class='table table-bordered' style="width:930px">
						<?php
						$ra=0;
						
							$sql=mysql_query("SELECT * from tb_hasil where golongan='0' ");
								while($row=mysql_fetch_array($sql)){
										
							
									
									echo"
										
									";
									$sql2=mysql_query("SELECT * from tb_hasil where golongan='1' ");
								while($row_6=mysql_fetch_array($sql2)){
									$sql22=mysql_query("SELECT * from tb_hasil where golongan='2' ");
									while($row_7=mysql_fetch_array($sql22)){
										$sql4=mysql_query("SELECT * from tb_hasil where golongan='3' ");
													while($row_8=mysql_fetch_array($sql4)){
																if($row_8['keterangan'] == "gelap"){
												$ket="Dark";
											}else if($row_8['keterangan'] == "redup"){
												$ket="Rather Dim";
											}else if($row_8['keterangan'] == "agak_terang"){
												$ket="Rather Bright";
											}else if($row_8['keterangan'] == "terang"){
												$ket="Bright";
											}else{
												$ket=$row_8['keterangan'];
											}
											/*
															echo"
															<tr>
																<td>".$row['keterangan']." </td> <td>".$row_6['keterangan']."</td><td>".$row_7['keterangan']."</td><td>".$ket."</td>
																<td>".get_rule_kondisi($row['keterangan'],$row_6['keterangan'],$row_7['keterangan'],$row_8['keterangan'])."</td>
																<td>MIN(".$row['hasil'].",".$row_6['hasil'].",".$row_7['hasil'].",".$row_8['hasil'].")</td>
																<td>".MIN($row['hasil'],$row_6['hasil'],$row_7['hasil'],$row_8['hasil'])."</td>
																
															</tr>
															";
														*/
														echo"
															<tr>
																<td>".$row['keterangan']." </td> <td>".$row_6['keterangan']."</td><td>".$row_7['keterangan']."</td><td>".$ket."</td>
																<td>MIN(".$row['hasil'].",".$row_6['hasil'].",".$row_7['hasil'].",".$row_8['hasil'].")</td>
																<td>".MIN($row['hasil'],$row_6['hasil'],$row_7['hasil'],$row_8['hasil'])."</td>
																
															</tr>
															";
													}
									}
								}
									
							$ra++;
							}
						?>
					</table>
					<hr />
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
										 
				
<!-- PERHITUNGAN UNTUK FUZYFICATION -------------------------------------------------------------------------------------------->
	
							<h4>IMPLICATION</h1>
					<table class='table table-bordered' style="width:930px">
						<?php
						$ra=0;
						$nomor=1;
							$sql=mysql_query("SELECT * from tb_hasil where golongan='0' ");
								while($row=mysql_fetch_array($sql)){
											
									
									echo"
										
									";
									$sql2=mysql_query("SELECT * from tb_hasil where golongan='1' ");
								while($row_6=mysql_fetch_array($sql2)){
									$sql22=mysql_query("SELECT * from tb_hasil where golongan='2' ");
									while($row_7=mysql_fetch_array($sql22)){
										$sql4=mysql_query("SELECT * from tb_hasil where golongan='3' ");
													while($row_8=mysql_fetch_array($sql4)){
														if($row_8['keterangan'] == "gelap"){
												$ket="Dark";
											}else if($row_8['keterangan'] == "redup"){
												$ket="Rather Dim";
											}else if($row_8['keterangan'] == "agak_terang"){
												$ket="Rather Bright";
											}else if($row_8['keterangan'] == "terang"){
												$ket="Bright";
											}else{
												$ket=$row_8['keterangan'];
											}
							
															echo"
															<tr>
																<td>".$row['keterangan']." </td> <td>".$row_6['keterangan']."</td><td>".$row_7['keterangan']."</td><td>".$ket."</td>
																<td>".get_rule_kondisi($row['keterangan'],$row_6['keterangan'],$row_7['keterangan'],$row_8['keterangan'])."</td>
																<td>".MIN($row['hasil'],$row_6['hasil'],$row_7['hasil'],$row_8['hasil'])."</td>
																
															</tr>
															";
									
														mysql_query("INSERT INTO tb_hasil_2(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','".get_rule_kondisi($row['keterangan'],$row_6['keterangan'],$row_7['keterangan'],$row_8['keterangan'])."','".$_POST['suhu']."','".$row['keterangan']."','".MIN($row['hasil'],$row_6['hasil'],$row_7['hasil'],$row_8['hasil'])."')");
													}
									}
								}
							
							$ra++;
							$nomor++;
							}
						?>
					</table>
					<hr />
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
									 
				
<!-- PERHITUNGAN UNTUK FUZYFICATION -------------------------------------------------------------------------------------------->
	
								<h4>AGREGATION</h1>
					<table class='table table-bordered' style="width:930px">
						<?php
						function get_duration($kondisi_1,$nilai_set){
							$nilai=0;
							$sql=mysql_query("SELECT * from tb_rule_duration where keterangan='".$kondisi_1."' LIMIT 0,4");
								while($row=mysql_fetch_array($sql)){
									$nilai=$nilai+$row['nilai'];
								}
								$nilanya=$nilai*$nilai_set;
								return $nilanya;
						}
						$ra=0;
						$nomor=1;
							$total=0;
							$total_bagi=0;
							$sql=mysql_query("SELECT golongan,MAX(hasil)as total_max from tb_hasil_2 GROUP BY golongan ");
								while($row=mysql_fetch_array($sql)){
									$total_set=$row['total_max']*4;
									echo"<tr><td>".$row['golongan']." ".$row['total_max']."</td></tr>";
									$total=$total+get_duration($row['golongan'],$row['total_max']);
									$total_bagi=$total_bagi+$total_set;
							$ra++;
							$nomor++;
							}
							echo"";
						?>
					</table>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
										 
				
<!-- PERHITUNGAN UNTUK DEFUZYFICATION -------------------------------------------------------------------------------------------->
	
					<h4>DEFUZZYFICATION</h1>
					<table class='table table-bordered'>
					<?php
							$hasil_meni=$total / $total_bagi;
							echo"<tr><td>".round($hasil_meni)." Detik</td></tr>";
							
							mysql_query("UPDATE tb_hasil_menit SET tanggal='".$_POST['tanggal']."',suhu='".$_POST['suhu']."',sm='".$_POST['sm']."',humidity='".$_POST['hm']."',li='".$_POST['li']."',nilai='".round($hasil_meni)."' where id_hasil='".$_POST['id_hasil']."'");
					
					?>
					</table>
			

					<hr />
					  </div>
				 </div>
				</div>
				
					
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				</div>
			</div>
	  </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
    </div>
	  </div>
	    </div>
		  </div>
  <!-- /#wrapper -->
    <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/jquery.canvasjs.min.js"></script>
  
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
