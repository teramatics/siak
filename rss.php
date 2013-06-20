<?php
include('settings/config.php');
    //SET XML HEADER
    header('Content-type: text/xml');
 
    //CONSTRUCT RSS FEED HEADERS
    $output  = '<rss version="2.0">';
    $output .= '<channel>';
    $output .= '<title>Cybermafaza.com</title>';
    $output .= '<description>perekat ukhuwah islamiyyah</description>';
    $output .= '<image><url>'.$base.'theme/images/logo_rss.png</url><title>Cybermafaza.com</title><link>'.$base.'</link></image>';
    $output .= '<link>'.$base.'</link>';
    $output .= '<copyright>2013 - Cybermafaza.com</copyright>';

	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.isi as isi, artikel.foto as foto, artikel.dibuat as dibuat, kategori.seo as katseo FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid WHERE artikel.publish=1 ORDER BY aid DESC LIMIT 0, 10');
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {	 
    $isi = substr(strip_tags($row['isi']), 0, 200); 
    $img = $base.'/public/artikel/thumb/'.$row['foto'];
    $kat = $row['katseo'];
    $seo = $row['seo'];
    $tgl = $row['dibuat'];

    //BODY OF RSS FEED
   $output .= '<item>';
        $output .= '<title>'.$row['judul'].'</title>';
        $output .= '<description><![CDATA[<img align="left" hspace="5" src="'.$img.'" width="65" />'.$isi.']]></description>';
        $output .= '<link>'.$base.'konten/'.$kat.'/'.$seo.'</link>';
        $output .= '<pubDate>'.$tgl.'</pubDate>';
   $output .= '</item> ';
 	}
    //CLOSE RSS FEED
   $output .= '</channel>';
   $output .= '</rss>';
 
    //SEND COMPLETE RSS FEED TO BROWSER
    echo($output);
?>