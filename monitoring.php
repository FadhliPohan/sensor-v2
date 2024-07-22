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