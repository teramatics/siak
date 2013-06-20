<?php 
protect();

if(isset($_POST['tambah'])) {

	$judul 	= $_POST['judul'];
	$kid 	= $_POST['kid'];
	$seo 	= seo($judul);
	$isi	= nl2br($_POST['isi']);
	$pub 	= $_POST['pub'];
	$post 	= $_SESSION['uid'];

	if(!empty($_POST['pilihan'])) {
		$plh = $_POST['pilihan'];
	} else {
		$plh = '0';
	}
	
	$file_name 	= $_FILES['pic']['name'];
	$file_tmp 	= $_FILES['pic']['tmp_name'];

	if(allowed_image($file_name) == true) {
		$width = '268';
		$file_name = md5(microtime(true)).'.png';
		watermark_image($file_tmp, $_SERVER['DOCUMENT_ROOT'].'/public/artikel/'.$file_name);
		thumbnail($_SERVER['DOCUMENT_ROOT'].'/public/artikel/', $_SERVER['DOCUMENT_ROOT'].'/public/artikel/thumb/', $file_name, $width);
	}	

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$data = array($kid,$judul,$seo,$isi,$file_name,$pub,$plh,$post);
	$query = $pdo->prepare('INSERT INTO artikel (kid,judul,seo,isi,foto,publish,pilihan,post_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
	$query->execute($data);

	redirect('/artikel');
}	
?>	
<h2>Tambah Artikel</h2>
<form id="form" method="post" enctype="multipart/form-data" action="">
<label>Judul</label><input type="text" class="input-block-level required" name="judul" />
<label>Kategori</label>
<select name="kid" class="required">
<option value="">-- Pilh Kategori --</option>	
	<?php 
	$query = $pdo->prepare('SELECT * FROM kategori'); $query->execute();
	while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	?>	
<option value="<?=$row['kid']?>"><?=$row['kategori']?></option>
if
<?php } ?>
</select>	<a href="#kategori" class="btn btn-mini btn-add" data-toggle="modal" title="Tambah Kategori"><i class="icon-plus"></i> Tambah Kategori</a>
<label>Isi</label><textarea id="textarea" class="input-block-level required" name="isi"></textarea>
<?php if($_SESSION['level'] < 3) { ?>
Artikel Pilihan: <label class="radio inline">
<input type="radio" id="inlineRadio" name="pilihan" value="0" checked> Bukan Pilihan
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="pilihan" value="1"> Pilihan
</label><p />
<?php } ?>
Opsi Publikasi: <label class="radio inline">
<input type="radio" id="inlineRadio" name="pub" value="0" checked> Tidak dipublikasikan
</label>
<label class="radio inline">
<input type="radio" id="inlineRadio" name="pub" value="1"> Dipublikasikan
</label>
<label>Upload Foto</label>
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
<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
</form>	

<div id="kategori" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Tambah Kategori</h3>
</div>
<div class="modal-body">
<?php 
if(isset($_POST['addkat'])) {
    
	$kat 	= $_POST['kat'];
	$seo 	= seo($kat);
	$ket 	= $_POST['ket'];

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$data = array($kat, $seo, $ket);
	$query = $pdo->prepare('INSERT INTO kategori (kategori, seo, ket) VALUES (?, ?, ?)');
	$query->execute($data);

    redirect('/artikel/tambah');
    exit();
}
?>
<form id="form" method="post" action="" >
<label>Nama Kategori</label><input type="text" name="kat" class="input" onclick="this.placeholder=''" placeholder="Nama Kategori">
<label>Keterangan</label><input type="text" name="ket" class="input-xlarge" onclick="this.placeholder=''" placeholder="Keterangan">
<label></label>
<input class="btn btn-primary" type="submit" name="addkat" value="Tambah" />
</form>
</div>
</div>