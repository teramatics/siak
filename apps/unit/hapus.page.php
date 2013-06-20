<?php 
$uid = abs((int)$_GET['r']);
if(!empty($uid)) {
		$query = $pdo->prepare('DELETE FROM unit WHERE uid = ?');
		$query->bindValue(1, $uid);

	  	$query->execute();
	redirect('/unit');
}	
?>	