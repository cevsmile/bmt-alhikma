CREATE VIEW sum_kas AS
SELECT
Sum(det_rek.Jumlah_Debit) AS TotalDebet,
Sum(det_rek.Jumlah_Kredit) AS TotalKredit,
Sum(det_rek.Jumlah_Debit) - Sum(det_rek.Jumlah_Kredit) AS GrandTotal
FROM
	`det_rek`