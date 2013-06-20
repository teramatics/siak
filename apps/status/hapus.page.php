<?php 
$wid = abs((int)$_GET['r']);
if(!empty($wid)) {
		$query = $pdo->prepare('DELETE FROM wall WHERE wid = ?');
		$query->bindValue(1, $wid);

	  	$query->execute();
	redirect('/dashboard');
}	
?>	