-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jun 06, 2020 at 06:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blognow`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL,
  `length` varchar(10) NOT NULL,
  `content` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `category`, `uploadDate`, `views`, `length`, `content`) VALUES
(171, 'abcdefgh', 'Post COVID-19: Indian Online Education Industry - Boon Or Bane', 'education sectors boon', 0, 13, '2020-06-06 19:09:47', 83, '736 words', '<h2><i style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: 0px 0px rgb(255, 255, 255); color: rgb(94, 94, 94); font-weight: 100;\"><font face=\"Georgia\" style=\"\" size=\"4\">The nationwide lockdown that was imposed, in hopes to contain the virus, resulted in schools and colleges being closed across the country affecting over 500 million students.</font></i></h2><div style=\"text-align: center;\"><i style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: 0px 0px rgb(255, 255, 255); color: rgb(94, 94, 94); font-weight: 100;\"><img src=\"assets/images/articleImages/5edb9c28d36cda.jpg\" class=\"\" style=\"width: 600px;\"></i></div><div style=\"text-align: center;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: 0px 0px rgb(255, 255, 255); color: rgb(94, 94, 94);\"><p style=\"font-style: normal; font-weight: 100; margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 16px; line-height: 22.4px; text-align: justify;\"><font face=\"Comic Sans MS\">The coronavirus pandemic has been responsible for millions of infections globally, affecting almost every sector across the world. Amid COVID-19 disrupted academic year, educational institutions are coming up with better methods, albeit as complementary to traditional classroom education. Caught in the vortex, the Indian education system is shifting the paradigm towards online education</font></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-size: 16px; line-height: 22.4px; text-align: justify;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><b style=\"\"><font face=\"Arial\">Huge demand rising in Online Learning</font></b></span></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; line-height: 22.4px; text-align: justify;\"><font face=\"Arial\">The orders of \'Stay Home\' and social distancing has spared no one. Students have been caged at their homes since Lockdown 1.0. India has the largest population in the world in the age bracket of 4-23 years which presents huge prospects in the education sector. Most of the companies, schools and institutions have come up with online essentials as their primary mode of teaching. The teachers and instructors are gradually organising online webinars and meetings. Educational universities and institutions like Amity International Group, DIT University, Dehradun and many others have shown tremendous results in online teaching methodology. The institutions are promoting the concept of online classrooms and the resources are being provided to all the students digitally. &nbsp;</font></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; line-height: 22.4px; text-align: justify;\"><font face=\"Arial\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"></span></font></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; line-height: 22.4px; text-align: justify;\"><font face=\"Arial\">The demand for online courses and learning has seen a sudden surge since the lockdown. This clearly indicates the huge demand that is rising for online learning. Online learning has been adopted in various countries as the primary mode of education. The e-learning method requires only a good internet connection and a computer/mobile as essentials. The sessions can also be recorded for later use. Also, the commute time is reduced to zero, buying enough time to relax after the sessions. The retention power is also increased, as the students don’t feel tired due to travelling. The learning from home also provides a comfortable ambience to focus as students are flexible to choose the right environment for themselves. Moreover, the importance of virtual learning is increasing as the academic year has been drastically interrupted due to Covid-19. Students are left with no other choice rather than attending online classes.&nbsp;</font></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: Gudea, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: 0px 0px; font-weight: 700;\">Technological challenges being faced by the teachers and students&nbsp;</span></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: Gudea, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;\">The lockdown crisis has forced us to adopt online learning mode without any preparations. The educators and students are strangled with the basics like internet connectivity and unpredictive power cuts. Also, the educators are under tremendous stress in solving structural issues like teaching methods and deliverables. The new learning system has also resulted in increased working hours for the educators, inviting more pressure. Many students also try to skip classes, as the teacher are not able to ensure 100% attendance. Many parents don’t have a spare computer or a laptop at home, as they themselves are busy working from home. This forces the students to struggle with attending the classes over smartphones.&nbsp;</p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: Gudea, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;\"><span style=\"margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background: 0px 0px; font-weight: 700;\">Effective measures are taken by the Government to boost virtual classroom process&nbsp;</span></p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: Gudea, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;\">The government is taking effective measures to curb the negative implications. FM recently announced help for all the students who don’t have access to internet facility. This will consist of DIKSHA, a one-nation, one-digital platform facility for school students. The government also mentioned extensive use of radio services in the near future. The Ministry of HRD is also planning to open the schools after the consent from MHA. Though social distancing is not feasible in schools, the MHA has prohibited opening schools throughout the country. This leaves the schools and institutions to actively adopt virtual learning methods.&nbsp;</p><p style=\"margin: 0px 0px 15px; padding: 0px; border: 0px; outline: 0px; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; font-family: Gudea, sans-serif; font-size: 16px; line-height: 22.4px; text-align: justify;\">Online teachings are a potential model for resource crunched country like India, and we should look forward to adapting to newer learning methods. With everything going digital, we need to assure efficiency in learning methods too. Online teachings will promote self-development and effective teachers are being able to realize it. The positive prospects, however, outweigh the negative implications and we should be ready to acclimatize with the advancements.&nbsp;&nbsp;</p></span></div>');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles'),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Travel & Events'),
(7, 'Gaming'),
(8, 'People & Blogs'),
(9, 'Comedy'),
(10, 'Entertainment'),
(11, 'News & Politics'),
(12, 'Howto & Style'),
(13, 'Education'),
(14, 'Science & Technology'),
(15, 'Nonprofits & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `articleId` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `articleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user` varchar(25) NOT NULL,
  `articleId` int(11) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `statusPaused` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `article_commentId` int(11) NOT NULL DEFAULT 0,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(50) NOT NULL,
  `subscribedTo` varchar(50) DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resetpasswords`
--

CREATE TABLE `resetpasswords` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `searchhistory`
--

CREATE TABLE `searchhistory` (
  `id` int(11) NOT NULL,
  `searchTopic` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `username` varchar(25) NOT NULL,
  `searchResults` varchar(50) NOT NULL,
  `statusPaused` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `articleId`, `filePath`) VALUES
(303, 171, 'uploads/articles/thumbnails/5edb9ca345d25a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profilePic` varchar(255) NOT NULL,
  `statusPaused` int(11) NOT NULL DEFAULT 0,
  `statusPaused2` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`, `statusPaused`, `statusPaused2`) VALUES
(23, 'Senthil', 'Nathan', 'senthil', '2senthil2018@gmail.com', 'c8b9c5635fe4f39f69e5363a05c2e55b9c3b685608f38c3ab7cb46c8ddac87378bc380adccac3f624b5fc2399fbf024dde3696b721647d441c88b66a9fa4ef22', '2020-05-28 16:09:07', 'assets/images/profilePictures/default.png', 0, 0),
(24, 'Senthil', 'Senthil', 'abcdefgh', 'mailsenthilnathan2001@gmail.com', 'b109f3bbbc244eb82441917ed06d618b9008dd09b3befd1b5e07394c706a8bb980b1d7785e5976ec049b46df5f1326af5a2ea6d103fd07c95385ffab0cacbc86', '2020-05-30 18:50:21', 'assets/images/profilePictures/5ed916a28db24.jpeg', 0, 0),
(25, 'Karthick', 'Senthil', 'sammy', 'mailsenthilnathan2002@gmail.com', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', '2020-06-05 13:14:11', 'assets/images/profilePictures/default.png', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searchhistory`
--
ALTER TABLE `searchhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `resetpasswords`
--
ALTER TABLE `resetpasswords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `searchhistory`
--
ALTER TABLE `searchhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
