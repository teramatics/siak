<?php 
protect();

if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/kelas/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('apps/kelas/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/kelas/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/kelas/tambah.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/kelas" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/kelas/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Data Kelas</h3>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>KELAS</th>
				<th>KETERANGAN</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query = $pdo->prepare("SELECT kid, kelas, ket FROM kelas");
			$query->execute();
			$no = 1;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<tr>
				<td><?=$no++?></a></td>
				<td><?=$data['kelas']?></td>
				<td><?=$data['ket']?></td>
				<td>
					<a href="/kelas/detail/<?=$data['kid']?>" class="lihat" title="Lihat <?=$data['kelas'];?>"><i class="icon-list-alt"></i></a>
					<a href="/kelas/edit/<?=$data['kid']?>" class="edit" title="Edit <?=$data['kelas'];?>"><i class="icon-edit"></i></a>
					<a href="/kelas/hapus/<?=$data['kid']?>" class="delete" title="Hapus <?=$data['kelas'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>
<?php } ?>	