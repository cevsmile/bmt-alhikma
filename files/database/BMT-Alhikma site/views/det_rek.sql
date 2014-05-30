CREATE VIEW det_rek AS
SELECT
	`kas`.`Id_Kas` AS `Id_Kas`,
	`kas`.`Kode_Norek` AS `Kode_Norek`,
	`kas`.`Id_Daftar_Sandi` AS `Id_Daftar_Sandi`,
	`kas`.`Validasi` AS `Validasi`,
	`kas`.`Jumlah_Debit` AS `Jumlah_Debit`,
	`kas`.`Jumlah_Kredit` AS `Jumlah_Kredit`,
	`kas`.`Log_Date` AS `Log_Date`,
	`kas`.`Log_Time` AS `Log_Time`,
	`kas`.`Log_User` AS `Log_User`,
	`nasabah`.`Nama` AS `NamaNasabah`,
	`supplier`.`Nama` AS `NamaSupplier`,
	`pegawai`.`Nama` AS `NamaPegawai`,
	`daftar_sandi`.`Id_Daftar_Akun_Debit` AS `Id_Daftar_Akun_Debit`,
	`daftar_sandi`.`Id_Daftar_Akun_Kredit` AS `Id_Daftar_Akun_Kredit`
FROM
	(
		(
			(
				(
					(
						`kas`
						LEFT JOIN `nomor_rekening` ON (
							(
								`nomor_rekening`.`Kode_Norek` = `kas`.`Kode_Norek`
							)
						)
					)
					LEFT JOIN `pegawai` ON (
						(
							`pegawai`.`NIK` = `nomor_rekening`.`NIK`
						)
					)
				)
				LEFT JOIN `supplier` ON (
					(
						`supplier`.`Id_Supplier` = `nomor_rekening`.`Id_Supplier`
					)
				)
			)
			LEFT JOIN `nasabah` ON (
				(
					`nasabah`.`Id_Nasabah` = `nomor_rekening`.`Id_Nasabah`
				)
			)
		)
		LEFT JOIN `daftar_sandi` ON (
			(
				`daftar_sandi`.`Id_Daftar_Sandi` = `kas`.`Id_Daftar_Sandi`
			)
		)
	)
ORDER BY
	`kas`.`Id_Kas` DESC