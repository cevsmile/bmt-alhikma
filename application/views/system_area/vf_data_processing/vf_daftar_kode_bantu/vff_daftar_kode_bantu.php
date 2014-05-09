<script type="text/javascript">
// widget configuration
var config_daftar_kode_bantu = {
	grid_daftar_kode_bantu: { 
        name : 'grid_daftar_kode_bantu',
        header : 'Daftar Akun BMT AL-Hikma',
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
				{ type: 'button', id: 'btn-fullscreen', caption: 'Full', icon: 'fa  fa-expand' }
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
            { field: 'recid', caption: 'Kode Pembantu', size: '150px', searchable: true, sortable: true },
            { field: 'Nomor_Urut_Supplier', caption: 'Nomor Urut Supplier', size: '150px', searchable: true, sortable: true },
            { field: 'Kode_Cabang', caption: 'Kode Cabang', size: '150px', searchable: true, sortable: true },
            { field: 'Kode_Akun', caption: 'Kode Akun', size: '100%', searchable: true, sortable: true },
            { field: 'No_Urut_Nasabah', caption: 'Nomor Urut Nasabah', size: '100%', searchable: true, sortable: true },
            { field: 'NIK', caption: 'Nomor Induk Kepegawaian', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_daftar_kode_bantu(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_daftar_kode_bantu(event.recid); 
			var grid = this;
			var form_edit_daftar_kode_bantu = w2ui.form_edit_daftar_kode_bantu;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_daftar_kode_bantu.recid  = sel[0];
					form_edit_daftar_kode_bantu.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_daftar_kode_bantu.refresh();
				} else {
					form_edit_daftar_kode_bantu.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_daftar_kode_bantu'].getSelection();
			event.preventDefault();
			call_delete_daftar_kode_bantu(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_daftar_kode_bantu'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_daftar_kode_bantu'].add([
				{ recid: 0, name: 'Kode Pembantu:', value: record.Kode_Pembantu },
				{ recid: 1, name: 'Nomor Urut Supplier:', value: record.Nomor_Urut_Supplier },
				{ recid: 2, name: 'Kode Cabang:', value: record.Kode_Cabang },
				{ recid: 3, name: 'Kode Akun:', value: record.Kode_Akun },
				{ recid: 5, name: 'Nomor Urut Nasabah:', value: record.No_Urut_Nasabah },
				{ recid: 6, name: 'Nomor Induk Kepegawaian:', value: record.NIK }
			]);
		}
	},
	grid_detail_daftar_kode_bantu: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_daftar_kode_bantu', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_daftar_kode_bantu: {
		name: 'form_edit_daftar_kode_bantu',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Kode Pembantu', attr: 'size="10" readonly' } },
			{ name: 'Nomor_Urut_Supplier', type: 'text', required: true, html: { caption: 'Nomor Urut Supplier', attr: 'size="40" maxlength="40"' } },
			{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="5" maxlength="2"' } },
			{ name: 'Kode_Akun', type: 'text', html: { caption: 'Kode Akun', attr: 'size="5" maxlength="2"' } },
			{ name: 'No_Urut_Nasabah', type: 'int', html: { caption: 'Nomor Urut Nasabah'} },
			{ name: 'NIK', type: 'int', required: true, html: { caption: 'Nomor Induk Kepegawaian'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_kode_bantu'].set(data.records.Kode_Pembantu, data.records);
						w2ui['grid_daftar_kode_bantu'].refresh();
						w2ui['grid_daftar_kode_bantu'].selectNone();
						w2ui['grid_detail_daftar_kode_bantu'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_daftar_kode_bantu: {
		name: 'form_add_daftar_kode_bantu',
		fields: [
			{ name: 'Kode_Pembantu', type: 'text', required: true, html: { caption: 'Kode Pembantu', attr: 'size="10"' } },
			{ name: 'Nomor_Urut_Supplier', type: 'text', required: true, html: { caption: 'Nomor Urut Supplier', attr: 'size="40" maxlength="40"' } },
			{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="5" maxlength="2"' } },
			{ name: 'Kode_Akun', type: 'text', html: { caption: 'Kode Akun', attr: 'size="5" maxlength="2"' } },
			{ name: 'No_Urut_Nasabah', type: 'int', html: { caption: 'Nomor Urut Nasabah'} },
			{ name: 'NIK', type: 'int', html: { caption: 'Nomor Induk Kepegawaian'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_kode_bantu'].add(data.records);
						w2ui['grid_daftar_kode_bantu'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	}
		
}

$(function () {
	$().w2form(config_daftar_kode_bantu.form_add_daftar_kode_bantu);
	$().w2form(config_daftar_kode_bantu.form_edit_daftar_kode_bantu);
	
});


function call_edit_daftar_kode_bantu(recid) {
	$().w2popup('open', {
		title	: 'Edit Daftar Akun BMT',
		body	: '<div id="form_edit_daftar_kode_bantu" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_daftar_kode_bantu.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_daftar_kode_bantu.box).show();
				w2ui.form_edit_daftar_kode_bantu.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_daftar_kode_bantu.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_daftar_kode_bantu.box).show();
				w2ui.form_edit_daftar_kode_bantu.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_daftar_kode_bantu').w2render('form_edit_daftar_kode_bantu');
				w2ui['form_edit_daftar_kode_bantu'].url = {save: 'index.php/ctrl_daftar_kode_bantu/update/'};
				
			}
		}
	});
	
}

function call_add_daftar_kode_bantu(recid) {
	$().w2popup('open', {
		title	: 'Add Kode Akun BMT',
		body	: '<div id="form_add_daftar_kode_bantu" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_daftar_kode_bantu.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_daftar_kode_bantu.box).show();
				w2ui.form_add_daftar_kode_bantu.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_daftar_kode_bantu.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_daftar_kode_bantu.box).show();
				w2ui.form_add_daftar_kode_bantu.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_daftar_kode_bantu').w2render('form_add_daftar_kode_bantu');
				w2ui['form_add_daftar_kode_bantu'].url = {save: 'index.php/ctrl_daftar_kode_bantu/create/'};
				w2ui['form_add_daftar_kode_bantu'].action('Reset');
			}
		}
	});
	
}

function call_delete_daftar_kode_bantu(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_daftar_kode_bantu/delete/' + delrecid,
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
							w2ui['grid_daftar_kode_bantu'].remove(delrecid);
							w2ui['grid_detail_daftar_kode_bantu'].clear();
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
		title	: 'Delete Kode Akun BMT',
		body	: '<div id="form_popup_daftar_kode_bantu" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_daftar_kode_bantu').w2render('deletedialog');
			}
		},
	});	
	
}
</script>