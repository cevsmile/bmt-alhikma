<script type="text/javascript">
// widget configuration
var config_daftar_sandi = {
	layout_daftar_sandi: {
		name: 'layout_daftar_sandi',
		padding: 2,
		panels: [
			{ type: 'left', size: '50%', resizable: true, minSize: 50 },
			{ type: 'preview', size: '50%', resizable: true, minSize: 70 },
			{ type: 'main', size: '50%', resizable: true, minSize: 50 }
		]
	},

	grid_daftar_sandi: { 
        name : 'grid_daftar_sandi',
        header : 'Data Sandi BMT AL-Hikma',
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
						//w2ui['layout'].toggle('top', true);
						w2ui['layout'].toggle('left', true);
						w2ui['layout'].hide('right', true);
						//w2ui['layout'].toggle('bottom', true);
						break;
					case 'level-1-2':
						break;
				};
			}
		},
        columns: [
            { field: 'recid', caption: 'Kode Sandi', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_Sandi', caption: 'Nama Sandi', size: '150px', searchable: true, sortable: true },
            { field: 'Id_Daftar_Akun_Debit', caption: 'Akun Debit', size: '150px', searchable: true, sortable: true },
            { field: 'Id_Daftar_Akun_Kredit', caption: 'Akun Kredit', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_daftar_sandi(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_daftar_sandi(event.recid); 
			var grid = this;
			var form_edit_daftar_sandi = w2ui.form_edit_daftar_sandi;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_daftar_sandi.recid  = sel[0];
					form_edit_daftar_sandi.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_daftar_sandi.refresh();
				} else {
					form_edit_daftar_sandi.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_daftar_sandi'].getSelection();
			event.preventDefault();
			call_delete_daftar_sandi(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_daftar_sandi'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_daftar_sandi'].add([
				{ recid: 0, name: 'Kode Sandi:', value: record.Id_Daftar_Sandi},
				{ recid: 1, name: 'Nama Sandi:', value: record.Nama_Sandi },
				{ recid: 2, name: 'Akun Debit:', value: record.Id_Daftar_Akun_Debit },
				{ recid: 3, name: 'Akun Kredit:', value: record.Id_Daftar_Akun_Kredit }
			]);
		}
	},
	grid_detail_daftar_sandi: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_daftar_sandi', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_daftar_sandi: {
		name: 'form_edit_daftar_sandi',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Kode Sandi', attr: 'size="20" readonly' } },
			{ name: 'Nama_Sandi', type: 'text', required: true, html: { caption: 'Nama Sandi', attr: 'size="20" maxlength="20"' } },
			{ name: 'Id_Daftar_Akun_Debit', type: 'text', html: { caption: 'Akun Debit', attr: 'size="20" maxlength="20"' } },
			{ name: 'Id_Daftar_Akun_Kredit', type: 'text', html: { caption: 'Akun Kredit', attr: 'size="20" maxlength="20"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_sandi'].set(data.records.Id_Daftar_Sandi, data.records);
						w2ui['grid_daftar_sandi'].refresh();
						w2ui['grid_daftar_sandi'].selectNone();
						w2ui['grid_detail_daftar_sandi'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_daftar_sandi: {
		name: 'form_add_daftar_sandi',
		fields: [
			{ name: 'Id_Daftar_Sandi', type: 'text', required: true, html: { caption: 'Kode Sandi', attr: 'size="20"' } },
			{ name: 'Nama_Sandi', type: 'text', required: true, html: { caption: 'Nama Sandi', attr: 'size="20" maxlength="20"' } },
			{ name: 'Id_Daftar_Akun_Debit', type: 'text', required: true, html: { caption: 'Akun Debit', attr: 'size="20" maxlength="20" readonly' } },
			{ name: 'Id_Daftar_Akun_Kredit', type: 'text', required: true, html: { caption: 'Akun Kredit', attr: 'size="20" maxlength="20" readonly' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_sandi'].add(data.records);
						w2ui['grid_daftar_sandi'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	},
	grid_dt_akun_debit: { 
        name : 'grid_dt_akun_debit',
        header : 'Daftar Akun BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'Kode Akun', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_Akun', caption: 'Nama Akun', size: '100%', searchable: true, sortable: true }
		]
	},
	grid_dt_akun_kredit: { 
        name : 'grid_dt_akun_kredit',
        header : 'Daftar Akun BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'Kode Akun', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_Akun', caption: 'Nama Akun', size: '100%', searchable: true, sortable: true }
		]
	}
		
}

$(function () {
	//put grid to memory so we can re use it without have to destroy the object
	//in this case, we are not use this grid on this page, but with the control page
	$().w2grid(config_daftar_sandi.grid_daftar_sandi);
	$().w2grid(config_daftar_sandi.grid_detail_daftar_sandi);

	//initialize everything in memory. We can re-use it without destroying the object
	$().w2layout(config_daftar_sandi.layout_daftar_sandi);
	$().w2form(config_daftar_sandi.form_edit_daftar_sandi);
	$().w2form(config_daftar_sandi.form_add_daftar_sandi);
	$().w2grid(config_daftar_sandi.grid_dt_akun_debit);
	$().w2grid(config_daftar_sandi.grid_dt_akun_kredit);
	
});


function call_edit_daftar_sandi(recid) {
	w2ui.layout_daftar_sandi.content('left', w2ui.form_edit_daftar_sandi);
	w2ui.layout_daftar_sandi.content('main', w2ui.grid_dt_akun_debit);
	w2ui.layout_daftar_sandi.content('preview', w2ui.grid_dt_akun_kredit);

	load_data_to_grid_daftar_sandi();

	w2ui.grid_dt_akun_debit.on('click', function(event) {
		var grid = this;
		var form_edit_daftar_sandi = w2ui.form_edit_daftar_sandi;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_edit_daftar_sandi.record['Id_Daftar_Akun_Debit']  = sel[0];
				form_edit_daftar_sandi.refresh();
			} else {
				form_edit_daftar_sandi.clear();
			}
		}
	});
	
	w2ui.grid_dt_akun_kredit.on('click', function(event) {
		var grid = this;
		var form_edit_daftar_sandi = w2ui.form_edit_daftar_sandi;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_edit_daftar_sandi.record['Id_Daftar_Akun_Kredit']  = sel[0];
				form_edit_daftar_sandi.refresh();
			} else {
				form_edit_daftar_sandi.clear();
			}
		}
	});	
	
	$().w2popup('open', {
		title	: 'Edit Data Sandi BMT',
		body	: '<div id="popup_edit_daftar_sandi" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 700,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_daftar_sandi.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_daftar_sandi.box).show();
				w2ui.layout_daftar_sandi.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_daftar_sandi.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_daftar_sandi.box).show();
				w2ui.layout_daftar_sandi.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #popup_edit_daftar_sandi').w2render('layout_daftar_sandi');
				w2ui['form_edit_daftar_sandi'].url = {save: 'index.php/ctrl_daftar_sandi/update/'};
				
			}
		}
	});
	
}

function call_add_daftar_sandi(recid) {
	w2ui.layout_daftar_sandi.content('left', w2ui.form_add_daftar_sandi);
	w2ui.layout_daftar_sandi.content('main', w2ui.grid_dt_akun_debit);
	w2ui.layout_daftar_sandi.content('preview', w2ui.grid_dt_akun_kredit);

	load_data_to_grid_daftar_sandi();

	
	w2ui.grid_dt_akun_debit.on('click', function(event) {
		var grid = this;
		var form_add_daftar_sandi = w2ui.form_add_daftar_sandi;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_daftar_sandi.record['Id_Daftar_Akun_Debit']  = sel[0];
				form_add_daftar_sandi.refresh();
			} else {
				form_add_daftar_sandi.clear();
			}
		}
	});
	
	w2ui.grid_dt_akun_kredit.on('click', function(event) {
		var grid = this;
		var form_add_daftar_sandi = w2ui.form_add_daftar_sandi;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_daftar_sandi.record['Id_Daftar_Akun_Kredit']  = sel[0];
				form_add_daftar_sandi.refresh();
			} else {
				form_add_daftar_sandi.clear();
			}
		}
	});	
		
	$().w2popup('open', {
		title	: 'Add Daftar Sandi BMT',
		body	: '<div id="popup_add_daftar_sandi" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 700,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_daftar_sandi.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_daftar_sandi.box).show();
				w2ui.layout_daftar_sandi.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_daftar_sandi.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_daftar_sandi.box).show();
				w2ui.layout_daftar_sandi.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				
				$('#w2ui-popup #popup_add_daftar_sandi').w2render('layout_daftar_sandi');
				w2ui['form_add_daftar_sandi'].url = {save: 'index.php/ctrl_daftar_sandi/create/'};
				w2ui['form_add_daftar_sandi'].action('Reset');
			}
		}
	});
	
}

function call_delete_daftar_sandi(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_daftar_sandi/delete/' + delrecid,
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
							w2ui['grid_daftar_sandi'].remove(delrecid);
							w2ui['grid_detail_daftar_sandi'].clear();
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
		title	: 'Delete Daftar Sandi BMT',
		body	: '<div id="form_popup_daftar_sandi" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_daftar_sandi').w2render('deletedialog');
			}
		},
	});	
	
}


function load_data_to_grid_daftar_sandi(){
	w2ui['grid_dt_akun_debit'].load('index.php/ctrl_daftar_akun/read');
	w2ui['grid_dt_akun_debit'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_akun/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui['grid_dt_akun_kredit'].load('index.php/ctrl_daftar_akun/read');
	w2ui['grid_dt_akun_kredit'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_akun/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});	
}
</script>