-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  db5000113840.hosting-data.io
-- Généré le :  Mer 03 Juillet 2019 à 15:35
-- Version du serveur :  5.7.25-log
-- Version de PHP :  7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbs108372`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `alert` int(11) DEFAULT NULL,
  `added_datetime` datetime NOT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `content`, `alert`, `added_datetime`, `updated_datetime`) VALUES
(1, 1, 'Julien', 'La chance ! J\'aimerais un jour pouvoir contempler tout cela :)', 0, '2019-06-25 11:05:19', NULL),
(2, 1, 'Louis', '&lt;p&gt;Franchement, ce pays craint !&lt;/p&gt;', 1, '2019-06-25 11:05:32', '2019-06-27 15:06:40');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `added_datetime` datetime NOT NULL,
  `updated_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `author`, `title`, `content`, `added_datetime`, `updated_datetime`) VALUES
(1, 'Jean Forteroche', '1 - Arrivée à Juneau', '&lt;p&gt;Mon p&amp;eacute;riple commence ce mardi 11 d&amp;eacute;cembre 2018. Le thermom&amp;egrave;tre affiche -10&amp;deg;, un vrai temps d\'hiver.&lt;br /&gt;Les seules personnes que je croise se r&amp;eacute;v&amp;egrave;lent &amp;ecirc;tre des &amp;eacute;leveurs accompagn&amp;eacute;s de deux ou trois chiens guident le troupeau vers leurs terres.&lt;br /&gt;Cela change des terres Canadiennes. Je continue donc mon chemin seul, vers Juneau, la premi&amp;egrave;re &amp;eacute;tape de mon aventure.&lt;br /&gt;Je ne sais pas combien de temps je vais rester ici, la seule chose dont je suis soit sur, c\'est que les paysages ici sont vraiment merveilleux.&lt;/p&gt;', '2019-06-25 10:48:59', '2019-06-25 10:58:34'),
(2, 'Jean Forteroche', '2 - Des paysages majestueux', '&lt;p&gt;La premi&amp;egrave;re chose qui m\'a marqu&amp;eacute;, c\'est les paysages en Alaska.&amp;nbsp;&lt;br /&gt;Ici, tout semble avoir &amp;eacute;tait fig&amp;eacute; par le temps, tout est &amp;agrave; la fois tr&amp;egrave;s blanc du fait des immenses glaciers et montagne qui surplombent le paysage, mais les quelques coins de verdure rendent le tout unique.&lt;br /&gt;C\'est comme si la vie ici n\'avait en r&amp;eacute;alit&amp;eacute; jamais commenc&amp;eacute;, qu\'aucun &amp;ecirc;tre humain n\'a jamais pos&amp;eacute; les pieds ici, en Alaska&lt;br /&gt;L\'environnement, la qualit&amp;eacute; de l\'air, la faune, la flore, tous les &amp;eacute;l&amp;eacute;ments sont r&amp;eacute;unis pour faire de cette terre, un paradis pour les yeux et pour le corps.&lt;/p&gt;', '2019-06-25 10:55:35', '2019-06-25 10:57:02'),
(3, 'Jean Forteroche', '3 - Une population', '&lt;p&gt;Je vous ai parl&amp;eacute; du paysage, maintenant laissez moi vous parler un petit peu des gens que j\'ai pu y rencontrer.&lt;br /&gt;Il &amp;eacute;tait 19h58, le soleil &amp;eacute;tait sur le point de ce coucher, et la temp&amp;eacute;rature &amp;eacute;tait de -15&amp;deg;, une grosse nuit d\'hiver sous ma tente m\'attendait.&lt;br /&gt;Un habitant d\'un village aux alentours, m\'ayant aper&amp;ccedil;u me proposa de venir passer la nuit au chaud chez lui, ce fut une surprise sachant que les 3/4 des habitants de ce pays sont des indig&amp;egrave;nes.&lt;br /&gt;Nous avons din&amp;eacute;, une bonne petite soupe, et une chambre d\'amis avec un bon lit m\'attendait.&lt;/p&gt;', '2019-06-25 11:04:06', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$K5ABdxECRbfeywfYqaH9kOn7.HgmGe4qlzIt2d36sMeod28jhDyeu', 'jean@admin.fr\r\n');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
