<?php 
$seo = htmlentities($_GET['r']);

	$query = $pdo->prepare("SELECT berita.berita_id as bid, berita.judul as judul, 
			berita.seo as seo, berita.isi as isi, kategori.kategori as kat, berita.tanggal as tgl
			FROM berita 
		   	INNER JOIN kategori on berita.kategori_id = kategori.kategori_id 
		   	WHERE berita.seo = ?");
	$query->bindValue(1, $seo);
	$query->execute();
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<h3><?=$data['judul']?></h3>
<span class="label label-success"><?=$data['kat']?></span> <span class="label label-info"><?php echo tgl(substr($data['tgl'], 0, 10)).' - <small>'.substr($data['tgl'], -8);?> WIB</small></span>
<?=$data['isi']?>