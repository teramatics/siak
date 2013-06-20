<?php 

$unit = $_GET['p'];
$level = $_GET['q'];
$kls = $_GET['r'];

?>
<div class="btn-group pull-right">
	<a href="<?=$base.$unit.'/'.$level.'/'.$kls?>/siswa" class="btn">Siswa</a>
	<a href="<?=$base.$unit.'/'.$level.'/'.$kls?>/guru" class="btn">Pengajar</a>
	<a href="<?=$base.$unit.'/'.$level.'/'.$kls?>/absensi" class="btn">Absensi</a>
	<a href="<?=$base.$unit.'/'.$level.'/'.$kls?>/nilai" class="btn">Nilai</a>
	<a href="<?=$base.$unit.'/'.$level.'/'.$kls?>/keuangan" class="btn">Keuangan</a>
</div>	
<h2>Data Guru Level <?=$level?> Kelas <?=$kls?></h2>