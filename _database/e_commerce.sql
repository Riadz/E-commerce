-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2020 at 05:53 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(4) NOT NULL,
  `article_name` varchar(155) NOT NULL,
  `stock` int(5) NOT NULL,
  `sold_count` int(6) NOT NULL DEFAULT '0',
  `price` varchar(25) NOT NULL,
  `brand` varchar(155) NOT NULL,
  `sub_category_id` int(4) NOT NULL,
  `rating_percentage` int(3) DEFAULT '0',
  `rating_number` int(5) DEFAULT '0',
  `discount` float DEFAULT NULL,
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `description` text,
  `characteristics` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `stock`, `sold_count`, `price`, `brand`, `sub_category_id`, `rating_percentage`, `rating_number`, `discount`, `new`, `description`, `characteristics`) VALUES
(1, 'Écouteurs Apple Earbuds Bluetooth - Blanch', 21, 18, '12500', 'apple', 3, 0, 0, 0.1, 0, '<p><strong>Plus magiques que jamais.</strong><br />Les nouveaux AirPods r&eacute;inventent les &eacute;couteurs sans fil. Sortez-les de leur bo&icirc;tier de charge, et ils fonctionnent tout de suite avec votre iPhone, votre Apple Watch, votre iPad ou votre Mac.<br /><br />Apr&egrave;s une configuration en un seul geste, la magie des AirPods op&egrave;re. Ils s&rsquo;allument automatiquement et restent toujours connect&eacute;s. Ils d&eacute;tectent m&ecirc;me quand vous les placez &agrave; l&rsquo;oreille et mettent en pause ce que vous &eacute;coutez d&egrave;s que vous les retirez.<br /><br />Pour r&eacute;gler le volume, changer de morceau, passer un appel ou m&ecirc;me obtenir un itin&eacute;raire, dites simplement &laquo; Dis Siri &raquo; et formulez votre demande. Vous pouvez porter les deux AirPods ou juste un seul. Et lorsque vous &eacute;coutez de la musique ou des podcasts, un double toucher suffit pour lancer la lecture ou passer au morceau suivant.<br /><br />Les AirPods vous offrent 5 heures d&rsquo;&eacute;coute et 3 heures de conversation sur une m&ecirc;me charge. Et ils peuvent vous accompagner partout, gr&acirc;ce &agrave; leur bo&icirc;tier qui permet de multiples recharges et livre plus de 24 heures d&rsquo;autonomie. Besoin d&rsquo;une recharge rapide ? En pla&ccedil;ant vos AirPods dans leur bo&icirc;tier pendant 15 petites minutes, vous obtiendrez 3 heures d&rsquo;&eacute;coute ou 2 heures de conversation.<br /><br />Dot&eacute;s de la nouvelle puce d&rsquo;&eacute;couteurs H1 con&ccedil;ue par Apple, les AirPods exploitent des capteurs optiques et des acc&eacute;l&eacute;rom&egrave;tres de mouvement pour d&eacute;tecter quand vous les portez. Que vous utilisiez les deux AirPods ou juste un seul, la puce H1 achemine automatiquement le son et active le micro. Et lorsque vous &ecirc;tes au t&eacute;l&eacute;phone ou en train de parler &agrave; Siri, un autre acc&eacute;l&eacute;rom&egrave;tre d&eacute;tecteur de voix fonctionne en tandem avec des micros beamforming pour filtrer le bruit de fond et se concentrer sur votre voix.<br /><br />- Con&ccedil;us par Apple<br />- Activation et connexion automatiques<br />- Configuration facile pour tous vos appareils Apple<br />- Acc&eacute;dez rapidement &agrave; Siri en disant &laquo; Dis Siri &raquo; ou en configurant le double toucher<br />- Touchez deux fois pour lancer la lecture ou passer au morceau suivant<br />- Recharge rapide dans le bo&icirc;tier<br />- Le bo&icirc;tier peut &ecirc;tre recharg&eacute; &agrave; l&rsquo;aide d&rsquo;un connecteur Lightning<br />- Voix et son de qualit&eacute; sup&eacute;rieure<br />- Passage instantan&eacute; d&rsquo;un appareil &agrave; l&rsquo;autre</p>', '<p><strong>Acc&eacute;l&eacute;rom&egrave;tre: </strong>Oui<br /><strong>Bluetooth: </strong>Oui<br /><strong>Bo&icirc;tier de chargement: </strong>Oui<br /><strong>Coffret de chargement: </strong>38 g<br /><strong>Compatibilit&eacute; Mac: </strong>Oui<br /><strong>Compatibilit&eacute; de marque: </strong>Apple<br /><strong>Connecteur de 2,5 mm: </strong>Non<br /><strong>Connecteur de 3,5&nbsp;mm: </strong>Non<br /><strong>Connectivit&eacute; USB: </strong>Non<br /><strong>Con&ccedil;u pour l\'activit&eacute; sportive: </strong>Non<br /><strong>Couleur du produit: </strong>Blanc<br /><strong>Couplage auriculaire: </strong>Intra-aural<br /><strong>Dimensions du bo&icirc;tier de chargement (l x p x H): </strong>44,3 x 21,3 x 53,5 mm<br /><strong>Fonctionne sur piles: </strong>Oui<br /><strong>Guidage vocal: </strong>Oui<br /><strong>Hauteur: </strong>40,5 mm<br /><strong>Largeur: </strong>16,5 mm<br /><strong>Poids de l\'&eacute;couteur droit: </strong>4 g<br /><strong>Poids de l\'&eacute;couteur gauche: </strong>4 g<br /><strong>Profondeur: </strong>18 mm<br /><strong>Rechargeable: </strong>Oui<br /><strong>Technologie de connectivit&eacute;: </strong>Sans fil<br /><strong>Temps de communication: </strong>3 h<br /><strong>Type de batterie: </strong>Batterie int&eacute;gr&eacute;<br /><strong>Type de casque: </strong>Binaural<br /><strong>Type de commande: </strong>Tactil<br /><strong>Voyant de charge: </strong>Oui</p>'),
(31, 'Ecran Asus VP248H 24', 5, 3, '24900', 'asus', 30, 0, 0, NULL, 1, '  : elle permet d\'optimiser la luminosité et les contrastes. Avec sa fréquence de 75 Hz , votre écran <b>VP248H</b> peut générer jusqu\'à 75 images par secondes ce qui en résulte une meilleure fluidité pour une précision accrue lors de vos combats.\r\nVotre moniteur <b>VP248H</b> s\'daptera parfaitement à votre setup grâce à son design classique et élégant. Profitez aussi de deux speakers stereo de 1,5 watts chacun. De plus, pour un gain de place sur votre bureau, vous avez la possibilité de monter votre <b>écran Asus</b> sur un bras en montage VESA 100 x 100 mm.>>>>>>>>>>', '  Item Weight</td><td class=\"value\">3.6 Kg</td></tr>\r\n<tr class=\"size-weight\"><td class=\"label\">Product Dimensions</td><td class=\"value\">57.1 x 19.9 x 40.6 cm</td></tr>\r\n\r\n<tr class=\"item-model-number\"><td class=\"label\">Item model number</td><td class=\"value\">VP248H</td></tr>\r\n\r\n         <tr><td class=\"label\">Series</td><td class=\"value\">VP248H</td></tr>\r\n         <tr><td class=\"label\">Color</td><td class=\"value\">Black</td></tr>\r\n         <tr><td class=\"label\">Screen Size</td><td class=\"value\">61 centimetres</td></tr>\r\n         <tr><td class=\"label\">Screen Resolution</td><td class=\"value\">1920 x 1080 pixels</td></tr>\r\n         <tr><td class=\"label\">Maximum Display Resolution</td><td class=\"value\">1920 x 1080 pixels</td></tr>\r\n         <tr><td class=\"label\">Speaker Description</td><td class=\"value\">Loudspeakers</td></tr>\r\n         <tr><td class=\"label\">Number of HDMI Ports</td><td class=\"value\">1</td></tr>\r\n         <tr><td class=\"label\">Number of VGA Ports</td><td class=\"value\">1</td></tr>\r\n         <tr><td class=\"label\">Wattage</td><td class=\"value\">27 watts</td></tr>\r\n<tr><td class=\"lAttr\"> </td><td class=\"lAttr\"> </td></tr>\r\n     </tbody>\r\n     </table>>>>>>>>>>>'),
(32, 'Asus VivoBook 15 X540NA', 3, 2, '54000', 'asus', 24, 0, 0, 0.2, 0, '  This laptop is a \'no frills\' offering from Asus.\r\nThere\'s no DVD drive, or ethernet socket, there is a micro sd slot however which is handy...\r\nThe case is a bit like a 60s Russian TV set, looks and feels a bit cheap...\r\nHowever it works, having 4 gig of ram and 1Tb main drive. I found the track pad a bit quirky, but a USB mouse works well.\r\nWiFi works well and Windows 10, with it\'s \'user friendly\' interface does everything it\'s supposed to.\r\nBattery life is huge at around 10 hours, but it is built in so when it no longer charges, you will need to either run all the time on it\'s power adapter, or replace the laptop.\r\nIf you need a machine for correspondence, email. browsing the internet etc', '  <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n     <tbody>\r\n         <tr><td class=\"label\">Brand name</td><td class=\"value\">ASUS</td></tr>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                                                \r\n\r\n\r\n<tr class=\"size-weight\"><td class=\"label\">Item Weight</td><td class=\"value\">2 Kg</td></tr>\r\n<tr class=\"size-weight\"><td class=\"label\">Product Dimensions</td><td class=\"value\">25 x 38 x 2.5 cm</td></tr>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n<tr class=\"batteries\"><td class=\"label\">Batteries:</td><td class=\"value\">1 Lithium ion batteries required. (included)</td></tr>\r\n\r\n\r\n\r\n\r\n\r\n\r\n<tr class=\"item-model-number\"><td class=\"label\">Item model number</td><td class=\"value\">X540NA-GQ052T</td></tr>\r\n\r\n         <tr><td class=\"label\">Series</td><td class=\"value\">Vivobook X540NA-GQ052T</td></tr>\r\n         <tr><td class=\"label\">Color</td><td class=\"value\">Black</td></tr>\r\n         <tr><td class=\"label\">Form Factor</td><td class=\"value\">Notebook</td></tr>\r\n         <tr><td class=\"label\">Screen Size</td><td class=\"value\">39.6 centimetres</td></tr>\r\n         <tr><td class=\"label\">Screen Resolution</td><td class=\"value\">1366 x 768 pixels</td></tr>\r\n         <tr><td class=\"label\">Maximum Display Resolution</td><td class=\"value\">1366 x 768 pixels</td></tr>\r\n         <tr><td class=\"label\">Processor Brand</td><td class=\"value\">Intel</td></tr>\r\n         <tr><td class=\"label\">Processor Type</td><td class=\"value\">Pentium</td></tr>\r\n         <tr><td class=\"label\">Processor Speed</td><td class=\"value\">1.1 GHz</td></tr>\r\n         <tr><td class=\"label\">Processor Count</td><td class=\"value\">4</td></tr>\r\n         <tr><td class=\"label\">RAM Size</td><td class=\"value\">4 GB</td></tr>\r\n         <tr><td class=\"label\">Computer Memory Type</td><td class=\"value\">DDR3 SDRAM</td></tr>\r\n         <tr><td class=\"label\">Hard Drive Size</td><td class=\"value\">1024 GB</td></tr>\r\n         <tr><td class=\"label\">Hard Disk Technology</td><td class=\"value\">HDD</td></tr>\r\n         <tr><td class=\"label\">Graphics Coprocessor</td><td class=\"value\">NA</td></tr>\r\n         <tr><td class=\"label\">Graphics Card Description</td><td class=\"value\">HD GPU</td></tr>\r\n         <tr><td class=\"label\">Connectivity Type</td><td class=\"value\">NA</td></tr>\r\n         <tr><td class=\"label\">Wireless Type</td><td class=\"value\">802.11b, 802.11g</td></tr>\r\n         <tr><td class=\"label\">Number of USB 2.0 Ports</td><td class=\"value\">2</td></tr>\r\n         <tr><td class=\"label\">Number of USB 3.0 Ports</td><td class=\"value\">1</td></tr>\r\n         <tr><td class=\"label\">Number of HDMI Ports</td><td class=\"value\">1</td></tr>\r\n         <tr><td class=\"label\">Voltage</td><td class=\"value\">19 volts</td></tr>\r\n         <tr><td class=\"label\">Optical Drive Type</td><td class=\"value\">None</td></tr>\r\n         <tr><td class=\"label\">Operating System</td><td class=\"value\">Windows 10</td></tr>\r\n         <tr><td class=\"label\">Supported Software</td><td class=\"value\">Microsoft Office</td></tr>\r\n         <tr><td class=\"label\">Average Battery Life (in hours)</td><td class=\"value\">8 hours</td></tr>\r\n         <tr><td class=\"label\">Lithium Battery Energy Content</td><td class=\"value\">33 watt_hours</td></tr>\r\n         <tr><td class=\"label\">Lithium Battery Packaging</td><td class=\"value\">Batteries packed with equipment</td></tr>\r\n         <tr><td class=\"label\">Lithium Battery Weight</td><td class=\"value\">7 Grams</td></tr>\r\n<tr><td class=\"lAttr\"> </td><td class=\"lAttr\"> </td></tr>\r\n     </tbody>\r\n     </table>'),
(33, 'Sony Playstation 4 Slim - 500 GB PS4 - Noir', 7, 15, '48900', 'playstation', 37, 40, 2, 0.15, 0, '  Le système PS4 a été conçu pour offrir aux joueurs PlayStation les meilleurs jeux et les expériences les plus immersives. La PS4 permet aussi aux plus grands développeurs de jeux du monde de laisser libre cours à leur créativité. Elle connecte également le joueur de manière fluide au vaste monde d\'expériences de PlayStation à travers le système et les espaces mobiles, ainsi qu\'au PlayStation Network (PSN).', '  <ul><li>Modèle : CUH-2000</li><li>Processeur principal : Processeur single-chip spécifique</li><li>Unité centrale : x86-64 AMD \"Jaguar\", 8 cœurs</li><li>Processeur graphique : 1,84 TFLOPS, moteur graphique AMD Radeon™</li><li>Mémoire	GDDR5 8 Go</li><li>Capacité de stockage*	500 Go, 1 To</li><li>Dimensions externes	Environ 265×39×288 mm (largeur × hauteur × longueur) </li><li>Poids	Environ 2,1 kg</li><li>Lecteur BD/ DVD : (lecture uniquement)	BD × 6 CAV /   DVD × 8 CAV</li><li>Entrée/ Sortie	2 ports USB très haut débit (USB 3.1 Gen1) /  1 port AUX</li><li>Réseau : 1 Ethernet (10BASE-T, 100BASE-TX, 1000BASE-T)   /   IEEE 802.11 a/b/g/n/ac    /     Bluetooth®v4.0</li><li>Alimentation	AC 100-240 V, 50/60 Hz</li><li>Consommation électrique	Max. 165 W</li><li>Température de fonctionnement	5ºC – 35ºC</li><li>Sortie AV	Port de sortie HDMI™ (sortie HDR prise en charge)</li></ul>'),
(34, 'Condor Plume P6 Pro LTE - Gold - Garantie 1 An', 0, 9, '24900', 'condor', 27, 0, 0, NULL, 0, '    Référence : PGN-528\r\n            <br /><br />\r\n            Famille : Série Plume\r\n            <br /><br />\r\n            Vous avez aimé le P6 PRO, vous allez adorer la nouvelle version avec\r\n            une caméra de 13 MP et une compatibilité totale avec les réseaux 4G\r\n            LTE.\r\n            <br /><br />\r\n            Un Smartphone qui vous accompagne tout au long de votre journée, pas\r\n            besoin de s\'inquiéter des problèmes de batterie avec la charge 4000\r\n            mAh, vous pouvez maintenant partager la charge de votre Plume P6 PRO\r\n            Lte avec d\'autres Smartphone grâce à la fonction de banque\r\n            d\'énergie.\r\n            <br /><br />\r\n            Doté d\'un processeur quad-core de haute qualité cadencé à 1,3 GHz,\r\n            soutenu par 2 Go de RAM pour remplir les spots les plus gourmands et\r\n            16 Go de mémoire interne pour stocker votre contenu multimédia.\r\n            Contenu amélioré par le puissant capteur photo 13 mégapixels\r\n            principal et un autre front de 5 mégapixels pour selfies de qualité.', '    <table\r\n            class=\"tab-caracs  table table-striped  table-responsive\"\r\n            width=\"100%\"\r\n          >\r\n            <tbody>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td></td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Systeme d\'exploitation\r\n                </td>\r\n                <td><p>Android 6.0 Marshmallow</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Processeur\r\n                </td>\r\n                <td><p>MT6737v, ARM Cortex-A53</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Nombre de cœurs\r\n                </td>\r\n                <td><p>4</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Fréquence processeur\r\n                </td>\r\n                <td><p>1. 3 GHz, 64-bit</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Puce graphique (GPU)\r\n                </td>\r\n                <td><p>ARM MALI-T720</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  RAM\r\n                </td>\r\n                <td><p>2 GB</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  ROM\r\n                </td>\r\n                <td><p>16 GB</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Mémoire flash libre\r\n                </td>\r\n                <td><p>10.07 GB</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Indice DAS (W/kg)\r\n                </td>\r\n                <td><p>MAX BODY :1.25; Head : 0.362</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Carte sim\r\n                </td>\r\n                <td><p>Double SIM Dual Standby</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Type de cartes supportées\r\n                </td>\r\n                <td><p>Micro SIM </p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Couleurs disponibles\r\n                </td>\r\n                <td><p>Gris / Gold / Marron</p></td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Photo & Vidéo</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Capteur photo principal\r\n                </td>\r\n                <td><p>13 M Pixels</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Enregistrement vidéo (principal)\r\n                </td>\r\n                <td><p>1088 P</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Flash\r\n                </td>\r\n                <td><p>LED</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Capteur photo Selfie\r\n                </td>\r\n                <td><p>5 MP</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Enregistrement vidéo Selfie\r\n                </td>\r\n                <td><p>480P</p></td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Ecran</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Taille (diagonale) (pouces)\r\n                </td>\r\n                <td><p>5’’ 2.5D</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Technologie de l’écran\r\n                </td>\r\n                <td><p>IPS</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Interface utilisable\r\n                </td>\r\n                <td><p>67.44%</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Résolution de l’écran\r\n                </td>\r\n                <td><p>HD 720 x 1280</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Densité (ppp)\r\n                </td>\r\n                <td><p>320 dpi</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Détail du Multipoint\r\n                </td>\r\n                <td><p>5 points</p></td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Connectivité</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Bandes GSM\r\n                </td>\r\n                <td><p>1800, 1900, 850, 900 MHz</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Bandes WCDMA (3G)\r\n                </td>\r\n                <td>\r\n                  <p>WCDMA-IMT-2000/WCDMA-PCS-</p>\r\n                  <p>1900/WCDMA-GSM-900</p>\r\n                </td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Compatible réseau 4G (LTE)\r\n                </td>\r\n                <td><p>1/3/7/20/38/40/41</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Norme WIFI\r\n                </td>\r\n                <td><p>802.11b/g/n</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Partage de connexion internet\r\n                </td>\r\n                <td>\r\n                  <p> Wi-Fi Direct</p>\r\n                  <p> Wi-Fi Display</p>\r\n                  <p> Borne Wi-Fi (HotSpot)</p>\r\n                </td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Bluetooth Stéréo\r\n                </td>\r\n                <td><p>V : 4.0</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  USB OTG\r\n                </td>\r\n                <td><p>Oui (Chargement & data) </p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Port USB\r\n                </td>\r\n                <td><p>Micro USB 2.0</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Prise Audio\r\n                </td>\r\n                <td><p>Mini-Jack de 3.5mm</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Radio FM\r\n                </td>\r\n                <td><p>Oui</p></td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Batterie</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Type de batterie\r\n                </td>\r\n                <td><p>Li polymer 3.8V -15.2 Wh (Amovible</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Capacité de la batterie (mAh)\r\n                </td>\r\n                <td><p>4000 mAh</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Autonomie\r\n                </td>\r\n                <td>\r\n                  <p>\r\n                    6H et30 min Mode (vidéo YouTube, Luminosité max, GSM,\r\n                    Bluetooth)\r\n                  </p>\r\n                </td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Capteurs</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Photomètre\r\n                </td>\r\n                <td>\r\n                  <p><span style=\"font-size: 12.16px;\">Oui</span></p>\r\n                </td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Magnétomètre\r\n                </td>\r\n                <td><p>Oui</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Orientation\r\n                </td>\r\n                <td><p>Oui</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Proximité\r\n                </td>\r\n                <td>\r\n                  <p><span style=\"font-size: 12.16px;\">Oui</span></p>\r\n                </td>\r\n              </tr>\r\n              <tr class=\"tr-entetecarac\">\r\n                <td>\r\n                  <h3 class=\"entetecarac\">Dimensions</h3>\r\n                </td>\r\n                <td></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Largeur (mm)\r\n                </td>\r\n                <td><p>70.8 mm</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Hauteur (mm)\r\n                </td>\r\n                <td><p>144 mm </p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Epaisseur\r\n                </td>\r\n                <td><p>10.2 mm</p></td>\r\n              </tr>\r\n              <tr class=\"row1\">\r\n                <td>\r\n                  Poids\r\n                </td>\r\n                <td><p>185 gr</p></td>\r\n              </tr>\r\n              <tr class=\"row0\">\r\n                <td>\r\n                  Matériaux\r\n                </td>\r\n                <td><p>Couvercle en Plastique</p></td>\r\n              </tr>\r\n            </tbody>\r\n          </table>'),
(35, 'DELL Notebook Inspiron 3567', 3, 1, '36000', 'dell', 25, 100, 1, NULL, 1, '', ''),
(36, 'Hp Ordinateur De Bureau 290 G1', 3, 0, '51000', 'hp', 23, 0, 0, 0.1, 0, '', ''),
(38, 'ROG STRIX - RXVEGA64', 3, 0, '69000', 'asus', 6, 0, 0, NULL, 1, '', ''),
(39, 'Sandisk Clé USB - 8Gb - Noir', 25, 0, '1790', 'sandisk', 40, 0, 0, 0.05, 0, '', ''),
(41, 'boitier pc gamer spirit of gamer revolution two red', 5, 0, '10500', 'spirit of gamer', 9, 0, 0, NULL, 1, 'Un Design Gaming Et Complet Pour Un PC De Jeux Évolutif !\r\nLe boitier PC Spirit Of Gamer Revolution Two Blue Vectory peut accueillir - sous un design gamer élégant - une configuration performante au format ATX / micro ATX / mini ITX. Pour répondre aux besoins de puissance des loisirs vidéoludiques, il embarque tout le confort nécessaire adapté à la conception d\'un PC équipé des composants dernière génération. Recommandé aux configurations évolutives et accessibles.<br>\r\n\r\nConcevez Un PC Gamer Efficace Et Abordable\r\nLe boitier Spirit of Gamer Revolution Two est une plateforme au design gaming adaptée pour recevoir une configuration où la puissance est au centre des exigences.<br>\r\n\r\nInstallez aisément une carte mère (format ATX) ainsi qu\'un binôme processeur / carte(s) graphique(s) capable de propulser tous vos logiciels et applications. La qualité et le design Spirit Of Gamer désignent ce boitier PC comme une excellente base pour un PC gaming et multimédia.', ''),
(42, 'spirit of gamer airflow 120 mm bleu', 22, 0, '1500', 'spirit of gamer', 8, 0, 0, NULL, 1, ' Avec le ventilateur Spirit of Gamer AirFlow 120 mm, ajoutez la touche finale à votre boîtier Gamer ! Grâce à sa dissipation de la chaleur efficace, ses LED bleues intégrées et ses fixations anti-vibration, il répond efficacement aux 3 grandes exigences des Gamers : performance, silence et look d\'enfer !', ' <ul style=\"padding:0px;margin:.2em 1em 1em;list-style-position:inside;list-style-image:none;color:#141414;font-family:arial, verdana, geneva, helvetica, sans-serif;font-size:12px;text-align:justify;border:0px none;\"><li style=\"padding:0px;margin:0px;border:0px none;\">Ventilateur de boîtier de 120 mm</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Conception avec 9 pales noires et 15 LED bleues</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Roulement de type \"Rifle Bearing\"</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Vitesse de rotation de 1200 RPM et débit d\'air de 44 CFM</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Fonctionnement silencieux avec un niveau sonore de 25.5 dB(A)</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Puissance nominale : 3,6 Watts</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Tension de démarrage : 5 Volts / Tension de fonctionnement : 12 Volts</li>\r\n<li style=\"padding:0px;margin:0px;border:0px none;\">Connecteur d\'alimentation 3 broches / 4 broches</li>\r\n</ul>'),
(43, 'intel core i5-9400f (2.9 ghz / 4.1 ghz)', 17, 0, '28500', 'intel', 3, 0, 0, NULL, 1, '<div style=\"margin:0px;padding:0px;border:0px;font:inherit;vertical-align:baseline;\">Plus de Core, plus de cache et des fréquences Turbo ultra-élevées sont les atouts majeurs de la&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">9ème génération de processeur Intel Core Coffee Lake Refresh</span>. En améliorant les performances thermiques et l\'efficacité énergétique de ses CPU, Intel a rendu possible l\'atteinte de fréquences plus élevées pour un TDP toujours aussi modéré.&nbsp;Que vous soyez&nbsp;<span style=\"margin:0px;padding:0px;border:0px;font:inherit;vertical-align:baseline;\">Gamer&nbsp;</span>ou utilisateur ultra-exigeant, vous tirerez parti du meilleur de votre PC grâce au&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">processeur Intel Core i5-9400F</span>&nbsp;dôté de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">6 Cores</span>&nbsp;(6 Threads), de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">9&nbsp;Mo de cache&nbsp;</span>de niveau 3 et de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">fréquences Turbo pouvant atteindre 4.1 GHz</span>.&nbsp;<br><br>Performances exceptionnelles dans les Jeux, VR ultra-immersive ou multitâche intensif, les processeurs Intel Core de 9ème génération sont conçus pour tous les usages. L\'Intel Core i5-9400F est&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">dépourvu de contrôleur graphique intégré&nbsp;</span>généralement peu utililisé par les gamers et les power users. Vous disposez ainsi d\'une plus grande flexibilité dans le choix la&nbsp;carte graphique adaptée à vos exigences.</div>', ''),
(44, 'intel core i3-9100f (3.6 ghz / 4.2 ghz)', 14, 0, '17900', 'intel', 3, 0, 0, 0.1, 0, '<div style=\"margin:0px;padding:0px;border:0px;font-size:13px;line-height:inherit;font-family:Montserrat, sans-serif;vertical-align:baseline;color:#505050;text-align:justify;background-color:#ffffff;\"><br>Plus de Core, plus de cache et des fréquences Turbo ultra-élevées sont les atouts majeurs de la&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">9ème génération de processeur Intel Core Coffee Lake Refresh</span>. En améliorant les performances thermiques et l\'efficacité énergétique de ses CPU, Intel a rendu possible l\'atteinte de fréquences plus élevées pour un TDP toujours aussi modéré.&nbsp;Que vous soyez&nbsp;<span style=\"margin:0px;padding:0px;border:0px;font:inherit;vertical-align:baseline;\">Gamer&nbsp;</span>ou utilisateur exigeant, vous tirerez parti du meilleur de votre PC grâce au&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">processeur Intel Core i3-9100F</span>&nbsp;dôté de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">4 Cores</span>&nbsp;(4 Threads), de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">6&nbsp;Mo de cache&nbsp;</span>de niveau 3 et de&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">fréquences Turbo pouvant atteindre 4.2 GHz</span>.&nbsp;<br>&nbsp;</div>\r\n<div style=\"margin:0px;padding:0px;border:0px;font-size:13px;line-height:inherit;font-family:Montserrat, sans-serif;vertical-align:baseline;color:#505050;text-align:justify;background-color:#ffffff;\">Performances exceptionnelles dans les Jeux, VR ultra-immersive ou multitâche intensif, les processeurs Intel Core de 9ème génération sont conçus pour tous les usages. L\'Intel Core i3-9100F est&nbsp;<span style=\"font-weight:600;margin:0px;padding:0px;border:0px;font-style:inherit;font-variant:inherit;font-size:inherit;line-height:inherit;font-family:inherit;vertical-align:baseline;\">dépourvu de contrôleur graphique intégré&nbsp;</span>généralement peu utililisé par les gamers. Vous disposez ainsi d\'une plus grande flexibilité dans le choix la&nbsp;carte graphique adaptée à vos exigences.</div>', ''),
(45, 'intel core i7-9700k (3.6 ghz / 4.9 ghz)', 10, 0, '69900', 'intel', 3, 0, 0, 0.2, 0, '', '<table class=\"fpDescTb fpDescTbPub\" style=\"padding:0px;border-spacing:0px;border-collapse:collapse;font-size:12px;margin:.5em 0px 1em;color:#323232;font-family:Arial, Verdana, Helvetica, sans-serif;\"><tbody style=\"letter-spacing:0px;margin:0px;padding:0px;\"><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><th colspan=\"2\" style=\"letter-spacing:0px;margin:0px;padding:.4em 0px;font-size:1.2em;text-align:left;border-bottom:1px solid #ccd3dd;\">Informations générales sur le produit</th></tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Marque</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\"><span style=\"letter-spacing:0px;margin:0px;padding:0px;\"><a href=\"https://www.cdiscount.com/m-1069-intel.html\" title=\"Intel\" style=\"letter-spacing:0px;margin:0px;padding:0px;color:#096ec8;\">Intel</a></span>&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Nom du produit</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">Processeur Intel Core i7 9700K&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Catégorie</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">PROCESSEUR&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><th colspan=\"2\" style=\"letter-spacing:0px;margin:0px;padding:.4em 0px;font-size:1.2em;text-align:left;border-bottom:1px solid #ccd3dd;\">Général</th></tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Type de produit</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">Processeur&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><th colspan=\"2\" style=\"letter-spacing:0px;margin:0px;padding:.4em 0px;font-size:1.2em;text-align:left;border-bottom:1px solid #ccd3dd;\">Processeur</th></tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Nombre de coeurs</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">8 coeurs&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Nbre de processeurs</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">1&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Port de processeur compatible</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">LGA1151 Socket&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Caractéristiques architecturales</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">Technologie Intel Turbo Boost&nbsp;2.0, Intel Optane Memory Supported&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Détails de la mémoire cache</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">12 Mo&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Cache</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">12 Mo&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Vitesse maximale en mode Turbo</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">4.9 GHz&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Nombre de filetages</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">8 filetages&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Enveloppe thermique</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">95 W&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Type - Format</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">Intel Core i7 9700K (9ème génération)&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Procédé de fabrication</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">14 nm&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Fréquence d\'horloge</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">3.6 GHz&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Configurations PCI Express</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">1x16, 2x8, 1x8+2x4&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Nombre de voies PCI Express</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">16&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Révision PCI Express</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">3.0&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><th colspan=\"2\" style=\"letter-spacing:0px;margin:0px;padding:.4em 0px;font-size:1.2em;text-align:left;border-bottom:1px solid #ccd3dd;\">Graphiques intégrés</th></tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Résolution maximale prise en charge</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">4096x2304@24Hz (HDMI), 4096x2304@60Hz (eDP), 4096x2304@60Hz (DP)&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Taille de mémoire maximale de prise en charge</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">64 Go&nbsp;</td>\r\n</tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><th colspan=\"2\" style=\"letter-spacing:0px;margin:0px;padding:.4em 0px;font-size:1.2em;text-align:left;border-bottom:1px solid #ccd3dd;\">Divers</th></tr><tr style=\"letter-spacing:0px;margin:0px;padding:0px;\"><td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;background-color:#f0f0f7;width:320px;\">Type d\'emballage</td>\r\n<td style=\"letter-spacing:0px;margin:0px;padding:.5em 1em;border-spacing:0px;border-collapse:separate;border-bottom:1px solid #ccd3dd;\">Intel Boxed&nbsp;</td>\r\n</tr></tbody></table>'),
(46, 'amd ryzen 3 3200g wraith stealth edition (3.6 ghz / 4 ghz)', 14, 0, '17500', 'amd', 3, 0, 0, NULL, 1, '', ''),
(47, 'gigabyte b450m ds3h', 20, 0, '13700', 'gigabyte', 4, 0, 0, NULL, 1, '', ''),
(48, 'msi b450m-a pro max', 32, 0, '16900', 'msi', 4, 0, 0, NULL, 0, '', ''),
(49, 'gigabyte geforce gtx 1650 windforce oc 4g', 21, 0, '31900', 'gigabyte', 6, 0, 0, NULL, 1, '', ''),
(50, 'microsoft xbox one s 1tb console - white', 42, 0, '42000', 'xbox', 38, 0, 0, NULL, 1, '', ''),
(51, 'samsung galaxy s9 g960u 64gb unlocked gsm 4g lte', 9, 0, '99900', 'samsung', 27, 0, 0, NULL, 1, '  ', '  '),
(52, 'apple iphone 11 pro max (64gb) - space gray', 13, 0, '139990', 'apple', 36, 0, 0, NULL, 1, '', ''),
(55, 'Apple MacBook Pro', 6, 0, '320000', 'apple', 3, 0, 0, NULL, 1, '<p>The best for the brightest</p>', '<p>pretty powerfull</p>'),
(56, 'Razer Kraken Gaming Headset', 12, 0, '19000', 'razer', 1, 0, 0, NULL, 1, '<p>The Headset for Esports Pros</p>', '<p>The Headset for Esports Pros</p>\r\n<p>&nbsp;</p>'),
(57, 'Nintendo Switch', 20, 0, '35000', 'Nintendo', 39, 0, 0, NULL, 1, '<p>The games you want, wherever you are</p>\r\n<p>&nbsp;</p>', '<p>The games you want, wherever you are</p>\r\n<p>&nbsp;</p>'),
(58, 'Razer BlackWidow Mechanical Keyboard', 25, 0, '12000', 'razer', 17, 0, 0, NULL, 1, '<p>Meet the iconic mechanical gaming keyboard</p>\r\n<p>&nbsp;</p>', '<p>Meet the iconic mechanical gaming keyboard</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `article_review`
--

CREATE TABLE `article_review` (
  `article_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `article_review_id` int(11) NOT NULL,
  `article_review_title` varchar(255) NOT NULL,
  `article_review_body` text NOT NULL,
  `article_review_rating` int(1) NOT NULL,
  `article_review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article_review`
--

INSERT INTO `article_review` (`article_id`, `user_id`, `article_review_id`, `article_review_title`, `article_review_body`, `article_review_rating`, `article_review_date`) VALUES
(33, 1, 14, 'not bad', '30fps but its ok i guess', 3, '2020-07-17'),
(33, 1, 15, 'bad', 'pc is better lol', 1, '2020-07-17'),
(35, 1, 16, 'Realy good', 'its good', 5, '2020-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(4) NOT NULL,
  `article_id` int(4) NOT NULL,
  `article_quantity` int(5) NOT NULL,
  `current_discount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `article_id`, `article_quantity`, `current_discount`) VALUES
(40, 33, 1, 0.15),
(40, 35, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(4) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'PC Parts'),
(2, 'Desktop PCs'),
(3, 'Laptops'),
(4, 'Phones'),
(5, 'Monitors'),
(6, 'Devices'),
(7, 'Printers'),
(8, 'Consoles');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `cart_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `cart_date` date DEFAULT NULL,
  `payment_method` text NOT NULL,
  `shipping_address` text NOT NULL,
  `status` varchar(100) DEFAULT 'undefined'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`cart_id`, `user_id`, `cart_date`, `payment_method`, `shipping_address`, `status`) VALUES
(40, 1, '2020-07-16', 'credit_card', 'my house', 'undefined');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(4) NOT NULL,
  `category_id` int(4) NOT NULL,
  `sub_category_name` varchar(122) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`) VALUES
(1, 6, 'Headphones and earphones'),
(2, 6, ' Mouse'),
(3, 1, 'Processors'),
(4, 1, 'Motherboards'),
(5, 1, 'RAM'),
(6, 1, 'Graphics Cards\r\n'),
(7, 1, 'Storage'),
(8, 1, 'Cooling'),
(9, 1, 'Cases'),
(10, 1, 'PSU'),
(16, 6, 'Mouse pads'),
(17, 6, 'Keyboards'),
(18, 6, 'Controllers'),
(19, 6, 'Microphones'),
(20, 6, 'Chairs'),
(21, 2, 'Gamer'),
(22, 2, 'Work'),
(23, 2, 'Simple'),
(24, 3, '15 inch'),
(25, 3, '16 inch'),
(26, 3, '17 inch'),
(27, 4, 'Android'),
(28, 4, 'Simple'),
(29, 5, 'HD'),
(30, 5, 'Full HD'),
(31, 5, 'Ultra Wide'),
(32, 5, '4K'),
(33, 7, 'Normal'),
(34, 7, 'Laser'),
(35, 7, 'Photocopier'),
(36, 4, 'Iphone'),
(37, 8, 'Playstation'),
(38, 8, 'Xbox'),
(39, 8, 'Nintendo'),
(40, 6, 'Flashdisk');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(4) NOT NULL,
  `first_name` varchar(155) NOT NULL,
  `last_name` varchar(155) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(155) DEFAULT NULL,
  `phone_number` varchar(155) DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `address`, `phone_number`, `birth_date`) VALUES
(1, 'lorem', 'ipsom', 'admin', '$2y$10$OVOp28ZwK5WICjdQpfaCiOY.cLfIkjTup2RmBQFbBBPvef/FpcijW', NULL, NULL, NULL),
(3, 'riad', 'hachemane', 'dzriaddz@gmail.com', '$2y$10$XWs7J2hY03F1IGKPJG.1T.fMEJX9OZqxSecwVDvHVQLWScAKbC9SW', 'annaba, sidiamar', '06584', '1999-11-13'),
(14, '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', 'Test', 'Test@Test', '$2y$10$l2bx11LjIOF02qdrC5KXE.219nFPRRPkU9pUAKeqxtvq8vv1wnKmu', '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', NULL, NULL),
(15, '&lt;script&gt;alert(&#039;lol&#039;)&lt;/scr', '&lt;script&gt;alert(&#039;lol&#039;)&lt;/scr', 'tt@tt', '$2y$10$zTnkuk4Fb2oWEFN0yawE1uEIL7iC9gcocxqfpWc6flzbXCYt95nc6', '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', NULL, NULL),
(16, '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', '21@ghhj', '$2y$10$73PZ/II.vi.Ru/EasK9CseiOtIcXc1oyn/z0L40k188F0L8bFQ.e.', '&lt;script&gt;alert(&#039;lol&#039;)&lt;/script&gt;', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `persone_id` (`user_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `id_sou_cat` (`sub_category_id`);

--
-- Indexes for table `article_review`
--
ALTER TABLE `article_review`
  ADD PRIMARY KEY (`article_review_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `person_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `c_id` (`cart_id`),
  ADD KEY `id_p` (`article_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `p_id` (`user_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `id_cat` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `article_review`
--
ALTER TABLE `article_review`
  MODIFY `article_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `cart_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_persone` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `produit_sou_cat` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`sub_category_id`);

--
-- Constraints for table `article_review`
--
ALTER TABLE `article_review`
  ADD CONSTRAINT `article_review` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `article_review_person` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `order` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sou_cat_cat` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
