<!DOCTYPE html>
<html>
<head>
		<base href="<?php echo base_url(); ?>" />
		<link rel="stylesheet" type="text/css" href="css/w2ui-1.3.2.min.css" />
		<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="js/w2ui-1.3.2.min.js"></script>
</head>
<body>
    <div id="users" style="width: 100%; height: 600px;"></div>
</body>
<script>
$(function () {
// define and render grid
	$.get("index.php/home/read", function(data) {
		var myRecords = [];
		for (var i in data) {
			myRecords.push({
				recid : data[i].id,
				name : data[i].name,
				email : data[i].email
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
            { field: 'recid', caption: 'ID', size: '150px', searchable: true },
            { field: 'name', caption: 'Name', size: '150px', searchable: true },
            { field: 'email', caption: 'Email', size: '100%', searchable: true }
        ], records: myRecords,
        onAdd: function (event) {
	        addUser(0);
        },
        onDblClick: function (event) {
         	editUser(event.recid);
        }
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
</html>