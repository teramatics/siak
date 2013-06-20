<?php 
$seo = htmlentities($_GET['r']);

	$query = $pdo->prepare('SELECT download.did as did, download.judul as judul, download.seo as seo, download.isi as isi, download.file as file, download.link as link, download.dibuat as tgl, kategori.kategori as kat, kategori.seo as kseo, users.uid as uid, users.uname as uname, users.nama as posted FROM download INNER JOIN kategori on kategori.kid = download.kid INNER JOIN users on users.uid = download.post_id WHERE download.seo = ?');
	$query->bindValue(1, $seo);
	$query->execute();
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2><?=$data['judul']?></h2>
<?=$data['isi']?>
<div class="download"><a href="/dl/<?=$data['link']?>" title="Download File <?=$data['file']?>"><i class="icon-download-alt"></i> Download File Format <?=substr($data['file'], -4, 4);?></a></div>

<div class="row-fluid">
<div class="span12">
<p></p>
<div class="share">
	<!-- span class='st_sharethis_hcount' displayText='ShareThis'></span -->
	<span class='st_facebook_hcount' displayText='Facebook'></span>
	<span class='st_twitter_hcount' displayText='Tweet'></span>
	<span class='st_linkedin_hcount' displayText='LinkedIn'></span>
	<!-- span class='st_pinterest_hcount' displayText='Pinterest'></span -->
	<span class='st_email_hcount' displayText='Email'></span>
</div>	
<p>
<i class="icon-user"></i> Ditulis oleh <a href="<?=$base?>profil/<?=$data['uname']?>"><?=$data['posted']?></a>
 <i class="icon-calendar"></i> <?=$data['tgl']?>
 <i class="icon-tags"></i> Kategori: <a href="<?=$base?>kategori/<?=$data['katseo']?>"><span class="label label-info"><?=$data['kat']?></span></a>
</p>
</div>
</div>