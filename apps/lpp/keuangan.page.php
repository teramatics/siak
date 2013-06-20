<?php 
protect();
$unit = $_GET['q'];
$level = $_GET['r'];
$kls = $_GET['s'];

?>
<div class="btn-group pull-right">
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/guru" class="btn">Pengajar</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
</div>
<h2>Data Keuangan</h2>