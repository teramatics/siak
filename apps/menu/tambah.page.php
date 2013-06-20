<?php 
	protect();
	if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
	}
if(isset($_POST['tambah'])) {

	$menu = $_POST['menu'];
	$url  = $_POST['url'];
	//$posisi = $_POST['posisi'];

	$query = $pdo->prepare('INSERT INTO menu (menu, url) VALUES (?, ?)');
	$query->execute(array($menu, $url));
	redirect('/menu');
	exit();
}	
?>
<h2>Tambah Menu</h2>
<form id="form" method="post" action="">
<label>Nama Menu</label><input type="text" name="menu" class="required" />
<label>URL</label><input type="text" name="url" class="required" />
<!-- label>Posisi</label>
	<select name="posisi" class="required" />
		<option value="1">Atas</option>
		<option value="2">Bawah</option>
	</select -->
<label></label>
<input type="submit" name="tambah" value="Tambah" class="btn btn-primary" />
</form>