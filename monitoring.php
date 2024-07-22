<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card w-100 position-relative overflow-hidden">
				<div class="px-4 py-3 border-bottom">
					<h5 class="card-title fw-semibold mb-0 lh-sm">Monitoring Data</h5>
				</div>
				<div class="card-body p-4">
					<div class="table-responsive rounded-2 mb-4">
						<table class="table border text-nowrap customize-table mb-0 align-middle">
							<thead class="text-dark fs-4">
								<tr>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Time</h6>
									</th>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Temperature</h6>
									</th>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Soilmoisture</h6>
									</th>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Humidity</h6>
									</th>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Intensity</h6>
									</th>
									<th>
										<h6 class="fs-4 fw-semibold mb-0">Action</h6>
									</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$sql = mysql_query("select * from node_1");
								while ($row = mysql_fetch_array($sql)) {
									echo "
												<tr>
													<td>" . $row['time'] . "</td>
													<td>" . $row['temperature'] . "</td>
													<td>" . $row['soilmoisture'] . "</td>
													<td>" . $row['humidity'] . "</td>
													<td>" . $row['intensity'] . "</td>
													<td>
														<a class='btn btn-danger btn-sm' href='hapus_monitoring.php?id=" . $row['id'] . "'>Hapus</a>
													</td>
												
												</tr>
											";
								}
								?>

							</tbody>
						</table>
					</div>

				</div>
			</div>
			<div class="card">
				<div class="content table-responsive table-full-width">
					<h3 style="text-align:center"> Monitoring Data </h3>
					<table class="table table-bordered" id="example">
						<tr>
							<th>Time</th>
							<th>Temperature</th>
							<th>Soilmoisture</th>
							<th>Humidity</th>
							<th>Intensity</th>
							<th>Action</th>
						</tr>
						<?php
						$sql = mysql_query("select * from node_1");
						while ($row = mysql_fetch_array($sql)) {
							echo "
												<tr>
													<td>" . $row['time'] . "</td>
													<td>" . $row['temperature'] . "</td>
													<td>" . $row['soilmoisture'] . "</td>
													<td>" . $row['humidity'] . "</td>
													<td>" . $row['intensity'] . "</td>
													<td>
														<a class='btn btn-danger btn-sm' href='hapus_monitoring.php?id=" . $row['id'] . "'>Hapus</a>
													</td>
												
												</tr>
											";
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>

<script>
	function fungsi_nama_toko() {
		// var variabel = document.getElementById("nama_toko").value;

		if ($('#tanggal').val() != "") {
			$.ajax({
				url: 'http://localhost/aplikasi/perhitungan2.php?id=' + $('#tanggal').val(),
				type: 'GET',

				async: false,
				cache: false,
				//dataType : 'jsonp',
				processData: false,
				contentType: false,
				success: function(data) {

					$("#div_data").html(data);
				}
			})
		}
	}
</script>

</html>