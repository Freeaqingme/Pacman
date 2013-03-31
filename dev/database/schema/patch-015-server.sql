CREATE TABLE IF NOT EXISTS server (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    cluster_id INT(10) UNSIGNED NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_server_cluster FOREIGN KEY (cluster_id) REFERENCES cluster (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET foreign_key_checks = 0;

ALTER TABLE credential
    ADD COLUMN server_id INT(10) UNSIGNED NOT NULL AFTER cluster_id,
    ADD CONSTRAINT fk_credential_server
    FOREIGN KEY (server_id)
    REFERENCES server (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

SET foreign_key_checks = 1;
