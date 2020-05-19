-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 19, 2020 at 05:41 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marvinvitorino`
--

-- --------------------------------------------------------

--
-- Table structure for table `certification`
--

CREATE TABLE `certification` (
  `id_certif` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `certification`
--

INSERT INTO `certification` (`id_certif`, `nom`) VALUES
(1, 'CISCO');

-- --------------------------------------------------------

--
-- Table structure for table `competences`
--

CREATE TABLE `competences` (
  `id_competences` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `competences`
--

INSERT INTO `competences` (`id_competences`, `description`) VALUES
(1, 'Methode Agile & Scrum'),
(2, 'Français , Anglais, Espagnol, Portugais');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id_exp` int(11) NOT NULL,
  `entreprise` varchar(255) NOT NULL,
  `metier` varchar(255) NOT NULL,
  `description` text,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id_exp`, `entreprise`, `metier`, `description`, `date_debut`, `date_fin`) VALUES
(4, 'Thomas Cook Voyage', 'Stagiaire', 'Stage d\'observation de 3ème', '2015-12-07', '2015-12-12'),
(5, 'Nike', 'Avocat', 'Yves', '2014-06-12', '2016-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id_forma` int(11) NOT NULL,
  `nom_univ` varchar(255) NOT NULL,
  `nom_diplome` varchar(255) NOT NULL,
  `description` text,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id_forma`, `nom_univ`, `nom_diplome`, `description`, `date_debut`, `date_fin`) VALUES
(1, 'Ynov Paris Campus', 'Bachelor Informatique Spé WEB', '', '2019-09-25', NULL),
(5, 'Lycée Général et Technologique Montesquieu , Herblay', 'Baccalauréats Scientifiques spé SI', 'Obtention du baccalauréat mention : Assez Bien \r\nSpécialité SI , option ISN', '2016-09-01', '2019-06-24'),
(6, 'ST CHARLES', 'BREVET DES collège ', 'mention Très Bien', '2012-09-03', '2015-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id_interest` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id_interest`, `description`) VALUES
(1, 'Je suis passioné de Football , je pratique le tennis \r\n\r\nJ\'aime aussi les jeux vidéo et la programmation web\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae risus at velit accumsan venenatis eu sit amet felis. Nunc in dui non dolor lobortis porta. Morbi sit amet metus scelerisque, ultricies dui a, faucibus justo. Vivamus molestie aliquam dolor, et faucibus sem gravida eget. Praesent orci turpis, rutrum non pharetra vitae, congue id dui. Nam arcu metus, facilisis vitae massa aliquam, luctus malesuada dolor. Mauris sed fermentum orci. Suspendisse malesuada mi risus, sit amet fermentum lorem hendrerit at. Aliquam velit justo, dictum eget feugiat ac, faucibus id felis. Quisque nibh augue, dapibus sed vehicula vitae, imperdiet ut ipsum. Vestibulum in interdum arcu. Pellentesque non bibendum ligula. Sed eu dapibus dolor. Cras placerat ante ut diam ullamcorper bibendum. Quisque aliquam, neque vitae scelerisque pretium, massa elit vehicula mauris, eget scelerisque tortor justo sit amet quam.');

-- --------------------------------------------------------

--
-- Table structure for table `langage_prog`
--

CREATE TABLE `langage_prog` (
  `id_langage` int(11) NOT NULL,
  `nom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `langage_prog`
--

INSERT INTO `langage_prog` (`id_langage`, `nom`) VALUES
(1, 'html5'),
(2, 'css3'),
(5, 'javascript'),
(6, 'php'),
(8, 'mysql'),
(9, 'python');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` text NOT NULL,
  `num` varchar(11) NOT NULL,
  `bio` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `fb` text,
  `twitter` text,
  `linkedin` text,
  `github` text,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `prenom`, `nom`, `adresse`, `num`, `bio`, `email`, `fb`, `twitter`, `linkedin`, `github`, `username`, `password`, `img`) VALUES
(1, 'Marvin', 'GOMES Vitorino', '39 rue des grands fonds', '0637939936', 'Bonjour El Profesor, j’espère que vous allez apprécier mon site ! On peut tout ajouter, supprimer et je vous laisserait modifier cette bio dans le panneau de contrôle ! Attention, il vous faudra l\'identifiant et le mot de passe qui se trouve dans le README.md. Merci pour votre cours en espérant vous revoir. ✌️(oui je suis le seul sur Mac je me permet les emojis)', 'marvin.gomes.vito@gmail.com', 'www.facebook.com/marvin.vito.95', 'www.twitter.com/MarvinVitorino', 'www.linkedin.com/', 'www.github.com/Gomerinho', 'admin', 'admin', 'img/pdp.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certification`
--
ALTER TABLE `certification`
  ADD PRIMARY KEY (`id_certif`);

--
-- Indexes for table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competences`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id_exp`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_forma`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id_interest`);

--
-- Indexes for table `langage_prog`
--
ALTER TABLE `langage_prog`
  ADD PRIMARY KEY (`id_langage`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certification`
--
ALTER TABLE `certification`
  MODIFY `id_certif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `competences`
--
ALTER TABLE `competences`
  MODIFY `id_competences` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id_exp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id_interest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `langage_prog`
--
ALTER TABLE `langage_prog`
  MODIFY `id_langage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
