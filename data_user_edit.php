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
							<h3 style="text-align:center">FORM EDIT</h3>
             	<form class="form-horizontal" action="data_user_edit.php" method="post" role="form">
				<div class="panel panel-default">
					<div class="panel-body">
							<input type="hidden" name="id_user" value="<?php echo $_GET['id_user']; ?>"required class="form-control">
							
						
						<div class="form-group">
							<label class="col-sm-2 control-label text-left">Username</label>
							<div class="col-sm-10">
								<input type="text" name="username"required value="<?php echo $username; ?>" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label text-left">Password</label>
							<div class="col-sm-10">
								<input type="password" name="password"  class="form-control">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label text-left">Status</label>
							<div class="col-sm-10">
								<select name="status" required class="form-control">
									
									<option value="1">User1</option>
									<option value="0">User2</option>
									
								</select>
							</div>
						</div>
						
						<div class="form-action text-left">
							<input type="submit" name="simpan" value="Save" class="btn btn-primary">
							<input type="button" name="kembali" value="Back" onClick="javascript:history.back()" class="btn btn-default">
						</div>

					</div>
				</div>
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
<?php 
			if (isset($_POST['simpan'])) {
				$username			 = $_POST['username'];
				$password 		= $_POST['password'];
				$status 		= $_POST['status'];
				
				if($password == ""){
$sql = "UPDATE tbl_user SET username='$username',status='$status' where id_user='".$_POST['id_user']."'";
				
				}else{
				$sql = "UPDATE tbl_user SET username='$username',password='$password',status='$status' where id_user='".$_POST['id_user']."'";
					
				}
				$query = mysql_query($sql) or die(mysql_error());
				if ($query) {
					echo "<script>window.alert('Data User  Berhasil Diedit');
								window.location=(href='data_user.php')</script>";
				}}
			?>

</html>
