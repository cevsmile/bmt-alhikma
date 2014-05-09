<div id="main" style="width: 100%; height: 500px;"></div>
<?php $this->load->view('system_area/vf_data_processing/vf_daftar_kode_bantu/vff_daftar_kode_bantu'); ?>

<script type="text/javascript">
// widget configuration
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'top', size: '10%', resizable: true, minSize: 10 },
			{ type: 'left', size: '15%', resizable: true, minSize: 10 },
			{ type: 'right', size: '25%', resizable: true, minSize: 10, hidden : true },
			{ type: 'bottom', size: '10%', resizable: true, minSize: 10 },
			{ type: 'main', minSize: 300 }
		]
	},
	sidebar:{
		name: 'sidebar',
		nodes: [ 
			{ id: 'level-1', text: 'PROSES PENDATAAN', img: 'icon-folder',
			  nodes: [ { id: 'level-1-1', text: 'Daftar Kode Bantu', img: 'icon-page'},
					   { id: 'level-1-2', text: 'Daftar Akun', img: 'icon-page' },
					   { id: 'level-1-3', text: 'Pegawai', img: 'icon-page' },
					   { id: 'level-1-4', text: 'Nasabah', img: 'icon-page' },
					   { id: 'level-1-5', text: 'Supplier', img: 'icon-page' },
					   { id: 'level-1-6', text: 'Daftar Sandi', img: 'icon-page' }
					 ]
			},
			{ id: 'level-2', text: 'Level 2', img: 'icon-folder',
			  nodes: [ { id: 'level-2-1', text: 'Level 2.1', icon: 'fa fa-home' },
					   { id: 'level-2-2', text: 'Level 2.2', icon: 'fa fa-home'  },
					   { id: 'level-2-3', text: 'Barcode', icon: 'fa fa-barcode'  }
					 ]
			}
		]
	}

}

$(function () {
	// define layout to html class id main.
	$('#main').w2layout(config.layout);
	//initialization layout to main
	w2ui.layout.content('left', $().w2sidebar(config.sidebar));
	w2ui.layout.content('main', '<div style="padding: 10px">Slamat Datang</div>');
	//var a = w2utils.formatDateTime((new Date()), 'mm-dd-yyyy');
	//console.log(a);
	//sidebar evenet listener
	w2ui.sidebar.on('click', function (event) {
		switch (event.target) {
			case 'level-1':
				desObj();
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">Some HTML</div>');
				break;
			case 'level-1-1':
				menu_daftar_kode_bantu();
				//menu_identitas_bmt();
				break;
			case 'level-1-2':
				//menu_daftar_akun();
				break;
			case 'level-1-3':
				//menu_pegawai();
				break;
			case 'level-1-4':
				//menu_nasabah();
				break;
			case 'level-1-5':
				//menu_supplier();
				break;
			case 'level-1-6':
				//menu_daftar_kode_bantu();
				break;
			case 'html':
				w2ui.layout.content('main', '<div style="padding: 10px">Some HTML</div>');
				$(w2ui.layout.el('main'))
					.removeClass('w2ui-grid')
					.css({ 
						'border-left': '1px solid silver'
					});
				break;
		}
	});
	

});


function desObj(){
	$().w2destroy('grid_daftar_kode_bantu');
	$().w2destroy('grid_detail_daftar_kode_bantu');
}


function menu_daftar_kode_bantu(){
	desObj();
	w2ui.layout.content('main', $().w2grid(config_daftar_kode_bantu.grid_daftar_kode_bantu));
	w2ui.layout.content('right', $().w2grid(config_daftar_kode_bantu.grid_detail_daftar_kode_bantu));
	w2ui['grid_daftar_kode_bantu'].load('index.php/ctrl_daftar_kode_bantu/tester');
	w2ui['grid_daftar_kode_bantu'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_kode_bantu/tester');
		this.selectNone();
		this.reset();
		this.refresh();
		w2ui['grid_detail_daftar_kode_bantu'].clear();
	});
}
</script>