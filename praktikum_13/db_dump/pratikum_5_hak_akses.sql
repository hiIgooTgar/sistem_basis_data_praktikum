USE mysql;
SHOW TABLES

SELECT USER, HOST, PASSWORD FROM USER

CREATE USER 'user_admin'@'localhost';

CREATE USER 'user_supervisor'
IDENTIFIED BY 'supervisor1'

CREATE USER 'user_kasir'@'127.0.0.1';
IDENTIFIED BY 'kasir1'

CREATE USER 'igo_if'@'127.0.0.1'
IDENTIFIED BY 'igo_if24c'

DROP USER 'user_admin'@'localhost'

CREATE USER 'user_admin'@'localhost' IDENTIFIED BY 'admin';
GRANT SELECT ON 24sa11a159.* TO 
'user_admin'@'localhost';

CREATE USER 'user_kasir'@'localhost' IDENTIFIED BY 'kasir1';
GRANT SELECT ON 24sa11a159.tbproduk TO 
'user_kasir'@'localhost';
GRANT SELECT ON 24sa11a159.tbpelanggan TO
'user_kasir'@'localhost';

CREATE USER 'user_owner'@'localhost' IDENTIFIED BY 'sila';
GRANT ALL ON 24sa11a159.* TO 
'user_owner'@'localhost';

CREATE USER 'user_pelanggan'@'localhost';
GRANT SELECT (namaproduk, stok, harga) ON 24sa11a159.tbproduk
TO 'user_pelanggan'@'localhost';

SHOW GRANT FOR user_owner@localhost;
SHOW GRANT FOR user_admin@localhost;
SHOW GRANT FOR user_kasir@localhost;
SHOW GRANT FOR user_pelanggan@localhost;


SET PASSWORD FOR user_owner@'localhost' = PASSWORD('owner');

REVOKE INSERT ON 24sa11a159.* FROM 'user_owner'@'localhost';
REVOKE ALL ON 24sa11a159.* FROM 'user_owner'@'localhost';
REVOKE SELECT ON 24sa11a159.* FROM 'user_admin'@'localhost';