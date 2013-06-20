<?php 
protect();
$unit = $_GET['q'];
$level = $_GET['r'];
$kls = $_GET['s'];

?>
<div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls?>" class="btn">Pengajar</a>
	<a href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.'nilai/'.$unit.'/'.$level.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.'keuangan/'.$unit.'/'.$level.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
</div>
<div class="row-fluid">
	<div class="span10"><h2>Data Pengajar <?php if($_GET['q'] == 'tk') { echo 'TK/PG'; } else if($_GET['q'] == 'sd01') { echo 'SD 01'; } else if($_GET['q'] == 'sd02') { echo 'SD 02'; } else if($_GET['q'] == 'smp') { echo 'SMP'; } else if($_GET['q'] == 'sma') { echo 'SMA'; } ?> Level <?php if($_GET['q'] == 'tk' && $_GET['r'] == '1') { echo 'TK A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '2') { echo 'TK B'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '3') { echo 'PG A'; } else if($_GET['q'] == 'tk' && $_GET['r'] == '4') { echo 'PG B'; } else { echo $level; } ?> Kelas <?=$kls?></h2>
</div>
<div class="span2">
	<label></label>
<a class="btn btn-primary pull-right" href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kls?>/tambah"><i class="icon-plus"></i> Tambah</a>
</div>
</div>
<table class="table-bordered table-hover" id="data">
		<thead>
			<tr>
				<th>NIP</th>
				<th>NAMA</th>
				<th>MATA PELAJARAN</th>
			</tr>
		</thead>
		<tbody>
<?php
	$query = $pdo->prepare('SELECT profil.nama as nama, pengajar.mapel as mapel, users.uid as uid, users.uname as uname FROM profil INNER JOIN users on users.uid=profil.uid INNER JOIN pengajar on pengajar.uid=profil.uid');
	$query->execute();
	$no = 0;
	while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		$mapel = unserialize($data['mapel']);
?>
			<tr>
				<td><?=$data['uname']?></a></td>
				<td><?=$data['nama']?></td>
				<td><ul><?php foreach($mapel as $maplist){ print '<li>'.$maplist.'</li>'; } ?></ul></td>
			</tr>
		<?php } ?>		
	</table>