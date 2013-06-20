<?php
protect(); 
if($_SESSION['level'] > 2) { 
	redirect('/denied');
	exit();
} else { 
?>
<div class="btn-group pull-right">
	<a href="/download" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/download/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Daftar Download</h2>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>KATEGORI</th>
				<th>JUDUL</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT download.did as did, download.judul as judul, download.seo as seo, download.link as link, kategori.kategori as kat, kategori.seo as kseo FROM download INNER JOIN kategori on kategori.kid = download.kid ORDER BY download.did DESC');
	$query->execute();
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['kat']?></td>
				<td><a href="<?=$base?>download/detail/<?=$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><?=$row['judul']?></a></td>
				<td>
					<a href="<?=$base?>download/detail/<?=$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><i class="icon-list-alt"></i></a> 
					<a href="<?=$base?>download/edit/<?=$row['seo']?>" title="Edit <?=$row['judul']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>download/hapus/<?=$row['seo']?>" title="Hapus <?=$row['judul']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>