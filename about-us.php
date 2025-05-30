<?php 
    include 'elemanlar/connect.php';

    if (isset($_COOKIE['kullanici_id'])) {
    	$user_id = $_COOKIE['kullanici_id'];
    }else{
    	$user_id = '';
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blue Sky Summer - Hakkımızda</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Hakkımızda</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod <br> tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <span> <a href="home.php">Anasayfa</a><i class="bx bx-right-arrow-alt"></i>Hakkımızda </span> 
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Alex Doe</span>
                    <h1>Masterchef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Dondurmanın yalnızca bir tatlı değil, bir sanat olduğunu savunan  MasterChef Alex Doe, mutfaktaki ustalığıyla dünya çapında tanınan yenilikçi bir isim. İtalya’da geleneksel gelato eğitimi alan Alex, klasik tatları modern dokunuşlarla harmanlayarak kendi imzasını oluşturdu.</p>
                <div class="flex-btn">
                    <a href="" class="btn">Menümüzü keşfedin</a>
                    <a href="menu.php" class="btn">Mağazamızı ziyaret edin</a>
                </div>  
            </div>
            <div class="box">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>

    <div class="story">
        <div class="heading">
            <h1>Bizim hikayemiz</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Tatlıya olan sevgimizi, doğallığa olan inancımızla birleştirdik. <br> Yıllar boyunca tarifler denedik, mevsim meyvelerinin tadını bekledik, küçük mutlulukların peşinden gittik. <br> Her kaşıkta nostalji, her konide sevgi var. Bugün hala ilk günkü heyecanla, en doğal malzemelerle, katkısız ve taptaze dondurmalar yapıyoruz. <br> Blue Sky Summer, bir ailenin tutkuyla kurduğu küçük bir hayaldi. Şimdi o hayali sizinle paylaşıyoruz.
        Afiyetle ve sevgiyle.</p>
        <a href="menu.php" class="btn">Hizmetlerimiz</a> 
    </div>
    <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Dondurmayı Yeni Zirvelere Taşı</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut Labore.</p>
                <a href="" class="btn">Daha fazla bilgi edinin</a>  
            </div> 
        </div>  
    </div>

    <div class="team">
        <div class="heading">
            <span>Bizim Ekibimiz</span>
            <h1>Kalite Ve Tutkuyla Hizmetlerimizi Sunuyoruz</h1>
            <img src="image/separator-img.png" alt="">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Ralph Johnson</h2>
                    <p>Kahve Şefi</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Fiona Johnson</h2>
                    <p>Pasta Şefi</p>
                </div>
            </div>
            <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Tom Knelltonns</h2>
                    <p>Fırın Şefi</p>
                </div>
            </div>
        </div>
    </div>

    <div class="standards">
        <div class="detail">
            <div class="heading">
                <h1>Standartlarımız</h1>
                <img src="image/separator-img.png">
            </div>
            <p>Dondurmalarımızı katkı maddesi ve yapay aroma kullanmadan, tamamen doğal içeriklerle üretiyoruz.</p>
            <i class="bx bxs-heart"></i>
            <p>Tazeliğe önem veriyoruz; dondurmalarımızı her gün taze olarak hazırlıyoruz.</p>
            <i class="bx bxs-heart"></i>
            <p>Üretim alanlarımızda hijyen standartlarına maksimum düzeyde dikkat ediyoruz.</p>
            <i class="bx bxs-heart"></i>
            <p>Her lokmada lezzeti hissetmeniz için en kaliteli hammaddeleri özenle seçiyoruz.</p>
            <i class="bx bxs-heart"></i>
            <p>Ambalajlarımızda geri dönüştürülebilir malzemeler kullanarak doğaya saygılı üretim yapıyoruz.</p>
            <i class="bx bxs-heart"></i> 
        </div> 
    </div>

    <div class="testimonial">
        <div class="heading">
            <h1>Eleştirmen Yorumları</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>🍨 “Kremamsı dokusu ve malzeme kalitesiyle klasik dondurma algısını aşıyor. Özellikle vanilya aromasının doğallığı etkileyici.”</p>
                        <h2>Burak Tan</h2>
                        <p>Gastronomi Yazarı</p> 
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">             
                    </div>                
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>🍓 “Gerçek meyve kullanımı her kaşıkta hissediliyor. Ahududu ve limon sorbe, yaz menülerinin yıldızı olmaya aday.”</p>
                        <h2>Cem Dursun</h2>
                        <p>Tat ve Sunum Dergisi Editörü</p> 
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">             
                    </div>                
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>🥛 “Süt bazlı dondurmalarda genellikle yoğunluk ya da yapay tat problemi olur ama burada tam tersi: Denge ve doğallık mükemmel uyumda.”</p>
                        <h2>Derya Yalçın</h2>
                        <p>Yiyecek İçecek Danışmanı</p> 
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">             
                    </div>                
                </div>
                <div class="slide-col">
                    <div class="user-text">
                        <p>🌰 “Antep fıstıklı dondurma, hem kıtırlığı hem aromasıyla özgün ve yerel tatları modern sunumla birleştiriyor. Gurme düzeyinde.”</p>
                        <h2>Melis Kaya</h2>
                        <p>Şef & Dondurma Eğitmeni</p> 
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">             
                    </div>                
                </div>
            </div>  
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>

    <div class="mission">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <h1>Misyonumuz</h1>
                    <img src="image/separator-img.png">
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission.webp">
                    </div>
                    <div>
                        <h2>Meksika Çikolatası</h2>
                        <p>Yoğun kakao aroması, hafif acılık ve tarçın ile biberin eşsiz uyumunu bir araya getiren Meksika çikolatası, damakta uzun süre kalan unutulmaz bir tat sunar.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission1.webp">
                    </div>
                    <div>
                        <h2>Ballı Vanilya</h2>
                        <p>Doğal balın tatlılığı ve vanilyanın yumuşak aromasıyla harmanlanan bu özel lezzet, damakta sıcak ve huzurlu bir iz bırakır.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission2.webp">
                    </div>
                    <div>
                        <h2>Naneli Çikolatası</h2>
                        <p>Ferahlatıcı nane aroması ile zengin kakaonun dengeli birleşimi, hem serinletici hem de tatmin edici bir tat sunar. Çikolatanın yoğunluğu, nanenin tazeliğiyle yeniden doğuyor.</p>
                    </div>
                </div>
                <div class="detail">
                    <div class="img-box">
                        <img src="image/mission0.jpg">
                    </div>
                    <div>
                        <h2>Ahududu Sorbesi</h2>
                        <p>Tatlı ve ekşi ahududularla hazırlanan bu sorbe, meyvemsi notaları ve canlı rengiyle hem gözlere hem damağa hitap eder. Serinletici ve capcanlı bir tat.</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <img src="image/form.png" alt="" class="img">
            </div>
        </div>
    </div>





















    <?php include 'elemanlar/footer.php'; ?>
    <script src="js/user_script.js"></script>
</body>
</html>