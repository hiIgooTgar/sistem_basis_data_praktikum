CREATE DATABASE restoran_sbd
USE restoran_sbd

CREATE TABLE users(
 id_users INT(11) PRIMARY KEY AUTO_INCREMENT,
 username VARCHAR(255),
 PASSWORD VARCHAR(255),
 nama VARCHAR(64),
 gender ENUM('L', 'P'),
 no_telp CHAR(16),
 alamat TEXT,
 ROLE BOOLEAN
)

CREATE TABLE makanan(
 id_makanan INT(11) PRIMARY KEY AUTO_INCREMENT,
 nama_makanan VARCHAR(64),
 harga INT(11)
)

CREATE TABLE minuman(
 id_minuman INT(11) PRIMARY KEY AUTO_INCREMENT,
 nama_minuman VARCHAR(64),
 harga INT(11)
)

CREATE TABLE pesanan(
 id_pesanan INT(11) PRIMARY KEY AUTO_INCREMENT,
 tgl_pesanan DATETIME,
 status_pesanan ENUM('proses', 'diterima', 'gagal'),
 id_users INT(11),
 
 FOREIGN KEY (id_users) REFERENCES users(id_users)
)

CREATE TABLE detail_pesanan(
 id_detail_pesanan INT(11) PRIMARY KEY AUTO_INCREMENT,
 id_makanan INT(11),
 jumlah_makanan INT(11),
 id_minuman INT(11),
 jumlah_minuman INT(11),
 total_pesanan INT(11),
 id_pesanan INT(11),
 
 FOREIGN KEY(id_pesanan) REFERENCES pesanan(id_pesanan),
 FOREIGN KEY(id_makanan) REFERENCES makanan(id_makanan),
 FOREIGN KEY(id_minuman) REFERENCES minuman(id_minuman)
)

CREATE TABLE pembayaran(
 id_pembayaran INT(11) PRIMARY KEY AUTO_INCREMENT,
 jumlah_bayar INT(11),
 metode_pembayaran ENUM('cash', 'debit', 'qris'),
 tgl_pembayaran DATETIME,
 id_pesanan INT(11),
 
 FOREIGN KEY(id_pesanan) REFERENCES pesanan(id_pesanan)
)