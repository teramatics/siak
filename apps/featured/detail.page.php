<?php 
$seo = htmlentities($_GET['r']);

	$query = $pdo->prepare("SELECT berita.berita_id as bid, berita.judul as judul, 
			berita.seo as seo, berita.isi as isi, kategori.kategori as kat, berita.tanggal as tgl
			FROM berita 
		   	INNER JOIN kategori on berita.kategori_id = kategori.kategori_id 
		   	WHERE berita.seo = ?");
	$query->bindValue(1, $seo);
	$query->execute();
	$data = $query->fetch(PDO::FETCH_ASSOC);
?>
<h3><?=$data['judul']?></h3>
<span class="label label-success"><?=$data['kat']?></span> <span class="label label-info"><?php echo tgl(substr($data['tgl'], 0, 10)).' - <small>'.substr($data['tgl'], -8);?> WIB</small></span>
<?=$data['isi']?>
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
