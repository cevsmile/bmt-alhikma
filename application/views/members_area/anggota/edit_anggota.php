<?php

foreach($detilanggota as $anggota):
	
	$norek2 		= $anggota -> no_rek; 
	$tanggal2 		= $anggota -> tanggal; 
	$nama2 			= $anggota -> nama; 
	$alamat2 		= $anggota -> alamat; 
	$alamat_surat2 	= $anggota -> alamat_surat; 
	$tmp_lahir2 	= $anggota -> tmp_lahir; 
	$tgl_lahir2 	= $anggota -> tgl_lahir; 
	$telpon2 		= $anggota -> telpon; 
	$jenis_id2 		= $anggota -> jenis_id; 
	$no_id2 		= $anggota -> no_id; 
	$agama2 		= $anggota -> agama; 
	$pekerjaan2 	= $anggota -> pekerjaan; 
	$status2 		= $anggota -> status; 
	$nama_psangan2 	= $anggota -> nama_psangan; 
	$gender2 		= $anggota -> gender; 
?>

<div id="cecep">
	<?php echo validation_errors('<div class="ui-state-error ui-corner-all"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span><strong>Peringatan:</strong> ', '</p></div>'); ?>
	<?php $attributes = array('id' => 'form');
		echo form_open('system_site/update_data_anggota', $attributes);
		$tanggal 		= array('type' => 'text', 'name' => 'tanggal', 'id' => 'datepicker3', 'value' => $tanggal2);
		$nama 			= array('type' => 'text', 'name' => 'nama', 'value' => $nama2);
		$alamat 		= array('type' => 'textarea', 'name' => 'alamat', 'rows' => '2', 'cols' => '44', 'value' => $alamat2);
		$alamat_surat 	= array('type' => 'textarea', 'name' => 'alamat_surat', 'rows' => '2', 'cols' => '44', 'value' => $alamat_surat2);
		$tmp_lahir 		= array('type' => 'text', 'name' => 'tmp_lahir', 'value' => $tmp_lahir2);
		$tgl_lahir 		= array('type' => 'text', 'name' => 'tgl_lahir', 'id' => 'datepicker2', 'value' => $tgl_lahir2);
		$telpon 		= array('type' => 'text', 'name' => 'telpon', 'value' => $telpon2);
		$jenis_id 		= array('type' => 'text', 'name' => 'jenis_id', 'value' => $jenis_id2);
		$no_id 			= array('type' => 'text', 'name' => 'no_id', 'value' => $no_id2);
		$agama 			= array('type' => 'text', 'name' => 'agama', 'value' => $agama2);
		$pekerjaan 		= array('type' => 'text', 'name' => 'pekerjaan', 'value' => $pekerjaan2);
		$status 		= array('type' => 'text', 'name' => 'status', 'value' => $status2);
		$nama_psangan 	= array('type' => 'text', 'name' => 'nama_psangan', 'value' => $nama_psangan2);
		$js = 'onfocus="this.select()"';
		
		$gender = array(
                  'l'  => 'Laki-Laki',
                  'p'    => 'Perempuan',
                );

		$terpilih = array($gender2);
	?>
		<?php echo form_hidden('no_rek', $norek2); ?>

<table class="table">
	<tbody>
		<tr>
			<td><?php echo form_label('Nomor Rekening : <br />' . $norek2); ?></td>
			<td><?php echo form_label('Tanggal : '); ?> <?php echo form_input($tanggal, set_value('tanggal'), $js); ?> <?php echo form_error('tanggal', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nama : '); ?> <?php echo form_input($nama, set_value('nama'), $js); ?> <?php echo form_error('nama', '<div class="error">', '</div>'); ?></td> 
		</tr>
		<tr>
			<td><?php echo form_label('Jenis Kelamin : '); ?><?php echo form_dropdown('gender', $gender, $terpilih); ?></td>
			<td><?php echo form_label('Alamat : '); ?><?php echo form_textarea($alamat, set_value('alamat'), $js); ?> <?php echo form_error('alamat', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Alamat Surat : '); ?><?php echo form_textarea($alamat_surat, set_value('alamat_surat'), $js); ?> <?php echo form_error('alamat_surat', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Tempat Lahir : '); ?><?php echo form_input($tmp_lahir, set_value('tmp_lahir'), $js); ?> <?php echo form_error('tmp_lahir', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Tanggal Lahir : '); ?><?php echo form_input($tgl_lahir, set_value('tgl_lahir'), $js); ?> <?php echo form_error('tgl_lahir', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Jenis Kartu Pengenal : '); ?><?php echo form_input($jenis_id, set_value('jenis_id'), $js); ?> <?php echo form_error('jenis_id', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Nomor Kartu Pengenal : '); ?><?php echo form_input($no_id, set_value('no_id'), $js); ?> <?php echo form_error('no_id', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Agama : '); ?><?php echo form_input($agama, set_value('agama'), $js); ?> <?php echo form_error('agama', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Pekerjaan : '); ?><?php echo form_input($pekerjaan, set_value('pekerjaan'), $js); ?> <?php echo form_error('pekerjaan', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Status : '); ?><?php echo form_input($status, set_value('status'), $js); ?> <?php echo form_error('status', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nama Pasangan : '); ?><?php echo form_input($nama_psangan, set_value('nama_psangan'), $js); ?> <?php echo form_error('nama_psangan', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nomor Telpon : '); ?><?php echo form_input($telpon, set_value('telpon'), $js); ?> <?php echo form_error('telpon', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td>
				<?php 
				$btn_simpan = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only', 'value' => 'true', 'type' => 'submit', 'content' => '<i class="icon icon-white icon-save"></i> Simpan');
				echo form_button($btn_simpan);
				$btn_reset = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only', 'value' => 'true', 'type' => 'reset', 'content' => '<i class="icon icon-white icon-repeat"></i> Reset');
				echo form_button($btn_reset);
				?>
				<a class="btn btn-danger" href="<?php echo base_url();?>index.php/system_site/detil_anggota/no_rek/<?php echo $anggota -> no_rek;?>/"><i class="icon icon-white icon-remove-sign"></i> Batal </a>	
			</td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

	<?php echo form_close(); ?>
</div>
<?php	endforeach; ?>