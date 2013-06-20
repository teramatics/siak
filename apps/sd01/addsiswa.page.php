<?php 
protect();

?>
<h2>Tambah Siswa</h2>
<form id="form" class="form-horizontal" method="post" action="">

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
      <input name="radios" value="Laki-laki" checked="checked" type="radio">
      Laki-laki
    </label>
    <label class="radio inline">
      <input name="radios" value="Perempuan" type="radio">
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

<div class="control-group">
  <label class="control-label">Upload Foto</label>
  <div class="controls">
	<div class="fileupload fileupload-new" data-provides="fileupload">
	<div class="input-append">
		<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> 
			<span class="fileupload-preview"></span>
		</div>
			<span class="btn btn-file"><span class="fileupload-new">Pilih foto</span>
			<span class="fileupload-exists">Ganti</span><input type="file" name="myfoto" /></span>
			<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Hapus</a>
		</div>
	</div>
  </div>
</div>

		<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />

</form>			