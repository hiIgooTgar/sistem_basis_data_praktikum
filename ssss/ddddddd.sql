/* Praktikum 6 join table */
SELECT u.nama, pem.metode_pembayaran, pem.tgl_pembayaran FROM users AS u
LEFT JOIN pesanan AS pes ON u.id_users = pes.id_users
LEFT JOIN pembayaran AS pem ON pem.id_pesanan = pes.id_pesanan

SELECT u.nama, mak.nama_makanan, dp.jumlah_makanan, mi.nama_minuman, dp.jumlah_minuman, pem.metode_pembayaran, pem.tgl_pembayaran, pes.status_pesanan, dp.total_pesanan FROM users AS u
INNER JOIN pesanan AS pes ON u.id_users = pes.id_users
INNER JOIN detail_pesanan AS dp ON dp.id_pesanan = pes.id_pesanan
INNER JOIN makanan AS mak ON mak.id_makanan = dp.id_makanan
INNER JOIN minuman AS mi ON mi.id_minuman = dp.id_minuman
INNER JOIN pembayaran AS pem ON pem.id_pesanan = pes.id_pesanan





/* Praktikum 5 aggregate sum count */
SELECT COUNT(id_users) AS "Jumlah Pengguna", alamat
FROM users GROUP BY alamat

SELECT SUM(jumlah_bayar) AS "Jumlah bayar" FROM pembayaran
SELECT MIN(jumlah_bayar) AS "Jumlah bayar yang terkecil" FROM pembayaran
SELECT MAX(jumlah_bayar) AS "Jumlah bayar yang terbesar" FROM pembayaran
SELECT AVG(jumlah_bayar) AS "Rata-rata jumlah pembayaran" FROM pembayaran






/* procedure 4 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE jumlahMakanan(OUT hasil INT)

BEGIN 
	SELECT COUNT(*) INTO hasil FROM makanan;
END $$

CALL jumlahMakanan(@jumlah)
SELECT @jumlah AS 'Jumlah Makanan | Procedure'
SELECT * FROM tbpelanggan




DELIMITER $$
CREATE OR REPLACE PROCEDURE tambahMinuman(IN id_minuman INT(11), IN nama_minuman VARCHAR(64), 
IN harga INT(11))

BEGIN 
	INSERT INTO minuman(id_minuman, nama_minuman, harga)
	VALUES(id_minuman, nama_minuman, harga);
END $$
CALL tambahMinuman('8', 'Energen', 2500);


/* Query Function */
DELIMITER $$
CREATE OR REPLACE FUNCTION jumlahBayarFunction(id INT(11))
RETURNS INT
BEGIN
	DECLARE jumlah INT;
	SELECT total_pesanan INTO jumlah FROM detail_pesanan
	WHERE id_pesanan = id;
	RETURN jumlah;
END $$
SELECT jumlahBayarFunction('2') AS 'Jumlah bayar pesanan | Function'
SELECT * FROM tbproduk




DELIMITER $$
CREATE OR REPLACE FUNCTION jumlahBayarFunctionSecond(p_harga INT(11))
RETURNS INT
BEGIN
	DECLARE jumlah INT;
	SELECT COUNT(total_pesanan) INTO jumlah FROM detail_pesanan
	WHERE total_pesanan < p_harga;
	RETURN jumlah;
END $$ 

SELECT jumlahBayarFunctionSecond(25000) AS 'Jumlah total pesanan yang harganya dibawah Rp. 25.000'




/* Control flow statement */
SELECT id_users, alamat,
IF (alamat = 'Purwokerto','','Luar Purwokerto') 
AS 'Keterangan' 
FROM users;

SELECT id_pembayaran, jumlah_bayar, 
CASE 
WHEN jumlah_bayar > 300000 THEN 'mahal' 
WHEN jumlah_bayar > 0 AND jumlah_bayar < 100000 THEN 'murah' 
ELSE 'tidak diketahui' 
END AS 'keterangan harga' 
FROM pembayaran;





DELIMITER $$ 
CREATE OR REPLACE TRIGGER tr_pesanan_menu
AFTER INSERT ON detail_pesanan 
FOR EACH ROW BEGIN 
UPDATE pesanan SET stok = stok + New.jumlah 
WHERE id_pesanan = NEW.idProduk; 
END$$

INSERT INTO pesanan VALUES
('sf-6','2023-10-29','KRY-1','Sp1-3',3400000),
('sf-7','2023-10-30','KRY-2','Spl-4',2049000);

INSERT INTO detail_pesanan VALUES
('sf-1','Prd-5',2,1700000,jumlah*harga),
('sf-1','Prd-1',3,2600000,jumlah*harga),
('sf-2','Prd-1',2,509000,jumlah*harga);



DELIMITER $$
CREATE OR REPLACE TRIGGER tr_cekharga
BEFORE INSERT ON makanan
FOR EACH ROW BEGIN
IF NEW.harga <= 8000 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'cek kembali harga makanan!';
END IF;
END$$

INSERT INTO makanan VALUES ('', 'Opor Ayam', 4500);
SELECT * FROM makanan





DELIMITER $$
CREATE OR REPLACE TRIGGER tr_hapusminuman
BEFORE DELETE ON minuman
FOR EACH ROW BEGIN 
	IF OLD.id_minuman = OLD.id_minuman THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Data minuman tidak dapat dihapus';
	END IF;
END $$

DELETE FROM minuman WHERE id_minuman = '7'




DELIMITER// 
CREATE OR REPLACE PROCEDURE cur_alamatusers()
BEGIN
DECLARE nama_users VARCHAR(64);
DECLARE exit_loop BOOLEAN;
DECLARE cursor1 CURSOR FOR
SELECT nama FROM users WHERE alamat = 'Banyumas';

DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;

OPEN cursor1;
ulang: LOOP
FETCH cursor1 INTO nama_users;
SELECT nama AS 'Daftar data users yang berdomusili di Banyumas'
FROM users
WHERE alamat = 'Banyumas';
IF exit_loop THEN
CLOSE cursor1;
LEAVE ulang;
END IF;
END LOOP ulang;
END;//

CALL cur_alamatusers();






SET autocommit=0; 
START TRANSACTION; 
INSERT INTO makanan VALUES(7, 'Mie Rebus', 12000); 
INSERT INTO minuman VALUES(8,'Teh Tarik', 7000); 
UPDATE makanan SET harga = harga + 1000 WHERE id_ = 7;
COMMIT;


SET autocommit=0;
START TRANSACTION;
INSERT INTO tbpelanggan VALUES(11, "Surya Saputra", "Purbalingga", "08984736");
ROLLBACK;

