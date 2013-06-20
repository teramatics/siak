<?php 
protect(); 

if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/download/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('apps/download/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/download/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/download/tambah.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'kelola') {
include('apps/download/kelola.page.php');
} else { ?>
<h2>Download</h2>
<p>Download materi kajian dalam format mp3, pdf atau format lainya.</p>
<?php
$query = $pdo->prepare('SELECT download.did as did, download.judul as judul, download.seo as seo, download.isi as isi, download.file as file, download.link as link, download.dibuat as tgl, kategori.kategori as kat, kategori.seo as kseo, users.uid as uid, users.uname as uname, users.nama as posted FROM download INNER JOIN kategori on kategori.kid = download.kid INNER JOIN users on users.uid = download.post_id ORDER BY download.did DESC');
	$query->execute();
	$num = $query->rowCount();
	if($num > 0) {
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
<h3><?=$data['judul']?></h3>
<?=substr($data['isi'], 0, 200);?>
<p><a class="btn btn-small" href="<?=$base?>download/detail/<?=$data['seo']?>">Selengkapnya...</a></p>
<?php } } else { echo 'Belum ada data download'; } ?>
<?php } ?>	