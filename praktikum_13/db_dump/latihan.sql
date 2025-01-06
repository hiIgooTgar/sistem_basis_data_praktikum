CREATE DATABASE db_penjualan;
USE db_penjualan;

CREATE TABLE barang (
    id_barang INT(11) PRIMARY KEY,
    nama_barang VARCHAR(32),
    id_jenisbarang INT(11),
    id_supplier INT(11),
    harga INT(16),
    stok INT(16)

    FOREIGN KEY (id_jenisbarang) REFERENCES jenis_barang(id_jenisbarang)
    FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier)
)

CREATE TABLE supplier (
    id_supplier INT(11) PRIMARY KEY,
    nama_supplier VARCHAR(32),
)

CREATE TABLE jenis_barang (
    id_jenisbarang INT(11) PRIMARY KEY,
    nama_jenisbarang VARCHAR(32),
)

CREATE TABLE totaltransaksi (
    id_transaksi INT(11) PRIMARY KEY,
    id_customer INT(16),
    id_barang INT(16),
    tgl_transaksi DATE,
    jumlah INT(16),
    keterangan VARCHAR(32)

    FOREIGN KEY (id_customer) REFERENCES customer(id_customer)
    FOREIGN KEY (id_barang) REFERENCES barang(id_barang)

)

CREATE TABLE customer (
    id_customer INT(11) PRIMARY KEY,
    nama_customer VARCHAR(32),
    alamat_customer VARCHAR(32),
    telp_customer VARCHAR(32)
)