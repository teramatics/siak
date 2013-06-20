<?php
include('settings/config.php');
header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">';

	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.dibuat as dibuat, kategori.seo as katseo FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid ORDER BY artikel.aid DESC');
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $tgl = $row['dibuat'];	
    $kat = $row['katseo'];
    $seo = $row['seo'];

	echo '<url>
			<loc>'.$base.'konten/'.$kat.'/'.$seo.'</loc>
			<lastmod>'.$tgl.'</lastmod>
			<changefreq>hourly</changefreq>
			<priority>0.5</priority>
		  </url>';
     }
echo '</urlset>';
?>