<?php
include "head.php";
include "templete/head.php";
include "templete/sidebar.php";
?>
<div class="container-fluid">
	<div class="card w-100 position-relative overflow-hidden">
		<div class="px-4 py-3 border-bottom">
			<h5 class="card-title fw-semibold mb-0 lh-sm">Data User</h5>
		</div>
		<div class="card-body p-4">
			<div class="table-responsive rounded-2 mb-4">
				<table class="table border text-nowrap customize-table mb-0 align-middle">
					<thead class="text-dark fs-4">
						<tr>
							<th>
								<h6 class="fs-4 fw-semibold mb-0">No</h6>
							</th>
							<th>
								<h6 class="fs-4 fw-semibold mb-0">Username</h6>
							</th>
							<th>
								<h6 class="fs-4 fw-semibold mb-0">Status</h6>
							</th>
							<th>
								<h6 class="fs-4 fw-semibold mb-0">Action</h6>
							</th>

						</tr>
					</thead>
					<tbody>
						<?php
						/*$sql = "SELECT * FROM tbl_kriteria";
							$nomor = 0;
							foreach ($dbh->query($sql) as $data) :
							*/
						$nomor = 0;
						$tampil = mysql_query("SELECT * FROM tbl_user");
						while ($data = mysql_fetch_array($tampil)) {
							if ($data['status'] == 1) {
								$status = "User1";
							} else {
								$status = "User2";
							}
							?>
						<tr>
							<td>
								<h6 class="fs-4 fw-semibold mb-0"><?php echo $nomor = $nomor + 1; ?></h6>
							</td>
							<td>
								<h6 class="fs-4 fw-semibold mb-0"><?php echo $data['username']; ?></h6>
							</td>
							<td>
								<h6 class="fs-4 fw-semibold mb-0"><?php echo $status; ?></h6>
							</td>
							<td>
								<a class="btn btn-warning btn-sm" href="data_user_edit.php?id_user=<?php echo $data['id_user']; ?>">
									Edit User </a>
								</a> </td>
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
<?php
include "templete/script.php";
?>
<?php
include "templete/footer.php";
?>