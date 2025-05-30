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
	<title>Blue Sky Summer - Anasayfa</title>
	<link rel="stylesheet" type="text/css" href="css/user_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<?php include 'elemanlar/user_header.php'; ?>

    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>
                <div class="textBox">
                    <h1>Kendimizle gurur duyuyoruz <br> Olağanüstü lezzetler</h1>
                    <a href="menu.php" class="btn">Şimdi alışveriş yap</a>   
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>Soğuk ikramlar benim tarzım <br> Gıda konforu</h1>
                    <a href="menu.php" class="btn">Şimdi alışveriş yap</a>   
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg">
                </div>
            </div>      
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"> <i class="bx bx-right-arrow-alt"></i> </li>
            <li onclick="prevSlide();" class="prev"> <i class="bx bx-left-arrow-alt"></i> </li>  
        </ul>       
    </div>

    <div class="service">
        <div class="box-container">

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Teslimat</h4>
                    <span>100% Güvenli</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Ödeme</h4>
                    <span>100% Güvenli</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Destek</h4>
                    <span>24*7 Saat</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Geri dönüş</h4>
                    <span>24*7 Geri dönüş</span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Hediye hizmeti</h4>
                    <span>Hediye hizmet desteği </span>
                </div>
            </div>

            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">     
                    </div>
                </div>
                <div class="detail">
                    <h4>Teslim etme</h4>
                    <span>100% Güvenli</span>
                </div>
            </div>
            
        </div>
    </div> 

    <div class="categories">
        <div class="heading">
            <h1>Kategoriler ve Özellikler</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">Hindistan cevizi</a>   
            </div>
            <div class="box">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">Çikolata</a>   
            </div>
            <div class="box">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">Çilek</a>   
            </div>
            <div class="box">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">Limon</a>   
            </div>         
        </div>
    </div>

    <img src="image/menu-banner.jpg" class="menu-banner">
    <div class="taste">
        <div class="heading">
            <span>Lezzet</span>
            <h1>Herhangi bir dondurma satın al @ Bir tane bedava al</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="image/taste.webp">
                <div class="detail">
                    <h2>Doğal tatlılık</h2>
                    <h1>Mango</h1>  
                </div>  
            </div>
            <div class="box">
                <img src="image/taste0.webp">
                <div class="detail">
                    <h2>Doğal tatlılık</h2>
                    <h1>Matcha</h1>  
                </div>  
            </div>
            <div class="box">
                <img src="image/taste1.webp">
                <div class="detail">
                    <h2>Doğal tatlılık</h2>
                    <h1>Yabanmersini</h1>  
                </div>  
            </div>   
        </div>  
    </div>

    <div class="ice-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1>Dondurma daha ucuzdur <br> Stres için terapidir</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br> sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit, <br> sed do eiusmod tempor incididunt ut Labore.</p>
            <a href="menu.php" class="btn">Şimdi alışveriş yap</a>   
        </div>   
    </div>

    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>Tatlı zevkinizi bulun</h1>
                <p>Onlara lezzetli bir ikramda bulunun ve İrlanda'ya da biraz şans gönderin!</p>
                <a href="menu.php" class="btn">Şimdi alışveriş yap</a>  
            </div>
        </div>
        <div class="box-container">
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div> 
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div> 
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type1.png">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div> 
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type2.png">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div> 
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type0.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>Çilek</h1>
                    <p>Tatlı zevkinizi bulun</p>
                    <a href="menu.php" class="btn">Daha fazlasını keşfedin</a>   
                </div>  
            </div>   
        </div>   
    </div>

    <div class="flavor">
        <div class="box-container">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Sıcak fırsat ! <span>%20 İndirim</span> </h1>
                <p>Süresi bitmiş</p>
                <a href="menu.php" class="btn">Şimdi alışveriş yap</a>
            </div>
        </div>
    </div>

    <div class="usage">
        <div class="heading">
            <h1>Nasıl çalışır</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>
                <div class="box">
                    <img src="image/icon0.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>     
                <div class="box">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>                
            </div>
            <img src="image/sub-banner.png" class="divider">
            <div class="box-container">
                <div class="box">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>
                <div class="box">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>     
                <div class="box">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>Top dondurma</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
                    </div>                
                </div>                
            </div>              
        </div>
    </div>

    <div class="pride">
        <div class="detail">
            <h1>Kendimizle Gurur Duyuyoruz <br> Olağanüstü Lezzetler.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> 
            <a href="menu.php" class="btn">Şimdi alışveriş yap</a> 
        </div> 
    </div>

    <?php include 'elemanlar/footer.php'; ?>

    <script src="js/user_script.js"></script>

    <?php include 'elemanlar/uyari.php'; ?>
</body>
</html>