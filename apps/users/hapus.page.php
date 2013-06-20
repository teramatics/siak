<?php
protect();

if(isset($_GET['r'])) {
		$uid = $_GET['r'];
		$query = $pdo->prepare('DELETE FROM users WHERE uid = ?');
		$query->bindValue(1, $uid, PDO::PARAM_STR);
		$query->execute();

		$query = $pdo->prepare('DELETE FROM profil WHERE uid = ?');
		$query->bindValue(1, $uid, PDO::PARAM_STR);
		$query->execute();

		redirect('/users');
		exit();
}		