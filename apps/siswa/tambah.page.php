<?php 
protect();
$unit   = $_GET['q'];
$level  = $_GET['r'];
$kelas  = $_GET['s'];
$posted = $_SESSION['uid'];

if(isset($_POST['tambah'])) {
  $uname  = $_POST['uname'];
  $nama   = $_POST['nama'];
  $email  = $_POST['email'];
  $tpl    = $_POST['tpl'];
  $tgl    = $_POST['tgl'];
  $jk     = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $kota   = $_POST['kota'];
  $telp   = $_POST['telp'];

  $ayah       = $_POST['ayah'];
  $ayah_kerja = $_POST['ayah_pekerjaan'];
  $ibu        = $_POST['ibu'];
  $ibu_kerja  = $_POST['ibu_pekerjaan'];
  $wali       = $_POST['wali'];
  $wali_kerja = $_POST['wali_pekerjaan'];
  $alamat_ortu = $_POST['alamat_ortu'];
  $kota_ortu  = $_POST['kota_ortu'];
  $telp_ortu  = $_POST['telp_ortu'];

  $msk_kls  = $_POST['masuk_kelas'];
  $msk_tgl  = $_POST['tgl_masuk'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $alamat_sekolah = $_POST['alamat_sekolah'];
  $thn_ijazah = $_POST['tahun_ijazah'];
  $no_ijazah = $_POST['no_ijazah'];

  $foto = $_FILES['foto']['name'];
  $tmp_name = $_FILES['foto']['tmp_name'];
  if(isset($foto)) {
      $location = $_SERVER['DOCUMENT_ROOT'].'/public/avatar/'.$foto;
      move_uploaded_file($tmp_name, $location);
  }

  $password = substr($_POST['tgl'], 0, 4).substr($_POST['tgl'], 5, -3).substr($_POST['tgl'], -2, 2);
  $pass = md5($salt.md5($password).$salt);

  $qu = $pdo->prepare('SELECT MAX(uid) as uid FROM users');
  $qu->execute();
  $uid = $qu->fetch();
  $lastid = $uid['uid'];
  $nextid = $lastid+1;

  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $query = $pdo->prepare('INSERT INTO users (uname, email, password, nama, foto) VALUES (?, ?, ?, ?, ?)') or die("Gagal mengecek users di database");
  $data_users = array($uname, $email, $pass, $nama, $foto);
  $query->execute($data_users);

  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $query2 = $pdo->prepare('INSERT INTO profil (uid, nama, email, jk, tpl, tgl, alamat, kota, telp, ayah, ayah_pekerjaan, ibu, ibu_pekerjaan, wali, wali_pekerjaan, alamat_ortu, kota_ortu, telp_ortu, masuk_kls, masuk_tgl, asal_sekolah, alamat_sekolah, tahun_ijazah, no_ijazah, unit, level, kelas, posted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)') or die("Gagal mengecek profil di database");
  $data_profil = array($nextid, $nama, $email, $jk, $tpl, $tgl, $alamat, $kota, $telp, $ayah, $ayah_kerja, $ibu, $ibu_kerja, $wali, $wali_kerja, $alamat_ortu, $kota_ortu, $telp_ortu, $msk_kls, $msk_tgl, $asal_sekolah, $alamat_sekolah, $thn_ijazah, $no_ijazah, $unit, $level, $kelas, $posted);
  $query2->execute($data_profil);

  $direct = $base.'siswa/'.$unit.'/'.$level.'/'.$kelas;
  redirect($direct);
}

?>
<div class="btn-group pull-right">
  <a href="<?=$base.'siswa/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Siswa</a>
  <a href="<?=$base.'pengajar/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Pengajar</a>
  <a href="<?=$base.'absensi/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Absensi</a>
  <a href="<?=$base.'nilai/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Nilai</a>
  <a href="<?=$base.'keuangan/'.$unit.'/'.$level.'/'.$kelas?>" class="btn">Keuangan</a>
</div>
<h2>Tambah Siswa</h2>
<form id="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="">

<fieldset>
  <legend>Data Pribadi</legend>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">NISN</label>
  <div class="controls">
    <input id="uname" name="uname" class="input-xlarge" required="" type="text">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Lengkap</label>
  <div class="controls">
    <input id="nama" name="nama" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Email Valid</label>
  <div class="controls">
    <input id="email" name="email" class="input-xlarge" type="text">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tempat lahir</label>
  <div class="controls">
    <input id="tpl" name="tpl" class="input-xlarge" type="text">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tanggal Lahir</label>
  <div class="controls">
    <input name="tgl" id="tanggal" required="" type="text">
    <p class="help-block">Harus diisi untuk generate password</p>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="control-group">
  <label class="control-label">Jenis Kelamin</label>
  <div class="controls">
    <label class="radio inline">
      <input name="jenis_kelamin" value="Laki-laki" checked="checked" type="radio">
      Laki-laki
    </label>
    <label class="radio inline">
      <input name="jenis_kelamin" value="Perempuan" type="radio">
      Perempuan
    </label>
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Lengkap</label>
  <div class="controls">
    <input id="alamat" name="alamat" class="input-xxlarge" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Kota</label>
  <div class="controls">
    <input id="kota" name="kota" class="input" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Telp/HP</label>
  <div class="controls">
    <input id="telp" name="telp" class="input" type="text">  
  </div>
</div>
</fieldset>

<fieldset>
<legend>Data Orang Tua</legend>
<div class="collapsible">
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Ayah</label>
  <div class="controls">
    <input id="ayah" name="ayah" placeholder="" class="input-xlarge" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Ayah</label>
  <div class="controls">
    <input id="ayah_pekerjaan" name="ayah_pekerjaan" placeholder="" class="input-xlarge" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Ibu</label>
  <div class="controls">
    <input id="ibu" name="ibu" placeholder="" class="input-xlarge" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Ibu</label>
  <div class="controls">
    <input id="ibu_pekerjaan" name="ibu_pekerjaan" placeholder="" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Wali</label>
  <div class="controls">
    <input id="wali" name="wali" placeholder="" class="input-xlarge" type="text"> 
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Wali</label>
  <div class="controls">
    <input id="wali_pekerjaan" name="wali_pekerjaan" placeholder="" class="input-xlarge" type="text">
    
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Orang Tua/Wali</label>
  <div class="controls">
    <input id="alamat_ortu" name="alamat_ortu" placeholder="" class="input-xxlarge" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Kota</label>
  <div class="controls">
    <input id="kota_ortu" name="kota_ortu" placeholder="" class="input" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Telp/HP</label>
  <div class="controls">
    <input id="telp_ortu" name="telp_ortu" placeholder="" class="input" type="text">   
  </div>
</div>

</div>
</fieldset>

<fieldset>
<legend>Histori Sekolah</legend>
<div class="collapsible">
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Masuk Kelas</label>
  <div class="controls">
    <input id="masuk_kelas" name="masuk_kelas" placeholder="Masuk Al Irsyad Kelas" class="input" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tanggal Masuk</label>
  <div class="controls">
    <input id="tanggal1" name="tgl_masuk" placeholder="Tgl Masuk Al Irsyad" class="input" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Asal Sekolah</label>
  <div class="controls">
    <input id="asal_sekolah" name="asal_sekolah" placeholder="" class="input" type="text">    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Sekolah</label>
  <div class="controls">
    <input id="alamat_sekolah" name="alamat_sekolah" placeholder="" class="input-xxlarge" type="text">    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tahun Ijazah</label>
  <div class="controls">
    <input id="tahun_ijazah" name="tahun_ijazah" placeholder="" class="input" type="text">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">No Ijazah</label>
  <div class="controls">
    <input id="no_ijazah" name="no_ijazah" placeholder="" class="input" type="text">
  </div>
</div>
</div>
</fieldset>

<fieldset>
  <legend>Pas Foto</legend>
<div class="collapsible">  
<div class="control-group">
  <label class="control-label">Upload Foto</label>
  <div class="controls">
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih Foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="foto" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
  </div>
</div>

</div>
</fieldset>

<div class="control-group">
  <label class="control-label"></label>
  <div class="controls">
    <button id="tambah" name="tambah" class="btn btn-primary"><i class="icon-plus"></i> Kirim</button>
  </div>
</div>

</form>			