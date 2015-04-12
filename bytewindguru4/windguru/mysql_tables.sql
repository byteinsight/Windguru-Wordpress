DROP TABLE IF EXISTS wg_data_cache;
DROP TABLE IF EXISTS wg_data_status;

CREATE TABLE `wg_data_cache` (
  `id_spot` int(10) unsigned NOT NULL,
  `id_model` int(10) unsigned NOT NULL,
  `lang` char(2),
  `data` blob NOT NULL,
  `met` datetime default NULL,
  `wave` datetime default NULL
) TYPE=MyISAM;

CREATE TABLE `wg_data_status` (
  `id` int(10) unsigned NOT NULL,
  `val` text
) TYPE=MyISAM;

INSERT INTO wg_data_status (id, val) VALUES (0,'0');
INSERT INTO wg_data_status (id, val) VALUES (3,'1970-01-01 00:00:00');
INSERT INTO wg_data_status (id, val) VALUES (10,'1970-01-01 00:00:00');

