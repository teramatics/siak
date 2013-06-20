<?php 
$mid = abs((int)$_GET['r']);

if(isset($_POST['mapel'], $_POST['ket'])) {

	$mapel	= $_POST['mapel'];
	$ket = $_POST['ket'];

		$query = $pdo->prepare('UPDATE mapel SET mapel = ?, ket = ? WHERE mid = ?');
		$query->bindValue(1, $mapel);
	  	$query->bindValue(2, $ket);
	  	$query->bindValue(3, $mid);

	  	$query->execute();
	  	
	  	redirect('/mapel');
}
$query = $pdo->prepare("SELECT mid, mapel, ket FROM mapel WHERE mid = ?");
$query->bindValue(1, $mid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Edit Data <?=$row['mapel']?></h3>
<form method="post" action="">
	<label>Nama Mapel</label>
    <input type="text" name="mapel" value="<?=$row['mapel']; ?>" />
    <label>Keterangan</label>
    <input type="text" name="ket" value="<?=$row['ket']; ?>" class="input input-xxlarge" />
    <label></label>
    <input type="submit" name="submit" value="Update" class="btn btn-primary" />	
</form>	