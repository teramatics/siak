<?php 
$kid = abs((int)$_GET['r']);
if(!empty($kid)) {
		$query = $pdo->prepare('DELETE FROM kelas WHERE kid = ?');
		$query->bindValue(1, $kid);

	  	$query->execute();
	redirect('/kelas');
}	
?>	