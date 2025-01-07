DELIMITER $$
CREATE OR REPLACE PROCEDURE tambahPelanggan(IN id_pelanggan VARCHAR(16), IN namapelanggan VARCHAR(64),
IN alamatpelanggan VARCHAR(64), IN teleponpelanggan VARCHAR(64))

BEGIN 
INSERT INTO tbpelanggan VALUES(
id_pelanggan, namapelanggan, alamatpelanggan, teleponpelanggan);
END $$

CALL tambahPelanggan('C-9', 'Hamdani', 'Kebumen', '08847374637')


DELIMITER $$ 
CREATE OR REPLACE 