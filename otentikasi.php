<?php 
include 'inc/koneksi.php';
function antiinjection($data){
	$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter_sql;
}
session_start();

// tangkap data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// untuk mencegah sql injection
$username = antiinjection($username);
$password = antiinjection($password);

$loginadmin = mysql_query("SELECT * FROM tbl_user where username='$username' AND password='$password'");
$q = mysql_fetch_array($loginadmin);

if (mysql_num_rows($loginadmin) == 1) {
	// kalau username dan password sudah terdaftar di database
	// buat session dengan nama username dengan isi nama user yang login
	$_SESSION['username'] = $q['username'];
	$_SESSION['password'] = $q['password'];
$_SESSION['status'] = $q['status'];

	// redirect ke halaman index
	header('location: home.php');
} else {
	// kalau username ataupun password tidak terdaftar di database
	echo"<script>alert('Username dan Password tidak terdaftar');location.href='index.php'</script>";
	//header('location:index.php');
	

}
?>