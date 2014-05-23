INSERT INTO `Identitas_BMT` (`Kode_Cabang`, `Nama_BMT`, `Alamat_BMT`, `Status`, `Nomor_Registrasi`, `Tgl_Pembukuan`) VALUES
(101, 'BMT Al-Hikma', 'Terara Lombok Timur NTB','Pusat','1A3344B','2014/5/1');


INSERT INTO `Daftar_Akun` (`Id_Daftar_Akun`, `Nama_Akun`, `Akun_DK`, `Akun_NR_LR`, `Jumlah_Debit`, `Jumlah_Kredit`) VALUES
(1000, 'AKTIVA', '','','',''),
(1100, 'AKTIVA LANCAR', '','','',''),
(1111, 'KAS','D','NR','',''),
(1112, 'Bank','D','NR','',''),
(1113, 'Bank Lain','D','NR','',''),
(1121, 'Bahan Habis Pakai Kantor','D','NR','',''),
(1131, 'Piutang Murabahah','D','NR','',''),
(1132, 'Piutang Murabahah Lewat Waktu','D','NR','0','0'),
(1133, 'Margin Murabahah Ditangguhkan','D','NR','0','0'),
(1136, 'Piutang Karyawan','D','NR','0','0'),
(1141, 'Persediaan Barang Murabahah','D','NR','0','0'),
(1171, 'Sewa Dibayar Dimuka','D','NR','0','0'),
(1200, 'AKTIVA TETAP','','','',''),
(1261, 'Peralatan Kantor','D','NR','0','0'),
(1271, 'Akumulasi Penyusutan Peralatan Kantor','D','NR','0','0'),
(2000, 'KEWAJIBAN','','','',''),
(2110, 'Tabungan','K','NR','0','0'),
(2210, 'Deposito','K','NR','0','0'),
(2310, 'Dana Titipan Nasabah Sementara','K','NR','0','0'),
(2320, 'Utang Gaji Karyawan','K','NR','0','0'),
(2330, 'Utang Listrik dan Telpon','K','NR','0','0'),
(3000, 'EQUITAS','','','',''),
(3110, 'Saham Anggota','K','NR','0','0'),
(3120, 'Tabungan Wajib Anggota','K','NR','0','0'),
(3210, 'SHU Belum Dibagi','K','NR','0','0'),
(4000, 'PENDAPATAN','','','',''),
(4110, 'Penjualan Barang Murabahah','K','NR','0','0'),
(4210, 'Pendapatan Margin Murabahah','K','NR','0','0'),
(4310, 'Pendapatan Murabahah Ditangguhkan Lewat Waktu','K','NR','0','0'),
(4410, 'Jasa Administrasi','K','NR','0','0'),
(4510, 'Provisi','K','NR','0','0'),
(5000, 'HARGA POKOK PENJUALAN','','','',''),
(5110, 'Harga Pokok Penjualan Barang Murabahah','D','LR','0','0'),
(6000, 'BIAYA USAHA','','','',''),
(6011, 'Biaya Gaji Karyawan','D','LR','0','0'),
(6012, 'Biaya Listrik dan Telpon','D','LR','0','0'),
(6013, 'Biaya Bahan Habis Pakai - Kantor','D','LR','0','0'),
(6014, 'Biaya Penyusutan Peralatan Kantor','D','LR','0','0'),
(6016, 'Biaya Sewa','D','LR','0','0'),
(6018, 'Potongan Tunai','D','LR','0','0'),
(6019, 'Biaya Penjualan dan Pemasaran','D','LR','0','0'),
(6020, 'Biaya Perjalanan Dinas','D','LR','0','0'),
(6021, 'Biaya Perbaikan Peralatan','D','LR','0','0'),
(6022, 'Lembur','D','LR','0','0'),
(6023, 'Penghapusan Piutang/Pembiayaan','D','LR','0','0'),
(6024, 'Bonus Tabungan','D','LR','0','0'),
(6025, 'Biaya Usaha Lainnya','D','LR','0','0'),
(7000, 'PENDAPATAN DAN BIAYA LAIN-LAIN','K','LR','0','0'),
(7100, 'Pendapatan Lain-Lain di Luar Usaha','K','LR','0','0'),
(7200, 'Biaya Lain-Lain di Luar Usaha','K','LR','0','0'),
(9000, 'IKHTISAR', '','','',''),
(9999, 'Ikhtisar Laba Rugi', '','','','');


INSERT INTO `bmtalhikma`.`pegawai` (`NIK`, `Nama`, `Alamat`, `Nomor_KTP`, `Nomor_SIM`, `Jenis_Kelamin`, `Tanggal_Masuk`, `Tanggal_Keluar`, `Status`) VALUES 
('P1', 'Lalu Sefty Junaedi', 'Jenggik', NULL, NULL, 'Pria', NULL, NULL, '1'), 
('P2', 'Andri Azwari', 'Jenggik', NULL, NULL, 'Wanita', NULL, NULL, '2'),
('P3', 'Suhirman', 'Jenggik', NULL, NULL, 'Pria', NULL, NULL, '3');


INSERT INTO `bmtalhikma`.`nasabah` (`Id_Nasabah`, `Nama`, `Alamat`, `Nomor_KTP`, `Nomor_SIM`, `Jenis_Kelamin`, `Tanggal_Masuk`, `Tanggal_Keluar`, `Status`) VALUES 
('N1', 'Fazlurrahman', 'Korleko', NULL, NULL, 'Pria', '2013-05-20', NULL, '1'), 
('N2', 'Abdul Majid Datok', 'Mataram', NULL, NULL, 'Pria', '2013-05-21', NULL, '1');

INSERT INTO `bmtalhikma`.`daftar_sandi` (`Id_Daftar_Sandi`, `Nama_Sandi`, `Id_Daftar_Akun_Debit`, `Id_Daftar_Akun_Kredit`) VALUES 
('01', 'Tabungan Wajib', '1111', '3120'), 
('02', 'Setor Tunai', '1111', '2110');

