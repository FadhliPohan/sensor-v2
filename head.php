<?php 
session_start();
if ($_SESSION['username'] == null || $_SESSION['password'] == null) {
	echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	exit;
}

include "inc/koneksi.php";
include "config/authentication_users.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
include 'inc/librari.php';
$tanggal = tgl_indo(date("Y m d"));
$jam	= date("H:i:s");
?>
<!DOCTYPE html>
