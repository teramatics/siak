<?php 
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/kategori/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/kategori/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/kategori/tambah.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'detail') {
include('apps/kategori/detail.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'daftar') {
include('apps/kategori/daftar.page.php');
} else if(!empty($_GET['q'])) {
		$kid = $_GET['q'];
		$query = $pdo->prepare('SELECT kategori FROM kategori WHERE seo = ?') or die('Get data error');
		$query->bindValue(1, $kid);
		$query->execute();
		$kat = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2>Kategori <?=$kat['kategori']?><span class="h-line"></i></h2>
<?php 
	$kid = $_GET['q'];
	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.isi as isi, artikel.foto as foto, artikel.dibuat as dibuat, kategori.kategori as kat, kategori.seo as katseo, users.uid as uid, users.uname as uname, users.nama as posted FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid INNER JOIN users on users.uid = artikel.post_id WHERE artikel.publish = ? AND kategori.seo = ?');
	$query->execute(array(1, $kid));
	$num = $query->rowCount();
	if($num > 0) {
	while($data = $query->fetch(PDO::FETCH_ASSOC)) { 
?>
<div class="row-fluid">
<div class="span12">
<h3><?=$data['judul']?><span class="h-line"></i></h3>
</div>
</div>
<div class="row-fluid">
<?php if($data['foto']) { ?>	
<div class="span3">
<img id="zoom" class="thumbnail" src="/public/artikel/<?=$data['foto']?>" alt="<?=$data['judul']?>">
</div>
<?php } ?>
<div class="span9">
<?=substr($data['isi'], 0, 400)?>
<p><a class="btn btn-small" href="<?=$base?>konten/<?=$data['katseo'].'/'.$data['seo']?>">Selengkapnya...</a></p>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<p></p>
<p>
<i class="icon-user"></i> Ditulis oleh <a href="<?=$base?>profil/<?=$data['uname']?>"><?=$data['posted']?></a>
 <i class="icon-calendar"></i> <?=$data['dibuat']?>
 <i class="icon-tags"></i> Kategori: <a href="<?=$base?>kategori/<?=$data['katseo']?>"><span class="label label-info"><?=$data['kat']?></span></a>
</p>
</div>
</div>
<?php } 
} else { 
	echo 'Belum ada artikel di kategori ini';
} 
} else { ?>	
<h2>Kategori Artikel</h2>
<ul class="nav-list">
	<?php
	$query = $pdo->prepare('SELECT * FROM kategori');
	$query->execute();
	while($kat = $query->fetch(PDO::FETCH_ASSOC)) { ?>
	<li><a href="/kategori/<?=$kat['seo']?>"><?=$kat['kategori']?></a></li>
	<?php } ?>
</ul>
<?php } ?>					