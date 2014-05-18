<div id="main" style="width: 100%; height: 500px;"></div>

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
			  nodes: [ { id: 'level-1-1', text: 'KAS', img: 'icon-page'},
					   { id: 'level-1-2', text: 'Bank', img: 'icon-page' },
					   { id: 'level-1-3', text: 'Bank Lain', img: 'icon-page' },
					   { id: 'level-1-4', text: 'Jurnal Beli Murabahah', img: 'icon-page' },
					   { id: 'level-1-5', text: 'Jurnal Jual Murabahah', img: 'icon-page' },
					   { id: 'level-1-6', text: 'Jurnal Setoran Murabahah', img: 'icon-page' }
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

	w2ui.sidebar.on('click', function (event) {
		switch (event.target) {
			case 'level-1':
				desObj();
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">Some HTML</div>');
				break;
			case 'level-1-1':
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


</script>