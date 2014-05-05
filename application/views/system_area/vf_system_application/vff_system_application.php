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
				{ type: 'button', id: 'btn-details', caption: 'Details', icon: 'fa fa-eye' }
			],
			onClick: function (event) {
				switch (event.target) {
					case 'btn-details':
						w2ui['layout'].toggle('right', true);
						break;
					case 'level-1-1':
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
	// define layout to html class id main.
	$('#main').w2layout(config.layout);
	//initialization layout to main
	w2ui.layout.content('left', $().w2sidebar(config.sidebar));
	w2ui.layout.content('main', '<div style="padding: 10px">Slamat Datang</div>');
	
	// save to memory for re-use
	$().w2form(config.form);
	$().w2form(config.form2);

	//sidebar evenet listener
	w2ui.sidebar.on('click', function (event) {
		switch (event.target) {
			case 'level-1':
				desObj();
				w2ui['layout'].hide('right', true);
				w2ui.layout.content('main', '<div style="padding: 10px">Some HTML</div>');
				break;
			case 'level-1-1':
				break;
			case 'level-1-2':
				//w2ui.layout.content('main', w2ui['users1']);
				break;
			case 'level-1-3':
				desObj();
				w2ui.layout.content('main', $().w2grid(config.grid));
				w2ui.layout.content('right', $().w2grid(config.grid2));
				break;
			case 'level-1-4':
				//w2ui.layout.content('main', w2ui['users1']);
				break;
			case 'level-1-5':
				//w2ui.layout.content('main', w2ui['users1']);
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
	
$('#toolbar').w2toolbar({
	name  : 'toolbar',
	right : 'text on the right',
	items : [
		{ type: 'check',  id: 'item1', caption: 'Check', img: 'icon-page', checked: true },
		{ type: 'radio',  id: 'item3',  group: '1', caption: 'Radio 1', img: 'icon-add' },
		{ type: 'radio',  id: 'item4',  group: '1', caption: 'Radio 2', img: 'icon-add' },
	]
});	
	
	
	
	
	
	

});


function desObj(){
	$().w2destroy('users');
	$().w2destroy('users1');
}

</script>