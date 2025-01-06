CREATE DATABASE responsi_namamhs;
USE responsi_namamhs;

CREATE TABLE tbcabang(
 idcabang CHAR(2) PRIMARY KEY,
 namacabang VARCHAR(30),
 pimpinan VARCHAR(30)
)

CREATE TABLE tbnasabah(
 norek VARCHAR(15) PRIMARY KEY,
 nama VARCHAR(30),
 alamat VARCHAR(35),
 saldo INT, 
 idcabang CHAR(2),
 
 FOREIGN KEY (idcabang) REFERENCES tbcabang(idcabang)
)

CREATE TABLE tbtransaksi(
 idtransaksi VARCHAR(15) PRIMARY KEY,
 tanggal DATE,
 norek VARCHAR(15),
 jenis ENUM('simpan', 'penarikan'), 
 nominal INT,
 
  FOREIGN KEY (norek) REFERENCES tbnasabah(norek)
)





INSERT INTO tbcabang(idcabang, namacabang, pimpinan) VALUES('C1', 'Kanca Purwokerto', 'Ananda Syifa'),
('C2', 'Kanca Banyumas', 'Rafif Ahmad'),
('C3', 'Kanca Purbalingga', 'Wulandari'),
('C4', 'Kanca Banjarnegara', 'Anugerah');

INSERT INTO tbnasabah(norek, nama, alamat, saldo, idcabang) VALUES('123456', 'Abdurrahman', 'Banyumas', '10000000', 'C2'),
('745689', 'Retno Ambarwati', 'Banyumas', '5000000', 'C2'),
('336688', 'Salman Alfarizi', 'Purwokerto', '7000000', 'C1'),
('909023', 'Rika Suryani', 'Banjarnegara', '8500000', 'C4'),
('775959', 'Sulaiman', 'Purwokerto', '12000000', 'C1');

INSERT INTO tbtransaksi(idtransaksi, tanggal, norek, jenis, nominal) VALUES('t1', '2024-11-11', '745689', 'simpan', '500000'),
('t2', '2024-11-11', '909023', 'penarikan', '2000000'),
('t3', '2024-11-12', '123456', 'simpan', '1000000'),
('t4', '2024-11-12', '775959', 'simpan', '750000');




UPDATE tbcabang SET pimpinan = 'Surya Adi Pratama' WHERE idcabang = 'C1'

SELECT norek, nama, saldo FROM tbnasabah WHERE saldo > 8000000

SELECT SUM(nominal) AS total_nominal_transaksi_simpan FROM tbtransaksi WHERE jenis = 'simpan'

SELECT COUNT(*) AS jumlah_transaksi_di_tanggal_2024_11_11 FROM tbtransaksi WHERE tanggal = '2024-11-11'
SELECT COUNT(*) AS jumlah_transaksi_di_tanggal_2024_11_12 FROM tbtransaksi WHERE tanggal = '2024-11-12'



SELECT tbcabang.idcabang, tbcabang.namacabang, tbnasabah.nama FROM tbcabang
LEFT JOIN tbnasabah ON tbcabang.idcabang = tbnasabah.idcabang


SELECT tbtransaksi.idtransaksi, tbtransaksi.tanggal, tbnasabah.nama, tbtransaksi.jenis, tbtransaksi.nominal FROM tbnasabah
INNER JOIN tbtransaksi ON tbnasabah.norek = tbtransaksi.norek