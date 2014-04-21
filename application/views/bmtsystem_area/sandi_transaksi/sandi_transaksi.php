
<div id="cecep">
	<?php $attributes = array('id' => 'form-horizontal');
		echo form_open('system_site/sandi_transaksi', $attributes);
		$kode_sandi = array('type' => 'text', 'name' => 'kode_sandi');
		$nama_sandi = array('type' => 'text', 'name' => 'nama_sandi');
		$kegiatan = array('type' => 'text', 'name' => 'kegiatan');
		$nomor_akun = array('type' => 'text', 'name' => 'nomor_akun');
		$keterangan = array('type' => 'textarea', 'name' => 'keterangan', 'type' => 'textarea', 'name' => 'alamat', 'rows' => '2', 'cols' => '44' );
		$js = 'onfocus="this.select()"';
	?>
<table class="table">
	<tbody>
		<tr>
			<td><?php echo form_label('Kode Sandi : '); ?> <?php echo form_input($kode_sandi, set_value('kode_sandi'), $js); ?> <?php echo form_error('kode_sandi', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nama Sandi : '); ?> <?php echo form_input($nama_sandi, set_value('nama_sandi'), $js); ?> <?php echo form_error('nama_sandi', '<div class="error">', '</div>'); ?></td>
		</tr>
		<tr>
			<td><?php echo form_label('Kegiatan : '); ?><?php echo form_input($kegiatan, set_value('kegiatan'), $js); ?> <?php echo form_error('kegiatan', '<div class="error">', '</div>'); ?></td>
			<td><?php echo form_label('Nomor Akun : '); ?><?php echo form_input($nomor_akun, set_value('nomor_akun'), $js); ?> <?php echo form_error('nomor_akun', '<div class="error">', '</div>'); ?></td>
		</tr>			
		<tr>
			<td><?php echo form_label('Keterangan : '); ?><?php echo form_textarea($keterangan, set_value('keterangan'), $js); ?> <?php echo form_error('keterangan', '<div class="error">', '</div>'); ?></td>
			<td></td>
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
		</tr>
	</tbody>
</table>

	<?php echo form_close(); ?>
</div>
