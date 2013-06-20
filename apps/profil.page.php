<?php 
protect();
$uname = $_GET['q'];
if(isset($_POST['kirim']) || isset($_POST['tambah'])) {

    $komen = nl2br($_POST['komen']);
    $uid   = $_POST['uid'];

    if(!empty($_POST['pid'])) {
        $pid = $_POST['pid'];
    } else {
        $pid = '0';
    }
    if(!empty($_POST['email']) && !empty($_POST['nama'])) { 
            $nama  = $_POST['nama'];
            $email  = $_POST['email'];
            $subject = $nama.', Ada komentar di Status Anda';

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: SIS LPP Al Irsyad <admin@sis.alirsyadpwt.com>' . "\r\n";

            $status  = '<html><body>';
            $status .= 'Dengan Hormat,<p>Ada Komentar di Status Anda:</p>';
            $status .= '"'.substr($komen, 0, 60).'..."<br />';
            $status .= '<p>Detail silahkan cek di <a href="'.$base.'dashboard">'.$base.'dashboard</a>';
            $status .= '<p>Terima kasih,</p><p>Admin Support</p>';
            $status .= '</body></html>';

            mail($email, $subject, $status, $headers);
    }
            
    $query = $pdo->prepare('INSERT INTO wall (pid, isi, uid) VALUES (?, ?, ?)');
    $query->execute(array($pid, $komen, $uid));

    $direct = '/profil/'.$uname;
    redirect($direct);
    exit();
}
if(!empty($_GET['q']) && $_GET['q'] == 'edit' && !empty($_GET['r'])) {
include('apps/profil/edit.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'detail') {
include('apps/profil/detail.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/profil/hapus.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'tambah') {
include('apps/profil/tambah.page.php');
} else { 
    $query = $pdo->prepare('SELECT profil.nama as nama, profil.jk as jk, profil.tpl as tpl, profil.tgl as tgl, profil.motto as motto, profil.alamat as alamat, profil.kota as kota, profil.telp as telp, profil.ayah as ayah, profil.ayah_pekerjaan as akerja, profil.ibu as ibu, profil.ibu_pekerjaan as ikerja, profil.wali as wali, profil.wali_pekerjaan as wkerja, profil.alamat_ortu as almt_ortu, profil.kota_ortu as kota_ortu, profil.telp_ortu as telp_ortu, profil.masuk_kls as msk_kls, profil.masuk_tgl as msk_tgl, profil.asal_sekolah as asl_sklh, profil.alamat_sekolah as almt_sklh, profil.tahun_ijazah as thn_ijazah, profil.no_ijazah as no_ijazah, profil.unit as unit, profil.level as level, profil.kelas as kelas, users.uid as uid, users.uname as uname, users.email as email, users.foto as foto FROM profil INNER JOIN users on users.uid=profil.uid WHERE users.uname=? LIMIT 1');
    $query->execute(array($uname));

    $pro = $query->fetch(PDO::FETCH_ASSOC);
?>

<div class="row-fluid">
    <div class="span2">
        <img class="thumbnail" src="<?php if(!empty($pro['foto'])){ echo '/public/avatar/'.$pro['foto']; } else { echo gravatar($pro['email']); } ?>" alt="Foto" width="100" />
    </div>
    <div class="span10">
        <h2 class="profil"><?=$pro['nama']?><?php if(isset($_SESSION['loggedin']) && $_SESSION['email'] == $pro['email']) { ?> <a href="/profil/edit/<?=$pro['uname']?>" title="Edit Data Profil"><small><i class="icon-edit"></i> Edit</small></a><?php } ?></h2>
        <label>Motto:</label>
        <div class="motto alert alert-success"><?=$pro['motto']?></div>
    </div>
</div>
<div class="row-fluid"> 
<div class="btn btn-small biodata" title="Lihat Profil <?=$pro['nama']?>">Detail Profil</div>
<table class="bio noborder" style="display: none;">
    <tr><td class="span2">Nama Lengkap</td><td>: <?=$pro['nama']?></td></tr>
    <tr><td>Email</td><td>: <?=$pro['email']?></td></tr>
    <tr><td>Alamat Lengkap</td><td>: <?=$pro['alamat']?></td></tr>
    <tr><td>Kota</td><td>: <?=$pro['kota']?></td></tr>
    <tr><td>HP.</td><td>: <?=$pro['telp']?></td></tr>
</table>
</div>
<fieldset><legend>Histori Status</legend>
<div class="pesan wall">
        <?php
            $uid = $pro['uid'];
            $query = $pdo->prepare('SELECT wall.wid as wid, wall.pid as pid, wall.isi as isi, wall.uid as uid, wall.dibuat as dibuat, users.uname as uname, users.nama as nama, users.email as email, users.foto as foto FROM wall INNER JOIN users on users.uid = wall.uid WHERE wall.pid = ? AND wall.uid =? ORDER BY wall.wid DESC LIMIT 5'); $query->execute(array(0, $uid)); 
            while($wall = $query->fetch(PDO::FETCH_ASSOC)) { 
        ?>
        <div class="row-fluid display-komen">
            <div class="span1">
                <img class="thumbnail" src="<?php if(!empty($wall['foto'])){ echo '/public/avatar/'.$wall['foto']; } else { echo gravatar($wall['email']); } ?>" alt="Avatar" width="55" />
            </div>
            <div class="span11">
                <div class="isi"><?php if($_SESSION['uid'] == $wall['uid']) { ?><a class="remove" href="/status/hapus/<?=$wall['wid']?>" title="Hapus"><i class="icon-remove pull-right"></i></a><?php } ?><strong><a href="/profil/<?=$wall['uname'] ?>"><?=$wall['nama']?></a></strong> <?=$wall['isi']?> <span><?=sejak($wall['dibuat']); ?></span></div>
                <div class="komen"><i class="icon-pencil"></i> Tulis Komentar </div>
                <div class="tulis" style="display: none;">
                    <form class="form" method="post" action="">
                        <textarea name="komen" class="input span12" placeholder="Tulis komentar disini..." onclick="this.placeholder=''"></textarea><br />
                        <input type="hidden" name="pid" value="<?=$wall['wid']?>" />
                        <input type="hidden" name="uid" value="<?=$_SESSION['uid']?>" />
                        <input type="submit" name="tambah" value="Kirim" class="btn btn-small btn-primary" />
                    </form>
                </div>
                <?php
                    $wid = $wall['wid'];
                    $query2 = $pdo->prepare('SELECT wall.wid as wid, wall.pid as pid, wall.isi as isi, wall.uid as uid, wall.dibuat as dibuat, users.uname as uname, users.nama as nama, users.email as email, users.foto as foto FROM wall INNER JOIN users on users.uid = wall.uid WHERE wall.pid = ? AND wall.uid =? ORDER BY wall.wid ASC'); $query2->execute(array($wid, $uid)); 
                    while($kom = $query2->fetch(PDO::FETCH_ASSOC)) { 
                ?>
                    <div class="row-fluid display-komen">
                    <div class="span1">
                        <img class="thumbnail" src="<?php if(!empty($kom['foto'])){ echo '/public/avatar/'.$kom['foto']; } else { echo gravatar($kom['email']); } ?>" alt="Avatar" width="28" />
                    </div>
                    <div class="span11">
                        <div class="isi"><strong><a href="/profil/<?=$kom['uname'] ?>"><?=$kom['nama']?></a></strong> <?=$kom['isi']?>
                            <span><?=sejak($kom['dibuat']); ?></span><?php if($_SESSION['uid'] == $kom['uid']) { ?><a class="remove" href="/status/hapus/<?=$kom['wid']?>" title="Hapus"><i class="icon-remove pull-right"></i></a><?php } ?></div>
                    </div>
                    </div>  
                <?php } ?>
            </div>
        </div>  
        <?php } ?>  
    </div>

</fieldset>    
<?php } ?>