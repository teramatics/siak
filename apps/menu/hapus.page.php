<?php 
$uid = abs((int)$_GET['r']);
if(!empty($uid)) {
		$query = $pdo->prepare('DELETE FROM menu WHERE mid = ?');
		$query->bindValue(1, $uid);

	  	$query->execute();
	redirect('/menu');
}	
?>	