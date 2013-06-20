<?php 
if(isset($_POST['kelas'], $_POST['ket'])) {

	$kelas	= $_POST['kelas'];
	$ket = $_POST['ket'];

		$query = $pdo->prepare('INSERT INTO kelas (kelas, ket) VALUES (?, ?)');
		$query->bindValue(1, $kelas);
	  	$query->bindValue(2, $ket);

	  	$query->execute();
	  	redirect('/kelas');
}
?>
<div class="btn-group pull-right">
	<a href="/kelas" class="btn btn-info"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/kelas/tambah" class="btn btn-info active"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Tambah Kelas</h3>

<form id="form" method="post" action="">
	<label>Nama Kelas</label><input type="text" name="kelas" placeholder="Isi huruf kecil semua" required />
	<label>Keterangan</label><input type="text" name="ket" placeholder="Keerangan kelas" class="input input-xxlarge" required />
	<label></label>
	<input type="submit" value="Tambah" class="btn btn-primary" />			    	
</form>