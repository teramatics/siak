<?php 
if(isset($_SESSION['loggedin'])) {
redirect('/dashboard');
exit();
} else {
if(isset($_POST['register'])) {
	if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {

		$uname 		= strtolower($_POST['uname']);
		$email		= $_POST['email'];

		if(unameCek($uname) == true) {
			$error = 'Username sudah digunakan, silahkan pilih yang lain'; 
		}

		if(emailCek($email) == true) {
			$error = 'Email sudah digunakan, silahkan pilih yang lain'; 
		}

		if(unameCek($uname) == false && emailCek($email) == false) {
			$password 	= $_POST['password'];
			$nama 		= $_POST['nama'];
			$alamat 	= $_POST['alamat'];
			$kota 		= $_POST['kota'];
			$provinsi 	= $_POST['provinsi'];
			$negara 	= $_POST['negara'];
			$hp 		= $_POST['hp'];
			$kode 		= randompass(15);

		    $pass = md5($salt.md5($password).$salt);

		    $qu = $pdo->prepare('SELECT MAX(uid) as uid FROM users');
			$qu->execute();
			$uid = $qu->fetch();
			$lastid = $uid['uid'];
			$nextid = $lastid+1;

			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$query = $pdo->prepare('INSERT INTO users (uname, nama, email, password, aktivasi) VALUES (?, ?, ?, ?, ?)') or die("Gagal mengecek users di database");
			$data_users = array($uname, $nama, $email, $pass, $kode);
			$query->execute($data_users);

			$subject = 'Data Registrasi di Cybermafaza.com';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Cybermafaza.com <admin@cybermafaza.com>' . "\r\n";

			$registrasi  = '<html><body>';
			$registrasi .= 'Dengan Hormat,<p>Berikut ini data pendaftaran keanggotaan di Cybermafaza.com:</p>';
			$registrasi .= 'Nama Lengkap: '.$nama.'<br />';
			$registrasi .= 'Username: '.$uname.'<br />';
			$registrasi .= 'Email: '.$email.'<br />';
			$registrasi .= 'Password: '.$password.'<br />';
			$registrasi .= '<p>Silahkan lakukan aktivasi keanggotaan lewat link '.$base.'aktivasi/'.$kode.' atau masukan kode: '.$kode.' melalui halaman aktivasi '.$base.'aktivasi/</p>';
			$registrasi .= '<p>Jika sudah aktivasi silahkan login menggunakan data diatas melalui '.$base.'secure</p>';
			$registrasi .= '<p>Terima kasih,</p><p>Admin Support</p>';
			$registrasi .= '</body></html>';

			mail($email, $subject, $registrasi, $headers);

			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$query2 = $pdo->prepare('INSERT INTO profil (uid, nama, email, alamat, kota, provinsi, negara, telp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)') or die("Gagal mengecek profil di database");
			$data_profil = array($nextid, $nama, $email, $alamat, $kota, $provinsi, $negara, $hp);
			$query2->execute($data_profil);

			header('Location: /sukses');
			exit();
		} else {
			$error = 'Username atau email sudah digunakan, silahkan pilih yang lain';
		}
	} else {
		$error = "Kode capctha salah, silahkan dicoba kembali";
	}	
}
?>
<h2>Pendaftaran Menjadi Anggota</h2>
<?php if(!empty($error)) { ?><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?=$error?></p></div><?php } ?>
<form id="register" method="post" action="">
<label>User Name</label><input type="text" class="input-large required" name="uname" value="<?php if(!empty($_POST['uname'])) { echo $_POST['uname']; } ?>" placeholder="Tanpa tanda baca & huruf kecil" onclick="this.placeholder='';" />	
<label>Email</label><input type="text" class="input-large required" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>" placeholder="Valid email" onclick="this.placeholder='';" />
<label>Password</label><input type="password" name="password" id="password" class="required" placeholder="Min 6 karakter" onclick="this.placeholder='';" />
<label>Ulang Password</label><input type="password" name="upassword" id="upassword" class="required" placeholder="Ulang Password" onclick="this.placeholder='';" />
<label>Nama Lengkap</label><input type="text" class="input-large  required" name="nama" value="<?php if(!empty($_POST['nama'])) { echo $_POST['nama']; } ?>" placeholder="Nama Lengkap" onclick="this.placeholder='';" />
<label>Alamat Lengkap</label><input type="text" class="input-xxlarge  required" name="alamat" value="<?php if(!empty($_POST['alamat'])) { echo $_POST['alamat']; } ?>" placeholder="Alamat Lengkap" onclick="this.placeholder='';" />
<label>Kota</label>
<input type="text" id="kota" data-provide="typeahead" name="kota" class="required" autocomplate="off" />
<select name="kota" class="required">
      <option value="228">Purwokerto</option> 	
	    <?php 
	        $query = $pdo->prepare("SELECT kid, kota FROM kota");	$query->execute(); 
	        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	    ?>	
      <option value="<?=$row['kid']?>"><?=$row['kota']?></option>
    <?php } ?>
</select>
<label>Provinsi</label>
<select name="provinsi" id="provinsi" class="required">
      <option value="14">Jawa Tengah</option> 	
	    <?php 
	        $query = $pdo->prepare("SELECT pid, provinsi FROM provinsi");	$query->execute(); 
	        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	    ?>	
      <option value="<?=$row['r']?>"><?=$row['provinsi']?></option>
    <?php } ?>
</select>
<label>Negara</label>
<select name="negara" id="negara" class="required">
      <option value="102">Indonesia</option> 	
	    <?php 
	        $query = $pdo->prepare("SELECT nid, negara FROM negara");	$query->execute(); 
	        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
	    ?>	
      <option value="<?=$row['nid']?>"><?=$row['negara']?></option>
    <?php } ?>
</select>
<label>Telp./HP.</label><input type="text" name="hp" class="required" value="<?php if(!empty($_POST['hp'])) { echo $_POST['hp']; } ?>" placeholder="Telpon/Handphone" onclick="this.placeholder='';" />
<label>Masukan Kode</label>
<img class="captcha" src="/apps/captcha.php" /><input name="captcha" type="text" class="input-small required">
<label></label>
<input type="submit" name="register" value="Daftar" class="btn btn-primary" />
</form>
<?php } ?>