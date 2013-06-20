<?php 
protect(); 
if($_SESSION['level'] > 2) {
redirect('/denied');
exit();
} else { 
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/menu/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/menu/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/menu/tambah.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'detail') {
include('apps/menu/detail.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/menu" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/menu/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Daftar Menu</h2>
<table class="table-bordered table-hover display" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>MENU</th>
				<!-- th>POSISI</th -->
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT mid, menu, posisi FROM menu');
	$query->execute();
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['menu']?></td>
				<!-- td><?=($row['posisi'] == 1) ? 'Atas' : 'Bawah';?></td -->
				<td>
					<a href="<?=$base?>menu/detail/<?=$row['mid']?>" title="Lihat Detail <?=$row['menu']?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base?>menu/edit/<?=$row['mid']?>" title="Edit <?=$row['menu']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>menu/hapus/<?=$row['mid']?>" title="Hapus <?=$row['menu']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } } ?>						