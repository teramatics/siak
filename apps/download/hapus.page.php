<?php 
$uid = abs((int)$_GET['r']);
if(!empty($uid)) {
		$query = $pdo->prepare('DELETE FROM artikel WHERE aid = ?');
		$query->bindValue(1, $uid);

	  	$query->execute();
	redirect('/featured');
}	
?>	