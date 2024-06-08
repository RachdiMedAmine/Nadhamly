-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 09:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_app_planner`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` varchar(15) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `nombre` int(11) NOT NULL,
  `prix` float NOT NULL,
  `image1` varchar(100) DEFAULT 'image_default.png',
  `image2` varchar(100) DEFAULT 'image_default.png',
  `image3` varchar(100) DEFAULT 'image_default.png',
  `categorie` varchar(20) NOT NULL,
  `dispo` int(11) NOT NULL DEFAULT 1,
  `motif` varchar(9) NOT NULL,
  `id_frs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `libelle`, `description`, `nombre`, `prix`, `image1`, `image2`, `image3`, `categorie`, `dispo`, `motif`, `id_frs`) VALUES
('662cd489c27ba', 'chaises', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 100, 3.25, 'images/Equipements/chairs3.jpg', 'images/Equipements/chairs3.jpg', 'images/Equipements/chairs3.jpg', 'meuble', 1, 'Location', 1),
('662cd4c03001b', 'table', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1, 12.25, 'images/Equipements/table.jpg', 'images/Equipements/table.jpg', 'images/Equipements/table.jpg', 'meuble', 1, 'Location', 1),
('662cd4f181bc6', 'sono', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1, 100.2, 'images/Equipements/Sono.png', 'images/Equipements/Sono.png', 'images/Equipements/Sono.png', 'Equipement', 1, 'Vente', 1),
('662cd52db1ff8', 'salle des fêtes 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1, 1252, 'images/Baristas/2.jpg', 'images/Baristas/2.jpg', 'images/Baristas/2.jpg', 'Espace', 1, 'Location', 1),
('662cd58174dd1', 'developpement web', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1, 100, 'images/Baristas/3.jpg', 'images/Baristas/3.jpg', 'images/Baristas/3.jpg', 'Service', 1, 'Vente', 18),
('662cd5a9b1315', 'design graphique', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1, 125, 'images/Equipements/chairs1.jpg', 'images/Equipements/chairs1.jpg', 'images/Equipements/chairs1.jpg', 'Formation', 1, 'Vente', 18),
('662cd5ee8a0db', 'Traiteurs', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 8, 12.5, 'images/esppaces/2.jpg', 'images/esppaces/2.jpg', 'images/esppaces/2.jpg', 'Service', 1, 'Location', 18),
('662cd66a015c8', 'cuillères jetables', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida sagittis lorem, tempor ullamcorper lorem egestas in. Suspendisse et enim eget dui tempor fermentum. Nulla rhoncus metus nec sapien porta, id lobortis tellus consectetur.', 1000, 3.25, 'images/personnels/musique.jpg', 'images/personnels/musique.jpg', 'images/personnels/musique.jpg', 'Autres', 1, 'Vente', 18);

-- --------------------------------------------------------

--
-- Table structure for table `candidatures`
--

CREATE TABLE `candidatures` (
  `id_equipe` varchar(60) NOT NULL,
  `id_frs` int(11) NOT NULL,
  `id_candidat` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `statut` varchar(60) NOT NULL DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidatures`
--

INSERT INTO `candidatures` (`id_equipe`, `id_frs`, `id_candidat`, `date`, `statut`) VALUES
('662509948d643', 14, 1, '2024-04-22 20:07:50', 'acceptee'),
('6626b4876a773', 1, 14, '2024-04-24 16:12:10', 'acceptee'),
('66295fd18852a', 1, 9, '2024-04-24 17:40:02', 'acceptee'),
('662cb34e54bf1', 18, 1, '2024-04-27 06:14:36', 'en_attente');

-- --------------------------------------------------------

--
-- Table structure for table `crm`
--

CREATE TABLE `crm` (
  `id` varchar(30) NOT NULL,
  `nom` varchar(100) DEFAULT 'anonyme',
  `mail` varchar(100) NOT NULL DEFAULT 'anonyme',
  `tel` int(11) NOT NULL DEFAULT 0,
  `objet` varchar(100) NOT NULL DEFAULT 'Aucun objet',
  `message` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm`
--

INSERT INTO `crm` (`id`, `nom`, `mail`, `tel`, `objet`, `message`) VALUES
('661b0af3ad7c2', 'visiteur1', 'v@v.com', 12345678, 'swexdrcftvgb', 'ti chbikom'),
('661b0c7506bd8', 'visiteur2', 'v2@v.com', 12345678, 'dsfgh', 'blablabla'),
('662e5506a55ee', '', '', 0, 'HELLO', 'hff hgutyutn yguytut '),
('662e561935617', 'anonyme', 'anonyme', 0, 'ygfu', 'ufritgfig hgug');

-- --------------------------------------------------------

--
-- Table structure for table `equipes`
--

CREATE TABLE `equipes` (
  `id` varchar(60) NOT NULL,
  `libelle` varchar(60) NOT NULL,
  `prix` float NOT NULL,
  `description` varchar(300) NOT NULL,
  `categorie` varchar(30) NOT NULL,
  `id_frs` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dispo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipes`
--

INSERT INTO `equipes` (`id`, `libelle`, `prix`, `description`, `categorie`, `id_frs`, `image`, `dispo`) VALUES
('662509948d643', 'equipe_essai', 12.5, 'serdtfgyuhijo', 'Sécurité', 14, 'Capture d&#039;écran 2024-04-12 154149.png', 1),
('6626b4876a773', 'equipe2', 12.5, 'Hoc inmaturo interitu ipse quoque sui pertaesus excessit e vita aetatis nono anno atque vicensimo cum quadriennio imperasset. natus apud Tuscos in Massa Veternensi, patre Constantio ', 'Restauration', 1, 'Capture d&#039;écran 2024-04-16 232945.png', 1),
('66295fd18852a', 'equipe_test', 3.25, 'sdfghjklmfghjklmù\r\n', 'Formation', 1, 'Capture d&#039;écran 2024-04-12 154253.png', 1),
('662cb34e54bf1', 'equipe4', 12.25, 'qserdtfgyhukpol^fgyhuijkolmfg sdfghijkolp dfgtyhuijk dftgyhui dftgyhuijk rtfyuiofv drtfguyij dtcyfuih', 'Restauration', 18, 'batcoders.png', 1),
('662cb37c96c5a', 'equipe2', 3.25, 'gfuyfu fuyfurf gtut_tr tytdtes uhyiyà bouoyè(e hioy_rydf', 'Autres', 18, 'Capture d&#039;écran 2024-04-24 234846.png', 1),
('662cc4c9eb57d', 'equipe req', 12.25, 'rtfhujkl trfyguhijokp dfghj fghj fvgoçiofn fydtliv futèr ç_yitu oihljonbug  tuètdymk hyer-r t;,oj hièu-t_y uyutèeytpjb iu(rygo jiy_rugo', 'Restauration', 1, 'Capture d&#039;écran 2024-04-12 154253.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `id_panier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_equipe` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` int(4) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_user`, `id_equipe`, `id`, `quantite`, `date_debut`, `date_fin`, `date_ajout`) VALUES
(0, 1, NULL, '662cd66a015c8', 43, '0000-00-00', '0000-00-00', '2024-04-30 18:59:56'),
(0, 1, NULL, '662cd5a9b1315', 1, '0000-00-00', '0000-00-00', '2024-04-30 19:26:51'),
(0, 19, '', '662cd5ee8a0db', 13, '2024-04-01', '2024-04-30', '2024-04-30 17:17:21'),
(0, 19, '', '662cd5ee8a0db', 29, '2024-04-01', '2024-04-23', '2024-04-30 17:21:47'),
(0, 19, '', '662cd5ee8a0db', 5, '2024-04-17', '2024-04-23', '2024-04-30 17:23:32'),
(0, 19, '', '662cd5a9b1315', 1, '0000-00-00', '0000-00-00', '2024-04-30 17:23:57'),
(0, 19, '', '662cd66a015c8', 25, '0000-00-00', '0000-00-00', '2024-04-30 17:24:14'),
(0, 19, '', '662cd52db1ff8', 1, '2024-04-01', '2024-04-30', '2024-04-30 17:26:32'),
(0, 19, '', '662cd52db1ff8', 1, '2024-04-03', '2024-04-29', '2024-04-30 17:26:54'),
(1, 19, '', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-04-30 17:28:34'),
(226555, 1, '662509948d643', NULL, 1, '2024-04-01', '2024-04-24', '2024-04-30 19:13:28'),
(773704, 1, '662509948d643', NULL, 1, '2024-04-01', '2024-04-10', '2024-04-30 19:26:14'),
(802764, 19, '6626b4876a773', NULL, 0, '2024-04-01', '2024-04-30', '2024-04-30 18:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  `nom` char(20) NOT NULL,
  `prenom` char(20) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `tel` int(11) NOT NULL,
  `bio` char(255) NOT NULL,
  `role` char(5) NOT NULL DEFAULT 'user',
  `username` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  `pdp` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `id_panier`, `nom`, `prenom`, `mail`, `tel`, `bio`, `role`, `username`, `mot_de_passe`, `pdp`) VALUES
(1, 0, 'amin', 'rachdi', 'aminamin@amin.amin', 0, '', '', 'amin', '147258369', 0x696d616765732f70726f66696c652f312e6a7067),
(9, 0, 'amine', 'rachdi', 'rimrim@rim.r', 20111211, 'ijijiji', '', 'rimderbali', '147258369', 0x696d616765732f70726f66696c652f392e6a7067),
(11, 0, 'amine', 'rachdie', 'am@amm.mm', 20111211, 'ijijiji', '', 'amin', '123456789', 0x696d616765732f70726f66696c652f31312e6a7067),
(12, 0, 'test', 'test', 'amamama@e.e', 78945211, 'ssss', '', 'amin', '147258369', NULL),
(13, 0, 'amin', 'rachdi', 'rachdiamine@r.r', 20144744, 'fsss', '', 'aminemine', '147258369', 0x696d616765732f70726f66696c652f31332e6a7067),
(14, 0, 'okok', 'okok', 'ab@a.a', 20144744, 'aa', '', 'aba.a', '147258369', 0x696d616765732f70726f66696c652f31342e6a7067),
(15, 0, 'am', 'amm', 'amam@gg.g', 28789123, 'ojojoi', '', 'amamgma', '147258369', NULL),
(16, 0, 'aijifj', 'ijijij', 'amin@amin.fr', 78945211, 'opsdkgodpgk', '', 'ajinn', '123456789', NULL),
(17, 0, 'wijden', 'zerai', 'wijlwij@wij.wij', 212322550, 'actrice', '', 'wijdenwajdounahobamouna', '123456789', 0x696d616765732f70726f66696c652f31372e6a7067),
(18, 0, 'Toubale', 'Molka', 'molkatoubale23@gmail.com', 12345678, 'srsfglihgutdetsdugohpmu', 'user', 'molka_toubale', '123456789', NULL),
(19, 0, 'malouche', 'rayen', 'rayenmalouche27@gmail.com', 55737055, 'dajkdbl', 'user', 'rayen.malouche', '0123456789', NULL),
(22, 0, 'chedi', 'rhimi', 'rayenmalouche@gmail.com', 55737055, 'dvakdvgdbezfBLFKZ', 'user', 'rayenmalouche@gmail.com', '123456789', NULL),
(24, 0, 'aziz', 'saidi', 'az@gmail.com', 55737055, 'boezfufbL9BF4UFONL', 'user', 'aziz.saidi', '123456789', NULL),
(25, 0, 'rami', 'rami', 'rami@gmail.com', 55737055, 'gkigvgkvhb khl', 'user', 'rami.rami', '123456789', NULL),
(26, 0, 'hi', 'hello', 'hello@gmail.com', 55737055, 'djkabflfEZG4', 'user', 'rayenmalou@gmail.com', '123456789', NULL),
(27, 0, 'malouche', 'rayen', 'rayee27@gmail.com', 55737055, 'dzbiGFVEzk bhj gkr', 'user', 't.t', '123456789', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`id_frs`);

--
-- Indexes for table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id_equipe`,`id_frs`,`id_candidat`),
  ADD KEY `fk2` (`id_candidat`),
  ADD KEY `fk3` (`id_frs`);

--
-- Indexes for table `crm`
--
ALTER TABLE `crm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_frs` (`id_frs`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_panier`,`id_user`,`date_ajout`),
  ADD KEY `panier_c1` (`id_user`),
  ADD KEY `panier_22` (`id_equipe`),
  ADD KEY `panier__55` (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `utili_panier` (`id_panier`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_candidat`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_22` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id`),
  ADD CONSTRAINT `panier__55` FOREIGN KEY (`id`) REFERENCES `articles` (`id`),
  ADD CONSTRAINT `panier_c1` FOREIGN KEY (`id_user`) REFERENCES `utilisateur` (`id_user`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utili_panier` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
