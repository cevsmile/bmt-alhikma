<script type="text/javascript">
// widget configuration
var config_daftar_akun = {
	grid_daftar_akun: { 
        name : 'grid_daftar_akun',
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
            { field: 'recid', caption: 'Kode Akun', size: '50px', searchable: true, sortable: true },
            { field: 'Nama_Akun', caption: 'Nama Akun', size: '100%', searchable: true, sortable: true },
            { field: 'Akun_DK', caption: 'Posisi D/K', size: '150px', searchable: true, sortable: true },
            { field: 'Akun_NR_LR', caption: 'Neraca Lajur/Laba Rugi', size: '150px', searchable: true, sortable: true },
            { field: 'Jumlah_Debit', caption: 'Jumlah Debit', size: '100px', searchable: true, sortable: true },
            { field: 'Jumlah_Kredit', caption: 'Jumlah Kredit', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_daftar_akun(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_daftar_akun(event.recid); 
			var grid = this;
			var form_edit_daftar_akun = w2ui.form_edit_daftar_akun;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_daftar_akun.recid  = sel[0];
					form_edit_daftar_akun.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_daftar_akun.refresh();
				} else {
					form_edit_daftar_akun.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_daftar_akun'].getSelection();
			event.preventDefault();
			call_delete_daftar_akun(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_daftar_akun'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_daftar_akun'].add([
				{ recid: 0, name: 'Kode Akun:', value: record.Id_Daftar_Akun },
				{ recid: 1, name: 'Nama Akun:', value: record.Nama_Akun },
				{ recid: 2, name: 'Akun D/K:', value: record.Akun_DK },
				{ recid: 3, name: 'Akun NR/LR:', value: record.Akun_NR_LR },
				{ recid: 5, name: 'Debit:', value: record.Jumlah_Debit },
				{ recid: 6, name: 'Kredit:', value: record.Jumlah_Kredit }
			]);
		}
	},
	grid_detail_daftar_akun: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_daftar_akun', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_daftar_akun: {
		name: 'form_edit_daftar_akun',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Kode Akun', attr: 'size="10" readonly' } },
			{ name: 'Nama_Akun', type: 'text', html: { caption: 'Nama Akun', attr: 'size="40" maxlength="40"' } },
			{ name: 'Akun_DK', type: 'text', html: { caption: 'Akun D/K', attr: 'size="5" maxlength="2"' } },
			{ name: 'Akun_NR_LR', type: 'text', html: { caption: 'Neraca Lajur/Laba Rugi', attr: 'size="5" maxlength="2"' } },
			{ name: 'Jumlah_Debit', type: 'int', html: { caption: 'Jumlah di Debit'} },
			{ name: 'Jumlah_Kredit', type: 'int', html: { caption: 'Jumlah di Kredit'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_akun'].set(data.records.Id_Daftar_Akun, data.records);
						w2ui['grid_daftar_akun'].refresh();
						w2ui['grid_daftar_akun'].selectNone();
						w2ui['grid_detail_daftar_akun'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_daftar_akun: {
		name: 'form_add_daftar_akun',
		fields: [
			{ name: 'Id_Daftar_Akun', type: 'text', required: true, html: { caption: 'Kode Akun', attr: 'size="10"' } },
			{ name: 'Nama_Akun', type: 'text', html: { caption: 'Nama Akun', attr: 'size="40" maxlength="40"' } },
			{ name: 'Akun_DK', type: 'text', html: { caption: 'Akun DK', attr: 'size="5" maxlength="2"' } },
			{ name: 'Akun_NR_LR', type: 'text', html: { caption: 'Neraca Lajur/Laba Rugi', attr: 'size="5" maxlength="2"' } },
			{ name: 'Jumlah_Debit', type: 'int', html: { caption: 'Jumlah Debit'} },
			{ name: 'Jumlah_Kredit', type: 'int', html: { caption: 'Jumlah Kredit'} }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_daftar_akun'].add(data.records);
						w2ui['grid_daftar_akun'].selectNone();
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
	$().w2grid(config_daftar_akun.grid_daftar_akun);
	$().w2grid(config_daftar_akun.grid_detail_daftar_akun);
	
	//initialize fom in memory. We can re-use it without destroying the object
	$().w2form(config_daftar_akun.form_add_daftar_akun);
	$().w2form(config_daftar_akun.form_edit_daftar_akun);
	
});


function call_edit_daftar_akun(recid) {
	$().w2popup('open', {
		title	: 'Edit Daftar Akun BMT',
		body	: '<div id="form_edit_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_daftar_akun.box).show();
				w2ui.form_edit_daftar_akun.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_daftar_akun.box).show();
				w2ui.form_edit_daftar_akun.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_daftar_akun').w2render('form_edit_daftar_akun');
				w2ui['form_edit_daftar_akun'].url = {save: 'index.php/ctrl_daftar_akun/update/'};
				
			}
		}
	});
	
}

function call_add_daftar_akun(recid) {
	$().w2popup('open', {
		title	: 'Add Kode Akun BMT',
		body	: '<div id="form_add_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_daftar_akun.box).show();
				w2ui.form_add_daftar_akun.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_daftar_akun.box).show();
				w2ui.form_add_daftar_akun.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_daftar_akun').w2render('form_add_daftar_akun');
				w2ui['form_add_daftar_akun'].url = {save: 'index.php/ctrl_daftar_akun/create/'};
				w2ui['form_add_daftar_akun'].action('Reset');
			}
		}
	});
	
}

function call_delete_daftar_akun(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_daftar_akun/delete/' + delrecid,
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
							w2ui['grid_daftar_akun'].remove(delrecid);
							w2ui['grid_detail_daftar_akun'].clear();
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
		body	: '<div id="form_popup_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_daftar_akun').w2render('deletedialog');
			}
		},
	});	
	
}
</script>