<?php 
protect();
if(!empty($_GET['r']) && $_GET['q'] == 'hapus') {
include('apps/status/hapus.page.php');
} else {
	redirect('/dashboard');
	exit();
}
?>