#04/12/2011 Maxim

CREATE TABLE mb_cache (
  name varchar(50) NOT NULL,
  value mediumtext NOT NULL,
  PRIMARY KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE mb_users (
  ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  login varchar(50) NOT NULL,
  password  varchar(32) NOT NULL,
  email varchar(50) NOT NULL DEFAULT '',
  isAdmin tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  firstname varchar(50) NOT NULL DEFAULT '',
  lastname varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (ID),
  UNIQUE KEY uniqueLogin (login),
  UNIQUE KEY uniqueEmail (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;