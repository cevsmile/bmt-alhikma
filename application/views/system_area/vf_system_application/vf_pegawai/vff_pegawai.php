<script type="text/javascript">
// widget configuration
var config_pegawai = {
	grid_pegawai: { 
        name : 'grid_pegawai',
        header : 'Data Pegawai BMT AL-Hikma',
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
            { field: 'recid', caption: 'ID Pegawai', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '150px', searchable: true, sortable: true },
            { field: 'Alamat', caption: 'Alamat', size: '150px', searchable: true, sortable: true },
            { field: 'Nomor_KTP', caption: 'Nomor KTP', size: '100%', searchable: true, sortable: true },
            { field: 'Status', caption: 'Status', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_pegawai(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_pegawai(event.recid); 
			var grid = this;
			var form_pegawai = w2ui.form_edit_pegawai;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_pegawai.recid  = sel[0];
					form_pegawai.record = $.extend(true, {}, grid.get(sel[0]));
					form_pegawai.refresh();
				} else {
					form_pegawai.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_pegawai'].getSelection();
			event.preventDefault();
			call_delete_pegawai(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_pegawai'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_pegawai'].add([
				{ recid: 0, name: 'NIK:', value: record.NIK },
				{ recid: 1, name: 'Nama:', value: record.Nama },
				{ recid: 2, name: 'Alamat:', value: record.Alamat },
				{ recid: 3, name: 'Nomor KTP:', value: record.Nomor_KTP },
				{ recid: 4, name: 'Nomor SIM:', value: record.Nomor_SIM },
				{ recid: 5, name: 'Jenis Kelamin:', value: record.Jenis_Kelamin },
				{ recid: 6, name: 'Tanggal Masuk:', value: record.Tanggal_Masuk },
				{ recid: 7, name: 'Tanggal Keluar:', value: record.Tanggal_Keluar },
				{ recid: 8, name: 'Status:', value: record.Status }
			]);
		}		        
	},
	grid_detail_pegawai: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_pegawai', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_pegawai: {
		name: 'form_edit_pegawai',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'ID Pegawai', attr: 'size="10" readonly' } },
			{ name: 'Nama', type: 'textarea', html: { caption: 'Nama', attr: 'size="150" maxlength="150"' } },
			{ name: 'Alamat', type: 'textarea', html: { caption: 'Alamat', attr: 'size="200" maxlength="200"' } },
			{ name: 'Nomor_KTP', type: 'text', html: { caption: 'Nomor KTP', attr: 'size="20" maxlength="16"' } },
			{ name: 'Nomor_SIM', type: 'text', html: { caption: 'Nomor SIM', attr: 'size="20" maxlength="12"' } },
			{ name: 'Jenis_Kelamin', type: 'text', html: { caption: 'Jenis Kelamin', attr: 'size="20" maxlength="6"' } },
			{ name: 'Tanggal_Masuk', type: 'date', html: { caption: 'Tanggal Masuk'} },
			{ name: 'Tanggal_Keluar', type: 'date', html: { caption: 'Tanggal Keluar'} },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="2" maxlength="1"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_pegawai'].set(data.records.NIK, data.records);
						w2ui['grid_pegawai'].refresh();
						w2ui['grid_pegawai'].selectNone();
						w2ui['grid_detail_pegawai'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_pegawai: {
		name: 'form_add_pegawai',
		fields: [
			{ name: 'NIK', type: 'text', required: true, html: { caption: 'NIK', attr: 'size="10" ' } },
			{ name: 'Nama', type: 'textarea', html: { caption: 'Nama', attr: 'size="150" maxlength="150"' } },
			{ name: 'Alamat', type: 'textarea', html: { caption: 'Alamat', attr: 'size="200" maxlength="200"' } },
			{ name: 'Nomor_KTP', type: 'text', html: { caption: 'Nomor KTP', attr: 'size="20" maxlength="16"' } },
			{ name: 'Nomor_SIM', type: 'text', html: { caption: 'Nomor SIM', attr: 'size="20" maxlength="12"' } },
			{ name: 'Jenis_Kelamin', type: 'list',  options: { items: ['Pria', 'Wanita'] } },
			{ name: 'Tanggal_Masuk', type: 'date', html: { caption: 'Tanggal Masuk'} },
			{ name: 'Tanggal_Keluar', type: 'date', html: { caption: 'Tanggal Keluar'} },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="2" maxlength="1"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_pegawai'].add(data.records);
						w2ui['grid_pegawai'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	}
		
}

$(function () {
	$().w2form(config_pegawai.form_add_pegawai);
	$().w2form(config_pegawai.form_edit_pegawai);
	
});


function call_edit_pegawai(recid) {
	$().w2popup('open', {
		title	: 'Edit Pegawai',
		body	: '<div id="form_edit_pegawai" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_pegawai.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_pegawai.box).show();
				w2ui.form_edit_pegawai.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_pegawai.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_pegawai.box).show();
				w2ui.form_edit_pegawai.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_pegawai').w2render('form_edit_pegawai');
				w2ui['form_edit_pegawai'].url = {save: 'index.php/ctrl_pegawai/update/'};
				
			}
		}
	});
	
}

function call_add_pegawai(recid) {
	$().w2popup('open', {
		title	: 'Add Pegawai',
		body	: '<div id="form_add_pegawai" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_pegawai.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_pegawai.box).show();
				w2ui.form_add_pegawai.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_pegawai.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_pegawai.box).show();
				w2ui.form_add_pegawai.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_pegawai').w2render('form_add_pegawai');
				w2ui['form_add_pegawai'].url = {save: 'index.php/ctrl_pegawai/create/'};
				w2ui['form_add_pegawai'].action('Reset');
			}
		}
	});
	
}

function call_delete_pegawai(delrecid){
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
							w2ui['grid_pegawai'].remove(delrecid);
							w2ui['grid_detail_pegawai'].clear();
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
		body	: '<div id="form_popup_pegawai" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_pegawai').w2render('deletedialog');
			}
		},
	});	
	
}
</script>