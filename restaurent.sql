-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2019 at 04:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurent`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `final`
--

CREATE TABLE `final` (
  `id_reservation` varchar(255) NOT NULL,
  `id_table` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL,
  `date_vente` date NOT NULL,
  `client_nom` varchar(255) NOT NULL,
  `client_prenom` varchar(255) NOT NULL,
  `order_status` enum('Canceled','Pending','Done') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final`
--

INSERT INTO `final` (`id_reservation`, `id_table`, `id_product`, `qty_product`, `date_vente`, `client_nom`, `client_prenom`, `order_status`) VALUES
('2lf9ugusr9', 8, 8, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('2lf9ugusr9', 8, 9, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('2lf9ugusr9', 8, 12, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('yghfizjq9e', 2, 7, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('yghfizjq9e', 2, 2, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('a3gfka8npb', 1, 1, 1, '2019-07-28', 'mehri', 'mehri', 'Done'),
('apaat3hme3', 1, 7, 1, '2019-07-28', 'mehri', 'mehri', 'Pending'),
('x68iphje7b', 1, 8, 1, '2019-07-31', 'mehri', 'mehri', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_product`, `nom`, `photo`, `price`, `category`, `description`, `status`) VALUES
(1, 'Jus citron', 'jus_citron.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magnaa.', '1'),
(2, 'Jus fraise', 'jus_fraise.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(3, 'Jus mojito', 'jus_mojito.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(4, 'Jus orange', 'jus_orange.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(5, 'Jus kiwi', 'jus_kiwi.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(6, 'Jus cocktail', 'jus_cocktail.jpg', 10, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(7, 'Pizza 4 saisons', '4_saisons.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(8, 'Pizza cheese burger', 'cheese_burger.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(9, 'Pizza with the lot', 'with_the_lot.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(10, 'Pizza vegetarienne', 'vegetarienne.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(11, 'Pizza pepperoni ', 'pepperoni.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1'),
(12, 'Pizza napolitaine', 'napolitaine.jpg', 10, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare sem sed nisl dignissim, facilisis dapibus lacus vulputate. Sed lacinia lacinia magna.', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `category` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`category`, `type`) VALUES
(1, 'coffee'),
(2, 'crepe'),
(3, 'ice cream'),
(4, 'jus'),
(5, 'pizza'),
(6, 'tea'),
(7, 'waffle');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_table`
--

CREATE TABLE `reservation_table` (
  `id_table` int(11) NOT NULL,
  `status` enum('0','1') DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_table`
--

INSERT INTO `reservation_table` (`id_table`, `status`) VALUES
(1, '1'),
(2, '1'),
(3, '1'),
(4, '1'),
(5, '1'),
(6, '1'),
(7, '1'),
(8, '1'),
(9, '1'),
(10, '1');

-- --------------------------------------------------------

--
-- Table structure for table `security_question`
--

CREATE TABLE `security_question` (
  `id_question` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_question`
--

INSERT INTO `security_question` (`id_question`, `question`) VALUES
(1, 'What was the last name of your third-grade teacher?'),
(2, 'What was the name of your second pet?'),
(3, 'What was the name of the hospital where you were born?'),
(4, 'What was the name of the company where you had your first job?'),
(5, 'What is the name of your favorite childhood friend?');

-- --------------------------------------------------------

--
-- Table structure for table `user_restaurent`
--

CREATE TABLE `user_restaurent` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '1.png',
  `reset_code` varchar(255) NOT NULL,
  `id_question` int(11) NOT NULL,
  `answer_question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_restaurent`
--

INSERT INTO `user_restaurent` (`id_user`, `email`, `nom`, `prenom`, `password`, `photo`, `reset_code`, `id_question`, `answer_question`) VALUES
(1, 'xxxx@gmail.com', 'xxxx', 'xxxx', 'd033e22ae348aeb5660fc2140aec35850c4da997', '749992277.png', '7sp8zvwnl9', 1, 'xxxx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `final`
--
ALTER TABLE `final`
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_table` (`id_table`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `reservation_table`
--
ALTER TABLE `reservation_table`
  ADD PRIMARY KEY (`id_table`);

--
-- Indexes for table `security_question`
--
ALTER TABLE `security_question`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `user_restaurent`
--
ALTER TABLE `user_restaurent`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `user_restaurent_ibfk_1` (`id_question`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `security_question`
--
ALTER TABLE `security_question`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_restaurent`
--
ALTER TABLE `user_restaurent`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user_restaurent` (`id_user`);

--
-- Constraints for table `final`
--
ALTER TABLE `final`
  ADD CONSTRAINT `final_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `final_ibfk_2` FOREIGN KEY (`id_table`) REFERENCES `reservation_table` (`id_table`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category`) REFERENCES `product_type` (`category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
