<?php 
$kid = $_GET['r']; 
if(isset($_POST['update'])) {

	$kategori 	= $_POST['kategori'];
	$seo 	= seo($_POST['kategori']);
	$ket 	= $_POST['ket'];

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query = $pdo->prepare('UPDATE kategori SET kategori=?, seo=?, ket=? WHERE kid=?');
	$query->execute(array($kategori, $seo, $ket, $kid));
	redirect('/kategori/daftar');
}	
	$query = $pdo->prepare('SELECT kid, kategori, seo, ket FROM kategori WHERE kid = ?') or die('Get data error');
		$query->bindValue(1, $kid);
		$query->execute();
		$kat = $query->fetch(PDO::FETCH_ASSOC);
		$ket = $kat['ket'];
?>
<h3><?=$kat['kategori'];?></h3>
<form id="form" method="post" action="">
<label>Nama Ketegori</label><input type="text" name="kategori" value="<?=$kat['kategori']?>" />
<label>Keterangan</label><input type="text" class="input-xxlarge" name="ket" value="<?=$ket?>" />
<label>&nbsp;<label><input type="submit" name="update" value="Update" class="btn btn-primary" />
</form>	