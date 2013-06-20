<?php

protect();
$kid = $_GET['r'];

$query = $pdo->prepare("SELECT kid, kelas, ket FROM kelas WHERE kid = ?");
$query->bindValue(1, $kid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Detail <?=$row['kelas']?></h3>
<table class="table">
	<tr><td class="span3">Nama Kelas</td><td><?=$row['kelas']; ?></td></tr>
	<tr><td>Keterangan</td><td><?=$row['ket']; ?></td></tr>
</table>	
<button onclick="history.go(-1);" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Kembali</button>