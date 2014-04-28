<a value="Open Popup" onclick="openPopup()"/><img style="border:0;" src="files/img/kspread.png" alt="Input Data" width="64" height="64"></a>

<script type="text/javascript">
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'left', size: '60%', resizable: true, minSize: 300 },
			{ type: 'main', minSize: 300 }
		]
	},
	grid: $.get("index.php/system_area/read", function(data) {
	var myRecords = [];
	for (var i in data) {
		myRecords.push({
			recid : data[i].NIK,
			Nama : data[i].Nama,
			Alamat : data[i].Alamat,
			Nomor_KTP : data[i].Nomor_KTP,
			Nomor_SIM : data[i].Nomor_SIM,
			Jenis_Kelamin : data[i].Jenis_Kelamin,
			Tanggal_Masuk : data[i].Tanggal_Masuk,
			Tanggal_Keluar : data[i].Tanggal_Keluar,
			Status : data[i].Status,
			Pembaruan : data[i].Pembaruan,
			Saldo_Awal : data[i].Saldo_Awal,
			Saldo_Akhir : data[i].Saldo_Akhir,
			Username : data[i].Username
		});
	}
	
    $('grid').w2grid({
        name : 'grid',
        header : 'List of Pegawai',
        show: {
	         header : true,
	         toolbar : true,
	         footer : true,
	         toolbarAdd	: true,
	         toolbarDelete	: true
        },
        columns: [
            { field: 'recid', caption: 'Nomor Pegawai', size: '150px', searchable: true },
            { field: 'Nama', caption: 'Nama', size: '150px', searchable: true },
            { field: 'Username', caption: 'Username', size: '100%', searchable: true }
        ], records: myRecords,
        onAdd: function (event) {
	        addPegawai(0);
        },
        onDblClick: function (event) {
         	editPegawai(event.recid);
        },
		onClick: function (event) {
			w2ui['grid2'].clear();
			var record = this.get(event.recid);
			w2ui['grid2'].add([
				{ recid: 0, name: 'NIK:', value: record.recid },
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
    });
	//defined detailed grid
	$('grid2').w2grid({ 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid2', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	});		

	
    
	}, "json")

		
}


$(function () {
	// initialization in memory
	$().w2layout(config.layout);
	//$().w2grid(config.grid);



	$().w2form({
		name : 'user_edit',
		url : '',
		style : 'border: 0px; background-color: transparent;',
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
			' 	<input type="button" value="Cancel" name="cancel">'+
			' 	<input type="button" value="Save" name="save">'+
			'</div>',
		fields: [
			{ name: 'Nama', type: 'text', required: true },
			{ name: 'Alamat', type: 'text' },
			],
		actions: {
			"save": function () {
				this.save(function (data) {
				if (data.status == 'success') {
					openPopup();
					w2ui['grid'].reload();
					//$().w2popup('close');
				}
			// if error, it is already displayed by w2form
			});
			},
			"cancel": function () {
				//$().w2popup('close');
				openPopup();
			},
		}
	});
	
	$().w2form({
		name : 'user_add',
		url : 'index.php/home/create',
		style : 'border: 0px; background-color: transparent;',
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
			' 	<input type="button" value="Cancel" name="cancel">'+
			' 	<input type="button" value="Save" name="save">'+
			'</div>',
		fields: [
			{ name: 'id', type: 'text', required: true },
			{ name: 'name', type: 'text', required: true },
			{ name: 'email', type: 'email' },
			],
		actions: {
			"save": function () {
				this.save(function (data) {
				if (data.status == 'success') {
					openPopup();
					w2ui['grid'].reload();
					//$().w2popup('close');
					
				}
			// if error, it is already displayed by w2form
			});
			},
			"cancel": function () {
				//$().w2popup('close');
				openPopup();
			},
		}
	});	
});

function openPopup() {
	w2popup.open({
		title 	: 'Popup',
		width	: 900,
		height	: 600,
		showMax : true,
		body 	: '<div id="main" style="position: absolute; left: 5px; top: 5px; right: 5px; bottom: 5px;"></div>',
		onOpen  : function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #main').w2render('layout');
				w2ui.layout.content('left', w2ui.grid);
				w2ui.layout.content('main', w2ui.grid2);
			};
		},
		onMax : function (event) { 
			event.onComplete = function () {
				w2ui.layout.resize();
			}
		},
		onMin : function (event) {
			event.onComplete = function () {
				w2ui.layout.resize();
			}
		}
	});
}

function editPegawai(recid) {
	$().w2popup('open', {
		title 	: 'Edit User',
		body 	: '<div id="user_edit" style="width: 100%; height: 100%"></div>',
		style 	: 'padding: 15px 0px 0px 0px',
		width 	: 500,
		height 	: 600,
		onOpen 	: function (event) {
			event.onComplete = function () {
			w2ui['user_edit'].clear();
			w2ui['user_edit'].recid = recid;
			$('#w2ui-popup #user_edit').w2render('user_edit');
			}
		}
	});
}

function addPegawai(recid) {
	$().w2popup('open', {
		title 	: 'Add User',
		body 	: '<div id="user_add" style="width: 100%; height: 100%"></div>',
		style 	: 'padding: 15px 0px 0px 0px',
		width 	: 500,
		height 	: 600,
		onOpen 	: function (event) {
			event.onComplete = function () {
			w2ui['user_add'].clear();
			w2ui['user_add'].recid = recid;
			$('#w2ui-popup #user_add').w2render('user_add');
			}
		}
	});
}

</script>