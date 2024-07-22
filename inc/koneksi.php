<?php 
$server = "localhost";
$username = "crez1389_fadli";
$password = "lokasi123!";
$database = "crez1389_sensor";
$konek = mysql_connect($server, $username, $password) or die("Gagal konek ke server MySQL" .mysql_error());
$bukadb = mysql_select_db($database) or die("Gagal membuka database $database" .mysql_error());
?>
<?php
/*$dsn = "mysql:dbname=spk_ahp;host=localhost";
$user = "root";
$pass = "";

try{
	$dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
	echo "Koneksi ke database gagal: ".$e->getMessage();
}*/
?>