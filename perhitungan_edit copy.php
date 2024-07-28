<?php
include "head.php";
?>

<?php
include 'sidebar.php';

$sql = mysql_query("select * from tb_hasil_menit where id_hasil='" . $_GET['id_hasil'] . "'");
while ($row2 = mysql_fetch_array($sql)) {
	$suhu = $row2['suhu'];
	$sm = $row2['sm'];
	$humidity = $row2['humidity'];
	$tanggal = $row2['tanggal'];
	$li = $row2['li'];
}
?>

<div class="main-panel">


	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="content table-responsive table-full-width">
							<form action="edit_perhitungan.php" method="POST">
								<input type="hidden" value="<?php echo $_GET['id_hasil']; ?>" name="id_hasil">
								<h3 style="text-align:center">FORM EDIT</h3>
								<table class='table table-bordered'>
									<tr>
										<td>Date</td>
										<td><input type="date" name="tanggal" value="<?php echo $tanggal; ?>" class="form-control datepicker"></td>
									</tr>
									<tr>
										<td>Temperature</td>
										<td><input type="text" name="suhu" value="<?php echo $suhu; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Soil Moisture</td>
										<td><input type="text" name="sm" value="<?php echo $sm; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Humidity</td>
										<td><input type="text" name="hm" value="<?php echo $humidity; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Intensity</td>
										<td><input type="text" name="li" value="<?php echo $li; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td><input type="submit" value="Update" class="btn btn-warning"></td>
									</tr>
								</table>
							</form>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<footer class="footer">
		<div class="container-fluid">


		</div>
	</footer>


</div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>


</html>