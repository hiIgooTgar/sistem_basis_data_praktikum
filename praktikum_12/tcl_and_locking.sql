SELECT USER, HOST, PASSWORD FROM USER

CREATE USER 'user_admin'@'localhost' IDENTIFIED BY '123';
GRANT ALL ON praktikumsbd.* TO 'user_admin'@'localhost'

CREATE USER 'user';
GRANT ALL ON praktikumsbd.* TO 'user'

DROP USER 'user_admin'@'localhost'
DROP USER 'user'


SET autocommit=0; 
START TRANSACTION; 
INSERT INTO tbpenjualan VALUES(6, 'PJN-11', '2024-01-01', 1, 4, 180000); 
INSERT INTO tbdetailjual VALUES('PJN-11', 3, 1 ,180000, jumlah*harga); 
UPDATE tbproduk SET stok = stok - 1 WHERE idproduk = 7;
COMMIT;


SET autocommit=0;
START TRANSACTION;
INSERT INTO tbpelanggan VALUES(11, "Surya Saputra", "Purbalingga", "08984736");
ROLLBACK;


SET autocommit=0; 
START TRANSACTION; 
UPDATE tbpelanggan SET namapelanggan = 'Hanifah Saputri' WHERE idpelanggan = 5; 
SAVEPOINT a; 
INSERT INTO tbpelanggan VALUES(11, 'Arya Wiragama', 'Banyumas','082387237'); 
SAVEPOINT b; 
INSERT INTO tbpelanggan VALUES(12, 'Ria Yati Sandera', 'Banyumas','083923273');
ROLLBACK TO b; 
ROLLBACK TO a;

LOCK TABLE tbproduk READ;
LOCK TABLE tbproduk WRITE;
UNLOCK TABLE;

START TRANSACTION;
SELECT * FROM tbproduk WHERE idproduk = 1 LOCK IN SHARE MODE;

START TRANSACTION;
SELECT * FROM tbproduk WHERE idproduk = 1 FOR UPDATE;

SELECT * FROM tbpenjualan
SELECT * FROM tbpelanggan
SELECT * FROM tbdetailjual
SELECT * FROM tbproduk