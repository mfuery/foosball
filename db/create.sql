
CREATE DATABASE foosball;
USE foosball;
CREATE TABLE scores (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  name1 varchar(255) NOT NULL DEFAULT '',
  score1 tinyint(1) NOT NULL DEFAULT '0',
  name2 varchar(255) NOT NULL DEFAULT '',
  score2 tinyint(1) NOT NULL DEFAULT '0',
  created datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

