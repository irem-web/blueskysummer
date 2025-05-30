<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $select_user = $conn->prepare("SELECT * FROM `kullanicilar` WHERE email = ? AND sifre=?");
        $select_user->execute([$email,$pass]);
        $row=$select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            setcookie('kullanici_id', $row['id'], time() + 60*60*24*30, '/');
            header('location:home.php');
        }
        else{
            $warning_msg[]= 'email ya da şifre yanlış';
        }

    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Kullanıcı Giriş Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Giriş Yap</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Giriş Yap </span> 
        </div>
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="giriş yap">
            <h3>şimdi giriş yap</h3>
            <div class="input-field">
                <p>email <span>*</span></p>
                <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">    
            </div>  
            
                <div class="input-field">
                    <p>şifre <span>*</span></p>
                    <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">   
                </div>
            <p class="link">hesabınız yok mu? <a href="kayit.php">şimdi kayıt ol</a> </p>
            <input type="submit" name="submit" value="giriş yap" class="btn">   
        </form>
    </div>

    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>