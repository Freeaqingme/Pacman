CREATE TABLE IF NOT EXISTS user (
  user_id int(10) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL UNIQUE,
  email varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL UNIQUE,
  display_name varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL UNIQUE,
  password varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
