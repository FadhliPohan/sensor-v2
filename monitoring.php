<?php
include "head.php";
?>

<?php
include'sidebar.php';
?>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
<div class="main-panel">
		

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
							<h3 style="text-align:center"> Monitoring Data </h3>
					<table class="table table-bordered">
						<tr>
							<th>Time</th>
							<th>Temperature</th>
							<th>Soilmoisture</th>
							<th>Humidity</th>
							<th>Intensity</th>
							<th>Action</th>
						</tr>
						<?php
							$sql=mysql_query("select * from node_1");
										while($row=mysql_fetch_array($sql)){
											echo"
												<tr>
													<td>".$row['time']."</td>
													<td>".$row['temperature']."</td>
													<td>".$row['soilmoisture']."</td>
													<td>".$row['humidity']."</td>
													<td>".$row['intensity']."</td>
													<td>
														<a href='hapus_monitoring.php?id=".$row['id']."'>Hapus</a>
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
        </div>

        <footer class="footer">
            <div class="container-fluid">
              
              
            </div>
        </footer>


    </div>
</div>


</body>

  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
	<script>
$(document).ready(function() {
	$('#example').DataTable();
} );

	</script>

<script>
function fungsi_nama_toko(){
	// var variabel = document.getElementById("nama_toko").value;
		
				if($('#tanggal').val()!=""){
						$.ajax({
								url   :'http://localhost/aplikasi/perhitungan2.php?id='+$('#tanggal').val(),
								type  : 'GET',
											 
								async : false,
								cache : false,
											  //dataType : 'jsonp',
											  processData : false,
											  contentType : false,
											  success:function (data){
												 
												  $("#div_data").html(data);
											  }
						})
										}
}	

</script>
</html>
