<?php

if(!empty($_GET['q'])) {
	$act = $_GET['q']; 
	$query = $pdo->prepare("SELECT aktif FROM users WHERE aktivasi = ?");
	$query->bindValue(1, $act);
	$query->execute();
	$num = $query->rowCount();
		if($num == 1) {
			$query2 = $pdo->prepare('UPDATE users SET aktif = ?, aktivasi =? WHERE aktivasi = ?') or die('Gagal ngecek user akivasi');
			$query2->execute(array('1', '0', $act));
		} else {
			$error = 'Kode aktivasi salah, silahkan periksa kembali';
		}

} 
if(isset($_POST['aktivasi'])) {
	$kode = $_POST['kode'];
	$query = $pdo->prepare("SELECT aktif FROM users WHERE aktivasi = ?");
	$query->bindValue(1, $kode);
	$query->execute();
	$num = $query->rowCount();
		if($num == 1) {
			$query2 = $pdo->prepare('UPDATE users SET aktif = ?, aktivasi =? WHERE aktivasi = ?') or die('Gagal ngecek user akivasi');
			$query2->execute(array('1', '0', $kode));
		} else {
			$error = 'Kode aktivasi salah, silahkan periksa kembali';
		}
} 
if(empty($_GET['q']) && empty($_POST['kode'])) {
	$error = 'Kode aktivasi kosong! Kode aktivasi dapat ditemukan diemail konfirmasi pada saat pendaftaran, silahkan periksa kembali email Anda.';
}	
?>
<h3>Aktivasi Keanggotaan</h3>
<?php if(isset($error)) { ?><p /><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?=$error?></div>
<form class="form-horizontal" id="form" method="post" action="">
	    <div class="control-group">
	    <label class="control-label" for="inputKode">Kode Aktivasi</label>
	    <div class="controls">
	    <input type="text" class="required" name="kode" placeholder="Masukan kode aktivasi" onclick="this.placeholder='';">
	    </div>
	    </div>
	    <div class="control-group">
	    <div class="controls">
	    <button type="submit" name="aktivasi" class="btn btn-primary">Aktivasi</button>
	    </div>
	    </div>
</form>

<?php } else { ?>        
<p>Keanggotaan Anda telah aktif, silahkan login melalui <a href="/secure">member area</a>.<?php } ?>