<?php 
$mid = abs((int)$_GET['r']);
if(!empty($mid)) {
		$query = $pdo->prepare('DELETE FROM mapel WHERE mid = ?');
		$query->bindValue(1, $mid);

	  	$query->execute();
	redirect('/mapel');
}	
?>	