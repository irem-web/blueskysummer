<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }

    // sending message
    if (isset($_POST['send_message'])) {
        if ($user_id != '') {

            $id = unique_id();
            $name = $_POST['name'];
            $name = filter_var($name, FILTER_SANITIZE_STRING);

            $email = $_POST['email'];
            $email = filter_var($email, FILTER_SANITIZE_STRING);

            $subject = $_POST['subject'];
            $subject = filter_var($subject, FILTER_SANITIZE_STRING);

            $message = $_POST['message'];
            $message = filter_var($message, FILTER_SANITIZE_STRING);

            $verify_message = $conn->prepare("SELECT * FROM `mesaj` WHERE kullanici_id = ? AND email = ? AND konu = ? AND mesaj = ?");
            $verify_message->execute([$user_id, $email, $subject, $message]);

            if ($verify_message->rowCount() > 0) {
                $warning_msg[] = 'mesaj zaten mevcut';
            } else {
                $insert_message = $conn->prepare("INSERT INTO `mesaj` (id, kullanici_id, isim, email, konu, mesaj) VALUES (?, ?, ?, ?, ?, ?)");
                $insert_message->execute([$id, $user_id, $name, $email, $subject, $message]);

                $success_msg[] = 'açıklama başarıyla eklendi';
            }
        }else{
            $warning_msg[] = 'lütfen ilk önce giriş yapın';
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - İletişim Sayfası</title>

	<link rel="stylesheet" type="text/css" href="css/user_style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/
    font-awesome/6.2.0/css/all.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Bize Ulaşın</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Bize Ulaşın </span> 
        </div>
    </div>
    <div class="services">
        <div class="heading">
            <h1>Hizmetlerimiz</h1>
            <p>Zamanınızdan ve Paranızdan Tasarruf Etmek İçin Çevrimiçi Rezervasyon Yapmak İçin Sadece Birkaç Tıklama</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/2.png">
                <div>
                    <h1>Ücretsiz hızlı kargo</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/1.png">
                <div>
                    <h1>Para iadesi ve garanti</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="box">
                <img src="image/0.png">
                <div>
                    <h1>24/7 Çevrimiçi destek</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="heading">
            <h1>bize bir satır yazın</h1>
            <p>Zamanınızdan ve Paranızdan Tasarruf Etmek İçin Çevrimiçi Rezervasyon Yapmak İçin Sadece Birkaç Tıklama</p>
            <img src="image/separator-img.png">
        </div>
        <form action="" method="post" class="register">
            <div class="input-field">
                <label>isim <sup>*</sup></label>
                <input type="text" name="name" required placeholder="isminizi giriniz" class="box">
            </div>
             <div class="input-field">
                <label>email <sup>*</sup></label>
                <input type="email" name="email" required placeholder="e-mailinizi giriniz" class="box">
            </div>
             <div class="input-field">
                <label>konu <sup>*</sup></label>
                <input type="text" name="subject" required placeholder="neden.." class="box">
            </div>
             <div class="input-field">
                <label>açıklama <sup>*</sup></label>
                <textarea name="message" cols="30" rows="10" required placeholder="" class="box"></textarea>
            </div>
            <button type="submit" name="send_message" class="btn">mesajı gönder</button>
        </form>
    </div>

    <div class="adress">
        <div class="heading">
            <h1>iletişim bilgilerimiz</h1>
            <p>Zamanınızdan ve Paranızdan Tasarruf Etmek İçin Çevrimiçi Rezervasyon Yapmak İçin Sadece Birkaç Tıklama</p>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="bx bxs-map-alt"></i>
                <div>
                    <h4>adres</h4>
                    <p>1093 Marigold, Coral Way <br> Miami, Florida, 33169 </p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-phone-incoming"></i>
                <div>
                    <h4>telefon numarası</h4>
                    <p>50123658720</p>
                    <p>50123658720</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bxs-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>iremmm@gmail.com</p>
                    <p>iremmm@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    


    <?php include 'elemanlar/footer.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>