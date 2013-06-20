<?php 
protect();

if(!empty($_GET['t']) && $_GET['t'] == 'tambah' && $_GET['s'] == 'siswa') {
include('apps/sd01/addsiswa.page.php');
} else if(!empty($_GET['s']) && $_GET['s'] == 'keuangan') {
include('apps/sd01/keuangan.page.php');
} else if(!empty($_GET['s']) && $_GET['s'] == 'nilai') {
include('apps/sd01/nilai.page.php');
} else if(!empty($_GET['s']) && $_GET['s'] == 'absensi') {
include('apps/sd01/absensi.page.php');
} else if(!empty($_GET['s']) && $_GET['s'] == 'guru') {
include('apps/sd01/guru.page.php');
} else if(!empty($_GET['s']) && $_GET['s'] == 'tambah') {
include('apps/sd01/addsiswa.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == '1') {
include('apps/sd01/1.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == '2') {
include('apps/sd01/2.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == '3') {
include('apps/sd01/3.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == '4') {
include('apps/sd01/4.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == '5') {
include('apps/sd01/5.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == '6') {
include('apps/sd01/6.page.php');
} else if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/sd01/hapus.page.php');
} else { ?>

<h1>SD 01</h1>

<?php } ?>