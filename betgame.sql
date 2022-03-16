/*
Navicat MySQL Data Transfer

Source Server         : Dofus
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : betgame

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-03-16 19:11:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `accounts`
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT '',
  `password` varchar(100) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES ('6', 'nassim', 'test@test.com', '1568e3d2b2383c3b2c813d9a326720fda7b1f5d7d9b8b2b81c3ea80bc9b118c2', '556');
INSERT INTO `accounts` VALUES ('7', 'martin', 'martinlebg@gmail.com', 'dc03b27079721aee79f33f5b6441168d2e941b31b9a0b2ea4cafb2b9168c41c6', '0');
INSERT INTO `accounts` VALUES ('8', 'baptiste', 'baptistelebgdu37@gmail.com', 'd9c918b0896854b587665db158e5eb2c9df82456dc9d841d75c1fa70e9b95100', '0');
INSERT INTO `accounts` VALUES ('9', 'dzadzadzdzadz', 'dzada@gmail.com', 'e3d80d10307b29b89e7941db862aacdd2b9babc9789a940c2c8bd436dda472a7', '10');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

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
  CONSTRAINT `betid` FOREIGN KEY (`betid`) REFERENCES `bets` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of bets_details
-- ----------------------------
