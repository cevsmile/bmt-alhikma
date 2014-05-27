<div id="toolbar" style="padding: 4px; border: 1px solid silver; border-radius: 3px"></div>

<div id="main" style="width: 100%; height: 500px;"></div>
<?php $this->load->view('system_area/vf_system_application/vf_identitas_bmt/vff_identitas_bmt'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_daftar_akun/vff_daftar_akun'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_pegawai/vff_pegawai'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_nasabah/vff_nasabah'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_supplier/vff_supplier'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_user/vff_user'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_daftar_sandi/vff_daftar_sandi'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_nomor_rekening/vff_nomor_rekening'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_kas/vff_kas'); ?>
<script type="text/javascript">
// widget configuration
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			//{ type: 'top', size: '10%', resizable: true, minSize: 10 },
			{ type: 'left', size: '15%', resizable: true, minSize: 10 },
			{ type: 'right', size: '25%', resizable: true, minSize: 10, hidden : true },
			//{ type: 'bottom', size: '10%', resizable: true, minSize: 10 },
			{ type: 'main', minSize: 300 }
		]
	},
	sidebar:{
		name: 'sidebar',
		nodes: [ 
			{ id: 'level-1', text: 'DATA MASTER', img: 'icon-folder',
			  nodes: [ { id: 'level-1-1', text: 'Identitas BMT', img: 'icon-page'},
					   { id: 'level-1-2', text: 'Daftar Akun', img: 'icon-page' },
					   { id: 'level-1-3', text: 'Pegawai', img: 'icon-page' },
					   { id: 'level-1-4', text: 'Nasabah', img: 'icon-page' },
					   { id: 'level-1-5', text: 'Supplier', img: 'icon-page' },
					   { id: 'level-1-6', text: 'User', img: 'icon-page' }
					 ]
			},
			{ id: 'level-2', text: 'SECONDARY MASTER', img: 'icon-folder',
			  nodes: [ { id: 'level-2-1', text: 'Daftar Sandi', img: 'icon-page' },
					   { id: 'level-2-2', text: 'Nomor Rekening', img: 'icon-page'  },
					   { id: 'level-2-3', text: 'Barcode', icon: 'fa fa-barcode'  }
					 ]
			},
			{ id: 'level-3', text: 'PROCESS', img: 'icon-folder',
			  nodes: [ { id: 'level-3-1', text: 'KAS', img: 'icon-page' },
					   { id: 'level-3-2', text: 'Bank', img: 'icon-page' },
					   { id: 'level-3-3', text: 'Bank Lain', img: 'icon-page' },
					   { id: 'level-3-4', text: 'J. Beli Kredit', img: 'icon-page' },
					   { id: 'level-3-5', text: 'J. Jual Kredit', img: 'icon-page' }
					 ]
			}
		]
	}

}

$(function () {

	$('#toolbar').w2toolbar({
		name: 'toolbar',
		items: [
			{ type: 'check',  id: 'item1', caption: 'Check', icon: 'fa fa-check', checked: true },
			{ type: 'break',  id: 'break0' },
			{ type: 'menu',   id: 'item2', caption: 'Menu', icon: 'fa fa-table', items: [
				{ text: 'Item 1', icon: 'fa fa-camera' }, 
				{ text: 'Item 2', icon: 'fa fa-picture' }, 
				{ text: 'Item 3', icon: 'fa fa-glass' }
			]},
			{ type: 'break', id: 'break1' },
			{ type: 'radio',  id: 'item3',  group: '1', caption: 'Radio 1', icon: 'fa fa-star', checked: true },
			{ type: 'radio',  id: 'item4',  group: '1', caption: 'Radio 2', icon: 'fa fa-heart' },
			{ type: 'break', id: 'break2' },
			{ type: 'drop',  id: 'item5', caption: 'Drop Down', icon: 'fa fa-plus', html: '<div style="padding: 10px">Drop down</div>' },
			{ type: 'break', id: 'break3' },
			{ type: 'html',  id: 'item6',
				html: '<div style="padding: 3px 10px;">'+
					  ' Input:'+
					  '	<input size="10" style="padding: 3px; border-radius: 2px; border: 1px solid silver"/>'+
					  '</div>' 
			},
			{ type: 'spacer' },
			{ type: 'button',  id: 'item7',  caption: 'Item 5', icon: 'fa fa-flag' }
		]
	});
	
	w2ui.toolbar.on('*', function (event) { 
		//console.log('EVENT: '+ event.type + ' TARGET: '+ event.target, event);
	});


//======================== end of toolbar

	// define layout to html class id main.
	$('#main').w2layout(config.layout);
	//initialization layout to main
	w2ui.layout.content('left', $().w2sidebar(config.sidebar));
	w2ui.layout.content('main', '<div style="padding: 10px">Slamat Datang</div>');
	//sidebar evenet listener
	w2ui.sidebar.on('click', function (event) {
		switch (event.target) {
			case 'level-1':
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">This data should not be null, before you can proceed to another link, you should really fill this form completly.</div>');
				break;
			case 'level-1-1':
				menu_identitas_bmt();
				break;
			case 'level-1-2':
				menu_daftar_akun();
				break;
			case 'level-1-3':
				menu_pegawai();
				break;
			case 'level-1-4':
				menu_nasabah();
				break;
			case 'level-1-5':
				menu_supplier();
				break;
			case 'level-1-6':
				menu_user();
				break;
			case 'level-2':
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">This data Required befor you can proceed to accounting data. Master Data associate to this item shoud be filled.</div>');
				break;			
			case 'level-2-1':
				menu_daftar_sandi();
				break;
			case 'level-2-2':
				menu_nomor_rekening();
				break;
			case 'level-3':
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">You can fill this form after completing master anda secondary master data.</div>');
				break;
			case 'level-3-1':
				menu_kas();
				break;
			case 'level-3-2':
				//menu_daftar_akun();
				break;
			case 'level-3-3':
				//menu_pegawai();
				break;
			case 'level-3-4':
				//menu_daftar_akun();
				break;
			case 'level-3-5':
				//menu_pegawai();
				break;
		}
	});
	


});



function menu_identitas_bmt(){
	w2ui.layout.content('main', w2ui.grid_identitas_bmt);
	w2ui.layout.content('right', w2ui.grid_detail_identitas_bmt);
	w2ui['grid_identitas_bmt'].load('index.php/ctrl_identitas_bmt/read');
	w2ui['grid_identitas_bmt'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_identitas_bmt'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_identitas_bmt/read');
		};

	});

}


function menu_daftar_akun(){
	w2ui.layout.content('main', w2ui.grid_daftar_akun);
	w2ui.layout.content('right', w2ui.grid_detail_daftar_akun);
	w2ui['grid_daftar_akun'].load('index.php/ctrl_daftar_akun/read');
	w2ui['grid_daftar_akun'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_daftar_akun'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_daftar_akun/read');
		};
	});
}

function menu_pegawai(){
	w2ui.layout.content('main', w2ui.grid_pegawai);
	w2ui.layout.content('right', w2ui.grid_detail_pegawai);
	w2ui['grid_pegawai'].load('index.php/ctrl_pegawai/read');
	w2ui['grid_pegawai'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_pegawai'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_pegawai/read');
		};


	});
}

function menu_nasabah(){
	w2ui.layout.content('main', w2ui.grid_nasabah);
	w2ui.layout.content('right', w2ui.grid_detail_nasabah);
	w2ui['grid_nasabah'].load('index.php/ctrl_nasabah/read');
	w2ui['grid_nasabah'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_nasabah'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_nasabah/read');
		};

	});
}

function menu_supplier(){
	w2ui.layout.content('main', w2ui.grid_supplier);
	w2ui.layout.content('right', w2ui.grid_detail_supplier);
	w2ui['grid_supplier'].load('index.php/ctrl_supplier/read');
	w2ui['grid_supplier'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_supplier'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_supplier/read');
		};
	});
}

function menu_user(){
	w2ui.layout.content('main', w2ui.grid_user);
	w2ui.layout.content('right', w2ui.grid_detail_user);
	w2ui['grid_user'].load('index.php/ctrl_user/read');
	w2ui['grid_user'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_user'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_user/read');
		};
	});
}

function menu_daftar_sandi(){
	w2ui.layout.content('main', w2ui.grid_daftar_sandi);
	w2ui.layout.content('right', w2ui.grid_detail_daftar_sandi);
	w2ui['grid_daftar_sandi'].load('index.php/ctrl_daftar_sandi/read');
	w2ui['grid_daftar_sandi'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_daftar_sandi'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_daftar_sandi/read');
		};
	});
}


function menu_nomor_rekening(){
	w2ui.layout.content('main', w2ui.grid_nomor_rekening);
	w2ui.layout.content('right', w2ui.grid_detail_nomor_rekening);
	w2ui['grid_nomor_rekening'].load('index.php/ctrl_nomor_rekening/Qread');
	w2ui['grid_nomor_rekening'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_nomor_rekening'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_nomor_rekening/Qread');
		};
	});
}

function menu_kas(){
	w2ui.layout.content('main', w2ui.grid_kas);
	w2ui.layout.content('right', w2ui.grid_detail_kas);
	w2ui['grid_kas'].load('index.php/ctrl_kas/Qread');
	w2ui['grid_kas'].on('reload', function(event) {
		this.reset();
		w2ui['grid_detail_kas'].clear();
		event.onComplete = function () {
			this.load('index.php/ctrl_kas/Qread');
		};
	});
}

</script>