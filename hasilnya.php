<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card">

				<div class="content table-responsive table-full-width">

					<a href="hasilnya_cetak.php"><img src="logo.jpg" style="width:100px;height:50px"> <br /></a>
					<h3 style="text-align:center">Data Results </h3>
					<table class='table table-bordered' id="example">
						<thead>
							<tr>
								<td>Time</td>
								<td>Temperature</td>
								<td>Soil Moisture</td>
								<td>Humidity</td>
								<td>Intensity</td>
								<td>Duration Drip</td>
								<td>Duration Drip (Seconds)</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<?php
							$data_set = "";
							$data = mysql_query("select * from tb_hasil_menit ORDER BY tanggal");
							while ($row = mysql_fetch_array($data)) {
								if ($row['tanggal'] == $data_set) { } else {
									echo "
								<tr>
									<td>" . $row['tanggal'] . "</td>
									<td>" . $row['suhu'] . "</td>
									<td>" . $row['sm'] . "</td>
									<td>" . $row['humidity'] . "</td>
									<td>" . $row['li'] . "</td>
									<td>" . $row['defuz'] . "</td>
									<td>" . $row['nilai'] . " Seconds</td>
									<td>
									<a href='perhitungan_edit.php?id_hasil=" . $row['id_hasil'] . "' class=\"btn btn-warning\">Edit</a>
									<a href='hapus_perhitungan.php?id_hasil=" . $row['id_hasil'] . "' class=\"btn btn-danger\">Hapus</a>
									
									</td>
								</tr>
								";
								}

								$data_set = $row['tanggal'];
							}
							?>
						</tbody>

					</table>
				</div>
			</div>
		</div>

	</div>
</div>

<?php
include "templete/footer.php";
?>