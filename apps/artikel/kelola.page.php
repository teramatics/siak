<?php 
protect();
if($_SESSION['tipe'] > '2') {
		redirect('/denied');
		exit();
}
?>
<ul class="nav nav-pills pull-right">
    <li class="active">
    <a class="btn-success" href="/berita/kelola">Daftar</a>
    </li>
    <li>
    <a href="/berita/tambah">Tambah</a>
    </li>      
</ul>
<h3>Data Berita</h3>
	<table class="table table-striped table-bordered dataTable" id="data">
		<thead>
			<tr>
				<th>TANGGAL</th>
				<th>KETEGORI</th>
				<th>JUDUL</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$query = $pdo->prepare("SELECT berita.berita_id as bid, berita.judul as judul, 
			berita.seo as seo, berita.isi as isi, berita.tanggal as tgl, kategori.kategori as kat
			FROM berita 
		   	INNER JOIN kategori on berita.kategori_id = kategori.kategori_id 
		   	WHERE berita.kategori_id = kategori.kategori_id");

			$query->execute();
			$no = 1;
			while($data = $query->fetch(PDO::FETCH_ASSOC)) {
		?>		
			<tr>
				<td><?php echo tgl(substr($data['tgl'], 0, 10)).' - <small>'.substr($data['tgl'], -8);?> WIB</small></a></td>
				<td><?=$data['kat']?></td>
				<td><a href="/berita/detail/<?=$data['seo']?>" title="Lihat <?=$data['judul'];?>"><?=$data['judul']?></a></td>
				<td>
					<a href="/berita/detail/<?=$data['seo']?>" class="lihat" title="Lihat <?=$data['judul'];?>"><i class="icon-list-alt"></i></a>
					<a href="/berita/edit/<?=$data['bid']?>" class="edit" title="Edit <?=$data['judul'];?>"><i class="icon-edit"></i></a>
					<a href="/berita/hapus/<?=$data['bid']?>" class="delete" title="Hapus <?=$data['judul'];?>"><i class="icon-remove"></i></a>
				</td>
			</tr>
		<?php } ?>		
	</table>	