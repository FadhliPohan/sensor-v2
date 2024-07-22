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
					<h3 style="text-align:center">Temperature</h3>
					<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

				</div>
				<div class="content table-responsive table-full-width">
					<h3 style="text-align:center">Soil Moisture</h3>
					<div id="chartContainer2" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

				</div>
				<div class="content table-responsive table-full-width">
					<h3 style="text-align:center">Humidity</h3>
					<div id="chartContainer3" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

				</div>
				<div class="content table-responsive table-full-width">
					<h3 style="text-align:center">Intensity</h3>
					<div id="chartContainer4" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

				</div>
			</div>
			<div class="content table-responsive table-full-width">
				<h3 style="text-align:center">Duration Drip(Seconds)</h3>
				<div id="chartContainer5" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>

			</div>
		</div>
	</div>




</div>

<script>
	window.onload = function() {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			title: {
				text: ""
			},
			toolTip: {
				shared: true
			},
			axisX: {
				title: "",
				suffix: " "
			},
			axisY: {
				title: "Temperature (Celcius)",
				titleFontColor: "#4F81BC",
				suffix: " ",

				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY1: {
				title: "Penyiraman",
				titleFontColor: "#4F81BC",
				suffix: " ",

				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				title: "Penyiraman",
				titleFontColor: "#C0504E",
				suffix: " ",
				lineColor: "#C0504E",
				tickColor: "#C0504E"
			},
			data: [{
					type: "spline",
					name: "Sebelum Penyiraman",
					xValueFormatString: "#### ",
					yValueFormatString: "#,##",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='1'  ");
						while ($row = mysql_fetch_array($sql)) {
							$y = $row['temperature'] - 1;
							?> {
							x: <?php echo $row['temperature']; ?>,
							y: <?php echo $y; ?>
						},
						<?php
						}
						?>
					]
				},
				{
					type: "spline",

					name: "Setelah Penyiraman",
					yValueFormatString: "#,##0.# ",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='2'  ");
						while ($row = mysql_fetch_array($sql)) {
							?> {
							x: <?php echo $row['temperature']; ?>,
							y: <?php echo $row['temperature']; ?>
						},
						<?php
						}
						?>
					]
				}
			]
		});
		chart.render();




		var chart = new CanvasJS.Chart("chartContainer2", {
			animationEnabled: true,
			title: {
				text: ""
			},
			toolTip: {
				shared: true
			},
			axisX: {
				title: " ",
				suffix: " "
			},
			axisY: {
				title: "Soil Moisture (%)",
				titleFontColor: "#4F81BC",
				suffix: " ",
				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				title: "Setelah Penyiraman",
				titleFontColor: "#C0504E",
				suffix: " ",
				lineColor: "#C0504E",
				tickColor: "#C0504E"
			},
			data: [{
					type: "spline",

					name: "Sebelum Penyiraman",
					xValueFormatString: "#### ",
					yValueFormatString: "#,##",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='1' ");
						while ($row = mysql_fetch_array($sql)) {
							$y = $row['soilmoisture'] - 1;
							?> {
							x: <?php echo $row['soilmoisture']; ?>,
							y: <?php echo $y; ?>
						},
						<?php
						}
						?>
					]
				},
				{
					type: "spline",

					name: "Setelah Penyiraman",
					yValueFormatString: "#,##0.# ",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='2'  ");
						while ($row = mysql_fetch_array($sql)) {
							?> {
							x: <?php echo $row['soilmoisture']; ?>,
							y: <?php echo $row['soilmoisture']; ?>
						},
						<?php
						}
						?>
					]
				}
			]
		});
		chart.render();



		var chart = new CanvasJS.Chart("chartContainer3", {
			animationEnabled: true,
			title: {
				text: ""
			},
			toolTip: {
				shared: true
			},
			axisX: {
				title: "",
				suffix: " "
			},
			axisY: {
				title: "Humidity (%)",
				titleFontColor: "#4F81BC",
				suffix: " ",
				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				title: "Setelah Penyiraman",
				titleFontColor: "#C0504E",
				suffix: " ",
				lineColor: "#C0504E",
				tickColor: "#C0504E"
			},
			data: [{
					type: "spline",
					name: "Sebelum Penyiraman",
					xValueFormatString: "#### ",
					yValueFormatString: "#,##",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='1' ");
						while ($row = mysql_fetch_array($sql)) {
							$y = $row['humidity'] - 1;
							?> {
							x: <?php echo $row['humidity']; ?>,
							y: <?php echo $y; ?>
						},
						<?php
						}
						?>
					]
				},
				{
					type: "spline",

					name: "Setelah Penyiraman",
					yValueFormatString: "#,##0.# ",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='2'  ");
						while ($row = mysql_fetch_array($sql)) {
							?> {
							x: <?php echo $row['humidity']; ?>,
							y: <?php echo $row['humidity']; ?>
						},
						<?php
						}
						?>
					]
				}
			]
		});
		chart.render();



		var chart = new CanvasJS.Chart("chartContainer4", {
			animationEnabled: true,
			title: {
				text: ""
			},
			toolTip: {
				shared: true
			},
			axisX: {
				title: " ",
				suffix: " "
			},
			axisY: {
				title: "Intensity (Lux)",
				titleFontColor: "#4F81BC",
				suffix: " ",
				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				title: "Setelah Penyiraman",
				titleFontColor: "#C0504E",
				suffix: " ",
				lineColor: "#C0504E",
				tickColor: "#C0504E"
			},
			data: [{
					type: "spline",
					name: "Sebelum Penyiraman",
					xValueFormatString: "#### ",
					yValueFormatString: "#,##",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='1' ");
						while ($row = mysql_fetch_array($sql)) {
							$y = $row['intensity'] - 1;
							?> {
							x: <?php echo $row['intensity']; ?>,
							y: <?php echo $y; ?>
						},
						<?php
						}
						?>
					]
				},
				{
					type: "spline",

					name: "Setelah Penyiraman",
					yValueFormatString: "#,##0.# ",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='2'  ");
						while ($row = mysql_fetch_array($sql)) {
							?> {
							x: <?php echo $row['intensity']; ?>,
							y: <?php echo $row['intensity']; ?>
						},
						<?php
						}
						?>
					]
				}
			]
		});
		chart.render();




		var chart = new CanvasJS.Chart("chartContainer5", {
			animationEnabled: true,
			title: {
				text: ""
			},
			toolTip: {
				shared: true
			},
			axisX: {
				title: "",
				suffix: " "
			},
			axisY: {
				title: "Duration Drip (Seconds)",
				titleFontColor: "#4F81BC",
				suffix: " ",

				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY1: {
				title: "Fuzzy Rule-based Combination",
				titleFontColor: "#4F81BC",
				suffix: " ",

				lineColor: "#4F81BC",
				tickColor: "#4F81BC"
			},
			axisY2: {
				title: "Penyiraman",
				titleFontColor: "#C0504E",
				suffix: " ",
				lineColor: "#C0504E",
				tickColor: "#C0504E"
			},
			data: [{
					type: "spline",
					name: "Fuzzy rule-based Triangle",
					xValueFormatString: "#### ",
					yValueFormatString: "#,##",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='1'  ");
						while ($row = mysql_fetch_array($sql)) {
							$y = $row['temperature'] - 1;
							?> {
							x: <?php echo $row['temperature']; ?>,
							y: <?php echo $y; ?>
						},
						<?php
						}
						?>
					]
				},
				{
					type: "spline",

					name: "Fuzzy rule-based Combination",
					yValueFormatString: "#,##0.# ",
					dataPoints: [
						<?php
						$sql = mysql_query("select * from node_1 where status='2'  ");
						while ($row = mysql_fetch_array($sql)) {
							?> {
							x: <?php echo $row['temperature']; ?>,
							y: <?php echo $row['temperature']; ?>
						},
						<?php
						}
						?>
					]
				}
			]
		});
		chart.render();



	}
</script>
<script src="js/jquery.canvasjs.min.js"></script>
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