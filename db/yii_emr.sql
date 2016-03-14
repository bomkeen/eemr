/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50525
Source Host           : 127.0.0.1:3306
Source Database       : yii_emr

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2016-02-04 21:35:10
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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('27', 'bomkeen', '3110400786382', '2016-02-04 21:00:34');
INSERT INTO `log` VALUES ('28', 'bomkeen', '3110400786382', '2016-02-04 21:06:33');
INSERT INTO `log` VALUES ('29', 'bomkeen', '3110400786382', '2016-02-04 21:08:25');
INSERT INTO `log` VALUES ('30', 'bomkeen', '3110400786382', '2016-02-04 21:09:01');
INSERT INTO `log` VALUES ('31', 'bomkeen', '3110400786382', '2016-02-04 21:10:00');
INSERT INTO `log` VALUES ('32', 'bomkeen', '3110400786382', '2016-02-04 21:10:20');
INSERT INTO `log` VALUES ('33', 'bomkeen', '3110400786382', '2016-02-04 21:10:38');
INSERT INTO `log` VALUES ('34', 'bomkeen', '0107690716295', '2016-02-04 21:20:57');
INSERT INTO `log` VALUES ('35', 'bomkeen', '0107690716295', '2016-02-04 21:21:19');
INSERT INTO `log` VALUES ('36', 'bomkeen', '0107690716295', '2016-02-04 21:21:48');
INSERT INTO `log` VALUES ('37', 'bomkeen', '0107690716295', '2016-02-04 21:22:32');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'bomkeen', 'bomkeen66@hotmail.com', '$2y$12$2pGPe5ky5q/2ve7LP7xD6umuhgI9sEMs3pEP1P765hTypZogpRrNG', 'IEKyNKs_pxuZpAK_CCFPPWAzrXJOQ3bY', '1454596172', null, null, '127.0.0.1', '1454494112', '1454494112', '0');
