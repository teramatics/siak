<?php 
protect();
if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
}		
if(isset($_POST['update'])) {

	$url 		= $_POST['url'];
	$nama 		= $_POST['nama'];
	$slogan 	= $_POST['slogan'];
	$email 		= $_POST['email'];
	$alamat 	= $_POST['alamat'];
	$telp 		= $_POST['telp'];
	$intro 		= $_POST['intro'];
	$facebook 	= $_POST['facebook'];
	$twitter 	= $_POST['twitter'];
	$google 	= $_POST['google'];
	$rss 		= $_POST['rss'];
	$sid 		= $_POST['sid'];

	if(!empty($_FILES['logo']['name'])) { 
		$logo = $_FILES['logo']['name'];
		$tmp_name = $_FILES['logo']['tmp_name'];
		if(isset($logo)) {
			$location = $_SERVER['DOCUMENT_ROOT']."/public/images/$logo";
			move_uploaded_file($tmp_name, $location);
		}
	} else {
		$logo = $_POST['dlogo'];
	}	 

	if(!empty($_FILES['logo']['name'])) { 
		$icon = $_FILES['icon']['name'];
		$tmp_name = $_FILES['icon']['tmp_name'];
		if(isset($icon)) {
			$location = $_SERVER['DOCUMENT_ROOT']."/public/images/$icon";
			move_uploaded_file($tmp_name, $location);
		}
	} else {
		$icon = $_POST['dicon'];
	}	 
			
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query2 = $pdo->prepare('UPDATE settings SET url=?, logo=?, icon=?, nama=?, slogan=?, email=?, alamat=?, telp=?, intro=?, facebook=?, twitter=?, google=?, rss=? WHERE sid=?') or die("Gagal mengecek profil di database");
	$data = array($url, $logo, $icon, $nama, $slogan, $email, $alamat, $telp, $intro, $facebook, $twitter, $google, $rss, $sid);
	$query2->execute($data);	

	redirect('/setting');					

}
	$query = $pdo->prepare("SELECT * FROM settings"); $query->execute(); 
	$stg = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2>Pengaturan Web</h2>
<form id="form" method="post" enctype="multipart/form-data" action="" >
	<label>Default URL</label><input type="text" name="url" class="input-xlarge required" value="<?=$stg['url']?>" />
	<label>Logo</label>
	<img class="thumbnail" src="<?=$base?>public/images/<?=$stg['logo']?>" /><br />
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="logo" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
	<label>Iconset</label>
	<img class="thumbnail" src="<?=$base?>public/images/<?=$stg['icon']?>" /><br />
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="icon" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
	<label>Nama Web</label><input type="text" name="nama" class="input-xlarge required" value="<?=$stg['nama']?>" />
	<label>Slogan</label><input type="text" name="slogan" class="input-xlarge required" value="<?=$stg['slogan']?>" />
	<label>Email</label><input type="text" name="email" class="input-xlarge required" value="<?=$stg['email']?>" />
	<label>Alamat Lengkap</label><input type="text" name="alamat" class="input-xxlarge required" value="<?=$stg['alamat']?>" />
	<label>Telp.</label><input type="text" name="telp" class="input-xlarge required" value="<?=$stg['telp']?>" />
	<label>Intro</label><textarea id="textarea" class="required" name="intro"><?=$stg['intro']?></textarea>
	<label>Facebook</label><input type="text" name="facebook" class="input-xxlarge required" value="<?=$stg['facebook']?>" />
	<label>Twitter</label><input type="text" name="twitter" class="input-xxlarge required" value="<?=$stg['twitter']?>" />
	<label>Google</label><input type="text" name="google" class="input-xxlarge required" value="<?=$stg['google']?>" />
	<label>RSS</label><input type="text" name="rss" class="input-xxlarge required" value="<?=$stg['rss']?>" />
	<label><label>
		<input type="hidden" name="dlogo" value="<?=$stg['logo']?>" />
		<input type="hidden" name="dicon" value="<?=$stg['icon']?>" />
		<input type="hidden" name="sid" value="<?=$stg['sid']?>" />
		<input type="submit" class="btn btn-primary" name="update" value='Update' />
</form>