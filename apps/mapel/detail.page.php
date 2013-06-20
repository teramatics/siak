<?php

protect();
$mid = $_GET['r'];

$query = $pdo->prepare("SELECT mapel, ket FROM mapel WHERE mid = ?");
$query->bindValue(1, $mid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Detail <?=$row['mapel']?></h3>
<table class="table">
	<tr><td class="span3">Nama Mapel</td><td><?=$row['mapel']; ?></td></tr>
	<tr><td>Keterangan</td><td><?=$row['ket']; ?></td></tr>
</table>	
<button onclick="history.go(-1);" class="btn btn-primary"><i class="icon-arrow-left icon-white"></i> Kembali</button>