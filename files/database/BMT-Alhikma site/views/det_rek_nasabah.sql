CREATE VIEW det_rek_nasabah AS
SELECT
	`kas`.`Id_Kas` AS `Id_Kas`,
	`nomor_rekening`.`Kode_Norek` AS `Kode_Norek`,
	`kas`.`Validasi` AS `Validasi`,
	`kas`.`Id_Daftar_Sandi` AS `Id_Daftar_Sandi`,
	`pegawai`.`Nama` AS `NamaPegawai`,
	`nasabah`.`Nama` AS `NamaNasabah`,
	`supplier`.`Nama` AS `NamaSupplier`,
	`daftar_sandi`.`Id_Daftar_Akun_Kredit` AS `Id_Daftar_Akun_Kredit`,
	`daftar_sandi`.`Id_Daftar_Akun_Debit` AS `Id_Daftar_Akun_Debit`,
	`kas`.`Jumlah_Debit` AS `Jumlah_Debit`,
	`kas`.`Jumlah_Kredit` AS `Jumlah_Kredit`,
	`kas`.`Log_Date` AS `Log_Date`,
	`kas`.`Log_Time` AS `Log_Time`,
	`kas`.`Log_User` AS `Log_User`
FROM
	(
		(
			(
				(
					(
						`nomor_rekening`
						LEFT JOIN `pegawai` ON (
							(
								`pegawai`.`NIK` = `nomor_rekening`.`NIK`
							)
						)
					)
					LEFT JOIN `nasabah` ON (
						(
							`nasabah`.`Id_Nasabah` = `nomor_rekening`.`Id_Nasabah`
						)
					)
				)
				LEFT JOIN `supplier` ON (
					(
						`supplier`.`Id_Supplier` = `nomor_rekening`.`Id_Supplier`
					)
				)
			)
			JOIN `kas` ON (
				(
					`nomor_rekening`.`Kode_Norek` = `kas`.`Kode_Norek`
				)
			)
		)
		JOIN `daftar_sandi` ON (
			(
				`kas`.`Id_Daftar_Sandi` = `daftar_sandi`.`Id_Daftar_Sandi`
			)
		)
	)
ORDER BY
	`kas`.`Id_Kas`