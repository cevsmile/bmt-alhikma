<script type="text/javascript">
// widget configuration
var config_identitas_bmt = {
	grid_identitas_bmt: { 
        name : 'grid_identitas_bmt',
        header : 'Data Buku BMT AL-Hikma',
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
            { field: 'recid', caption: 'Kode Cabang', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_BMT', caption: 'Nama BMT', size: '150px', searchable: true, sortable: true },
            { field: 'Alamat_BMT', caption: 'Alamat BMT', size: '150px', searchable: true, sortable: true },
            { field: 'Status', caption: 'Status', size: '100%', searchable: true, sortable: true },
            { field: 'Nomor_Registrasi', caption: 'Nomor Registrasi', size: '100%', searchable: true, sortable: true },
            { field: 'Tgl_Pembukuan', caption: 'Tanggal Pembukuan', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_identitas_bmt(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_identitas_bmt(event.recid); 
			var grid = this;
			var form_edit_identitas_bmt = w2ui.form_edit_identitas_bmt;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_identitas_bmt.recid  = sel[0];
					form_edit_identitas_bmt.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_identitas_bmt.refresh();
				} else {
					form_edit_identitas_bmt.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_identitas_bmt'].getSelection();
			event.preventDefault();
			call_delete_identitas_bmt(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_identitas_bmt'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_identitas_bmt'].add([
				{ recid: 0, name: 'Kode Cabang:', value: record.Kode_Cabang },
				{ recid: 1, name: 'Nama BMT:', value: record.Nama_BMT },
				{ recid: 2, name: 'Alamat BMT:', value: record.Alamat_BMT },
				{ recid: 3, name: 'Status:', value: record.Status },
				{ recid: 5, name: 'Nomor Registrasi:', value: record.Nomor_Registrasi },
				{ recid: 6, name: 'Tanggal Pembukuan:', value: record.Tgl_Pembukuan }
			]);
		}		        
	},
	grid_detail_identitas_bmt: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_identitas_bmt', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_identitas_bmt: {
		name: 'form_edit_identitas_bmt',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="3" readonly' } },
			{ name: 'Nama_BMT', type: 'textarea', html: { caption: 'Nama BMT', attr: 'size="200" maxlength="200"' } },
			{ name: 'Alamat_BMT', type: 'textarea',html: { caption: 'Alamat BMT', attr: 'size="200" maxlength="200"' } },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="20"' } },
			{ name: 'Nomor_Registrasi', type: 'text', html: { caption: 'Nomor SIM', attr: 'size="20"' } },
			{ name: 'Tgl_Pembukuan', type: 'date', required: true, html: { caption: 'Tanggal Pembukuan'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						//menumpuk baris data lama dengan data baru dari controller
						w2ui['grid_identitas_bmt'].set(data.records.Kode_Cabang, data.records);
						w2ui['grid_identitas_bmt'].refresh();
						w2ui['grid_identitas_bmt'].selectNone();
						w2ui['grid_detail_identitas_bmt'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_identitas_bmt: {
		name: 'form_add_identitas_bmt',
		fields: [
			{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="3"' } },
			{ name: 'Nama_BMT', type: 'textarea', html: { caption: 'Nama BMT', attr: 'size="200" maxlength="200"' } },
			{ name: 'Alamat_BMT', type: 'textarea', html: { caption: 'Alamat BMT', attr: 'size="200" maxlength="200"' } },
			{ name: 'Status', type: 'text', html: { caption: 'Status', attr: 'size="10"' } },
			{ name: 'Nomor_Registrasi', type: 'text', html: { caption: 'Nomor Registrasi', attr: 'size="10"' } },
			{ name: 'Tgl_Pembukuan', type: 'date', required: true, html: { caption: 'Tanggal Pembukuan'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_identitas_bmt'].add(data.records);
						w2ui['grid_identitas_bmt'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	}
		
}

$(function () {
	//put grid to memory so we can re use it without have to destroy the object
	//in this case, we are not use this grid on this page, but with the control page
	$().w2grid(config_identitas_bmt.grid_identitas_bmt);
	$().w2grid(config_identitas_bmt.grid_detail_identitas_bmt);

	//initialize fom in memory. We can re-use it without destroying the object
	$().w2form(config_identitas_bmt.form_add_identitas_bmt);
	$().w2form(config_identitas_bmt.form_edit_identitas_bmt);
});


function call_edit_identitas_bmt(recid) {
	$().w2popup('open', {
		title	: 'Edit Identitas BMT',
		body	: '<div id="form_edit_identitas_bmt" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_identitas_bmt.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_identitas_bmt.box).show();
				w2ui.form_edit_identitas_bmt.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_identitas_bmt.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_identitas_bmt.box).show();
				w2ui.form_edit_identitas_bmt.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_identitas_bmt').w2render('form_edit_identitas_bmt');
				w2ui['form_edit_identitas_bmt'].url = {save: 'index.php/ctrl_identitas_bmt/update/'};
				w2ui['form_edit_identitas_bmt'].refresh();
				
			}
		}
	});
	
}

function call_add_identitas_bmt(recid) {
	$().w2popup('open', {
		title	: 'Add Identitas BMT',
		body	: '<div id="form_add_identitas_bmt" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_identitas_bmt.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_identitas_bmt.box).show();
				w2ui.form_add_identitas_bmt.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_identitas_bmt.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_identitas_bmt.box).show();
				w2ui.form_add_identitas_bmt.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_identitas_bmt').w2render('form_add_identitas_bmt');
				w2ui['form_add_identitas_bmt'].url = {save: 'index.php/ctrl_identitas_bmt/create/'};
				w2ui['form_add_identitas_bmt'].action('Reset');
			}
		}
	});
	
}

function call_delete_identitas_bmt(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_identitas_bmt/delete/' + delrecid,
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
							w2ui['grid_identitas_bmt'].remove(delrecid);
							w2ui['grid_detail_identitas_bmt'].clear();
							$().w2popup('close');
						}
					});
				},
				"cancel": function () {
					$().w2popup('close');
				}
			}
	}); 
	
	$().w2popup('open', {
		title	: 'Delete Identitas BMT',
		body	: '<div id="form_popup_identitas_bmt" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_identitas_bmt').w2render('deletedialog');
			}
		},
	});	
	
}
</script>