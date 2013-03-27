INSERT INTO cluster
    (id, name)
VALUES
    (1, 'Cluster A'),
    (2, 'Cluster B');

INSERT INTO cluster_environment
    (cluster_id, environment_id)
VALUES
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (2, 1);

UPDATE credential
SET cluster_id = 1
WHERE id IN(1,3);
