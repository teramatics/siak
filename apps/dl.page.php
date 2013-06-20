<?PHP

protect();
 $link = $_GET['q'];
 
 $query = $pdo->prepare('SELECT file FROM download WHERE link=?');
 $query->execute(array($link));

 $dl = $query->fetch(PDO::FETCH_ASSOC);

 $file = $dl['file'];
 $download = $base.'public/download/'.$dl['file'];
 if(!$dl)
 {
     redirect('/404');
 }
 else
 {
     // Set headers
     header("Cache-Control: public");
     header("Content-Description: File Transfer");
     header("Content-Disposition: attachment; filename=$file");
     header("Content-Type: application/zip");
     header("Content-Transfer-Encoding: binary");
     header("Location: $download");
    
     // Read the file from disk
     //readfile($download);
 }
 ?>