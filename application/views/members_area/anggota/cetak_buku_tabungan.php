<div id="cecep">
	
	<?php 
	echo form_error('no_rek', '<div class="error">', '</div>'); 
	$attributes = array('id' => 'form');
	echo form_open('system_site/form_cetak_buku_tabungan2', $attributes);
	$js = 'onfocus="this.select()"';
	$no_rek = array('type' => 'text', 'name' => 'no_rek');
	$btn_simpan = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary', 'value' => 'true', 'type' => 'submit', 'content' => '<i class="icon icon-white icon-zoom-in"></i> Cari');
	$btn_reset = array('name' => 'button', 'id' => 'button', 'class' => 'ui-button-primary', 'value' => 'true', 'type' => 'reset', 'content' => '<i class="icon icon-white icon-repeat"></i> Reset');
	echo form_input($no_rek, set_value('no_rek', 'Nomor Rekening'), $js);
	?>

	<span class="error" for="no_rek"></span>
	<div>
		<?php echo form_button($btn_simpan);
		echo form_button($btn_reset);
		echo form_close();
		?>
	</div>
		
	<div>
		<b>Ditemukan Sebanyak <?php echo $num_results; ?> Anggota.</b>
	</div>
	
		<table class="table table-striped table-bordered bootstrap-datatable datatable">
			<thead>
				<?php foreach($fields as $field_name => $field_display): ?>
				<th <?php if ($sort_by == $field_name) echo "class=\"sort_$sort_order\"" ?>>
					<?php echo anchor("system_site/form_cetak_buku_tabungan/$field_name/" . (($sort_order == 'asc' && $sort_by == $field_name) ? 'desc' : 'asc'), $field_display); ?></th>
				<?php endforeach; ?>
			</thead>
		
			<tbody>
				<?php foreach($anggotabmt as $anggota): ?>
				<tr>
					<?php foreach($fields as $field_name => $field_display): ?>
					<?php $nomor = $anggota -> $field_name; ?>
					<td>
						<?php echo anchor("system_site/detil_anggota/$field_name/$nomor/", $anggota -> $field_name); ?>
						<?php echo anchor("system_site/edit_anggota/$field_name/$nomor/", 'Edit'); ?>
						<?php echo anchor("system_site/form_hapus_anggota/$field_name/$nomor/", 'Hapus'); ?>
					</td>
					<?php endforeach; ?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		
		</table>

	<?php if (strlen($pagination)):	?>
	<div id="pagination">
		Halaman: <?php echo $pagination; ?>
	</div>
	<?php endif; ?>
</div>