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
			$username = array('name' => 'username', 'type' => 'text', 'value' => 'username');
			$password = array('name' => 'password', 'type' => 'text', 'value' => 'password');
			$level = array('name' => 'Jenis_Kelamin', 'type' => 'text', 'value' => 'level');
			$submit = array('type' => 'submit', 'name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-primary');
			?>
		</div>
		<table class="table">
			<tr>
				<td><?php echo form_label('Username', 'username'); ?></td><td><?php echo form_input($username); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Password', 'password'); ?></td><td><?php echo form_password($password); ?></td>
			</tr>
			<tr>
				<td><?php echo form_label('Level', 'level'); ?></td><td><?php echo form_input($level); ?></td>
			</tr>
			<tr>
				<td><?php echo form_submit($submit); ?></td><td><?php ?></td>
			</tr>
			<?php echo form_close(); ?>
		</table>
	</div><!-- /.instalation_form -->
</div><!-- /.container -->
