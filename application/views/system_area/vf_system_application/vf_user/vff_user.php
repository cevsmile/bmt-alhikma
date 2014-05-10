<script type="text/javascript">
// widget configuration
var config_user = {
	grid_user: { 
        name : 'grid_user',
        header : 'Data User BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        toolbarAdd	: true,
	        toolbarDelete	: true,
	        lineNumbers: true
		},
		toolbar: {
			items: [
				{ type: 'break' },
				{ type: 'button', id: 'btn-details', caption: 'Details', icon: 'fa fa-eye' },
				{ type: 'button', id: 'btn-fullscreen', caption: 'Full', icon: 'fa fa-expand' }
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
            { field: 'recid', caption: 'ID User', size: '150px', searchable: true, sortable: true },
            { field: 'Username', caption: 'Username', size: '150px', searchable: true, sortable: true },
            { field: 'Password', caption: 'Password', size: '150px', searchable: true, sortable: true },
            { field: 'Level', caption: 'Level', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        //call_add_user(event.recid);
        },
        onDblClick: function (event) {
         	//call_edit_user(event.recid); 
			var grid = this;
			var form_edit_user = w2ui.form_edit_user;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_user.recid  = sel[0];
					form_edit_user.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_user.refresh();
				} else {
					form_edit_user.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_user'].getSelection();
			event.preventDefault();
			//call_delete_user(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_user'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_user'].add([
				{ recid: 0, name: 'Nomor Urut user:', value: record.Id_User },
				{ recid: 1, name: 'Username:', value: record.Username },
				{ recid: 2, name: 'Password:', value: record.Password },
				{ recid: 3, name: 'Level:', value: record.Level }
			]);
		}
	},
	grid_detail_user: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_user', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_user: {
		name: 'form_edit_user',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'ID User', attr: 'size="20" readonly' } },
			{ name: 'Username', type: 'text', required: true, html: { caption: 'Username', attr: 'size="20" maxlength="20"' } },
			{ name: 'Password', type: 'text', required: true, html: { caption: 'Password', attr: 'size="32" maxlength="32"' } },
			{ name: 'Level', type: 'int', html: { caption: 'Level', attr: 'size="5" maxlength="2"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_user'].set(data.records.Id_User, data.records);
						w2ui['grid_user'].refresh();
						w2ui['grid_user'].selectNone();
						w2ui['grid_detail_user'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_user: {
		name: 'form_add_user',
		fields: [
			{ name: 'Username', type: 'text', required: true, html: { caption: 'Username', attr: 'size="20" maxlength="20"' } },
			{ name: 'Password', type: 'text', required: true, html: { caption: 'Password', attr: 'size="32" maxlength="32"' } },
			{ name: 'Level', type: 'int', html: { caption: 'Level', attr: 'size="5" maxlength="1"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_user'].add(data.records);
						w2ui['grid_user'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	}
		
}

$(function () {
	$().w2form(config_user.form_add_user);
	$().w2form(config_user.form_edit_user);
	
});


function call_edit_user(recid) {
	$().w2popup('open', {
		title	: 'Edit user BMT',
		body	: '<div id="form_edit_user" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_user.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_user.box).show();
				w2ui.form_edit_user.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_user.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_user.box).show();
				w2ui.form_edit_user.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_user').w2render('form_edit_user');
				w2ui['form_edit_user'].url = {save: 'index.php/ctrl_user/update/'};
				
			}
		}
	});
	
}

function call_add_user(recid) {
	$().w2popup('open', {
		title	: 'Add User BMT',
		body	: '<div id="form_add_user" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_user.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_user.box).show();
				w2ui.form_add_user.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_user.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_user.box).show();
				w2ui.form_add_user.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_user').w2render('form_add_user');
				w2ui['form_add_user'].url = {save: 'index.php/ctrl_user/create/'};
				w2ui['form_add_user'].action('Reset');
			}
		}
	});
	
}

function call_delete_user(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_user/delete/' + delrecid,
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
							w2ui['grid_user'].remove(delrecid);
							w2ui['grid_detail_user'].clear();
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
		title	: 'Delete User BMT',
		body	: '<div id="form_popup_user" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_user').w2render('deletedialog');
			}
		},
	});	
	
}
</script>