<?php
$q = strtolower($_GET["q"]);
if (!$q) return;

$query = $pdo->prepare('select DISTINCT kota from kota where kota LIKE ?');
$query->bindValue(1, %$q%);
$query->execute();
while($rs = $query->fetch(PDO::FETCH_ASSOC)) {
	$cname = $rs['kota'];
	echo "$cname\n";
}
?>