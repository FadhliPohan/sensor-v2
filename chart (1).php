<?php
include "head.php";
?>

<?php
include'sidebar.php';
?>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="chartjs/Chart.js"></script>
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
    <div class="main-panel">
		

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
					<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
			
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
<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$jumlah_teknik = mysql_query("select SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='01' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='02' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='03' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='04' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='05' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='06' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='07' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='08' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='09' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='10' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='11' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					<?php 
					$jumlah_teknik = mysql_query("select  SUM(DISTINCT(nilai))as total from tb_hasil_menit where MONTH(tanggal)='12' AND YEAR(tanggal)='".date('Y')."'");
					$row=mysql_fetch_array($jumlah_teknik);
					echo "".$row['total']."";
					?>,
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
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
