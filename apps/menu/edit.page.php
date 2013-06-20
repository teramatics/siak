<?php 
	protect();
	if($_SESSION['level'] > '2') {
		redirect('/denied');
		exit();
	}
if(isset($_POST['update'])) {

	$menu = $_POST['menu'];
	$url  = $_POST['url'];
	$mid = $_POST['mid'];

	$query = $pdo->prepare('UPDATE menu SET menu=?, url=? WHERE mid=?');
	$query->execute(array($menu, $url, $mid));
	redirect('/menu');
	exit();
}	

$mid= $_GET['r'];
$query = $pdo->prepare('SELECT * FROM menu WHERE mid=?');
$query->execute(array($mid));
$mn = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2>Update Menu</h2>
<form id="form" method="post" action="">
<label>Nama Menu</label><input type="text" name="menu" class="required" value="<?=$mn['menu']?>" />
<label>URL</label><input type="text" name="url" class="required" value="<?=$mn['url']?>" />
<!-- label>Posisi</label>
	<select name="posisi" class="required" />
		<option value="1">Atas</option>
		<option value="2">Bawah</option>
	</select -->
<label></label>
<input type="hidden" name="mid" value="<?=$mn['mid']?>" />
<input type="submit" name="update" value="Update" class="btn btn-primary" />
</form>