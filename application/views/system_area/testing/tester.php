<div id="main" style="width: 100%; height: 400px;"></div>
<script type="text/javascript">
// widget configuration
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'left', size: '70%', resizable: true, minSize: 300 },
			{ type: 'main', minSize: 200 }
		]
	},
	grid: { 
        name : 'users',
        header : 'Data Pegawai BMT AL-Hikma',
        url : {get: 'index.php/system_area/tester'},
        show: {
	         header : true,
	         toolbar : true,
	         footer : true,
	         toolbarAdd	: true,
	         toolbarDelete	: true
        },
        columns: [
            { field: 'recid', caption: 'Nomor Induk', size: '150px', searchable: true },
            { field: 'Nama', caption: 'Nama', size: '150px', searchable: true },
            { field: 'Jenis_Kelamin', caption: 'Jenis Kelamin', size: '150px', searchable: true },
            { field: 'Username', caption: 'Username', size: '100%', searchable: true }
        ],
        onAdd: function (event) {
	        addUser(0);
        },
        onDblClick: function (event) {
         	editUser(event.recid); 
        },
		onDelete: function(event) {
			//var delnik = w2ui['users'].getSelection();
			var delrecid= w2ui['users'].getSelection();
			event.preventDefault();
			deleteUser(delrecid);
			console.log(delrecid);
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
	}
		
}

$(function () {
	// initialization
	$('#main').w2layout(config.layout);
	w2ui.layout.content('left', $().w2grid(config.grid));
	w2ui.layout.content('main', $().w2grid(config.grid2));
});


function editUser(recid) {
		$.get("index.php/system_area/getByRecid/" + recid, function(data) {
		$().w2destroy('foo');
		$().w2form({
			name: 'foo',
			style: 'border: 0px; background-color: transparent;',
			url : 'index.php/system_area/update/',
			formHTML:
				'<div class="w2ui-page page-0">'+
				' 	<div class="w2ui-label">Nomor Pegawai:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="NIK" type="text" size="35" disabled/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nama:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nama" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Alamat:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Alamat" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nomor KTP:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nomor_KTP" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nomor SIM:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nomor_SIM" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Jenis Kelamin:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Jenis_Kelamin" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Tanggal Masuk:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Tanggal_Masuk" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Tanggal Keluar:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Tanggal_Keluar" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Status:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Status" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Pembaruan Rekening:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Pembaruan" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Saldo Awal:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Saldo_Awal" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Saldo Akhir:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Saldo_Akhir" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Username:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Username" type="text" size="35"/>'+
				' 	</div>'+
				'</div>'+
				'<div class="w2ui-buttons">'+
				'	<input type="button" value="save" name="save">'+
				'	<input type="button" value="cancel" name="cancel">'+
				'</div>',
			fields: [
				{ name: 'NIK', type: 'text', required: true },
				{ name: 'Nama', type: 'text', required: true },
				{ name: 'Alamat', type: 'text', required: true },
				{ name: 'Nomor_KTP', type: 'text' },
				{ name: 'Nomor_SIM', type: 'text' },
				{ name: 'Jenis_Kelamin', type: 'text' },
				{ name: 'Tanggal_Masuk', type: 'text' },
				{ name: 'Tanggal_Keluar', type: 'text' },
				{ name: 'Status', type: 'text' },
				{ name: 'Pembaruan', type: 'text' },
				{ name: 'Saldo_Awal', type: 'text' },
				{ name: 'Saldo_Akhir', type: 'text' },
				{ name: 'Username', type: 'text' },
			],
			record: data,
			actions: {
				"save": function () {
					w2ui['foo'].recid = recid;
					this.save(function (data) {
						if (data.status == 'success') {

							w2ui['users'].reload();
							w2ui['users1'].clear();
	
							//w2ui['users'].destroy();
							//w2ui['users1'].destroy();
							//loadPegawai();
							//w2ui('users').reload();
							
							$().w2popup('close');
							
						}
					// if error, it is already displayed by w2form
					});
				},
				"cancel": function () {
					$().w2popup('close');
				},  
			}
		});
		
		$().w2popup('open', {
			title	: 'Edit Pegawai',
			body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
			style	: 'padding: 15px 0px 0px 0px',
			width	: 500,
			height	: 600, 
			showMax : true,
			onMin	: function (event) {
				$(w2ui.foo.box).hide();
				event.onComplete = function () {
					$(w2ui.foo.box).show();
					w2ui.foo.resize();
				}
			},
			onMax	: function (event) {
				$(w2ui.foo.box).hide();
				event.onComplete = function () {
					$(w2ui.foo.box).show();
					w2ui.foo.resize();
				}
			},
			onOpen	: function (event) {
				event.onComplete = function () {
					// specifying an onOpen handler instead is equivalent to specifying an onBeforeOpen handler, which would make this code execute too early and hence not deliver.
					//w2ui['foo'].clear();
					//w2ui['foo'].recid = recid;
					$('#w2ui-popup #form').w2render('foo');
				}
			}
		});
		
	}, "json");
}

function addUser(recid) {

		$().w2destroy('foo');
		$().w2form({
			name: 'foo',
			style: 'border: 0px; background-color: transparent;',
			url : 'index.php/system_area/create/',
			formHTML:
				'<div class="w2ui-page page-0">'+
				' 	<div class="w2ui-label">Nomor Pegawai:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="NIK" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nama:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nama" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Alamat:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Alamat" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nomor KTP:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nomor_KTP" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Nomor SIM:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Nomor_SIM" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Jenis Kelamin:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Jenis_Kelamin" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Tanggal Masuk:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Tanggal_Masuk" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Tanggal Keluar:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Tanggal_Keluar" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Status:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Status" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Pembaruan Rekening:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Pembaruan" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Saldo Awal:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Saldo_Awal" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Saldo Akhir:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Saldo_Akhir" type="text" size="35"/>'+
				' 	</div>'+
				' 	<div class="w2ui-label">Username:</div>'+
				' 	<div class="w2ui-field">'+
				' 		<input name="Username" type="text" size="35"/>'+
				' 	</div>'+
				'</div>'+
				'<div class="w2ui-buttons">'+
				'	<input type="button" value="save" name="save">'+
				'	<input type="button" value="cancel" name="cancel">'+
				'</div>',
			fields: [
				{ name: 'NIK', type: 'text', required: true },
				{ name: 'Nama', type: 'text', required: true },
				{ name: 'Alamat', type: 'text', required: true },
				{ name: 'Nomor_KTP', type: 'text' },
				{ name: 'Nomor_SIM', type: 'text' },
				{ name: 'Jenis_Kelamin', type: 'text' },
				{ name: 'Tanggal_Masuk', type: 'text' },
				{ name: 'Tanggal_Keluar', type: 'text' },
				{ name: 'Status', type: 'text' },
				{ name: 'Pembaruan', type: 'text' },
				{ name: 'Saldo_Awal', type: 'text' },
				{ name: 'Saldo_Akhir', type: 'text' },
				{ name: 'Username', type: 'text' },
			],
			actions: {
				"save": function () {
					w2ui['foo'].recid = recid;
					this.save(function (data) {
						if (data.status == 'success') {
							//w2ui['users'].reload();
							//data.preventDefault();
							w2ui['users'].destroy();
							w2ui['users1'].destroy();
							loadPegawai();
							$().w2popup('close');
						}
					// if error, it is already displayed by w2form
					});
				},
				"cancel": function () {
					$().w2popup('close');
				},  
			}
		});
		
		$().w2popup('open', {
			title	: 'Add Pegawai',
			body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
			style	: 'padding: 15px 0px 0px 0px',
			width	: 500,
			height	: 600, 
			showMax : true,
			onMin	: function (event) {
				$(w2ui.foo.box).hide();
				event.onComplete = function () {
					$(w2ui.foo.box).show();
					w2ui.foo.resize();
				}
			},
			onMax	: function (event) {
				$(w2ui.foo.box).hide();
				event.onComplete = function () {
					$(w2ui.foo.box).show();
					w2ui.foo.resize();
				}
			},
			onOpen	: function (event) {
				event.onComplete = function () {
					$('#w2ui-popup #form').w2render('foo');
				}
			}
		});
		

}

function deleteUser(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/system_area/delete/' + delrecid,
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
						console.log(data);
						if (data.status == 'success') {
							w2ui['users'].reload();
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