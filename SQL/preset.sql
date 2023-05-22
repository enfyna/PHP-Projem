-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2023 at 06:45 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db1`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(10) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `game_name` varchar(50) NOT NULL,
  `game_description` text NOT NULL,
  `game_release_date` date NOT NULL,
  `game_developer` varchar(50) NOT NULL,
  `game_genre` varchar(30) NOT NULL,
  `game_image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `user_id`, `game_name`, `game_description`, `game_release_date`, `game_developer`, `game_genre`, `game_image`) VALUES
(1, 1, 'Gran Turismo™ 7', '25 yıllık tecrübeyle hazırlanan Gerçek Sürüş simülatörünü deneyimleyin.İlk andan itibaren 400 farklı otomobilde direksiyon başına geçin. Her biri eşsiz detaylarla yeniden yaratılmış klasik motorlu otomobiller ve son teknoloji süper otomobillerle dinamik hava koşullarında 90’ın üstünde pistte sürüş keyfi yaşayın.Efsanevi GT Simülasyon Modu’nun geri dönüşüyle tek oyunculu senaryoda otomobil alın, modifiye edin, yarışın, satın ve yeni arabaların ve meydan okumaların kilitlerini açın.', '2022-04-03', 'Polyphony Digital Inc', 'Yarış', 'https://image.api.playstation.com/vulcan/ap/rnd/202202/2806/wpHT6JXmOA9iECLZKRPRvt0U.png'),
(2, 1, 'Stardew Valley', 'Dededen miras kalan eski çiftlik arazisini Stardew Vadisinde devraldın. Elinden geçmiş aletler ve birkaç bozuk para ile yeni bir yaşama adım atmak için yola çıkıyorsun. Bu yabani otlarla kaplı tarlaları bereketli bir eve dönüştürmeyi ve geçimini sağlamayı öğrenebilir misin? Kolay olmayacak. Joja Şirketi kasabaya geldikten beri, eski yaşam tarzları neredeyse tamamen kayboldu. Eskiden kasabanın en canlı etkinlik merkezi olan toplum merkezi şimdi harabeye dönmüş durumda. Ancak vadide fırsatlarla dolu gibi görünüyor. Az bir özveriyle, belki de Stardew Vadisini eski ihtişamına kavuşturan kişi sensin!', '2016-02-06', 'ConcernedApe', 'RPG', 'https://cdn.cloudflare.steamstatic.com/steam/apps/413150/capsule_616x353.jpg'),
(3, 1, 'Euro Truck Simulator 2', 'Avrupanın dört bir yanını dolaşarak, etkileyici mesafelerde önemli kargonun teslimatını gerçekleştiren bir kamyon şoförü olarak yolun kralı olun! Keşfedilecek onlarca şehirle, dayanıklılığınız, yetenekleriniz ve hızınız tüm sınırlarını zorlayacak.', '2012-10-18', ' SCS Software', 'Simulasyon', 'https://cdn.cloudflare.steamstatic.com/steam/apps/227300/capsule_616x353.jpg?t=1683639221'),
(4, 3, 'Battlefield™ 2042', 'Battlefield™ 2042, markanın ikonik tümüyle savaşına dönüşü işaret eden bir birinci şahıs nişancı oyunudur. Karmaşa ile dönüşen yakın gelecekteki bir dünyada uyum sağlayın ve üstesinden gelin. Takım arkadaşlarınızla birlik olun ve 128 oyuncuyu destekleyen, eşi benzeri görülmemiş ölçekte ve epik yıkımlara sahip dinamik olarak değişen savaş alanlarına keskin ve son teknoloji silahlarla çıkın.', '2021-11-19', ' DICE', 'Savaş', 'https://media.contentapi.ea.com/content/dam/battlefield/battlefield-2042/images/2021/04/k-1920x1080-featured-image.jpg'),
(5, 3, 'League Of Legends', 'League of Legends, beş güçlü şampiyondan oluşan iki takımın birbirlerinin üssünü yok etmek için karşı karşıya geldiği takım tabanlı bir strateji oyunudur. Epik oyunlar yapmak, öldürmeleri sağlamak ve kuleleri yıkmak için 140tan fazla şampiyon arasından seçim yaparak zafer yolunda savaşırken başarınızı sağlamlayın.', '2009-10-27', 'Riot Games', 'Strateji', 'https://i0.wp.com/drawyourweapon.com/wp-content/uploads/2020/11/1_nb1P8J-TXW8D-7yqznrDXw.jpeg ');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(10) UNSIGNED NOT NULL,
  `game_id` int(10) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating_comment` mediumtext NOT NULL,
  `rating_point` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `game_id`, `user_id`, `rating_comment`, `rating_point`) VALUES
(1, 1, 1, 'Gayet güzel ama kutuların hep en düşük ödülü vermesi çok sinir bozucu.', 7),
(2, 1, 3, 'Oyunun tek kişilik modu bittikten sonra yapacak çok birşey kalmıyor.', 6.5),
(3, 1, 2, 'Oyun güzel ama online oynamak için gereken aylık abonelik çok pahalı... ', 8.5),
(4, 3, 3, 'Oyunun sadece ilk 5 dakikası eğlenceli.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_pass` varchar(256) NOT NULL,
  `user_point` smallint(6) UNSIGNED NOT NULL DEFAULT 0,
  `user_is_mod` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `user_point`, `user_is_mod`) VALUES
(1, 'Ramazan', 'eposta@mail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 151, 1),
(2, 'Emre', 'aslan@mail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 0),
(3, 'Mehmet', 'mail@mail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 52, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `game_id` (`game_id`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
