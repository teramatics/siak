<?php
    $seo = $_GET['r'];
    $kat = $pdo->prepare('SELECT kid, kategori FROM kategori WHERE seo = ?');
    $kat->execute(array($seo));
    $kat = $kat->fetch(PDO::FETCH_ASSOC);
?>
<h3>Kategori <?=$kat['kategori']?></h3>
<?php    
    $page  = 1;
    $limit = (int) 5;
    $start = (int) (($page - 1) * $limit);
    $kid = $kat['kid'];  

    $query = $pdo->prepare('SELECT produk.pid as pid, produk.kid as kid, produk.kode as kode, produk.nama as nama, produk.seo as seo, produk.harga as harga, produk.diskon as diskon, produk.stok as stok, produk.image as image, kategori.kategori as kat FROM produk INNER JOIN kategori on kategori.kid = produk.kid WHERE kategori.seo = ?');
        $query->execute(array($seo));
        $num = $query->rowCount();
?>
<ul class="thumbnails">
<?php 
if($num > 0) {
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
    ?>
    <li class="grid">
    <div class="produk thumbnail">
        <?php if($row['diskon'] > 0) { ?><span class="diskon">diskon<br /><span><?=$row['diskon']?>%</span></span><?php } ?>
        <a href="/produk/detail/<?=$row['seo']?>" ><img class="produk-thumb" src="<?=$base?>/filebox/produk/<?=$row['image']?>"  /></a>
        <h6 class="produk"><a href="/produk/detail/<?=$row['seo']?>" ><?=substr($row['nama'], 0, 30)?>..</a></h6>
        <div class="normal"><del>Rp. <?=number_format($row['harga'], '0', ',', '.')?></del></div>
        <div class="jual">Rp. <?=number_format(($row['harga']-($row['diskon']*$row['harga']/100)), '0', ',', '.')?></div>
        <a href="/beli/add/<?=$row['r']?>" class="btn btn-primary"><i class="icon-plus icon-white"></i> Beli</a>
    </div>
    </li>
<?php } 
} else { 
    echo 'Belum ada produk disini'; 
} ?>
</ul>