<!DOCTYPE html>
<html><head>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIS - LPP AL IRSYAD PURWOKERTO</title> 
  <meta name="description" content="Sistem Informasi Sekolah LPP Al Irsyad Al Islamiyyah Purwokerto">
  <meta name="keywords" content="al irsyad, lpp, purwokerto, sekolah, sd it, smp it, sma it, sekolah para juara">
  <meta property="og:title" content="SIS - LPP AL IRSYAD PURWOKERTO"/>
  <meta property="og:description"content="Sistem Informasi Sekolah LPP Al Irsyad Al Islamiyyah Purwokerto"/>
  <meta name="author" content="Munawar">    

  <link href="<?=$base?>theme/css/bootstrap.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/font-awesome.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/redactor.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/jquery.dataTables.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/jquery.autocomplate.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/bootstrap-tables.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/datepicker.css" rel="stylesheet">
  <link href="<?=$base?>theme/css/style.css" rel="stylesheet">

  <link rel="shortcut icon" href="<?=$base?>theme/images/favicon.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base?>theme/images/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base?>theme/images/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base?>theme/images/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png"> 
</head>
<body>
<div id="header" class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <a href="/" class="brand">
        <img alt="SIS LPP" src="<?=$base?>theme/images/logo.png">
      </a>
        <?php require('menu.tpl.php');?>
        <ul class="nav-top pull-right">
          <?php if(!empty($_SESSION['loggedin'])) { ?>
                <div class="btn-group pull-right">
                  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user icon-white"></i> <?=$_SESSION['email']?> <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="/dashboard"><i class="icon-list"></i> Dashboard</a></li>
                    <li><a href="/profil/<?=$_SESSION['uname']?>"><i class="icon-list-alt"></i> Profil</a></li>
                    <li><a href="/logout"><i class="icon-share"></i> Logout</a></li>
                  </ul>
                </div>
                <?php } else { ?>
          <li><a class="btn btn-primary" href="/login">Login</a></li>
          <?php } ?>
        </ul>
    </div>
  </div>
</div>

<div class="row-fluid">
    <?php if(substr($_SERVER['REQUEST_URI'], 1) != 'secure') { ?>  
    <div id="sidebar">
      <?php include('leftside.tpl.php');?>
    </div>
    <div class="main span8">
    <?php } ?>  