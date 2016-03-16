/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : 127.0.0.1:3306
Source Database       : yii_emr

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2016-03-15 20:06:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `scid` varchar(13) DEFAULT NULL,
  `sdate` datetime DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('68', 'bomkeen', '3140300265381', '2016-02-08 11:03:48');
INSERT INTO `log` VALUES ('69', 'bomkeen', '3140300265411', '2016-02-09 12:52:56');
INSERT INTO `log` VALUES ('70', 'bomkeen', '3140300265381', '2016-02-10 15:10:16');
INSERT INTO `log` VALUES ('72', 'bomkeen', '3140300265381', '2016-02-12 13:59:29');
INSERT INTO `log` VALUES ('60', 'bomkeen', '3140300265411', '2016-02-05 12:27:39');
INSERT INTO `log` VALUES ('61', 'bomkeen', '3140300265381', '2016-02-05 12:28:59');
INSERT INTO `log` VALUES ('62', 'bomkeen', '3140300265411', '2016-02-05 12:29:15');
INSERT INTO `log` VALUES ('63', 'bomkeen', '0107690716295', '2016-02-05 12:31:13');
INSERT INTO `log` VALUES ('64', 'bomkeen', '0107690716295', '2016-02-05 12:32:27');
INSERT INTO `log` VALUES ('65', 'bomkeen', '0107690716295', '2016-02-05 13:53:12');
INSERT INTO `log` VALUES ('66', 'bomkeen', '3110400786382', '2016-02-05 14:28:58');
INSERT INTO `log` VALUES ('71', 'bomkeen', '3110400786382', '2016-02-12 13:57:21');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1454493550');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1454493552');
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', '1454493552');
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', '1454493552');
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', '1454493552');
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', '1454493552');
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', '1454493552');
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', '1454493552');
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', '1454493552');
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', '1454493552');
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', '1454493552');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', 'peeragad poonsawat', 'bomkeen66@hotmail.com', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '');
INSERT INTO `profile` VALUES ('2', 'ทดสอบ การสมัคร ', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', '');

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for tmp_s
-- ----------------------------
DROP TABLE IF EXISTS `tmp_s`;
CREATE TABLE `tmp_s` (
  `cid` int(13) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of tmp_s
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '8F8VbfEVtaAzOroo2t8a_Viyl1_diUp7', '1454494112', '0');
INSERT INTO `token` VALUES ('2', 'Ue5CCWXrBNvAUFfHSYZ7uoP4vQ4u1U3j', '1454904692', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'bomkeen', 'bomkeen66@hotmail.com', '$2y$12$2pGPe5ky5q/2ve7LP7xD6umuhgI9sEMs3pEP1P765hTypZogpRrNG', 'IEKyNKs_pxuZpAK_CCFPPWAzrXJOQ3bY', '1454596172', null, null, '127.0.0.1', '1454494112', '1454494112', '0');
INSERT INTO `user` VALUES ('2', 'user', 'test1@hotmail.com', '$2y$12$4MDaCiuQl2Jgwn8h.jE8W.Zb.RixNrZPljzG.bp9HOFl3SWGMqB4i', 'ZyjRG3pQxqvSSWe8OtivH4BTZoA76brb', null, null, null, '127.0.0.1', '1454904692', '1454904692', '0');
