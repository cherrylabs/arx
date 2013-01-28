CREATE TABLE IF NOT EXISTS `t_labels` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` longtext NOT NULL,
  `isocode` varchar(5) NOT NULL DEFAULT 'fr',
  `context` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;