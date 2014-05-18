<?php 
$attributes = array('class' => "navbar-form navbar-right", 'role' => 'form');
$Username = array('name' => 'Username', 'type' => 'text', 'value' => 'admin', 'placeholder' => 'Username', 'class' => 'form-control');
$Password = array('name' => 'Password', 'type' => 'password', 'value' => 'admin', 'placeholder' => 'Password', 'class' => 'form-control');
$Subkan = array('type' => 'submit', 'name' => 'submit', 'value' => 'Sign in', 'class' => 'btn btn-success');
?>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">BMT AL-HIKMA TERARA</a>
		</div>
		<div class="navbar-collapse collapse">
			<?php echo form_open('site/validate', $attributes); ?>
			<div class="form-group">
				<?php echo form_input($Username); ?>
			</div>
			<div class="form-group">
				<?php echo form_password($Password); ?>
			</div>
			<?php echo form_submit($Subkan);
				echo form_close();
			?>
		</div><!--/.navbar-collapse -->
	</div>
</div>
