<?php
include("../log.php");
mysql_connect($db_adr, $db_login, $db_password) or die(mysql_error());
$date = date("Y-m-d");

//--
//-- Base de données: `KALEIDOSCOPE`
//--

//--
//-- Structure de la table `admin_avertissement`
//--

//mysql_query("CREATE DATABASE IF NOT EXISTS `$db_name` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;");

mysql_select_db($db_name) or die(mysql_error());

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_avertissement` (
  `id_membre` bigint(20) NOT NULL,
  `id_averto` bigint(20) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL,
  `id_modero` bigint(20) NOT NULL,
  `ban` varchar(1) NOT NULL default 'F',
  `explication` tinytext NOT NULL,
  `pardon` varchar(1) NOT NULL default 'F',
  PRIMARY KEY  (`id_averto`)
)
");

//--
//-- Structure de la table `admin_configuration`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_configuration` (
  `id_config` tinyint(4) NOT NULL auto_increment,
  `configuration` tinytext NOT NULL,
  `commentaire` tinytext NOT NULL,
  PRIMARY KEY  (`id_config`)
)
") or die(mysql_error());

//--
//-- Contenu de la table `admin_configuration`
//--

mysql_query("
INSERT INTO `admin_configuration` (`id_config`, `configuration`, `commentaire`) VALUES
(1, 'Kaleidoscope', 'Nom du site'),
(2, 'Pentacle Technologie Kaleidoscope board video', 'Meta KEYWORDS'),
(3, '1', 'Quantité de publicité differentes'),
(4, 'skin/logo.png', 'Logo du site'),
(5, 'skin.css', 'Feuille de style'),
(6, '', 'Copyright du locataire'),
(7, 'false', 'Autoriser seulement les moderateurs a mettre en ligne des videos'),
(8, 'false', 'Activation des video par ladministrateur')
");

//--
//-- Structure de la table `admin_hierarchie`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_hierarchie` (
  `id_membre` bigint(20) NOT NULL,
  `niveau` varchar(1) NOT NULL default '0',
  PRIMARY KEY  (`id_membre`)
)
");

//--
//-- Contenu de la table `admin_hierarchie`
//-- NE JAMAIS SUPPRIMER

mysql_query("
INSERT INTO `admin_hierarchie` (`id_membre`, `niveau`) VALUES
(0, '3'),
(1, '0')
");

//--
//-- Structure de la table `admin_news`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_news` (
  `id_news` smallint(6) NOT NULL auto_increment,
  `id_membre` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `titre` tinytext NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY  (`id_news`)
)
");

//--
//-- Contenu de la table `admin_news`
//--

mysql_query("
INSERT INTO `admin_news` (`id_news`, `id_membre`, `date`, `titre`, `message`) VALUES
(1, 0, '".$date."', 'Installation', 'Website installed!')
");

//--
//-- Structure de la table `admin_publicite`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_publicite` (
  `id_pub` tinyint(4) NOT NULL auto_increment,
  `categorie` varchar(6) NOT NULL,
  `code` text NOT NULL,
  PRIMARY KEY  (`id_pub`,`categorie`)
)
");

//--
//-- Contenu de la table `admin_publicite`
//--

mysql_query("
INSERT INTO `admin_publicite` (`id_pub`, `categorie`, `code`) VALUES
(1, 'global', '<script type=\"text/javascript\"><!--\r\ngoogle_ad_client = \"pub-4924610423678548\";\r\n/* 200x200, date de création 19/01/10 */\r\ngoogle_ad_slot = \"8442346504\";\r\ngoogle_ad_width = 200;\r\ngoogle_ad_height = 200;\r\n//-->\r\n</script>\r\n<script type=\"text/javascript\"\r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>'),
(1, 'news', '<script type=\"text/javascript\"><!--\r\ngoogle_ad_client = \pub-4924610423678548\";\r\n/* 468x60, date de création 19/01/10 */\r\ngoogle_ad_slot = \"9472798706\";\r\ngoogle_ad_width = 468;\r\ngoogle_ad_height = 60;\r\n//-->\r\n</script>\r\n<script type=\"text/javascript\"\r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>')
");

//--
//-- Structure de la table `admin_visiteur`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_visiteur` (
  `ip` varchar(15) NOT NULL,
  `date` timestamp NOT NULL,
  `visite` int(11) NOT NULL,
  PRIMARY KEY  (`ip`)
)
");

//--
//-- Structure de la table `langue_condition`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `langue_condition` (
  `id` tinyint(4) NOT NULL auto_increment,
  `fr` longtext NOT NULL,
  `eng` longtext NOT NULL,
  PRIMARY KEY  (`id`)
)
");

//--
//-- Contenu de la table `langue_condition`
//--

mysql_query("
INSERT INTO `langue_condition` (`id`, `fr`, `eng`) VALUES
(1, 'Conditions d''utilisations', 'Terms Of Services')
");

//--
//-- Structure de la table `langue_index`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `langue_index` (
  `id_langage` tinyint(4) NOT NULL auto_increment,
  `code` varchar(3) NOT NULL,
  `nom` varchar(16) NOT NULL,
  PRIMARY KEY  (`id_langage`)
)
");

//--
//-- Contenu de la table `langue_index`
//--

mysql_query("
INSERT INTO `langue_index` (`id_langage`, `code`, `nom`) VALUES
(1, 'eng', 'English'),
(2, 'fr', 'Francais')
");

//--
//-- Structure de la table `langue_source`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `langue_source` (
  `id_source` tinyint(4) NOT NULL auto_increment,
  `fr` mediumtext NOT NULL,
  `eng` mediumtext NOT NULL,
  PRIMARY KEY  (`id_source`)
)
");

//--
//-- Contenu de la table `langue_source`
//--

mysql_query("
INSERT INTO `langue_source` (`id_source`, `fr`, `eng`) VALUES
(1, 'Connecté en tant que', 'Log as'),
(2, 'Deconnexion', 'Logout'),
(3, 'Se connecter', 'Log in'),
(4, 'Pseudo', 'Nickname'),
(5, 'Mot de passe', 'Password'),
(6, 'Recopiez', 'Copy'),
(7, 'J''ai oublié mon mot de passe', 'I forgot my password'),
(8, 'Inscription', 'Registration'),
(9, 'Page perso', 'My space'),
(10, 'Effectuer une recherche', 'Search'),
(11, 'Entrez vos mot-clefs', 'Enter keywords'),
(12, 'Par', 'By'),
(13, 'Choisissez votre langue', 'Choose your language'),
(14, 'La référence absolue pour les vidéos de danse hip-hop!', 'The absolute reference for hip-hop dance video!'),
(15, 'Dernières vidéos', 'Latest video'),
(16, 'Meilleures vidéos du mois', 'Best video of month'),
(17, 'Voir toutes les news', 'See all-time news'),
(18, 'Vidéos répondant aux critères', 'Videos that respond the criteria'),
(19, 'Connexion', 'Log in'),
(20, 'Critères employés', 'Used criteria'),
(21, 'Depuis le', 'Since the'),
(22, 'Aucune vidéo disponible', 'No video available'),
(23, 'Précèdent', 'Above'),
(24, 'Suivant', 'Next'),
(25, 'Page', 'Page'),
(26, 'visites', 'views'),
(27, 'Voir la vidéo', 'See the video'),
(28, 'Note', 'Point'),
(29, 'Commentaires', 'Comments'),
(30, 'Ce message a été censuré', 'This message has been censored'),
(31, 'Voir tous les commentaires', 'See all comments'),
(32, 'Vidéos similaires', 'Similar video'),
(33, 'Insérer un commentaire', 'Write a comment'),
(34, 'Vous devez être connecté pour pouvoir poster un commentaire', 'You have to log in for writing a comment'),
(35, 'Poster', 'Submit'),
(36, 'Langage', 'Language'),
(37, 'Actions possibles', 'Available action'),
(38, 'Rappel des conditions d''utilisation', 'Reminder of Terms Of Services'),
(39, 'Mettre une vidéo en ligne', 'Upload a video'),
(40, 'Adresse du fichier vidéo', 'Link on computer to video file'),
(41, 'Attention!', 'Caution!'),
(42, 'Les formats supportés pour l''envoi se limitent aux suivantes: <br />\r\n.AVI, .MPG, .WMV, .FLV, .MOV, .MP4, .3GP, .M4V <br />\r\nLa taille des fichiers vidéos est limité à 100Mo.<br /><br />\r\n<i>La durée requise à l''upload et à sa conversion dans un format approprié peut facilement aller de une à dix minutes.</i>', 'Supported formats for submission are limited to the following: <br />\r\n. AVI,. MPG,. WMV,. FLV,. MOV, .MP4, .3GP, .M4V <br />\r\nThe size of video files is limited to 100MB.<br /><br />\r\n<i>The time required to upload and convert into the appropriate format can easily take from one to ten minutes.</i>'),
(43, 'Entrez le titre de la vidéo', 'Enter the video title'),
(44, 'Entrez une description pour votre vidéo', 'Describe your video'),
(45, 'Entrez des mot-clefs pour votre vidéo, séparé par un espace', 'Enter keywords for your video, separate by a space'),
(46, 'J''accepte les conditions d''utilisations', 'I accept the terms of services'),
(47, 'Proceder', 'Proceed'),
(48, 'Vous ne pouvez pas acceder à cette vidéo.<br />\r\nCelle ci est peut-etre encore en cours de conversion ou absente de notre base de données.', 'This video is not available.<br />\r\nMaybe this video is not converted yet or does not even exist.'),
(49, 'Signaler un contenu frauduleux', 'Report fraudulent content'),
(50, 'Spam', 'Spam'),
(51, 'Lien vers la page', 'Link to this page'),
(52, 'Integrer la vidéo sur un site', 'Put video on a website'),
(53, 'Services', 'Services'),
(54, 'Qui sommes nous?', 'About us'),
(55, 'Mon compte', 'My account'),
(56, 'Editer', 'Edit'),
(57, 'Vous avez été banni pour les raisons suivantes', 'You''re been banned for the following reasons'),
(58, 'Pas de nouveaux messages', 'No new posts'),
(59, 'Nouveaux messages', 'New post'),
(60, 'Page de &nbsp;', ''),
(61, '', '''s page'),
(62, 'Messagerie', 'PO Box'),
(63, 'A propos de moi', 'About me'),
(64, 'Nom', 'Family Name'),
(65, 'Prénom', 'First Name'),
(66, 'Date de naissance', 'Birthday'),
(67, 'Courriel', 'E-Mail'),
(68, 'MSN', 'MSN'),
(69, 'Résidence', 'Residence'),
(70, 'Interêts', 'Interests'),
(71, 'Film favori', 'Favorite movie'),
(72, 'Groupe ou troupe préféré', 'Favorite band'),
(73, 'Musique préférée', 'Favorite music'),
(74, 'Artiste favoris', 'Favorite artist'),
(75, 'Genre préféré', 'Favorite genre'),
(76, 'Citation', 'Quote'),
(77, 'Site web', 'Website'),
(78, 'Modifier mes paramètres', 'Change parameters'),
(79, 'Propriétés du compte', 'Account properties'),
(80, 'Apparence', 'Appearance'),
(81, 'Détails personnels', 'Personal Details'),
(82, 'Voir toutes les vidéos préférées', 'See all favorites vids'),
(83, 'Mes vidéos', 'My videos'),
(84, 'Mes favoris', 'My favorites'),
(85, 'Voir toutes les vidéos', 'See all videos'),
(86, 'Boite de réception', 'Reception box'),
(87, 'Messages envoyés', 'Send messages'),
(88, 'Envoyer un message', 'Send a message'),
(89, 'Envoyer un message à', 'Send a message to'),
(90, '', ''),
(91, 'Vous devez vous connecter pour pouvoir mettre en ligne une vidéo', 'You have to login in for submitting a video'),
(92, 'Répondre', 'Answer'),
(93, 'Envoyer un message privé', 'Send a private message'),
(94, 'Système de transmission de message', 'Transmission system'),
(95, 'Destinataire', 'Target'),
(96, 'Titre du message', 'Message title'),
(97, 'Pas de messages', 'No messages'),
(98, 'Ouvrir un compte sur le site', 'Open an account on the site'),
(99, 'Recopiez le mot de passe', 'Type your password again'),
(100, 'Inscription', 'Subscribe'),
(101, 'Inscription à la newsletter', 'Subscribe to newsletter'),
(102, 'Supprimer', 'Delete'),
(103, 'Panneau de configuration', 'Configurattion pannel'),
(104, 'Nouveau pseudo', 'New login'),
(105, 'Nouveau mot de passe', 'New password'),
(106, 'Recopiez le mot de passe', 'Copy the password'),
(107, 'Adresse E-Mail', 'E-Mail adress'),
(108, 'Avatar', 'Avatar'),
(109, 'Signature', 'Signature'),
(110, 'Veuillez entrer votre adresse E-Mail. Un courrier vous sera envoyé dans lequel sera indiqué votre nouveau mot de passe et un lien d''activation.', 'Please enter your email address. A letter will be sent which will indicate your new password and activation link.'),
(111, 'Récuperation de mot de passe', 'Password rescue'),
(112, 'Vous recevez ce message suite a une demande de renouvellement de mot de passe.', 'You received this email because a renewal password query.'),
(113, 'Copiez ce lien dans votre barre d''adresse pour activer votre nouveau mot de passe.', 'Put this link into your address bar to activate your new password.'),
(114, 'Vous revecez ce message suite à votre inscription sur notre site. Celui ci contient toutes les informations qui permettront votre connexion.', 'You revecez this email because you registered on our site. This one contains all the information that will help your future login.'),
(115, 'Conservez ces données, celle ci ne pourront pas être retrouvé pour vous.\r\n\r\nMerci de vous être inscrit sur notre site.', 'Preserves theses datas, we will not be able to give it to you again.\r\n\r\nThanks for subscribing on our website.'),
(116, 'Cette vidéo a été censurée.', 'This video has been censored.'),
(117, 'News complètes', 'Complete news'),
(118, 'Accueil', 'Home'),
(119, 'Dernier coup de coeur', 'Last favorite'),
(120, 'Cette vidéo fait déjà partie de vos favorites', 'This movie is already favorite'),
(121, 'Ajouter cette vidéo à vos favorites', 'Add this movie to your favorites'),
(122, 'Sur la vidéo', 'About'),
(123, 'Commentaires', 'Comments'),
(124, 'Supprimer cette vidéo', 'Delete this video'),
(125, 'Censurer', 'Censor'),
(126, 'Annonce', 'Advertisement'),
(127, 'Voir toutes les annonces', 'See all avertisements')
");

//--
//-- Structure de la table `membre_detail`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_detail` (
  `residence` tinytext NOT NULL,
  `interet` tinytext NOT NULL,
  `film` tinytext NOT NULL,
  `groupe` tinytext NOT NULL,
  `musique` tinytext NOT NULL,
  `artiste` tinytext NOT NULL,
  `genre` tinytext NOT NULL,
  `citation` tinytext NOT NULL,
  `msn` tinytext NOT NULL,
  `site` tinytext NOT NULL,
  `id_membre` bigint(20) NOT NULL,
  PRIMARY KEY  (`id_membre`)
)
");

//--
//-- Contenu de la table `membre_detail`
//--

mysql_query("
INSERT INTO `membre_detail` (`residence`, `interet`, `film`, `groupe`, `musique`, `artiste`, `genre`, `citation`, `msn`, `site`, `id_membre`) VALUES
('', '', '', '', '', '', '', '', '', '', 0)
");

//--
//-- Structure de la table `membre_favoris`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_favoris` (
  `id_membre` bigint(20) NOT NULL,
  `id_video` bigint(20) NOT NULL,
  `id_favoris` bigint(20) NOT NULL auto_increment,
  PRIMARY KEY  (`id_favoris`)
)
");

//--
//-- Structure de la table `membre_general`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_general` (
  `id_membre` bigint(20) NOT NULL auto_increment,
  `login` varchar(16) NOT NULL,
  `login_original` varchar(16) NOT NULL,
  `hash` tinytext NOT NULL,
  `mail` varchar(38) NOT NULL,
  `inscription` date NOT NULL,
  `nom` varchar(16) NOT NULL,
  `prenom` varchar(16) NOT NULL,
  `naissance` date NOT NULL,
  `avatar` tinytext NOT NULL,
  `signature` tinytext NOT NULL,
  `newsletter` varchar(1) NOT NULL default 'V',
  PRIMARY KEY  (`id_membre`)
)
");

//--
//-- Contenu de la table `membre_general`
//-- NE RIEN SUPPRIMER

mysql_query("
INSERT INTO `membre_general` 
(`id_membre`, `login`, `login_original`, `hash`, `mail`, `inscription`, `nom`, `prenom`, `naissance`, `avatar`, `signature`, `newsletter`) 
VALUES
(0, '".strtolower($_POST['login'])."', '".$_POST['login']."', '".hash("sha256", $_POST['mdp'], false)."', '".$_POST['mail']."', '".$date."', '', '', '', 'upload_img/avat_null.png', 'Administrateur\r<br />Rapportez moi tous les bugs rencontrés!', 'V'),
(1, '', '', 'Interdit', '', '0000-00-00', '', '', '0000-00-00', 'upload_img/avat_null.png', '', 'V')");

//--
//-- Structure de la table `membre_ip`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_ip` (
  `id_membre` bigint(20) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`id_membre`,`ip`)
)
");

//--
//-- Structure de la table `membre_messagerie`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_messagerie` (
  `id_message` bigint(20) NOT NULL auto_increment,
  `id_auteur` bigint(20) NOT NULL,
  `id_lecteur` bigint(20) NOT NULL,
  `titre` varchar(64) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `lu` varchar(1) NOT NULL default 'F',
  `del_aut` varchar(1) NOT NULL default 'F',
  `del_lec` varchar(1) NOT NULL default 'F',
  PRIMARY KEY  (`id_message`)
)
");

//--
//-- Structure de la table `membre_page`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `membre_page` (
  `id_membre` bigint(20) NOT NULL auto_increment,
  `msg_bienvenu` tinytext NOT NULL,
  `presentation` longtext NOT NULL,
  PRIMARY KEY  (`id_membre`)
)
");

//--
//-- Contenu de la table `membre_page`
//--

mysql_query("
INSERT INTO `membre_page` (`id_membre`, `msg_bienvenu`, `presentation`) VALUES
(0, 'Soyez le bienvenu sur la page du Super-Administrateur de ce site.', '')
");

//--
//-- Structure de la table `tube_commentaire`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_commentaire` (
  `id_commentaire` bigint(20) NOT NULL auto_increment,
  `id_video` bigint(20) NOT NULL,
  `id_auteur` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `message` text NOT NULL,
  `censure` varchar(1) NOT NULL default 'F',
  PRIMARY KEY  (`id_commentaire`)
)
");

//--
//-- Structure de la table `tube_general`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_general` (
  `id_video` bigint(20) NOT NULL auto_increment,
  `id_auteur` bigint(20) NOT NULL,
  `titre` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `visite` bigint(20) NOT NULL,
  `censure` varchar(1) NOT NULL default 'F',
  `sel` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id_video`)
)
");

//--
//-- Contenu de la table `tube_general`
//--

mysql_query("
INSERT INTO `tube_general` (`id_video`, `id_auteur`, `titre`, `description`, `date`, `visite`, `censure`, `sel`) VALUES
(1, 0, 'Bienvenue sur Kaleidoscope', 'Bienvenue sur ce site web vidéo par Pentacle Technologie: Kaleidoscope!\r\n<br />Ses fonctionnalités sont les suivantes: \r\n<br />- Mise en ligne de vidéos\r\n<br />- Moteur de recherche parmis les vidéos\r\n<br />- Vidéos similaires à la courante sur les pages\r\n<br />- Gestion des visites, des notes sur les vidéos\r\n<br />- Page perso pour chaque membre\r\n<br />- Systeme de messagerie personnelle\r\n<br />- Possibilité d''adjoindre des commentaires sur les vidéos\r\n<br />- Systeme de favoris\r\n<br />- Gestion de la censure et système de délation adapté\r\n<br />- Système d''avertissement et de bannissement par compte et ip\r\n<br />- Anti bot\r\n<br />\r\n<br />Ce site web est actuellement à sa version: 1.00', '0000-00-00', 78, 'F', 10)
");

//--
//-- Structure de la table `tube_keyword`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_keyword` (
  `id_video` bigint(20) NOT NULL,
  `keyword` tinytext NOT NULL,
  `id_keyword` bigint(20) NOT NULL auto_increment,
  PRIMARY KEY  (`id_keyword`)
)
");

//--
//-- Contenu de la table `tube_keyword`
//--

mysql_query("
INSERT INTO `tube_keyword` (`id_video`, `keyword`, `id_keyword`) VALUES
(1, 'pentacle', 1),
(1, 'technologie', 2),
(1, 'kaleidoscope', 3),
(1, 'présentation', 4)
");

//--
//-- Structure de la table `tube_note`
//--
mysql_query("
CREATE TABLE IF NOT EXISTS `tube_note` (
  `id_video` bigint(20) NOT NULL,
  `id_membre` bigint(20) NOT NULL,
  `note` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id_video`,`id_membre`)
)
");

//--
//-- Contenu de la table `tube_note`
//--

mysql_query("
INSERT INTO `tube_note` (`id_video`, `id_membre`, `note`) VALUES
(1, 1, 10)
");

//--
//-- Structure de la table `tube_promo`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_promo` (
  `id_promo` smallint(6) NOT NULL auto_increment,
  `id_video` bigint(20) NOT NULL,
  PRIMARY KEY  (`id_promo`)
)
");

//--
//-- Contenu de la table `tube_promo`
//--

mysql_query("
INSERT INTO `tube_promo` (`id_promo`, `id_video`) VALUES
(1, 1)
");

//--
//-- Structure de la table `tube_report`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_report` (
  `id_vidcom` bigint(20) NOT NULL,
  `id_membre` bigint(20) NOT NULL,
  `report` varchar(1) NOT NULL default 'F',
  `date` date NOT NULL,
  PRIMARY KEY  (`id_vidcom`,`id_membre`)
)
");

//--
//-- Structure de la table `admin_annonce`
//--

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_annonce` (
  `id_annonce` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `message` longtext NOT NULL,
  `show` longtext NOT NULL,
  PRIMARY KEY (`id_annonce`)
)
");

mysql_query("
CREATE TABLE IF NOT EXISTS `tube_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` longtext NOT NULL,
  `keyword` longtext NOT NULL,
  PRIMARY KEY (`id`)
)
");

mysql_query("
CREATE TABLE IF NOT EXISTS `admin_sondage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` longtext NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`)
)
");