<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    if (isset($_POST['submit'])) {

        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'image/'.$rename;

        $select_seller = $conn->prepare("SELECT * FROM `kullanicilar` WHERE email = ?");
        $select_seller->execute([$email]);

        if ($select_seller->rowCount() > 0) {
            $warning_msg[] = 'email zaten var!';
        }
        else{
            if ($pass != $cpass){
                $warning_msg[] = 'şifreler eşleşmiyor';
            }
            else{
                $insert_seller = $conn->prepare("INSERT INTO `kullanicilar` (id, isim, email, sifre, fotograf) VALUES (?,?,?,?,?)");
                $insert_seller->execute([$id, $name, $email, $cpass, $rename]);
                move_uploaded_file($image_tmp_name, $image_folder);
                $success_msg[] = 'Yeni kullanıcı kaydoldu! Lütfen şimdi giriş yapın.';
            }
        }


    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Kullanıcı Kayıt Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Kayıt Ol</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Kayıt ol </span> 
        </div>
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="kayit">
            <h3>şimdi kayıt ol</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>isim <span>*</span></p>
                        <input type="text" name="name" placeholder="enter your name" maxlength="50" required class="box">   
                </div>
                <div class="input-field">
                    <p>email <span>*</span></p>
                        <input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">    
                </div>  
                </div>
                <div class="col">
                    <div class="input-field">
                        <p>şifre <span>*</span></p>
                        <input type="password" name="pass" placeholder="enter your password" maxlength="50" required class="box">   
                </div>
                <div class="input-field">
                    <p>şifreyi onayla <span>*</span></p>
                        <input type="password" name="cpass" placeholder="confirm your password" maxlength="50" required class="box">    
                </div>  
                </div>
                
            </div>  
            <div class="input-field">
                <p>profil <span>*</span></p>
                <input type="file" name="image" accept="image/*"  required class="box"> 
            </div>
            <p class="link">zaten bir hesabın var mı? <a href="login.php">şimdi giriş yap</a> </p>
            <input type="submit" name="submit" value="kayıt ol" class="btn">    
        </form>
    </div>

    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>