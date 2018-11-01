-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2018-11-01 05:06:14
-- 服务器版本： 10.1.36-MariaDB
-- PHP 版本： 7.2.10

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
  `username` varchar(20) NOT NULL,
  `post_time` varchar(50) NOT NULL,
  `post_content` varchar(200) NOT NULL,
  `post_picture` varchar(200) NOT NULL,
  `emotion` varchar(20) NOT NULL,
  `comment_content` varchar(200) NOT NULL,
  `comment_picture` varchar(200) NOT NULL,
  `comment_user` varchar(20) NOT NULL,
  `comment_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `post`
--

INSERT INTO `post` (`username`, `post_time`, `post_content`, `post_picture`, `emotion`, `comment_content`, `comment_picture`, `comment_user`, `comment_time`) VALUES
('', '', '', '', '', '', '', '', ''),
('123123', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `relation`
--

CREATE TABLE `relation` (
  `userone` varchar(20) DEFAULT NULL,
  `usertwo` varchar(20) DEFAULT NULL,
  `relation` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`username`, `loginstate`, `password`, `city`, `age`, `profile`, `birthday`, `gender`, `email`) VALUES
('', 'offline', '', '', 0, '', '', '', ''),
('poteh1', 'offline', '123', 'kowllon', 0, '', '2018-10-25', '4', '15104202D@connect.polyu.hk'),
('15104202d', 'offline', '123', 'Kowloon', 0, '', '2018-10-25', '4', '974961865@qq.com');

--
-- 转储表的索引
--

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
