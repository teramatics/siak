<?php 
if(isset($_POST['unit'], $_POST['ket'])) {

	$unit	= $_POST['unit'];
	$kode = str_replace(' ', '', strtolower($unit));
	$ket = $_POST['ket'];

		$query = $pdo->prepare('INSERT INTO unit (kode, unit, ket) VALUES (?, ?, ?)');
	  	$query->execute(array($kode, $unit, $ket));
	  	redirect('/unit');
}
?>
<div class="btn-group pull-right">
	<a href="/unit" class="btn btn-info"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/unit/tambah" class="btn btn-info active"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>
<h3>Tambah Unit</h3>

<form id="form" method="post" action="">
	<label>Nama Unit</label><input type="text" name="unit" placeholder="Isi huruf kecil semua" required />
	<label>Keterangan</label><input type="text" name="ket" placeholder="Unit, alamat unit" class="input input-xxlarge" required />
	<label></label>
	<input type="submit" value="Tambah" class="btn btn-primary" />			    	
</form>