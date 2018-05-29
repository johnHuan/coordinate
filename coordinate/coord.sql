-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-13 01:53:22
-- 服务器版本： 5.7.10-log
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coord`
--

-- --------------------------------------------------------

--
-- 表的结构 `canshu`
--

CREATE TABLE `canshu` (
  `qid` tinyint(4) NOT NULL COMMENT '//七参数编号',
  `X0` double NOT NULL COMMENT '//△X0平移分量单位m',
  `Y0` double NOT NULL COMMENT '//△Y0平移分量单位m',
  `Z0` double NOT NULL COMMENT '//△Z0平移分量单位m//',
  `ex` double NOT NULL COMMENT '//欧拉角εx旋转角单位秒',
  `ey` double NOT NULL COMMENT '//欧拉角εy旋转角单位秒',
  `ez` double NOT NULL COMMENT '//欧拉角εz旋转角单位秒',
  `m` double NOT NULL COMMENT '//缩放因子m',
  `style` int(11) NOT NULL COMMENT '//转换类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `canshu`
--

INSERT INTO `canshu` (`qid`, `X0`, `Y0`, `Z0`, `ex`, `ey`, `ez`, `m`, `style`) VALUES
(1, -13.2685, -29.2514, -7.8576, 0.4814, 0.013, 0.3126, 0.00000172153, 1),
(3, -2587193.135, 4781183.777, 2382621.383, -0.911553441, -2.283480801, -0.323446403, -0.00039712, 2);

-- --------------------------------------------------------

--
-- 表的结构 `canshu_style_info`
--

CREATE TABLE `canshu_style_info` (
  `fid` tinyint(4) NOT NULL,
  `_style` int(11) NOT NULL,
  `_info` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `canshu_style_info`
--

INSERT INTO `canshu_style_info` (`fid`, `_style`, `_info`) VALUES
(1, 1, '54系转80系'),
(2, 2, '54系转84系'),
(3, 3, '54系转2000系'),
(4, 4, '80系转54系'),
(5, 5, '80系转84系'),
(6, 6, '80系转2000系'),
(7, 7, '84系转54系'),
(8, 8, '84系转2000系');

-- --------------------------------------------------------

--
-- 表的结构 `dadi2kz`
--

CREATE TABLE `dadi2kz` (
  `did` int(11) NOT NULL,
  `L` double NOT NULL,
  `B` double NOT NULL,
  `H` double NOT NULL,
  `tuoqiu` text NOT NULL,
  `X` double NOT NULL,
  `Y` double NOT NULL,
  `Z` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `gauss_f`
--

CREATE TABLE `gauss_f` (
  `fid` tinyint(4) NOT NULL COMMENT '//编号',
  `x` double NOT NULL,
  `y` double NOT NULL,
  `N` int(11) NOT NULL,
  `tuoqiu` varchar(20) NOT NULL,
  `L` double NOT NULL,
  `B` double NOT NULL,
  `ll` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `gauss_z`
--

CREATE TABLE `gauss_z` (
  `Gid` int(10) UNSIGNED NOT NULL COMMENT '//计算点位编号',
  `jingdu` int(7) NOT NULL COMMENT '//经度',
  `weidu` int(7) NOT NULL COMMENT '//纬度',
  `fendai` int(11) NOT NULL COMMENT '//分带',
  `tuoqiu` varchar(20) DEFAULT NULL COMMENT '//椭球',
  `x` double DEFAULT '0' COMMENT '//转换后的X坐标',
  `y` double DEFAULT '0' COMMENT '//转换后的y坐标',
  `zhongyangziwuxianjingdu` double DEFAULT '0' COMMENT '//中央子午线经度值',
  `daihao` double NOT NULL DEFAULT '0' COMMENT '//该点所在的编号'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gauss_z`
--

INSERT INTO `gauss_z` (`Gid`, `jingdu`, `weidu`, `fendai`, `tuoqiu`, `x`, `y`, `zhongyangziwuxianjingdu`, `daihao`) VALUES
(12, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(11, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(10, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(13, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(14, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(15, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(16, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(17, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(18, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(19, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(20, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(21, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(22, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(23, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(24, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(25, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37),
(26, 1100101, 450101, 3, 'keshi_z', 4987385.61273, 77489.267510121, 111, 37);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dadi2kz`
--
ALTER TABLE `dadi2kz`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `gauss_f`
--
ALTER TABLE `gauss_f`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `gauss_z`
--
ALTER TABLE `gauss_z`
  ADD PRIMARY KEY (`Gid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `dadi2kz`
--
ALTER TABLE `dadi2kz`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `gauss_f`
--
ALTER TABLE `gauss_f`
  MODIFY `fid` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '//编号';
--
-- 使用表AUTO_INCREMENT `gauss_z`
--
ALTER TABLE `gauss_z`
  MODIFY `Gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '//计算点位编号', AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
