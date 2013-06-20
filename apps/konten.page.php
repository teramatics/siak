<?php
$kid = $_GET['q'];
$aid = $_GET['r'];
	$query = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, artikel.isi as isi, artikel.foto as foto, artikel.dibuat as dibuat, kategori.kategori as kat, kategori.seo as katseo, users.uid as uid, users.uname as uname, users.nama as posted FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid INNER JOIN users on users.uid = artikel.post_id WHERE kategori.seo = ? and artikel.seo = ?');
	$query->execute(array($kid, $aid));
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="row-fluid">
<div class="span12">
<h2><?=$data['judul']?><span class="h-line"></i></h2>
</div>
</div>
<div class="row-fluid">
<?php if($data['foto']) { echo '<img id="zoom" class="thumbnail span4" src="/public/artikel/'.$data['foto'].'" alt="'.$data['judul'].'">'; } ?>
<?=$data['isi']?>
</div>

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
 <i class="icon-calendar"></i> <?=$data['dibuat']?>
 <i class="icon-tags"></i> Kategori: <a href="<?=$base?>kategori/<?=$data['katseo']?>"><span class="label label-info"><?=$data['kat']?></span></a>
</p>
</div>
</div>
<div class="row-fluid">
    <h2>Artikel Terkait</h2>
    <?=terkait($aid);?>
</div>    
<!-- div class="fb-comments" data-href="http://www.cybermafaza.com" data-width="670" data-num-posts="3"></div -->
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'cybermafaza'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <!-- a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a -->
