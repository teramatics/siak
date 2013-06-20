<h3>Hasil Pencarian</h3>

<form class="form-search" method="post" action="/cari">
    <input type="text" name="cari" class="input-large search-query" placeholder="Cari Artikel..." onclick="this.placeholder=''" />
    <button type="submit" name="submit" class="btn"><i class="icon-search"></i></button>
</form>
<?php
if(isset($_POST['cari'])) {
	$cari = $_POST['cari'];
	//$query = $pdo->prepare('SELECT judul, seo, isi, foto FROM artikel WHERE nama LIKE ?');
    $query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.isi as isi, artikel.foto as foto, artikel.dibuat as dibuat, kategori.kategori as kat, kategori.seo as katseo, users.uid as uid, users.uname as uname, users.nama as posted FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid INNER JOIN users on users.uid = artikel.post_id WHERE artikel.judul LIKE ? OR artikel.isi LIKE ? LIMIT 0, 10');
	$query->bindValue(1, "%$cari%", PDO::PARAM_STR);
    $query->bindValue(2, "%$cari%", PDO::PARAM_STR);
	$query->execute();
	$num = $query->rowCount();
    if($num > 0) {
    while($data = $query->fetch(PDO::FETCH_ASSOC)) { 
?>
<div class="row-fluid">
<div class="span12">
<h3><?=$data['judul']?><span class="h-line"></i></h3>
</div>
</div>
<div class="row-fluid">
<?php if($data['foto']) { ?>    
<div class="span3">
<img id="zoom" class="thumbnail" src="/public/artikel/<?=$data['foto']?>" alt="<?=$data['judul']?>">
</div>
<?php } ?>
<div class="span9">
<?=substr($data['isi'], 0, 400)?>
<p><a class="btn btn-small" href="<?=$base?>konten/<?=$data['katseo'].'/'.$data['seo']?>">Selengkapnya...</a></p>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<p></p>
<p>
<i class="icon-user"></i> Ditulis oleh <a href="<?=$base?>profil/<?=$data['uname']?>"><?=$data['posted']?></a>
 <i class="icon-calendar"></i> <?=$data['dibuat']?>
 <i class="icon-tags"></i> Kategori: <a href="<?=$base?>kategori/<?=$data['katseo']?>"><span class="label label-info"><?=$data['kat']?></span></a>
</p>
</div>
</div>
<?php }
} else { ?>
    <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Artikel tidak ditemukan. Silahkan cek kembali atau cari berdasarkan kategori.</div>
        <div class="row-fluid">
            <h2>Artikel Populer</h2>
            </div>
            <ul>
            <?php 
            $query = $pdo->prepare('SELECT judul, seo FROM artikel ORDER BY RAND() LIMIT 5');
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);
                echo '<li><a href="'.$row['seo'].'" title="'.$row['judul'].'">'.$row['judul'].'</a></li>'
            ?>
            </ul>
        </div>
    <?php        
    }
}
?> 