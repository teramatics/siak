<?php 
protect();

if(isset($_POST['tambah'])) {

	$judul 	= $_POST['judul'];
	$kid 	= $_POST['kid'];
	$seo 	= seo($judul);
	$isi	= nl2br($_POST['isi']);
	$pub 	= 0;
	$post 	= $_SESSION['uid'];

	$file_name 	= $_FILES['pic']['name'];
	$file_tmp 	= $_FILES['pic']['tmp_name'];

	if(allowed_image($file_name) == true) {
		$width = '268';
		$file_name = md5(microtime(true)).'.png';
		watermark_image($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/public/artikel/'.$file_name);
		thumbnail($_SERVER['DOCUMENT_ROOT'].'/public/artikel/', $_SERVER['DOCUMENT_ROOT'].'/public/artikel/thumb/', $file_name, $width);
	}	

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$data = array($kid,$judul,$seo,$isi,$file_name,$pub,$post);
	$query = $pdo->prepare('INSERT INTO artikel (kid,judul,seo,isi,foto,publish,post_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
	$query->execute($data);

	redirect('/artikelku');
}	
?>	
<h2>Kirim Artikel</h2>
<div class="alert alert-info">Silahkan kirimkan artikel Anda melalui formulir ini. Admin akan mereview dan berhak melakukan editing sesuai dengan kebutuhan untuk dapat dipublikasikan.</div> 
<form id="form" method="post" enctype="multipart/form-data" action="">
<label>Judul</label><input type="text" class="input-block-level required" name="judul" />
<label>Kategori</label>
<select name="kid" class="required">
<option value="">-- Pilh Kategori --</option>	
	<?php 
	$query = $pdo->prepare('SELECT * FROM kategori WHERE kid != 1 AND kid != 7 AND kid != 6'); $query->execute();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	?>	
<option value="<?=$row['kid']?>"><?=$row['kategori']?></option>
if
<?php } ?>
</select>
<label>Isi</label><textarea id="textarea" class="input-block-level required" name="isi"></textarea>
<label>Upload Foto</label>
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih Foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="pic" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
<p />
<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
</form>	