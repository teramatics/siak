<?php 
protect();
$dt = $_GET['q'];
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

  $msk_kls  = $_POST['masuk_kelas'];
  $msk_tgl  = $_POST['tgl_masuk'];
  $asal_sekolah = $_POST['asal_sekolah'];
  $alamat_sekolah = $_POST['alamat_sekolah'];
  $thn_ijazah = $_POST['tahun_ijazah'];
  $no_ijazah = $_POST['no_ijazah'];
  $akses = $_POST['akses'];

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
  $query = $pdo->prepare('INSERT INTO users (uname, email, password, nama, foto, akses) VALUES (?, ?, ?, ?, ?, ?)') or die("Gagal mengecek users di database");
  $data_users = array($uname, $email, $pass, $nama, $foto, $akses);
  $query->execute($data_users);

  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $query2 = $pdo->prepare('INSERT INTO profil (uid, nama, email, jk, tpl, tgl, alamat, kota, telp, ayah, ayah_pekerjaan, ibu, ibu_pekerjaan, wali, wali_pekerjaan, alamat_ortu, kota_ortu, telp_ortu, masuk_kls, masuk_tgl, asal_sekolah, alamat_sekolah, tahun_ijazah, no_ijazah, unit, level, kelas, posted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)') or die("Gagal mengecek profil di database");
  $data_profil = array($nextid, $nama, $email, $jk, $tpl, $tgl, $alamat, $kota, $telp, $ayah, $ayah_kerja, $ibu, $ibu_kerja, $wali, $wali_kerja, $alamat_ortu, $kota_ortu, $telp_ortu, $msk_kls, $msk_tgl, $asal_sekolah, $alamat_sekolah, $thn_ijazah, $no_ijazah, $unit, $level, $kelas, $posted);
  $query2->execute($data_profil);

  $direct = $base.'siswa/'.$unit.'/'.$level.'/'.$kelas;
  redirect($direct);
}

?>
<h2>Tambah Personal</h2>
<form id="form" class="form-horizontal" enctype="multipart/form-data" method="post" action="">

<fieldset>
  <legend>Data Pribadi</legend>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">NIP</label>
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
<legend>Histori Pekerjaan</legend>
<div class="collapsible">
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Masuk Unit</label>
  <div class="controls">
    <input id="masuk_kelas" name="masuk_kelas" placeholder="Unit Pertama masuk Al Irsyad" class="input" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tanggal Mulai</label>
  <div class="controls">
    <input id="tanggal1" name="tgl_masuk" placeholder="Tgl Mulai Kerja di Al Irsyad" class="input" type="text">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pendidikan Terakhir</label>
  <div class="controls">
    <input id="asal_sekolah" name="asal_sekolah" placeholder="" class="input" type="text">    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Perguruan Tinggi</label>
  <div class="controls">
    <input id="alamat_sekolah" name="alamat_sekolah" placeholder="" class="input-xxxlarge" type="text">    
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

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Jabatan Saat Ini</label>
  <div class="controls">
          <select id="akses" name="akses">
            <option value="">-- Pilih Jabatan --</option>  
          <?php 
            $query = $pdo->prepare("SELECT * FROM akses WHERE aid > 1"); $query->execute(); 
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
          ?>
            <option value="<?=$row['aid']?>"><?=$row['akses']?></option>
          <?php } ?>    
          </select>
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