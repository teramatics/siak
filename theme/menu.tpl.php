<ul id="nav" class="nav navtop">
  <?php 
    $query = $pdo->prepare('SELECT * FROM menu WHERE pid=0');
    $query->execute();
    while($mn = $query->fetch(PDO::FETCH_ASSOC)) {
  ?>
  <li><a href="<?=$mn['url']?>"><?=$mn['menu']?></a></li>
  <?php } ?>
</ul>