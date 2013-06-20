<?php 
protect(); 
if($_SESSION['level'] > 2) {
redirect('/denied');
exit();
} else { 
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/featured/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('apps/featured/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/featured/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/featured/tambah.page.php');
} else { ?>
<div class="btn-group pull-right">
	<a href="/featured" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/featured/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Daftar Featured Artikel</h2>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>KATEGORI</th>
				<th>JUDUL</th>
				<th>STATUS</th>
				<th>PENULIS</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.publish as publish, kategori.kategori as kat, kategori.seo as katseo, users.nama as nama FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid INNER JOIN users on users.uid = artikel.post_id WHERE artikel.featured=1');
	$query->execute();
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['kat']?></td>
				<td><a href="<?=$base?>konten/<?=$row['katseo'].'/'.$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><?=$row['judul']?></a></td>
				<td><?php if($row['publish'] == 1) { echo 'Publish'; } else if($row['publish'] == 0) { echo 'UnPublish';} ?> </td>
				<td><?=$row['nama']?></td>
				<td>
					<a href="<?=$base?>konten/<?=$row['katseo'].'/'.$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><i class="icon-list-alt"></i></a> 
					<a href="<?=$base?>featured/edit/<?=$row['seo']?>" title="Edit <?=$row['judul']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>featured/hapus/<?=$row['seo']?>" title="Hapus <?=$row['judul']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } } ?>	