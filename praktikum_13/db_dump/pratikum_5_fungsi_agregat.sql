USE 24sa11a159

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