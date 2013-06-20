<?php 
protect();
$dt = $_GET['q'];
?>
<!-- div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$akses.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$akses.'/'.$kls?>/guru" class="btn">Pengajar</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$akses.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$akses.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$akses.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
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
	$query = $pdo->prepare('SELECT profil.nama as nama, profil.tgl as tgl, users.uid as uid, users.uname as uname, akses.aid as aid, akses.akses as akses FROM profil INNER JOIN users on users.uid=profil.uid INNER JOIN akses on akses.aid=users.akses WHERE users.akses > 1');
	$query->execute();
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['tgl']?></td>
				<td><?=$data['akses']?></td>
				<td>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uname']?>/edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'lpp/'.$dt.'/'.$data['uid']?>/hapus" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>