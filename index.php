<?php
include('settings/config.php');
include('theme/header.tpl.php');

$apps_dir = 'apps';

  if(!empty($_GET['p'])) {
    $apps = scandir($apps_dir, 0);
    unset($apps[0], $apps[1]);

    $p = $_GET['p'];

    if(in_array($p.'.page.php', $apps)) {
      include($apps_dir.'/'.$p.'.page.php');
    } else {
      redirect('/404');
      exit();
      //echo '<h2>Error 404</h2><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>Maaf, halaman tidak ditemukan!.</div>';
    }
  } else {
    include($apps_dir.'/dashboard.page.php');
  }

include('theme/footer.tpl.php');
?>