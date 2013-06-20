<?php 
protect();
$dt = $_GET['q'];

if($dt == 'management') { $q1 = 8; $q2 = 9; } else if($dt == 'guru') { $q1 = 10; $q2 = 12; } else if($dt == 'pegawai') { $q1 = 13; $q2 = 14; }
?>
<!-- div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/guru" class="btn">Pengajar</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
</div -->
<div class="row-fluid">
	<div class="span10"><h2>Data <?=ucfirst($dt)?></h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'lpp/'.$dt?>/tambah"><i class="icon-plus"></i> Tambah</a>
</div>
</div>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NISN</th>
				<th>NAMA</th>
				<th>TGL LAHIR</th>
				<th>JABATAN</th>			
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT profil.nama as nama, profil.tgl as tgl, users.uid as uid, users.uname as uname FROM profil INNER JOIN users on users.uid=profil.uid WHERE users.level BETWEEN ? AND ?');
	$query->execute(array($q1, $q2));
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['tgl']?></td>
				<td></td>
				<td>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uname']?>/edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uid']?>/hapus" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>