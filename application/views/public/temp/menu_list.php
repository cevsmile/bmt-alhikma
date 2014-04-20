<?php echo form_open('site/validasi');
$nama_anda = array('name' => 'nama', 'type' => 'text', 'value' => 'admin');
echo form_input($nama_anda);
$pass_anda = array('name' => 'password', 'type' => 'password', 'value' => 'admin');
echo form_password($pass_anda);
$subkan = array('type' => 'submit', 'name' => 'submit', 'value' => 'Masuk', 'class' => 'ui-button-primary ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only');
echo form_submit($subkan);
echo form_close();
?>
