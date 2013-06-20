<?php 
protect();
if($_SESSION['level'] < 1) {
redirect('/denied');
exit();
} else {
if(isset($_POST['tambah'])) {

	$kat 	= $_POST['kategori'];
	$seo 	= seo($kat);
	$ket 	= $_POST['ket'];

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$data = array($kat, $seo, $ket);
	$query = $pdo->prepare('INSERT INTO kategori (kategori, seo, ket) 
		VALUES (?, ?, ?)');
	$query->execute($data);

	redirect('/kategori/daftar');
}
?>
<h2>Tambah Kategori</h2>
<form id="form" method="post" action="">
<label>Nama Kategori</label><input type="text" class="input required" name="kategori" />
<label>Keterangan</label><input type="text" class="input-xxlarge required" name="ket" />
<label></label>
<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
</form>	
<?php } ?>