-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 mai 2024 à 02:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `event_app_planner`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` varchar(15) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL,
  `nombre` int(11) NOT NULL,
  `prix` float NOT NULL,
  `image1` varchar(100) DEFAULT 'images/default/image_default.png',
  `image2` varchar(100) DEFAULT 'images/default/image_default.png',
  `image3` varchar(100) DEFAULT 'images/default/image_default.png',
  `categorie` varchar(20) NOT NULL,
  `dispo` int(11) NOT NULL DEFAULT 1,
  `motif` varchar(9) NOT NULL,
  `id_frs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
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
-- Structure de la table `candidatures`
--

CREATE TABLE `candidatures` (
  `id_equipe` varchar(60) NOT NULL,
  `id_frs` int(11) NOT NULL,
  `id_candidat` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `statut` varchar(60) NOT NULL DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `candidatures`
--

INSERT INTO `candidatures` (`id_equipe`, `id_frs`, `id_candidat`, `date`, `statut`) VALUES
('662509948d643', 14, 1, '2024-04-22 20:07:50', 'acceptee'),
('6626b4876a773', 1, 14, '2024-04-24 16:12:10', 'acceptee'),
('66295fd18852a', 1, 9, '2024-04-24 17:40:02', 'acceptee'),
('662cb34e54bf1', 18, 1, '2024-04-27 06:14:36', 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `crm`
--

CREATE TABLE `crm` (
  `id` varchar(30) NOT NULL,
  `nom` varchar(100) DEFAULT 'anonyme',
  `mail` varchar(100) NOT NULL DEFAULT 'anonyme',
  `tel` int(11) NOT NULL DEFAULT 0,
  `objet` varchar(100) NOT NULL DEFAULT 'Aucun objet',
  `message` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `crm`
--

INSERT INTO `crm` (`id`, `nom`, `mail`, `tel`, `objet`, `message`) VALUES
('661b0af3ad7c2', 'visiteur1', 'v@v.com', 12345678, 'swexdrcftvgb', 'ti chbikom'),
('661b0c7506bd8', 'visiteur2', 'v2@v.com', 12345678, 'dsfgh', 'blablabla'),
('662e5506a55ee', '', '', 0, 'HELLO', 'hff hgutyutn yguytut '),
('662e561935617', 'anonyme', 'anonyme', 0, 'ygfu', 'ufritgfig hgug');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id`, `libelle`, `prix`, `description`, `categorie`, `id_frs`, `image`, `dispo`) VALUES
('662509948d643', 'equipe_essai', 12.5, 'serdtfgyuhijo', 'Sécurité', 14, 'images/default/image_default.png', 1),
('6626b4876a773', 'equipe2', 12.5, 'Hoc inmaturo interitu ipse quoque sui pertaesus excessit e vita aetatis nono anno atque vicensimo cum quadriennio imperasset. natus apud Tuscos in Massa Veternensi, patre Constantio ', 'Restauration', 1, 'images/default/image_default.png', 1),
('66295fd18852a', 'equipe_test', 3.25, 'sdfghjklmfghjklmù\r\n', 'Formation', 1, 'images/default/image_default.png', 1),
('662cb34e54bf1', 'equipe4', 12.25, 'qserdtfgyhukpol^fgyhuijkolmfg sdfghijkolp dfgtyhuijk dftgyhui dftgyhuijk rtfyuiofv drtfguyij dtcyfuih', 'Restauration', 18, 'images/default/image_default.png', 1),
('662cb37c96c5a', 'equipe2', 3.25, 'gfuyfu fuyfurf gtut_tr tytdtes uhyiyà bouoyè(e hioy_rydf', 'Autres', 18, 'images/default/image_default.png', 1),
('662cc4c9eb57d', 'equipe req', 12.25, 'rtfhujkl trfyguhijokp dfghj fghj fvgoçiofn fydtliv futèr ç_yitu oihljonbug  tuètdymk hyer-r t;,oj hièu-t_y uyutèeytpjb iu(rygo jiy_rugo', 'Restauration', 1, 'images/default/image_default.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_event` varchar(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Description` varchar(3000) NOT NULL,
  `Date_debut` date NOT NULL,
  `Date_fin` date NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_event`, `id_utilisateur`, `Nom`, `Description`, `Date_debut`, `Date_fin`, `date_ajout`) VALUES
('66368f2f3fb', 19, 'Anniversaire ', 'L\'anniversaire, une date singulière inscrite au carrefour du temps, où les souvenirs se mêlent à l\'anticipation. C\'est un jour où le présent s\'efface devant le passé et le futur, où l\'on célèbre l\'existence, marquant ainsi le voyage continu de la vie.   Au cœur de cette célébration, règne une ambiance électrique, vibrant d\'excitation et de joie contagieuse. Les préparatifs débutent bien avant le jour J, une frénésie de planification et de créativité s\'empare de chacun. Les invitations sont envoyées, les décorations soigneusement choisies, et le gâteau, pièce maîtresse de la fête, se pare des couleurs les plus vives et des saveurs les plus exquises.  Le jour tant attendu se lève, empreint d\'une aura particulière. Les premiers rayons du soleil semblent plus chauds, les sourires plus éclatants. Les proches se réunissent, chacun apportant sa touche personnelle à cette journée spéciale. Les rires résonnent, les éclats de voix se mêlent à la musique entraînante qui anime l\'espace.  Les cadeaux, emballés avec s', '2024-05-23', '2024-05-24', '2024-05-04 20:40:31'),
('66369011a03', 19, 'Mariage', 'Un mariage est bien plus qu\'une simple cérémonie ; c\'est un symbole d\'amour, d\'engagement et de partenariat. C\'est un événement où deux personnes s\'unissent pour former une union sacrée, où les promesses d\'amour éternel sont échangées devant famille et amis. C\'est une célébration de l\'unité, où deux âmes se rejoignent pour parcourir ensemble le chemin de la vie.  Au cœur d\'un mariage se trouve la promesse solennelle de soutien mutuel dans les bons moments comme dans les mauvais, de respect et de compréhension, de croissance et d\'évolution ensemble. C\'est un moment chargé d\'émotion, où les sourires radieux, les larmes de joie et les éclats de rire remplissent l\'atmosphère, créant des souvenirs qui dureront toute une vie.  Chaque détail d\'un mariage - des décorations élégantes à la délicatesse des alliances échangées - témoigne de l\'amour et du dévouement des deux personnes qui s\'engagent l\'une envers l\'autre. C\'est un moment où les différences sont mises de côté, où les familles et les amis se réunissent pour célébrer l\'unité et le bonheur des mariés.  Mais un mariage est également le début d\'une nouvelle aventure, un voyage rempli de défis et de découvertes, mais aussi de bonheur et d\'accomplissement. C\'est un rappel que, même dans un monde en constante évolution, l\'amour véritable demeure un pilier solide sur lequel construire une vie ensemble.  En résumé, un mariage est une célébration de l\'amour sous toutes ses formes - un moment magique où deux cœurs deviennent un, où l\'espoir d\'un avenir radieux brille plus fort que jamais.', '2024-05-23', '2024-05-31', '2024-05-04 20:44:17'),
('6636905420e', 19, 'seminaire', 'Un séminaire est bien plus qu\'une simple réunion professionnelle; c\'est un rendez-vous privilégié où les esprits s\'épanouissent, où les idées fusionnent et où les horizons s\'élargissent. Réunissant des individus partageant des intérêts communs ou des objectifs similaires, un séminaire offre une plateforme pour l\'apprentissage, l\'échange et la collaboration. C\'est un espace où les connaissances se transforment en actions, où les défis sont relevés avec ingéniosité et où de nouvelles perspectives émergent.  Au cœur d\'un séminaire se trouve une dynamique d\'apprentissage sans pareil, où des experts partagent leur expertise, où des débats enflammés stimulent la réflexion et où les participants repartent enrichis de nouvelles idées et d\'insights précieux. Que ce soit pour explorer de nouveaux domaines de recherche, discuter des tendances émergentes dans un secteur donné, ou renforcer les compétences professionnelles, chaque séminaire offre une occasion unique de croissance et d\'épanouissement.  Mais un séminaire va au-delà de l\'aspect académique. C\'est également un lieu de réseautage où des relations professionnelles durables sont forgées, où les collaborations futures prennent forme et où les amitiés naissent. Les moments partagés lors d\'un séminaire, que ce soit autour d\'une table de discussion, lors d\'une pause-café animée ou lors d\'une soirée de clôture, deviennent souvent le point de départ de partenariats fructueux et de synergies inattendues.  En résumé, un séminaire est une expérience riche en apprentissages, en échanges et en opportunités. C\'est un catalyseur de croissance personnelle et professionnelle, un moment privilégié où les individus et les idées se rencontrent pour créer un avenir prometteur.', '2024-05-23', '2024-05-31', '2024-05-04 20:45:24');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id_event` varchar(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `id_equipe` varchar(60) NOT NULL DEFAULT '0',
  `id` varchar(15) NOT NULL DEFAULT '0',
  `quantite` int(4) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_ajout` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id_event`, `id_user`, `id_equipe`, `id`, `quantite`, `date_debut`, `date_fin`, `date_ajout`) VALUES
('0', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 22:02:16'),
('0', 19, '0', '662cd52db1ff8', 1, '2024-05-01', '2024-05-31', '2024-05-04 22:02:34'),
('0', 19, '0', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-05-04 22:02:22'),
('0', 19, '0', '662cd5ee8a0db', 37, '2024-05-06', '2024-05-30', '2024-05-05 00:22:15'),
('0', 19, '0', '662cd66a015c8', 33, '0000-00-00', '0000-00-00', '2024-05-04 23:42:55'),
('0', 19, '6626b4876a773', '0', 1, '2024-05-18', '2024-05-30', '2024-05-04 23:58:40'),
('0', 19, '6626b4876a773', '0', 1, '2024-05-19', '2024-05-23', '2024-05-05 00:03:03'),
('66368f2f3fb', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:26:58'),
('66368f2f3fb', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:28:55'),
('66368f2f3fb', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:29:26'),
('66368f2f3fb', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:34:02'),
('66368f2f3fb', 19, '0', '662cd52db1ff8', 1, '2024-05-23', '2024-05-28', '2024-05-04 18:57:35'),
('66368f2f3fb', 19, '0', '662cd52db1ff8', 1, '2024-05-29', '2024-05-31', '2024-05-04 19:27:16'),
('66368f2f3fb', 19, '0', '662cd52db1ff8', 1, '2024-05-23', '2024-05-29', '2024-05-04 19:29:03'),
('66368f2f3fb', 19, '0', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:27:22'),
('66368f2f3fb', 19, '0', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:29:30'),
('66368f2f3fb', 19, '0', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:34:06'),
('66368f2f3fb', 19, '0', '662cd5ee8a0db', 20, '2024-05-16', '2024-05-30', '2024-05-04 18:57:49'),
('66368f2f3fb', 19, '0', '662cd5ee8a0db', 16, '2024-05-01', '2024-05-03', '2024-05-04 19:27:32'),
('66368f2f3fb', 19, '0', '662cd5ee8a0db', 3, '2024-06-06', '2024-06-09', '2024-05-04 19:29:42'),
('66368f2f3fb', 19, '0', '662cd66a015c8', 37, '0000-00-00', '0000-00-00', '2024-05-04 19:27:38'),
('66368f2f3fb', 19, '662509948d643', '0', 1, '2024-05-03', '2024-05-23', '2024-05-04 19:28:52'),
('66368f2f3fb', 19, '6626b4876a773', '0', 1, '2024-05-16', '2024-05-22', '2024-05-04 18:57:19'),
('66368f2f3fb', 19, '662cb37c96c5a', '0', 1, '2024-05-15', '2024-05-30', '2024-05-04 19:27:07'),
('66369011a03', 19, '0', '662cd4f181bc6', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:43:16'),
('66369011a03', 19, '0', '662cd52db1ff8', 1, '2024-05-24', '2024-05-27', '2024-05-04 19:43:22'),
('66369011a03', 19, '0', '662cd58174dd1', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:43:26'),
('6636905420e', 19, '0', '662cd52db1ff8', 1, '2024-05-22', '2024-05-29', '2024-05-04 19:44:51'),
('6636905420e', 19, '0', '662cd5a9b1315', 1, '0000-00-00', '0000-00-00', '2024-05-04 19:44:58'),
('6636905420e', 19, '0', '662cd66a015c8', 45, '0000-00-00', '0000-00-00', '2024-05-04 19:44:43');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
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
  `pdp` varchar(100) DEFAULT 'images/default/image_default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `id_panier`, `nom`, `prenom`, `mail`, `tel`, `bio`, `role`, `username`, `mot_de_passe`, `pdp`) VALUES
(1, 0, 'amin', 'rachdi', 'aminamin@amin.amin', 0, '', '', 'amin', '147258369', 'images/profile/1.jpg'),
(9, 0, 'amine', 'rachdi', 'rimrim@rim.r', 20111211, 'ijijiji', '', 'rimderbali', '147258369', 'images/profile/9.jpg'),
(11, 0, 'amine', 'rachdie', 'am@amm.mm', 20111211, 'ijijiji', '', 'amin', '123456789', 'images/profile/11.jpg'),
(12, 0, 'test', 'test', 'amamama@e.e', 78945211, 'ssss', '', 'amin', '147258369', NULL),
(13, 0, 'amin', 'rachdi', 'rachdiamine@r.r', 20144744, 'fsss', '', 'aminemine', '147258369', 'images/profile/13.jpg'),
(14, 0, 'okok', 'okok', 'ab@a.a', 20144744, 'aa', '', 'aba.a', '147258369', 'images/profile/14.jpg'),
(15, 0, 'am', 'amm', 'amam@gg.g', 28789123, 'ojojoi', '', 'amamgma', '147258369', NULL),
(16, 0, 'aijifj', 'ijijij', 'amin@amin.fr', 78945211, 'opsdkgodpgk', '', 'ajinn', '123456789', NULL),
(17, 0, 'wijden', 'zerai', 'wijlwij@wij.wij', 212322550, 'actrice', '', 'wijdenwajdounahobamouna', '123456789', 'images/profile/17.jpg'),
(18, 0, 'Toubale', 'Molka', 'molkatoubale23@gmail.com', 12345678, 'srsfglihgutdetsdugohpmu', 'user', 'molka_toubale', '123456789', NULL),
(19, 0, 'malouche', 'rayen', 'rayenmalouche27@gmail.com', 55737055, 'dajkdbl', 'user', 'rayen.malouche', '0123456789', NULL),
(22, 0, 'chedi', 'rhimi', 'rayenmalouche@gmail.com', 55737055, 'dvakdvgdbezfBLFKZ', 'user', 'rayenmalouche@gmail.com', '123456789', NULL),
(24, 0, 'aziz', 'saidi', 'az@gmail.com', 55737055, 'boezfufbL9BF4UFONL', 'user', 'aziz.saidi', '123456789', NULL),
(25, 0, 'rami', 'rami', 'rami@gmail.com', 55737055, 'gkigvgkvhb khl', 'user', 'rami.rami', '123456789', NULL),
(26, 0, 'hi', 'hello', 'hello@gmail.com', 55737055, 'djkabflfEZG4', 'user', 'rayenmalou@gmail.com', '123456789', NULL),
(27, 0, 'malouche', 'rayen', 'rayee27@gmail.com', 55737055, 'dzbiGFVEzk bhj gkr', 'user', 't.t', '123456789', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1` (`id_frs`);

--
-- Index pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD PRIMARY KEY (`id_equipe`,`id_frs`,`id_candidat`),
  ADD KEY `fk2` (`id_candidat`),
  ADD KEY `fk3` (`id_frs`);

--
-- Index pour la table `crm`
--
ALTER TABLE `crm`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_frs` (`id_frs`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_event`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id_event`,`id_user`,`id_equipe`,`id`,`date_ajout`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `utili_panier` (`id_panier`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `candidatures`
--
ALTER TABLE `candidatures`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_candidat`) REFERENCES `utilisateur` (`id_user`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `equipes_ibfk_1` FOREIGN KEY (`id_frs`) REFERENCES `utilisateur` (`id_user`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utili_panier` FOREIGN KEY (`id_panier`) REFERENCES `panierrr` (`id_panier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
