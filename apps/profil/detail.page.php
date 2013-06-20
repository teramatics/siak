<?php 
protect();
    $pid = $_GET['r'];
    $query = $pdo->prepare('SELECT users.uid as uid, users.nama as nama, users.email as email, profil.alamat as alamat, profil.kota as kota, profil.provinsi as provinsi, profil.negara as negara, profil.telp as telp FROM users INNER JOIN profil on users.uid = profil.uid WHERE users.uname = ?');
    $query->execute(array($pid)); 
    $pro = $query->fetch(PDO::FETCH_ASSOC);  
?>
<h3>Profilku <a href="/profil/edit/<?=$pro['uid']?>" title="Edit Data Profil"><small><i class="icon-edit"></i> Edit</a></small></h3>
<?php echo 'p: '.$_GET['p'].'<br />q: '.$_GET['q'].'<br />r: '.$_GET['r']; ?>
<table class="table">
    <tr><td class="span2">Nama Lengkap</td><td>: <?=$pro['nama']?></td></tr>
    <tr><td>Email</td><td>: <?=$pro['email']?></td></tr>
    <tr><td>Alamat Lengkap</td><td>: <?=$pro['alamat']?></td></tr>
    <tr><td>Kota</td><td>:  
    <?php 
        $query = $pdo->prepare("SELECT kid, kota FROM kota WHERE kid = ?");
        $query->execute(array($pro['kota'])); 
        $row = $query->fetch(PDO::FETCH_ASSOC); 
        echo $row['kota'];
        ?>
    </td></tr>
    <tr><td>Provinsi</td><td>:  
    <?php 
        $query = $pdo->prepare("SELECT pid, provinsi FROM provinsi WHERE pid = ?"); 
        $query->execute(array($pro['provinsi'])); 
        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo $row['provinsi'];
    ?>  
    </td></tr>
    <tr><td>Negara</td><td>:
    <?php 
        $query = $pdo->prepare("SELECT nid, negara FROM negara WHERE nid = ?"); 
        $query->execute(array($pro['negara'])); 
        $row = $query->fetch(PDO::FETCH_ASSOC);
        echo $row['negara']; 
    ?>  
</td></tr>
<tr><td>HP.</td><td>: <?=$pro['telp']?></td></tr>
</table>