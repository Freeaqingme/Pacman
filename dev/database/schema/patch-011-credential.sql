CREATE TABLE IF NOT EXISTS credential (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  project_id int(10) unsigned NOT NULL,
  category_id int(10) unsigned NOT NULL,
  notes text COLLATE utf8_unicode_ci NULL,
  url varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  username varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  password varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (id),
  CONSTRAINT project_fk FOREIGN KEY (project_id) REFERENCES project (id),
  CONSTRAINT category_fk FOREIGN KEY (category_id) REFERENCES category (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS credential_environment (
  credential_id int(10) unsigned NOT NULL,
  environment_id int(10) unsigned NOT NULL,
  PRIMARY KEY (credential_id,environment_id),
  CONSTRAINT credential FOREIGN KEY (credential_id) REFERENCES credential (id),
  CONSTRAINT environment FOREIGN KEY (environment_id) REFERENCES environment (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
