    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </div><!-- /.container -->

<?php
	echo form_open('site/first_installation');
	$NIK = array('name'=>'NIK', 'type' =>'text', 'value' => '');
	$Nama = array('name'=>'Nama', 'type' =>'text', 'value' => '');
	$Alamat = array('name'=>'Alamat', 'type' =>'text', 'value' => '');
	$Nomor_KTP= array('name'=>'Nomor_KTP', 'type' =>'text', 'value' => '');
	$Nomor_SIM = array('name'=>'Nomor_SIM', 'type' =>'text', 'value' => '');
	$Jenis_Kelamin = array('name'=>'Jenis_Kelamin', 'type' =>'text', 'value' => '');
	$Tanggal_Masuk = array('name'=>'Tanggal_Masuk', 'type' =>'text', 'value' => '');
	$Tanggal_Keluar = array('name'=>'Tanggal_Keluar', 'type' =>'text', 'value' => '');
	$Status = array('name'=>'Status', 'type' =>'text', 'value' => '');
	$Pembaruan = array('name'=>'Pembaruan', 'type' =>'text', 'value' => '');
	$Saldo_Awal = array('name'=>'Saldo_Awal', 'type' =>'text', 'value' => '');
	$Saldo_Akhir = array('name'=>'Saldo_Akhir', 'type' =>'text', 'value' => '');
	$Username = array('name'=>'Username', 'type' =>'text', 'value' => '');
	$Password = array('name'=>'Password', 'type' =>'text', 'value' => '');

	echo form_input($NIK);
	echo form_input($Nama);
	echo form_input($Alamat);
	echo form_input($Nomor_KTP);
	echo form_input($Nomor_SIM);
	echo form_input($Jenis_Kelamin);
	echo form_input($Tanggal_Masuk);
	echo form_input($Tanggal_Keluar);
	echo form_input($Status);
	echo form_input($Pembaruan);
	echo form_input($Saldo_Awal);
	echo form_input($Saldo_Akhir);
	echo form_input($Username);
	echo form_password($Password);

	$submit = array('type' => 'submit', 'name' => 'submit', 'value' => 'Submit');
	echo form_submit($submit);
	
	echo form_close();
?>