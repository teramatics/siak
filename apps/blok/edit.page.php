<?php 
	protect();
	if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
	}
if(isset($_POST['update'])) {

	$blok = $_POST['blok'];
	$isi  = $_POST['isi'];
	$letak = $_POST['letak'];
	$aktif = $_POST['aktif'];
	$bid = $_POST['bid'];

	$query = $pdo->prepare('UPDATE blok SET blok=?, isi=?, letak=?, aktif=? WHERE bid=?');
	$query->execute(array($blok, $isi, $letak, $aktif, $bid));
	redirect('/blok');
	exit();
}

$bid = $_GET['r'];
$query = $pdo->prepare('SELECT * FROM blok WHERE bid=?');
$query->execute(array($bid));
$blok = $query->fetch(PDO::FETCH_ASSOC);	
?>
<h2>Edit Blok</h2>
<form id="form" method="post" action="">
<label>Nama Blok</label><input type="text" name="blok" class="required" value="<?=$blok['blok']?>" />
<label>Isi</label><textarea id="textarea" name="isi" class="input-xxlarge required"><?=$blok['isi']?></textarea>
<label>Letak</label>
	<select name="letak" class="required" />
		<option <?=($blok['letak'] == 1) ? 'value="1" selected' : 'value="1"'; ?>>Bawah Kiri</option>
		<option <?=($blok['letak'] == 2) ? 'value="2" selected' : 'value="2"'; ?>>Bawah Tengah</option>
		<option <?=($blok['letak'] == 3) ? 'value="3" selected' : 'value="3"'; ?>>Bawah Kanan</option>
		<option <?=($blok['letak'] == 4) ? 'value="4" selected' : 'value="4"'; ?>>Middle Kiri</option>
		<option <?=($blok['letak'] == 5) ? 'value="5" selected' : 'value="5"'; ?>>Middle Kanan</option>
		<option <?=($blok['letak'] == 6) ? 'value="6" selected' : 'value="6"'; ?>>Flayout Box</option>
	</select>
<label></label>	
Status: <label class="radio inline">
<input type="radio" id="inlineRadio" name="aktif" <?=($blok['aktif'] == 0) ? 'value="'.$blok['aktif'].'" checked' : 'value="0"'; ?>> Tidak Aktif
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="aktif" <?=($blok['aktif'] == 1) ? 'value="'.$blok['aktif'].'" checked' : 'value="1"'; ?>> Aktif
</label>	
<label></label>
<input type="hidden" name="bid" value="<?=$blok['bid']?>" />
<input type="submit" name="update" value="Update" class="btn btn-primary" />
</form>