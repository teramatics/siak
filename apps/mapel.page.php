<?php 
protect();

if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('/apps/mapel/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('/apps/mapel/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('/apps/mapel/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('/apps/mapel/tambah.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/mapel" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/mapel/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Data Mata Pelajaran</h3>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>MATA PELAJARAN</th>
				<th>KETERANGAN</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query = $pdo->prepare("SELECT mid, mapel, ket FROM mapel");
			$query->execute();
			$no = 1;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<tr>
				<td><?=$no++?></a></td>
				<td><?=$data['mapel']?></td>
				<td><?=$data['ket']?></td>
				<td>
					<a href="/mapel/detail/<?=$data['mid']?>" class="lihat" title="Lihat <?=$data['mapel'];?>"><i class="icon-list-alt"></i></a>
					<a href="/mapel/edit/<?=$data['mid']?>" class="edit" title="Edit <?=$data['mapel'];?>"><i class="icon-edit"></i></a>
					<a href="/mapel/hapus/<?=$data['mid']?>" class="delete" title="Hapus <?=$data['mapel'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>
<?php } ?>	