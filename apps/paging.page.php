<?php 

$per_page = 5;
$page_query = $pdo->prepare("SELECT COUNT(uid) FROM users");
$page_query->execute();
$result = $page_query->fetchColumn();
$pages = ceil($result / $per_page);

if(!empty($_GET['q'])) { $page = (int)$_GET['q']; } else { $page ='1'; }
$start = ($page - 1) * $per_page;

$query = $pdo->prepare("SELECT nama FROM users LIMIT $start, $per_page");
$query->execute();

while($query_row = $query->fetch(PDO::FETCH_ASSOC)) {
	echo '<p>'. $query_row['nama']. '</p>';
}

if($pages >= 1) {
	for ($x=1; $x<=$pages; $x++) {
		echo '<a class="btn" href="/paging/'.$x.'">'.$x.'</a> ';
	}
}
?>