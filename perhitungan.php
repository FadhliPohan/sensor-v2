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
					<h3 class="style1" style="text-align:center">Input Form</h3>
					<form action="hasil_perhitungan.php" method="POST">
						<table class='table table-bordered'>
							<tr>
								<td>Time</td>
								<td>

									<select id="tanggal" class="form-control" onclick="fungsi_nama_toko()">
										<option value="">Select Data Based On Time</option>
										<?php
										$sql = mysql_query("select * from node_1");
										while ($row = mysql_fetch_array($sql)) {
											echo "
												<option value='" . $row['time'] . "'>" . $row['time'] . "</option>
												";
												// <option value='" . $row['id'] . "'>" . $row['time'] . "</option>
										}
										?>
									</select>

								</td>
							</tr>
							<tbody id="div_data">
								<tr>
									<td>Temperature</td>
									<td><input type="text" name="suhu" class="form-control" required></td>
								</tr>
								<tr>
									<td>Soil Moisture</td>
									<td><input type="text" name="sm" class="form-control" required></td>
								</tr>
								<tr>
									<td>Humidity</td>
									<td><input type="text" name="hm" class="form-control" required></td>
								</tr>
								<tr>
									<td>Intensity</td>
									<td><input type="text" name="li" class="form-control" required></td>
								</tr>
							</tbody>
							<tr>
								<td><input type="submit" value="Save" class="btn btn-warning"></td>
							</tr>
						</table>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
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
<?php
include "templete/footer.php";
?>