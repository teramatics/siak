<?php 

if(isset($_POST['update'])) {

	$aid	= $_POST['aid'];
	$judul 	= $_POST['judul'];
	$kat 	= $_POST['kategori'];
	$seo 	= seo($judul);
	$isi	= $_POST['isi'];
	$pub 	= $_POST['pub'];

	if(!empty($_POST['pilihan'])) {
		$plh = $_POST['pilihan'];
	} else {
		$plh = '0';
	}
	
	if(!empty($_FILES['pic']['name'])) { 

		$file_name = $_FILES['pic']['name'];
		$file_tmp 	= $_FILES['pic']['tmp_name'];
		if(allowed_image($file_name) == true) {
			$width = '268';
			$file_name = md5(microtime(true)).'.png';
			watermark_image($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/public/artikel/'.$file_name);
			thumbnail($_SERVER['DOCUMENT_ROOT'].'/public/artikel/', $_SERVER['DOCUMENT_ROOT'].'/public/artikel/thumb/', $file_name, $width);
		}
	} else { 
		$file_name = $_POST['foto']; 
	}

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query = $pdo->prepare('UPDATE artikel SET kid=?, judul=?, seo=?, isi=?, foto=?, publish=?, pilihan=? WHERE aid=?');
	$query->execute(array($kat, $judul, $seo, $isi, $file_name, $pub, $plh, $aid));

	redirect('/artikel');
}	

	$pid = $_GET['r']; 
	$query = $pdo->prepare('SELECT aid, kid, judul, seo, isi, foto, publish, pilihan FROM artikel WHERE seo = ?');
	$query->execute(array($pid));
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>	
<h2>Edit <?=$data['judul']?></h2>
<form id="form" method="post" enctype="multipart/form-data" action="">
<label>Judul</label><input type="text" class="input-block-level required" name="judul" value="<?=$data['judul']?>" />
<label>Kategori</label>
<select name="kategori" class="required">
<option value="">-- Pilh Kategori --</option>	
    <?php 
        $query = $pdo->prepare("SELECT kid, kategori FROM kategori"); $query->execute(); 
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
        	$kid 	= $row['kid'];
        	$kat 	= $row['kategori'];
    ?>	
      <option <?php if($data['kid'] == $kid) { echo 'value="'.$kid.'" selected'; } else { echo 'value="'.$kid.'"'; } ?> ><?='<strong>'.$kat.'</strong>';?></option>
    <?php } ?>	
</select>	
<label>Isi</label><textarea id="textarea" class="input-block-level required" name="isi"><?=$data['isi']?></textarea>
<?php if($_SESSION['level'] < 3) { ?>
Artikel Pilihan: <label class="radio inline">
<input type="radio" id="inlineRadio" name="pilihan" value="0" <?php if($data['pilihan'] == '0') { echo 'checked'; } ?>> Bukan Pilihan
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="pilihan" value="1" <?php if($data['pilihan'] == '1') { echo 'checked'; } ?>> Pilihan
</label><p />
<?php } ?>
Opsi Publikasi: <label class="radio inline">
<input type="radio" id="inlineRadio" name="pub" value="0" <?php if($data['publish'] == '0') { echo 'checked'; } ?>> Tidak dipublikasikan
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="pub" value="1" <?php if($data['publish'] == '1') { echo 'checked'; } ?>> Dipublikasikan
</label>
<label></label>
<img src="/public/artikel/thumb/<?=(!empty($data['foto'])) ? $data['foto'] : 'cybermafaza.png'; ?>" alt="Foto Artikel" /><br />
<label>Ganti Foto</label>
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="pic" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
<p />
<input type="hidden" name="foto" value="<?=$data['foto']?>" />
<input type="hidden" name="aid" value="<?=$data['aid']?>" />
<input type="submit" name="update" value="Update" class="btn btn-primary" />
</form>	