CREATE TABLE IF NOT EXISTS cluster (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS cluster_environment (
    cluster_id INT(10) UNSIGNED NOT NULL,
    environment_id INT(10) UNSIGNED NOT NULL,
    PRIMARY KEY (cluster_id, environment_id),
    CONSTRAINT fk_credential_cluster_cluster FOREIGN KEY (cluster_id) REFERENCES cluster (id),
    CONSTRAINT fk_credential_cluster_environment FOREIGN KEY (environment_id) REFERENCES environment (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET foreign_key_checks = 0;

ALTER TABLE credential
    ADD COLUMN cluster_id INT(10) UNSIGNED NOT NULL AFTER category_id,
    ADD CONSTRAINT fk_credential_cluster
    FOREIGN KEY (cluster_id)
    REFERENCES cluster (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

SET foreign_key_checks = 1;
