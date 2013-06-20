<?php 
$uid = $_GET['r'];
if(!empty($uid)) {
		$query = $pdo->prepare('DELETE FROM artikel WHERE seo = ?');
		$query->bindValue(1, $uid);

	  	$query->execute();
	redirect('/featured');
}	
?>	