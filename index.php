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


 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cekilis</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">

</head>
    <body>
    <nav class="navbar navbar-default" role="navigation">
     <div class="container-fluid">
<!--header section -->
          <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Brand Name</a>
          </div>

          <div class="collapse navbar-collapse navbar-ex1-collapse">
               <ul class="nav navbar-nav navbar-right">
               <li><a href="# ">Home</a></li>
               <li><a href="# ">About</a></li>
               <li><a href="#">Products</a></li>
               <li><a href="#">Blog</a></li>
               <li><a href="#">Support</a></li>
               </ul>
          </div>
     </div>
</nav>      
        <section id="authenty_preview" style="height: 629px;">
            <section id="signup_window" class="authenty signup-window" style="height: 629px;">
                <div class="section-content">
                    <div class="wrap">
                        <div class="container">
                            <div class="row form-wrap" data-animation="fadeInUp">
                                <i class="fa fa-times-circle"></i>
                                <div class="title">
                                    <h3>Çekiliş Sayfası</h3>
                                </div>
                                <div class="col-xs-12 col-sm-5 col-md-4 col-md-offset-1">
                                    <div class="sns-signin">
                                        <div class="btn btn-primary" href="#">
                                          Şuana Kadar <b><?php echo $conn->query("select * from cekilis ")->rowCount(); ?></b> Kişi Katıldı.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-2 col-sm-1">
                                    <div class="horizontal-divider"></div>
                                </div>
                                <div  class="col-xs-12 col-sm-6 col-md-4">
                                    
                                    <div class="normal-signup">
                                    <?php 
                                        if(isset($_POST["face"])){
                                            $ad=htmlspecialchars(addslashes(strip_tags(trim($_POST["ad"]))));
                                            $mail=htmlspecialchars(addslashes(strip_tags(trim($_POST["tlf"]))));
                                            $face=htmlspecialchars(addslashes(strip_tags(trim($_POST["face"]))));
                                            function GetIP(){
                                                if(getenv("HTTP_CLIENT_IP")) {
                                                    $ip = getenv("HTTP_CLIENT_IP");
                                                } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
                                                    $ip = getenv("HTTP_X_FORWARDED_FOR");
                                                    if (strstr($ip, ',')) {
                                                        $tmp = explode (',', $ip);
                                                        $ip = trim($tmp[0]);
                                                    }
                                                } else {
                                                $ip = getenv("REMOTE_ADDR");
                                                }
                                                return $ip;
                                            }
                                            $ip=GetIP();
                                            if (!empty($ad)&&!empty($mail)&&!empty($face)) {
                                                //ekle
                                                $bakip=$conn->query("select * from cekilis where ip = '$ip'")->rowCount();
                                                if ($bakip>0) {
                                                    echo '<div class="text-danger text">Zaten Katıldın</div> ';
                                                }else{
                                                    $conn->query("insert into cekilis set ad = '$ad' , mail='$mail' , face='$face', ip = '$ip' ");
                                                    echo '<div class="text-success">Başarıyla eklendi</div> ';
                                                }
                                            }else{
                                                echo '<div class="text-danger text">Boş Alan Bıraktınız</div> ';
                                            }
                                        }
                                    ?>
                                        <form method="POST" action="">
                                            <div class="form-group">
                                                <input type="text" name="ad" class="form-control" placeholder="Ad Soyad" required="required">
                                                <input type="text" name="tlf" class="form-control tlf" placeholder="Telefon" required="required">
                                                <input type="text"  name="face" class="form-control" placeholder="Facebook" required="required" >
                                                <script src="//apis.google.com/js/platform.js" gapi_processed="true"></script>
                                                <div id="___ytsubscribe_0" style="text-indent: 0px; margin: 0px; padding: 0px; background: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; display: inline-block; width: 116px; height: 24px;">

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-md-offset-7">
                                                    <button type="submit" class="btn btn-block signup">Çekilişe Katıl</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </body>
</html>