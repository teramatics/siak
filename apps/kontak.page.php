<?php
if(empty($_POST) === false) {
	if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {

	$nama 	= mysql_real_escape_string($_POST['nama']);
	$email 	= mysql_real_escape_string($_POST['email']);
	$pesan	= mysql_real_escape_string($_POST['pesan']);

		mail('yolelang@gmail.com', 'Contact From', $pesan, 'From: '. $email);
		redirect('/kontak/terkirim');
		exit();
	} else {
		$error = 'Captcha salah, silahkan dicoba kembali';
	}	
}
?>
<h3>Kontak Kami</h3>
<div class="row-fluid">
	<div class="span6">
	<?php if(isset($_GET['act']) == 'terkirim') { ?><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><p>Terima kasih telah menghubungi kami..</p></div><?php } ?>
	<?php if(!empty($error)) { ?><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><p>Kode Capctha salah, silahkan dicoba kembali.</p></div><?php } ?>
	<form id="form" action="" method="post">
		<label>Nama</label>
		<input type="text" name="nama" required <?php if(isset($_POST['nama']) === true) { echo 'value="'. strip_tags($_POST['nama']). '"'; } ?> />
		<label>Email</label>
		<input type="text" name="email" required <?php if(isset($_POST['email']) === true) { echo 'value="'. strip_tags($_POST['email']). '"'; } ?> />
		<label>Pesan</label>
		<textarea name="pesan" class="input-xxlarge" required><?php if(isset($_POST['pesan']) === true) { echo ''. strip_tags($_POST['pesan']). '"'; } ?> </textarea>
		<label>Masukan Kode</label>
		<img class="captcha" src="/apps/captcha.php" /><input name="captcha" type="text" class="input-small" required>
		<label></label>
		<input type="submit" value="Kirim" class="btn btn-primary" />
	</form>
</div>
<div class="span6">
	<?php 
		$query = $pdo->prepare("SELECT * FROM settings"); $query->execute(); 
		$stg = $query->fetch(PDO::FETCH_ASSOC);
	?>
	<h4>Lajnah Pendidikan dan Pengajaran</h4>
	<?=$stg['alamat']?><br />
	Telp. <?=$stg['telp']?><br />
	Email. <?=$stg['email']?>
</div>
</div>	