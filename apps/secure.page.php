<?php 
if(isset($_POST['login'])) {
    
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $pass = md5($salt.md5($password).$salt);

    if(empty($email) or empty($password)) {
        $error = 'Email dan Password harus diisi!';
    } else {
        $query = $pdo->prepare("SELECT * FROM users WHERE (uname = ? OR email = ?) AND password = ?");

        $query->bindValue(1, $email);
        $query->bindValue(2, $email);
        $query->bindValue(3, $pass);

        $query->execute();

        $user = $query->fetchAll();
        $num = $query->rowCount();

        if($num == 1) {
            foreach ($user as $data) {
            $_SESSION['uid'] = $data['uid'];
            $_SESSION['uname'] = $data['uname'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['akses'] = $data['akses'];
            $_SESSION['loggedin'] = true;
            }
            redirect('/dashboard');
            exit();
        } else {
            $error = 'Email dan Password tidak cocok atau keanggotaan Anda belum aktif. Silahkan cek email aktivasi Anda!';
        }
    }
}
  

?>
	<div class="alert alert-info span4" style="position: fixed; top: 70px; right: 10px; width: 320px;z-index: 999;"><button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Data Login Administrator</h4>
			<table class="table">
				<tr><th>Unit</td><th>ID User</th><th>Email</th></tr>
				<tr>
					<td>LPP</td>
					<td>102030</td>
					<td>admin@alirsyadpwt.com</td>
				</tr>	
				<tr>
					<td>TK/PG</td>
					<td>203040</td>
					<td>tk@alirsyadpwt.com</td>
				</tr>
				<tr>
					<td>SD 01</td>
					<td>304050</td>
					<td>sd01@alirsyadpwt.com</td>
				</tr>
				<tr>
					<td>SD 02</td>
					<td>405060</td>
					<td>sd02@alirsyadpwt.com</td>
				</tr>
				<tr>
					<td>SMP</td>
					<td>506070</td>
					<td>smp@alirsyadpwt.com</td>
				</tr>
				<tr>
					<td>SMA</td>
					<td>607080</td>
					<td>sma@alirsyadpwt.com</td>
				</tr>
			</table>Password silahkan konfirmasi ke admin LPP																			
	</div>
<div id="login">
	<?php if(!empty($error)) { ?><div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><p><?=$error?></p></div><?php } ?>
	<form class="form-vertical no-padding no-margin" id="loginform" method="post" action="">
		<div class="lock">
			<i class="icon-lock"></i>
		</div>
		<div class="control-wrap">
			<h2>User Login</h2>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on">
							<i class="icon-user"></i>
						</span>
						<input type="text" name="email" placeholder="ID User atau email" id="input-username">
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on">
							<i class="icon-key"></i>
						</span>
						<input type="password" name="password" placeholder="Password" id="input-password">
					</div>
					<div class="mtop10">
						<div class="block-hint pull-left small">
						</div>
							<div class="block-hint pull-right">
								<a id="forget-password" class="" href="/reset">Lupa Password?</a>
							</div>
						</div>
						<div class="clearfix space5"></div>
					</div>
				</div>
			</div>
			<input type="submit" name="login" value="Login" class="btn btn-block btn-primary">
		</form>
</div>