<?php 
protect();
$unit = $_GET['q'];
$data = $_GET['r'];


?>
<!-- div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Pengajar</a>
	<a href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.'nilai/'.$unit.'/'.$level.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.'keuangan/'.$unit.'/'.$level.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
</div -->
<div class="row-fluid">
	<div class="span10"><h2>Data Pengajar <?php if($_GET['q'] == 'tk') { echo 'TK/PG'; } else if($_GET['q'] == 'sd01') { echo 'SD 01'; } else if($_GET['q'] == 'sd02') { echo 'SD 02'; } else if($_GET['q'] == 'smp') { echo 'SMP'; } else if($_GET['q'] == 'sma') { echo 'SMA'; } ?></h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'pengajar/'.$unit?>/tambah"><i class="icon-plus"></i> Tambah</a>
</div>
</div>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NISN</th>
				<th>NAMA</th>
				<th>TGL LAHIR</th>			
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT profil.nama as nama, profil.tgl as tgl, users.uid as uid, users.uname as uname FROM profil INNER JOIN users on users.uid=profil.uid WHERE profil.unit=?');
	$query->execute(array($unit));
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['tgl']?></td>
				<td>
					<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uname']?>/edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uid']?>/hapus" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>