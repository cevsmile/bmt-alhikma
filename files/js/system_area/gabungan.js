<!DOCTYPE html>
<html>
<head>
	<title>W2UI Demo: combo-7</title>
	<link rel="stylesheet" type="text/css" href="dist/w2ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
	<script type="text/javascript" src="dist/w2ui.js"></script>
</head>
<body>

<div style="padding: 20px 0px">
	<input type="button" value="Open Popup" onclick="openPopup()"/>
</div>

<script type="text/javascript">
// widget configuration
var config = {
	layout: {
		name: 'layout',
		padding: 4,
		panels: [
			{ type: 'left', size: '50%', resizable: true, minSize: 300 },
			{ type: 'main', minSize: 300 }
		]
	},

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
}

$(function () {
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
		};
			// initialization in memory
	$().w2layout(config.layout);
	$().w2grid(config.grid);
	$().w2form(config.form);
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
				w2ui.layout.content('main', w2ui.form);
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
</script>

</body>
</html>