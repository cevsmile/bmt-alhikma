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
			$Username = array('name' => 'Username', 'type' => 'text', 'value' => 'admin', 'maxlength' => '20', 'size' => '20');
			$Password = array('name' => 'Password', 'type' => 'password', 'value' => 'admin', 'maxlength' => '32', 'size' => '32');
			$Level = array('name' => 'Level', 'type' => 'int', 'value' => '1');
			$submit = array('type' => 'submit', 'name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-primary');
			?>
		</div>
		<table class="table">
			<tr>
				<td><?php echo form_label('Username', 'Username'); ?></td><td><?php echo form_input($Username); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Password', 'Password'); ?></td><td><?php echo form_password($Password); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Level', 'Level'); ?></td><td><?php echo form_input($Level); ?></td>
			</tr>
			<tr>
				<td><?php echo form_submit($submit); ?></td><td><?php ?></td>
			</tr>
			<?php echo form_close(); ?>
		</table>
	</div><!-- /.instalation_form -->
</div><!-- /.container -->
