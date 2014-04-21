<div class="container">

	<div class="jumbotron">
		<h1>INSTALLATION</h1>
		<p class="lead">
			If you see this page, thats mean this is your first time setup. Please fill this form to continue...
		</p>
	</div>

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Instalation Form</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open('site/first_installation');
			$NIK = array('name' => 'NIK', 'type' => 'text', 'value' => 'NIK');
			$Nama = array('name' => 'Nama', 'type' => 'text', 'value' => 'Nama');
			$Alamat = array('name' => 'Alamat', 'type' => 'text', 'value' => 'Alamat');
			$Nomor_KTP = array('name' => 'Nomor_KTP', 'type' => 'text', 'value' => 'Nomor KTP');
			$Nomor_SIM = array('name' => 'Nomor_SIM', 'type' => 'text', 'value' => 'Nomor SIM');
			$Jenis_Kelamin = array('name' => 'Jenis_Kelamin', 'type' => 'text', 'value' => 'Jenis Kelamin');
			$Tanggal_Masuk = array('name' => 'Tanggal_Masuk', 'type' => 'text', 'value' => 'Tanggal Masuk');
			$Tanggal_Keluar = array('name' => 'Tanggal_Keluar', 'type' => 'text', 'value' => 'Tanggal Keluar');
			$Status = array('name' => 'Status', 'type' => 'text', 'value' => 'Status');
			$Pembaruan = array('name' => 'Pembaruan', 'type' => 'text', 'value' => 'Pembaruan');
			$Saldo_Awal = array('name' => 'Saldo_Awal', 'type' => 'text', 'value' => 'Saldo Awal');
			$Saldo_Akhir = array('name' => 'Saldo_Akhir', 'type' => 'text', 'value' => 'Saldo Akhir');
			$Username = array('name' => 'Username', 'type' => 'text', 'value' => 'Username');
			$Password = array('name' => 'Password', 'type' => 'text', 'value' => 'Password');
			$submit = array('type' => 'submit', 'name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-primary');
			?>
		</div>
		<table class="table">
			<th>Label</th><th>Input </th>
			<tr>
				<td><?php echo form_label('Nomor Induk Kepegawaian', 'NIK'); ?></td><td><?php echo form_input($NIK); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nama Pegawai', 'Nama'); ?></td><td><?php echo form_input($Nama); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Alamat Pegawai', 'Alamat'); ?></td><td><?php echo form_input($Alamat); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nomor KTP', 'Nomor_KTP'); ?></td><td><?php echo form_input($Nomor_KTP); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Nomor SIM', 'Nomor_SIM'); ?></td><td><?php echo form_input($Nomor_SIM); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Jenis Kelamin', 'Jenis_Kelamin'); ?></td><td><?php echo form_input($Jenis_Kelamin); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Tanggal Masuk', 'Tanggal_Masuk'); ?></td><td><?php echo form_input($Tanggal_Masuk); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Tanggal Keluar', 'Tanggal_Keluar'); ?></td><td><?php echo form_input($Tanggal_Keluar); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Status', 'Status'); ?></td><td><?php echo form_input($Status); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Pembaruan', 'Pembaruan'); ?></td><td><?php echo form_input($Pembaruan); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Saldo_Awal', 'Saldo_Awal'); ?></td><td><?php echo form_input($Saldo_Awal); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Saldo Akhir', 'Saldo_Akhir'); ?></td><td><?php echo form_input($Saldo_Akhir); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Username', 'Username'); ?></td><td><?php echo form_input($Username); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Password', 'Password'); ?></td><td><?php echo form_password($Password); ?></td>
			</tr>
			<tr>
				<td><?php echo form_submit($submit); ?></td><td><?php ?></td>
			</tr>
			<?php echo form_close(); ?>
		</table>
	</div><!-- /.instalation_form -->
</div><!-- /.container -->
