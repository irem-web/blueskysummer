<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
        $user_id = $_COOKIE['kullanici_id'];
    }else{
        $user_id = '';
    }

    if (isset($_POST['submit'])) {

        $select_user = $conn->prepare("SELECT * FROM `kullanicilar` WHERE
        id = ? LIMIT 1");
        $select_user->execute([$user_id]);
        $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);


        $prev_pass = $fetch_user['sifre'];
        $prev_image = $fetch_user['fotograf'];

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        if(!empty($name)) {
            $update_name = $conn->prepare("UPDATE `kullanicilar` SET isim = ? WHERE id = ?");
            $update_name->execute([$name, $user_id]);
            $success_msg[] = 'Kullanıcı adı başarıyla güncelllendi';
        }

        if (!empty($email)) {
            $select_email = $conn->prepare("SELECT * FROM `kullanicilar` WHERE id = ? AND email = ?");
            $select_email->execute([$user_id, $email]);

            if ($select_email->rowCount() > 0) {
                $warning_msg[] = 'E-mail zaten mevcut';
            }else{
                $update_email = $conn->prepare("UPDATE `kullanicilar` SET email = ? WHERE id = ?");
                $update_email->execute([$email, $user_id]);
                $success_msg[] = 'E-mail başarıyla güncelllendi';
            }
        }

        $image = $_FILES['image']['name'];
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../image/'.$rename;

        if (!empty($image)) {
            if ($image_size > 2000000) {
                $warning_msg[] = 'Resimin boyutu çok büyük';
            }else{
                $update_image = $conn->prepare("UPDATE `kullanicilar` SET fotograf = ? WHERE id = ?");
                $update_image->execute([$rename, $user_id]);
                move_uploaded_file($image_tmp_name, $image_folder);

                if ($prev_image != '' AND $prev_image != $rename) {
                    unlink('image/'.$prev_image);
                }
                $success_msg[] = 'Fotoğraf başarıyla güncelllendi';
            }
        }

        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';

        $old_pass = sha1($_POST['old_pass']);
        $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

        $new_pass = sha1($_POST['new_pass']);
        $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

        $cpass = sha1($_POST['cpass']);
        $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

        if ($old_pass != $empty_pass) {
            if ($old_pass != $prev_pass) {
                $warning_msg[] = 'Eski şifre eşleşmiyor';
            }elseif($new_pass != $cpass){
                $warning_msg[] = 'Şifreler eşleşmiyor';
            }else{
                if ($new_pass != $empty_pass) {
                    $update_pass = $conn->prepare("UPDATE `kullanicilar` SET sifre = ? WHERE id = ?");
                    $update_pass->execute([$new_pass, $user_id]);
                    $success_msg[] = 'Şifre başarıyla güncelllendi';
                }else{
                    $warning_msg[] = 'Lütfen yeni bir şifre girin';
                }
            }
        }
    }   

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blue Sky Summer - Profil güncelleme Sayfası</title>
    <link rel="stylesheet" type="text/css" href="css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Profil güncelleme</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Giriş Yap </span> 
        </div>
    </div>
    <section class="form-container">
            <div class="heading">
                <h1>Profil detaylarını güncelleme</h1>
                <img src="image/separator-img.png">   
            </div>
            <form action="" method="post" enctype="multipart/form-data" class="kayit">
                <div class="img-box">
                    <img src="image/<?= $fetch_profile['fotograf']; ?>">   
                </div>
                <div class="flex">
                    <div class="col">
                        <div class="input-field">
                            <p>İsminiz <span>*</span> </p>
                            <input type="text" name="name" placeholder="<?= $fetch_profile['isim'];  ?>" class="box">   
                        </div>
                        <div class="input-field">
                            <p>E-mailiniz <span>*</span> </p>
                            <input type="email" name="email" placeholder="<?= $fetch_profile['email'];  ?>" class="box">   
                        </div>
                        <div class="input-field">
                            <p>Resim seç <span>*</span> </p>
                            <input type="file" name="image" accept="image/*" class="box">   
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-field">
                            <p>Eski şifre <span>*</span> </p>
                            <input type="password" name="old_pass" placeholder="Eski şifrenizi girin" class="box">   
                        </div>
                        <div class="input-field">
                            <p>Yeni şifre <span>*</span> </p>
                            <input type="password" name="new_pass" placeholder="Yeni şifrenizi girin" class="box">   
                        </div>
                        <div class="input-field">
                            <p>Şifreyi onayla <span>*</span> </p>
                            <input type="password" name="cpass" placeholder="Şifreyi onayla" class="box">   
                        </div>      
                    </div>    
                </div>
                <input type="submit" name="submit" value="Profili güncelle" class="btn">   
            </form>  
        </section>

    <?php include 'elemanlar/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>