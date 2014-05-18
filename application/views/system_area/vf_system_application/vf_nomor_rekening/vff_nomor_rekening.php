<script type="text/javascript">
// widget configuration
var config_nomor_rekening = {
	layout_nomor_rekening: {
		name: 'layout_nomor_rekening',
		padding: 2,
		panels: [
			{ type: 'main', size: '50%', resizable: true, minSize: 2 },
			{ type: 'right', size: '50%', resizable: true, minSize: 2, hidden: true },
		]
	},

	grid_nomor_rekening: { 
        name : 'grid_nomor_rekening',
        header : 'Data Nomor Rekening BMT AL-Hikma',
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
            { field: 'recid', caption: 'Kode Nomor Rekening', size: '150px', searchable: true, sortable: true },
            { field: 'Kode_Cabang', caption: 'Kode Cabang', size: '100px', searchable: true, sortable: true },
            { field: 'Id_Daftar_Akun', caption: 'ID Daftar AKun', size: '100px', searchable: true, sortable: true },
            { field: 'Id_Nasabah', caption: 'ID Nasabah', size: '100px', searchable: true, sortable: true },
            { field: 'Id_Supplier', caption: 'ID Supplier', size: '100px', searchable: true, sortable: true },
            { field: 'NIK', caption: 'NIK Pegawai', size: '100px', searchable: true, sortable: true },
            { field: 'Saldo_Awal', caption: 'Saldo Awal', size: '100px', searchable: true, sortable: true },
            { field: 'Saldo_Akhir', caption: 'Saldo Akhir', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_nomor_rekening(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_nomor_rekening(event.recid); 
			var grid = this;
			var form_edit_nomor_rekening = w2ui.form_edit_nomor_rekening;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_nomor_rekening.recid  = sel[0];
					form_edit_nomor_rekening.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_nomor_rekening.refresh();
				} else {
					form_edit_nomor_rekening.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_nomor_rekening'].getSelection();
			event.preventDefault();
			call_delete_nomor_rekening(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_nomor_rekening'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_nomor_rekening'].add([
				{ recid: 0, name: 'Nomor Rekening:', value: record.Kode_Norek},
				{ recid: 1, name: 'Kode Cabang:', value: record.Kode_Cabang },
				{ recid: 2, name: 'ID Daftar Akun:', value: record.Id_Daftar_Akun },
				{ recid: 3, name: 'ID Nasabah:', value: record.Id_Nasabah },
				{ recid: 4, name: 'ID Supplier:', value: record.Id_Supplier },
				{ recid: 5, name: 'NIK:', value: record.NIK },
				{ recid: 6, name: 'Saldo Awal:', value: record.Saldo_Awal },
				{ recid: 7, name: 'Saldo Akhir:', value: record.Saldo_Akhir },				
				{ recid: 8, name: 'Tgl Direkam:', value: record.Log_Date },
				{ recid: 9, name: 'Jam Direkam:', value: record.Log_Time },
				{ recid: 10, name: 'Penginput Data:', value: record.Log_User }
			]);
		}
	},
	grid_detail_nomor_rekening: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_nomor_rekening', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_nomor_rekening: {
		name: 'form_edit_nomor_rekening',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Nomor Rekening', attr: 'size="20" readonly ' } },
			//{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Kode_Cabang()"' } },
			//{ name: 'Id_Daftar_Akun', type: 'text', required: true, html: { caption: 'Daftar Akun', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Daftar_Akun()"' } },
			//{ name: 'Id_Nasabah', type: 'text', html: { caption: 'ID Nasabah', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Nasabah()"' } },
			//{ name: 'Id_Supplier', type: 'text', html: { caption: 'ID Supplier', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Supplier()"' } },
			//{ name: 'NIK', type: 'text', html: { caption: 'NIK', attr: 'size="20" maxlength="20" readonly onclick="openPopup_NIK()"' } },
			{ name: 'Saldo_Awal', type: 'text', html: { caption: 'Saldo Awal' } },
			{ name: 'Saldo_Akhir', type: 'text', html: { caption: 'Saldo Akhir' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						/*
						w2ui['grid_nomor_rekening'].set(data.records.Kode_Norek, data.records);
						w2ui['grid_nomor_rekening'].refresh();
						w2ui['grid_nomor_rekening'].selectNone();
						w2ui['grid_detail_nomor_rekening'].clear();
						*/
						w2ui['grid_nomor_rekening'].load('index.php/ctrl_nomor_rekening/read');
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_nomor_rekening: {
		name: 'form_add_nomor_rekening',
		fields: [
			{ name: 'Kode_Norek', type: 'text', required: true, html: { caption: 'Nomor Rekening', attr: 'size="20" readonly ' } },
			{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Kode_Cabang()"' } },
			{ name: 'Id_Daftar_Akun', type: 'text', required: true, html: { caption: 'Daftar Akun', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Daftar_Akun()"' } },
			{ name: 'Id_Nasabah', type: 'text', html: { caption: 'ID Nasabah', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Nasabah()"' } },
			{ name: 'Id_Supplier', type: 'text', html: { caption: 'ID Supplier', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Supplier()"' } },
			{ name: 'NIK', type: 'text', html: { caption: 'NIK', attr: 'size="20" maxlength="20" readonly onclick="openPopup_NIK()"' } },
			{ name: 'Saldo_Awal', type: 'text', html: { caption: 'Saldo Awal' } },
			{ name: 'Saldo_Akhir', type: 'text', html: { caption: 'Saldo Akhir' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_nomor_rekening'].load('index.php/ctrl_nomor_rekening/read');
						//w2ui['grid_nomor_rekening'].add(data.records);
						//w2ui['grid_nomor_rekening'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	},
	grid_dt_identitas_bmt: { 
        name : 'grid_dt_identitas_bmt',
        header : 'Profil/Identitas BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'Kode Cabang', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_BMT', caption: 'Nama BMT', size: '100%', searchable: true, sortable: true }
		]
	},
	grid_dt_daftar_akun: { 
        name : 'grid_dt_daftar_akun',
        header : 'Daftar Akun BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'ID Daftar Akun', size: '150px', searchable: true, sortable: true },
            { field: 'Nama_Akun', caption: 'Nama', size: '100%', searchable: true, sortable: true }
		]
	},
	grid_dt_nasabah: { 
        name : 'grid_dt_nasabah',
        header : 'Daftar Nasabah BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'ID Nasabah', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '100%', searchable: true, sortable: true }
		]
	},
	grid_dt_supplier: { 
        name : 'grid_dt_supplier',
        header : 'Daftar Supplier BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'ID Supplier', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '100%', searchable: true, sortable: true }
		]
	},
	grid_dt_pegawai: { 
        name : 'grid_dt_pegawai',
        header : 'Daftar Pegawai BMT AL-Hikma',
		show : {
			toolbar : true,
	        header : true,
	        footer : true,
	        lineNumbers: true
		},
        columns: [
            { field: 'recid', caption: 'Nomor Induk Kepegawaian', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '100%', searchable: true, sortable: true }
		]
	}

}

$(function () {


});






function call_edit_nomor_rekening(recid) {

	$().w2destroy('layout_nomor_rekening');
	$().w2destroy('form_edit_nomor_rekening');
	$().w2destroy('grid_dt_akun_debit');
	$().w2destroy('grid_dt_akun_kredit');
	
	$().w2layout(config_nomor_rekening.layout_nomor_rekening);
	w2ui.layout_nomor_rekening.content('main', $().w2form(config_nomor_rekening.form_edit_nomor_rekening));

	$().w2popup('open', {
		title	: 'Edit Data Sandi BMT',
		body	: '<div id="popup_edit_nomor_rekening" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 700,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_nomor_rekening.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening.box).show();
				w2ui.layout_nomor_rekening.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_nomor_rekening.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening.box).show();
				w2ui.layout_nomor_rekening.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #popup_edit_nomor_rekening').w2render('layout_nomor_rekening');
				w2ui['form_edit_nomor_rekening'].url = {save: 'index.php/ctrl_nomor_rekening/update/'};
				
			}
		}
	});
	
}

function call_add_nomor_rekening(recid) {
	$().w2destroy('layout_nomor_rekening');
	$().w2destroy('form_add_nomor_rekening');
	$().w2destroy('grid_dt_akun_debit');
	$().w2destroy('grid_dt_akun_kredit');
	
	$().w2layout(config_nomor_rekening.layout_nomor_rekening);
	w2ui.layout_nomor_rekening.content('main', $().w2form(config_nomor_rekening.form_add_nomor_rekening));


	//re populating string
	w2ui.form_add_nomor_rekening.on('refresh', function () {
		var Kode_Cabang = [this.record.Kode_Cabang],
			Id_Daftar_Akun = [this.record.Id_Daftar_Akun],
			Id_Nasabah = [this.record.Id_Nasabah],
			Id_Supplier = [this.record.Id_Supplier],
			NIK = [this.record.NIK];
		
		this.record.Kode_Norek = Kode_Cabang+'.'+Id_Daftar_Akun+'.'+Id_Nasabah+Id_Supplier+NIK;
	});				
	
	$().w2popup('open', {
		title	: 'Add Daftar Sandi BMT',
		body	: '<div id="popup_add_nomor_rekening" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 800,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_nomor_rekening.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening.box).show();
				w2ui.layout_nomor_rekening.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_nomor_rekening.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening.box).show();
				w2ui.layout_nomor_rekening.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				
				$('#w2ui-popup #popup_add_nomor_rekening').w2render('layout_nomor_rekening');
				w2ui['form_add_nomor_rekening'].url = {save: 'index.php/ctrl_nomor_rekening/create/'};
			}
		}
	});
	
}





function call_delete_nomor_rekening(delrecid){
	console.log(delrecid);
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_nomor_rekening/delete/' + delrecid,
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
							w2ui['grid_nomor_rekening'].remove(delrecid);
							w2ui['grid_detail_nomor_rekening'].clear();
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
		title	: 'Delete Daftar Sandi BMT',
		body	: '<div id="form_popup_nomor_rekening" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_nomor_rekening').w2render('deletedialog');
			}
		},
	});	
}






function openPopup_Kode_Cabang(){
	$().w2destroy('grid_dt_identitas_bmt');
	w2ui.layout_nomor_rekening.content('right', $().w2grid(config_nomor_rekening.grid_dt_identitas_bmt));

	w2ui['grid_dt_identitas_bmt'].load('index.php/ctrl_identitas_bmt/read');
	w2ui['grid_dt_identitas_bmt'].on('reload', function(event) {
		this.load('index.php/ctrl_identitas_bmt/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening.show('right', true);
	
	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_identitas_bmt.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening = w2ui.form_add_nomor_rekening;
		event.onComplete = function () {
			var sel = grid.getSelection();
			
			if (sel.length == 1) {
				//both of this similiar line is same
				form_add_nomor_rekening.record.Kode_Cabang = sel[0];
				form_add_nomor_rekening.refresh();

			} else {
				form_add_nomor_rekening.clear();
			}
		}
	});

}

function openPopup_Id_Daftar_Akun(){
	$().w2destroy('grid_dt_daftar_akun');
	w2ui.layout_nomor_rekening.content('right', $().w2grid(config_nomor_rekening.grid_dt_daftar_akun));

	w2ui['grid_dt_daftar_akun'].load('index.php/ctrl_daftar_akun/read');
	w2ui['grid_dt_daftar_akun'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_akun/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening.show('right', true);

	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_daftar_akun.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening = w2ui.form_add_nomor_rekening;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening.record.Id_Daftar_Akun  = sel[0];
				form_add_nomor_rekening.refresh();
			} else {
				form_add_nomor_rekening.clear();
			}
		}
	});


}

function openPopup_Id_Nasabah(){
	$().w2destroy('grid_dt_nasabah');
	w2ui.layout_nomor_rekening.content('right', $().w2grid(config_nomor_rekening.grid_dt_nasabah));

	w2ui['grid_dt_nasabah'].load('index.php/ctrl_nasabah/read');
	w2ui['grid_dt_nasabah'].on('reload', function(event) {
		this.load('index.php/ctrl_nasabah/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});	

	w2ui.layout_nomor_rekening.show('right', true);

	w2ui.grid_dt_nasabah.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening = w2ui.form_add_nomor_rekening;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening.record.Id_Supplier = null;
				form_add_nomor_rekening.record.NIK = null;
				form_add_nomor_rekening.record.Id_Nasabah  = sel[0];
				form_add_nomor_rekening.refresh();
			} else {
				form_add_nomor_rekening.clear();
			}
		}
	});


}

function openPopup_Id_Supplier(){
	$().w2destroy('grid_dt_supplier');
	w2ui.layout_nomor_rekening.content('right', $().w2grid(config_nomor_rekening.grid_dt_supplier));

	w2ui['grid_dt_supplier'].load('index.php/ctrl_supplier/read');
	w2ui['grid_dt_supplier'].on('reload', function(event) {
		this.load('index.php/ctrl_supplier/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening.show('right', true);
	w2ui.grid_dt_supplier.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening = w2ui.form_add_nomor_rekening;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening.record.Id_Nasabah  = null;
				form_add_nomor_rekening.record.NIK = null;
				form_add_nomor_rekening.record.Id_Supplier = sel[0];
				form_add_nomor_rekening.refresh();
			} else {
				form_add_nomor_rekening.clear();
			}
		}
	});

}

function openPopup_NIK(){
	$().w2destroy('grid_dt_pegawai');
	w2ui.layout_nomor_rekening.content('right', $().w2grid(config_nomor_rekening.grid_dt_pegawai));

	w2ui['grid_dt_pegawai'].load('index.php/ctrl_pegawai/read');
	w2ui['grid_dt_pegawai'].on('reload', function(event) {
		this.load('index.php/ctrl_pegawai/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});	

	w2ui.layout_nomor_rekening.show('right', true);

	w2ui.grid_dt_pegawai.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening = w2ui.form_add_nomor_rekening;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening.record.Id_Nasabah  = null;
				form_add_nomor_rekening.record.Id_Supplier = null;
				form_add_nomor_rekening.record.NIK = sel[0];
				form_add_nomor_rekening.refresh();
			} else {
				form_add_nomor_rekening.clear();
			}
		}
	});


}


</script>