SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+01:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` text COLLATE utf8_unicode_ci NOT NULL,
  `ga_token` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `admins` (`id`, `username`, `passwd`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3');

DROP TABLE IF EXISTS `bets`;
CREATE TABLE `bets` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `player` int(255) NOT NULL,
  `under_over` int(1) NOT NULL,
  `bet_amount` double NOT NULL,
  `multiplier` double NOT NULL,
  `result` double NOT NULL,
  `win_lose` int(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `sender` int(255) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `deposits`;
CREATE TABLE `deposits` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `player_id` int(255) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `received` int(1) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `txid` text COLLATE utf8_unicode_ci NOT NULL,
  `confirmations` int(255) NOT NULL DEFAULT '0',
  `time_generated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE `admin_logs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `admin_id` int(255) NOT NULL,
  `ip` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `browser` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `hash` text COLLATE utf8_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `alias` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_last_active` datetime NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `lastip` text COLLATE utf8_unicode_ci NOT NULL,
  `server_seed` text COLLATE utf8_unicode_ci NOT NULL,
  `last_server_seed` text COLLATE utf8_unicode_ci NOT NULL,
  `t_bets` int(255) NOT NULL DEFAULT '0',
  `t_wagered` double NOT NULL DEFAULT '0',
  `t_wins` int(255) NOT NULL DEFAULT '0',
  `t_profit` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `id` int(1) NOT NULL DEFAULT '1',
  `autoalias_increment` int(255) NOT NULL DEFAULT '1',
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `currency` text COLLATE utf8_unicode_ci NOT NULL,
  `currency_sign` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `activeTheme` text COLLATE utf8_unicode_ci NOT NULL,
  `giveaway` int(1) NOT NULL DEFAULT '0',
  `giveaway_amount` double NOT NULL DEFAULT '0',
  `chat_enable` int(1) NOT NULL DEFAULT '1',
  `bot_enable` int(1) NOT NULL DEFAULT '1',
  `t_bets` int(255) NOT NULL DEFAULT '0',
  `t_wagered` double NOT NULL DEFAULT '0',
  `t_wins` int(255) NOT NULL DEFAULT '0',
  `t_player_profit` double NOT NULL DEFAULT '0',
  `house_edge` double NOT NULL DEFAULT '1',
  `rolls_mintime` int(255) NOT NULL DEFAULT '0',
  `rolls_mintime_bB` int(255) NOT NULL DEFAULT '0',
  `giveaway_freq` int(255) NOT NULL DEFAULT '0',
  `min_withdrawal` double NOT NULL DEFAULT '0',
  `bankroll_maxbet_ratio` double NOT NULL DEFAULT '25'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `system` (`id`, `autoalias_increment`, `title`, `url`, `currency`, `currency_sign`, `description`, `activeTheme`, `giveaway`, `giveaway_amount`, `chat_enable`, `bot_enable`, `t_bets`, `t_wagered`, `t_wins`, `t_player_profit`, `house_edge`, `rolls_mintime`, `rolls_mintime_bB`, `giveaway_freq`, `min_withdrawal`, `bankroll_maxbet_ratio`) VALUES
(1,	1,	'default',	'default',	'default',	'default',	'default', 'ClassicPurple',	0,	0,	1,	1,	0,	0,	0,	0,	1,	500,	500,	60,	0.0002,	25);

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `player_id` int(255) NOT NULL,
  `amount` double NOT NULL,
  `txid` text COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `player_id` (`player_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
