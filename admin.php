 <?php 
			session_start();
			ob_start();
			// Admin Panel şifrsi;
			$sifre123="123";
			if(!$_SESSION["gir_s"]=="1ykk2"){
			  if(isset($_POST["sifre"])){
			    if($_POST["sifre"]==$sifre123){
			      $_SESSION["gir_s"]="1ykk2";
			      header("Location:admin.php"); 
			    }else{
			      echo "hatalı şifre!";
			    }
			  }
			  ?>
			  <form action="" method="post">
			      <span>Şifre:</span>
			      <input type="text" name="sifre">
			      <input type="submit" name="g">
			  </form>
			  <?php
			  exit();
			}?><!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title><link href="style.css" rel="stylesheet">
 	<link href="bootstrap.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
 </head>
 <body>
  
    <center>
        <br>
        <a href="?islem=belirle" data-toggle="tooltip" class="btn btn-danger">KAZANANI BELİRLE</a>&nbsp; <a href="?islem=sifirla" data-toggle="tooltip" class="btn btn-danger">ÇEKİLİŞİ SIFIRLA</a>&nbsp; <a href="index.php" target="_blank" data-toggle="tooltip" class="btn btn-danger">KATILIM SAYFASI</a>
        <br>
       
<?php
			
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'admin';

			try{
				$conn = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
			} catch(PDOException $e){
				die( "Bağlantı sağlanamadı: " . $e->getMessage());
			}

			if($is=$_GET["islem"]){
				if ($is=="sifirla") {
					$conn->query("TRUNCATE TABLE cekilis");
					header("Location:admin.php"); 
					exit();
				}elseif ($is=="belirle") {
					$sor=$conn->query("select * from cekilis ")->rowCount();
					$idm=rand(1,$sor);
					
					echo '<br> <br>	 <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">Sonuç</div>
            <div class="panel-body">
                <table class="table">
	                    <thead>
	                        <tr>
	                            <th width="150">AD SOYAD</th>
	                            <th width="200">Telefon</th>
	                            <th width="90">FACEBOOK</th>
	                            
	                        </tr>
	                    </thead>
	                    <tbody>
	                    ';
	                    $sql="select * from cekilis where id=$idm";
	                     foreach ($conn->query($sql) as $row) {
							echo '<tr>
								<td width="150">'.$row["ad"].' </td>
								<td width="200">'.$row["mail"].' </td>
								<td width="90" >'.$row["face"].' </td>
							
							</tr>';
							 } 
	                   echo  '      </tbody>
                </table>
            </div>
        </div>
    </div>';
				}
			}

		?>
<br>
        <br>
        <b>Çekilişe Katılım Formu :</b> <font color="green"></font>
        <br>
        <br>
    </center>
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                KATILANLAR </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th width="150">AD SOYAD</th>
                            <th width="200">Telefon</th>
                            <th width="90">FACEBOOK</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $sql='select * from cekilis ';
                     foreach ($conn->query($sql) as $row) {
                    	
                    ?>
						<tr>
							<td width="150"> <?php echo $row["ad"]; ?> </td>
							<td width="200"> <?php echo $row["mail"]; ?> </td>
							<td width="90" > <?php echo $row["face"]; ?> </td>
							
						</tr>
						<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 centerText">
        <p>©2017 TheYkk, Tüm hakları saklıdır.</p>
    </div>
    <br>
    <br>

</body>
 </html>