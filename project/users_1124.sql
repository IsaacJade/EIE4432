-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2018-11-24 13:48:46
-- 服务器版本： 10.1.36-MariaDB
-- PHP 版本： 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `users`
--

-- --------------------------------------------------------

--
-- 表的结构 `post`
--

CREATE TABLE `post` (
  `post_id` int(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `post_time` varchar(50) NOT NULL,
  `post_content` varchar(200) NOT NULL,
  `post_picture` varchar(200) NOT NULL,
  `like_num` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`post_id`, `username`, `post_time`, `post_content`, `post_picture`, `like_num`) VALUES
(1, 'Sunny', '2018_11_05_11_54_52', 'today is a good day because i have posted the fourth post and i am polishing my existence value', 'no pic', 0),
(2, 'Sunny', '2018_11_05_14_30_18', 'no pic no pic', 'no pic', 0),
(3, 'Sunny', '2018_11_05_19_19_48', 'this cat is really cute', 'image_DB/Sunny/2018_11_05_19_19_48.jpg', 0),
(4, 'Sunny', '2018_11_05_19_32_38', 'do u like a pen like this', 'image_DB/Sunny/2018_11_05_19_32_38.png', 0),
(5, 'Sunny', '2018_11_06_10_21_20', 'no, I like pic very much~', 'image_DB/Sunny/2018_11_06_10_21_20.jpg', 0),
(6, 'Sunny', '2018_11_06_10_23_20', 'no no no pic i like', 'no pic', 0),
(7, '15104202d', '2018_11_23_22_15_49', 'I am new here and hope that everyone can know about me', 'no pic', 0),
(8, 'wen', '2018_11_24_19_29_48', 'I am wen and you guys can follow me', 'image_DB/wen/2018_11_24_19_29_48.png', 0);

-- --------------------------------------------------------

--
-- 表的结构 `quote`
--

CREATE TABLE `quote` (
  `quote_id` int(10) NOT NULL,
  `quote_type` varchar(100) NOT NULL,
  `quote_content` varchar(200) NOT NULL,
  `quote_picture` varchar(200) NOT NULL,
  `comment_user` varchar(20) NOT NULL,
  `comment_content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `quote`
--

INSERT INTO `quote` (`quote_id`, `quote_type`, `quote_content`, `quote_picture`, `comment_user`, `comment_content`) VALUES
(1, 'quotes, sentences, energy, positive, encourage, encouraging, cheering, cheer upper', 'One day the reality will be better than your dreams', 'quote_db/1.jpg', '', ''),
(2, 'quotes, sentences, energy, positive, encourage, encouraging, cheering, cheer upper', 'Happiness is not about getting all you want, it is all about enjoying all you have', 'quote_db/2.jpg', '', ''),
(3, 'quotes, sentences, energy, positive, encourage, encouraging, cheering, cheer upper', 'No one is extraordinary from their birth. Extraordinary people have to work extra hard to make their everyday special.', 'quote_db/3.jpg', '', ''),
(4, 'quotes, sentences, energy, positive, encourage, encouraging, cheering, cheer upper', 'Don\'t ruin a good today by thinking about a bad yesterday. Let it go', 'quote_db/4.jpg', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `relation`
--

CREATE TABLE `relation` (
  `userone` varchar(20) DEFAULT NULL,
  `relation` varchar(20) DEFAULT NULL,
  `usertwo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `relation`
--

INSERT INTO `relation` (`userone`, `relation`, `usertwo`) VALUES
('Sunny', 'follow', 'lalalal'),
('Sunny', 'follow', 'wen'),
('aaa', 'follow', 'bbb'),
('tim', 'follow', 'issac'),
('sunny', 'follow', 'aaa'),
('wen', 'follow', 'Sunny');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `loginstate` varchar(10) NOT NULL DEFAULT 'offline',
  `password` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `age` int(10) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `birthday` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `like_post` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`username`, `loginstate`, `password`, `city`, `age`, `profile`, `birthday`, `gender`, `email`, `like_post`) VALUES
('lalalal', 'offline', '123', 'JIANGMEN', 0, '', '1997-10-25', '1', '15101888d@connect.polyu.hk', 'Like_post: '),
('poteh1', 'offline', '123', 'kowllon', 0, '', '2018-10-25', '4', '15104202D@connect.polyu.hk', 'Like_post: '),
('Sunny', 'offline', '123', 'CHAOJIANG ROAD,', 0, '', '2018-10-25', '4', '1614704061@qq.com', 'Like_post: '),
('wen', 'offline', '123', 'beijing', 20, 'he is a cute dog', '1998-20-25', '2', '1@q.com', 'Like_post: '),
('15104202d', 'offline', '123', 'Kowloon', 0, '', '2018-10-25', '4', '974961865@qq.com', 'Like_post: ');

--
-- 转储表的索引
--

--
-- 表的索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
