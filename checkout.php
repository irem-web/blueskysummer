<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
        header('location:login.php');
    }

    if (isset($_POST['place_order'])) {

        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $adress = $_POST['flat']. ','.$_POST['street'].','.$_POST['city'].','.$_POST['country'].','.$_POST['pin'];
        $adress = filter_var($adress, FILTER_SANITIZE_STRING);

        $adress_type = $_POST['adress_type'];
        $adress_type = filter_var($adress_type, FILTER_SANITIZE_STRING);

        $method = $_POST['method'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);

        $verify_cart = $conn->prepare("SELECT * FROM `kart` WHERE kullanici_id = ?");
        $verify_cart->execute([$user_id]);

        if (isset($_GET['get_id'])) {

            $get_product = $conn->prepare("SELECT * FROM `urunler` WHERE id = ? LIMIT 1");
            $get_product->execute([$_GET['get_id']]);

            if($get_product->rowCount() > 0) {
               while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
                   $satici_id = $fetch_p['satici_id'];

                   $insert_order = $conn->prepare("INSERT INTO `siparisler`(id, kullanici_id, satici_id, isim, numara, email, adres, adres_turu, odeme_yontemi, urun_id, fiyat, miktar) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                   $insert_order->execute([uniqid(), $user_id, $satici_id, $name, $number, $email, $adress, $adress_type, $method, $fetch_p['id'], $fetch_p['fiyat'], 1]);

                   header('location:order.php');
                }
            }else{
                $warning_msg[] = 'bir şeyler ters gitti';
            }

        }elseif($verify_cart->rowCount() > 0){
            while($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)){
                $s_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ? LIMIT 1");
                $s_products->execute([$f_cart['urun_id']]);
                $f_product = $s_products->fetch(PDO::FETCH_ASSOC);

                $satici_id = $f_product['satici_id'];

                $insert_order = $conn->prepare("INSERT INTO `siparisler`(id, kullanici_id, satici_id, isim, numara, email, adres, adres_turu, odeme_yontemi, urun_id, fiyat, miktar)VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([uniqid(), $user_id, $satici_id, $name, $number, $email,$adress, $adress_type, $method, $f_cart['urun_id'], $f_cart['fiyat'], $f_cart['miktar']]);

            }
            if($insert_order) {

                $delete_cart = $conn->prepare("DELETE FROM `kart` WHERE kullanici_id = ?");
                $delete_cart->execute([$user_id]);
                header('location:order.php');
            }
        }else{
            $warning_msg[] = 'bir şeyler ters gitti';
        }
    }
       
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Ödeme İşlemi Sayfası</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Ödeme İşlemleri</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Ödeme İşlemleri </span> 
        </div>
    </div>
    <div class="checkout">
        <div class="heading">
            <h1>Ödeme özeti</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <form action="" method="post" class="register">
                <input type="hidden" name="p_id" value="<?= $get_id; ?>">
                <h3>fatura detayları</h3>
                <div class="flex">
                    <div class="box">
                        <div class="input-field">
                            <p>isminiz <span>*</span> </p>
                            <input type="text" name="name" required maxlength="50" placeholder="isminizi giriniz" class="input">
                        </div>
                        <div class="input-field">
                            <p>numaranız <span>*</span> </p>
                            <input type="number" name="number" required maxlength="10" placeholder="numaranızı giriniz" class="input">
                        </div>
                        <div class="input-field">
                            <p>mailiniz <span>*</span> </p>
                            <input type="email" name="email" required maxlength="50" placeholder="mailinizi giriniz" class="input">
                        </div>
                        <div class="input-field">
                            <p>ödeme yöntemi <span>*</span> </p>
                            <select name="method" class="input">
                                <option value="kapıda ödeme">kapıda ödeme</option>
                                <option value="kredi veya banka kartı">kredi veya banka kartı</option>
                                <option value="net bankacılık">net bankacılık</option>
                                <option value="Havale veya Eft">Havale veya Eft</option>
                                <option value="ödeme">ödeme</option>
                            </select>
                        </div>
                        <div class="input-field">
                            <p>adres türü <span>*</span> </p>
                            <select name="adress_type" class="input">
                                <option value="home">Ev</option>
                                <option value="office">Ofis</option>
                            </select>
                        </div>
                    </div>
                    <div class="box">
                        <div class="input-field">
                            <p>adres satırı 01 <span>*</span> </p>
                            <input type="text" name="flat" required maxlength="50" placeholder="daire veya bina adı girin" class="input">
                        </div>
                        <div class="input-field">
                            <p>adres satırı 02 <span>*</span> </p>
                            <input type="text" name="street" required maxlength="50" placeholder="cadde adı girin" class="input">
                        </div>
                        <div class="input-field">
                            <p>şehir adı <span>*</span> </p>
                            <input type="text" name="city" required maxlength="50" placeholder="şehir adı girin" class="input">
                        </div>
                        <div class="input-field">
                            <p>ülke adı <span>*</span> </p>
                            <input type="text" name="country" required maxlength="50" placeholder="ülke adı girin" class="input">
                        </div>
                        <div class="input-field">
                            <p>posta kodu <span>*</span> </p>
                            <input type="number" name="pin" required maxlength="6" min="0" placeholder="e.g 06620" class="input">
                        </div>
                    </div>
                </div>
                <button type="submit" name="place_order" class="btn">sipariş ver</button>
            </form>

            <div class="summary">
                <h3>çantam</h3>
                <div class="box-container">
                    <?php
                    $grand_total = 0;
                    if (isset($_GET['get_id'])) {

                        $select_get = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                        $select_get->execute([$_GET['get_id']]);

                        while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
                            $sub_total = $fetch_get['fiyat'];
                            $grand_total+=$sub_total;
    
                    ?>
                    <div class="flex">
                        <img src="image/<?= $fetch_get['fotograf']; ?>" class="image">
                        <div>
                            <h3 class="name"><?= $fetch_get['isim']; ?></h3>
                            <p class="price">₺<?= $fetch_get['fiyat']; ?>/-</p>
                        </div>
                    </div>
                    <?php
                            }
                        }else{
                            $select_cart = $conn->prepare("SELECT * FROM `kart` WHERE kullanici_id = ?");
                            $select_cart->execute([$user_id]);

                            if ($select_cart->rowCount() > 0) {
                                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                                    $select_products = $conn->prepare("SELECT * FROM `urunler` WHERE id = ?");
                                    $select_products->execute([$fetch_cart['urun_id']]);
                                    $fetch_products = $select_products->fetch(PDO::FETCH_ASSOC);
                                    $sub_total = ($fetch_cart['miktar'] * $fetch_products['fiyat']);
                                    $grand_total += $sub_total;
                                
                    ?>
                    <div class="flex">
                        <img src="image/<?= $fetch_products['fotograf']; ?>" class="image">
                        <div>
                            <h3 class="name"><?= $fetch_products['isim']; ?></h3>
                            <p class="price">₺<?= $fetch_products['fiyat']; ?> X <?= $fetch_cart['miktar']; ?></p>
                        </div>
                    </div>
                    <?php
                                }
                            }else{
                                echo '<p class="empty">sepetiniz boş</p>';
                            }
                        }
                    ?>
                </div>
                <div class="grand-total">
                    <span>ödenecek toplam tutar:</span>
                    <p>₺<?= $grand_total; ?>/-</p>
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