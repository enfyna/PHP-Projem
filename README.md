# Web Programlama Dersi PHP Projem

infinityfree Link : http://oyungurmesi.epizy.com/index.php

## Konu
  Oyun puanlama sitesi

## Özellikler
  - Kullanıcılar, hesap oluşturabilir, oturum açabilir ve oturumlarını kapatabilirler.
  - Kullanıcılar, oyun ekleyebilirler.
  - Kullanıcılar, oyunlara yorum ve puan verebilir.
  - Kullanıcılar, kendi yorumlarını düzenleyebilir yada silebilirler.
  - Moderatörler, kullanıcıların sahip olduğu izinlere sahiptirler.
  - Moderatörler, oluşturulmuş oyunları düzenleyebilir yada silebilirler.
  - Moderatörler, oluşturulmuş yorumları düzenleyebilir yada silebilirler.

## Kurulum

Eğer bu projeyi kendi bilgisayarınızda çalıştırmak istiyorsanız önceden [XAMPP](https://www.apachefriends.org/)'ın sisteminizde yüklü olması gerekmektedir. Eğer bu program zaten yüklü ise, aşağıdaki adımları izleyebilirsiniz.

#### 1. Adım

Bu repoyu [indirin](https://github.com/enfyna/PHP-Projem/archive/refs/heads/main.zip).

#### 2. Adım

İndirdiğiniz zip dosyasını XAMPP'ın bilgisayarınızda kurulu olduğu dizindeki **htdocs** klasörüne atın.
**htdocs** klasörünüz boş değilse diğer dosyalarınızın yedeğini aldıktan sonra silin ve zip dosyasını çıkarın. *PHP-Projem-main* klasörünün içidekileri kesip **htdocs** içine yapıştırın. Bunları yaptıktan sonra **htdocs** klasörünüzün içinde repoda gördüğünüz dosyalar olmalı. Son olarak **SQL** klasörünü açın, bu klasör birazdan işimize yarayacak kapatmayın. Şimdilik alta alabilirsiniz.

#### 3. Adım 

XAMPP'ı başlatın ve MySQL, Apache hizmetlerini başlatın.

#### 4.Adım

İstediğiniz internet tarayıcısını açın ve [phpMyAdmin](http://localhost/phpmyadmin/)'e girin.

#### 5.Adım

Yeni bir database oluşturun ve adını '**db1**' olarak dilini de '**utf8mb4_general_ci**' olarak ayarlayın.

#### 6.Adım

Database oluşturulduktan sonra SQL sekmesini açın.Ve biraz önce alta aldığımız **SQL** klasörünü açın. İstediğiniz dosyayı not defteri ile açtıktan sonra içindeki herşeyi kopyalayıp SQL sekmesine yapıştırın ve sorguyu çalıştırın.
(**SQL** klasöründe *empty.sql* ve *preset.sql* olmak üzere 2 dosya var. *preset.sql* dosyasını seçerseniz sitede 5 oyun, 3 kullanıcı ve 4 tane yorum yapılmış bir şekilde gelir.*empty.sql* seçerseniz site boş gelir.)

#### 7.Adım

[Site](http://localhost/)'yi başarılı bir şekilde kurdunuz!

#### 8.Adım

Moderatör hesabı oluşturmak için siteye kayıt olduktan sonra [phpMyAdmin](http://localhost/phpmyadmin/)'den kullanıcının *user_is_mod* değerini **1** olarak ayarlamanız gerekmekte.

## Kullanım Videosu

https://youtu.be/iWel7nunFU4

