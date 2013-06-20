<?php
protect();

$pid = (int)$_GET['r'];

		$query = $pdo->prepare('DELETE FROM profil WHERE pid = ?');
		$query->bindValue(1, $pid, PDO::PARAM_STR);
		$query->execute();

		redirect('/profil');

?>	