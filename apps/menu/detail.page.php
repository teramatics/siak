<?php
	$mid = $_GET['r'];
	$query = $pdo->prepare('SELECT mid, menu, url FROM menu WHERE mid=?');
	$query->execute(array($mid));
	$mn = $query->fetch(PDO::FETCH_ASSOC);
?>	
<h2>Detail <?=$mn['menu']?></h2>

<table class="noborder">
	<tr>
		<td class="span2">Nama Menu</td>
		<td><?=$mn['menu']?></td>
	</tr>
	<tr>
		<td>URL</td>
		<td><?=$mn['url']?></td>
	</tr>
	<!-- tr>
		<td>Posisi</td>
		<td><?=($mn['posisi'] == 1) ? 'Atas' : 'Bawah';?></td>
	</tr -->
</table>			
<button onclick="history.go(-1);" class="btn btn-info"><i class="icon-arrow-left icon-white"></i> Kembali</button>