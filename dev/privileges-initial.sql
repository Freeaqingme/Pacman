CREATE TABLE IF NOT EXISTS `privileges` (
  `privilige_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `enviroment_id` int(10) unsigned NOT NULL,
  `permission` tinyint(3) unsigned,
  PRIMARY KEY (`privilige_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

ALTER TABLE  `privileges` ADD INDEX (  `user_id` );
ALTER TABLE  `privileges` ADD INDEX (  `project_id` );
ALTER TABLE  `privileges` ADD INDEX (  `enviroment_id` );

ALTER TABLE user ADD adminlevel smallint(6) unsigned NOT NULL;

-- 12-10-2012 / Rob
ALTER TABLE project ADD description text NOT NULL;