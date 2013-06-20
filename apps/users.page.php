<?php 
protect();
if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
}
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/users/edit.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'hapus') {
include('apps/users/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/users/tambah.page.php');
} else { 
?>
<div class="btn-group pull-right">
	<a href="/users" class="btn btn-info active"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/users/tambah" class="btn btn-info"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h2>Data Keanggotaan</h2>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>NO</th>
				<th>NAMA</th>
				<th>EMAIL</th>
				<th>LEVEL</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			
			$query = $pdo->prepare("SELECT users.uid as uid, users.uname as uname, users.email as email, users.nama as nama, level.level as level FROM users INNER JOIN level on level.lid = users.level WHERE users.level > ?");
			$query->execute(array(1));
			$no = 0;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) { 
		?>		
			<tr>
				<td><?=++$no?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['email']?></td>
				<td><?=$data['level']?></td>
				<td>
					<a href="/profil/<?=$data['uname']?>" class="lihat" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="/users/edit/<?=$data['uid']?>" class="edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="/users/hapus/<?=$data['uid']?>" class="delete" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>
<?php } ?>	