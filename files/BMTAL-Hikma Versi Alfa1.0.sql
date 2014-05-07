/*
Created		15/04/2014
Modified		20/04/2014
Project		Akutansi BMT
Model		Utama
Company		BMT AL-Hikma
Author		Lalu Sefty Junaedi
Version		1.5
Database		mySQL 5 
*/

















drop table IF EXISTS Supplier;
drop table IF EXISTS Jurnal_Jual_Kredit;
drop table IF EXISTS Bank;
drop table IF EXISTS Pegawai;
drop table IF EXISTS Daftar_Kode_Bantu;
drop table IF EXISTS Jurnal_Beli_Kredit;
drop table IF EXISTS Jurnal_Umum;
drop table IF EXISTS Daftar_Sandi;
drop table IF EXISTS Nasabah;
drop table IF EXISTS Identitas_BMT;
drop table IF EXISTS Daftar_Akun;




Create table Daftar_Akun (
	Kode_Akun Char(4) NOT NULL,
	nama_akun Varchar(50),
	Akun_DK Char(2),
	Akun_NR_LR Char(2),
	Jumlah_Debit Int,
	Jumlah_Kredit Int,
 Primary Key (Kode_Akun)) ENGINE = InnoDB;

Create table Identitas_BMT (
	Kode_Cabang Char(3) NOT NULL,
	Nama_BMT Varchar(200),
	Alamat_BMT Varchar(200),
	status Char(20),
	Nomor_Registrasi Char(20),
	Tgl_Pembukuan Char(20),
 Primary Key (Kode_Cabang)) ENGINE = InnoDB;

Create table Nasabah (
	No_Urut_Nasabah Int NOT NULL AUTO_INCREMENT,
	Nama Varchar(150),
	Alamat Varchar(200),
	Nomor_KTP Char(16),
	Nomor_SIM Char(12),
	Jenis_Kelamin Char(1),
	Tanggal_Masuk Datetime,
	Tanggal_Keluar Datetime,
	Status Char(1),
	Pembaruan Datetime,
	Saldo_Awal Int,
	Saldo_Akhir Int,
	Username Varchar(32),
	Password Varchar(32),
	UNIQUE (No_Urut_Nasabah),
 Primary Key (No_Urut_Nasabah)) ENGINE = InnoDB;

Create table Daftar_Sandi (
	Kode_Sandi Char(20) NOT NULL,
	Nama_Sandi Char(20),
	Akun_DB Char(20),
	Akun_KR Char(20),
 Primary Key (Kode_Sandi)) ENGINE = InnoDB;

Create table Jurnal_Umum (
	Tanggal Datetime,
	Kode_Pembantu Char(20) NOT NULL,
	Validasi Char(5),
	Akun_DB Char(20),
	Akun_KR Char(20),
	Jumlah_Debit Int,
	Jumlah_Kredit Int) ENGINE = InnoDB;

Create table Jurnal_Beli_Kredit (
	Tanggal Datetime,
	Kode_Pembantu Char(20) NOT NULL,
	Faktur Char(20),
	uraian Char(20),
	akun_db Char(20),
	akun_kr Char(20),
	Jumlah_Pembelian Int,
	akun_db2 Char(20),
	akun_kr2 Char(20),
	Jumlah_Potongan Int) ENGINE = InnoDB;

Create table Daftar_Kode_Bantu (
	Kode_Pembantu Char(20) NOT NULL,
	Nomor_Urut_Supplier Char(20) NOT NULL,
	Kode_Cabang Char(3) NOT NULL,
	Kode_Akun Char(4) NOT NULL,
	No_Urut_Nasabah Int NOT NULL,
	NIK Int NOT NULL,
	UNIQUE (Kode_Pembantu),
 Primary Key (Kode_Pembantu)) ENGINE = InnoDB;

Create table Pegawai (
	NIK Int NOT NULL AUTO_INCREMENT,
	Nama Varchar(150),
	Alamat Varchar(200),
	Nomor_KTP Char(16),
	Nomor_SIM Char(12),
	Jenis_Kelamin Char(1),
	Tanggal_Masuk Datetime,
	Tanggal_Keluar Datetime,
	Status Char(1),
	Pembaruan Datetime,
	Saldo_Awal Int,
	Saldo_Akhir Int,
	Username Varchar(32),
	Password Varchar(32),
	UNIQUE (NIK),
 Primary Key (NIK)) ENGINE = InnoDB;

Create table Bank (
	Tanggal Datetime,
	Kode_Pembantu Char(20) NOT NULL,
	Validasi Char(5),
	Akun_DB Char(20),
	Akun_KR Char(20),
	Jumlah_Debit Int,
	Jumlah_Kredit Int) ENGINE = InnoDB;

Create table Jurnal_Jual_Kredit (
	Tanggal Datetime,
	Kode_Pembantu Char(20) NOT NULL,
	Faktur Char(20),
	uraian Char(20),
	akun_db Char(20),
	akun_kr Char(20),
	Jumlah_Jual Int,
	akun_db2 Char(20),
	akun_kr2 Char(20),
	Jumlah_Untung Int) ENGINE = InnoDB;

Create table Supplier (
	Nomor_Urut_Supplier Char(20) NOT NULL,
	Nama Char(20),
	Alamat Char(20),
	NPWP Char(20),
 Primary Key (Nomor_Urut_Supplier)) ENGINE = InnoDB;












Alter table Daftar_Kode_Bantu add Foreign Key (Kode_Akun) references Daftar_Akun (Kode_Akun) on delete  restrict on update  restrict;
Alter table Daftar_Kode_Bantu add Foreign Key (Kode_Cabang) references Identitas_BMT (Kode_Cabang) on delete  restrict on update  restrict;
Alter table Daftar_Kode_Bantu add Foreign Key (No_Urut_Nasabah) references Nasabah (No_Urut_Nasabah) on delete  restrict on update  restrict;
Alter table Jurnal_Umum add Foreign Key (Kode_Pembantu) references Daftar_Kode_Bantu (Kode_Pembantu) on delete  restrict on update  restrict;
Alter table Bank add Foreign Key (Kode_Pembantu) references Daftar_Kode_Bantu (Kode_Pembantu) on delete  restrict on update  restrict;
Alter table Jurnal_Beli_Kredit add Foreign Key (Kode_Pembantu) references Daftar_Kode_Bantu (Kode_Pembantu) on delete  restrict on update  restrict;
Alter table Jurnal_Jual_Kredit add Foreign Key (Kode_Pembantu) references Daftar_Kode_Bantu (Kode_Pembantu) on delete  restrict on update  restrict;
Alter table Daftar_Kode_Bantu add Foreign Key (NIK) references Pegawai (NIK) on delete  restrict on update  restrict;
Alter table Daftar_Kode_Bantu add Foreign Key (Nomor_Urut_Supplier) references Supplier (Nomor_Urut_Supplier) on delete  restrict on update  restrict;















/* Users permissions */






