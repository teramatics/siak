<?php if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == '1' || $_SESSION['akses'] == '2') { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Administrator</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-group"></i></span> TK/PG<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> TK A</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/tk/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/tk/1/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/tk/1/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/tk/1/f"><i class="icon-th"></i> Kelas F</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> TK B</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/tk/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/tk/2/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/tk/2/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/tk/2/f"><i class="icon-th"></i> Kelas F</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> PG A</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/3/b"><i class="icon-th"></i> Kelas B</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> PG B</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/4/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/4/b"><i class="icon-th"></i> Kelas B</a></li>
            </ul>  
      </li> 
    </ul>
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open-alt"></i></span> SD 01<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> Level 1</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/1/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/1/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/1/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/1/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 2</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/2/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/2/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/2/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/2/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 3</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/3/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/3/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/3/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/3/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/3/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/3/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 4</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/4/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/4/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/4/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/4/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/4/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/4/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/4/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 5</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/5/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/5/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/5/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/5/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/5/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/5/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/5/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 6</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd01/6/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd01/6/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd01/6/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd01/6/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd01/6/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd01/6/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd01/6/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>                     
    </ul>
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open"></i></span> SD 02<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> Level 1</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/1/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/1/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/1/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/1/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 2</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/2/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/2/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/2/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/2/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 3</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/3/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/3/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/3/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/3/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/3/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/3/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 4</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/4/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/4/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/4/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/4/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/4/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/4/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/4/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 5</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/5/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/5/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/5/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/5/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/5/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/5/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/5/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> Level 6</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sd02/6/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sd02/6/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sd02/6/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sd02/6/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/sd02/6/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/sd02/6/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/sd02/6/g"><i class="icon-th"></i> Kelas G</a></li>
            </ul>  
      </li>                     
    </ul>
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-star-empty"></i></span> SMP<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> Level 1</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/smp/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/smp/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/smp/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/smp/1/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/smp/1/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/smp/1/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/smp/1/g"><i class="icon-th"></i> Kelas G</a></li>
              <li><a href="/siswa/smp/1/h"><i class="icon-th"></i> Kelas H</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 2</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/smp/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/smp/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/smp/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/smp/2/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/smp/2/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/smp/2/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/smp/2/g"><i class="icon-th"></i> Kelas G</a></li>
              <li><a href="/siswa/smp/2/h"><i class="icon-th"></i> Kelas H</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 3</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/smp/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/smp/3/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/smp/3/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/smp/3/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/smp/3/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/smp/3/f"><i class="icon-th"></i> Kelas F</a></li>
              <li><a href="/siswa/smp/3/g"><i class="icon-th"></i> Kelas G</a></li>
              <li><a href="/siswa/smp/3/h"><i class="icon-th"></i> Kelas H</a></li>
            </ul>  
      </li> 
    </ul>
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-star"></i></span> SMA<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> Level 1</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sma/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sma/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sma/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sma/1/d"><i class="icon-th"></i> Kelas D</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 2</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sma/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sma/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sma/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sma/2/d"><i class="icon-th"></i> Kelas D</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> Level 3</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/sma/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/sma/3/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/sma/3/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/sma/3/d"><i class="icon-th"></i> Kelas D</a></li>
            </ul>  
      </li> 
    </ul>
  </li>        
</ul> 
<ul class="sidebar-menu">
  <li class="nav-header">Pengaturan</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-cogs"></i></span> Pengaturan Data<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><a href="/lpp/personalia"><i class="icon-user"></i> Personalia</a></li>
      <li><a href="/pengajar"><i class="icon-group"></i> Pengajar</a></li>
      <li><a href="/unit"><i class="icon-sign-blank"></i> Unit/Sekolah</a></li>
      <li><a href="/level"><i class="icon-th-large"></i> Level</a></li>
      <li><a href="/kelas"><i class="icon-th"></i> Kelas</a></li>
    </ul>
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-random"></i></span> Migrasi Data<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><a href="/lpp/siswa"><i class="icon-th-large"></i> Siswa</a></li>
      <li><a href="/lpp/guru"><i class="icon-th-large"></i> Pengajar</a></li>
      <li><a href="/lpp/pegawai"><i class="icon-th-large"></i> Pegawai</a></li>
    </ul>
  </li>  
</ul>   
<?php } else if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 3) { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Admin TK/PG</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-group"></i></span> TK/PG<span class="arrow"></span></label>
    <ul class="sub" style="display: none;">
      <li><label class="tree"><i class="icon-th-large"></i> TK A</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/1/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/1/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/tk/1/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/tk/1/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/tk/1/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/tk/1/f"><i class="icon-th"></i> Kelas F</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> TK B</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/2/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/2/b"><i class="icon-th"></i> Kelas B</a></li>
              <li><a href="/siswa/tk/2/c"><i class="icon-th"></i> Kelas C</a></li>
              <li><a href="/siswa/tk/2/d"><i class="icon-th"></i> Kelas D</a></li>
              <li><a href="/siswa/tk/2/e"><i class="icon-th"></i> Kelas E</a></li>
              <li><a href="/siswa/tk/2/f"><i class="icon-th"></i> Kelas F</a></li>
            </ul>  
      </li>
      <li><label class="tree"><i class="icon-th-large"></i> PG A</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/3/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/3/b"><i class="icon-th"></i> Kelas B</a></li>
            </ul>  
      </li> 
      <li><label class="tree"><i class="icon-th-large"></i> PG B</label>
            <ul class="subtree" style="display: none;">
              <li><a href="/siswa/tk/4/a"><i class="icon-th"></i> Kelas A</a></li>
              <li><a href="/siswa/tk/4/b"><i class="icon-th"></i> Kelas B</a></li>
            </ul>  
      </li> 
    </ul>
  </li>              
</ul> 
<?php } else if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 4) { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Admin SD 01</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-user"></i></span> Level 1<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sd01/1/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/1/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/1/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/1/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/1/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/1/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/1/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-group"></i></span> Level 2<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sd01/2/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/2/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/2/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/2/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/2/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/2/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/2/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-close-alt"></i></span> Level 3<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd01/3/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/3/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/3/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/3/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/3/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/3/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/3/g"><i class="icon-th"></i> Kelas G</a></li>>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-close"></i></span> Level 4<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd01/4/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/4/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/4/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/4/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/4/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/4/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/4/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open-alt"></i></span> Level 5<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd01/5/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/5/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/5/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/5/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/5/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/5/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/5/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open"></i></span> Level 6<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd01/6/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd01/6/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd01/6/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd01/6/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd01/6/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd01/6/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd01/6/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
</ul>
<?php } else if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 5) { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Admin SD 02</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-user"></i></span> Level 1<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sd02/1/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/1/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/1/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/1/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/1/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/1/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/1/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-group"></i></span> Level 2<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sd02/2/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/2/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/2/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/2/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/2/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/2/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/2/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-close-alt"></i></span> Level 3<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd02/3/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/3/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/3/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/3/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/3/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/3/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/3/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-close"></i></span> Level 4<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd02/4/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/4/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/4/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/4/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/4/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/4/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/4/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open-alt"></i></span> Level 5<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd02/5/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/5/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/5/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/5/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/5/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/5/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/5/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li> 
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open"></i></span> Level 6<span class="arrow"></span></label>
        <ul class="subtree" style="display: none;">
          <li><a href="/siswa/sd02/6/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sd02/6/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sd02/6/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sd02/6/d"><i class="icon-th"></i> Kelas D</a></li>
          <li><a href="/siswa/sd02/6/e"><i class="icon-th"></i> Kelas E</a></li>
          <li><a href="/siswa/sd02/6/f"><i class="icon-th"></i> Kelas F</a></li>
          <li><a href="/siswa/sd02/6/g"><i class="icon-th"></i> Kelas G</a></li>
        </ul>  
  </li>
</ul>
<?php } else if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 6) { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Admin SMP</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-user"></i></span> Level 1<span class="arrow"></span></label>
      <ul class="sub" style="display: none;">
        <li><a href="/siswa/smp/1/a"><i class="icon-th"></i> Kelas A</a></li>
        <li><a href="/siswa/smp/1/b"><i class="icon-th"></i> Kelas B</a></li>
        <li><a href="/siswa/smp/1/c"><i class="icon-th"></i> Kelas C</a></li>
        <li><a href="/siswa/smp/1/d"><i class="icon-th"></i> Kelas D</a></li>
        <li><a href="/siswa/smp/1/e"><i class="icon-th"></i> Kelas E</a></li>
        <li><a href="/siswa/smp/1/f"><i class="icon-th"></i> Kelas F</a></li>
        <li><a href="/siswa/smp/1/g"><i class="icon-th"></i> Kelas G</a></li>
        <li><a href="/siswa/smp/1/h"><i class="icon-th"></i> Kelas H</a></li>
      </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-group"></i></span> Level 2<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
        <li><a href="/siswa/smp/2/a"><i class="icon-th"></i> Kelas A</a></li>
        <li><a href="/siswa/smp/2/b"><i class="icon-th"></i> Kelas B</a></li>
        <li><a href="/siswa/smp/2/c"><i class="icon-th"></i> Kelas C</a></li>
        <li><a href="/siswa/smp/2/d"><i class="icon-th"></i> Kelas D</a></li>
        <li><a href="/siswa/smp/2/e"><i class="icon-th"></i> Kelas E</a></li>
        <li><a href="/siswa/smp/2/f"><i class="icon-th"></i> Kelas F</a></li>
        <li><a href="/siswa/smp/2/g"><i class="icon-th"></i> Kelas G</a></li>
        <li><a href="/siswa/smp/2/h"><i class="icon-th"></i> Kelas H</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open"></i></span> Level 3<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
        <li><a href="/siswa/smp/3/a"><i class="icon-th"></i> Kelas A</a></li>
        <li><a href="/siswa/smp/3/b"><i class="icon-th"></i> Kelas B</a></li>
        <li><a href="/siswa/smp/3/c"><i class="icon-th"></i> Kelas C</a></li>
        <li><a href="/siswa/smp/3/d"><i class="icon-th"></i> Kelas D</a></li>
        <li><a href="/siswa/smp/3/e"><i class="icon-th"></i> Kelas E</a></li>
        <li><a href="/siswa/smp/3/f"><i class="icon-th"></i> Kelas F</a></li>
        <li><a href="/siswa/smp/3/g"><i class="icon-th"></i> Kelas G</a></li>
        <li><a href="/siswa/smp/3/h"><i class="icon-th"></i> Kelas H</a></li>
        </ul>  
  </li>
</ul>  
<?php } else if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 7) { ?>
<ul class="sidebar-menu">
  <li class="nav-header">Admin SMA</li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-user"></i></span> Level 1<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sma/1/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sma/1/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sma/1/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sma/1/d"><i class="icon-th"></i> Kelas D</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open"></i></span> Level 2<span class="arrow"></span></label>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sma/2/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sma/2/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sma/2/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sma/2/d"><i class="icon-th"></i> Kelas D</a></li>
        </ul>  
  </li>
  <li><label class="has-sub"><span class="icon-box"><i class="icon-folder-open-alt"></i></span> Level 3<span class="arrow"></span></label>l>
        <ul class="sub" style="display: none;">
          <li><a href="/siswa/sma/3/a"><i class="icon-th"></i> Kelas A</a></li>
          <li><a href="/siswa/sma/3/b"><i class="icon-th"></i> Kelas B</a></li>
          <li><a href="/siswa/sma/3/c"><i class="icon-th"></i> Kelas C</a></li>
          <li><a href="/siswa/sma/3/d"><i class="icon-th"></i> Kelas D</a></li>
        </ul>  
  </li>      
</ul>
<?php } ?>
<?php if(!empty($_SESSION['loggedin']) && $_SESSION['akses'] == 0) { ?>
<ul class="sidebar-menu"> 
    <li class="nav-header">Akademik</li>     
    <li><a href="/absensi/<?=$_SESSION['uname']?>"><i class="icon-calendar"></i> Absensi</a></li>
    <li><a href="/jadwal/<?=$_SESSION['uname']?>"><i class="icon-table"></i> Jadwal Pelajaran</a></li>
    <li><a href="/pengajar/<?=$_SESSION['uname']?>"><i class="icon-th-list"></i> Pengajar</a></li>
    <li><a href="/kurikulum/<?=$_SESSION['uname']?>"><i class="icon-pencil"></i> Struktur Kurikulum</a></li>
    <li><a href="/nilai/<?=$_SESSION['uname']?>"><i class="icon-list-alt"></i> Nilai</a></li>
    <li><a href="/keuangan/<?=$_SESSION['uname']?>"><i class="icon-money"></i> Keuangan</a></li>
</ul>    
<?php } ?>  
<?php if(!empty($_SESSION['loggedin'])) { ?>
<ul class="sidebar-menu">
    <li class="nav-header">Menu Anggota</li>        
    <li><a href="/dashboard"><i class="icon-dashboard"></i> Dashboard</a></li>
    <li><a href="/profil/<?=$_SESSION['uname']?>"><i class="icon-user"></i> Profilku</a></li>
    <li><a href="/profil/edit/<?=$_SESSION['uname']?>"><i class="icon-pencil"></i> Edit Profil</a></li>
    <li><a href="/ganti-password"><i class="icon-edit"></i> Ganti Password</a></li>
    <li><a href="/logout"><i class="icon-share"></i> Logout</a></li>
</ul> 
<?php } else { ?>  
<ul class="sidebar-menu">
    <?php 
      $query = $pdo->prepare('SELECT * FROM menu WHERE pid=0');
      $query->execute();
      while($mn = $query->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <li><a href="<?=$mn['url']?>"><i class="icon-th-large"></i> <?=$mn['menu']?></a></li>
    <?php } ?>
</ul>
<?php } ?> 