<?php
session_start();
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>

<!--
tabel dalam database yang digunakan dalamperhitungan
1.tb rule
2.tb rule duration
3.tb rul kondisi4.tb hasil_2
4.tb hasil
-->

<?php
function get_ket($suhu, $nilai)
{
	$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='$suhu' and nilai='" . $nilai . "' GROUP BY is_sub_golongan,keterangan_nilai");
	$set = "SELECT * FROM `tb_rule` WHERE is_golongan='$suhu' and nilai='" . $nilai . "' GROUP BY is_sub_golongan,keterangan_nilai";
	while ($row = mysql_fetch_array($sql)) {
		$data = $row['keterangan_nilai'];
	}
	return $set;
}
function nilai_parameter_a($is_sub_golongan, $keterangan, $suhu, $keterangan_nilai, $golongan, $ket_nilai)
{
	$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='$golongan' and nilai='" . $suhu . "' and keterangan_nilai='" . $keterangan_nilai . "' GROUP BY is_sub_golongan,keterangan_nilai");
	while ($row = mysql_fetch_array($sql)) {
		$sql2 = mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '$golongan'
											AND keterangan =  '" . $keterangan . "'
											AND is_sub_golongan='" . $is_sub_golongan . "'
											");





		while ($row2 = mysql_fetch_array($sql2)) {
			$nilai_a = $row2['nilai_bawah'];
			$nilai_c = $row2['nilai_atas'];

			$nilai_tengah_awal = $nilai_c - $nilai_a;
			$nilai_tengah_pros = $nilai_tengah_awal / 2;
			$nilai_tengah_akhir = $row2['nilai_bawah'] + $nilai_tengah_pros;
			if ($row['is_sub_golongan'] == 1) {

				if ($keterangan_nilai == "Very Cold" || $keterangan_nilai == "Very Dry" || $keterangan_nilai == "Very Low" || $keterangan_nilai == "gelap") {

					if ($suhu <= $nilai_a  || $suhu >= $nilai_c) {
						$Formula = "";
						$hasil = 0;
					} else if ($nilai_a <= $suhu && $suhu <= $nilai_tengah_akhir) {
						$Formula = "b ≤ x ≤ c";
						$hasil = 1;
					} else if ($nilai_tengah_akhir < $suhu && $suhu < $nilai_c) {
						$Formula = "(d-x) / (d-c)";
						$hasil = ($row2['nilai_atas'] - $suhu) / ($row2['nilai_atas'] - $nilai_tengah_akhir);
					}
					if ($suhu >= $nilai_c) {
						$Formula = "-";
						$hasil = 0;
					}
				} else {
					if ($suhu <= $nilai_a) {
						$Formula = "-";
						$hasil = 0;
					} else if ($nilai_a < $suhu && $suhu < $nilai_tengah_akhir) {
						$Formula = "(x-a) / (b-a)";
						$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
					} else if ($nilai_a <= $suhu && $suhu <= $nilai_c) {
						$Formula = "b ≤ x ≤ c";
						$hasil = 1;
					}
				}
			} else {
				if ($suhu <= $nilai_a || $suhu >= $nilai_c) {
					$Formula = "x≤a / x≥ c";
					$hasil = 0;
				} else if ($nilai_a <= $suhu && $suhu <= $nilai_tengah_akhir) {
					$Formula = "(x-a) / (b-a)";
					$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
				} else if ($nilai_tengah_akhir <= $suhu && $suhu <= $nilai_c) {
					$Formula = " (c-x) / (c-b)";
					$hasil = @(($nilai_c - $suhu) / ($nilai_c - $nilai_tengah_akhir));
				} else if ($suhu == $nilai_tengah_akhir) {
					$Formula = "";
					$hasil = 1;
				} else {
					$Formula = "asdasdasd-";
					$hasil = 1;
				}
			}
		}

		if ($keterangan_nilai == "Very Cold" || $keterangan_nilai == "Very Dry" || $keterangan_nilai == "Very Low" || $keterangan_nilai == "gelap") {
			if ($row['is_sub_golongan'] == 1) {
				if ($ket_nilai == "a") {
					return $nilai_a;
				} else if ($ket_nilai == "b") {
					return $nilai_c;
				} else if ($ket_nilai == "c") {

					return number_format($nilai_tengah_akhir, 2);
				} else if ($ket_nilai == "r") {
					return $Formula;
				} else if ($ket_nilai == "h") {
					return number_format($hasil, 2);
				}
			} else {
				if ($ket_nilai == "a") {
					return $nilai_a;
				} else if ($ket_nilai == "b") {
					return number_format($nilai_tengah_akhir, 2);
				} else if ($ket_nilai == "c") {
					return number_format($nilai_c, 2);
				} else if ($ket_nilai == "r") {
					return $Formula;
				} else if ($ket_nilai == "h") {
					return number_format($hasil, 2);
				}
			}
		} else {
			if ($row['is_sub_golongan'] == 1) {
				if ($ket_nilai == "a") {
					return $nilai_a;
				} else if ($ket_nilai == "b") {
					return number_format($nilai_tengah_akhir, 2);
				} else if ($ket_nilai == "c") {
					return $nilai_c;
				} else if ($ket_nilai == "r") {
					return $Formula;
				} else if ($ket_nilai == "h") {
					return number_format($hasil, 2);
				}
			} else {
				if ($ket_nilai == "a") {
					return $nilai_a;
				} else if ($ket_nilai == "b") {
					return number_format($nilai_tengah_akhir, 2);
				} else if ($ket_nilai == "c") {
					return number_format($nilai_c, 2);
				} else if ($ket_nilai == "r") {
					return $Formula;
				} else if ($ket_nilai == "h") {
					return number_format($hasil, 2);
				}
			}
		}
	}
}

$vc2 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very Dry'"));
$c2 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Dry'"));
$n2 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='1'"));
$h2 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Wet'"));
$vh2 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very Wet'"));


$vc3 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very Low'"));
$c3 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Low'"));
$n3 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='2'"));
$h3 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='High'"));
$vh3 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very High'"));

$vc4 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='gelap'"));
$c4 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='redup'"));
$n4 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='3'"));
$vh4 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='terang'"));
$h4 = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='agak_terang'"));


$vc = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very Cold'"));
$c = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Cold'"));
$n = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='0'"));
$h = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Hot'"));
$vh = mysql_num_rows(mysql_query("select * from tb_hasil where keterangan='Very Hot'"));

?>
<div class="container-fluid">

	<div class="panel panel-default">
		<div class="datatable">
			<div class="container">

				<ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
					<li class="nav-item active mr-1"><a data-toggle="tab" href="#menu1">Temperature</a></li>
					<li class="nav-item mr-1"><a data-toggle="tab" href="#menu2">Soil Moisture</a></li>
					<li class="nav-item mr-1"><a data-toggle="tab" href="#menu3">Humidity</a></li>
					<li class="nav-item mr-1"><a data-toggle="tab" href="#menu4">Intensity</a></li>
					<li class="nav-item mr-1"><a data-toggle="tab" href="#menu5">Result</a></li>
				</ul>

				<!-- <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">

						<a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" data-toggle="tab" href="#menu1">Temperature</a>
					</li>
					<li class="nav-item" role="presentation">

						<a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" data-toggle="tab" href="#menu2">Soil Moisture</a>
					</li>
					<li class="nav-item" role="presentation">

						<a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" data-toggle="tab" href="#menu3">Humidity</a>

					</li>
					<li class="nav-item" role="presentation">

						<a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" data-toggle="tab" href="#menu4">Intensity</a>

					</li>
					<li class="nav-item" role="presentation">

						<a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" data-toggle="tab" href="#menu5">Result</a>

					</li>
				</ul> -->

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

							<div style="height:50px;width:800px;background-color:white;z-index: 99;margin-top:30px; position: absolute">
								<!-- <table>
							<tr> -->
								<?php


								if (!empty($vc)) {
									echo '<span style="margin-left: 200px;">Very Cold</span>';
								}
								if (!empty($c)) {
									echo '<span style="margin-left: 330px;">Cold</span>';
								}
								if (!empty($n)) {
									echo '<span style="margin-left: 352px;">Normal</span>';
								}
								if (!empty($h)) {
									echo '<span style="margin-left: 400px;">Hot</span>';
								}
								if (!empty($vh)) {
									echo '<span style="margin-left: 250px;">Very Hot</span>';
								}
								?>

								<!-- </tr>
						</table> -->
							</div>
							<div style="margin-left:17px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:69px; position: absolute">
								<span style='color:black'>Y</span>

							</div>
							<div style="margin-left:800px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:325px; position: absolute">
								<span style='color:black'>Temperature (Celcius)</span>

							</div>
							<div style="margin-left:730px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:390px; position: absolute">

							</div>
							<div style="margin-left:1px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:387px; position: absolute">

							</div>
							<div id="chartContainer" style="height: 370px;width:800px;"></div>

							<br /><br />
						</div>

						<table class='table table-bordered'>
						</table>
						<br /><br /><br />
						<table class="table table-bordered" style="width:900px">
							<tr>
								<td>Fuzzy Set</td>
							</tr>
							<?php
							mysql_query("delete from tb_hasil");
							mysql_query("delete from tb_hasil_2");
							$suhu = $_POST['suhu'];
							$nomor = 1;
							$nomor1 = 1;
							$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='0' and nilai='" . $_POST['suhu'] . "' GROUP BY is_sub_golongan,keterangan_nilai");
							while ($row = mysql_fetch_array($sql)) {
								$sql2 = mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
															FROM  `tb_rule` 
															WHERE is_golongan =  '0'
															AND keterangan =  '" . $row['keterangan'] . "'
															AND is_sub_golongan='" . $row['is_sub_golongan'] . "'
															");

								while ($row2 = mysql_fetch_array($sql2)) {
									$nilai_a = number_format($row2['nilai_bawah'], 2);
									$nilai_c = number_format($row2['nilai_atas'], 2);

									$nilai_tengah_awal = $nilai_c - $nilai_a;
									$nilai_tengah_pros = $nilai_tengah_awal / 2;
									$nilai_tengah_akhir = number_format($row2['nilai_bawah'] + $nilai_tengah_pros, 2);
									if ($row['is_sub_golongan'] == 1) {
										if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {

											$Formula = "(d-x) / (d-c)";
											$hasil = ($row2['nilai_atas'] - $suhu) / ($row2['nilai_atas'] - $nilai_tengah_akhir);
										} else if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
											$Formula = "(x-a) / (b-a)";
											$hasil = @(($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']));
										} else {
											$Formula = "0";
											$hasil = 0;
										}
									} else {
										if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
											$Formula = "(x-a) / (b-a)";
											$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
										} else if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {
											$Formula = "(c-x) / (c-b)";
											$hasil = @(($nilai_c - $suhu) / ($nilai_c - $nilai_tengah_akhir));
										} else {
											$Formula = "0";
											$hasil = 0;
										}
									}
								}

								$nomor1++;

								$nomor++;
							}
							?>
						</table>





						<table class="table table-bordered" style="width:900px">

							<?php
							$nomor = 1;
							$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='0' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
							while ($row = mysql_fetch_array($sql)) {
								if ($row['is_sub_golongan'] == 1) {
									$nama_golongan = "Trapezoid"; //menentukan dia masuk ke kurva mana
									$nilai_b = "D";
								} else {
									$nama_golongan = "Triangle";
									$nilai_b = "B";
								}


								echo "
						<tr>
						<td colspan='5' style='background-color:silver'>" . $row['keterangan_nilai'] . "</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						";
								if ($row['keterangan_nilai'] == "Very Cold") {
									$status_a = "(B)";
									$status_c = "(C)";
									$status_d = "(D)";
									echo "
							<tr>
							<td>$status_a=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "a") . "</td>
							<td>$status_c=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "c") . "</td>
							
							<td>$status_d=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "b") . "</td>
							
							<td>(Formula)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "r") . "</td>
							<td>(Result)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "h") . "</td>
							
						</tr>
							";
								} else {
									$status_a = "(A)";
									$status_c = "(C)";
									$status_d = "(B)";
									echo "
							<tr>
							<td>$status_a=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "a") . "</td>
							<td>$status_d=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "b") . "</td>
							
							<td>$status_c=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "c") . "</td>
							<td>(Formula)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "r") . "</td>
							<td>(Result)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "h") . "</td>
							
						</tr>
							";
								}

								if (nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "h") == "") { } else {
									mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil,nomor)VALUES('$nomor','0','" . $_POST['suhu'] . "','" . $row['keterangan_nilai'] . "','" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['suhu'], $row['keterangan_nilai'], 0, "h") . "','$nomor1')");
								}
								echo "
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
							<div style="height:30px;width:800px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:30px; position:absolute ">
								<!-- <table>
							<tr> -->
								<?php


								if (!empty($vc2)) {
									echo '<span style="margin-left: 100px;">Very Dry</span>';
								}
								if (!empty($c2)) {
									echo '<span style="margin-left: 230px;">Dry</span>';
								}
								if (!empty($n2)) {
									echo '<span style="margin-left: 130px;">Normal</span>';
								}
								if (!empty($h2)) {
									echo '<span style="margin-left: 160px;">Wet</span>';
								}
								if (!empty($vh2)) {
									echo '<span style="margin-left: 240px;">Very Wet</span>';
								}
								?>

								<!-- </tr>
						</table> -->
							</div>
							<div style="margin-left:17px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:69px; position: absolute">
								<span style='color:black'>Y</span>

							</div>
							<div style="margin-left:500px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:355px; position: absolute">
								<span style='color:black'>Soil Moisture (%)</span>

							</div>
							<div style="margin-left:730px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:390px; position: absolute">

							</div>
							<div style="margin-left:1px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:387px; position: absolute">

							</div>

							<div id="chartContainer2" style="height: 370px;width:800px;"></div>

							<br /><br />
						</div>

						<table class='table table-bordered'>

							<?php
							$nomor = 1;
							$nomor2 = 3;
							$suhu = $_POST['sm'];
							$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='1' and nilai='" . $_POST['sm'] . "' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
							while ($row = mysql_fetch_array($sql)) {
								$sql2 = mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '1'
											AND keterangan =  '" . $row['keterangan'] . "'
											AND is_sub_golongan='" . $row['is_sub_golongan'] . "'
											");
								while ($row2 = mysql_fetch_array($sql2)) {
									$nilai_a = number_format($row2['nilai_bawah'], 2);
									$nilai_c = number_format($row2['nilai_atas'], 2);

									$nilai_tengah_awal = $nilai_c - $nilai_a;
									$nilai_tengah_pros = $nilai_tengah_awal / 2;
									$nilai_tengah_akhir = number_format($row2['nilai_bawah'] + $nilai_tengah_pros, 2);
									if ($row['is_sub_golongan'] == 1) {
										if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {

											$rumus = "(d-x) / (d-c)";
											$hasil = ($row2['nilai_atas'] - $suhu) / ($row2['nilai_atas'] - $nilai_tengah_akhir);
										} else if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
											$rumus = "(x-a) / (b-a)";
											$hasil = @(($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']));
										} else {
											$rumus = "0";
											$hasil = 0;
										}
									} else {
										if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
											$rumus = "(x-a) / (b-a)";
											$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
										} else if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {
											$rumus = "(c-x) / (c-b)";
											$hasil = @(($nilai_c - $suhu) / ($nilai_c - $nilai_tengah_akhir));
										} else {
											$rumus = "0";
											$hasil = 0;
										}
									}
								}
								$nomor++;
								$nomor2++;
							}
							?>
						</table>


						<br /><br /><br />
						<table class="table table-bordered" style="width:900px">
							<tr>
								<td>Fuzzy Set</td>
							</tr>

							<?php
							$nomor = 1;

							$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='1' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
							while ($row = mysql_fetch_array($sql)) {
								if ($row['is_sub_golongan'] == 1) {
									$nama_golongan = "Trapezoid";
									$nilai_b = "D";
								} else {
									$nama_golongan = "Triangle";
									$nilai_b = "B";
								}
								if ($row['keterangan_nilai'] == "Very Dry") {
									$status_a = "(B)";
									$status_c = "(C)";
									$status_d = "(D)";
								} else {
									$status_a = "(A)";
								}

								if ($row['keterangan_nilai'] == "Very Wet") {

									$status_d = "(B)";
									$status_c = "(C)";
								}
								if ($row['keterangan_nilai'] == "Dry") {
									$status_a = "(A)";

									$status_d = "(B)";
									$status_c = "(C)";
								}

								echo "
						<tr>
						<td colspan='5' style='background-color:silver'>" . $row['keterangan_nilai'] . "</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>$status_a=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "a") . "</td>
							<td>$status_d=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "b") . "</td>
							
							<td>$status_c=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "c") . "</td>
							<td>(Formula)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "r") . "</td>
							<td>(Result)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "h") . "</td>
							
						</tr>
						";
								if (nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "h") == "") { } else {
									mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil,nomor)VALUES('$nomor','1','" . $_POST['sm'] . "','" . $row['keterangan_nilai'] . "','" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['sm'], $row['keterangan_nilai'], 1, "h") . "','$nomor2')");
								}
							}
							?>
						</table>


					</div>
					<!-- PERHITUNGAN UNTUK SOIL MOISTURE -------------------------------------------------------------------------------------------->

					<!-- PERHITUNGAN UNTUK HUMIDITY -------------------------------------------------------------------------------------------->


					<div id="menu3" class="tab-pane fade in ">

						<h4>
							</h2><br />
							<div class="col-md-12">
								<table class="table table-bordered" style="width:300px">
									<tr>
										<td>HUMIDITY</td>
										<td><?php echo $_POST['hm']; ?>
									</tr>
								</table>
								<div style="height:30px;width:800px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:30px; position:absolute ">
									<!-- <table>
							<tr> -->
									<?php


									if (!empty($vc3)) {
										echo '<span style="margin-left: 100px;">Very Low</span>';
									}
									if (!empty($c3)) {
										echo '<span style="margin-left: 190px;">Low</span>';
									}
									if (!empty($n3)) {
										echo '<span style="margin-left: 230px;">Normal</span>';
									}
									if (!empty($h3)) {
										echo '<span style="margin-left: 250px;">High</span>';
									}
									if (!empty($vh3)) {
										echo '<span style="margin-left: 160px;">Very High</span>';
									}
									?>

									<!-- </tr>
						</table> -->
								</div>
								<div style="margin-left:17px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:69px; position: absolute">
									<span style='color:black'>Y</span>

								</div>
								<div style="margin-left:500px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:355px; position: absolute">
									<span style='color:black'>Humidity (%)</span>

								</div>
								<div style="margin-left:730px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:390px; position: absolute">

								</div>
								<div style="margin-left:1px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:387px; position: absolute">

								</div>
								<div id="chartContainer3" style="height: 370px;width:800px;"></div>
								<br /><br />
							</div>

							<table class='table table-bordered'>

								<?php
								$nomor = 1;
								$nomor3 = 5;
								$suhu = $_POST['hm'];
								$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='2' and nilai='" . $_POST['hm'] . "' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
								while ($row = mysql_fetch_array($sql)) {
									$sql2 = mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '2'
											AND keterangan =  '" . $row['keterangan'] . "'
											AND is_sub_golongan='" . $row['is_sub_golongan'] . "'
											");
									while ($row2 = mysql_fetch_array($sql2)) {
										$nilai_a = number_format($row2['nilai_bawah'], 2);
										$nilai_c = number_format($row2['nilai_atas'], 2);

										$nilai_tengah_awal = $nilai_c - $nilai_a;
										$nilai_tengah_pros = $nilai_tengah_awal / 2;
										$nilai_tengah_akhir = number_format($row2['nilai_bawah'] + $nilai_tengah_pros, 2);
										if ($row['is_sub_golongan'] == 1) {
											if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {

												$rumus = "(d-x) / (d-c)";
												$hasil = ($row2['nilai_atas'] - $suhu) / ($row2['nilai_atas'] - $nilai_tengah_akhir);
											} else if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
												$rumus = "(x-a) / (b-a)";
												$hasil = @(($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']));
											} else {
												$rumus = "0";
												$hasil = 0;
											}
										} else {
											if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
												$rumus = "(x-a) / (b-a)";
												$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
											} else if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {
												$rumus = "(c-x) / (c-b)";
												$hasil = @(($nilai_c - $suhu) / ($nilai_c - $nilai_tengah_akhir));
											} else {
												$rumus = "0";
												$hasil = 0;
											}
										}
									}
									$nomor3++;
									$nomor++;
								}
								?>
							</table>

							<br /><br /><br />
							<table class="table table-bordered" style="width:900px">
								<tr>
									<td>Fuzzy Set</td>
								</tr>

								<?php
								$nomor = 1;
								$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='2' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
								while ($row = mysql_fetch_array($sql)) {
									if ($row['is_sub_golongan'] == 1) {
										$nama_golongan = "Trapezoid";
										$nilai_b = "D";
									} else {
										$nama_golongan = "Triangle";
										$nilai_b = "B";
									}
									if ($row['keterangan_nilai'] == "Very Low") {
										$status_a = "(B)";
										$status_c = "(C)";
										$status_d = "(D)";
									} else {
										$status_a = "(A)";
										$status_c = "(C)";
										$status_d = "(B)";
									}



									echo "
						<tr>
						<td colspan='5' style='background-color:silver'>" . $row['keterangan_nilai'] . "</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>$status_a=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "a") . "</td>
							<td>$status_d=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "b") . "</td>
												
						<td>$status_c=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "c") . "</td>
							<td>(Formula)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "r") . "</td>
							<td>(Result)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "h") . "</td>
							
						</tr>
						";
									if (nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "h") == "") { } else {
										mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil,nomor)VALUES('$nomor','2','" . $_POST['hm'] . "','" . $row['keterangan_nilai'] . "','" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['hm'], $row['keterangan_nilai'], 2, "h") . "','$nomor3')");
									}
								}
								?>
							</table>

					</div>

					<!-- PERHITUNGAN UNTUK HUMIDITY -------------------------------------------------------------------------------------------->


					<!-- PERHITUNGAN UNTUK LIGHT -------------------------------------------------------------------------------------------->

					<div id="menu4" class="tab-pane fade in ">

						<h4>
							</h2><br />
							<div class="col-md-12">
								<table class="table table-bordered" style="width:300px">
									<tr>
										<td>INTENSITY</td>
										<td><?php echo $_POST['li']; ?>
									</tr>
								</table>
								<div style="height:30px;width:800px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:30px; position:absolute ">
									<!-- <table>
							<tr> -->
									<?php


									if (!empty($vc4)) {
										echo '<span style="margin-left: 100px;">Dark</span>';
									}
									if (!empty($c4)) {
										echo '<span style="margin-left: 210px;">Rather Dim</span>';
									}
									if (!empty($n4)) {
										echo '<span style="margin-left: 200px;">Normal</span>';
									}
									if (!empty($h4)) {
										echo '<span style="margin-left: 150px;">Bright</span>';
									}
									if (!empty($vh4)) {
										echo '<span style="margin-left: 250px;">Very Bright</span>';
									}
									?>

									<!-- </tr>
						</table> -->
								</div>

								<div style="margin-left:17px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:69px; position: absolute">
									<span style='color:black'>Y</span>

								</div>
								<div style="margin-left:500px;height:5px;width:10px;background-color:white;z-index: 999999999999999999999999999999999999999999999999999999999999;margin-top:355px; position: absolute">
									<span style='color:black'>Intensity (Lux)</span>

								</div>
								<div style="margin-left:730px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:390px; position: absolute">

								</div>
								<div style="margin-left:1px;height:15px;width:150px;background-color:white;z-index: 99999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999999;margin-top:387px; position: absolute">

								</div>
								<div id="chartContainer5" style="height: 370px;width:800px;"></div>
								<br /> <br />
							</div>

							<table class='table table-bordered'>

								<?php
								$nomor = 1;
								$nomor4 = 7;
								$suhu = $_POST['li'];
								$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='3' and nilai='" . $_POST['li'] . "' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
								while ($row = mysql_fetch_array($sql)) {
									$sql2 = mysql_query("SELECT MIN( nilai ) AS nilai_bawah, MAX( nilai ) AS nilai_atas
											FROM  `tb_rule` 
											WHERE is_golongan =  '3'
											AND keterangan =  '" . $row['keterangan'] . "'
											AND is_sub_golongan='" . $row['is_sub_golongan'] . "'
											");
									while ($row2 = mysql_fetch_array($sql2)) {
										$nilai_a = $row2['nilai_bawah'];
										$nilai_c = $row2['nilai_atas'];

										$nilai_tengah_awal = $nilai_c - $nilai_a;
										$nilai_tengah_pros = $nilai_tengah_awal / 2;
										$nilai_tengah_akhir = $row2['nilai_bawah'] + $nilai_tengah_pros;
										if ($row['is_sub_golongan'] == 1) {
											if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {

												$rumus = "(d-x) / (d-c)";
												$hasil = ($row2['nilai_atas'] - $suhu) / ($row2['nilai_atas'] - $nilai_tengah_akhir);
											} else if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
												$rumus = "(x-a) / (b-a)";
												$hasil = @(($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']));
											} else {
												$rumus = "0";
												$hasil = 0;
											}
										} else {
											if ($row2['nilai_bawah'] <= $suhu && $suhu <= $nilai_tengah_akhir) {
												$rumus = "(x-a) / (b-a)";
												$hasil = ($suhu - $row2['nilai_bawah']) / ($nilai_tengah_akhir - $row2['nilai_bawah']);
											} else if ($nilai_tengah_akhir <= $suhu && $suhu <= $row2['nilai_atas']) {
												$rumus = "(c-x) / (c-b)";
												$hasil = @(($nilai_c - $suhu) / ($nilai_c - $nilai_tengah_akhir));
											} else {
												$rumus = "0";
												$hasil = 0;
											}
										}
									}
									$nomor++;
									$nomor4++;
								}
								?>
							</table>




							<br /><br /><br />
							<table class="table table-bordered" style="width:900px">
								<tr>
									<td>Fuzzy Set</td>
								</tr>

								<?php
								$nomor = 1;
								$sql = mysql_query("SELECT * FROM `tb_rule` WHERE is_golongan='3' GROUP BY is_sub_golongan,keterangan_nilai ORDER BY id_golongan ASC");
								while ($row = mysql_fetch_array($sql)) {
									if ($row['is_sub_golongan'] == 1) {
										$nama_golongan = "Trapezoid";
										$nilai_b = "D";
									} else {
										$nama_golongan = "Triangle";
										$nilai_b = "B";
									}
									if ($row['keterangan_nilai'] == "gelap") {
										$ket = "Dark";
									} else if ($row['keterangan_nilai'] == "redup") {
										$ket = "Rather Dim";
									} else if ($row['keterangan_nilai'] == "agak_terang") {
										$ket = "Bright";
									} else if ($row['keterangan_nilai'] == "terang") {
										$ket = "Very Bright";
									} else {
										$ket = $row['keterangan_nilai'];
									}
									if ($ket == "Dark") {
										$status_a = "(B)";
										$status_c = "(C)";
										$status_d = "(D)";
									} else {
										$status_a = "(A)";
										$status_c = "(C)";
										$status_d = "(B)";
									}


									echo "
						<tr>
						<td colspan='5' style='background-color:silver'>" . $ket . "</td>
						
						</tr>
						<tr>
						<td>Curve Representation</td>
						<td> $nama_golongan</td>
						</tr>
						<tr>
							<td>$status_a=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "a") . "</td>
							<td>$status_d=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "b") . "</td>
							
							<td>$status_c=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "c") . "</td>
							<td>(Formula)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "r") . "</td>
							<td>(Result)=" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "h") . "</td>
							
						</tr>
						";
									if (nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "h") == "") { } else {
										//mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil,nomor)VALUES('$nomor','2','".$_POST['hm']."','".$row['keterangan_nilai']."','".nilai_parameter_a($row['is_sub_golongan'],$row['keterangan'],$_POST['hm'],$row['keterangan_nilai'],2,"h")."','$nomor3')");

										mysql_query("INSERT INTO tb_hasil(urutan,golongan,nilai,keterangan,hasil,nomor)VALUES('$nomor','3','" . $_POST['li'] . "','" . $row['keterangan_nilai'] . "','" . nilai_parameter_a($row['is_sub_golongan'], $row['keterangan'], $_POST['li'], $row['keterangan_nilai'], 3, "h") . "','$nomor4')");
									}
								}
								?>
							</table>

					</div>

					<!-- PERHITUNGAN UNTUK LIGHT -------------------------------------------------------------------------------------------->


					<div id="menu5" class="tab-pane fade in ">


						<!-- PERHITUNGAN UNTUK FUZYFICATION -------------------------------------------------------------------------------------------->

						<hr />
						<h4>FUZZIFICATION</h1>
							<table class='table table-bordered' style="width:930px">
								<?php
								$ra = 0;
								function get_rule_kondisi($kondisi_1, $kondisi_2, $kondisi_3)
								{
									$sql = mysql_query("SELECT * from tb_rule_kondisi where kondisi_1 LIKE '%$kondisi_1%' and kondisi_2 LIKE '" . $kondisi_2 . "'  and kondisi_3 LIKE '" . $kondisi_3 . "' ");
									while ($row = mysql_fetch_array($sql)) {
										$kondisi = $row['hasil'];
									}
									return $kondisi;
								}
								$sql = mysql_query("SELECT * from tb_hasil where golongan='0' ORDER BY id_hasil ASC");
								while ($row = mysql_fetch_array($sql)) {

									echo "
										
									";
									$sql2 = mysql_query("SELECT * from tb_hasil where golongan='1' ORDER BY id_hasil ASC");
									$nomor1 = 1;
									while ($row_6 = mysql_fetch_array($sql2)) {
										$nomor2 = 2;
										$sql3 = mysql_query("SELECT * from tb_hasil where golongan='2' ORDER BY id_hasil ASC");
										while ($row_7 = mysql_fetch_array($sql3)) {
											$sql4 = mysql_query("SELECT * from tb_hasil where golongan='3' ORDER BY id_hasil ASC");
											while ($row_8 = mysql_fetch_array($sql4)) {
												if ($row_8['keterangan'] == "gelap") {
													$ket = "Dark";
												} else if ($row_8['keterangan'] == "redup") {
													$ket = "Rather Dim";
												} else if ($row_8['keterangan'] == "agak_terang") {
													$ket = "Bright";
												} else if ($row_8['keterangan'] == "terang") {
													$ket = "Very Bright";
												} else {
													$ket = $row_8['keterangan'];
												}

												echo "
														<tr>
															<td>" . $row['keterangan'] . " </td>
															<td>" . $row['hasil'] . " </td> 															
															<td> " . $row_6['keterangan'] . "</td> 
															<td>" . $row_6['hasil'] . "</td> 
															
															<td> " . $row_7['keterangan'] . "</td>
															<td>" . $row_7['hasil'] . "</td>
															
															<td> " . $ket . "</td>
															<td>" . $row_8['hasil'] . "</td>
															
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
									$ra = 0;

									$sql = mysql_query("SELECT * from tb_hasil where golongan='0' ");
									while ($row = mysql_fetch_array($sql)) {



										echo "
										
									";
										$sql2 = mysql_query("SELECT * from tb_hasil where golongan='1' ");
										while ($row_6 = mysql_fetch_array($sql2)) {
											$sql22 = mysql_query("SELECT * from tb_hasil where golongan='2' ");
											while ($row_7 = mysql_fetch_array($sql22)) {
												$sql4 = mysql_query("SELECT * from tb_hasil where golongan='3' ");
												while ($row_8 = mysql_fetch_array($sql4)) {
													if ($row_8['keterangan'] == "gelap") {
														$ket = "Dark";
													} else if ($row_8['keterangan'] == "redup") {
														$ket = "Rather Dim";
													} else if ($row_8['keterangan'] == "agak_terang") {
														$ket = "Bright";
													} else if ($row_8['keterangan'] == "terang") {
														$ket = "Very Bright";
													} else {
														$ket = $row_8['keterangan'];
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
													echo "
															<tr>
																<td>" . $row['keterangan'] . " </td> <td>" . $row_6['keterangan'] . "</td><td>" . $row_7['keterangan'] . "</td><td>" . $ket . "</td>
																<td>MIN(" . $row['hasil'] . "," . $row_6['hasil'] . "," . $row_7['hasil'] . "," . $row_8['hasil'] . ")</td>
																<td>" . MIN($row['hasil'], $row_6['hasil'], $row_7['hasil'], $row_8['hasil']) . "</td>
																
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
										$ra = 0;
										$nomor = 1;
										$sql = mysql_query("SELECT * from tb_hasil where golongan='0' ");
										while ($row = mysql_fetch_array($sql)) {


											echo "
										
									";
											$sql2 = mysql_query("SELECT * from tb_hasil where golongan='1' ");
											while ($row_6 = mysql_fetch_array($sql2)) {
												$sql22 = mysql_query("SELECT * from tb_hasil where golongan='2' ");
												while ($row_7 = mysql_fetch_array($sql22)) {
													$sql4 = mysql_query("SELECT * from tb_hasil where golongan='3' ");
													while ($row_8 = mysql_fetch_array($sql4)) {
														if ($row_8['keterangan'] == "gelap") {
															$ket = "Dark";
														} else if ($row_8['keterangan'] == "redup") {
															$ket = "Rather Dim";
														} else if ($row_8['keterangan'] == "agak_terang") {
															$ket = "Bright";
														} else if ($row_8['keterangan'] == "terang") {
															$ket = "Very Bright";
														} else {
															$ket = $row_8['keterangan'];
														}

														echo "
															<tr>
																<td>" . $row['keterangan'] . " </td> <td>" . $row_6['keterangan'] . "</td><td>" . $row_7['keterangan'] . "</td><td>" . $ket . "</td>
																<td>" . get_rule_kondisi($row['keterangan'], $row_6['keterangan'], $row_7['keterangan'], $row_8['keterangan']) . "</td>
																<td>" . MIN($row['hasil'], $row_6['hasil'], $row_7['hasil'], $row_8['hasil']) . "</td>
																
															</tr>
															";

														mysql_query("INSERT INTO tb_hasil_2(urutan,golongan,nilai,keterangan,hasil)VALUES('$nomor','" . get_rule_kondisi($row['keterangan'], $row_6['keterangan'], $row_7['keterangan'], $row_8['keterangan']) . "','" . $_POST['suhu'] . "','" . $row['keterangan'] . "','" . MIN($row['hasil'], $row_6['hasil'], $row_7['hasil'], $row_8['hasil']) . "')");
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

									<h4>AGGREGATION</h1>
										<table class='table table-bordered' style="width:930px">
											<?php

											function get_duration($kondisi_1, $nilai_set)
											{
												$nilai = 0;
												$sql = mysql_query("SELECT * from tb_rule_duration where keterangan='" . $kondisi_1 . "' LIMIT 0,4");
												while ($row = mysql_fetch_array($sql)) {
													$nilai = $nilai + $row['nilai'];
												}
												$nilanya = $nilai * $nilai_set;
												return $nilanya;
											}
											$ra = 0;
											$nomor = 1;
											//$total=0;
											//$total_bagi=0;
											$sql = mysql_query("SELECT golongan,MAX(hasil)as total_max from tb_hasil_2 GROUP BY golongan ");
											while ($row = mysql_fetch_array($sql)) {
												//$total_set=$row['total_max']*4;
												echo "<tr><td>" . $row['golongan'] . " " . $row['total_max'] . "</td></tr>";
												//$total=$total+get_duration($row['golongan'],$row['total_max']);
												//$total_bagi=$total_bagi+$total_set;
												$ra++;
												$nomor++;
											}
											echo "";

											?>
										</table>


										<!-- PERHITUNGAN UNTUK DEFUZYFICATION -------------------------------------------------------------------------------------------->

										<h4>DEFUZZIFICATION</h1>
											<table class='table table-bordered' style="width:930px">
												<?php

												$ra = 0;
												$nomor = 1;
												//$total=0;
												//$total_bagi=0;
												$sql = mysql_query("SELECT golongan,MAX(hasil)as total_max from tb_hasil_2 GROUP BY golongan  ORDER BY hasil DESC limit 0,1 ");
												while ($row = mysql_fetch_array($sql)) {
													$gol = $row['golongan'];
													$total_set = $row['total_max'] * 4;
													echo "<tr><td>" . $row['golongan'] . "</td></tr>";
													//$total=$total+get_duration($row['golongan'],$row['total_max']);
													//$total_bagi=$total_bagi+$total_set;
													if ($row['golongan'] == "Very Short") {
														$hasil_detik = 12;
													} else if ($row['golongan'] == "Short") {
														$hasil_detik = 24;
													} else if ($row['golongan'] == "Medium") {
														$hasil_detik = 36;
													} else if ($row['golongan'] == "Very Long") {
														$hasil_detik = 60;
													} else if ($row['golongan'] == "Long") {
														$hasil_detik = 48;
													}
													$ra++;
													$nomor++;
												}
												echo "";
												?>
											</table>


											<hr />

											<?php
											$hasil_meni = $hasil_detik;
											//		$hasil_meni=$hasil_detik;
											//	echo"<tr><td>".round($hasil_meni)." Detik</td></tr>";
											mysql_query("INSERT INTO tb_hasil_menit(tanggal,suhu,sm,humidity,li,aggre,defuz,nilai)VALUES('" . $_POST['tanggal'] . "','" . $_POST['suhu'] . "','" . $_POST['sm'] . "','" . $_POST['hm'] . "','" . $_POST['li'] . "','" . $_POST['aggre'] . "','$gol','" . $hasil_meni . "')");
											?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- /#page-content-wrapper -->


<script>
	window.onload = function() {

		//Better to construct options first and then pass it as a parameter
		var options = {
			title: {
				text: "Soil Moisture"

			},
			animationEnabled: true,
			exportEnabled: true,
			data: [
				<?php
				$data_very_dry = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very Dry'");
				$row_very_dry = mysql_fetch_array($data_very_dry);

				if ($row_very_dry['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very Dry'"));
					?> {

					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//grafik trapesium
						<?php if ($get['nilai'] <= 20) { ?> {
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 0,
							y: 1
						},
						{
							x: 20,
							y: 1
						},
						{
							x: 40,
							y: 0
						},
						<?php } else { ?>

						{
							x: 0,
							y: 1
						},
						{
							x: 20,
							y: 1
						},
						{
							x: 40,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_dry = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Dry'");
				$row_dry = mysql_fetch_array($data_dry);

				if ($row_dry['TOTAL'] > 0) {
					//manggil data hasil perhitungan dalam array, 
					$getdry = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Dry'"));
					?> {
					//nilai bawah
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//Grafik segitiga I
						<?php if ($getdry['nilai'] <= 42.5) { ?> {
							x: <?php echo $getdry['nilai'] ?>,
							y: <?php echo $getdry['hasil'] ?>
						},
						{
							x: 20,
							y: 0
						},
						{
							x: 42.5,
							y: 1
						},
						{
							x: 65,
							y: 0
						},
						//echo data x = input, y = hasil
						<?php } else { ?>

						{
							x: 20,
							y: 0
						},
						{
							x: 42.5,
							y: 1
						},
						{
							x: 65,
							y: 0
						},
						{
							x: <?php echo $getdry['nilai'] ?>,
							y: <?php echo $getdry['hasil'] ?>
						},
						//echo data x = input, y = hasil

						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_normal = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Normal' and golongan='1'");
				$row_normal = mysql_fetch_array($data_normal);

				if ($row_normal['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='1'"));
					?> {



					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//Grafik segitiga II
						<?php if ($get['nilai'] <= 70) { ?> {
							x: 60,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 70,
							y: 1
						},
						{
							x: 80,
							y: 0
						},
						<?php } else { ?> {
							x: 60,
							y: 0
						},
						{
							x: 70,
							y: 1
						},
						{
							x: 80,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_wet = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Wet'");
				$row_wet = mysql_fetch_array($data_wet);

				if ($row_wet['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Wet'"));
					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//Grafik segitiga III
						<?php if ($get['nilai'] <= 82.5) { ?> {
							x: 75,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 82.5,
							y: 1
						},
						{
							x: 90,
							y: 0
						},
						<?php } else { ?> {
							x: 75,
							y: 0
						},
						{
							x: 82.5,
							y: 1
						},
						{
							x: 90,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_very_wet = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very Wet'");
				$row_very_wet = mysql_fetch_array($data_very_wet);

				if ($row_very_wet['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very Wet'"));
					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Trapesium 2
						<?php if ($get['nilai'] <= 93.75) { ?> {
							x: 87.5,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 93.75,
							y: 1
						},
						{
							x: 100,
							y: 1
						},

						<?php } else { ?> {
							x: 87.5,
							y: 0
						},
						{
							x: 93.75,
							y: 1
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 100,
							y: 1
						},

						<?php } ?>

					]
				}
				<?php
				} else { }
				?>
			]
		};
		$("#chartContainer2").CanvasJSChart(options);


		//Better to construct options first and then pass it as a parameter
		var options2 = {
			title: {
				text: "Temperature"
			},
			animationEnabled: true,
			exportEnabled: true,
			data: [
				<?php
				$data_very_cold = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very Cold'");
				$row_very_cold = mysql_fetch_array($data_very_cold);

				if ($row_very_cold['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very Cold'"));
					?> {

					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [





						//grafik trapesium
						<?php if ($get['nilai'] <= 15.625) { ?> {
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 0,
							y: 1
						},
						{
							x: 15.625,
							y: 1
						},
						{
							x: 25,
							y: 0
						},


						<?php } else { ?>

						{
							x: 0,
							y: 1
						},
						{
							x: 15.625,
							y: 1
						},
						{
							x: 25,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_cold = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Cold'");
				$row_cold = mysql_fetch_array($data_cold);

				if ($row_cold['TOTAL'] > 0) {
					//manggil data hasil perhitungan dalam array, 
					$getcold = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Cold'"));

					?>

				{
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Segitiga 2
						<?php if ($get['nilai'] <= 25) { ?> {
							x: 20,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 25,
							y: 1
						},
						{
							x: 30,
							y: 0
						},
						<?php } else { ?> {
							x: 20,
							y: 0
						},
						{
							x: 25,
							y: 1
						},
						{
							x: 30,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>
					]
				},
				<?php
				} else { }

				?>
				<?php
				$data_hot = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Hot'");
				$row_hot = mysql_fetch_array($data_hot);

				if ($row_hot['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Hot'"));
					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//segitiga 3
						<?php if ($get['nilai'] <= 36.25) { ?> {
							x: 27.5,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 36.25,
							y: 1
						},
						{
							x: 45,
							y: 0
						},
						<?php } else { ?> {
							x: 27.5,
							y: 0
						},
						{
							x: 36.25,
							y: 1
						},
						{
							x: 45,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_hot = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very Hot'");
				$row_hot = mysql_fetch_array($data_hot);

				if ($row_hot['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very Hot'"));


					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Trapesium 2
						<?php if ($get['nilai'] <= 45) { ?> {
							x: 40,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 45,
							y: 1
						},
						{
							x: 50,
							y: 1
						}

						<?php } else { ?>

						{
							x: 40,
							y: 0
						},
						{
							x: 45,
							y: 1
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 50,
							y: 1
						},



						<?php } ?>
					]
				}

				<?php

				} else { }
				?>
			],

		};
		$("#chartContainer").CanvasJSChart(options2);









		var options3 = {
			title: {
				text: "Humidity"
			},
			animationEnabled: true,
			exportEnabled: true,
			data: [
				<?php
				$data_very_low = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very Low'");
				$row_very_low = mysql_fetch_array($data_very_low);

				if ($row_very_low['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very Low'"));
					?> {

					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//grafik trapesium
						<?php if ($get['nilai'] <= 17.5) { ?> {
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 0,
							y: 1
						},
						{
							x: 17.5,
							y: 1
						},
						{
							x: 35,
							y: 0
						},
						<?php } else { ?>

						{
							x: 0,
							y: 1
						},
						{
							x: 17.5,
							y: 1
						},
						{
							x: 35,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_low = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Low'");
				$row_low = mysql_fetch_array($data_low);

				if ($row_low['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Low'"));
					?> {
					//nilai bawah
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//Grafik segitiga I
						<?php if ($get['nilai'] <= 36.25) { ?> {
							x: 17.5,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 36.25,
							y: 1
						},
						{
							x: 55,
							y: 0
						},
						<?php } else { ?>

						{
							x: 17.5,
							y: 0
						},
						{
							x: 36.25,
							y: 1
						},
						{
							x: 55,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>


					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_low_normal = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Normal' and golongan='2'");
				$row_low_normal = mysql_fetch_array($data_low_normal);

				if ($row_low_normal['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='2'"));	?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Segitiga 2
						<?php if ($get['nilai'] <= 60) { ?> {
							x: 50,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 60,
							y: 1
						},
						{
							x: 70,
							y: 0
						},
						<?php } else { ?>

						{
							x: 50,
							y: 0
						},
						{
							x: 60,
							y: 1
						},
						{
							x: 70,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php

				} else { }
				?>
				<?php
				$data_high = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='High'");
				$row_high = mysql_fetch_array($data_high);

				if ($row_high['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='High'"));
					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//segitiga 3
						<?php if ($get['nilai'] <= 75) { ?> {
							x: 65,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 75,
							y: 1
						},
						{
							x: 85,
							y: 0
						},
						<?php } else { ?>

						{
							x: 65,
							y: 0
						},
						{
							x: 75,
							y: 1
						},
						{
							x: 85,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>


					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_very_high = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Very High'");
				$row_very_high = mysql_fetch_array($data_very_high);

				if ($row_very_high['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Very High'"));
					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Trapesium 2
						<?php if ($get['nilai'] <= 90) { ?> {
							x: 80,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},

						{
							x: 90,
							y: 1
						},
						{
							x: 100,
							y: 1
						},
						<?php } else { ?>

						{
							x: 80,
							y: 0
						},
						{
							x: 90,
							y: 1
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},

						{
							x: 100,
							y: 1
						},

						<?php } ?>
					]
				}
				<?php
				} else { }
				?>
			]
		};
		$("#chartContainer3").CanvasJSChart(options3);




















		//Better to construct options first and then pass it as a parameter
		var options5 = {
			title: {
				text: "INTENSITY"
			},
			animationEnabled: true,
			exportEnabled: true,
			data: [
				<?php
				$data_gelap = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='gelap'");
				$row_gelap = mysql_fetch_array($data_gelap);
				if ($row_gelap['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Gelap'"));
					?> {

					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//grafik trapesium
						<?php if ($get['nilai'] <= 1000) { ?> {
							x: <?php echo $get['nilai'] ?>,
							y: 1
						},
						{
							x: 0,
							y: 1
						},
						{
							x: 1000,
							y: 1
						},
						{
							x: 2000,
							y: 0
						},
						<?php } else { ?>

						{
							x: 0,
							y: 1
						},
						{
							x: 1000,
							y: 1
						},
						{
							x: 2000,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_redup = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='redup'");
				$row_redup = mysql_fetch_array($data_redup);
				if ($row_redup['TOTAL'] > 0) {
					//manggil data hasil perhitungan dalam array, 
					$getredup = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Redup'"));
					?> {
					//nilai bawah
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [

						//Grafik segitiga I
						<?php if ($getredup['nilai'] <= 3000) { ?> {
							x: <?php echo $getredup['nilai'] ?>,
							y: <?php echo $getredup['hasil'] ?>
						},
						{
							x: 1000,
							y: 0
						},
						{
							x: 3000,
							y: 1
						},
						{
							x: 5000,
							y: 0
						},
						<?php } else { ?>

						{
							x: 1000,
							y: 0
						},
						{
							x: 3000,
							y: 1
						},
						{
							x: 5000,
							y: 0
						},
						{
							x: <?php echo $getredup['nilai'] ?>,
							y: <?php echo $getredup['hasil'] ?>
						},
						//echo data x = input, y = hasil


						<?php } ?>

					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_normal_lig = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='Normal' and golongan='3'");
				$row_normal_lig = mysql_fetch_array($data_normal_lig);
				if ($row_normal_lig['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='Normal' and golongan='3'"));

					?> {
					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Segitiga 2
						<?php if ($get['nilai'] <= 6500) { ?> {
							x: 3000,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 6500,
							y: 1
						},
						{
							x: 10000,
							y: 0
						},
						<?php } else { ?>

						{
							x: 3000,
							y: 0
						},
						{
							x: 6500,
							y: 1
						},
						{
							x: 10000,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						//echo data x = input, y = hasil
						<?php } ?>
					]
				},
				<?php
				} else { }
				?>
				<?php
				$data_agak_terang = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='agak_terang'");
				$row_agak_terang = mysql_fetch_array($data_agak_terang);
				if ($row_agak_terang['TOTAL'] > 0) {
					$getagak_terang = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='agak_terang'"));
					?> {



					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Segitiga 3
						<?php if ($getagak_terang['nilai'] <= 19500) { ?> {
							x: 9000,
							y: 0
						},
						{
							x: <?php echo $getagak_terang['nilai'] ?>,
							y: <?php echo $getagak_terang['hasil'] ?>
						},
						{
							x: 19500,
							y: 1
						},
						{
							x: 30000,
							y: 0
						},
						<?php } else { ?>

						{
							x: 9000,
							y: 0
						},
						{
							x: 19500,
							y: 1
						},
						{
							x: 30000,
							y: 0
						},
						{
							x: <?php echo $getagak_terang['nilai'] ?>,
							y: <?php echo $getagak_terang['hasil'] ?>
						},
						<?php } ?>
					]
				},
				<?php
				} else { }

				?>
				<?php
				$data_terang = mysql_query("select COUNT(*)AS TOTAL from tb_hasil where keterangan='terang'");
				$row_terang = mysql_fetch_array($data_terang);
				if ($row_terang['TOTAL'] > 0) {
					$get = mysql_fetch_array(mysql_query("select * from tb_hasil where keterangan='terang'"));
					?> {

					type: "line", //change it to line, area, column, pie, etc
					dataPoints: [
						//Trapesium 2
						<?php if ($get['nilai'] <= 25000) { ?> {
							x: 25000,
							y: 0
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						{
							x: 42500,
							y: 1
						},
						{
							x: 60000,
							y: 1
						}
						<?php } else { ?>

						{
							x: 25000,
							y: 0
						},
						{
							x: 42500,
							y: 1
						},
						{
							x: 60000,
							y: 1
						},
						{
							x: <?php echo $get['nilai'] ?>,
							y: <?php echo $get['hasil'] ?>
						},
						<?php } ?>
					]
				}
				<?php
				} else { }
				?>
			]
		};
		$("#chartContainer5").CanvasJSChart(options5);



	}
</script>


<!-- Menu Toggle Script -->
<!-- <script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script> -->

<?php
include "templete/footer.php";
?>