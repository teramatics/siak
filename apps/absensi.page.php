<?php 
protect();

if(!empty($_GET['u']) && $_GET['u'] == 'edit') {
include('apps/absensi/update.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'hapus') {
include('apps/absensi/hapus.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'tambah') {
include('apps/absensi/tambah.page.php');
} else if(!empty($_GET['r']) && $_GET['r'] == 'daftar') {
include('apps/absensi/data.page.php');
} else if(!empty($_GET['s'])) {
include('apps/absensi/daftar.page.php');
} else {
$unit = $_GET['q'];
$level = $_GET['r'];
$kelas = $_GET['s'];
$uname = $_GET['t'];
$query = $pdo->prepare('SELECT profil.nama as nama, profil.tgl as tgl, users.uname as uname FROM profil INNER JOIN users on users.uid=profil.uid WHERE users.uname=?');
$query->execute(array($uname));

$data = $query->fetch(PDO::FETCH_ASSOC);
?>
NISN: <?=$data['uname']?><br>
Nama: <?=$data['nama']?><br>

<?php } ?>