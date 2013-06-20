<?php
ob_start();
session_start();
$timeout = 60; // Set timeout minutes
$logout_redirect_url = "/"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        header("Location: $logout_redirect_url");
    }
}
$_SESSION['start_time'] = time();

$base = 'http://sis.dev/';
$path = $_SERVER['DOCUMENT_ROOT'];


$config['db'] = array(
		'host'		=> 'localhost',
		'username'	=> 'root',
		'password'	=> 'matics',
		'dbname'	=> 'sis'
	);


include('setting.php');
?>