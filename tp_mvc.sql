-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 06:50 PM
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
-- Database: `tp_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_member`, `id_post`, `comment_content`, `comment_time`) VALUES
(1, 7, 4, 'IS THAT A JOJO REFERENCE !!!!', '2024-05-01 23:23:14'),
(3, 5, 3, ' Integer eu mi molestie, auctor libero ut, posuere ipsum. Ut nulla odio, cursus vitae nibh quis, elementum tempor nulla. Fusce in iaculis diam, pretium molestie arcu. Vestibulum ante justo, vestibulum sed viverra et, tincidunt vitae ante. Cras venenatis ornare sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aliquam vel urna dignissim, rutrum nunc malesuada, ullamcorper enim.', '2024-05-01 23:31:37'),
(4, 5, 1, ' A fellow steins;gate fan!', '2024-05-01 23:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `join_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_member`, `name`, `email`, `phone`, `join_date`) VALUES
(1, 'John Doe', 'johndoe@mail.com', '081234567890', '2024-05-01'),
(5, 'Jane Doe', 'janedoe@mail.com', '080987654321', '2024-05-01'),
(7, 'Furqon A', 'furqon@gmail.com', '082207207208', '2024-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `id_member`, `post_content`, `post_time`) VALUES
(1, 'El Psy Kongroo', 7, 'The universe has a beginning, but no end. —Infinite. The stars too have beginnings, but their power accompanies their decline. —Finite. It the wise who are the most foolish. History has taught us as much. The fish of the sea know not the world of the land. Were they to possess wisdom, they too would experience decline. It is more absurd that humans should surpass the speed of light than it is that fish should start living on the land. This can be said to be God final warning to those who resist. lorem', '2024-05-01 22:16:53'),
(3, 'Lorem Ipsum', 1, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus laoreet, sem eget interdum aliquam, est sapien sollicitudin felis, vel convallis ante eros vel quam. Curabitur purus nunc, accumsan non pellentesque sit amet, faucibus vitae lectus. Sed sed iaculis eros. Sed fermentum tellus vitae volutpat pretium. Vestibulum pharetra, enim ut varius maximus, lacus massa condimentum elit, vel fermentum est urna a lacus. Duis porta elementum ante, non aliquam ante aliquam at. Integer sagittis luctus sagittis.', '2024-05-01 23:19:41'),
(4, 'My Name is Yoshikage Kira', 5, 'My name is Yoshikage Kira. Im 33 years old. My house is in the northeast section of Morioh, where all the villas are, and I am not married. I work as an employee for the Kame Yu department stores, and I get home every day by 8 PM at the latest. I dont smoke, but I occasionally drink. Im in bed by 11 PM, and make sure I get eight hours of sleep, no matter what. After having a glass of warm milk and doing about twenty minutes of stretches before going to bed, I usually have no problems sleeping until morning. Just like a baby, I wake up without any fatigue or stress in the morning. I was told there were no issues at my last check-up. Im trying to explain that Im a person who wishes to live a very quiet life. I take care not to trouble myself with any enemies, like winning and losing, that would cause me to lose sleep at night. That is how I deal with society, and I know that is what brings me happiness. Although, if I were to fight I wouldnt lose to anyone.', '2024-05-01 23:22:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_member` (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
