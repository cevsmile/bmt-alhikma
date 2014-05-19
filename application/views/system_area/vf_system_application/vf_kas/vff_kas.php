<script type="text/javascript">
// widget configuration
var config_kas = {
	layout_kas: {
		name: 'layout_kas',
		padding: 2,
		panels: [
			{ type: 'main', size: '50%', resizable: true, minSize: 2 },
			{ type: 'right', size: '50%', resizable: true, minSize: 2, hidden: true },
		]
	},

	grid_kas: { 
        name : 'grid_kas',
        header : 'Data KAS BMT AL-Hikma',
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
            { field: 'recid', caption: 'Kode No. Rekening', size: '150px', searchable: true, sortable: true },
            { field: 'Id_Daftar_Sandi', caption: 'Id Daftar Sandi', size: '150px', searchable: true, sortable: true },
            { field: 'Validasi', caption: 'Validasi', size: '150px', searchable: true, sortable: true },
            { field: 'Jumlah', caption: 'Jumlah', size: '100%', searchable: true, sortable: true },
            { field: 'Log_Date', caption: 'Tanggal', size: '100%', searchable: true, sortable: true },
            { field: 'Log_Time', caption: 'Jam', size: '100%', searchable: true, sortable: true },
            { field: 'Log_User', caption: 'Kasir', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_kas(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_kas(event.recid); 
			var grid = this;
			var form_edit_kas = w2ui.form_edit_kas;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_kas.recid  = sel[0];
					form_edit_kas.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_kas.refresh();
				} else {
					form_edit_kas.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_kas'].getSelection();
			event.preventDefault();
			call_delete_kas(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_kas'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_kas'].add([
				{ recid: 0, name: 'Nomor Rekening:', value: record.Kode_Norek},
				{ recid: 1, name: 'Sandi:', value: record.Id_Daftar_Sandi },
				{ recid: 2, name: 'Sandi:', value: record.Validasi },
				{ recid: 3, name: 'Jumlah:', value: record.Jumlah },
				{ recid: 4, name: 'Tanggal:', value: record.Log_Date },
				{ recid: 5, name: 'Jam:', value: record.Log_Time },
				{ recid: 6, name: 'Kasir:', value: record.Log_User }
			]);
		}
	},
	grid_detail_kas: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_kas', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_kas: {
		name: 'form_edit_kas',
		fields: [
            { field: 'recid', caption: 'Kode No. Rekening', size: '150px', searchable: true, sortable: true },
            { field: 'Id_Daftar_Sandi', caption: 'Id Daftar Sandi', size: '150px', searchable: true, sortable: true },
            { field: 'Validasi', caption: 'Validasi', size: '150px', searchable: true, sortable: true },
            { field: 'Jumlah', caption: 'Jumlah', size: '100%', searchable: true, sortable: true }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						/*
						w2ui['grid_kas'].set(data.records.Kode_Norek, data.records);
						w2ui['grid_kas'].refresh();
						w2ui['grid_kas'].selectNone();
						w2ui['grid_detail_kas'].clear();
						*/
						w2ui['grid_kas'].load('index.php/ctrl_kas/read');
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_kas: {
		name: 'form_add_kas',
		fields: [
			{ name: 'Kode_Norek', type: 'text', required: true, html: { caption: 'No. Rekening', attr: 'size="20" maxlength="20" onclick="openPopup_Kode_Norek()"' } },
			{ name: 'Id_Daftar_Sandi', type: 'text', required: true, html: { caption: 'Daftar Sandi', attr: 'size="20" maxlength="20" onclick="openPopup_Id_Daftar_Sandi()"' } },
			{ name: 'Validasi', type: 'text', html: { caption: 'Validasi', attr: 'size="20" maxlength="20"' } },
			{ name: 'Jumlah', type: 'int', html: { caption: 'Jumlah', attr: 'size="20" maxlength="20"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_kas'].load('index.php/ctrl_kas/read');
						//w2ui['grid_kas'].add(data.records);
						//w2ui['grid_kas'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	},
	grid_dt_nomor_rekening: { 
        name : 'grid_dt_nomor_rekening',
        header : 'Daftar Nomor Rekening BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'No. Rekening', size: '150px', searchable: true, sortable: true }
		]
	},
	grid_dt_daftar_sandi: { 
        name : 'grid_dt_daftar_sandi',
        header : 'Daftar Sandi BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'Sandi', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_Sandi', caption: 'Nama Sandi', size: '100%', searchable: true, sortable: true }
		]
	}

}

$(function () {


});






function call_edit_kas(recid) {

	$().w2destroy('layout_kas');
	$().w2destroy('form_edit_kas');

	$().w2layout(config_kas.layout_kas);
	w2ui.layout_kas.content('main', $().w2form(config_kas.form_edit_kas));

	$().w2popup('open', {
		title	: 'Edit Data Sandi BMT',
		body	: '<div id="popup_edit_kas" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 700,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_kas.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_kas.box).show();
				w2ui.layout_kas.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_kas.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_kas.box).show();
				w2ui.layout_kas.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #popup_edit_kas').w2render('layout_kas');
				w2ui['form_edit_kas'].url = {save: 'index.php/ctrl_kas/update/'};
				
			}
		}
	});
	
}

function call_add_kas(recid) {
	$().w2destroy('layout_kas');
	$().w2destroy('form_add_kas');
	
	$().w2layout(config_kas.layout_kas);
	w2ui.layout_kas.content('main', $().w2form(config_kas.form_add_kas));


	$().w2popup('open', {
		title	: 'Add KAS BMT',
		body	: '<div id="popup_add_kas" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 800,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_kas.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_kas.box).show();
				w2ui.layout_kas.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_kas.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_kas.box).show();
				w2ui.layout_kas.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				
				$('#w2ui-popup #popup_add_kas').w2render('layout_kas');
				w2ui['form_add_kas'].url = {save: 'index.php/ctrl_kas/create/'};
			}
		}
	});
	
}





function call_delete_kas(delrecid){
	console.log(delrecid);
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_kas/delete/' + delrecid,
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
							w2ui['grid_kas'].remove(delrecid);
							w2ui['grid_detail_kas'].clear();
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
		title	: 'Delete KAS BMT',
		body	: '<div id="form_popup_kas" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_kas').w2render('deletedialog');
			}
		},
	});	
}






function openPopup_Kode_Norek(){
	$().w2destroy('grid_dt_nomor_rekening');
	w2ui.layout_kas.content('right', $().w2grid(config_kas.grid_dt_nomor_rekening));

	w2ui['grid_dt_nomor_rekening'].load('index.php/ctrl_nomor_rekening/read');
	w2ui['grid_dt_nomor_rekening'].on('reload', function(event) {
		this.load('index.php/ctrl_nomor_rekening/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_kas.show('right', true);
	
	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_nomor_rekening.on('click', function(event) {
		var grid = this;
		var form_add_kas = w2ui.form_add_kas;
		event.onComplete = function () {
			var sel = grid.getSelection();
			
			if (sel.length == 1) {
				//both of this similiar line is same
				form_add_kas.record.Kode_Norek = sel[0];
				form_add_kas.refresh();

			} else {
				form_add_kas.clear();
			}
		}
	});

}

function openPopup_Id_Daftar_Sandi(){
	$().w2destroy('grid_dt_daftar_sandi');
	w2ui.layout_kas.content('right', $().w2grid(config_kas.grid_dt_daftar_sandi));

	w2ui['grid_dt_daftar_sandi'].load('index.php/ctrl_daftar_sandi/read');
	w2ui['grid_dt_daftar_sandi'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_sandi/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_kas.show('right', true);

	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_daftar_sandi.on('click', function(event) {
		var grid = this;
		var form_add_kas = w2ui.form_add_kas;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_kas.record.Id_Daftar_Sandi  = sel[0];
				form_add_kas.refresh();
			} else {
				form_add_kas.clear();
			}
		}
	});


}



</script>