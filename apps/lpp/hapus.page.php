<?php
protect();
$unit   = $_GET['q'];
$level  = $_GET['r'];
$kelas  = $_GET['s'];
$uid = (int)$_GET['t'];
if($_GET['u'] == 'hapus') {
		$query = $pdo->prepare('DELETE FROM profil WHERE uid = ?');
		$query->bindValue(1, $uid, PDO::PARAM_STR);
		$query->execute();

		$query = $pdo->prepare('DELETE FROM users WHERE uid = ?');
		$query->bindValue(1, $uid, PDO::PARAM_STR);
		$query->execute();


		$direct = $base.'siswa/'.$unit.'/'.$level.'/'.$kelas;
  		redirect($direct);
}
?>	