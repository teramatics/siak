<?php 
protect(); 
if($_SESSION['level'] > 2) {
redirect('/denied');
exit();
} else { 
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/blok/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/blok/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/blok/tambah.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'detail') {
include('apps/blok/detail.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/blok" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/blok/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Daftar Blok</h2>
<table class="table-bordered table-hover display" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>BLOK</th>
				<th>LETAK</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT bid, blok, letak FROM blok');
	$query->execute();
	$no = 0;
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=++$no?></td>
				<td><?=$row['blok']?></td>
				<td><?php if($row['letak'] == 1) { echo 'Bawah Kiri'; } else if($row['letak'] == 2) { echo 'Bawah Tengah'; } else if($row['letak'] == 3) { echo 'Bawah Kanan';} else if($row['letak'] == 4) { echo 'Middle Kiri'; } else if($row['letak'] == 5) { echo 'Middle Kanan'; } else if($row['letak'] == 6) { echo 'Flayout Box'; } ?></td>
				<td>
					<a href="<?=$base?>blok/detail/<?=$row['bid']?>" title="Lihat Detail <?=$row['blok']?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base?>blok/edit/<?=$row['bid']?>" title="Edit <?=$row['blok']?>"><i class="icon-edit"></i></a>  
					<a href="<?=$base?>blok/hapus/<?=$row['bid']?>" title="Hapus <?=$row['blok']?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
<?php } ?>
	</tbody>
</table>
<?php } } ?>						