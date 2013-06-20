<?php 
protect(); 
if($_SESSION['level'] < 1) {
redirect('/denied');
exit();
} else { ?>
<div class="btn-group pull-right">
	<a href="/kategori/daftar" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/kategori/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Daftar Kategori</h2>
<table class="table-bordered table-hover display" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>KATEGORI</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT kid, kategori, seo FROM kategori');
	$query->execute();
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['kategori']?></td>
				<td>
					<a href="<?=$base?>kategori/<?=$row['seo']?>" title="Lihat Detail <?=$row['kategori']?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base?>kategori/edit/<?=$row['kid']?>" title="Edit <?=$row['kategori']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>kategori/hapus/<?=$row['kid']?>" title="Hapus <?=$row['kategori']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>