<?php 
protect();

if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('/apps/unit/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('/apps/unit/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('/apps/unit/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('/apps/unit/tambah.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/unit" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/unit/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Data Unit/Sekolah</h3>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>UNIT/SEKOLAH</th>
				<th>ALAMAT</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query = $pdo->prepare("SELECT uid, unit, ket FROM unit");
			$query->execute();
			$no = 1;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<tr>
				<td><?=$no++?></a></td>
				<td><?=$data['unit']?></td>
				<td><?=$data['ket']?></td>
				<td>
					<a href="/unit/detail/<?=$data['uid']?>" class="lihat" title="Lihat <?=$data['unit'];?>"><i class="icon-list-alt"></i></a>
					<a href="/unit/edit/<?=$data['uid']?>" class="edit" title="Edit <?=$data['unit'];?>"><i class="icon-edit"></i></a>
					<a href="/unit/hapus/<?=$data['uid']?>" class="delete" title="Hapus <?=$data['unit'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>
<?php } ?>	