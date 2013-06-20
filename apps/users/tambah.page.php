<?php 
protect();


if(isset($_POST['tambah'])) {

	$uid 	= $_POST['user_id'];
	$tipe 	= $_POST['tipe'];
	$nama 	= $_POST['nama'];
	$email 	= $_POST['email'];
	$jk 	= $_POST['jk'];
	$tpl 	= $_POST['tpl'];
	$tgl	= $_POST['tgl'];
	$agama 	= $_POST['agama'];
	$alamat = $_POST['alamat'];
	$kota 	= $_POST['kota'];
	$telp 	= $_POST['telp'];
	$hp 	= $_POST['hp'];
	$unit 	= $_POST['unit'];
	$level 	= $_POST['level'];
	$kelas 	= $_POST['kelas'];
	

		$salt = '1I3TTAIioG8PJkiyMd83Kc6Xya6I00v7';
		$password = substr($_POST['tgl'], 0, 4).substr($_POST['tgl'], 5, -3).substr($_POST['tgl'], -2, 2);
		$pass = md5($salt.md5($password).$salt);

		$name = $_FILES['myfoto']['name'];
		$tmp_name = $_FILES['myfoto']['tmp_name'];
		if(isset($name)) {
			$location = $_SERVER['DOCUMENT_ROOT']."/filebox/foto/$name";
			move_uploaded_file($tmp_name, $location);
		} 

		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$users = array($uid, $nama, $email, $pass, $name, $unit, $tipe);
		$query = $pdo->prepare('INSERT INTO users (user_id, nama, email, password, foto, unit_id, tipe_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
		$query->execute($users);

		$data = array($uid, $nama, $jk, $tpl, $tgl, $agama, $alamat, $kota, $telp, $hp, $unit, $level, $kelas);
		if ($tipe == '4') {
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$query = $pdo->prepare('INSERT INTO siswa (user_id, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, alamat, kota, telp, hp, unit_id, level_id, kelas_id) 
									VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$query->execute($data);
		} else {
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$query = $pdo->prepare('INSERT INTO pegawai (user_id, nama_lengkap, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, alamat, kota, telp, hp, unit_id, level_id, kelas_id) 
									VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$query->execute($data);
		}
	redirect('/users/'.$uid);
}

?>
<div class="btn-group pull-right">
	<a href="/users" class="btn btn-info"><i class="icon-list-alt icon-white"></i> DATA</a>
	<a href="/users/tambah" class="btn btn-info active"><i class="icon-plus icon-white"></i> TAMBAH</a>   
</div>	
<h3>Tambah Anggota</h3>
	<?php if(isset($_POST['user_id'])) { ?><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Data <?=$_POST['user_id']?> telah ditambahkan!.</div><?php } ?>
	<form id="form" method="post" enctype="multipart/form-data" action="">
		<fieldset><legend>Data Keanggotaan</legend>
			<label>NISN <span class="red">*</span></label><input type="text" name="user_id" class="required" />
			<label>Tipe</label>
		    <select id="tipe" name="tipe">
	          <option value="">-- Pilih Tipe --</option> 	
	        <?php 
		        $query = $pdo->prepare("SELECT * FROM tipe");	$query->execute(); 
		        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	        ?>	
	          <option value="<?=$row['tipe_id']?>"><?=$row['tipe']?></option>
	        <?php } ?>
	        </select>  
	        <label>Unit/Sekolah <span class="red">*</span></label>
	        <select id="unit" name="unit">
	          <option value="">-- Pilih Unit --</option> 	
	        <?php 
		        $query = $pdo->prepare("SELECT * FROM unit");	$query->execute(); 
		        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	        ?>
	          <option value="<?=$row['unit_id']?>"><?=$row['unit']?></option>
	        <?php } ?>   	
	        </select>
	        <label>Level</label>
	        <select id="level" name="level">
	          <option value="">-- Pilih Level --</option> 
	        <?php 
		        $query = $pdo->prepare("SELECT * FROM level");	$query->execute(); 
		        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	        ?>
	          <option value="<?=$row['level_id']?>"><?=$row['level']?></option>
	        <?php } ?>   
	        </select>
	        <label>Kelas</label>
	        <select id="kelas" name="kelas">
	          <option value="">-- Pilih Kelas --</option>   
	        <?php 
		        $query = $pdo->prepare("SELECT * FROM kelas");	$query->execute(); 
		        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	        ?>
	          <option value="<?=$row['kelas_id']?>"><?=$row['kelas']?></option>
	        <?php } ?>   
	        </select>
	        <p />
		</fieldset>
		<fieldset><legend>Data Personal</legend>
			<label>Nama Lengkap <span class="red">*</span></label><input type="text" name="nama" class="required" />
			<label>Email</label><input type="text" name="email" class="email required" />
			<label>Jenis Kelamin</label><input type="radio" name="jk" value="L" /> Laki-laki <input type="radio" name="jk" value="P" /> Perempuan
			<label>Tempat Lahir</label><input type="text" name="tpl" />
			<label>Tanggal Lahir <span class="red">*</span></label><input type="text" name="tgl" id="tanggal" class="required" />
			<label>Agama</label><input type="text" name="agama" />	
		    <label>Alamat</label><input type="text" class="input-xxlarge" name="alamat" />
		    <label>Kota</label><input type="text" name="kota" />
		    <label>Telp.</label><input type="text" class="number" name="telp" />
		    <label>HP.</label><input type="text" class="number" name="hp" />
		</fieldset>	

		<fieldset><legend>Pas Foto</legend>
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
		</fieldset>
		<input type="submit" name="tambah" value="Tambah" class="btn btn-success" />			    	
	</form> 	