<?php
include "head.php";
mysql_query("delete from tb_hasil_menit where id_hasil='".$_GET['id_hasil']."'");
?>
<script>
alert("data berhasil dihapus");
location.href="perhitungan.php";
</script>

