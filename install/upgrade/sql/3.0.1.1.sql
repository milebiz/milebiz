/* STRUCTURE */
CREATE TABLE `PREFIX_city` (
`id_city` INT( 10 ) unsigned NOT NULL auto_increment,
`id_state` INT( 10 ) unsigned NOT NULL,
`name` varchar(64) NOT NULL,
`active` tinyint(1) NOT NULL default '0',
PRIMARY KEY (`id_city`),
  KEY `id_state` (`id_state`),
  KEY `name` (`name`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8;
