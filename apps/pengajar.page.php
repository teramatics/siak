<?php 
protect();

if(!empty($_GET['q']) && $_GET['q'] == 'edit') {
include('apps/pengajar/update.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'hapus') {
include('apps/pengajar/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/pengajar/add.page.php');
} else if(!empty($_GET['r']) && $_GET['r'] == 'daftar') {
include('apps/pengajar/data.page.php');
} else if(!empty($_GET['r']) && $_GET['r'] == 'tambah') {
include('apps/pengajar/tambah.page.php');
} else if(!empty($_GET['s'])) {
include('apps/pengajar/daftar.page.php');
} else {
?>
<div class="row-fluid">
	<div class="span10"><h2>Data Pengajar Al Irsyad</h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'pengajar/tambah'?>"><i class="icon-plus"></i> Tambah</a>
</div>
</div>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NIP</th>
				<th>NAMA</th>
				<th>SEKOLAH</th>
				<th>LEVEL</th>
				<th>KELAS</th>
				<th>MATA PELAJARAN</th>		
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT profil.nama as nama, users.uname as uname, pengajar.mapel as mapel, pengajar.unit as unit, pengajar.level as level, pengajar.kelas as kelas FROM profil INNER JOIN users on users.uid=profil.uid INNER JOIN pengajar on pengajar.uid=profil.uid');
	$query->execute();
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$unit = unserialize($data['unit']);
		$level = unserialize($data['level']);
		$kelas = unserialize($data['kelas']);
		$mapel = unserialize($data['mapel']);
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?php foreach($unit as $maplist){ print $maplist; } ?></td>
				<td><?php foreach($level as $levlist){ print $levlist; } ?></td>
				<td><ul><?php foreach($kelas as $klslist){ print '<li>'.$klslist.'</li>'; } ?></ul></td>
				<td><ul><?php foreach($mapel as $maplist){ print '<li>'.$maplist.'</li>'; } ?></ul></td>
				<td>
					<a href="<?=$base.'pengajar/detail/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'pengajar/edit/'.$data['uname']?>" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'pengajar/hapus/'.$data['uid']?>" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>

<?php } ?>