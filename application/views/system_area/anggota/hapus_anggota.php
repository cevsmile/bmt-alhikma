

<?php

foreach($detilanggota as $anggota):
	if ($anggota -> gender == "l"){
		$jenis_kelamin = "Laki-laki";
	}else{
		$jenis_kelamin = "Perempuan";
	}
?>


<div id="cecep">
<h1 id="warningbmt">Apakah Anda Yakin Ingin Menghapus Data Ini? </h1>

	<?php echo form_open('system_site/hapus_anggota'); ?>
	<?php echo form_hidden('no_rek', $anggota -> no_rek); ?>
	<div>
		<?php
		$btn_simpan = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only', 'value' => 'true', 'type' => 'submit', 'content' => '<i class="icon icon-white icon-ok"></i> Hapus');
		echo form_button($btn_simpan);
		?>
		<a class="btn btn-danger" href="<?php echo base_url();?>index.php/system_site/detil_anggota/no_rek/<?php echo $anggota -> no_rek;?>/"><i class="icon icon-white icon-remove-sign"></i> Batal </a>	
	</div>

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
	<?php echo form_close();?>
<?php	endforeach; ?>


