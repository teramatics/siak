<?php 
protect();

if(!empty($_GET['u']) && $_GET['u'] == 'edit') {
include('apps/siswa/update.page.php');
} else if(!empty($_GET['u']) && $_GET['u'] == 'hapus') {
include('apps/siswa/hapus.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'tambah') {
include('apps/siswa/tambah.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'tambah-cepat') {
include('apps/siswa/tambah-cepat.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'siswa') {
include('apps/siswa/daftar.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'guru') {
include('apps/siswa/guru.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'absensi') {
include('apps/siswa/absensi.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'nilai') {
include('apps/siswa/nilai.page.php');
} else if(!empty($_GET['t']) && $_GET['t'] == 'keuangan') {
include('apps/siswa/keuangan.page.php');
} else if(!empty($_GET['t'])) {
include('apps/siswa/detail.page.php');
} else if(!empty($_GET['s'])) {
include('apps/siswa/daftar.page.php');
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