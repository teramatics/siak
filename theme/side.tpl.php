<div class="sidebar-nav">
	<?php if(!empty($_SESSION['loggedin']) && $_SESSION['level'] > 0) { ?>
	<div class="well">
		<ul class="nav nav-list">
		  <li class="nav-header">Administrator</li>        
		  <li><a href="/order"><i class="icon-shopping-cart"></i> Pesanan</a></li>
          <li><a href="/produk/kelola"><i class="icon-gift"></i> Produk</a></li>
          <li><a href="/category"><i class="icon-list-alt"></i> Kategori</a></li>
          <li><a href="/halaman"><i class="icon-edit"></i> Halaman</a></li>
          <li><a href="/users"><i class="icon-user"></i> Anggota</a></li>
          <li><a href="/pelanggan"><i class="icon-star"></i> Pelanggan</a></li>
		</ul>
	</div>
	<?php } ?>
	<?php if(!empty($_SESSION['loggedin'])) { ?>
	<div class="well">
		<ul class="nav nav-list">
		  <li class="nav-header">Menu Anggota</li>        
		  <li><a href="/dashboard"><i class="icon-home"></i> Dashboard</a></li>
          <li><a href="/profil"><i class="icon-user"></i> Profilku</a></li>
          <li><a href="/ganti-password"><i class="icon-edit"></i> Ganti Password</a></li>
		  <li><a href="/transaksi"><i class="icon-list-alt"></i> Histori Transaksi</a></li>
          <li class="divider"></li>
          <li><a href="/konfirmasi-pembayaran"><i class="icon-bullhorn"></i> Konfirmasi Pembayaran</a></li>
          <li><a href="/usul"><i class="icon-tint"></i> Usul & Saran Produk</a></li>
		  <li><a href="/logout"><i class="icon-share"></i> Logout</a></li>
		  <li class="divider"></li>
		</ul>
	</div>	  
		<?php } ?>

    <div class="well">
        <ul class="nav nav-list">
            <li><label class="tree-toggler nav-header">Header 1</label>
                <ul class="nav nav-list tree" style="display: none;">
                    <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li><label class="tree-toggler nav-header">Header 1.1</label>
                        <ul class="nav nav-list tree">
                            <li><a href="#">Link</a></li>
                            <li><a href="#">Link</a></li>
                            <li><label class="tree-toggler nav-header">Header 1.1.1</label>
                                <ul class="nav nav-list tree" style="display: none;">
                                    <li><a href="#">Link</a></li>
                                    <li><a href="#">Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
</div>

	<div class="well">
		<ul class="nav nav-list">
		  <li class="nav-header">Kategori</li>
          <?php 
          $query = $pdo->prepare('SELECT kid, parent, kategori, seo FROM kategori WHERE parent = ?'); 
          $query->execute(array('0'));
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?> 
          <li><label class="tree-toggler"><i class="icon-folder-open"></i> <?=$row['kategori']?></label>
          <!-- li><a href="<?=$base.'kategori/'.$row['seo']?>"><?=$row['kategori']?></a -->
	      <?php 
		      $kid= $row['kid'];
		      $kat1 = $base.'kategori/'.$row['seo'];
	          $query2 = $pdo->prepare('SELECT kid, kategori, seo FROM kategori WHERE parent = ?'); 
	          $query2->execute(array($kid));		              
              if($query2) { ?>
              	<ul class="nav nav-list tree" style="display: none;">
              		<?php while ($sub = $query2->fetch(PDO::FETCH_ASSOC)) { ?>
              			<li><label class="tree-toggler"><i class="icon-circle-arrow-right"></i> <?=$sub['kategori']?></label>
	        			<!-- li><a href="<?=$kat1.'/'.$sub['seo']?>"><i class="icon-circle-arrow-right"></i> <?=$sub['kategori']?></a></li -->
	        			<?php 
					      $kid2 = $sub['kid'];
					      $kat2 = $kat1.'/'.$sub['seo'];
				          $query3 = $pdo->prepare('SELECT kategori, seo FROM kategori WHERE parent = ?'); 
				          $query3->execute(array($kid2));		              
			              if($query3) { ?>
			              	<ul class="nav nav-list tree" style="display: none;">
			              		<?php while ($sub2 = $query3->fetch(PDO::FETCH_ASSOC)) { ?>
				        			<li><a href="<?=$kat2.'/'.$sub2['seo']?>"><i class="icon-arrow-right"></i> <?=$sub2['kategori']?></a></li>
				          		<?php } ?>
				          	</ul>
				          <?php } else { ?>
			           </li>
	          		<?php } } ?>
	          	</ul>
	          <?php } else { ?>
           </li>
          <?php } 
  		  } ?>
		</ul>
	</div>
</div>