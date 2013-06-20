<?php 
protect();
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/artikelku/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/artikelku/hapus.page.php');
} else { ?>
<h2>Daftar Artikelku</h2>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>KATEGORI</th>
				<th>JUDUL</th>
				<th>STATUS</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$post = $_SESSION['uid'];
	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.publish as publish, kategori.kategori as kat, kategori.seo as katseo FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid WHERE post_id=? ORDER BY artikel.aid DESC');
	$query->execute(array($post));
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['kat']?></td>
				<td><a href="<?=$base?>konten/<?=$row['katseo'].'/'.$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><?=$row['judul']?></a></td>
				<td><?=($row['publish'] == 1) ? 'Publish' : 'No Publish' ?> </td>
				<td>
					<a href="<?=$base?>konten/<?=$row['katseo'].'/'.$row['seo']?>" title="Lihat Detail <?=$row['judul']?>"><i class="icon-list-alt"></i></a> 
					<a href="<?=$base?>artikelku/edit/<?=$row['seo']?>" title="Edit <?=$row['judul']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>artikelku/hapus/<?=$row['seo']?>" title="Hapus <?=$row['judul']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>