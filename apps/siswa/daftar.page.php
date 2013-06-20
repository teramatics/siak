<?php 
protect();
$unit = $_GET['q'];
$level = $_GET['r'];
$kls = $_GET['s'];

?>
<div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Siswa</a>
	<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Pengajar</a>
	<a href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Absensi</a>
	<a href="<?=$base.'nilai/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Nilai</a>
	<a href="<?=$base.'keuangan/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Keuangan</a>
</div>
<div class="row-fluid">
	<div class="span10"><h2>Data Siswa <?php if($_GET['q'] == 'tk') { echo 'TK/PG'; } else if($_GET['q'] == 'sd01') { echo 'SD 01'; } else if($_GET['q'] == 'sd02') { echo 'SD 02'; } else if($_GET['q'] == 'smp') { echo 'SMP'; } else if($_GET['q'] == 'sma') { echo 'SMA'; } ?> Level <?php if($_GET['q'] == 'tk' && $_GET['r'] == '1') { echo 'TK A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '2') { echo 'TK B'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '3') { echo 'PG A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '4') { echo 'PG B'; } else { echo $level; } ?> Kelas <?=$kls?></h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/tambah"><i class="icon-plus"></i> Tambah</a>
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
	$query = $pdo->prepare('SELECT profil.nama as nama, profil.tgl as tgl, users.uid as uid, users.uname as uname FROM profil INNER JOIN users on users.uid=profil.uid WHERE profil.unit=? AND profil.level=? AND profil.kelas=?');
	$query->execute(array($unit, $level, $kls));
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['tgl']?></td>
				<td>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uname']?>/edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls.'/'.$data['uid']?>/hapus" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>