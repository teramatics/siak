<?php 
if(isset($_POST['mapel'], $_POST['ket'])) {

	$mapel	= $_POST['mapel'];
	$ket = $_POST['ket'];

		$query = $pdo->prepare('INSERT INTO mapel (mapel, ket) VALUES (?, ?)');
		$query->bindValue(1, $mapel);
	  	$query->bindValue(2, $ket);

	  	$query->execute();
	  	redirect('/mapel');
}
?>
<div class="btn-group pull-right">
	<a href="/mapel" class="btn btn-info"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/mapel/tambah" class="btn btn-info active"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Tambah Mata Pelajaran</h3>

<form id="form" method="post" action="">
	<label>Nama Mapel</label><input type="text" name="mapel" placeholder="Nama Mata Pelajaran" required />
	<label>Keterangan</label><input type="text" name="ket" placeholder="Keerangan Mata Pelajaran" class="input input-xxlarge" required />
	<label></label>
	<input type="submit" value="Tambah" class="btn btn-primary" />			    	
</form>