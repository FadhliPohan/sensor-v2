<?php
include "head.php";
$sql=mysql_query("DELETE from node_1 where id='".$_GET['id']."'");
?>
<script>
	location.href="monitoring.php";
</script>