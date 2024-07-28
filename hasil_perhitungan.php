<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>

<?php
// include "sidebar.php";
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
	<div class="card">
		<ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
					<i class="ti ti-user-circle me-2 fs-6"></i>
					<span class="d-none d-md-block">Temperature</span>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications" type="button" role="tab" aria-controls="pills-notifications" aria-selected="false">
					<i class="ti ti-bell me-2 fs-6"></i>
					<span class="d-none d-md-block">Notifications</span>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-bills-tab" data-bs-toggle="pill" data-bs-target="#pills-bills" type="button" role="tab" aria-controls="pills-bills" aria-selected="false">
					<i class="ti ti-article me-2 fs-6"></i>
					<span class="d-none d-md-block">Bills</span>
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
					<i class="ti ti-lock me-2 fs-6"></i>
					<span class="d-none d-md-block">Security</span>
				</button>
			</li>
		</ul>
		<div class="card-body">
			<div class="tab-content" id="pills-tabContent">
				<div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
					<!-- Temperature -->
					<div class="row">

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
				</div>
				<!-- Temperature -->

				<div class="tab-pane fade" id="pills-notifications" role="tabpanel" aria-labelledby="pills-notifications-tab" tabindex="0">
					<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Notification Preferences</h4>
									<p>
										Select the notificaitons ou would like to receive via email. Please note that you cannot opt
										out of receving service
										messages, such as payment, security or legal notifications.
									</p>
									<form class="mb-7">
										<label for="exampleInputtext5" class="form-label fw-semibold">Email Address*</label>
										<input type="text" class="form-control" id="exampleInputtext5" placeholder="" required>
										<p class="mb-0">Required for notificaitons.</p>
									</form>
									<div class="">
										<div class="d-flex align-items-center justify-content-between mb-4">
											<div class="d-flex align-items-center gap-3">
												<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
													<i class="ti ti-article text-dark d-block fs-7" width="22" height="22"></i>
												</div>
												<div>
													<h5 class="fs-4 fw-semibold">Our newsletter</h5>
													<p class="mb-0">We'll always let you know about important changes</p>
												</div>
											</div>
											<div class="form-check form-switch mb-0">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between mb-4">
											<div class="d-flex align-items-center gap-3">
												<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
													<i class="ti ti-checkbox text-dark d-block fs-7" width="22" height="22"></i>
												</div>
												<div>
													<h5 class="fs-4 fw-semibold">Order Confirmation</h5>
													<p class="mb-0">You will be notified when customer order any product</p>
												</div>
											</div>
											<div class="form-check form-switch mb-0">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked1" checked>
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between mb-4">
											<div class="d-flex align-items-center gap-3">
												<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
													<i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22" height="22"></i>
												</div>
												<div>
													<h5 class="fs-4 fw-semibold">Order Status Changed</h5>
													<p class="mb-0">You will be notified when customer make changes to the order</p>
												</div>
											</div>
											<div class="form-check form-switch mb-0">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked2" checked>
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between mb-4">
											<div class="d-flex align-items-center gap-3">
												<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
													<i class="ti ti-truck-delivery text-dark d-block fs-7" width="22" height="22"></i>
												</div>
												<div>
													<h5 class="fs-4 fw-semibold">Order Delivered</h5>
													<p class="mb-0">You will be notified once the order is delivered</p>
												</div>
											</div>
											<div class="form-check form-switch mb-0">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked3">
											</div>
										</div>
										<div class="d-flex align-items-center justify-content-between">
											<div class="d-flex align-items-center gap-3">
												<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
													<i class="ti ti-mail text-dark d-block fs-7" width="22" height="22"></i>
												</div>
												<div>
													<h5 class="fs-4 fw-semibold">Email Notification</h5>
													<p class="mb-0">Turn on email notificaiton to get updates through email</p>
												</div>
											</div>
											<div class="form-check form-switch mb-0">
												<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked4" checked>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Date & Time</h4>
									<p>Time zones and calendar display settings.</p>
									<div class="d-flex align-items-center justify-content-between mt-7">
										<div class="d-flex align-items-center gap-3">
											<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
												<i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22" height="22"></i>
											</div>
											<div>
												<p class="mb-0">Time zone</p>
												<h5 class="fs-4 fw-semibold">(UTC + 02:00) Athens, Bucharet</h5>
											</div>
										</div>
										<a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
											<i class="ti ti-download"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Ignore Tracking</h4>
									<div class="d-flex align-items-center justify-content-between mt-7">
										<div class="d-flex align-items-center gap-3">
											<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
												<i class="ti ti-player-pause text-dark d-block fs-7" width="22" height="22"></i>
											</div>
											<div>
												<h5 class="fs-4 fw-semibold">Ignore Browser Tracking</h5>
												<p class="mb-0">Browser Cookie</p>
											</div>
										</div>
										<div class="form-check form-switch mb-0">
											<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked5">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="d-flex align-items-center justify-content-end gap-3">
								<button class="btn btn-primary">Save</button>
								<button class="btn bg-danger-subtle text-danger">Cancel</button>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-bills" role="tabpanel" aria-labelledby="pills-bills-tab" tabindex="0">
					<div class="row justify-content-center">
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Billing Information</h4>
									<form>
										<div class="row">
											<div class="col-lg-6">
												<div class="mb-4">
													<label for="exampleInputtext6" class="form-label fw-semibold">Business
														Name*</label>
													<input type="text" class="form-control" id="exampleInputtext6" placeholder="Visitor Analytics">
												</div>
												<div class="mb-4">
													<label for="exampleInputtext7" class="form-label fw-semibold">Business
														Address*</label>
													<input type="text" class="form-control" id="exampleInputtext7" placeholder="">
												</div>
												<div class="">
													<label for="exampleInputtext8" class="form-label fw-semibold">First Name*</label>
													<input type="text" class="form-control" id="exampleInputtext8" placeholder="">
												</div>
											</div>
											<div class="col-lg-6">
												<div class="mb-4">
													<label for="exampleInputtext9" class="form-label fw-semibold">Business
														Sector*</label>
													<input type="text" class="form-control" id="exampleInputtext9" placeholder="Arts, Media & Entertainment">
												</div>
												<div class="mb-4">
													<label for="exampleInputtext10" class="form-label fw-semibold">Country*</label>
													<input type="text" class="form-control" id="exampleInputtext10" placeholder="Romania">
												</div>
												<div class="">
													<label for="exampleInputtext11" class="form-label fw-semibold">Last Name*</label>
													<input type="text" class="form-control" id="exampleInputtext11" placeholder="">
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Current Plan : <span class="text-success">Executive</span></h4>
									<p>Thanks for being a premium member and supporting our development.</p>
									<div class="d-flex align-items-center justify-content-between mt-7 mb-3">
										<div class="d-flex align-items-center gap-3">
											<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
												<i class="ti ti-package text-dark d-block fs-7" width="22" height="22"></i>
											</div>
											<div>
												<p class="mb-0">Current Plan</p>
												<h5 class="fs-4 fw-semibold">750.000 Monthly Visits</h5>
											</div>
										</div>
										<a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add">
											<i class="ti ti-circle-plus"></i>
										</a>
									</div>
									<div class="d-flex align-items-center gap-3">
										<button class="btn btn-primary">Change Plan</button>
										<button class="btn btn-outline-danger">Reset Plan</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-9">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Payment Method</h4>
									<p>On 26 December, 2023</p>
									<div class="d-flex align-items-center justify-content-between mt-7">
										<div class="d-flex align-items-center gap-3">
											<div class="text-bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
												<i class="ti ti-credit-card text-dark d-block fs-7" width="22" height="22"></i>
											</div>
											<div>
												<h5 class="fs-4 fw-semibold">Visa</h5>
												<p class="mb-0 text-dark">*****2102</p>
											</div>
										</div>
										<a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
											<i class="ti ti-pencil-minus"></i>
										</a>
									</div>
									<p class="my-2">If you updated your payment method, it will only be dislpayed here after your
										next billing cycle.</p>
									<div class="d-flex align-items-center gap-3">
										<button class="btn btn-outline-danger">Cancel Subscription</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="d-flex align-items-center justify-content-end gap-3">
								<button class="btn btn-primary">Save</button>
								<button class="btn bg-danger-subtle text-danger">Cancel</button>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
					<div class="row">
						<div class="col-lg-8">
							<div class="card">
								<div class="card-body p-4">
									<h4 class="fw-semibold mb-3">Two-factor Authentication</h4>
									<div class="d-flex align-items-center justify-content-between pb-7">
										<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis sapiente
											sunt earum officiis laboriosam ut.</p>
										<button class="btn btn-primary">Enable</button>
									</div>
									<div class="d-flex align-items-center justify-content-between py-3 border-top">
										<div>
											<h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
											<p class="mb-0">Google auth app</p>
										</div>
										<button class="btn bg-primary-subtle text-primary">Setup</button>
									</div>
									<div class="d-flex align-items-center justify-content-between py-3 border-top">
										<div>
											<h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
											<p class="mb-0">E-mail to send verification link</p>
										</div>
										<button class="btn bg-primary-subtle text-primary">Setup</button>
									</div>
									<div class="d-flex align-items-center justify-content-between py-3 border-top">
										<div>
											<h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
											<p class="mb-0">Your phone number or something</p>
										</div>
										<button class="btn bg-primary-subtle text-primary">Setup</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="card">
								<div class="card-body p-4">
									<div class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
										<i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
									</div>
									<h5 class="fs-5 fw-semibold mb-0">Devices</h5>
									<p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
									<button class="btn btn-primary mb-4">Sign out from all devices</button>
									<div class="d-flex align-items-center justify-content-between py-3 border-bottom">
										<div class="d-flex align-items-center gap-3">
											<i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
											<div>
												<h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
												<p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
											</div>
										</div>
										<a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
											<i class="ti ti-dots-vertical"></i>
										</a>
									</div>
									<div class="d-flex align-items-center justify-content-between py-3">
										<div class="d-flex align-items-center gap-3">
											<i class="ti ti-device-laptop text-dark d-block fs-7" width="26" height="26"></i>
											<div>
												<h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
												<p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
											</div>
										</div>
										<a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
											<i class="ti ti-dots-vertical"></i>
										</a>
									</div>
									<button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help ?</button>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="d-flex align-items-center justify-content-end gap-3">
								<button class="btn btn-primary">Save</button>
								<button class="btn bg-danger-subtle text-danger">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

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
<script src="js/jquery.canvasjs.min.js"></script>

<?php
include "templete/footer.php";
?>