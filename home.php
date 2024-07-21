<?php
include'sidebar.php';

include "inc/koneksi.php";

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style type="text/css">
<!--
.style1 {font-size: 14px}
-->
    </style>
    <div class="main-panel" style="background-image:url(gedung.jpg)">
		

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    

                    <div class="col-md-10">
							<table bordercolor="#0C1015" bgcolor="#9900FF" class="table table-bordered" style="background-color:white">
								<tr>
									<td bgcolor="#9966CC">TEMPERATURE (CELCIUS)</td>
									<td bgcolor="#9966CC">SOIL MOISTURE (%)</td>
								<td bgcolor="#9966CC">HUMIDITY (%)</td>
								<td bgcolor="#9966CC">INTENSITAS (LUX)</td>
								
								</tr>
								<tr>
								<?php
								$data=mysql_query("select * from tb_hasil_menit ORDER BY id_hasil DESC LIMIT 0,1");
								while($row=mysql_fetch_array($data)){
									$nilai=$row['nilai'];
									echo"
									<td>".$row['suhu']."</td>
									<td>".$row['sm']."</td>
									<td>".$row['humidity']."</td>
									<td>".$row['li']."</td>
									
									";
								}
									
								?>
								</tr>
								<tr>
									<td bgcolor="#9966CC">
								  <button id="start">start</button></td>
									<td colspan="2" bgcolor="#9966CC" style="text-align:center"><h1><time>00:00:00</time></h1><h3 class="style1"> DURATION DRIP IRIGASI <?php echo $nilai; ?> 
SECONDS</h3></td>
									<td bgcolor="#9966CC" id="lampu"></td>
								</tr>
					  </table>
                    </div>


                </div>
            </div>
        </div>

     

    </div>
</div>


</body>
<script>
document.getElementById("lampu").style.backgroundColor = "red";
var h1 = document.getElementsByTagName('h1')[0],
    start = document.getElementById('start'),
    stop = document.getElementById('stop'),
    clear = document.getElementById('clear'),
	
    seconds = <?php echo $nilai; ?>, minutes = 0, hours = 0,
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
	if(seconds == 1){
		    clearTimeout(t);
			document.getElementById("lampu").style.backgroundColor = "red";
			alert("Penyiraman Selesai Dilakukan");
			location.reload();
	}else{
		
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
    seconds = 0; minutes = 0; hours = 0;
}

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
