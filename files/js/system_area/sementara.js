<script type="text/javascript">
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'left', size: '50%', resizable: true, minSize: 300 },
			{ type: 'main', minSize: 300 }
		]
	},
	grid: { 
		$.get("index.php/system_area/read", function(data) {
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
	    $('#users').w2grid({
	        name : 'users',
	        header : 'List of Users',
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
	        ], records: myRecords,
	        onAdd: function (event) {
		        addUser(0);
	        },
	        onDblClick: function (event) {
	         	editUser(event.recid);
	        },
			onClick: function (event) {
				w2ui['users1'].clear();
				var record = this.get(event.recid);
				w2ui['users1'].add([
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
		$('#users1').w2grid({ 
			header: 'Details',
			show: { header: true, columnHeaders: false },
			name: 'users1', 
			columns: [				
				{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
				{ field: 'value', caption: 'Value', size: '100%' }
			]
		});		
		}, "json"); 
	},
	
};


$(function () {
// define and render grid
	$.get("index.php/system_area/read", function(data) {
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
    $('#users').w2grid({
        name : 'users',
        header : 'List of Users',
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
        ], records: myRecords,
        onAdd: function (event) {
	        addUser(0);
        },
        onDblClick: function (event) {
         	editUser(event.recid);
        },
		onClick: function (event) {
			w2ui['users1'].clear();
			var record = this.get(event.recid);
			w2ui['users1'].add([
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
	$('#users1').w2grid({ 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'users1', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	});		
	
    
	}, "json"); 


    // defined form
	$().w2form({
		name : 'user_edit',
		url : '',
		style : 'border: 0px; background-color: transparent;',
		formHTML:
			'<div class="w2ui-page page-0">'+
			' 	<div class="w2ui-label">Name:</div>'+
			' 	<div class="w2ui-field">'+
			' 		<input name="name" type="text" size="35"/>'+
			' 	</div>'+
			' 	<div class="w2ui-label">Email:</div>'+
			' 	<div class="w2ui-field">'+
			' 		<input name="email" type="text" size="35"/>'+
			' 	</div>'+
			'</div>'+
			'<div class="w2ui-buttons">'+
			' 	<input type="button" value="Cancel" name="cancel">'+
			' 	<input type="button" value="Save" name="save">'+
			'</div>',
		fields: [
			{ name: 'name', type: 'text', required: true },
			{ name: 'email', type: 'email' },
			],
		actions: {
			"save": function () {
				this.save(function (data) {
				if (data.status == 'success') {
					w2ui['users'].reload();
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
	
	$().w2form({
		name : 'user_add',
		url : 'index.php/home/create',
		style : 'border: 0px; background-color: transparent;',
		formHTML:
			'<div class="w2ui-page page-0">'+
			' 	<div class="w2ui-label">ID:</div>'+
			' 	<div class="w2ui-field">'+
			' 		<input name="id" type="text" size="35"/>'+
			' 	</div>'+
			' 	<div class="w2ui-label">Name:</div>'+
			' 	<div class="w2ui-field">'+
			' 		<input name="name" type="text" size="35"/>'+
			' 	</div>'+
			' 	<div class="w2ui-label">Email:</div>'+
			' 	<div class="w2ui-field">'+
			' 		<input name="email" type="text" size="35"/>'+
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
					w2ui['users'].reload();
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
	
	
	
});

function editUser(recid) {
	$().w2popup('open', {
		title 	: 'Edit User',
		body 	: '<div id="user_edit" style="width: 100%; height: 100%"></div>',
		style 	: 'padding: 15px 0px 0px 0px',
		width 	: 500,
		height 	: 300,
		onOpen 	: function (event) {
			event.onComplete = function () {
			w2ui['user_edit'].clear();
			w2ui['user_edit'].recid = recid;
			$('#w2ui-popup #user_edit').w2render('user_edit');
			}
		}
	});
}

function addUser(recid) {
	$().w2popup('open', {
		title 	: 'Add User',
		body 	: '<div id="user_add" style="width: 100%; height: 100%"></div>',
		style 	: 'padding: 15px 0px 0px 0px',
		width 	: 500,
		height 	: 300,
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