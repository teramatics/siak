<?php 
	protect();
	if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
	}
if(isset($_POST['tambah'])) {

	$blok = $_POST['blok'];
	$isi  = $_POST['isi'];
	$letak = $_POST['letak'];
	$aktif = $_POST['aktif'];

	$query = $pdo->prepare('INSERT INTO blok (blok, isi, letak, aktif) VALUES (?, ?, ?, ?)');
	$query->execute(array($blok, $isi, $letak, $aktif));
	redirect('/blok');
	exit();
}	
?>
<h2>Tambah Blok</h2>
<form id="form" method="post" action="">
<label>Nama Blok</label><input type="text" name="blok" class="required" />
<label>Isi</label><textarea id="textarea" name="isi" class="input-xxlarge required"></textarea>
<label>Letak</label>
	<select name="letak" class="required" />
		<option value="1">Bawah Kiri</option>
		<option value="2">Bawah Tengah</option>
		<option value="3">Bawah Kanan</option>
		<option value="4">Middle Kiri</option>
		<option value="5">Middle Kanan</option>
		<option value="6">Flayout Box</option>
	</select>
<label></label>		
Status: <label class="radio inline">
<input type="radio" id="inlineRadio" name="aktif" value="0" checked> Tidak Aktif
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="aktif" value="1"> Aktif
</label>	
<label></label>
<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
</form>