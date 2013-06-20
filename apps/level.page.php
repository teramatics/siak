<?php 
protect();

if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/level/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('apps/level/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/level/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/level/tambah.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/level" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/level/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Data Level</h3>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>LEVEL</th>
				<th>KETERANGAN</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query = $pdo->prepare("SELECT lid, level, ket FROM level");
			$query->execute();
			$no = 1;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<tr>
				<td><?=$no++?></a></td>
				<td><?=$data['level']?></td>
				<td><?=$data['ket']?></td>
				<td>
					<a href="/level/detail/<?=$data['lid']?>" class="lihat" title="Lihat <?=$data['level'];?>"><i class="icon-list-alt"></i></a>
					<a href="/level/edit/<?=$data['lid']?>" class="edit" title="Edit <?=$data['level'];?>"><i class="icon-edit"></i></a>
					<a href="/level/hapus/<?=$data['lid']?>" class="delete" title="Hapus <?=$data['level'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>
<?php } ?>	