CREATE VIEW det_no_rek AS
SELECT
	`nomor_rekening`.`Kode_Norek` AS `Kode_Norek`,
	`pegawai`.`Nama` AS `NamaPegawai`,
	`supplier`.`Nama` AS `NamaSupplier`,
	`nasabah`.`Nama` AS `NamaNasabah`,
	`nomor_rekening`.`Saldo_Awal` AS `Saldo_Awal`,
	`nomor_rekening`.`Saldo_Akhir` AS `Saldo_Akhir`,
	`nomor_rekening`.`Log_Date` AS `Log_Date`,
	`nomor_rekening`.`Log_Time` AS `Log_Time`,
	`nomor_rekening`.`Log_User` AS `Log_User`
FROM
	(
		(
			(
				`nomor_rekening`
				LEFT JOIN `pegawai` ON (
					(
						(
							`pegawai`.`NIK` = `nomor_rekening`.`NIK`
						)
						AND (
							`nomor_rekening`.`NIK` = `pegawai`.`NIK`
						)
					)
				)
			)
			LEFT JOIN `nasabah` ON (
				(
					(
						`nasabah`.`Id_Nasabah` = `nomor_rekening`.`Id_Nasabah`
					)
					AND (
						`nomor_rekening`.`Id_Nasabah` = `nasabah`.`Id_Nasabah`
					)
				)
			)
		)
		LEFT JOIN `supplier` ON (
			(
				(
					`supplier`.`Id_Supplier` = `nomor_rekening`.`Id_Supplier`
				)
				AND (
					`nomor_rekening`.`Id_Supplier` = `supplier`.`Id_Supplier`
				)
			)
		)
	)