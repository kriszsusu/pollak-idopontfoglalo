-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Sze 30. 12:55
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pollakidopontfoglalas`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `esemenyek`
--

CREATE TABLE `esemenyek` (
  `id` int(11) NOT NULL,
  `cim` varchar(30) NOT NULL,
  `leiras` text NOT NULL,
  `kep` varchar(500) NOT NULL,
  `datum` datetime NOT NULL,
  `feltoltesDatuma` datetime NOT NULL DEFAULT current_timestamp(),
  `tanarID` int(11) NOT NULL,
  `tanteremID` int(11) NOT NULL,
  `torolt` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `esemenyek`
--

INSERT INTO `esemenyek` (`id`, `cim`, `leiras`, `kep`, `datum`, `feltoltesDatuma`, `tanarID`, `tanteremID`, `torolt`) VALUES
(4, 'asd', 'jhgjhg', '66f525e9204c6.png', '2024-09-21 11:13:00', '2024-09-26 09:14:17', 2, 17, 1),
(5, 'Teszt Esemény', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce convallis rhoncus felis, et maximus nunc convallis a. Aliquam erat volutpat. Donec et facilisis nisi. Ut luctus nisi ipsum, a sodales lorem maximus a. Phasellus efficitur metus sapien, et facilisis neque porta eget. Fusce mattis vestibulum sapien eget dignissim. Donec non mi vel purus vestibulum ultricies nec sed orci. Proin risus ante, cursus et velit et, scelerisque consectetur orci. Suspendisse pretium, augue ut interdum posuere, ex lectus cursus mi, id malesuada ex dolor in tortor. Vestibulum lobortis, urna et posuere tempus, metus sapien consequat sem, sed scelerisque felis ante ac tortor.\r\n\r\nFusce vitae suscipit urna. Maecenas iaculis, justo nec dapibus mollis, elit odio placerat nunc, sit amet convallis eros urna nec libero. Phasellus id augue in erat tincidunt blandit. Quisque est turpis, ullamcorper ut egestas et, sollicitudin ut turpis. Aenean placerat felis nec nunc egestas sollicitudin. Integer tempor at lacus eget gravida. Morbi fermentum, risus non ultrices vulputate, justo est pellentesque nunc, non pretium enim mi ac mi. Donec quis leo id lectus finibus eleifend. Phasellus facilisis, libero sit amet sagittis dignissim, massa elit euismod leo, sed gravida velit mauris id dolor. Mauris lobortis dolor sit amet tristique tincidunt. Nullam viverra lectus et leo dictum ultrices. Pellentesque egestas elementum consequat.\r\n\r\nNunc convallis elit id diam mattis consequat. Donec rhoncus turpis lacus, id porttitor ligula convallis vel. Ut ullamcorper, tortor et molestie tempor, mi dui sagittis magna, eu lobortis est dui at ipsum. Pellentesque porttitor sem a diam ullamcorper imperdiet. Mauris luctus imperdiet lorem sit amet imperdiet. Maecenas eget arcu efficitur, volutpat lorem nec, faucibus dui. Quisque accumsan lacus tempor volutpat pellentesque. Vivamus viverra ac lacus vel consequat. Duis a felis felis. Nam nibh turpis, pretium pulvinar nisi a, scelerisque eleifend tortor.', '66f56cbd0557a.jpg', '2024-09-21 13:30:00', '2024-09-26 11:30:42', 2, 10, 1),
(6, 'Teszt Esemény', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas placerat erat vel mi semper congue. Phasellus sed commodo orci. Cras malesuada commodo leo et ornare. Integer iaculis dignissim efficitur. Morbi dictum diam sed massa malesuada venenatis. Donec quis hendrerit sapien. Ut tempor ornare mauris, eu vehicula mauris volutpat a. Nulla facilisi. Vestibulum sed justo sed diam ultricies gravida quis nec libero. Maecenas id ligula magna. Proin quam elit, consequat et vulputate eget, placerat quis orci. Nullam feugiat, libero at ultricies lacinia, nunc nisl finibus lectus, at semper orci elit vitae mauris. Quisque vitae massa diam. Donec imperdiet, leo nec finibus maximus, metus quam auctor ex, vel porta risus libero ac arcu. Nulla sit amet ligula luctus, consequat neque quis, sagittis tellus.\r\n\r\nAenean pellentesque dictum quam in consequat. Mauris maximus ex vel lacus vulputate, sed sagittis felis lobortis. Pellentesque pellentesque mi pretium turpis pellentesque tincidunt. Pellentesque in dignissim nulla, id maximus lacus. Donec consectetur purus mi, vitae ultricies neque rhoncus eu. Quisque id blandit eros, non malesuada dui. Quisque ac consequat lacus, et rutrum elit. Cras varius tellus eu purus vestibulum mollis. Nulla et finibus mi. Proin ullamcorper pretium urna nec blandit. Sed non velit iaculis, accumsan nisi eget, cursus purus. Duis quis ullamcorper mauris, et elementum felis. Mauris eu lobortis odio. Proin ornare ante non augue pulvinar volutpat. Nam laoreet, mi non vehicula porttitor, nisl augue vestibulum urna, a feugiat purus lorem quis sapien.', '66f570141eb15.jpg', '2024-09-29 16:30:00', '2024-09-26 14:30:44', 4, 10, 1),
(7, 'Teszt Esemény', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in arcu eu urna ultricies pellentesque. Proin malesuada, est eu auctor venenatis, lacus ante sagittis risus, vitae congue sapien felis sit amet lacus. Nunc at interdum elit. Donec eu nunc eu quam interdum consequat in vel libero. In quis enim euismod, placerat lacus ac, aliquam sem. Suspendisse convallis a arcu sit amet cursus. Fusce sagittis, enim eget volutpat dictum, mauris leo bibendum tellus, ac cursus arcu turpis a elit. Vestibulum malesuada nisi sed ante congue, quis eleifend ipsum tempus.\r\n\r\nInteger eget mi lectus. Aenean pulvinar euismod massa id tempus. Pellentesque eget semper mi, sit amet pharetra ligula. Sed id elementum arcu, vitae rhoncus lectus. Mauris id commodo odio. Nam ut est sem. Nam suscipit aliquet convallis. Proin consequat sollicitudin velit, vel blandit metus maximus vitae. In dictum faucibus erat. Integer purus orci, ullamcorper eget imperdiet nec, elementum eu mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean elementum, purus non dictum hendrerit, lectus urna scelerisque ipsum, vitae vestibulum metus lacus sit amet odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris varius nunc sit amet est dapibus hendrerit. Sed ut bibendum leo, sit amet ultricies metus. Ut porttitor lacus nibh, nec rutrum est sollicitudin vel.\r\n\r\nMorbi efficitur lectus fringilla lacinia accumsan. Sed bibendum felis ligula, tincidunt accumsan nibh dignissim vitae. Aliquam imperdiet tempus sollicitudin. In hendrerit nisi quis ipsum consequat consectetur. Suspendisse non sollicitudin mi, in euismod purus. Phasellus interdum turpis sit amet erat vestibulum, vitae consequat est hendrerit. Praesent eget odio auctor, sagittis magna nec, accumsan metus. Pellentesque nec nulla eu magna suscipit interdum. Sed sed pretium arcu, vel lobortis est. Sed ut nisl sed elit aliquam accumsan. Nulla facilisi. Donec sit amet elementum orci. Sed eu hendrerit elit, eu vehicula purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent tortor sem, malesuada quis libero et, gravida malesuada nibh.', '66f7b682bb3c5.jpg', '2024-10-15 12:00:00', '2024-09-28 07:55:46', 4, 10, 1),
(8, 'Teszt Esemény', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in arcu eu urna ultricies pellentesque. Proin malesuada, est eu auctor venenatis, lacus ante sagittis risus, vitae congue sapien felis sit amet lacus. Nunc at interdum elit. Donec eu nunc eu quam interdum consequat in vel libero. In quis enim euismod, placerat lacus ac, aliquam sem. Suspendisse convallis a arcu sit amet cursus. Fusce sagittis, enim eget volutpat dictum, mauris leo bibendum tellus, ac cursus arcu turpis a elit. Vestibulum malesuada nisi sed ante congue, quis eleifend ipsum tempus.\r\n\r\nInteger eget mi lectus. Aenean pulvinar euismod massa id tempus. Pellentesque eget semper mi, sit amet pharetra ligula. Sed id elementum arcu, vitae rhoncus lectus. Mauris id commodo odio. Nam ut est sem. Nam suscipit aliquet convallis. Proin consequat sollicitudin velit, vel blandit metus maximus vitae. In dictum faucibus erat. Integer purus orci, ullamcorper eget imperdiet nec, elementum eu mauris. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean elementum, purus non dictum hendrerit, lectus urna scelerisque ipsum, vitae vestibulum metus lacus sit amet odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris varius nunc sit amet est dapibus hendrerit. Sed ut bibendum leo, sit amet ultricies metus. Ut porttitor lacus nibh, nec rutrum est sollicitudin vel.\r\n\r\nMorbi efficitur lectus fringilla lacinia accumsan. Sed bibendum felis ligula, tincidunt accumsan nibh dignissim vitae. Aliquam imperdiet tempus sollicitudin. In hendrerit nisi quis ipsum consequat consectetur. Suspendisse non sollicitudin mi, in euismod purus. Phasellus interdum turpis sit amet erat vestibulum, vitae consequat est hendrerit. Praesent eget odio auctor, sagittis magna nec, accumsan metus. Pellentesque nec nulla eu magna suscipit interdum. Sed sed pretium arcu, vel lobortis est. Sed ut nisl sed elit aliquam accumsan. Nulla facilisi. Donec sit amet elementum orci. Sed eu hendrerit elit, eu vehicula purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent tortor sem, malesuada quis libero et, gravida malesuada nibh.', '66f7dd71a39e2.jpg', '2024-09-18 12:40:00', '2024-09-28 10:41:53', 4, 10, 0),
(9, '3r3rerer', '3232323ertiojherthierhtet\r\nretert\r\nertetrzkhijogdfjhofidjhoidfjhgoidjfhoidjfhoijdfhd\r\nhdflhjdfohijdfhjdfoihjdfhoijdfhoij', '66fa814e720ad.avif', '2024-08-28 12:16:00', '2024-09-30 12:16:04', 2, 2, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jelentkezok`
--

CREATE TABLE `jelentkezok` (
  `id` varchar(36) NOT NULL DEFAULT UUID(),
  `esemenyID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tanterem`
--

CREATE TABLE `tanterem` (
  `id` int(11) NOT NULL,
  `neve` varchar(50) NOT NULL,
  `ferohely` int(11) NOT NULL,
  `torolt` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tanterem`
--

INSERT INTO `tanterem` (`id`, `neve`, `ferohely`, `torolt`) VALUES
(2, 'Elektronika terem', 20, 0),
(3, 'I.', 36, 0),
(4, 'Informatika I.', 20, 0),
(5, 'Informatika II.', 19, 0),
(6, 'Informatika III.', 16, 0),
(7, 'Informatika IV.', 20, 0),
(8, 'Informatika V.', 20, 0),
(9, 'Informatika VI.', 20, 0),
(10, 'Informatika VII.', 20, 0),
(11, 'Ipari elektronikai terem', 12, 0),
(12, 'IX.', 30, 0),
(13, 'Kajtor István tanterem', 36, 0),
(14, 'Könyvtár', 12, 0),
(15, 'LEGRAND KNX labor', 12, 0),
(16, 'Matek szaktanterem I.', 24, 0),
(17, 'Matek szaktanterem II.', 18, 0),
(18, 'Matek szaktanterem III.', 36, 0),
(19, 'Mechanikai műhely', 24, 0),
(20, 'MetALCOM', 36, 0),
(21, 'Nyelvi laboratórium', 18, 0),
(22, 'PLC terem', 15, 0),
(23, 'Robotika terem', 20, 0),
(24, 'Tornaterem', 50, 0),
(25, 'V.', 15, 0),
(26, 'VII.', 32, 0),
(27, 'VIII.', 36, 0),
(28, 'X.', 30, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tiltottemail`
--

CREATE TABLE `tiltottemail` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `tiltottemail`
--

INSERT INTO `tiltottemail` (`id`, `email`) VALUES
(1, '123mail.org'),
(2, '126.com'),
(3, '139.com'),
(4, '150mail.com'),
(5, '150ml.com'),
(6, '163.com'),
(7, '16mail.com'),
(8, '2-mail.com'),
(9, '420blaze.it'),
(10, '4email.net'),
(11, '50mail.com'),
(12, '8chan.co'),
(13, 'aaathats3as.com'),
(14, 'airmail.cc'),
(15, 'airpost.net'),
(16, 'allmail.net'),
(17, 'antichef.com'),
(18, 'antichef.net'),
(19, 'bestmail.us'),
(20, 'bluewin.ch'),
(21, 'c2.hu'),
(22, 'cluemail.com'),
(23, 'cocaine.ninja'),
(24, 'cock.email'),
(25, 'cock.li'),
(26, 'cock.lu'),
(27, 'cumallover.me'),
(28, 'dfgh.net'),
(29, 'dicksinhisan.us'),
(30, 'dicksinmyan.us'),
(31, 'elitemail.org'),
(32, 'emailcorner.net'),
(33, 'emailengine.net'),
(34, 'emailengine.org'),
(35, 'emailgroups.net'),
(36, 'emailplus.org'),
(37, 'emailuser.net'),
(38, 'eml.cc'),
(39, 'f-m.fm'),
(40, 'fast-email.com'),
(41, 'fast-mail.org'),
(42, 'fastem.com'),
(43, 'fastemail.us'),
(44, 'fastemailer.com'),
(45, 'fastest.cc'),
(46, 'fastimap.com'),
(47, 'fastmail.cn'),
(48, 'fastmail.co.uk'),
(49, 'fastmail.com'),
(50, 'fastmail.com.au'),
(51, 'fastmail.es'),
(52, 'fastmail.fm'),
(53, 'fastmail.im'),
(54, 'fastmail.in'),
(55, 'fastmail.jp'),
(56, 'fastmail.mx'),
(57, 'fastmail.net'),
(58, 'fastmail.nl'),
(59, 'fastmail.se'),
(60, 'fastmail.to'),
(61, 'fastmail.tw'),
(62, 'fastmail.uk'),
(63, 'fastmail.us'),
(64, 'fastmailbox.net'),
(65, 'fastmessaging.com'),
(66, 'fea.st'),
(67, 'firemail.cc'),
(68, 'fmail.co.uk'),
(69, 'fmailbox.com'),
(70, 'fmgirl.com'),
(71, 'fmguy.com'),
(72, 'ftml.net'),
(73, 'getbackinthe.kitchen'),
(74, 'gmx.com'),
(75, 'gmx.us'),
(76, 'goat.si'),
(77, 'h-mail.us'),
(78, 'hailmail.net'),
(79, 'hitler.rocks'),
(80, 'horsefucker.org'),
(81, 'hush.ai'),
(82, 'hush.com'),
(83, 'hushmail.com'),
(84, 'hushmail.me'),
(85, 'imap-mail.com'),
(86, 'imap.cc'),
(87, 'imapmail.org'),
(88, 'inoutbox.com'),
(89, 'internet-e-mail.com'),
(90, 'internet-mail.org'),
(91, 'internetemails.net'),
(92, 'internetmailing.net'),
(93, 'jetemail.net'),
(94, 'justemail.net'),
(95, 'kakao.com'),
(96, 'kennedy808.com'),
(97, 'letterboxes.org'),
(98, 'liamekaens.com'),
(99, 'mail-central.com'),
(100, 'mail-page.com'),
(101, 'mail2world.com'),
(102, 'mailandftp.com'),
(103, 'mailas.com'),
(104, 'mailbolt.com'),
(105, 'mailc.net'),
(106, 'mailcan.com'),
(107, 'mailforce.net'),
(108, 'mailftp.com'),
(109, 'mailhaven.com'),
(110, 'mailingaddress.org'),
(111, 'mailite.com'),
(112, 'mailmight.com'),
(113, 'mailnew.com'),
(114, 'mailsent.net'),
(115, 'mailservice.ms'),
(116, 'mailup.net'),
(117, 'mailworks.org'),
(118, 'memeware.net'),
(119, 'ml1.net'),
(120, 'mm.st'),
(121, 'mozmail.com'),
(122, 'myfastmail.com'),
(123, 'mymacmail.com'),
(124, 'naver.com'),
(125, 'neverbox.com'),
(126, 'nigge.rs'),
(127, 'nospammail.net'),
(128, 'nus.edu.sg'),
(129, 'onet.pl'),
(130, 'ownmail.net'),
(131, 'petml.com'),
(132, 'postinbox.com'),
(133, 'postpro.net'),
(134, 'proinbox.com'),
(135, 'promessage.com'),
(136, 'qq.com'),
(137, 'realemail.net'),
(138, 'reallyfast.biz'),
(139, 'reallyfast.info'),
(140, 'recursor.net'),
(141, 'redchan.it'),
(142, 'ruffrey.com'),
(143, 'rushpost.com'),
(144, 'safe-mail.net'),
(145, 'sent.as'),
(146, 'sent.at'),
(147, 'sent.com'),
(148, 'shitposting.agency'),
(149, 'shitware.nl'),
(150, 'sibmail.com'),
(151, 'sneakemail.com'),
(152, 'snkmail.com'),
(153, 'snkml.com'),
(154, 'spamcannon.com'),
(155, 'spamcannon.net'),
(156, 'spamgourmet.com'),
(157, 'spamgourmet.net'),
(158, 'spamgourmet.org'),
(159, 'speedpost.net'),
(160, 'speedymail.org'),
(161, 'ssl-mail.com'),
(162, 'swift-mail.com'),
(163, 'tfwno.gf'),
(164, 'the-fastest.net'),
(165, 'the-quickest.com'),
(166, 'theinternetemail.com'),
(167, 'tweakly.net'),
(168, 'ubicloud.com'),
(169, 'veryfast.biz'),
(170, 'veryspeedy.net'),
(171, 'waifu.club'),
(172, 'warpmail.net'),
(173, 'xoxy.net'),
(174, 'xsmail.com'),
(175, 'xwaretech.com'),
(176, 'xwaretech.info'),
(177, 'xwaretech.net'),
(178, 'yahoo.com.ph'),
(179, 'yahoo.com.vn'),
(180, 'yeah.net'),
(181, 'yepmail.net'),
(182, 'your-mail.com');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `jelszo` varchar(500) NOT NULL,
  `torolt` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `nev`, `felhasznalonev`, `jelszo`, `torolt`) VALUES
(2, 'teszt', '1', '$2y$10$3HRvS4hNIZUU8BOUQfA5q.8ha9j1Imoi.D9scs6fc/JOHEGu7o4zq', 0),
(4, 'Huszka Adrián', 'hadrian', '$2y$10$5ypfRlC2sPLntq2WgIPDb.n2SeQVyoDh.6Zjth8mRaLmbQl1rCL.W', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `esemenyek`
--
ALTER TABLE `esemenyek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tanarID` (`tanarID`),
  ADD KEY `tanteremID` (`tanteremID`);

--
-- A tábla indexei `jelentkezok`
--
ALTER TABLE `jelentkezok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_esemenyID` (`esemenyID`);

--
-- A tábla indexei `tanterem`
--
ALTER TABLE `tanterem`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `tiltottemail`
--
ALTER TABLE `tiltottemail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `esemenyek`
--
ALTER TABLE `esemenyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT a táblához `tanterem`
--
ALTER TABLE `tanterem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT a táblához `tiltottemail`
--
ALTER TABLE `tiltottemail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `esemenyek`
--
ALTER TABLE `esemenyek`
  ADD CONSTRAINT `esemenyek_ibfk_1` FOREIGN KEY (`tanarID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `esemenyek_ibfk_2` FOREIGN KEY (`tanteremID`) REFERENCES `tanterem` (`id`);

--
-- Megkötések a táblához `jelentkezok`
--
ALTER TABLE `jelentkezok`
  ADD CONSTRAINT `FK_esemeny_jelentkezes` FOREIGN KEY (`esemenyID`) REFERENCES `esemenyek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
