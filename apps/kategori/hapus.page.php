<?php 
$uid = abs((int)$_GET['r']);
if(!empty($uid)) {
		$query = $pdo->prepare('DELETE FROM kategori WHERE kid = ?');
		$query->bindValue(1, $uid);

	  	$query->execute();
	redirect('/kategori/daftar');
}	
?>	