DROP TABLE wg_data_cache;
DROP TABLE wg_data_status;

CREATE TABLE wg_data_cache (
  id_spot int4 NOT NULL default 0,
  id_model int4 NOT NULL default 0,
  lang char(2),
  data text NOT NULL,
  met timestamp without time zone,
  wave timestamp without time zone 
);
GRANT SELECT,UPDATE,DELETE,INSERT ON wg_data_cache TO PUBLIC;

CREATE TABLE wg_data_status (
  id int4 primary key,
  val TEXT
);
GRANT SELECT,UPDATE,DELETE,INSERT ON wg_data_status TO PUBLIC;

INSERT INTO wg_data_status (id, val) VALUES (0,'0');
INSERT INTO wg_data_status (id, val) VALUES (3,'1970-01-01 00:00:00');
INSERT INTO wg_data_status (id, val) VALUES (10,'1970-01-01 00:00:00');

