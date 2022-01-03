-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 13 juin 2020 à 20:41
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sitemarchand`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `IDENTIFIANT` varchar(40) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `PROFIL` varchar(40) NOT NULL,
  `MOTDEPASSE` varchar(60) NOT NULL,
  PRIMARY KEY (`IDENTIFIANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`IDENTIFIANT`, `EMAIL`, `PROFIL`, `MOTDEPASSE`) VALUES
('admin', 'admin', 'Super', '$2y$10$6nw85W11aDX/1jG0sVFA3u2cxBWGRvAdr22VIjAlUNbpJextda08O'),
('test', 'test@yopmail.com', 'Employé', '$2y$10$SbbbUdSH4nvkJQ91oDJXXOevRcXrORxPX9P5J7gkZ7DcKg8TLexBm'),
('test1', 'test1@yopmail.com', 'Employé', '$2y$10$IeDg.tBSwAc7aKyZ1L03W.Gkgtk7QBTa8kEC/G3LMmdbicGYSJkRC'),
('test2', 'test2@yopmail.com', 'Employé', '$2y$10$MDsyMgNNQGXBC2/MEIgOwu3zbKXRj2.l1rtzkcTNbAj3.qawJ1C/y');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `NOANNONCE` int(2) NOT NULL AUTO_INCREMENT,
  `TITRE` varchar(128) NOT NULL,
  `ANNONCE` text NOT NULL,
  `DATE_ANNONCE` datetime NOT NULL,
  PRIMARY KEY (`NOANNONCE`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`NOANNONCE`, `TITRE`, `ANNONCE`, `DATE_ANNONCE`) VALUES
(1, ' test 1', 'test', '2020-06-10 21:45:31'),
(2, 'test2', 'test2', '2020-06-10 22:14:37'),
(3, 'objet', 'message', '2020-06-10 22:20:22'),
(4, 'objet', 'message', '2020-06-10 22:26:29'),
(5, 't', 't', '2020-06-10 22:28:40'),
(6, 'reduction ', 'Tout nos produits de la catégorie jeu de tir son à -70%', '2020-06-10 23:13:07'),
(7, 'test', 'test', '2020-06-12 21:12:29');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `NOCATEGORIE` int(2) NOT NULL AUTO_INCREMENT,
  `LIBELLE` varchar(50) NOT NULL,
  PRIMARY KEY (`NOCATEGORIE`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`NOCATEGORIE`, `LIBELLE`) VALUES
(2, 'Survie'),
(3, 'Course'),
(4, 'Aventure'),
(5, 'Gestion'),
(7, 'Plate-forme'),
(8, 'Simulation'),
(11, 'Combat'),
(13, 'Stratégie'),
(15, 'Coopération'),
(16, 'Action'),
(19, 'Sport');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `NOCLIENT` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(40) NOT NULL,
  `PRENOM` varchar(40) NOT NULL,
  `ADRESSE` varchar(128) DEFAULT NULL,
  `VILLE` varchar(40) DEFAULT NULL,
  `CODEPOSTAL` int(2) DEFAULT NULL,
  `EMAIL` varchar(30) NOT NULL,
  `MOTDEPASSE` varchar(60) NOT NULL,
  PRIMARY KEY (`NOCLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`NOCLIENT`, `NOM`, `PRENOM`, `ADRESSE`, `VILLE`, `CODEPOSTAL`, `EMAIL`, `MOTDEPASSE`) VALUES
(1, 'Test', 'Test', '4 rue des hirondelles sur mer', 'SAINT-BRIEUC', 29145, 'test@sfr.com', '$2y$10$k.UH08HgeSk3OwpSHlDCwO4XyFU85f4keDrarnMbyCpM18xsSjX5K'),
(2, 'Test', 'Test', 'test', 'TEST', 12345, 'test1@yopmail.com', '$2y$10$SaxviojEgzcsjC3u0YbNVeTJNQlMZu8Uqso1ZHRpu7kyV4m5j.X6i'),
(4, 'Test', 'Test', 'test', 'TEST', 12345, 'test@yopmail.com', '$2y$10$v87QjkumcyXaLnGYAG4WoOnsWWIDU354smp1T8sZMXXE1H9ZNblXu'),
(5, 'A', 'A', 'a', 'A', 12345, 'a@yopmail.com', '$2y$10$QqpqOUrrX/FTwG84riIDDu8JHjQycchU4VaBWOEjuMSx38tWEFWrm');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `NOCOMMANDE` int(2) NOT NULL AUTO_INCREMENT,
  `NOCLIENT` int(2) NOT NULL,
  `DATECOMMANDE` datetime NOT NULL,
  `TOTALHT` decimal(10,2) NOT NULL,
  `TOTALTTC` decimal(10,2) NOT NULL,
  `DATETRAITEMENT` datetime DEFAULT NULL,
  PRIMARY KEY (`NOCOMMANDE`),
  KEY `I_FK_COMMANDE_CLIENT` (`NOCLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`NOCOMMANDE`, `NOCLIENT`, `DATECOMMANDE`, `TOTALHT`, `TOTALTTC`, `DATETRAITEMENT`) VALUES
(20, 1, '2020-05-24 14:22:21', '24.24', '35.38', '2020-05-24 14:22:21'),
(21, 1, '2020-05-24 14:51:56', '39.13', '55.15', '2020-05-24 14:51:56'),
(22, 1, '2020-05-24 15:00:16', '11.73', '25.86', '2020-05-27 01:31:25'),
(24, 2, '2020-05-28 16:13:07', '14.99', '17.99', '2020-05-31 21:58:31'),
(25, 2, '2020-05-28 16:14:29', '19.42', '23.30', '2020-05-31 21:58:04'),
(26, 1, '2020-05-28 22:22:28', '50.71', '102.49', '2020-06-03 01:47:33'),
(27, 1, '2020-05-28 22:43:30', '18.24', '21.89', '2020-06-12 01:47:43'),
(28, 1, '2020-05-28 22:44:25', '18.24', '43.78', '2020-06-12 01:47:47'),
(29, 1, '2020-05-29 01:08:13', '65.53', '91.29', NULL),
(30, 1, '2020-05-29 13:23:19', '11.99', '14.39', NULL),
(31, 1, '2020-05-29 13:25:45', '15.90', '19.08', NULL),
(32, 1, '2020-05-29 13:26:49', '6.99', '8.39', NULL),
(33, 2, '2020-05-29 14:04:03', '7.49', '8.99', '2020-05-31 21:55:01'),
(34, 1, '2020-05-29 22:58:51', '59.71', '134.89', NULL),
(35, 1, '2020-05-29 23:02:09', '16.63', '19.96', NULL),
(36, 1, '2020-05-29 23:03:51', '10.54', '12.65', NULL),
(37, 1, '2020-05-29 23:05:41', '15.90', '19.08', NULL),
(38, 1, '2020-05-29 23:07:44', '10.12', '12.14', NULL),
(39, 1, '2020-05-29 23:08:17', '28.72', '34.46', NULL),
(40, 1, '2020-05-31 15:21:20', '34.36', '65.95', NULL),
(41, 1, '2020-05-31 15:22:47', '15.90', '19.08', NULL),
(42, 4, '2020-06-02 13:03:35', '40.71', '48.85', NULL),
(54, 4, '2020-06-11 01:02:30', '14.99', '17.99', NULL),
(55, 4, '2020-06-11 01:05:02', '20.99', '25.19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `identifiants_site`
--

DROP TABLE IF EXISTS `identifiants_site`;
CREATE TABLE IF NOT EXISTS `identifiants_site` (
  `NOIDENTIFIANT` int(11) NOT NULL AUTO_INCREMENT,
  `SITE` varchar(20) DEFAULT NULL,
  `RANG` varchar(128) DEFAULT NULL,
  `IDENTIFIANT` varchar(20) DEFAULT NULL,
  `CLEHMAC` varchar(255) DEFAULT NULL,
  `SITEENPRODUCTION` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NOIDENTIFIANT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `identifiants_site`
--

INSERT INTO `identifiants_site` (`NOIDENTIFIANT`, `SITE`, `RANG`, `IDENTIFIANT`, `CLEHMAC`, `SITEENPRODUCTION`) VALUES
(1, '1999888', '32', '107904482', '0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF0123456789ABCDEF', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

DROP TABLE IF EXISTS `ligne`;
CREATE TABLE IF NOT EXISTS `ligne` (
  `NOCOMMANDE` int(2) NOT NULL,
  `NOPRODUIT` int(2) NOT NULL,
  `QUANTITECOMMANDEE` double(5,2) NOT NULL,
  PRIMARY KEY (`NOCOMMANDE`,`NOPRODUIT`),
  KEY `I_FK_LIGNE_COMMANDE` (`NOCOMMANDE`),
  KEY `I_FK_LIGNE_PRODUIT` (`NOPRODUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ligne`
--

INSERT INTO `ligne` (`NOCOMMANDE`, `NOPRODUIT`, `QUANTITECOMMANDEE`) VALUES
(20, 24, 2.00),
(20, 42, 1.00),
(21, 1, 1.00),
(21, 14, 1.00),
(21, 29, 3.00),
(22, 17, 1.00),
(22, 21, 2.00),
(22, 29, 3.00),
(24, 3, 1.00),
(25, 7, 1.00),
(26, 1, 2.00),
(26, 21, 3.00),
(26, 42, 1.00),
(27, 31, 1.00),
(28, 31, 2.00),
(29, 11, 2.00),
(29, 19, 1.00),
(30, 2, 1.00),
(31, 10, 1.00),
(32, 14, 1.00),
(33, 13, 1.00),
(34, 1, 2.00),
(34, 2, 3.00),
(34, 42, 1.00),
(35, 5, 1.00),
(36, 11, 1.00),
(37, 10, 1.00),
(38, 25, 1.00),
(39, 1, 1.00),
(40, 24, 3.00),
(40, 25, 2.00),
(40, 42, 1.00),
(41, 10, 1.00),
(42, 1, 1.00),
(42, 2, 1.00),
(54, 3, 1.00),
(55, 4, 1.00);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `NOMARQUE` int(2) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) NOT NULL,
  PRIMARY KEY (`NOMARQUE`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`NOMARQUE`, `NOM`) VALUES
(3, 'Nintendo'),
(5, 'Microsoft'),
(6, 'EA'),
(7, 'Blizzard'),
(8, 'Activision'),
(9, 'Studio Wildcard'),
(10, 'Hello Games'),
(11, 'Rockstar Games'),
(12, 'Volition'),
(13, 'Overkill Software'),
(14, 'Bethesda'),
(15, 'Namco'),
(16, 'Capcom'),
(17, 'Offworld Industries'),
(18, 'Team17'),
(19, 'Bohemia Interactive'),
(20, 'Facepunch Studios'),
(21, 'Westwood Studios'),
(22, 'Pyro Studios'),
(23, 'Boneloaf Games'),
(24, 'Ubisoft'),
(25, 'Psyonix');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `EMAIL` varchar(150) NOT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`EMAIL`) VALUES
('test1@sfr.fr'),
('test2@sfr.fr'),
('test@sfr.fr');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `NOPRODUIT` int(2) NOT NULL AUTO_INCREMENT,
  `NOCATEGORIE` int(2) NOT NULL,
  `NOMARQUE` int(2) NOT NULL,
  `LIBELLE` varchar(128) NOT NULL,
  `DETAIL` text NOT NULL,
  `PRIXHT` decimal(10,2) NOT NULL,
  `TAUXTVA` decimal(10,2) NOT NULL,
  `NOMIMAGE` varchar(50) NOT NULL,
  `QUANTITEENSTOCK` double(5,2) NOT NULL,
  `DATEAJOUT` date NOT NULL,
  `DISPONIBLE` tinyint(1) NOT NULL,
  `VITRINE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NOPRODUIT`),
  KEY `I_FK_PRODUIT_CATEGORIE` (`NOCATEGORIE`),
  KEY `I_FK_PRODUIT_MARQUE` (`NOMARQUE`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`NOPRODUIT`, `NOCATEGORIE`, `NOMARQUE`, `LIBELLE`, `DETAIL`, `PRIXHT`, `TAUXTVA`, `NOMIMAGE`, `QUANTITEENSTOCK`, `DATEAJOUT`, `DISPONIBLE`, `VITRINE`) VALUES
(1, 4, 10, 'No Man\'s Sky', 'Chaque monde est unique. À vous de plonger dans l\'infini. Voyagez depuis les profondeurs de l\'espace pour répondre à l\'appel irrésistible d\'un mystère situé au centre de la galaxie. Préparez votre voyage à travers un univers vivant sur une échelle jamais vue auparavant, et découvrez de nouveaux mondes parmi les 18 446 744 073 709 551 616 planètes uniques possibles. Rencontrez de nouvelles espèces,\r\nrécoltez de précieuses ressources et marquez à tout jamais vos royaumes célestes sur la carte galactique pour que d\'autres astronautes puissent les visiter. Forgez votre destinée en tant que marchand, explorateur, chasseur de primes, mineur, pirate ou tout autre rôle interstellaire de votre choix,\r\net amassez la fortune nécessaire pour améliorer votre vaisseau et votre équipement. Au fur et à mesure que vous vous rapprocherez de votre objectif, votre voyage deviendra plus dangereux, vous poussant ainsi à participer à des combats spatiaux à grande échelle…et à découvrir la vérité qui se cache au centre du cosmos. ', '28.72', '5.74', 'No_man_sky', 41.00, '2020-05-16', 1, NULL),
(2, 16, 11, 'GTA V', 'Le très acclamé jeu en monde ouvert de Rockstar Games passe à la nouvelle génération Entrez dans la peau de trois criminels très différents, Michael, Franklin et Trevor, pendant qu’ils risquent le tout pour le tout dans une série de braquages audacieux et dangereux qui\r\npourraient leur coûter la vie.\r\nExplorez le monde éblouissant de Los Santos et Blaine County dans la meilleure expérience de Grand\r\nTheft Auto V, comprenant un éventail d’améliorations techniques et de nouveautés pour les\r\nnouveaux joueurs mais aussi les anciens. En plus d’une profondeur de champs accrue et d’une\r\nrésolution supérieure, les joueurs découvriront un ensemble d’ajouts et d’améliorations\r\ncomprenant :\r\n- Nouvelles armes, véhicules et activités\r\n- Nouvelle faune et flore\r\n- Circulation plus dense\r\n- Nouveau système de végétation\r\n- Effets de dégâts et de météo plus persistants, et bien plus encore\r\n\r\nGrand Theft Auto V inclut également Grand Theft Auto Online, l\'univers en ligne dynamique de Grand Theft Auto en constante évolution avec des parties en ligne désormais jusqu’à 30 joueurs sur PlayStation®4. Toutes les améliorations existantes de gameplay, les activités validées et le contenu créé par Rockstar depuis le lancement de Grand Theft Auto Online seront également disponibles sur PlayStation®4 en plus de bien d\'autres surprises à venir. ', '11.99', '2.40', 'GTA5', 31.00, '2020-05-16', 1, NULL),
(3, 16, 24, 'Rainbow Six Siege', 'Rainbow Six Siege marque le retour de la franchise phare des FPS tactiques. Ce nouvel opus renouvelle le genre du FPS multijoueur en apportant des évolutions majeures tout en gardant l’ADN de la franchise. Les joueurs sont invités à maîtriser l’art du siège, aussi bien dans la peau des attaquants que dans celle des défenseurs. Combats rapprochés, tactique, jeu en équipe et environnements dynamiques sont au cœur de l’expérience. FORCES SPÉCIALES & AGENTS Dans Rainbow Six Siege, découvrez les plus célèbres Forces Spéciales du monde : le GIGN, le SWAT, les SPETSNAZ, les SAS et le GSG9. Chacune de ces unités d’élite aura des habilités spécifiques inspirées par leur véritable doctrine militaire. Vos choix détermineront votre spécialité. Mobilité ou protection, destruction ou infiltration… chaque choix aura son incidence dans la partie à venir. ENVIRONNEMENTS DYNAMIQUES Pour la première fois dans Rainbow Six, les joueurs se confronteront lors de Sièges, un tout nouveau style d’assauts asymétriques. AFFRONTEMENTS TACTIQUES INTENSES En tant que spécialistes du combat rapproché, vous évoluerez en équipes de 5 joueurs, dans des environnements intérieurs. Le rôle de chaque Agent sera ainsi décisif, dans la victoire, comme dans la défaite. LE RETOUR D’UN MODE HISTORIQUE Rainbow Six Siege marque également le retour d’un mode de jeu tant apprécié par les fans : la Chasse aux Terroristes. Cette fois, les joueurs feront face à une menace inédite dans l’univers de Rainbow Six : les White Masks. Jouable seul ou en coopérations jusqu’à 5, le mode Chasse aux Terroristes place le joueur dans des situations hostiles face à de nombreux ennemis contrôlés par une nouvelle IA qui leur permettra de réagir directement et efficacement aux actions et choix tactiques des joueurs. ', '14.99', '3.00', 'R6', 98.00, '2020-05-16', 1, 1),
(4, 19, 6, 'Fifa 20', 'Doté du moteur Frostbite, EA SPORTS FIFA 20 vous propose deux facettes du Jeu Universel : le prestige du football professionnel et une nouvelle expérience réaliste de street football avec EA SPORTS VOLTA FOOTBALL. FIFA 20 innove sur tous les plans : le FOOTBALL INTELLIGENT vous offre un réalisme sans précédent, FIFA Ultimate Team vous propose de nouvelles façons de créer votre équipe de rêve et EA SPORTS VOLTA FOOTBALL vous plonge dans le monde du street avec des terrains réduits. ', '20.99', '4.20', 'Fifa20', 11.00, '2020-05-16', 1, NULL),
(5, 16, 6, 'Battlefield 5', 'Participez au plus grand conflit de l\'Histoire avec Battlefield V. La licence revient aux sources et dépeint la Seconde Guerre mondiale comme jamais auparavant. Livrez des batailles multijoueur frénétiques et brutales aux côtés de votre escouade dans des modes imposants comme Grandes opérations et coopératifs comme Tir groupé. Assistez également à des batailles méconnues dans un contexte de conflit mondial avec les récits de guerre du mode solo. Combattez dans des environnements inédits et spectaculaires aux quatre coins du monde et découvrez le jeu Battlefield plus riche et plus immersif à ce jour. Des combats à 64 joueurs dans le chaos de la guerre totale – Menez votre compagnie dans des batailles totales en multijoueur et découvrez d\'expériences de jeu comme l\'imposant mode grandes opérations. Jouez à des modes classiques comme Conquête ou faites équipe avec vos amis dans le mode Tir groupé, axé sur la coopération. ', '16.63', '3.33', 'bf5', 26.00, '2020-05-16', 1, NULL),
(6, 4, 3, ' Animal Crossing', 'Si l\'agitation de la vie moderne vous épuise, Tom Nook vous réserve un nouveau produit que vous allez adorer... la formule Évasion île déserte de Nook Inc. !\r\n\r\nVous avez probablement déjà croisé la route de personnages attachants, passé d\'excellents moment en compagnie des villageois, et peut-être avez-vous même rendu service à la communauté. Mais au fond, n\'y a-t-il pas une part de vous-même qui aspire à davantage... de liberté ? Une opportunité de faire ce que vous voulez, quand vous voulez ? Alors peut-être qu\'une longue marche sur la plage d\'une île déserte à la nature luxuriante est exactement ce qu\'il vous faut !\r\n\r\nVivez une existence paisible pleine de charme, tout en travaillant d\'arrache-pied pour faire de votre nouvelle vie celle dont vous rêvez.\r\n\r\nCollectez des ressources pour créer toutes sortes de choses, des objets nécessaires à votre bien-être aux outils les plus utiles. Renforcez votre lien avec la nature en interagissant avec les fleurs et les arbres de manières inédites. Faites-vous un petit chez-vous idéal en vous affranchissant des codes de la décoration intérieure et extérieure.\r\n\r\nTissez des liens avec les nouveaux arrivants, admirez le passage des saisons, sautez à la perche par-dessus les rivières et plus encore !', '47.99', '9.60', 'animal_crossing', 5.00, '2020-05-16', 1, NULL),
(7, 4, 5, 'Minecraft', ' Créez. Explorez. Survivez.\r\nUn monde immense à découvrir, explorez d\'immenses montagnes et des océans vivants dans des mondes infinis ou sur des environnements crées par la communauté\r\nUn jeu où l\'imagination est la seule limite, minecraft met au coeur du jeu la construction et l\'aventure, réalisez tout ce que vous pouvez imaginer ', '19.42', '3.88', 'minecraft', 34.00, '2020-05-16', 1, NULL),
(8, 16, 11, 'Red Dead Redemption 2', 'Red Dead Redemption 2 pour PC est un jeu d\'action et d\'aventure, open world, dans lequel le joueur peut errer librement et jouer à la troisième personne, tout en revenant à la première personne en mode simulation. Le joueur peut commettre des crimes, mais il doit ensuite être prêt à être traqué par les forces de l\'ordre, prêt à faire peser toute la force de la loi contre le malfaiteur !\r\n\r\nContrairement aux jeux où le chaos et la destruction sont la clé, ce jeu vous permet de plonger dans la beauté des paysages du Far West, et de créer des liens empathiques et sympathiques avec d\'autres joueurs et PNJ (personnages non joueurs) dans les moments entre les séquences d\'action - qui sont aussi nombreux.\r\n\r\n', '36.99', '7.40', 'RDR2', 6.00, '2020-05-16', 1, 0),
(9, 4, 5, 'Sea of Thieves', 'Sea of Thieves est un jeu d\'action et d\'aventure en haute mer dans lequel les joueurs doivent naviguer sur un océan au rendu magnifique. Les jeux de lumière sur l\'eau sont parfaitement restitués, et le simple fait de naviguer en regardant l\'océan est un bon moyen de tuer le temps en attendant que vos amis se joignent à vous.\r\n\r\nLes joueurs peuvent se glisser dans la peau de pirates ou dans la peau de marins. Lorsque vous jouez avec ces personnages, vous êtes équipé d\'un navire, de quelques compagnons si vous jouez en mode multi-joueurs ou en mode co-op, et d\'instructions minimales du genre : \"Naviguez jusqu\'à une île et rapporter quelque chose de valeur. Jouer au pirate est, comme vous pouvez l\'imaginer, sans loi et potentiellement plus divertissant ! Suivez d\'autres navires et attaquez-les pour leur or et leur butin, en les saisissant et en les emportant au port pour vous les approprier.\r\n\r\nEn tant que marin, le principe est simple : accepter une mission et partir vers une île, en utilisant la carte de bord pour vous guider. Une fois sur l\'île, déterrer un trésor, combattez des squelettes ou résolvez une énigme - et vous serez récompensé si vous gagnez. Puis revenez - avec votre butin si possible - au port d\'attache et acceptez une autre mission pour repartir à zéro.', '29.98', '6.00', 'sea_of_thieves', 35.00, '2020-05-16', 1, 1),
(10, 16, 7, 'Overwatch', 'Overwatch sur PC est un jeu de tir à la première personne multijoueur en équipe développé par Blizzard Entertainment, qui est également connu pour les jeux très populaires de World of Warcraft et leurs dérivés.\r\nUne fois que les joueurs s\'inscrivent, ils sont répartis en deux équipes de six avec d’autres joueurs. Chaque joueur peut choisir parmi 30 personnages au maximum (dans le jeu, on les appelle des héros). Les personnages sont tous personnalisables : incluant des traits de personnalité et physiques charmants et originaux. Ces particularités peuvent inclure un joli sourire, une mèche de cheveux qui tombe sur leur visage à un moment donné, et de nombreuses autres caractéristiques subtiles mais non négligeables.\r\n\r\nChacune se voit confier une mission ou une série de missions qui peuvent inclure soit la défense ou l\'attaque de forteresses et de laboratoires, soit l\'escorte de cargaisons ou de charges utiles sur la carte, afin de protéger les objets de valeur contre les attaques.\r\n\r\nChaque mission accomplie avec succès donne lieu à des prix pour l\'équipe gagnante, et des récompenses. Voici les exemples de prix et de récompenses que le jeu offre lorsque les missions sont accomplies : des améliorations et des mises à niveau qui vous donnent un air cool. La capacité n\'est pas extensible grâce à ces prix, qui sont juste esthétiques mais ils ajoutent beaucoup à l\'image que renvoie votre personnage.\r\n', '15.90', '3.18', 'overwatch', 81.00, '2020-05-16', 1, 0),
(11, 16, 12, 'Agents of Mayhem', 'Parfois il faut combattre le mal par le mal. Ce groupe d\'élite de héros aussi instables que dérangés, équipés d\'armes complètement folles, est sous les ordres d\'un ancien lieutenant de la LEGION, Persephone Brimstone, et de son bras droit Friday. Leur mission : abattre la LÉGION et son mystérieux chef, Morningstar. Explorez la ville de Séoul avec une équipe de trois agents interchangeables, chacun ayant son propre look, son propre sens de l\'humour, ses armes préférées et ses compétences spécifiques. Les joueurs peuvent façonner leur équipe comme ils le souhaitent, en passant de Daisy, la derby-girl au langage peu châtié équipée d\'une mitrailleuse et de bières, à Rama, une immunologue armée d\'un arc futuriste aux flèches énergétiques, en passant par Red Card, un hooligan amateur de foot au tempérament littéralement explosif.', '10.54', '2.11', 'agents_of_mayhem', 2.00, '2020-05-16', 1, NULL),
(12, 4, 24, 'Assassin\'s Creed: Origins', 'L\'Égypte ancienne, époque de grandeur et d\'intrigues, sombre dans une impitoyable lutte pour le pouvoir. Dévoilez des secrets et des mythes oubliés à un moment crucial : les origines de la Confrérie des Assassins.\r\nNaviguez sur le Nil, découvrez les mystères des pyramides ou affrontez factions et animaux sauvages dans ces contrées gigantesques et imprévisibles.\r\nLancez-vous dans de multiples quêtes et histoires captivantes lors de vos rencontres avec des personnages marquants, des plus riches aux misérables parias.\r\nDécouvrez une toute nouvelle manière de combattre. Appropriez-vous et utilisez des dizaines d\'armes aux caractéristiques et à la rareté variées. Évoluez grâce aux mécanismes de progression et mettez vos compétences à l\'épreuve face à des boss uniques. \r\n', '14.99', '3.00', 'AC_origins', 46.00, '2020-05-16', 13, NULL),
(13, 4, 24, 'Assassin\'s Creed Unity', 'Assassin\'s Creed® Unity est un jeu d\'action-aventure en monde ouvert qui se déroule à Paris pendant la Révolution Française. Vous pourrez maintenant personnaliser votre héros, Arno, en choisissant son équipement. Cela aura un impact sur l\'aspect visuel, mais aussi sur le gameplay. En plus de la campagne solo, Assassin\'s Creed Unity permet de jouer à 4 dans des missions additionnelles scénarisées. Assistez aux moments clés de l\'Histoire de France, dans le monde ouvert le plus crédible et vivant jamais créé. ', '7.49', '1.50', 'AC_unity', 13.00, '2020-05-16', 1, NULL),
(14, 16, 13, 'Payday 2', 'Payday 2 reprend dans les grandes largeurs le concept de son aîné. On se trouve donc toujours devant un FPS coopératif jouable à quatre, qui nous met dans la peau d\'une violente bande de braqueurs. Cette fois, Dallas, Hoxton, Wolf et Chains ont décidé d\'exercer leur talent à Washington. Pour ce deuxième volet, le studio Overkill a, dans un premier temps, cherché à étoffer le contenu et à donner plus d\'ampleur à son titre. Les développeurs parlent désormais de narration, dans la mesure où les jobs peuvent parfois se découper en plusieurs missions permettant de vivre ce qu\'il se passe avant, pendant et après un braquage. Les différents scénarios –il en existera 30 à la sortie du jeu– offrent ainsi une vraie variété dans les objectifs à atteindre et les situations. On démarre notamment certaines missions directement dans le feu de l\'action. On doit par exemple protéger des sacs remplis de drogue récupérés au préalable. Après quelques secondes à peine, on se trouve sous une pluie de balles provenant de la police qui chasse la bande de la plus brutale des manières. Il faut alors faire face à cette menace tout en gérant son butin et ce n\'est pas une mince affaire lorsqu\'on sait qu\'une balle perdue peut enflammer le camion qui transporte la drogue et engendrer des pertes financières irréversibles. ', '6.99', '1.40', 'payday2', 35.00, '2020-05-16', 1, 1),
(15, 3, 3, 'Mario Kart 8 Deluxe', 'Mario Kart 8 Deluxe est un jeu de course de kart immédiatement reconnaissable, le huitième de la série Nintendo. Il met en vedette le plombier légendaire, Mario, et tous ses amis qui ont participé avec lui à ces jeux : Mario : Yoshi, la princesse Peaches, Bowser et bien entendu, le frère de Mario, Luigi ainsi que d\'autres. Il y a quarante-deux personnages parmi lesquels choisir, dont beaucoup sont instantanément reconnaissables dans la culture populaire.\r\n', '39.99', '8.00', 'mariot_kart8', 16.00, '2020-05-16', 1, NULL),
(16, 4, 14, 'Fallout 4', 'Bethesda Game Studios, studio de développement maintes fois récompensé à l\'origine de Fallout 3 et de The Elder Scrolls V: Skyrim, vous invite à découvrir Fallout 4, leur titre le plus ambitieux à ce jour incarnant la nouvelle génération du jeu en monde ouvert.\r\n\r\nDans la peau du seul survivant de l\'abri 111, vous émergez dans un monde dévasté par une guerre nucléaire. Votre survie sera un combat de tous les instants et vos choix façonneront votre destin. Vous seul avez le pouvoir de faire entrer les Terres désolées dans une nouvelle ère. Bienvenue chez vous.\r\n\r\nJouissez d\'une liberté d\'action sans précédent dans un monde ouvert offrant des centaines de lieux, de personnages et de quêtes. Rejoignez plusieurs factions dans leur combat pour la suprématie ou forgez votre destinée en loup solitaire, c\'est à vous seul de décider.\r\n\r\nIncarnez le personnage que vous voulez grâce au système S.P.E.C.I.A.L. Soldat en armure assistée ou baratineur charismatique, choisissez parmi des centaines d\'aptitudes et développez votre propre style de jeu.\r\n\r\nUn tout nouveau moteur graphique et une gestion des éclairages de nouvelle génération donnent vie au monde de Fallout comme jamais auparavant. Des forêts dévastées du Commonwealth aux ruines de Boston, chaque lieu fourmille de détails dynamiques.\r\nLes combats intenses à la première ou à la troisième personne peuvent aussi être ralentis grâce au nouveau Système de Visée Assistée Vault-Tec (SVAV) dynamique, qui vous permet de choisir vos attaques avant de profiter du carnage comme si vous y étiez.\r\n\r\nTrouvez, améliorez et créez des milliers d\'objets grâce au système de fabrication le plus sophistiqué jamais conçu. Armes, armures, substances chimiques et nourriture ne sont qu\'une infime partie des possibilités : vous pourrez même construire et gérer des colonies entières !', '12.99', '2.60', 'fallout4', 6.00, '2020-05-16', 1, NULL),
(17, 16, 8, 'Call of Duty: Black Ops II', 'Repoussant encore plus loin les limites de la franchise phare du secteur du divertissement, Call of Duty®: Black Ops 2 propulse le joueur dans un futur proche, au cœur de la Guerre froide du 21e siècle, là où technologie et armement ont convergé pour donner naissance à une toute nouvelle façon de faire la guerre. ', '5.32', '1.06', 'BO2', 1.00, '2020-05-16', 1, NULL),
(18, 5, 6, 'Les Sims 4', 'Comme pour les autres jeux et packs d\'extension de la série, vous contrôlez la vie de vos Sims complètement - ou presque - pendant qu\'ils passent leur vie à acheter ou à construire leurs maisons, à chercher un travail ou à faire des rencontres.\r\n\r\nIl n\'y avait pas de scénario défini dans le jeu original, mais plus tard, des packs d\'extension et des add-ons ont été ajouté pour lancer des défis aux Sims, leur donnant des missions à accomplir ou des parcours professionnels à suivre. Ce jeu est en grande partie un jeu de bac à sable qui vous donne beaucoup de latitude pour décider ce que vos Sims devraient faire de leur vie.\r\n\r\nCependant, comme les enfants, les Sims peuvent résister de façon inattendue : certains de ces traits de caractère sont plus des problèmes de codage, comme aller à un rendez-vous et choisir de s\'asseoir aux extrémités opposées du bar, crier à travers la foule pour draguer, tandis que certains Sims peuvent juste être excentriques ! Ces bizarreries sont engageantes et maintiennent votre intérêt intact pendant toute la partie: ce serait ennuyeux si tout le monde faisait ce qu\'on lui disait !\r\n\r\nCe jeu se déroule dans un cadre différent des autres jeux de la série, ouvrant de nouveaux horizons et de nouveaux terrains aux joueurs, qu\'ils soient nouveaux dans la série ou des habitués de longue date qui reviennent pour redonner vie à leurs Sims existants.\r\n\r\nLivrés à eux-mêmes, les Sims deviennent multitâches, tant que c’est possible comme pour écouter de la musique en faisant la vaisselle ou bavarder en regardant la télévision. Vous ne pourriez pas, par exemple, écrire un roman et faire le repassage en même temps.\r\n\r\nIl y a aussi des \"moodlets\" qui mettent votre Sim dans un état d\'esprit différent : ils peuvent être détendus, ils peuvent être vraiment en colère ou ils peuvent être vraiment excités. C\'est une excellente façon de rendre les plans de vos Sims plus réels : être excité à l\'idée d\'un rendez-vous amoureux donne une toute autre ambiance à l\'atmosphère et aux préparatifs des Sims pour ce genre d\'événement..', '9.00', '1.80', 'sims4', 0.00, '2020-05-16', 0, NULL),
(19, 4, 3, 'Zelda Breath of the Wild', 'The Legend of Zelda : Breath of the Wild pour Nintendo Switch est un jeu d\'action et d\'aventure, le dernier né de la série Legends of Zelda. Le jeu est assez libre, avec peu d\'instructions données aux joueurs. Le jeu consiste principalement à rassembler des ressources, à remplir des missions annexes et à résoudre des énigmes.\r\n\r\nUne grande partie du charme du jeu tourne autour du fait qu\'il récompense l\'expérimentation, vous êtes donc positivement encouragés à sortir du scénario et à explorer les zones de la carte hors de la voie. Le scénario principal peut se dérouler de façon non linéaire, de sorte que vous pouvez choisir comment et quand accomplir chaque tâche plutôt que d\'être contraint à un plan d\'action restreint.\r\n\r\nSon graphisme soigné et son jeu vocal de haute qualité lui ont valu d\'être nommé Jeu de l\'année et il a été présenté comme l\'un des plus grands jeux vidéo de tous les temps ainsi que, bien entendu avec le jeu Zelda qui a été le plus vendu.', '54.99', '11.00', 'zeldaBOTW', 1.00, '2020-05-16', 1, NULL),
(20, 4, 14, 'Fallout 76', 'Bethesda Game Studios, créateurs maintes fois récompensés de Skyrim et Fallout 4, vous souhaitent la bienvenue dans Fallout 76, le prequel en ligne où tous les humains survivants sont de vraies personnes. Pour survivre, travaillez ensemble. Ou pas. Dans l\'ombre de la menace d\'un cataclysme nucléaire, découvrez le monde le plus étendu et le plus vivant jamais créé dans l\'univers légendaire de Fallout.\r\nFête de la Reconquête, 2102. Vingt-cinq ans se sont écoulés depuis le bombardement, lorsque vous et les autres résidents de l\'abri, triés sur le volet parmi ce que le pays avait de mieux à offrir, vous aventurez dans une Amérique post-nucléaire. Jouez seul ou avec d\'autres personnes afin d\'explorer, d\'accomplir des quêtes, de construire, et de venir à bout des plus grandes menaces des Terres désolées.\r\nLe multijoueur fait enfin son apparition au sein des RPG en monde ouvert épiques de Bethesda Game Studios. Créez votre personnage grâce au système S.P.E.C.I.A.L et forgez votre propre destinée dans une nouvelle région sauvage et dévastée, avec des centaines de lieux à découvrir. Que vous voyagiez seul ou avec des amis, une nouvelle et unique aventure Fallout vous attend.\r\nGrâce à de tout nouveaux graphismes, éclairages et technologies de modélisation de l\'environnement, les six régions différentes de la Virginie-Occidentale semblent plus vivantes que jamais. Parcourez les forêts des Appalaches ou les terres pourpres et toxiques de la Tourbière ; chaque région vous offrira ses propres récompenses et comportera ses propres dangers. L\'Amérique post-nucléaire n\'a jamais été aussi belle !\r\nUtilisez le tout nouveau Centre d\'Assemblage et de Montage Portatif (C.A.M.P) pour construire et fabriquer où bon vous semble. Votre C.A.M.P vous offrira un abri, du matériel, et une sécurité indispensables. Vous pourrez même établir une boutique pour échanger des produits avec d\'autres survivants. Mais faites attention, tout le monde ne sera pas aussi bienveillant.\r\nSeul ou avec d\'autres survivants, vous devrez déverrouiller l\'accès à l\'arme ultime : des missiles nucléaires. La destruction engendrée est également à l\'origine d\'une zone à haut niveau comportant des ressources rares et précieuses. Choisirez-vous de protéger ou de déchaîner la puissance de l\'atome ? Le choix vous appartient.', '16.49', '3.30', 'fallout76', 999.00, '2020-05-16', 1, NULL),
(21, 4, 24, 'Assassin\'s Creed Brotherhood', 'Incarnez Ezio, un légendaire Maître Assassin, dans son combat acharné contre le puissant Ordre des Templiers. Pour porter un coup fatal à l\'ennemi, Ezio doit se rendre dans la plus grande ville d\'Italie : Rome. Un lieu de pouvoir, d\'avidité et de corruption.\r\n\r\nPour triompher des tyrans corrompus qui s\'y terrent, Ezio devra non seulement montrer qu\'il est un puissant combattant, mais aussi un meneur d\'hommes : une Confrérie entière sera placée sous ses ordres. Ce n\'est qu\'en travaillant ensemble que les Assassins vaincront leurs ennemis jurés.\r\n\r\nDécouvrez un mode multijoueur inédit ! Faites votre choix parmi de nombreux personnages aux armes et aux techniques d\'assassinat caractéristiques, et mesurez-vous à des joueurs du monde entier.\r\n\r\nIl est temps de rejoindre la Confrérie.', '2.99', '0.60', 'AC_brothehood', 5.00, '2020-05-16', 1, 1),
(22, 5, 24, 'Anno 1800', 'Anno 1800 sur PC est un jeu de construction de ville en temps réel. C’est la septième de la série Anno et le jeu retrouve son format historique après deux éditions futuristes: Anno 2070 et Anno 2205. L’histoire se déroule au début du XIXe siècle et suit l’explosion technologique et la révolution industrielle. \r\nPour progresser, vous devez faire croître votre population et garder vos citoyens heureux. Ce dernier objectif est atteint différemment pour chaque type de personnes : par exemple, les agriculteurs vivent de la pêche et de la récolte, mais se satisfont de l\'alcool. Le bonheur fait grandir la population... comme dans la vie réelle, non ? - et une fois qu\'une ferme est remplie, le bâtiment peut être transformé en logement pour les travailleurs.\r\n\r\nChaque catégorie de personnes apporte ses propres exigences, mais aussi ses propres avantages : vous devez donc mettre en balance leurs besoins et la valeur qu\'ils ont pour votre société. Tout comme dans la vie, plus le bâtiment est complexe, plus il faut d\'articles pour fabriquer des ressources et plus il faut de travailleurs pour les faire fonctionner. Les grandes usines peuvent avoir besoin de centaines de travailleurs, tous ont besoin de nourriture, vêtements, savons et logements.', '30.54', '6.11', 'anno1800', 5.00, '2020-05-16', 1, NULL),
(23, 4, 24, 'Assassin\'s Creed Odyssey', 'Assassins Creed Odyssey: Europe pour PC est le dernier-né de la série de jeux de rôle d\'action populaire et de grande envergure dans laquelle le joueur devient un assassin à une certaine époque (grèce antique). Il y a, à ce jour, dix jeux principaux et dix-sept jeux dérivés ainsi que beaucoup d\'autres produits, tels que des livres et des films.\r\nComme souvent, avec des mondes aussi soigneusement réalisés, il y a de multiples histoires qui se chevauchent, dont certaines peuvent être fortement influencées par le joueur. L\'intrigue générale traite de la tentative d\'éradiquer un culte grec maléfique ainsi que de la découverte de preuves de créatures et d\'artefacts de l\'Atlantide. Pendant ce temps, l\'histoire plus centrale traite de la tentative du personnage de réunir et de guérir sa famille, qui a été laissée pour morte dans sa jeunesse.\r\n\r\nLe jeu est fortement axé sur le jeu de rôle, et presque tous les joueurs choisissent une voie différente dans jeu. Le monde créé est très interactif puisqu’il comporte de nombreuses options de dialogues authentiques et la possibilité pour les missions de s\'étendre de plusieurs façons, ce qui - évidemment - offre l\'option de fins multiples. Cela signifie que vous pouvez jouer aussi souvent que vous le souhaitez sur des zones et des missions, obtenant à chaque fois des résultats différents.\r\n\r\nHomme/femme : Spartiate / Athénienne - le choix vous appartient\r\n\r\nLe joueur choisit d\'être un homme (Alexios) ou une femme (Kassandra) : un mercenaire descendant du célèbre Léonidas 1er de Sparte, qui a hérité de sa lance cassée et a retravaillé les fragments en une nouvelle arme puissante avec de nouveaux pouvoirs à explorer et à maîtriser.\r\n\r\nVous vous joignez à la bataille entre Sparte et Athènes en 431 av. J.-C. , et comme vous êtes un mercenaire, vous pouvez choisir d\'être de chaque côté, selon vos préférences. Comme le jeu est fortement axé sur l\'histoire, votre personnage peut avoir des relations romantiques avec des PNJ (personnages qui ne jouent pas). Vous pouvez même choisir des partenaires de même sexe, si vous le désirez, ce qui rend le jeu inclusif sans effort.', '16.32', '3.26', 'AC_odyssey', 34.00, '2020-05-16', 1, NULL),
(24, 4, 24, 'Assassin\'s Creed Syndicate', 'Londres, 1868.La Révolution Industrielle déclenche un incroyable âge d\'or des inventions, transformant les vies de millions de personnes grâce à des technologies qu\'on pensait auparavant impossibles. Le peuple converge vers Londres afin de profiter des opportunités qu\'offre ce nouveau monde. Un monde qui n\'est plus contrôlé par les rois, les empereurs, les politiciens ou la religion, mais par un nouveau dénominateur commun : l\'argent. Cependant, tout le monde ne profite pas des bénéfices qu\'offrent ces bouleversements. Même si le moteur de l\'Empire Britannique tourne à la force des travailleurs, ces derniers ne sont finalement pas plus que des esclaves payés une misère pendant que les nantis s\'enrichissent de leur travail. Vivant pauvre et mourant jeune, la classe populaire s\'unit alors dans un nouveau genre de famille - les gangs - se tournant vers la criminalité dans leur lutte pour survivre. ', '5.24', '1.05', 'AC_syndicate', 0.00, '2020-05-16', 0, NULL),
(25, 3, 24, 'The Crew 2', 'The Crew 2 est un jeu de course sur PC dans un monde ouvert dans lequel le joueur peut se déplacer librement, explorer et faire la course, au sein d’un monde évolutif vaguement basé sur le continent nord-américain. Les joueurs ont le choix entre des avions, des aéroglisseurs, des bateaux, des motos et, bien sûr, des voitures, y compris des monster trucks.\r\nLe paramétrage du jeu ne couvre que les états qui se trouvent sur le continent américain, donc l\'Alaska et Hawaii ne sont pas inclus cette fois-ci. Chaque type de véhicule a une ingénierie différente, de sorte que les moteurs se conduisent de manière unique en fonction de la conception de chaque véhicule : permettant aux joueurs d\'apporter des changements assez importants au résultat final, simplement en modifiant le véhicule qu\'ils utilisent.\r\n\r\nL\'objectif est de gagner des abonnés sur les réseaux sociaux : c\'est ainsi qu\'un joueur \"gagne\" dans le jeu. Inutile de dire que le nombre d\'abonnés atteint des sommets lorsque vous passez en premier dans les courses et les événements comme les cascades et autres activités similaires.', '10.12', '2.02', 'the_crew2', 3.00, '2020-05-16', 1, NULL),
(26, 16, 24, 'Far Cry 5', 'Far Cry 5 pour PC est un jeu de tir à la première personne amusant dans lequel vous devez être sur vos gardes contre des adversaires bizarres et farfelus. Les animaux et les ennemis tenteront de vous éliminer, tandis que d\'autres animaux et des étrangers pourraient les éliminer au hasard pour vous. Comme son nom l\'indique, tout est loin de la réalité !\r\nVous prenez le rôle de l\'adjoint d\'un shérif débutant, accompagnant vos collègues pour procéder à une arrestation. Votre mission est d\'arrêter un chef de secte nommé Joseph Seed qui a la mauvaise habitude de kidnapper les gens pour les forcer à rejoindre son culte apocalyptique.\r\n\r\nL\'arrestation prévue, une mission conjointe entre le shérif, ses hommes et les US Marshals, va mal tourner et Joseph Seed et son culte se dispersent dans la brousse, jurant que ceux qui s\'en sont mêlés soient punis. Un accident d\'hélicoptère tue certains de vos collègues, vous laissant à la recherche des membres de la secte et de Seed Down.\r\n\r\nLa tentative d\'arrestation conduit Seed à commencer sa partie finale, lui et ses partisans croyant que la fin du monde est proche sont prêts à tuer tout le monde dans le comté afin de \"sauver\" leur âme pour l\'éternité : c\'est votre mission de les traquer pour minimiser le nombre de morts.\r\n\r\nIl s\'agit d\'un format Open World, ce qui signifie que vous pouvez explorer librement la carte, en recueillant des objets qui pourraient vous être utiles en cours de route - il peut s\'agir de gros billets comme des avions et des hélicoptères, ainsi que de la nourriture, des armes et des kits de survie.', '15.62', '3.12', 'far_cry5', 34.00, '2020-05-16', 1, NULL),
(27, 16, 6, 'Star Wars: Battlefront 2', 'Star Wars : Battlefront 2 for PC est un jeu vidéo de tir et d\'action dans lequel le joueur doit se frayer un chemin à travers l\'univers de Star Wars, aidé par des extraterrestres amis et des Jedi poursuivi et combattu par les Sith, l\'Empire et d\'autres ennemis.\r\nLe joueur peut choisir parmi un certain nombre de personnages jouables, tous bien connus et aimés dans la saga cinématographique portant le même nom. Il s\'agit notamment de Luke Skywalker, Leia, Han Solo, Chewbacca, Lando, Yoda et Rey.\r\n\r\nL’histoire complète rend le mode solo aussi immersif et addictif que les modes multijoueurs, qui sont nombreux. En solo, les personnages doivent progresser au fur à mesure de l\'histoire, pour éviter le piège tendu par l\'Empereur Palpatine qui veut attirer la Résistance hors de sa cachette et de ses griffes. Les commandos des forces spéciales impériales se déclarent prêts au combat, mais ils ont sous-estimé la passion des rebelles.\r\n\r\nIl existe onze modes multijoueur, dont certains sont limités dans le temps. Poursuivez les Storm Troopers jusqu\'à la mort, après quoi ils se reproduiront comme vos compagnons Ewok, affronteront deux contre deux, des héros contre des méchants sans capacité de reconstitution jusqu\'à ce que le jeu soit terminé : ils jouent vingt contre vingt afin de réussir leurs missions.\r\n\r\nD\'autres modes multijoueur incluent des exercices qui vous permettront d\'étendre vos capacités de jeu autant que possible avec la vitesse, l\'attaque et la défense à tour de rôle, ou fusionnés ensemble pour un affrontement passionnant qui vous laissera à bout de souffle et, espérons-le, victorieux !\r\n\r\nLes packs d\'extension et les mises à jour ont transformé le jeu, ajoutant de nouveaux personnages, de nouvelles zones et de nouveaux modes de jeu multijoueur. Revenez régulièrement pour voir si de nouvelles fonctionnalités ont été ajoutées afin que vous puissiez continuer à jouer à votre jeu bien-aimé.', '12.45', '2.49', 'battlefront2', 24.00, '2020-05-16', 1, NULL),
(28, 11, 15, 'Tekken 7', 'Tekken 7 pour PC est un jeu de combat à la japonaise, le septième de la série. Il s\'agit d\'une série de matchs en face à face où le joueur doit affronter cinq adversaires de plus en plus talentueux.\r\nComme il s\'agit de la septième version d\'un scénario long et compliqué, et que la durée et la complexité ne font qu\'augmenter à chaque nouvelle édition, il n\'est pas surprenant que cette histoire soit plus ou moins la même, étant trop longue pour une description détaillée.\r\n\r\nEn gros, le protagoniste est un journaliste qui cherche à se venger des assassins de sa famille. Il se heurte des sous-fifres qui, inutile de le préciser, cherchent à l\'empêcher de découvrir les pires secrets de la société, de publier son histoire et de renverser le leader de sa position élevée et pratiquement intouchable.\r\n\r\nC\'est dans ce contexte que le jeu prouve ses mérites, présentant une expérience de combat immersive qui vous rendra aussi essoufflé et épuisé que si vous aviez combattu pour de vrai', '10.35', '2.07', 'tekken7', 7.00, '2020-05-16', 1, NULL),
(29, 11, 16, 'Street Fighter V', 'La franchise de combat légendaire est de retour avec STREET FIGHTER® V ! La prochaine génération de guerriers du monde débarque avec des effets visuels époustouflants et un niveau de détails sans précédent, tandis que les mécanismes de combat captivants et accessibles garantissent des heures et des heures de combats délirants, aussi bien pour les débutants que les vétérans du jeu. Défiez vos amis en ligne ou participez au Capcom Pro Tour si vous êtes en quête de célébrité et de gloire.\r\n\r\nLe chemin vers la grandeur commence ici : RISE UP !\r\n\r\n    Personnages nouveaux et existants : Des personnages emblématiques tels que Ryu, Chun-Li, Charlie Nash et M. Bison sont de retour ! De nombreux autres personnages, nouveaux et existants, viendront compléter cette liste variée, offrant ainsi aux joueurs un large éventail de styles de combat parmi lesquels choisir.\r\n    Nouveaux mécanismes de combat et stratégies : De nouveaux mécanismes de jeu très accessibles, liés à la V-Gauge et à la EX Gauge, apportent à la franchise un aspect stratégique et une profondeur sans précédent, pouvant être appréciés de tous les joueurs. ', '3.42', '0.68', 'street_fighter5', 9.00, '2020-05-16', 1, NULL),
(30, 8, 17, 'Squad', 'Squad est un jeu de tir à la première personne qui vise à offrir une expérience de jeu réaliste en misant non seulement sur l’aspect jeu d’équipe mais aussi en mettant l\'accent sur les mécanismes de cohésion, la tactique et la stratégie. Il propose un univers avec de grandes cartes ouvertes, un gameplay basé sur l’importance des véhicules et des bases construites par les joueurs pour créer une expérience de jeu viscérale qui combine la tactique multi-escouade et la prise de décision réfléchie. ', '35.62', '7.12', 'squad', 21.00, '2020-05-16', 1, NULL),
(31, 15, 18, 'Overcooked! 2', 'Overcooked revient avec une toute nouvelle portion d\'action culinaire chaotique ! Retournez dans le royaume Oignon et réunissez votre équipe de chefs dans ce jeu de coopération locale ou en ligne jusqu\'à 4 joueurs. À vos tabliers... il est l\'heure de sauver le monde (encore une fois !)\r\n\r\nDe la poêle au feu de bois...\r\n\r\nVous avez sauvé le monde de l\'Insatiable. Désormais, une nouvelle menace a fait surface et il est temps de retourner en cuisine pour repousser l\'attaque des zomb\'mies !\r\n\r\nEnsemble (ou les uns contre les autres), mettez la main à la pâte pour obtenir le meilleur score dans un mode multijoueur chaotique local ou en ligne.\r\n\r\nDécouvrez une toute nouvelle carte du monde et voyagez sur terre, par la mer et dans les airs. Cuisinez dans de tout nouveaux environnements à thème : des restaurants de sushis, des écoles de magie, des mines, et même des planètes extraterrestres !\r\n\r\nVoyagez à travers le monde et préparez de nouvelles recettes pour tous les goûts, comme des sushis, gâteaux, hamburgers et pizzas.\r\n\r\nUtilisez des téléporteurs et plateformes mobiles, et gagnez du temps en envoyant vos ingrédients dans des cuisines dynamiques. Certaines cuisines pourront même mener vos chefs vers de nouvelles destinations. ', '18.24', '3.65', 'overcooked2', 0.00, '2020-05-16', 0, NULL),
(32, 15, 6, 'A Way Out', 'Les créateurs de Brothers – A Tale of Two Sons présentent A Way Out, une aventure exclusivement jouable en co-op, dans laquelle vous incarnez deux prisonniers s\'évadant de prison.\r\n\r\nCe qui commence comme une évasion palpitante devient vite une cavale imprévisible et pleine d\'émotion tout à fait unique dans le jeu vidéo.\r\n\r\nA Way Out est une expérience pour deux joueurs. Chaque joueur contrôle l\'un des personnages principaux, Leo et Vincent, improbables alliés s\'échappant de prison en quête de liberté.\r\n\r\nEnsemble, vous approfondirez les notions de confiance et de conséquence, tandis que vous êtes rattrapés par vos choix.\r\n\r\nAvec la fonction essai gratuit en un clic, vivez toute l\'expérience avec vos amis sans acheter le jeu. ', '11.64', '2.33', 'aWayOut', 15.00, '2020-05-16', 1, NULL),
(33, 16, 18, 'Worms WMD', 'Les vers sont de retour dans le jeu le plus destructeur jamais sorti! Avec son look 2D dessiné à la main, de nouvelles armes, de l\'artisanat, des véhicules et des bâtiments ainsi que le retour des armes et de la jouabilité si appréciées, Worms W.M.D. est le meilleur jeu de la série.\r\n\r\n    Une 2D unique: retrouvez la célèbre recette de la série Worms et découvrez un tout nouveau ver, entièrement reproduit à partir de superbes illustrations en 2D.\r\n    Le retour du gameplay cultissime, à la demande générale: vos souhaits ont été exaucés ! Si Worms W.M.D marque le retour tant attendu de la corde ninja, nous avons également recréé le gameplay et les principales caractéristiques du jeu qui ont rendu la franchise aussi célèbre !\r\n    Artisanat: Attendre pendant que vos adversaire jouent, c\'est terminé ! Récupérez les caisses d\'artisanat qui tombent du ciel pendant les parties pour créer des versions améliorées des objets comme le mouton électrique, la tarte bazooka et la sainte mine pour démolir vos ennemis !', '7.84', '1.57', 'wormsWMD', 0.00, '2020-05-16', 1, NULL),
(34, 8, 19, 'Arma III', 'Plongez dans la simulation de combat militaire ultime ! Authentique, riche et ouvert, ArmA 3 vous envoie sur le front d’une guerre moderne ultra-réaliste.\r\n\r\nArmA 3 est le dernier né de la série des jeux de tir militaire aux multiples récompenses développé par Bohemia Interactive, qui a débuté en 2001 avec l’excellent ArmA : Cold War Assault (à l’origine connu sous le nom ‘Operation Flashpoint : Cold War Crisis’). Avec ArmA 3, vous vous lancez dans des combats militaires titanesques sur un immense terrain de jeu de plus de 290km². Avec plus de 40 armes et plus de 20 véhicules terrestres, aériens et maritimes, et un large choix de modes de jeu solo et multijoueur, ArmA 3 propose la simulation de combat militaire la plus complète, la plus riche et la plus réaliste qui soit.\r\n\r\n    Altis & Stratis\r\n    Combattez vos ennemis sur des champs de bataille immenses, riches et hyper détaillés, sur un total de plus de 290 km² au magnifique décor méditerranéen.\r\n    Modes solo & Multijoueur\r\n    Plongez dans une campagne solo qui vous laisse le choix des armes, ou faites équipe en multi pour lutter contre vos adversaires dans des batailles titanesques en versus et en co-op.\r\n    Armes & Véhicules\r\n    Apprenez à piloter une vaste sélection de plus de 20 véhicules, avions et bateaux, et choisissez votre arme de prédilection parmi plus de 40 armes personnalisables.\r\n    Création de contenu\r\n    Créez vos propres scénarios grâce à l’éditeur de contenu ; téléchargez de nouveaux mods créés par les joueurs et rejoignez une communauté hyper créative.\r\n    Moteur graphique Real Virtuality 4.0\r\n    Parcourez un champ de bataille magnifique et hyperréaliste ! Vivez toute l’intensité des combats grâce à une version améliorée du moteur graphique et sonore, de nouvelles animations plus fluides et une nouvelle gestion ragdoll de la physique !', '25.00', '5.00', 'arma3', 0.00, '2020-05-16', 0, 1),
(35, 19, 6, 'NBA 2K20', 'NBA 2K20 pour PC est un jeu de simulation sportive mettant en avant le basket-ball de la NBA. Il est produit sous licence officielle de la NBA elle-même, de sorte que le parrainage, les règles du jeu, de nombreux détails, les particularités et les styles de jeu des joueurs sont aussi authentiques qu\'ils peuvent l\'être.\r\n\r\nA propos du jeu\r\n\r\nComme pour d\'autres jeux de simulation de basketball, il existe plusieurs options disponibles pour les joueurs. Vous pouvez choisir de jouer comme l\'un des nombreux joueurs téléchargés dans le jeu, avec des statistiques réalistes et leurs préférences de jeux déjà renseignés, ou vous pouvez choisir de construire votre propre joueur, en l\'enrichissant d\'un rien et en lui donnant du caractère et beaucoup de personnalité, la maîtrise du ballon et une grande capacité stratégique !\r\n', '24.53', '4.91', '2k20', 28.00, '2020-05-16', 1, NULL),
(36, 19, 6, 'NHL 21', 'NHL® 21 introduit des innovations de pointe en matière de jouabilité qui mettent en valeur vos talents, plus d’options de personnalisation afin de donner libre cours à votre style, ainsi que de nouveaux modes dans lesquels jouer contre ou avec vos amis.\r\n\r\nUne jouabilité propulsée par la RPM met en vedette des tirs emblématiques qui imitent les styles de tirs de vos joueurs de la LNH préférés. Plus de 45 nouvelles animations de tirs transforment chaque attaque en menace, et de nouvelles passes et cueillettes de rondelle créent une expérience de jeu au rythme palpitant plus rapide et fluide.\r\n\r\nUn système de télédiffusion repensé propose un contenu visuel inédit et de tout nouveaux commentaires. Grâce à plus de 1 100 nouveaux éléments de personnalisation pour votre équipe et votre personnage, vos meilleurs buts sont spectaculaires en direct comme en reprise.\r\n\r\nPour terminer, NHL 21 annonce l’arrivée de trois nouveaux modes de jeu. Les Clashs d’équipes ÉRH mettent en vedette chaque semaine des équipes créées par de athlètes et des artistes que vous pouvez défier dans l’espoir de gagner des récompenses uniques. Vous pouvez désormais jouer au très populaire mode ONES avec vos amis sur votre sofa, sans oublier le tout nouveau mode Eliminator (Éliminateur) de World of CHEL introduisant une compétition qui récompense les gagnants où vos amis et vous tenterez de régner sur l’arène.\r\n', '32.15', '6.43', 'nhl21', 52.00, '2020-05-16', 1, NULL),
(37, 4, 3, 'Pokémon Épée', 'Pokémon Sword est l\'un des premiers jeux pour Switch du genre et, comme tant d\'autres jeux de la franchise, il est associé à un jeu de la même gamme, Pokémon Shield, également pour Switch.\r\n\r\nLes Pokémon sont de petites créatures, qui passent par trois ou quatre étapes de développement, appelées évolutions, chaque étape supplémentaire leur donnant plus de puissance, d\'endurance ou de capacités spéciales. Même le plus gros Pokémon est assez petit : le nom est un portmanteau de Pocket Monster d\'après la traduction de la version originale japonaise lorsque le jeu est sorti en 1996.\r\n\r\nLes joueurs jouent le rôle de dresseurs de Pokémon qui parcourent la campagne, avec leurs Pokémon actuels, à la recherche de nouveaux Pokémon à combattre, capturer et dresser. Au fur et à mesure que chaque Pokémon est formé, ils évoluent comme mentionné ci-dessus. Une fois que le joueur a une bonne écurie de Pokémon, il peut commencer à combattre les Pokémon d\'autres dresseurs.\r\n\r\nLes Pokémon sont conservés dans une Pokéball, un dispositif rouge, noir et blanc qui contient les Pokémon jusqu\'à ce qu\'on en ait besoin. Ce dispositif est assez petit pour qu\'un dresseur puisse en porter six à sa ceinture, et chaque Pokéball peut contenir un Pokémon.\r\n\r\nLes Pokémon sont de différents types, qui correspondent à peu près aux éléments de la terre, de l\'air, de l\'eau et du feu, et qui présentent tous divers avantages et inconvénients. Par exemple, un Pokémon feu peut être vaincu par un Pokémon eau, donc il devra se battre de manière plus intense pour gagner une telle bataille. Cela signifie que les joueurs doivent choisir soigneusement leurs Pokémon avant de les envoyer au combat pour essayer de leur donner les meilleures chances de gagne', '24.13', '4.83', 'pokemonSword', 23.00, '2020-05-16', 1, NULL),
(38, 2, 20, 'Rust', 'Rust est un survival-horror en monde ouvert. Le joueur doit y survivre en serveur dans un monde post-apocalyptique particulièrement hostile, tout en gérant la faim, la soif et le froid, et en faisant attention aux monstres et aux autres joueurs ayant parfois de mauvaises intentions. Créez des alliances avec d\'autres joueurs et formez une forteresse afin de tenter de survivre le plus longtemps dans un monde hostile. Et n’oubliez pas que la nourriture demeure une ressource des plus rares. ', '12.30', '2.46', 'rust', 24.00, '2020-05-16', 1, NULL),
(40, 13, 21, 'Command & Conquer', 'Command & Conquer: The Ultimate Collection propose les 17 jeux Command & Conquer réunis dans un seul pack.\r\n▪ Command & Conquer\r\n▪ Command & Conquer : Opérations Survie\r\n▪ Command & Conquer : Alerte Rouge\r\n▪ Command & Conquer : Alerte Rouge : Missions Taïga\r\n▪ Command & Conquer : Alerte Rouge : Missions M.A.D.\r\n▪ Command & Conquer : Soleil de Tiberium\r\n▪ Command & Conquer : Soleil de Tiberium : Mission Hydre\r\n▪ Command & Conquer : Alerte Rouge 2\r\n▪ Command & Conquer : Alerte Rouge 2 : La Revanche de Yuri\r\n▪ Command & Conquer : Renegade\r\n▪ Command & Conquer : Generals\r\n▪ Command & Conquer : Generals : Heure H\r\n▪ Command & Conquer 3 : Les Guerres du Tiberium\r\n▪ Command & Conquer 3 : La Fureur de Kane\r\n▪ Command & Conquer : Alerte Rouge 3\r\n▪ Command & Conquer : Alerte Rouge 3 : La Révolte\r\n▪ Command & Conquer 4 : Le Crépuscule du Tiberium ', '7.49', '1.50', 'CC', 5.00, '2020-05-16', 1, NULL),
(41, 2, 9, 'ARK', 'Préparez-vous pour l’aventure suprême sur le thème des dinosaures! Abandonné sur une\r\nmystérieuse île préhistorique, vous devez explorer ses vastes biomes tout en commençant à\r\nchasser, à récolter, à fabriquer des outils, à cultiver et à bâtir des abris pour survivre.\r\nUtilisez votre ruse et vos compétences pour tuer, apprivoiser et élever des dinosaures et\r\nd’autres bêtes primitives vivant sur « The ARK », et même monter dessus! Faites progresser\r\nvotre technologie d’outils primitifs en pierre jusqu’à des canons laser fixés à des\r\ntyrannosaures, en travaillant avec des centaines de joueurs en ligne ou en profitant d’une\r\nexpérience jurassique solitaire. ', '36.37', '7.27', 'ARK', 74.00, '2020-05-16', 1, 1);
INSERT INTO `produit` (`NOPRODUIT`, `NOCATEGORIE`, `NOMARQUE`, `LIBELLE`, `DETAIL`, `PRIXHT`, `TAUXTVA`, `NOMIMAGE`, `QUANTITEENSTOCK`, `DATEAJOUT`, `DISPONIBLE`, `VITRINE`) VALUES
(42, 19, 25, 'Rocket League', 'Rocket League pour PC est un jeu de football en voiture dans lequel le joueur contrôle une voiture qui tourne autour d\'un ballon, dans le but d\'éviter l\'opposition et de marquer des buts. Oh, et les voitures sont toutes propulsées par fusée ! Le ballon est plus grand que les voitures, ce qui ajoute un aspect visuel satisfaisant aux frappes et aux buts bien conçus.\r\n\r\nLa prémisse du jeu est d\'une simplicité dérisoire : conduisez votre fusée au ballon géant et frappez-la dans le but : marquez ! Répétez l\'exercice jusqu\'à ce que le jeu soit terminé et que vous gagniez, avec un peu de chance. Bien sûr, si c\'était tout, le jeu deviendrait vite ennuyeux, mais il y a assez d\'extras, de bonus et de fonctions cool pour que vous puissiez revenir de plus en plus souvent pour des heures de jeu de conduite passionnantes.\r\n', '19.00', '3.80', 'rocket', 23.00, '2020-05-22', 1, 0),
(64, 7, 3, 'New Super Mario Bros', 'New Super Mario Bros. U passe à la version Deluxe sur Nintendo Switch !\r\n\r\nNew Super Luigi U, la première aventure de plateforme dont la star est Luigi, passera également en version Deluxe, et sera incluse dans le jeu… gratuitement !\r\n\r\nUne seule manette Joy-Con est nécessaire pour jouer. Profitez de 164 stages pour un maximum de quatre joueurs* où et quand vous voulez !\r\n\r\nMario, Luigi et Toad sont tous présents, et pour faire bonne mesure, Carottin et Toadette sont également de la partie !\r\n\r\nCarottin ne subit pas de dégâts de ses ennemis, ce qui peut se révéler très utile. Quant à Toadette, si elle utilise une super couronne… Ta-da ! Elle se transforme en Peachette ! Elle peut planer lentement dans les airs, et bénéficie d\'un boost pour remonter si elle tombe dans une crevasse. ', '45.99', '9.20', 'New_super_marios_bros', 14.00, '2020-06-11', 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_COMMANDE_CLIENT` FOREIGN KEY (`NOCLIENT`) REFERENCES `client` (`NOCLIENT`);

--
-- Contraintes pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD CONSTRAINT `FK_LIGNE_COMMANDE` FOREIGN KEY (`NOCOMMANDE`) REFERENCES `commande` (`NOCOMMANDE`),
  ADD CONSTRAINT `FK_LIGNE_PRODUIT` FOREIGN KEY (`NOPRODUIT`) REFERENCES `produit` (`NOPRODUIT`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_PRODUIT_CATEGORIE` FOREIGN KEY (`NOCATEGORIE`) REFERENCES `categorie` (`NOCATEGORIE`),
  ADD CONSTRAINT `FK_PRODUIT_MARQUE` FOREIGN KEY (`NOMARQUE`) REFERENCES `marque` (`NOMARQUE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
