<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>
<?php
$sql = mysql_query("select * from tb_hasil_menit where id_hasil='" . $_GET['id_hasil'] . "'");
while ($row2 = mysql_fetch_array($sql)) {
	$suhu = $row2['suhu'];
	$sm = $row2['sm'];
	$humidity = $row2['humidity'];
	$tanggal = $row2['tanggal'];
	$li = $row2['li'];
}
?>

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

<?php
include "templete/footer.php";
?>
