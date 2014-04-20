
<?php

foreach($detilanggota as $anggota):
	if ($anggota -> gender == "l"){
		$jenis_kelamin = "Laki-laki";
	}else{
		$jenis_kelamin = "Perempuan";
	}
?>

<?php $helo = $anggota -> no_rek; ?>
<div id="cecep">
<a class="btn btn-info" href="<?php echo base_url();?>index.php/system_site/edit_anggota/no_rek/<?php echo $helo;?>/"><i class="icon icon-white icon-cog"></i> Edit </a>	
<a class="btn btn-danger" href="<?php echo base_url();?>index.php/system_site/form_hapus_anggota/no_rek/<?php echo $helo;?>/"><i class="icon icon-white icon-remove-sign"></i> Hapus </a>	
<table class="table" >
	<tbody>
		<tr>
			<td>Nomor Rekening :</td><td><?php echo $anggota -> no_rek; ?></td>
			<td>Nama</td><td><?php echo $anggota -> nama; ?></td>
			<td>Tanggal : </td><td><?php echo $anggota -> tanggal; ?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin :</td><td><?php echo $jenis_kelamin; ?></td>
			<td>Alamat :</td><td><?php echo $anggota -> alamat; ?></td>
			<td>Alamat Surat : </td><td><?php echo $anggota -> alamat_surat; ?></td>
		</tr>
		<tr>
			<td>Tempat Lahir : </td><td><?php echo $anggota -> tmp_lahir; ?></td>
			<td>Tanggal Lahir :</td><td><?php echo $anggota -> tgl_lahir; ?></td>
			<td>Jenis Kartu Identitas : </td><td><?php echo $anggota -> jenis_id; ?></td>
		</tr>
		<tr>
			<td>Nomor Kertu Identitas : </td><td><?php echo $anggota -> no_id; ?></td>
			<td>Agama : </td><td><?php echo $anggota -> agama; ?></td>
			<td>Pekerjaan : </td><td><?php echo $anggota -> pekerjaan; ?></td>
		</tr>
		<tr>
			<td>Status : </td><td><?php echo $anggota -> status; ?></td>
			<td>Nama Pasangan : </td><td><?php echo $anggota -> nama_psangan; ?></td>
			<td>Nomor Telpon : </td><td><?php echo $anggota -> telpon; ?></td>
		</tr>
	</tbody>
</table>
</div>
<?php	endforeach; ?>