<?php 
$kid = abs((int)$_GET['r']);

if(isset($_POST['kelas'], $_POST['ket'])) {

	$kelas	= $_POST['kelas'];
	$ket = $_POST['ket'];

		$query = $pdo->prepare('UPDATE kelas SET kelas = ?, ket = ? WHERE kid = ?');
		$query->bindValue(1, $kelas);
	  	$query->bindValue(2, $ket);
	  	$query->bindValue(3, $kid);

	  	$query->execute();
	  	
	  	redirect('/kelas');
}
$query = $pdo->prepare("SELECT kid, kelas, ket FROM kelas WHERE kid = ?");
$query->bindValue(1, $kid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Edit Data <?=$row['kelas']?></h3>
<form method="post" action="">
	<label>Nama Kelas</label>
    <input type="text" name="kelas" value="<?=$row['kelas']; ?>" />
    <label>Keterangan</label>
    <input type="text" name="ket" value="<?=$row['ket']; ?>" class="input input-xxlarge" />
    <label></label>
    <input type="submit" name="submit" value="Update" class="btn btn-primary" />	
</form>	