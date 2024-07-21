<?php
include "head.php";
?>

<?php
include'sidebar.php';
?>

    <div class="main-panel">
		

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
                   	<a href="data_user_tambah.php"><input type="submit" value="ADDED USER" class="btn btn-info"></a>
				<div class="datatable">
					<table class="table table-hover">
						<thead>
							<tr>
								<th><strong>No</strong></th>
								<th><strong>Username</strong></th>
								<th><strong>Status</strong></th>
								
								<th><strong>Action</strong></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							/*$sql = "SELECT * FROM tbl_kriteria";
							$nomor = 0;
							foreach ($dbh->query($sql) as $data) :
							*/ 
							$nomor=0;
							$tampil = mysql_query("SELECT * FROM tbl_user");
							while ($data = mysql_fetch_array($tampil)) {
								if($data['status'] == 1){
								$status="User1";	
								}else{
								$status="User2";
								}
								?>
								<tr>
									<td><?php echo $nomor=$nomor+1; ?></td>
									<td><?php echo $data['username']; ?></td>
									<td><?php echo $status; ?></td>
									
									<td>
										<a class="btn btn-warning" href="data_user_edit.php?id_user=<?php echo $data['id_user']; ?>">
										Edit										</a>
										
										</a>									</td>
								</tr>
							<?php 
							/*endforeach;*/
						}
							 ?>
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
