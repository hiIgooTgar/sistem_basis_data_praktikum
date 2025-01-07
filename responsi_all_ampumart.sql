/* Praktikum SBD Ampu Mart ==== Igo Tegar Prambudhy | 24SA11A159 | IF 24 C */

/* Praktikum 3 membuat database */
CREATE DATABASE praktikumsbd
USE praktikumsbd







/* Praktikum 4 membuat dml */
INSERT INTO tbkaryawan(idkaryawan, namakaryawan, teleponkaryawan, jabatan, sandi) VALUES
("KRY-1", "Arsila", "089625113", "Owner", "sila"),
("KRY-2", "Perwira", "08247364", "Supervisor", "wira"),
("KRY-3", "Misha", "081734764", "Admin", "misha"),
("KRY-4", "Ica", "089473436", "Kasir 1", "kasir1"),
("KRY-5", "Agus", "08387383", "Kasir 2", "kasir1");

INSERT INTO tbkategori(idkategori, namakategori) VALUES
("KEY-1", "Komputer"),
("KEY-2", "Printer"),
("KEY-3", "Alat Input"),
("KEY-4", "Aksesoris Komputer"),
("KEY-5", "Web Camera"),
("KEY-6", "Monitor"),
("KEY-7", "Media penyimpanan data");

INSERT INTO tbproduk(idproduk, namaproduk, idkategori, stok, harga) VALUES
("Prd-1", "Acer", "KEY-1", 10, 7000000),
("Prd-2", "Asus", "KEY-1", 20, 7000000),
("Prd-3", "Epson", "KEY-2", 5, 2500000),
("Prd-4", "SPC", "KEY-6", 5, 1500000),
("Prd-5", "SeaGate", "KEY-7", 5, 1500000);

INSERT INTO tbpelanggan(idpelanggan, namapelanggan, alamatpelanggan, teleponpelanggan) VALUES
("C-1", "Adi Gunawan", "Purwokerto", "083434343"),
("C-2", "Bia Ramadhan", "Purwokerto", "08244637"),
("C-3", "Cici Kirana", "Banyumas", "082217362"),
("C-4", "Dona Ariana", "Purbalingga", "086476423"),
("C-5", "Emilia", "Banyumas", "085754545"),
("C-6", "Fino Barlian", "Banyumas", "085354454"),
("C-7", "Gita Gustian", "Purwokerto", "0856767676"),
("C-8", "Hanum Permata", "Purbalingga", "08243434");

INSERT INTO tbpemasok(idpemasok, namapemasok, kontak, pic) VALUES
("Spl-1", "PT Inovasi Sukses Bersama","0874637463", "Ilham Sentosa"),
("Spl-2", "CV. Zara Tech Achievement", "0849389834", "Zara Zulaikha"),
("Spl-3", "PT Integra Autona Solusi", "0894834737", "Sultan"),
("Spl-4", "PT Jete Tenaga Indonesia", "087437434", "Arya Seloka"),
("Spl-5", "PT Inovasi Kreasi Sarana Prima", "085874584", "Wiryaman"),
("Spl-6", "PT Jaya Utama", "0834348734", "Wijaya"),
("Spl-7", "PT Daveeno Group Indonesia", "0827242424", "Davino Suharjo");

INSERT INTO tbpenjualan() VALUES
("tr-1", "2024-11-01", "KRY-4", "C-2", 30200000),
("tr-2", "2024-11-01", "KRY-4", "C-1", 27000000),
("tr-3", "2024-10-29", "KRY-5", "C-3", 34000000),
("tr-4", "2024-10-30", "KRY-5", "C-8", 30290000),
("tr-5", "2024-10-01", "KRY-5", "C-2", 27000000);

UPDATE tbpelanggan SET namapelanggan = "Agus Hadi Gunawan" WHERE namapelanggan = "Adi Gunawan";
DELETE FROM  tbkategori WHERE idkategori = "KEY-4";
REPLACE INTO tbkategori(idkategori, namakategori) VALUES("K-5", "Webcam");

SELECT * FROM tbkaryawan WHERE jabatan = "Owner";
SELECT * FROM tbkategori;
SELECT * FROM tbproduk;
SELECT * FROM tbpelanggan;
SELECT * FROM tbpenjual;








/* Praktikum 5 aggregate sum count */
SELECT COUNT(namapelanggan) AS "Jumlah Pelanggan" FROM tbpelanggan

SELECT alamatpelanggan, COUNT(namapelanggan) AS "Jumlah Pelanggan"
FROM tbpelanggan GROUP BY alamatpelanggan

SELECT SUM(stok) AS "Total Stok" FROM tbproduk

SELECT idkategori, SUM(stok) AS "Total Produk"
FROM tbproduk
GROUP BY idkategori
HAVING SUM(stok) >= 10;

SELECT tbproduk.namaproduk, tbkategori.namakategori, tbproduk.harga AS 'Total Harga Produk' 
FROM tbproduk INNER JOIN tbkategori ON tbproduk.idkategori = tbkategori.idkategori

SELECT tbproduk.namaproduk, tbproduk.idkategori, tbproduk.harga AS 'Total Harga Produk' 
FROM tbproduk







/* Praktikum 6 join table */
SELECT p.idproduk, p.namaproduk, k.namakategori FROM tbproduk AS p
CROSS JOIN tbkategori AS k

SELECT p.idproduk, p.namaproduk, k.namakategori FROM tbproduk AS p
INNER JOIN tbkategori AS k ON p.idkategori = k.idkategori

SELECT p.idproduk, p.namaproduk, k.namakategori FROM tbproduk AS p
LEFT JOIN tbkategori AS k ON p.idkategori = k.idkategori

SELECT p.idproduk, p.namaproduk, k.namakategori FROM tbproduk AS p
RIGHT JOIN tbkategori AS k ON p.idkategori = k.idkategori

SELECT pj.kdjual, k.namakaryawan FROM tbpenjualan AS pj 
RIGHT JOIN tbkaryawan AS k ON pj.nik = k.nik

SELECT dj.kdjual, p.namaproduk, dj.jumlah, dj.harga, dj.subtotal
FROM tbdetailjual AS dj INNER JOIN tbproduk AS p
ON dj.kdproduk = p.kdproduk
ORDER BY kdjual

SELECT pj.kdjual, k.namakaryawan FROM tbpenjualan AS pj 
RIGHT JOIN tbkaryawan AS k ON pj.nik = k.nik

SELECT dj.notajual, p.namaproduk, dj.jumlah, dj.harga, dj.subtotal
FROM tbdetailjual AS dj INNER JOIN tbproduk AS p
ON dj.idproduk = p.idproduk
ORDER BY notajual


/* Praktikum 8 procedure dan function */
/* Algoritma membuat Procedure in mysql */

/* procedure 1 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE tambahPelanggan(IN idpelanggan VARCHAR(16), IN namapelanggan VARCHAR(64), 
IN alamatpelanggan VARCHAR(64), IN teleponpelanggan VARCHAR(16))

BEGIN 
	INSERT INTO tbpelanggan(idpelanggan, namapelanggan, alamatpelanggan, teleponpelanggan)
	VALUES(idpelanggan, namapelanggan, alamatpelanggan, teleponpelanggan);
END $$

CALL tambahPelanggan('5', 'Anindya Saputri', 'Bogor', '081323762476');
CALL tambahPelanggan('6', 'Rehan Saputra', 'Bandung', '081673317364');
CALL tambahPelanggan('7', 'Farel Jamaludin', 'Sukabumi', '085923746772');
CALL tambahPelanggan('8', 'Pratama Wisnu', 'Kuningan', '081332117472');
CALL tambahPelanggan('9', 'Windi Wulan Purnomo', 'Bandung Raya', '08112166325');
CALL tambahPelanggan('10', 'Arief Pamungkas', 'Ciamis', '085121425144');

SELECT * FROM tbpelanggan



/* procedure 2 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE ubahPelanggan(IN id VARCHAR(16), IN nama VARCHAR(64),
IN alamat VARCHAR(64), IN telepon VARCHAR(16))

BEGIN 
	UPDATE tbpelanggan SET 
	namapelanggan = nama,
	alamatpelanggan = alamat,
	teleponpelanggan = telepon
	WHERE idpelanggan = id;
END $$

CALL ubahPelanggan('6', 'Lutfi Prasetyo', 'Bandung Raya', '08912545273');
CALL ubahPelanggan('7', 'Abdul Gunawan', 'Serang', '08937267246');

SELECT * FROM tbpelanggan



/* procedure 3 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE hapusPelanggan(IN id VARCHAR(16))

BEGIN
	DELETE FROM tbpelanggan WHERE idpelanggan = id;
END $$

CALL hapusPelanggan('10')

SELECT * FROM tbpelanggan



/* procedure 4 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE jumlahPelanggan(OUT hasil INT)

BEGIN 
	SELECT COUNT(*) INTO hasil FROM tbpelanggan;
END $$

CALL jumlahPelanggan(@jumlah)
SELECT @jumlah AS 'Jumlah Pelanggan | Procedure'
SELECT * FROM tbpelanggan



/* procedure 5 */
DELIMITER $$
CREATE OR REPLACE PROCEDURE jumlahPelangganSecond(IN alamat VARCHAR(64),
OUT hasil INT)

BEGIN
	SELECT COUNT(*) INTO hasil FROM tbpelanggan
	WHERE alamatpelanggan = alamat;
END $$

CALL jumlahPelangganSecond('Bekasi', @jumlah)
SELECT @jumlah AS 'Jumlah Pelanggan Second From Bekasi City | Procedure'

SELECT * FROM tbpelanggan



/* Algoritma membuat Function in mysql */

/* function 1 */
/* query implementasi fungsi string */
SELECT namapelanggan, LEFT(namapelanggan, 5), RIGHT(namapelanggan, 5) FROM tbpelanggan

/* query implementasi fungsi date and time */
SELECT tgljual, DATEDIFF(NOW(), tgljual) AS 'Tanggal sekarang' FROM tbpenjualan
SELECT tgljual, DATEDIFF(NOW(), tgljual) AS 'Tanggal sekarang' FROM tbpenjualan WHERE notajual = 'PJN-3'
SELECT tgljual, MONTHNAME(tgljual) FROM tbpenjualan

SELECT * FROM tbpenjualan



/* function 2 */
DELIMITER $$
CREATE OR REPLACE FUNCTION jumlahStokFunction(id INT(11))
RETURNS INT

BEGIN
	DECLARE jumlah INT;
	SELECT stok INTO jumlah FROM tbproduk
	WHERE idproduk = id;
	RETURN jumlah;
END $$

SELECT jumlahStokFunction('3') AS 'Jumlah Stok Tabel Produk | Function'
SELECT * FROM tbproduk



/* function 3 */
DELIMITER $$
CREATE OR REPLACE FUNCTION jumlahStokFunctionSecond(id INT(11))
RETURNS INT

BEGIN
	DECLARE jumlah INT;
	SELECT SUM(stok) INTO jumlah FROM tbproduk
	WHERE idkategori = id;
	RETURN jumlah;
END$$

SELECT jumlahStokFunctionSecond('4')
SELECT * FROM tbproduk



/* function 4 */
DELIMITER $$
CREATE OR REPLACE FUNCTION jumlahStokFunctionThird(p_harga INT(11))
RETURNS INT

BEGIN
	DECLARE jumlah INT;
	SELECT COUNT(harga) INTO jumlah FROM tbproduk
	WHERE harga < p_harga;
	RETURN jumlah;
END $$ 

SELECT jumlahStokFunctionThird(500000) AS 'Jumlah data barang yang harganya dibawah Rp. 500.000'
SELECT * FROM tbproduk



/* Praktikum 9 control flow statement */
SELECT idProduk, stok, 
IF (stok <= 5, 'stok terbatas', 
IF (stok <=30, 'stok cukup', 'stok berlebih'))
AS 'keterangan' 
FROM tbProduk ORDER BY stok;


SELECT idPelanggan, alamatPelanggan, 
IF (alamatPelanggan = 'Purwokerto','','Luar Purwokerto') 
AS 'Keterangan' 
FROM tbPelanggan;


SELECT idProduk,Harga, 
CASE 
WHEN harga > 5000000 THEN 'mahal' 
WHEN harga > 0 AND harga < 100000 THEN 'murah' 
ELSE 'tidak diketahui' 
END AS 'keterangan harga' 
FROM tbProduk;


DELIMITER $$ 
CREATE OR REPLACE FUNCTION cektransaksi (Pelanggan VARCHAR(10)) 
RETURNS VARCHAR (50) 

BEGIN 
DECLARE jumlah TINYINT; 
SELECT COUNT(notaJual) INTO jumlah FROM tbPenjualan 
WHERE idPelanggan-Pelanggan; 
IF (jumlah > 0) THEN 
RETURN CONCAT("Anda sudah bertransaksi sebanyak ", 
jumlah, "kali"); 
ELSE 
RETURN "Anda belum pernah melakukan transaksi"; 
END IF; 

END$$

SELECT cektransaksi ('C-1'); 
SELECT cektransaksi ('C-2'); 
SELECT cektransaksi ('C-4');


DELIMITER // 
CREATE OR REPLACE PROCEDURE ganjil(IN batas INT)
BEGIN 
	DECLARE i INT; 
	DECLARE hasil VARCHAR(30)DEFAULT '';  
	SET i = 1; 
	WHILE i < batas DO 
		IF MOD(i,2) != 0 THEN
		SET hasil = CONCAT(hasil, i,' '); 
		END IF;
		SET i = i + 1; 
	END WHILE; 
	SELECT hasil;
END //

 CALL ganjil (20);




/* Praktikum 10 trigger */

DELIMITER $$ 
CREATE OR REPLACE TRIGGER tr_Pembelian 
AFTER INSERT ON tbDetailBeli 
FOR EACH ROW BEGIN 
UPDATE tbProduk SET stok=stok+New.jumlah 
WHERE idProduk=NEW.idProduk; 
END$$

INSERT INTO tbPembelian VALUES
('sf-6','2023-10-29','KRY-1','Sp1-3',3400000),
('sf-7','2023-10-30','KRY-2','Spl-4',2049000);

INSERT INTO tbDetailBeli VALUES
('sf-1','Prd-5',2,1700000,jumlah*harga),
('sf-1','Prd-1',3,2600000,jumlah*harga),
('sf-2','Prd-1',2,509000,jumlah*harga);


DELIMITER $$
CREATE OR REPLACE TRIGGER tr_cekharga
BEFORE INSERT ON tbProduk
FOR EACH ROW BEGIN
IF NEW.harga <= 1000 THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'cek kembali harga produk!';
END IF;
END$$

INSERT INTO tbProduk VALUES ('Prd-6', 'Head Phone','k4',5,4500);
SELECT * FROM tbProduk

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_updateharga
BEFORE UPDATE ON tbProduk
FOR EACH ROW BEGIN
	IF NEW.harga <= 1000 THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'cek kembali harga produk!';
	END IF ;
END $$

UPDATE tbProduk SET harga=100 WHERE idProduk='Prd-1'

CREATE TABLE tblog_produk
(
id_log INT (10) AUTO_INCREMENT,
idproduk VARCHAR(10),
harga_lama INT,
harga_baru INT,
waktu DATETIME,
PRIMARY KEY(id_log)
)

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_update_hargaproduk
AFTER UPDATE ON tbProduk
FOR EACH ROW BEGIN
INSERT INTO tblog_produk SET idProduk = OLD.idProduk,
harga_lama=old.harga,
harga_baru=new.harga,
waktu = NOW();
END $$

UPDATE tbProduk SET harga=25000000 WHERE idProduk='Prd-1'
SELECT * FROM tblog_produk

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_hapuspemasok
BEFORE DELETE ON tbPemasok
FOR EACH ROW BEGIN 
	IF OLD.idPemasok=OLD.idPemasok THEN
	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Data pemasok tidak dapat dihapus';
	END IF;
END $$

DELETE FROM tbPemasok WHERE idPemasok='Sp1-1'

DELIMITER $$
CREATE OR REPLACE TRIGGER tr_hapusjual
AFTER DELETE ON tbPenjualan
FOR EACH ROW BEGIN
	DELETE FROM tbDetailBeli WHERE notaJual=OLD.notaJual;
END $$

DELETE FROM tbPenjualan WHERE notaJual='tr-1'
	
	













/* Praktikum 11 cursor */
DELIMITER// 
CREATE OR REPLACE PROCEDURE cur_alamatpel()
BEGIN
DECLARE nama_pel VARCHAR(64);
DECLARE exit_loop BOOLEAN;
DECLARE cursor1 CURSOR FOR
SELECT namapelanggan FROM tbpelanggan WHERE alamatpelanggan = 'Purwokerto';

DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;

OPEN cursor1;
ulang: LOOP
FETCH cursor1 INTO nama_pel;
SELECT namapelanggan AS 'Daftar Pelanggan yang berdomusili di Purwkokerto'
FROM tbpelanggan
WHERE alamatpelanggan = 'Purwokerto';
IF exit_loop THEN
CLOSE cursor1;
LEAVE ulang;
END IF;
END LOOP ulang;
END;//

CALL cur_alamatpel();


DELIMITER//
CREATE OR REPLACE PROCEDURE cur_caripelanggan(id VARCHAR(11))
BEGIN
DECLARE nama_pel VARCHAR(64);
DECLARE cursor1 CURSOR FOR
SELECT namapelanggan FROM tbpelanggan WHERE idpelanggan = id;

DECLARE EXIT HANDLER FOR 1329
	BEGIN 
	SELECT CONCAT('Data pelanggan ' , id, ' tidak ditemukan!') AS message;
	END;

OPEN cursor1;
FETCH cursor1 INTO nama_pel;
SELECT nama_pel;
CLOSE cursor1;
END; //

CALL cur_caripelanggan('1');
CALL cur_caripelanggan('2');
CALL cur_caripelanggan('22');



DELIMITER//

CREATE OR REPLACE PROCEDURE cur_pelanggan_count()
BEGIN
DECLARE p_alamat VARCHAR(64);
DECLARE p_count INT(11) UNSIGNED;
DECLARE jmlpelanggan CURSOR FOR
	SELECT alamatpelanggan, COUNT(*) FROM tbpelanggan GROUP BY alamatpelanggan;

OPEN jmlpelanggan;

FETCH jmlpelanggan INTO p_alamat, p_count;

SELECT alamatpelanggan, COUNT(*) AS 'Jumlah Pelanggan' FROM tbpelanggan
GROUP BY alamatpelanggan;
CLOSE jmlpelanggan;

END;//

CALL cur_pelanggan_count()



DELIMITER//

CREATE OR REPLACE PROCEDURE cur_hargaproduk()
BEGIN
DECLARE nama VARCHAR(64);
DECLARE exit_loop BOOLEAN;
DECLARE c1 CURSOR FOR
	SELECT namaproduk FROM tbproduk WHERE harga > 2500000;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;
DECLARE EXIT HANDLER FOR 1329
	BEGIN 
	SELECT CONCAT('Data produk tidak ditemukan!') AS pesan;
	END;
	
OPEN c1;
1b1: LOOP
FETCH c1 INTO nama;
SELECT namaproduk AS 'Daftar produk dengan harga > 2.5 Juta'
FROM tbproduk WHERE harga > 2500000;

IF exit_loop THEN
 CLOSE c1;
  LEAVE 1b1;
 END IF;
 END LOOP 1b1;
END;//

CALL cur_hargaproduk();
SELECT * FROM tbproduk ORDER BY harga DESC






DELIMITER //

CREATE OR REPLACE PROCEDURE cur_stokbarang()
BEGIN 
DECLARE nama VARCHAR(64);
DECLARE stokproduk TINYINT;
DECLARE exit_loop BOOLEAN;
DECLARE c1 CURSOR FOR
	SELECT namaproduk, stok FROM tbproduk ORDER BY stok;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;
OPEN c1;
1b1: LOOP
FETCH c1 INTO nama, stokproduk;
 SELECT namaproduk, stok AS 'Daftar 5 produk dengan stok terendah' FROM tbproduk
 ORDER BY stok LIMIT 5;
 IF exit_loop THEN
  CLOSE c1;
  LEAVE 1b1;
 END IF;
END LOOP 1b1;
END; //

CALL cur_stokbarang();















/* Praktikum 12 tcl dan loocking */
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