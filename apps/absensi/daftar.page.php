<?php 
protect();
$unit = $_GET['q'];
$level = $_GET['r'];
$kelas = $_GET['s'];

?>
<div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Siswa</a>
	<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Pengajar</a>
	<a href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Absensi</a>
	<a href="<?=$base.'nilai/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Nilai</a>
	<a href="<?=$base.'keuangan/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Keuangan</a>
</div>
<div class="row-fluid">
	<div class="span10"><h2>Data Absensi <?php if($_GET['q'] == 'tk') { echo 'TK/PG'; } else if($_GET['q'] == 'sd01') { echo 'SD 01'; } else if($_GET['q'] == 'sd02') { echo 'SD 02'; } else if($_GET['q'] == 'smp') { echo 'SMP'; } else if($_GET['q'] == 'sma') { echo 'SMA'; } ?> Level <?php if($_GET['q'] == 'tk' && $_GET['r'] == '1') { echo 'TK A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '2') { echo 'TK B'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '3') { echo 'PG A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '4') { echo 'PG B'; } else { echo $level; } ?> Kelas <?=$kelas?></h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kelas?>/tambah"><i class="icon-plus"></i> Tambah</a>
</div>
</div>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NISN</th>
				<th>NAMA</th>
				<th>TGL</th>
				<th>ABSEN</th>
				<th>KETERANGAN</th>			
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT absensi.nisn as nisn, absensi.tgl as tgl, absensi.absensi as absensi, absensi.ket as ket, users.nama FROM absensi INNER JOIN users on users.uname=absensi.nisn INNER JOIN profil on profil.uid=users.uid WHERE unit=? AND level=? AND kelas=?');
	$query->execute(array($unit, $level, $kelas));
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
?>
			<tr>
				<td><?=$data['nisn']?></a></td>
				<td><?=$data['nama']?></td>
				<td><?=$data['tgl']?></td>
				<td><?=$data['absensi']?></td>
				<td><?=$data['ket']?></td>
				<td>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kelas.'/'.$data['uname']?>" title="Lihat <?=$data['nama'];?>"><i class="icon-list-alt"></i></a>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kelas.'/'.$data['uname']?>/edit" title="Edit <?=$data['nama'];?>"><i class="icon-edit"></i></a>
					<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kelas.'/'.$data['uid']?>/hapus" title="Hapus <?=$data['nama'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>