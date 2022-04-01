/*
Navicat MySQL Data Transfer

Source Server         : Dofus
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : betgame

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-04-01 19:15:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `points` int(11) NOT NULL DEFAULT 0,
  `confirmCode` int(11) NOT NULL,
  `confirmed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of accounts
-- ----------------------------

-- ----------------------------
-- Table structure for `bets`
-- ----------------------------
DROP TABLE IF EXISTS `bets`;
CREATE TABLE `bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL,
  `cote` int(11) NOT NULL,
  `mise` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(1) NOT NULL,
  `validated` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bets
-- ----------------------------

-- ----------------------------
-- Table structure for `bets_details`
-- ----------------------------
DROP TABLE IF EXISTS `bets_details`;
CREATE TABLE `bets_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `betid` int(11) NOT NULL,
  `accountid` int(11) NOT NULL,
  `matchid` int(11) NOT NULL,
  `bet` varchar(20) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `league` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `betid` (`betid`),
  KEY `accountid` (`accountid`),
  CONSTRAINT `accountid` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`),
  CONSTRAINT `betid` FOREIGN KEY (`betid`) REFERENCES `bets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bets_details
-- ----------------------------

-- ----------------------------
-- Table structure for `cotes`
-- ----------------------------
DROP TABLE IF EXISTS `cotes`;
CREATE TABLE `cotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchid` int(11) NOT NULL,
  `home` int(11) NOT NULL,
  `away` int(11) NOT NULL,
  `draw` int(11) NOT NULL,
  `sport` varchar(20) NOT NULL,
  `league` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cotes
-- ----------------------------
