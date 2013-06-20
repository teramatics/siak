<?php 
   
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $pass = md5($salt.md5($password).$salt);

    if(empty($email) or empty($password)) {
        redirect('/secure');
        exit();
    } else {
        $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND aktif = ?");

        $query->bindValue(1, $email);
        $query->bindValue(2, $pass);
        $query->bindValue(3, '1');

        $query->execute();

        $user = $query->fetchAll();
        $num = $query->rowCount();

        if($num == 1) {
            foreach ($user as $data) {
            $_SESSION['uid'] = $data['user_id'];
            $_SESSION['unit'] = $data['unit_id'];
            $_SESSION['tipe'] = $data['tipe_id'];
            $_SESSION['loggedin'] = true;
            }
            header('Location: dashboard');
            exit();
        } else {
            $error = 'Email dan Password tidak cocok atau keanggotaan Anda belum aktif. Silahkan cek email aktivasi Anda!';
        }
        redirect('/dashboard');
        exit();
    }
?>
<div class="row-fluid">
		<div class="login">
		<div class="page-header">
		<h3>Member Login</h3>
		</div>
		<?php if(isset($error)) { ?><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?=$error?></div><?php } ?>
        <form class="form-horizontal" id="form" method="post" action="">
			    <div class="control-group">
			    <label class="control-label" for="inputEmail">Email</label>
			    <div class="controls">
			    <input type="text" class="required" name="email" placeholder="Masukan Email" onclick="this.placeholder='';">
			    </div>
			    </div>
			    <div class="control-group">
			    <label class="control-label" for="inputPassword">Password</label>
			    <div class="controls">
			    <input type="password" class="required" name="password" placeholder="Masukan Password" onclick="this.placeholder='';">
			    </div>
			    </div>
			    <div class="control-group">
			    <div class="controls">
			    <button type="submit" name="login" class="mrbtn mrbtn-small">Login</button>
			    </div>
			    </div>
			    <div class="control-group">
			    <div class="controls">
			    	<a href="reset" title="Lupa Password?" />Lupa Password?</a>
			    </div>
			    </div>	
    	</form>
    </div>
</div>