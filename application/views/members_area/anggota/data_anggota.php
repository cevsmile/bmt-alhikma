<div id="cecep">
	<?php $attributes = array('class' => 'form-horizontal');
		echo form_open('system_site/data_anggota', $attributes);
		$no_rek 		= array('type' => 'text', 'name' => 'no_rek');
		$tanggal 		= array('type' => 'text', 'name' => 'tanggal', 'id' => 'datepicker3');
		$nama 			= array('type' => 'text', 'name' => 'nama', );
		$alamat 		= array('type' => 'textarea', 'name' => 'alamat', 'rows' => '2', 'cols' => '44');
		$alamat_surat 	= array('type' => 'textarea', 'name' => 'alamat_surat', 'rows' => '2', 'cols' => '44');
		$tmp_lahir 		= array('type' => 'text', 'name' => 'tmp_lahir');
		$tgl_lahir 		= array('type' => 'text', 'name' => 'tgl_lahir', 'id' => 'datepicker2');
		$telpon 		= array('type' => 'text', 'name' => 'telpon');
		$jenis_id 		= array('type' => 'text', 'name' => 'jenis_id');
		$no_id 			= array('type' => 'text', 'name' => 'no_id');
		$agama 			= array('type' => 'text', 'name' => 'agama');
		$pekerjaan 		= array('type' => 'text', 'name' => 'pekerjaan');
		$status 		= array('type' => 'text', 'name' => 'status');
		$nama_psangan 	= array('type' => 'text', 'name' => 'nama_psangan');
		$js 			= 'onfocus="this.select()"';
		$gender 		= array('l'  => 'Laki-Laki', 'p'=> 'Perempuan');
	?>
<table class="table">
	<tbody>
		<tr>
			<td><?php echo form_label('Nomor Rekening : '); ?> <?php echo form_input($no_rek, set_value('no_rek', 'Nomor Rekening'), $js); ?> <?php echo form_error('no_rek', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Tanggal : '); ?> <?php echo form_input($tanggal, set_value('tanggal', 'Tanggal'), $js); ?> <?php echo form_error('tanggal', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nama : '); ?> <?php echo form_input($nama, set_value('nama', 'Nama'), $js); ?> <?php echo form_error('nama', '<div class="error">', '</div>'); ?></td> 
		</tr>
		<tr>
			<td><?php echo form_label('Jenis Kelamin : '); ?><?php echo form_dropdown('gender', $gender, 'l'); ?></td>
			<td><?php echo form_label('Alamat : '); ?><?php echo form_textarea($alamat, set_value('alamat', 'Alamat'), $js); ?> <?php echo form_error('alamat', '<div class="error">', '</div>'); ?></td></td>
			<td><?php echo form_label('Alamat Surat : '); ?><?php echo form_textarea($alamat_surat, set_value('alamat_surat', 'Alamat Surat'), $js); ?> <?php echo form_error('alamat_surat', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Tempat Lahir : '); ?><?php echo form_input($tmp_lahir, set_value('tmp_lahir', 'Tempat Lahir'), $js); ?> <?php echo form_error('tmp_lahir', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Tanggal Lahir : '); ?><?php echo form_input($tgl_lahir, set_value('tgl_lahir', 'Tanggal Lahir'), $js); ?> <?php echo form_error('tgl_lahir', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Jenis Kartu Pengenal : '); ?><?php echo form_input($jenis_id, set_value('jenis_id', 'Jenis Kartu Pengenal'), $js); ?> <?php echo form_error('jenis_id', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Nomor Kartu Pengenal : '); ?><?php echo form_input($no_id, set_value('no_id', 'Nomor Kartu Pengenal'), $js); ?> <?php echo form_error('no_id', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Agama : '); ?><?php echo form_input($agama, set_value('agama', 'Agama'), $js); ?> <?php echo form_error('agama', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Pekerjaan : '); ?><?php echo form_input($pekerjaan, set_value('pekerjaan', 'Pekerjaan'), $js); ?> <?php echo form_error('pekerjaan', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Status : '); ?><?php echo form_input($status, set_value('status', 'Status'), $js); ?> <?php echo form_error('status', '<div class="error">', '</div>'); ?></td></td>
			<td><?php echo form_label('Nama Pasangan : '); ?><?php echo form_input($nama_psangan, set_value('nama_psangan', 'Nama Pasangan'), $js); ?> <?php echo form_error('nama_psangan', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nomor Telpon : '); ?><?php echo form_input($telpon, set_value('telpon', 'Nomor Telpon'), $js); ?> <?php echo form_error('telpon', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td>
				<?php 
				$btn_simpan = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only', 'value' => 'true', 'type' => 'submit', 'content' => '<i class="icon icon-white icon-save"></i> Simpan');
				echo form_button($btn_simpan);
				$btn_reset = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only', 'value' => 'true', 'type' => 'reset', 'content' => '<i class="icon icon-white icon-repeat"></i> Reset');
				echo form_button($btn_reset);
				?>
			</td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>

	<?php echo form_close(); ?>
</div>
