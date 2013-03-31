INSERT INTO server
    (id, name, cluster_id)
VALUES
    (1, 'Server X', 1),
    (2, 'Server Y', 1);

UPDATE credential SET server_id = 1 WHERE id IN(1,2);
UPDATE credential SET server_id = 2 WHERE id IN(3,4);
