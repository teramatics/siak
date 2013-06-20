<?php

$ver = '0.2';
try {
$pdo = new PDO('mysql:host='.$config['db']['host'].';dbname='.$config['db']['dbname'], $config['db']['username'], $config['db']['password']);
} catch (PDOException $e) {
	exit('Database error!.');
}

function seo($title) {
    return preg_replace('/[^a-z0-9_-]/i', '', strtolower(str_replace(' ', '-', trim($title))));
}
function tgl($date){
		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");
	
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
		return($result);
}
function redirect($url)
{
	if (!headers_sent())
	{    
		header('Location: '.$url);
		exit;
		}
	else
		{  
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
		echo '</noscript>'; exit;
	}
}


function protect() {
	if (empty($_SESSION['loggedin'])) {
		redirect('/secure');
		exit();
	}
}

function akses() {
	if($_SESSION['level'] <> '1' || $_SESSION['level'] <> '2') {
		redirect('/denied');
		exit();
	} else if (empty($_SESSION['loggedin'])) {
		redirect('/secure');
		exit();
	}
}

function emailCek($email) {
	global $pdo;
	$query = $pdo->prepare('SELECT email FROM users WHERE email = ?'); 
	$query->bindValue(1, $email, PDO::PARAM_STR); 
	$query->execute();
	$query->rowCount();

	return $query->rowCount() > 0;
}
function unameCek($uname) {
	global $pdo;
	$query = $pdo->prepare('SELECT uname FROM users WHERE uname = ?'); 
	$query->bindValue(1, $uname, PDO::PARAM_STR); 
	$query->execute();
	$query->rowCount();

	return $query->rowCount() > 0;
}
function allowed_image($file_name) {
	$allowed_ext	= array('jpg', 'jpeg', 'png','gif');
	$array 			= explode('.', $file_name);
	$file_ext		= end($array);

	return (in_array($file_ext, $allowed_ext) == true) ? true : false;
}

function watermark_image($file, $destination) {
	$watermark 		= imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/public/images/cybermafaza.png');

	$source 		= getimagesize($file);
	$source_mime 	= $source['mime'];

	if($source_mime == 'image/png') {
		$image = imagecreatefrompng($file);
	} else if($source_mime == 'image/jpeg') {
		$image = imagecreatefromjpeg($file);
	} else if($source_mime == 'image/gif') {
		$image = imagecreatefromgif($file);
	}

	$imagewidth = imagesx($image); 
	$imageheight = imagesy($image);  
	$watermarkwidth =  imagesx($watermark); 
	$watermarkheight =  imagesy($watermark); 
	$startwidth = (($imagewidth - $watermarkwidth)/2); 
	$startheight = (($imageheight - $watermarkheight)/2);

	imagecopy($image, $watermark, $startwidth, $startheight, 0, 0, imagesx($watermark), imagesy($watermark));
	imagepng($image, $destination);
}
function thumbnail($path_to_image_directory, $path_to_thumbs_directory, $filename, $final_width_of_image) {
     
    if(preg_match('/[.](jpg)$/', $filename)) {
    	$im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', $filename)) {
    	$im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
    	$im = imagecreatefrompng($path_to_image_directory . $filename);
    }
     
    $ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));
     
    $nm = imagecreatetruecolor($nx, $ny);
     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
    imagejpeg($nm, $path_to_thumbs_directory . $filename);
}


function randompass($length) {

	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	return substr(str_shuffle($chars),0,$length);

}
function title() {
	if(substr($_SERVER['REQUEST_URI'], 1) === 'secure') {
		echo 'Login Member - ';
	} else if(substr($_SERVER['REQUEST_URI'], 1) === 'dashboard') {
		echo 'Dashboard - ';
	} else {
		echo 'CyberMafaza.com - Portal Masjid Fatimatuzzahra Purwokerto';
	}		
}

$start = microtime(true);
$y = 0;
	for($x=0;$x<=1000000;$x++) {
		$y = $x;
	}
	$load = number_format((microtime(true) - $start), 2);

$dev = '<a href="http://www.teramatics.com" title="Developed by Teramatics Indonesia" target="_blank">SIS ver. '.$ver.'</a>';

$salt = '1I3TTAIioG8PJkiyMd83Kc6Xya6I00v7';

function gravatar($email) {
	$url = 'http://www.gravatar.com/avatar/';
	$email = $email;
	$default = 'wavatar';
	$size = 85;
	 
	$grav_url = $url.'?gravatar_id='.md5(strtolower($email)).'&default='.urlencode($default).'&size='.$size;

	return $grav_url;
}

function terkait($seo)
{
    // batas threshold 40%
    $threshold = 40;
    $maksartikel = 5;
    $listartikel = array();

    global $pdo;
    $query = $pdo->prepare('SELECT judul FROM artikel WHERE seo = ?');
	$query->execute(array($seo));
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$judul = $row['judul'];

	$query2 = $pdo->prepare('SELECT artikel.judul as judul, artikel.seo as seo, kategori.seo as katseo FROM artikel INNER JOIN kategori on kategori.kid = artikel.kid WHERE artikel.seo <> ?');
    $query2->execute(array($seo));
	while($data = $query2->fetch(PDO::FETCH_ASSOC)) {
        similar_text($judul, $data['judul'], $percent);
        if ($percent >= $threshold)
        {
            if (count($listartikel) <= $maksartikel)
            {
               // jika jumlah artikel belum sampai batas maksimum, tambahkan ke dalam array
              $listartikel[] = '<li><a href="/konten/'.$data['katseo'].'/'.$data['seo'].'">'.$data['judul'].'</a></li>';
             }
        }
    }	

    if (count($listartikel) > 0)
    {
    	echo '<ul class="terkait">';
        for ($i=0; $i<=count($listartikel)-1; $i++)
        {
            echo $listartikel[$i];
        }
        echo '</ul>';
    } else {
    	echo "<p>Belum ada artikel terkait</p>";
    }	
}
/*************  date ************/

function sejak($ptime) {
	$atime = strtotime($ptime);
    $etime = time() - $atime;

    if ($etime < 60) {
        return 'kurang dari 1 menit yang lalu';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'tahun yang lalu',
            30 * 24 * 60 * 60       =>  'bulan yang lalu',
            24 * 60 * 60            =>  'hari yang lalu',
            60 * 60                 =>  'jam yang lalu',
            60                      =>  'menit uang lalu'
            //1                       =>  'detik'
            );

foreach ($a as $secs => $str) {
    $d = $etime / $secs;
    if ($d >= 1) {
        $r = round($d);
        return $r . ' ' . $str . ($r > 1 ? '' : '');
    }
}
}

function intro() {
	global $pdo;
	$query = $pdo->prepare('SELECT intro FROM settings');
    $query->execute();
    $stg = $query->fetch(PDO::FETCH_ASSOC);
    $intro = $stg['intro'];
    return $intro;
}
?>