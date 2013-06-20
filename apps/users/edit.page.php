<?php 
	
protect();

if(isset($_POST['update'])) {

	$motto      = $_POST['motto'];
    $nama 		= $_POST['nama'];
	$email		= $_POST['email'];
	$alamat 	= $_POST['alamat'];
	$kota 		= $_POST['kota'];
	$provinsi 	= $_POST['provinsi'];
	$negara 	= $_POST['negara'];
	$hp 		= $_POST['hp'];
    $uid        = $_POST['uid'];

    if(!empty($_FILES['pic']['name'])) { 

        $foto = $_FILES['pic']['name'];
        $tmp_name = $_FILES['pic']['tmp_name'];
        if(isset($foto)) {
            $location = $_SERVER['DOCUMENT_ROOT'].'/public/avatar/'.$foto;
            move_uploaded_file($tmp_name, $location);
        }
    } else { 
        $foto = $_POST['foto']; 
    }

	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$query2 = $pdo->prepare('UPDATE profil SET nama = ?, email = ?, motto=?, alamat = ?, kota = ?, provinsi = ?, negara = ?, telp = ? WHERE uid = ?') or die("Gagal mengecek profil di database");
	$data_profil = array($nama, $email, $motto, $alamat, $kota, $provinsi, $negara, $hp, $uid);
	$query2->execute($data_profil);	

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query3 = $pdo->prepare('UPDATE users SET email=?, nama=?, foto=? WHERE uid=?') or die("Gagal mengecek users di database");
    $data_user = array($email, $nama, $foto, $uid);
    $query3->execute($data_user); 

	redirect('/users');					

}
	$uid = $_GET['r'];
	$query = $pdo->prepare('SELECT users.uid as uid, users.uname as uname, users.nama as nama, users.email as email, users.foto as foto, profil.motto, profil.alamat as alamat, profil.kota as kota, profil.provinsi as provinsi, profil.negara as negara, profil.telp as telp FROM users INNER JOIN profil on users.uid = profil.uid WHERE users.uid = ?');
    $query->execute(array($uid)); 
	$plg = $query->fetch(PDO::FETCH_ASSOC);
?>
<h3>Edit <?=$plg['nama']?></h3>
<form id="form" method="post" enctype="multipart/form-data" action="" >
<label>Motto</label><textarea name="motto" class="input-xlarge required"><?=$plg['motto']?></textarea>
<label>Nama Lengkap</label><input type="text" class="input-xlarge required" name="nama" value="<?=$plg['nama']?>" />
<label>Email</label><input type="text" class="input-xlarge required" name="email" value="<?=$plg['email']?>" />
<label>Alamat Lengkap</label><input type="text" class="input-xxlarge required" name="alamat" value="<?=$plg['alamat']?>" />
<label>Kota</label>
<select name="kota" id="kota" class="required">  
    <?php 
        $query = $pdo->prepare("SELECT kid, kota FROM kota");   $query->execute(); 
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    ?>  
      <option <?php if($row['kid'] == $plg['kota']) { echo "value=".$plg['kota'].""; echo " selected"; } else { echo "value=".$row['kid'].""; } ?> ><?=$row['kota']?></option>
    <?php } ?>
</select>
<label>Provinsi</label>
<select name="provinsi" id="provinsi" class="required">
    <?php 
        $query = $pdo->prepare("SELECT pid, provinsi FROM provinsi");   $query->execute(); 
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    ?>  
        <option <?php if($row['pid'] == $plg['provinsi']) { echo "value=".$plg['provinsi'].""; echo " selected"; } else { echo "value=".$row['q'].""; } ?> ><?=$row['provinsi']?></option>
    <?php } ?>
</select>
<label>Negara</label>
<select name="negara" id="negara" class="required"> 
    <?php 
        $query = $pdo->prepare("SELECT nid, negara FROM negara");   $query->execute(); 
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    ?>  
        <option <?php if($row['nid'] == $plg['negara']) { echo "value=".$plg['negara'].""; echo " selected"; } else { echo "value=".$row['nid'].""; } ?> ><?=$row['negara']?></option>
    <?php } ?>
</select>
<label>HP.</label><input type="text" name="hp" class="required" value="<?=$plg['telp']?>" />
<label></label>
<img src="<?php if(!empty($plg['foto'])){ echo '/public/avatar/'.$plg['foto']; } else { echo gravatar($plg['email']); } ?>" alt="Avatar" />
<label>Ganti Avatar</label>
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
<label></label>
<input type="hidden" name="foto" value="<?=$plg['foto']?>" />
<input type="hidden" name="uid" value="<?=$plg['uid']?>" />
<input type="submit" name="update" value="Update" class="btn btn-success" />
</form>