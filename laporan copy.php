<?php
include "head.php";
?>

<?php
include 'sidebar.php';
?>

<div class="main-panel">


	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">

						<div class="content table-responsive table-full-width">
							<form action="save_laporan.php" method="GET" target="_blank">
								<table class="table table-hover">

									<tbody>
										<tr>
											<td>Month</td>
											<td>
												<select type="text" name="bulan" id="bulan" class="form-control">
													<option value="">Select Month</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>

												</select>

											</td>
										</tr>
										<tr>
											<td>Year</td>
											<td>
												<select name='tahun' data-placeholder="Pilih Tahun..." class="form-control" style="">
													<option>Select year</option>
													<?php
													for ($i = 2010; $i <= 2019; $i++) {
														echo "<option value='$i'>$i</option>";
													}
													?>
												</select>
											</td>
										</tr>

										<tr>
											<td> <input type="submit" name="" value="Search Data" class="btn btn-primary">
											</td>
										</tr>
									</tbody>
								</table>
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