<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>
<div class="container-fluid">
	<div class="card w-100 position-relative overflow-hidden">
		<div class="px-4 py-3 border-bottom">
			<h5 class="card-title fw-semibold mb-0 lh-sm">Monitoring Data</h5>
		</div>
		<div class="card-body p-4">
			<div class="table-responsive rounded-2 mb-4">
				<table class="table border text-nowrap customize-table mb-0 align-middle" id="example">
					<thead class="text-dark fs-4">
						<tr>
							<td>
								<h6 class="fs-4 fw-semibold mb-0">TEMPERATURE (CELCIUS)</h6>
							</td>
							<td>
								<h6 class="fs-4 fw-semibold mb-0">SOIL MOISTURE (%)</h6>
							</td>
							<td>
								<h6 class="fs-4 fw-semibold mb-0">HUMIDITY (%)</h6>
							</td>
							<td>
								<h6 class="fs-4 fw-semibold mb-0">INTENSITAS (LUX)</h6>
							</td>

						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							$data = mysql_query("select * from tb_hasil_menit ORDER BY id_hasil DESC LIMIT 0,1");
							while ($row = mysql_fetch_array($data)) {
								$nilai = $row['nilai'];
								echo "
									<td>" . $row['suhu'] . "</td>
									<td>" . $row['sm'] . "</td>
									<td>" . $row['humidity'] . "</td>
									<td>" . $row['li'] . "</td>
									";
							}

							?>
						</tr>

						<tr>
							<td bgcolor="#9966CC" class="text-center">
								<button class="btn btn-primary " id="start">start</button></td>
							<td colspan="2" bgcolor="#9966CC" style="text-align:center">
								<h1><time>00:00:00</time></h1>
								<h3 class="style1"> DURATION DRIP NUTRITION <?php echo $nilai; ?>
									SECONDS</h3>
							</td>
							<td bgcolor="#9966CC" id="lampu"></td>
						</tr>

					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>

<script>
	document.getElementById("lampu").style.backgroundColor = "red";
	var h1 = document.getElementsByTagName('h1')[0],
		start = document.getElementById('start'),
		stop = document.getElementById('stop'),
		clear = document.getElementById('clear'),

		seconds = <?php echo $nilai; ?>,
		minutes = 0,
		hours = 0,
		t;

	function add() {
		seconds--;
		if (seconds == 0) {
			seconds = 60;
			minutes--;
			if (minutes == 0) {
				minutes = 60;
				hours--;
			}
		}

		h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 0 ? seconds : "0" + seconds);

		timer();
	}

	function timer() {
		document.getElementById("lampu").style.backgroundColor = "green";
		t = setTimeout(add, 200);
		if (seconds == 1) {
			clearTimeout(t);
			document.getElementById("lampu").style.backgroundColor = "red";
			alert("Penyiraman Selesai Dilakukan");
			location.reload();
		} else {

		}
	}
	//timer();


	/* Start button */
	start.onclick = timer;



	/* Stop button */
	stop.onclick = function() {
		clearTimeout(t);

	}

	/* Clear button */
	clear.onclick = function() {
		h1.textContent = "00:00:00";
		seconds = 0;
		minutes = 0;
		hours = 0;
	}
</script>

<?php
include "templete/footer.php";
?>