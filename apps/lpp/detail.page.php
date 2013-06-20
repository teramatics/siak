<?php 
protect();

$unit = $_GET['q'];
$level = $_GET['r'];
$kelas = $_GET['s'];
$uname = $_GET['t'];
$query = $pdo->prepare('SELECT profil.nama as nama, profil.jk as jk, profil.tpl as tpl, profil.tgl as tgl, profil.alamat as alamat, profil.kota as kota, profil.telp as telp, profil.ayah as ayah, profil.ayah_pekerjaan as akerja, profil.ibu as ibu, profil.ibu_pekerjaan as ikerja, profil.wali as wali, profil.wali_pekerjaan as wkerja, profil.alamat_ortu as almt_ortu, profil.kota_ortu as kota_ortu, profil.telp_ortu as telp_ortu, profil.masuk_kls as msk_kls, profil.masuk_tgl as msk_tgl, profil.asal_sekolah as asl_sklh, profil.alamat_sekolah as almt_sklh, profil.tahun_ijazah as thn_ijazah, profil.no_ijazah as no_ijazah, profil.unit as unit, profil.level as level, profil.kelas as kelas, users.uname as uname, users.email as email, users.foto as foto FROM profil INNER JOIN users on users.uid=profil.uid WHERE users.uname=? LIMIT 1');
$query->execute(array($uname));

$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="row-fluid">
    <div class="span2">
        <img class="thumbnail" src="<?php if(!empty($data['foto'])){ echo '/public/avatar/'.$data['foto']; } else { echo gravatar($data['email']); } ?>" alt="Foto" width="100" />
    </div>
    <div class="span10">
<h2><?=$data['nama']?></h2>
</div>
</div>
<fieldset><legend>Data Pribadi</legend>
<table class="noborder">
	<tr><td class="span2">NISN</td><td>: <?=$data['uname']?></td></tr>
	<tr><td>Nama Lengkap</td><td>: <?=$data['nama']?></td></tr>
	<tr><td>Email</td><td>: <?=$data['email']?></td></tr>
	<tr><td>Jenis Kelamin</td><td>: <?=$data['jk']?></td></tr>
	<tr><td>Tempat Lahir</td><td>: <?=$data['tpl']?></td></tr>
	<tr><td>Tanggal Lahir</td><td>: <?=$data['tgl']?></td></tr>
	<tr><td>Alamat Lengkap</td><td>: <?=$data['alamat']?></td></tr>
	<tr><td>Kota</td><td>: <?=$data['kota']?></td></tr>
	<tr><td>Telp/HP</td><td>: <?=$data['telp']?></td></tr>
</table>
</fieldset>
<fieldset><legend>Data Orang Tua/Wali</legend>
<table class="noborder">
	<tr><td class="span2">Ayah</td><td>: <?=$data['ayah']?></td></tr>
	<tr><td>Pekerjaan Ayah</td><td>: <?=$data['akerja']?></td></tr>
	<tr><td>Ibu</td><td>: <?=$data['ibu']?></td></tr>
	<tr><td>Pekerjaan Ibu</td><td>: <?=$data['ikerja']?></td></tr>
	<tr><td>Wali</td><td>: <?=$data['wali']?></td></tr>
	<tr><td>Pekerjaan Wali</td><td>: <?=$data['wkerja']?></td></tr>
	<tr><td>Alamat Orang Tua/Wali</td><td>: <?=$data['almt_ortu']?></td></tr>
	<tr><td>Kota</td><td>: <?=$data['kota_ortu']?></td></tr>
	<tr><td>Telp/HP</td><td>: <?=$data['telp_ortu']?></td></tr>
</table>	
</fieldset>
<fieldset><legend>Hostori Sekolah</legend>
<table class="noborder">
	<tr><td class="span2">Masuk Al Irsyad Kelas</td><td>: <?=$data['msk_kls']?></td></tr>
	<tr><td>Tanggal Masuk</td><td>: <?=$data['msk_tgl']?></td></tr>
	<tr><td>Asal Sekolah</td><td>: <?=$data['asl_sklh']?></td></tr>
	<tr><td>Alamat Sekolah</td><td>: <?=$data['almt_sklh']?></td></tr>
	<tr><td>Tahun Ijazah</td><td>: <?=$data['thn_ijazah']?></td></tr>
	<tr><td>No Ijazah</td><td>: <?=$data['no_ijazah']?></td></tr>
</table>	
</fieldset>
<button onclick="history.go(-1);" class="btn btn-primary"><i class="icon-angle-left icon-white"></i> Kembali</button>
<p />