/*
Created		15/04/2014
Modified		09/05/2014
Project		Akutansi BMT
Model		Utama
Company		BMT AL-Hikma
Author		Lalu Sefty Junaedi
Version		2.0
Database		mySQL 5 
*/

















drop table IF EXISTS Nomor_Rekening;
drop table IF EXISTS Daftar_Akun;
drop table IF EXISTS User;
drop table IF EXISTS Supplier;
drop table IF EXISTS Jurnal_Jual;
drop table IF EXISTS Bank;
drop table IF EXISTS Pegawai;
drop table IF EXISTS Jurnal_Beli_Kredit;
drop table IF EXISTS KAS;
drop table IF EXISTS Daftar_Sandi;
drop table IF EXISTS Nasabah;
drop table IF EXISTS Identitas_BMT;




Create table Identitas_BMT (
	Kode_Cabang Char(3) NOT NULL,
	Nama_BMT Varchar(200),
	Alamat_BMT Varchar(200),
	Status Char(20),
	Nomor_Registrasi Char(20),
	Tgl_Pembukuan Date,
 Primary Key (Kode_Cabang)) ENGINE = InnoDB;

Create table Nasabah (
	Id_Nasabah Int NOT NULL AUTO_INCREMENT,
	Nama Varchar(150),
	Alamat Varchar(200),
	Nomor_KTP Char(16),
	Nomor_SIM Char(12),
	Jenis_Kelamin Char(6),
	Tanggal_Masuk Date,
	Tanggal_Keluar Date,
	Status Char(1),
	Saldo_Awal Int,
	Saldo_Akhir Int,
 Primary Key (Id_Nasabah)) ENGINE = InnoDB;

Create table Daftar_Sandi (
	id_daftar_sandi Char(20) NOT NULL,
	Nama_Sandi Char(20),
	Kode_Akun_Debit Char(4),
	Kode_Akun_Kredit Char(4),
 Primary Key (id_daftar_sandi)) ENGINE = InnoDB;

Create table KAS (
	id_daftar_sandi Char(20) NOT NULL,
	Kode_Norek Char(20) NOT NULL,
	Validasi Varchar(200),
	Jumlah Int,
	Log_Date Date,
	Log_Time Time,
	log_user Char(20)) ENGINE = InnoDB;

Create table Jurnal_Beli_Kredit (
	id_daftar_sandi Char(20) NOT NULL,
	Kode_Norek Char(20) NOT NULL,
	Tanggal Datetime,
	Faktur Char(20),
	Jumlah_Pembelian Int,
	Jumlah_Potongan Int,
	Log_Date Date NOT NULL,
	Log_Time Time NOT NULL,
	Log_User Char(20) NOT NULL) ENGINE = InnoDB;

Create table Pegawai (
	NIK Int NOT NULL,
	Nama Varchar(150),
	Alamat Varchar(200),
	Nomor_KTP Char(16),
	Nomor_SIM Char(12),
	Jenis_Kelamin Char(1),
	Tanggal_Masuk Date,
	Tanggal_Keluar Date,
	Status Char(1),
	Pembaruan Datetime,
	Saldo_Awal Int,
	Saldo_Akhir Int,
	UNIQUE (NIK),
 Primary Key (NIK)) ENGINE = InnoDB;

Create table Bank (
	id_daftar_sandi Char(20) NOT NULL,
	Kode_Norek Char(20) NOT NULL,
	Validasi Char(5),
	Jumlah Int,
	Log_Date Date NOT NULL,
	Log_Time Time NOT NULL,
	Log_User Char(20) NOT NULL) ENGINE = InnoDB;

Create table Jurnal_Jual (
	Kode_Norek Char(20) NOT NULL,
	id_daftar_sandi Char(20) NOT NULL,
	Tanggal Date,
	Faktur Char(20),
	Jumlah_Jual Int,
	Jumlah_Untung Int,
	log_date Date,
	log_time Time,
	log_user Char(20)) ENGINE = InnoDB;

Create table Supplier (
	Id_Supplier Char(20) NOT NULL,
	Nama Char(20),
	Alamat Char(20),
	NPWP Char(20),
 Primary Key (Id_Supplier)) ENGINE = InnoDB;

Create table User (
	id_user Char(20) NOT NULL,
	username Char(20),
	password Char(20),
	log_date Date,
	log_time Time,
	level Char(1),
 Primary Key (id_user)) ENGINE = InnoDB;

Create table Daftar_Akun (
	Id_Daftar_Akun Char(4) NOT NULL,
	Nama_Akun Varchar(50),
	Akun_DK Char(2),
	Akun_NR_LR Char(2),
	Jumlah_Debit Int,
	Jumlah_Kredit Int,
	UNIQUE (Id_Daftar_Akun),
 Primary Key (Id_Daftar_Akun)) ENGINE = InnoDB;

Create table Nomor_Rekening (
	Kode_Norek Char(20) NOT NULL,
	Kode_Cabang Char(3) NOT NULL,
	Id_Nasabah Int,
	Id_Daftar_Akun Char(4) NOT NULL,
	Id_Supplier Char(20),
	NIK Int,
	log_date Date,
	log_time Time,
	log_user Char(20),
 Primary Key (Kode_Norek)) ENGINE = InnoDB;












Alter table Nomor_Rekening add Foreign Key (Kode_Cabang) references Identitas_BMT (Kode_Cabang) on delete  restrict on update  restrict;
Alter table Nomor_Rekening add Foreign Key (Id_Nasabah) references Nasabah (Id_Nasabah) on delete  restrict on update  restrict;
Alter table KAS add Foreign Key (id_daftar_sandi) references Daftar_Sandi (id_daftar_sandi) on delete  restrict on update  restrict;
Alter table Bank add Foreign Key (id_daftar_sandi) references Daftar_Sandi (id_daftar_sandi) on delete  restrict on update  restrict;
Alter table Jurnal_Beli_Kredit add Foreign Key (id_daftar_sandi) references Daftar_Sandi (id_daftar_sandi) on delete  restrict on update  restrict;
Alter table Jurnal_Jual add Foreign Key (id_daftar_sandi) references Daftar_Sandi (id_daftar_sandi) on delete  restrict on update  restrict;
Alter table Nomor_Rekening add Foreign Key (NIK) references Pegawai (NIK) on delete  restrict on update  restrict;
Alter table Nomor_Rekening add Foreign Key (Id_Supplier) references Supplier (Id_Supplier) on delete  restrict on update  restrict;
Alter table Nomor_Rekening add Foreign Key (Id_Daftar_Akun) references Daftar_Akun (Id_Daftar_Akun) on delete  restrict on update  restrict;
Alter table Daftar_Sandi add Foreign Key (Kode_Akun_Debit) references Daftar_Akun (Id_Daftar_Akun) on delete  restrict on update  restrict;
Alter table Daftar_Sandi add Foreign Key (Kode_Akun_Kredit) references Daftar_Akun (Id_Daftar_Akun) on delete  restrict on update  restrict;
Alter table KAS add Foreign Key (Kode_Norek) references Nomor_Rekening (Kode_Norek) on delete  restrict on update  restrict;
Alter table Jurnal_Jual add Foreign Key (Kode_Norek) references Nomor_Rekening (Kode_Norek) on delete  restrict on update  restrict;
Alter table Bank add Foreign Key (Kode_Norek) references Nomor_Rekening (Kode_Norek) on delete  restrict on update  restrict;
Alter table Jurnal_Beli_Kredit add Foreign Key (Kode_Norek) references Nomor_Rekening (Kode_Norek) on delete  restrict on update  restrict;















/* Users permissions */






