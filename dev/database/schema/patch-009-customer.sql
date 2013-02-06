CREATE  TABLE IF NOT EXISTS customer (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  PRIMARY KEY (id) )
ENGINE = InnoDB 
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

SET foreign_key_checks = 0;

ALTER TABLE project
  ADD COLUMN customer_id INT(10) UNSIGNED NOT NULL  AFTER url,
  ADD CONSTRAINT fk_project_customer
    FOREIGN KEY (customer_id)
    REFERENCES customer (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

SET foreign_key_checks = 1;
