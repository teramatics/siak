<?php 
include('../../settings/config.php');
//if (isset($_POST['query'])) {
	//$query = 'ka';
	$query2 = $pdo->prepare('SELECT kid, parent, kategori, seo FROM kategori'); // WHERE kategori LIKE ?');
	//$query2->bindValue(1, "%$query%");
	$query2->execute();
	$array = array();
	while ($row = $query2->fetch(PDO::FETCH_ASSOC)) {
		$array[] = $row['kategori'];
	}

	echo json_encode($array);
//}
?>		