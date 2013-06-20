<?php 
protect();

if(!empty($_GET['s']) && $_GET['s'] == 'edit') {
include('apps/lpp/update.page.php');
} else if(!empty($_GET['r']) && $_GET['r'] == 'tambah') {
include('apps/lpp/tambah.page.php');
} else if(!empty($_GET['q']) && $_GET['q'] == 'personalia') {
include('apps/lpp/personalia.page.php');
} else { ?>
<h2>LPP</h2>

<?php } ?>