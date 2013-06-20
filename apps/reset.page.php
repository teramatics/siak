<?php 
if(isset($_POST['email'])) {
    
    $email = htmlentities($_POST['email']);
    $password = randompass(6);
    $pass = md5($salt.md5($password).$salt);

    if(!empty($email)) {
        $query = $pdo->prepare("SELECT uid, email FROM users WHERE email = ?");
        $query->bindValue(1, $email);
        $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) { 
        	$uid 	= $row['uid']; 
        	$email 	= $row['email'];
        }
        
        $update = $pdo->prepare('UPDATE users SET password = ? WHERE = ?');
        $update->bindValue(1, $pass);
        $update->bindValue(2, $email);
        $update->execute();

        $pesan = 'DH,<p />';
        $pesan .= 'User ID: '.$uid.'<br />';
        $pesan .= 'Password baru anda: '.$pass;
        $pesan .= '<p />Terima kasih,<p />';
        $pesan .= 'Admin Support';

        mail($email, 'Reset Password:', $pesan, 'From: SIAK LPP AL IRSYAD');

        $error = 'Password baru telah dikirim ke email Anda!';

    } else {
    	$error = 'User ID dengan email '.$email.' tidak ditemukan!';
    }
}        
?>
<div class="page-header">
	<h3>Reset Password</h3>
</div>    
	<?php if(isset($error)) { ?><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?=$error?></div><?php } ?>
	<form class="form-horizontal" id="form" method="post" action="">
		    <div class="control-group">
		    <label class="control-label" for="inputEmail">Email</label>
		    <div class="controls">
		    <input type="text" class="email required" name="email" placeholder="Masukan Email" onclick="this.placeholder='';">
		    </div>
		    </div>
		    <div class="control-group">
		    <div class="controls">
		    <button type="submit" class="btn btn-success"><i class="icon-lock icon-white"></i> Reset Password</button> 
		    </div>
		    </div>
	</form>