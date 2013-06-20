<?php 
protect();

$uname = $_GET['t'];
$unit   = $_GET['q'];
$level  = $_GET['r'];
$kelas  = $_GET['s'];
$posted = $_SESSION['uid'];

if(isset($_POST['update'])) {

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

    $msk_kls        = $_POST['masuk_kelas'];
    $msk_tgl        = $_POST['tgl_masuk'];
    $asal_sekolah   = $_POST['asal_sekolah'];
    $alamat_sekolah = $_POST['alamat_sekolah'];
    $thn_ijazah     = $_POST['tahun_ijazah'];
    $no_ijazah      = $_POST['no_ijazah'];
    $uid            = $_POST['uid'];

    if(!empty($_FILES['foto']['name'])) { 

        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        if(isset($foto)) {
            $location = $_SERVER['DOCUMENT_ROOT'].'/public/avatar/'.$foto;
            move_uploaded_file($tmp_name, $location);
        }
    } else { 
        $foto = $_POST['foto']; 
    }

    $updated = date('Y-m-d H:i:s');

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query2 = $pdo->prepare('UPDATE profil SET nama=?, email=?, jk=?, tpl=?, tgl=?, alamat=?, kota=?, telp=?, ayah=?, ayah_pekerjaan=?, ibu=?, ibu_pekerjaan=?, wali=?, wali_pekerjaan=?, alamat_ortu=?, kota_ortu=?, telp_ortu=?, masuk_kls=?, masuk_tgl=?, asal_sekolah=?, alamat_sekolah=?, tahun_ijazah=?, no_ijazah=?, posted=?, updated=? WHERE uid=?') or die('Gagal mengecek profil di database');
    $data_profil = array($nama, $email, $jk, $tpl, $tgl, $alamat, $kota, $telp, $ayah, $ayah_kerja, $ibu, $ibu_kerja, $wali, $wali_kerja, $alamat_ortu, $kota_ortu, $telp_ortu, $msk_kls, $msk_tgl, $asal_sekolah, $alamat_sekolah, $thn_ijazah, $no_ijazah, $posted, $updated, $uid);
    $query2->execute($data_profil); 

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query3 = $pdo->prepare('UPDATE users SET email=?, nama=?, foto=? WHERE uid=?') or die('Gagal mengecek users di database');
    $data_user = array($email, $nama, $foto, $uid);
    $query3->execute($data_user); 

	$direct = $base.'siswa/'.$unit.'/'.$level.'/'.$kelas;
    redirect($direct);					

}
	$query = $pdo->prepare('SELECT profil.nama as nama, profil.jk as jk, profil.tpl as tpl, profil.tgl as tgl, profil.alamat as alamat, profil.kota as kota, profil.telp as telp, profil.ayah as ayah, profil.ayah_pekerjaan as akerja, profil.ibu as ibu, profil.ibu_pekerjaan as ikerja, profil.wali as wali, profil.wali_pekerjaan as wkerja, profil.alamat_ortu as almt_ortu, profil.kota_ortu as kota_ortu, profil.telp_ortu as telp_ortu, profil.masuk_kls as msk_kls, profil.masuk_tgl as msk_tgl, profil.asal_sekolah as asl_sklh, profil.alamat_sekolah as almt_sklh, profil.tahun_ijazah as thn_ijazah, profil.no_ijazah as no_ijazah, profil.unit as unit, profil.level as level, profil.kelas as kelas, users.uid as uid, users.uname as uname, users.email as email, users.foto as foto FROM profil INNER JOIN users on users.uid=profil.uid WHERE users.uname=?');
    $query->execute(array($uname)); 
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<h3>Edit <?=$data['nama']?></h3>
<form id="form" method="post" enctype="multipart/form-data" action="" >
<fieldset>
  <legend>Data Pribadi</legend>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">NISN</label>
  <div class="controls">
    <input id="uname" name="uname" class="input-xlarge" required="" type="text" disabled value="<?=$data['uname']?>">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Lengkap</label>
  <div class="controls">
    <input id="nama" name="nama" class="input-xlarge" required="" type="text" value="<?=$data['nama']?>">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Email Valid</label>
  <div class="controls">
    <input id="email" name="email" class="input-xlarge" type="text"  value="<?=$data['email']?>">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tempat lahir</label>
  <div class="controls">
    <input id="tpl" name="tpl" class="input-xlarge" type="text"  value="<?=$data['tpl']?>">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tanggal Lahir</label>
  <div class="controls">
    <input name="tgl" id="tanggal" required="" type="text" value="<?=$data['tgl']?>">
    <p class="help-block">Harus diisi untuk generate password</p>
  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="control-group">
  <label class="control-label">Jenis Kelamin</label>
  <div class="controls">
    <label class="radio inline">
      <input name="jenis_kelamin" value="Laki-laki" <?php if($data['jk'] == 'Laki-laki') { echo 'checked'; }?> type="radio">
      Laki-laki
    </label>
    <label class="radio inline">
      <input name="jenis_kelamin" value="Perempuan" <?php if($data['jk'] == 'Perempuan') { echo 'checked'; }?> type="radio">
      Perempuan
    </label>
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Lengkap</label>
  <div class="controls">
    <input id="alamat" name="alamat" class="input-xxlarge" type="text" value="<?=$data['alamat']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Kota</label>
  <div class="controls">
    <input id="kota" name="kota" class="input" type="text" value="<?=$data['kota']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Telp/HP</label>
  <div class="controls">
    <input id="telp" name="telp" class="input" type="text" value="<?=$data['telp']?>">  
  </div>
</div>
</fieldset>

<fieldset>
<legend>Data Orang Tua</legend>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Ayah</label>
  <div class="controls">
    <input id="ayah" name="ayah" placeholder="" class="input-xlarge" type="text" value="<?=$data['ayah']?>">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Ayah</label>
  <div class="controls">
    <input id="ayah_pekerjaan" name="ayah_pekerjaan" placeholder="" class="input-xlarge" type="text" value="<?=$data['akerja']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Ibu</label>
  <div class="controls">
    <input id="ibu" name="ibu" placeholder="" class="input-xlarge" type="text" value="<?=$data['ibu']?>">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Ibu</label>
  <div class="controls">
    <input id="ibu_pekerjaan" name="ibu_pekerjaan" placeholder="" class="input-xlarge" type="text" value="<?=$data['ikerja']?>">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Nama Wali</label>
  <div class="controls">
    <input id="wali" name="wali" placeholder="" class="input-xlarge" type="text" value="<?=$data['wali']?>"> 
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Pekerjaan Wali</label>
  <div class="controls">
    <input id="wali_pekerjaan" name="wali_pekerjaan" placeholder="" class="input-xlarge" type="text" value="<?=$data['wkerja']?>">
    
  </div>
</div>
<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Orang Tua/Wali</label>
  <div class="controls">
    <input id="alamat_ortu" name="alamat_ortu" placeholder="" class="input-xxlarge" type="text" value="<?=$data['almt_ortu']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Kota</label>
  <div class="controls">
    <input id="kota_ortu" name="kota_ortu" placeholder="" class="input" type="text" value="<?=$data['kota_ortu']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Telp/HP</label>
  <div class="controls">
    <input id="telp_ortu" name="telp_ortu" placeholder="" class="input" type="text" value="<?=$data['telp_ortu']?>">   
  </div>
</div>

</fieldset>

<fieldset>
<legend>Histori Sekolah</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Masuk Kelas</label>
  <div class="controls">
    <input id="masuk_kelas" name="masuk_kelas" placeholder="Masuk Al Irsyad Kelas" class="input" type="text" value="<?=$data['msk_kls']?>">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tanggal Masuk</label>
  <div class="controls">
    <input id="tanggal1" name="tgl_masuk" placeholder="Tgl Masuk Al Irsyad" class="input" type="text" value="<?=$data['msk_tgl']?>">  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Asal Sekolah</label>
  <div class="controls">
    <input id="asal_sekolah" name="asal_sekolah" placeholder="" class="input" type="text" value="<?=$data['asl_sklh']?>">    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Alamat Sekolah</label>
  <div class="controls">
    <input id="alamat_sekolah" name="alamat_sekolah" placeholder="" class="input" type="text" value="<?=$data['almt_sklh']?>">    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">Tahun Ijazah</label>
  <div class="controls">
    <input id="tahun_ijazah" name="tahun_ijazah" placeholder="" class="input" type="text" value="<?=$data['thn_ijazah']?>">   
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label">No Ijazah</label>
  <div class="controls">
    <input id="no_ijazah" name="no_ijazah" placeholder="" class="input" type="text" value="<?=$data['no_ijazah']?>">
  </div>
</div>

</fieldset>
<fieldset>
  <legend>Pas Foto</legend>
<div class="control-group">
  <label class="control-label"></label>
  <div class="controls">
    <img src="<?php if(!empty($data['foto'])){ echo '/public/avatar/'.$data['foto']; } else { echo gravatar($data['email']); } ?>" alt="Pas Foto" />
  </div>
</div>

<div class="control-group">
  <label class="control-label">Ganti Foto</label>
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


</fieldset>
<label></label>
<input type="hidden" name="foto" value="<?=$data['foto']?>" />
<input type="hidden" name="uname" value="<?=$data['uname']?>">
<input type="hidden" name="uid" value="<?=$data['uid']?>" />
<input type="submit" name="update" value="Update" class="btn btn-success" />
</form>