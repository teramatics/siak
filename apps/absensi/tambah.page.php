<?php 
protect();
$unit = $_GET['q'];
$level = $_GET['r'];
$kelas = $_GET['s'];
if(isset($_POST['tambah'])) {
	$nisn = $_POST['nisn'];
	$tgl = date('Y-m-d');
	$absensi = $_POST['absensi'];
	$ket = $_POST['ket'];
	$posted = $_SESSION['uid'];

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query = $pdo->prepare('INSERT INTO absensi (nisn, tgl, absensi, ket, posted) VALUES (?, ?, ?, ?, ?)') or die("Gagal mengecek absensi di database");
	$query->execute(array($nisn, $tgl, $absensi, $ket, $posted));

	$direct = $base.'absensi/'.$unit.'/'.$level.'/'.$kelas;
    redirect($direct);			
}
?>
<h2>Tambah Absensi</h2>
<form id="form" class="form-horizontal" method="post" action="">
	<div class="control-group">
	  <label class="control-label">NISN/Nama Lengkap</label>
	  <div class="controls">
	    <input type="text" name="cari" class="input" placeholder="Tulis NISN/Nama Lengkap" /> <button type="submit" name="submit" class="btn"><i class="icon-search"></i></button>
	  </div>
	</div>
</form>
<?php
if(isset($_POST['cari'])) {
	$cari = $_POST['cari'];
    $query = $pdo->prepare('SELECT uname, nama FROM users WHERE uname LIKE ? OR nama LIKE ? LIMIT 1');
	$query->bindValue(1, "%$cari%", PDO::PARAM_STR);
    $query->bindValue(2, "%$cari%", PDO::PARAM_STR);
	$query->execute();
	$num = $query->rowCount();
    if($num > 0) {
    $data = $query->fetch(PDO::FETCH_ASSOC); 
?>
<form id="form" class="form-horizontal" method="post" action="">
	<div class="control-group">
	  <label class="control-label">NISN</label>
	  <div class="controls">
	    <input type="text" name="uname" class="input input-xlarge" value="<?=$data['uname']?>" disabled="disabled" />
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label">Nama Lengkap</label>
	  <div class="controls">
	    <input type="text" name="nama" class="input input-xlarge" value="<?=$data['nama']?>" disabled="disabled" />
	  </div>
	</div>	
	<div class="control-group">
	  <label class="control-label">Staus Absensi</label>
	  <div class="controls">
	    <label class="radio inline">
	      <input name="absensi" value="A" type="radio">
	      Alpha
	    </label>
	    <label class="radio inline">
	      <input name="absensi" value="S" type="radio">
	      Sakit
	    </label>
	    <label class="radio inline">
	      <input name="absensi" value="I" type="radio">
	      Ijin
	    </label>
	    <label class="radio inline">
	      <input name="absensi" value="T" type="radio">
	      Tugas dari Sekolah
	    </label>
	    <label class="radio inline">
	      <input name="absensi" value="L" type="radio">
	      Lain-lain
	    </label>	    	    	    
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label">Keterangan</label>
	  <div class="controls">
	    <input type="text" name="ket" class="input input-xxlarge" />
	  </div>
	</div>	
	<div class="control-group">
	  <label class="control-label"></label>
	  <div class="controls">
	  	<input type="hidden" name="nisn" value="<?=$data['uname']?>" />
	    <input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
	  </div>
	</div>				
</form>

<?php } else { ?>
	<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><p>Data tidak ditemukan</p></div>
<?php } } ?>