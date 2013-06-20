<?php

protect();
$uid = $_GET['r'];

$query = $pdo->prepare("SELECT uid, unit, ket FROM unit WHERE uid = ?");
$query->bindValue(1, $uid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Detail <?=$row['unit']?></h3>
<table class="table">
	<tr><td class="span3">Nama Unit</td><td><?=$row['unit']; ?></td></tr>
	<tr><td>Keterangan</td><td><?=$row['ket']; ?></td></tr>
</table>	
<button onclick="history.go(-1);" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Kembali</button>