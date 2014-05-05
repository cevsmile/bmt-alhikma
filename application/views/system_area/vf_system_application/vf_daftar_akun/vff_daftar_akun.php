<div class="container">
<div id="main" style="width: 100%; height: 500px;"></div>
</div>
<script type="text/javascript">
// widget configuration
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'top', size: '10%', resizable: true, minSize: 10 },
			{ type: 'left', size: '70%', resizable: true, minSize: 300 },
			{ type: 'bottom', size: '10%', resizable: true, minSize: 10 },
			{ type: 'main', minSize: 200 }
		]
	},
	grid: { 
        name : 'users',
        header : 'Data Pegawai BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        toolbar : true,
	        footer : true,
	        toolbarAdd	: true,
	        toolbarDelete	: true,
	        lineNumbers: true
		},
		toolbar: {
			items: [
				{ type: 'break' },
				{ type: 'button', id: 'btn-details', caption: 'Details', icon: 'fa fa-eye' },
				{ type: 'button', id: 'btn-fullscreen', caption: 'Full', icon: 'fa fa-eye' }
			],
			onClick: function (event) {
				switch (event.target) {
					case 'btn-details':
						w2ui['layout'].toggle('right', true);
						break;
					case 'btn-fullscreen':
						w2ui['layout'].toggle('top', true);
						w2ui['layout'].toggle('left', true);
						w2ui['layout'].hide('right', true);
						w2ui['layout'].toggle('bottom', true);
						break;
					case 'level-1-2':
						break;
				};
			}
		},
        columns: [
            { field: 'recid', caption: 'Nomor Induk', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '150px', searchable: true, sortable: true },
            { field: 'Jenis_Kelamin', caption: 'Jenis Kelamin', size: '150px', searchable: true, sortable: true },
            { field: 'Username', caption: 'Username', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        addUser(event.recid);
        },
        onDblClick: function (event) {
         	editUser(event.recid); 
			var grid = this;
			var form = w2ui.form;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form.recid  = sel[0];
					form.record = $.extend(true, {}, grid.get(sel[0]));
					form.refresh();
				} else {
					form.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['users'].getSelection();
			event.preventDefault();
			deleteUser(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['users1'].clear();
			var record = this.get(event.recid);
			
			w2ui['users1'].add([
				{ recid: 0, name: 'NIK:', value: record.NIK },
				{ recid: 1, name: 'Nama:', value: record.Nama },
				{ recid: 2, name: 'Alamat:', value: record.Alamat },
				{ recid: 3, name: 'Nomor KTP:', value: record.Nomor_KTP },
				{ recid: 4, name: 'Nomor SIM:', value: record.Nomor_SIM },
				{ recid: 5, name: 'Jenis Kelamin:', value: record.Jenis_Kelamin },
				{ recid: 6, name: 'Tanggal Masuk:', value: record.Tanggal_Masuk },
				{ recid: 7, name: 'Tanggal Keluar:', value: record.Tanggal_Keluar },
				{ recid: 8, name: 'Status:', value: record.Status },
				{ recid: 9, name: 'Pembaruan:', value: record.Pembaruan },
				{ recid: 10, name: 'Saldo Awal:', value: record.Saldo_Awal },
				{ recid: 11, name: 'Saldo Akhir:', value: record.Saldo_Akhir },
				{ recid: 12, name: 'Username:', value: record.Username }
			]);
		}		        
	},
	grid2: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'users1', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form: {
		name: 'form',
		fields: [
			{ name: 'recid', type: 'text', html: { caption: 'NIK', attr: 'size="10" readonly' } },
			{ name: 'Nama', type: 'text', required: true, html: { caption: 'Nama', attr: 'size="40" maxlength="40"' } },
			{ name: 'Alamat', type: 'text', required: true, html: { caption: 'Alamat', attr: 'size="40" maxlength="40"' } },
			{ name: 'Nomor_KTP', type: 'text', html: { caption: 'Nomor KTP', attr: 'size="10"' } },
			{ name: 'Nomor_SIM', type: 'text', html: { caption: 'Nomor SIM', attr: 'size="10"' } },
			{ name: 'Jenis_Kelamin', type: 'text', html: { caption: 'Jenis Kelamin', attr: 'size="10"' } },
			{ name: 'Tanggal_Masuk', type: 'text', html: { caption: 'Tanggal Masuk'} },
			{ name: 'Tanggal_Keluar', type: 'text', html: { caption: 'Tanggal Keluar'} },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="10"' } },
			{ name: 'Pembaruan', type: 'text', html: { caption: 'Pembaruan'} },
			{ name: 'Saldo_Awal', type: 'int', html: { caption: 'Saldo Awal'} },
			{ name: 'Saldo_Akhir', type: 'int', html: { caption: 'Saldo Akhir'} },
			{ name: 'Username', type: 'text', html: { caption: 'Username', attr: 'size="10"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['users'].set(data.records.NIK, data.records);
						w2ui['users'].refresh();
						w2ui['users'].selectNone();
						w2ui['users1'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form2: {
		name: 'form2',
		fields: [
			{ name: 'NIK', type: 'text', required: true, html: { caption: 'NIK', attr: 'size="10"' } },
			{ name: 'Nama', type: 'text', required: true, html: { caption: 'Nama', attr: 'size="40" maxlength="40"' } },
			{ name: 'Alamat', type: 'text', required: true, html: { caption: 'Alamat', attr: 'size="40" maxlength="40"' } },
			{ name: 'Nomor_KTP', type: 'text', html: { caption: 'Nomor KTP', attr: 'size="10"' } },
			{ name: 'Nomor_SIM', type: 'text', html: { caption: 'Nomor SIM', attr: 'size="10"' } },
			{ name: 'Jenis_Kelamin', type: 'text', html: { caption: 'Jenis Kelamin', attr: 'size="10"' } },
			{ name: 'Tanggal_Masuk', type: 'text', html: { caption: 'Tanggal Masuk'} },
			{ name: 'Tanggal_Keluar', type: 'text', html: { caption: 'Tanggal Keluar'} },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="10"' } },
			{ name: 'Pembaruan', type: 'text', html: { caption: 'Pembaruan'} },
			{ name: 'Saldo_Awal', type: 'int', html: { caption: 'Saldo Awal'} },
			{ name: 'Saldo_Akhir', type: 'int', html: { caption: 'Saldo Akhir'} },
			{ name: 'Username', type: 'text', html: { caption: 'Username', attr: 'size="10"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['users'].add(data.records);
						w2ui['users'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	}
		
}

$(function () {
	// initialization
	$('#main').w2layout(config.layout);
	w2ui.layout.content('left', $().w2grid(config.grid));
	w2ui.layout.content('main', $().w2grid(config.grid2));
	$().w2form(config.form);
	$().w2form(config.form2);
	w2ui['users'].load('index.php/ctrl_pegawai/tester');

	w2ui['users'].on('reload', function(event) {
		this.load('index.php/ctrl_pegawai/tester');
		this.selectNone();
		this.reset();
		this.refresh();
		w2ui['users1'].clear();
	});

/*
	w2ui['users'].toolbar.on('click', function(event) {
		console.log(event.target);
		
		if (event.target == 'reload'){
		w2ui['users'].clear();
		
		//w2ui['users'].load('index.php/system_area/tester');
		w2ui['users'].reload();
		}
	});	
*/
	
});


function editUser(recid) {
	$().w2popup('open', {
		title	: 'Edit Pegawai',
		body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form.box).hide();
			event.onComplete = function () {
				$(w2ui.form.box).show();
				w2ui.form.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form.box).hide();
			event.onComplete = function () {
				$(w2ui.form.box).show();
				w2ui.form.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render('form');
				w2ui['form'].url = {save: 'index.php/ctrl_pegawai/update/'};
				
			}
		}
	});
	
}

function addUser(recid) {
	$().w2popup('open', {
		title	: 'Add Pegawai',
		body	: '<div id="form2" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form2.box).hide();
			event.onComplete = function () {
				$(w2ui.form2.box).show();
				w2ui.form2.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form2.box).hide();
			event.onComplete = function () {
				$(w2ui.form2.box).show();
				w2ui.form2.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form2').w2render('form2');
				w2ui['form2'].url = {save: 'index.php/ctrl_pegawai/create/'};
				w2ui['form2'].action('Reset');
			}
		}
	});
	
}

function deleteUser(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_pegawai/delete/' + delrecid,
		formHTML:
			'<div class="w2ui-page page-0">'+
			'<div style="" class="w2ui-box1">'+
			'	<div style="" class="w2ui-msg-body">'+
			'		<div class="w2ui-centered">'+
			'			<div style="font-size: 20px;">Data Akan Dihapus!!!!</div>'+
			'		</div>'+
			'	</div>'+
			'</div>'+			
			'</div>'+			
			'<div class="w2ui-buttons">'+
			'	<input type="button" value="delete" name="delete">'+
			'	<input type="button" value="cancel" name="cancel">'+
			'</div>',
			actions: {
				"delete": function () {
					this.save(function (data) {
						if (data.status == 'success') {
							w2ui['users'].remove(delrecid);
							w2ui['users1'].clear();
							$().w2popup('close');
						}
					// if error, it is already displayed by w2form
					});
				},
				"cancel": function () {
					$().w2popup('close');
				}
			}
	}); 
	
	$().w2popup('open', {
		title	: 'Delete Pegawai',
		body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render('deletedialog');
			}
		},
	});	
	
}
</script>