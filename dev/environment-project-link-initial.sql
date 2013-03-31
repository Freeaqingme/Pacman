CREATE TABLE `environment_project_link` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `environment_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `environment_id` (`environment_id`,`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1$$