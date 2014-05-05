<div id="main" style="width: 100%; height: 500px;"></div>

<?php $this->load->view('system_area/vf_system_application/vf_identitas_bmt/vff_identitas_bmt'); ?>
<?php $this->load->view('system_area/vf_system_application/vf_pegawai/vff_pegawai'); ?>

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
			{ id: 'level-1', text: 'DATA MASTER', img: 'icon-folder',
			  nodes: [ { id: 'level-1-1', text: 'Identitas BMT', img: 'icon-page'},
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
					   { id: 'level-2-3', text: 'Level 2.3', icon: 'fa fa-home'  }
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
	var a = w2utils.formatDateTime((new Date()), 'mm-dd-yyyy');
	console.log(a);
	//sidebar evenet listener
	w2ui.sidebar.on('click', function (event) {
		switch (event.target) {
			case 'level-1':
				desObj();
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">Some HTML</div>');
				break;
			case 'level-1-1':
				menu_identitas_bmt();
				break;
			case 'level-1-2':
				//w2ui.layout.content('main', w2ui['grid_detail_pegawai']);
				desObj();
				break;
			case 'level-1-3':
				menu_pegawai();
				break;
			case 'level-1-4':
				desObj();
				//w2ui.layout.content('main', w2ui['grid_detail_pegawai']);
				break;
			case 'level-1-5':
				desObj();
				//w2ui.layout.content('main', w2ui['grid_detail_pegawai']);
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
	$().w2destroy('grid_pegawai');
	$().w2destroy('grid_detail_pegawai');
	$().w2destroy('grid_identitas_bmt');
	$().w2destroy('grid_detail_identitas_bmt');	
}

function menu_pegawai(){
	desObj();
	w2ui.layout.content('main', $().w2grid(config_pegawai.grid_pegawai));
	w2ui.layout.content('right', $().w2grid(config_pegawai.grid_detail_pegawai));
	//w2ui['grid_pegawai'].load('index.php/ctrl_pegawai/tester');
	w2ui['grid_pegawai'].on('reload', function(event) {
		this.load('index.php/ctrl_pegawai/tester');
		this.selectNone();
		this.reset();
		this.refresh();
		w2ui['grid_detail_pegawai'].clear();
	});
}

function menu_identitas_bmt(){
	desObj();
	w2ui.layout.content('main', $().w2grid(config_identitas_bmt.grid_identitas_bmt));
	w2ui.layout.content('right', $().w2grid(config_identitas_bmt.grid_detail_identitas_bmt));
	//w2ui['grid_pegawai'].load('index.php/ctrl_pegawai/tester');
	w2ui['grid_identitas_bmt'].on('reload', function(event) {
		this.load('index.php/ctrl_identitas_bmt/tester');
		this.selectNone();
		this.reset();
		this.refresh();
		w2ui['grid_detail_identitas_bmt'].clear();
	});
}
</script>