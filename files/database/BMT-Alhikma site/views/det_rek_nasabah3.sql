CREATE VIEW det_rek_nasabah3 AS
select 	`nomor_rekening`.`Kode_Norek` AS `Kode_Norek`,
		CONCAT(`pegawai`.`Nama`,`nasabah`.`Nama`,',',`supplier`.`Nama`) AS `Namakami`,
		`nomor_rekening`.`Saldo_Awal` AS `Saldo_Awal`,
		`nomor_rekening`.`Saldo_Akhir` AS `Saldo_Akhir`,
		`nomor_rekening`.`Log_Date` AS `Log_Date`,
		`nomor_rekening`.`Log_Time` AS `Log_Time`,
		`nomor_rekening`.`Log_User` AS `Log_User` 
from (((`nomor_rekening` 
	left join `pegawai` on((`pegawai`.`NIK` = `nomor_rekening`.`NIK`))) 
left join `nasabah` on((`nasabah`.`Id_Nasabah` = `nomor_rekening`.`Id_Nasabah`))) 
left join `supplier` on((`supplier`.`Id_Supplier` = `nomor_rekening`.`Id_Supplier`)))