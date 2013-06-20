<?php if(substr($_SERVER['REQUEST_URI'], 1) != 'secure') { ?>  
    </div>
<?php } ?>    
</div> 
<footer class="footerwrapper">
  <div class="copyright">
    <div class="row-fluid container">
      <div class="span8">
      <?php 
        $query = $pdo->prepare("SELECT * FROM settings"); $query->execute(); 
        $stg = $query->fetch(PDO::FETCH_ASSOC);
      ?>
      &copy; <?php if(date('Y') === '2013') { echo date('Y'); } else { echo '2013 - '.date('Y'); } ?> - <?=$stg['nama']?>, LPP Al Irsyad Al Islamiyyah Purwokerto. <small>Loading page: <?php echo $load; ?> detik, <?=$dev;?></small>
      </div>
      <div class="span4">
        <div class="sc">
          <a class="facebook" target="_blank" href="<?=$stg['facebook']?>" title="Facebook">Facebook</a>
          <a class="twitter" target="_blank" href="<?=$stg['twitter']?>" title="Twitter">Twitter</a>
          <a class="rss" target="_blank" href="<?=$stg['rss']?>" title="RSS">RSS</a>
        </div>
      </div>  
    </div>
  </div>  
</footer>                  
  <script src="<?=$base?>theme/js/jquery.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/bootstrap-datepicker.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/jquery.validate.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/jquery.elevateZoom.min.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/redactor.min.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/jquery.dataTables.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/jquery.placeholder.min.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/selectnav.js" type="text/javascript"></script>
  <script src="<?=$base?>theme/js/script.js" type="text/javascript"></script>
  
  <script type="text/javascript" charset="utf-8">

    $('#slideshow').carousel({
      interval: 5000
    });
    
    $('input, textarea').placeholder();

      $("#zoom, #zoomthumb").elevateZoom({
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 500,
        lensFadeIn: 500,
        lensFadeOut: 500
      });

    $(function(){
          $('#tanggal, #tanggal1, #tanggal2, #tanggal3, #tanggal4, #tanggal5').datepicker();  
    }); 

    selectnav('nav');
   
</script>
</body>
</html>