<?php 
protect();
if(isset($_POST['kirim']) || isset($_POST['tambah'])) {

	$komen = nl2br($_POST['komen']);
	$uid   = $_POST['uid'];

	if(!empty($_POST['pid'])) {
		$pid = $_POST['pid'];
	} else {
		$pid = '0';
	}
	if(!empty($_POST['email']) && !empty($_POST['nama'])) { 
			$nama  = $_POST['nama'];
			$email  = $_POST['email'];
			$subject = $nama.', Ada komentar di Status Anda';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: SIS LPP Al Irsyad <admin@sis.alirdyadpwt.com>' . "\r\n";

			$status  = '<html><body>';
			$status .= 'Dengan Hormat,<p>Ada Komentar di Status Anda:</p>';
			$status .= '"'.substr($komen, 0, 60).'..."<br />';
			$status .= '<p>Detail silahkan cek di <a href="'.$base.'dashboard">'.$base.'dashboard</a>';
			$status .= '<p>Terima kasih,</p><p>Admin Support</p>';
			$status .= '</body></html>';

			mail($email, $subject, $status, $headers);
	}
			
	$query = $pdo->prepare('INSERT INTO wall (pid, isi, uid) VALUES (?, ?, ?)');
	$query->execute(array($pid, $komen, $uid));

	redirect('/dashboard');
	exit();
}
$uid = $_SESSION['uid'];
$query = $pdo->prepare('SELECT uname, nama, email, foto FROM users WHERE uid=?'); $query->execute(array($uid));
$usr = $query->fetch(PDO::FETCH_ASSOC);
?>
<h2>Wall</h2>
	<div class="row-fluid wall">
		<div class="span1">
			<a href="<?=$base?>profil/<?=$usr['uname']?>" title="<?=$usr['nama']?>"><img class="thumbnail" src="<?php if(!empty($usr['foto'])){ echo '/public/avatar/'.$usr['foto']; } else { echo gravatar($_SESSION['email']); } ?>" width="55" /></a>
		</div>
		<div class="span11">
			<label>Tulis Status</label> 			
			<form class="form" method="post" action="">
					<textarea name="komen" class="input span12" placeholder="Tulis status disini..." onclick="this.placeholder=''"></textarea><br />
					<input type="hidden" name="uid" value="<?=$_SESSION['uid']?>" />
					<input type="submit" name="kirim" value="Kirim" class="btn btn-small btn-primary pull-right" />
			</form>
		</div>	
	</div>
	<fieldset><legend>Status Terbaru</legend>	
	<div class="pesan wall">
		<?php
		$per_page = 5;
		$page_query = $pdo->prepare("SELECT COUNT(wid) FROM wall WHERE pid=0");
		$page_query->execute();
		$result = $page_query->fetchColumn();
		$pages = ceil($result / $per_page);

		if(!empty($_GET['q'])) { $page = (int)$_GET['q']; } else { $page ='1'; }
		$start = ($page - 1) * $per_page;

			$query = $pdo->prepare('SELECT wall.wid as wid, wall.pid as pid, wall.isi as isi, wall.uid as uid, wall.dibuat as dibuat, users.uname as uname, users.nama as nama, users.email as email, users.foto as foto FROM wall INNER JOIN users on users.uid = wall.uid WHERE wall.pid = :pid ORDER BY wall.wid DESC LIMIT :limit, :offset'); 
			$query->bindValue(':pid', 0);
			$query->bindValue(':limit', (int) $start, PDO::PARAM_INT);
			$query->bindValue(':offset', (int) $per_page, PDO::PARAM_INT);
			$query->execute(); 
        	while($wall = $query->fetch(PDO::FETCH_ASSOC)) { 
		?>
		<div class="row-fluid display-komen">
			<div class="span1">
				<img class="thumbnail" src="<?php if(!empty($wall['foto'])){ echo '/public/avatar/'.$wall['foto']; } else { echo gravatar($wall['email']); } ?>" alt="Avatar" width="55" />
			</div>
			<div class="span11">
				<div class="isi"><?php if($_SESSION['uid'] == $wall['uid']) { ?><a class="remove pull-right" href="/status/hapus/<?=$wall['wid']?>" title="Hapus"><i class="icon-remove"></i></a><?php } ?>
				<strong><a href="/profil/<?=$wall['uname'] ?>" title="<?=$wall['nama']?>"><?=$wall['nama']?></a></strong> <?=$wall['isi']?> <span><?=sejak($wall['dibuat']); ?></span></div>
				<div class="komen"><i class="icon-pencil"></i> Tulis Komentar </div>
				<div class="tulis" style="display: none;">
					<form class="form" method="post" action="">
						<textarea name="komen" class="input span12" placeholder="Tulis komentar disini..." onclick="this.placeholder=''"></textarea><br />
						<input type="hidden" name="pid" value="<?=$wall['wid']?>" />
						<input type="hidden" name="uid" value="<?=$_SESSION['uid']?>" />
						<input type="hidden" name="nama" value="<?=$wall['nama']?>" />
						<input type="hidden" name="email" value="<?=$wall['email']?>" />
						<input type="submit" name="tambah" value="Kirim" class="btn btn-small btn-primary pull-right" />
					</form>
				</div>
				<?php
					$wid = $wall['wid'];
					$query2 = $pdo->prepare('SELECT wall.wid as wid, wall.pid as pid, wall.isi as isi, wall.uid as uid, wall.dibuat as dibuat, users.uname as uname, users.nama as nama, users.email as email, users.foto as foto FROM wall INNER JOIN users on users.uid = wall.uid WHERE wall.pid = ? ORDER BY wall.wid ASC'); $query2->execute(array($wid)); 
		        	while($kom = $query2->fetch(PDO::FETCH_ASSOC)) { 
				?>
					<div class="row-fluid display-komen">
					<div class="span1">
						<img class="thumbnail" src="<?php if(!empty($kom['foto'])){ echo '/public/avatar/'.$kom['foto']; } else { echo gravatar($kom['email']); } ?>" alt="Avatar" width="28" />
					</div>
					<div class="span11">
						<div class="isi"><strong><a href="/profil/<?=$kom['uname'] ?>" title="<?=$kom['nama']?>"><?=$kom['nama']?></a></strong> <?=$kom['isi']?>
							<span><?=sejak($kom['dibuat']); ?></span><?php if($_SESSION['uid'] == $kom['uid']) { ?><a class="remove" href="/status/hapus/<?=$kom['wid']?>" title="Hapus"><i class="icon-remove pull-right"></i></a><?php } ?></div>
					</div>
					</div>	
				<?php } ?>

			</div>
		</div>	 

		<?php } 

		if($pages >= 1) {
			for ($x=1; $x<=$pages; $x++) {
				echo '<a class="btn" href="/dashboard/'.$x.'">'.$x.'</a> ';
			}
		}

		?>
		<p />
	</div>
</fieldset>