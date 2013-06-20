<?php 
$uid = abs((int)$_GET['r']);

if(isset($_POST['unit'], $_POST['ket'])) {

	$unit	= $_POST['unit'];
	$kode = str_replace(' ', '', strtolower($unit));
	$ket = $_POST['ket'];

		$query = $pdo->prepare('UPDATE unit SET kode=?, unit = ?, ket = ? WHERE uid = ?');
	  	$query->execute(array($kode, $unit, $ket));
	  	
	  	redirect('/unit');
}
$query = $pdo->prepare("SELECT uid, unit, ket FROM unit WHERE uid = ?");
$query->bindValue(1, $uid);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<h3>Edit Data <?=$row['unit']?></h3>
<form method="post" action="">
	<label>Nama Unit</label>
    <input type="text" name="unit" value="<?=$row['unit']; ?>" />
    <label>Keterangan</label>
    <input type="text" name="ket" value="<?=$row['ket']; ?>" class="input input-xxlarge" />
    <label></label>
    <input type="submit" name="submit" value="Update" class="btn btn-primary" />	
</form>	