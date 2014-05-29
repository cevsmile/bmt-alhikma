<script type="text/javascript">
// widget configuration
var config_nomor_rekening_daftar_akun = {
	layout_nomor_rekening_daftar_akun: {
		name: 'layout_nomor_rekening_daftar_akun',
		padding: 2,
		panels: [
			{ type: 'main', size: '50%', resizable: true, minSize: 2 },
			{ type: 'right', size: '50%', resizable: true, minSize: 2, hidden: true },
		]
	},

	grid_nomor_rekening_daftar_akun: { 
        name : 'grid_nomor_rekening_daftar_akun',
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
            { field: 'recid', caption: 'Kode Nomor Rekening', size: '150px', searchable: true, sortable: true },
            { field: 'namagabungan', caption: 'Nama', size: '100%', searchable: true, sortable: true },
            { field: 'Saldo_Awal', caption: 'Saldo Awal', size: '100px', searchable: true, sortable: true },
            { field: 'Saldo_Akhir', caption: 'Saldo Akhir', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_nomor_rekening_daftar_akun(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_nomor_rekening_daftar_akun(event.recid); 
			var grid = this;
			var form_edit_nomor_rekening_daftar_akun = w2ui.form_edit_nomor_rekening_daftar_akun;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_nomor_rekening_daftar_akun.recid  = sel[0];
					form_edit_nomor_rekening_daftar_akun.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_nomor_rekening_daftar_akun.refresh();
				} else {
					form_edit_nomor_rekening_daftar_akun.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_nomor_rekening_daftar_akun'].getSelection();
			event.preventDefault();
			call_delete_nomor_rekening_daftar_akun(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_nomor_rekening_daftar_akun'].clear();
			var record = this.get(event.recid);
			//console.log(event.recid);
			w2ui['grid_detail_nomor_rekening_daftar_akun'].add([
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
	grid_detail_nomor_rekening_daftar_akun: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_nomor_rekening_daftar_akun', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_nomor_rekening_daftar_akun: {
		name: 'form_edit_nomor_rekening_daftar_akun',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Nomor Rekening', attr: 'size="20" readonly ' } },
			//{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Kode_Cabang2()"' } },
			//{ name: 'Id_Daftar_Akun', type: 'text', required: true, html: { caption: 'Daftar Akun', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Daftar_Akun2()"' } },
			//{ name: 'Id_Nasabah', type: 'text', html: { caption: 'ID Nasabah', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Nasabah2()"' } },
			//{ name: 'Id_Supplier', type: 'text', html: { caption: 'ID Supplier', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Supplier2()"' } },
			//{ name: 'NIK', type: 'text', html: { caption: 'NIK', attr: 'size="20" maxlength="20" readonly onclick="openPopup_NIK2()"' } },
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
						w2ui['grid_nomor_rekening_daftar_akun'].set(data.records.Kode_Norek, data.records);
						w2ui['grid_nomor_rekening_daftar_akun'].refresh();
						w2ui['grid_nomor_rekening_daftar_akun'].selectNone();
						w2ui['grid_detail_nomor_rekening_daftar_akun'].clear();
						*/
						w2ui['grid_nomor_rekening_daftar_akun'].load('index.php/ctrl_nomor_rekening/Qread');
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_nomor_rekening_daftar_akun: {
		name: 'form_add_nomor_rekening_daftar_akun',
		fields: [
			{ name: 'Kode_Norek', type: 'text', required: true, html: { caption: 'Nomor Rekening', attr: 'size="20" readonly ' } },
			{ name: 'Kode_Cabang', type: 'text', required: true, html: { caption: 'Kode Cabang', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Kode_Cabang2()"' } },
			{ name: 'Id_Daftar_Akun', type: 'text', required: true, html: { caption: 'Daftar Akun', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Daftar_Akun2()"' } },
			{ name: 'Id_Nasabah', type: 'text', html: { caption: 'ID Nasabah', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Nasabah2()"' } },
			{ name: 'Id_Supplier', type: 'text', html: { caption: 'ID Supplier', attr: 'size="20" maxlength="20" readonly onclick="openPopup_Id_Supplier2()"' } },
			{ name: 'NIK', type: 'text', html: { caption: 'NIK', attr: 'size="20" maxlength="20" readonly onclick="openPopup_NIK2()"' } },
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
						
						w2ui['grid_nomor_rekening_daftar_akun'].load('index.php/ctrl_nomor_rekening/Qread');
						//w2ui['grid_nomor_rekening_daftar_akun'].add(data.records);
						//w2ui['grid_nomor_rekening_daftar_akun'].selectNone();
						
						$().w2popup('close');
					}
				});
			}
		}
	},
	grid_dt_identitas_bmt2: { 
        name : 'grid_dt_identitas_bmt2',
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
	grid_dt_daftar_akun2: { 
        name : 'grid_dt_daftar_akun2',
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
	grid_dt_nasabah2: { 
        name : 'grid_dt_nasabah2',
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
	grid_dt_supplier2: { 
        name : 'grid_dt_supplier2',
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
	grid_dt_pegawai2: { 
        name : 'grid_dt_pegawai2',
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
	//put grid to memory so we can re use it without have to destroy the object
	//in this case, we are not use this grid on this page, but with the control page
	$().w2grid(config_nomor_rekening_daftar_akun.grid_nomor_rekening_daftar_akun);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_detail_nomor_rekening_daftar_akun);

	//initialize everythings in memory. We can re-use it without destroying the object
	$().w2layout(config_nomor_rekening_daftar_akun.layout_nomor_rekening_daftar_akun);
	$().w2form(config_nomor_rekening_daftar_akun.form_edit_nomor_rekening_daftar_akun);
	$().w2form(config_nomor_rekening_daftar_akun.form_add_nomor_rekening_daftar_akun);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_dt_identitas_bmt2);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_dt_daftar_akun2);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_dt_nasabah2);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_dt_supplier2);
	$().w2grid(config_nomor_rekening_daftar_akun.grid_dt_pegawai2);
});

function call_edit_nomor_rekening_daftar_akun(recid) {

	w2ui.layout_nomor_rekening_daftar_akun.content('main', w2ui.form_edit_nomor_rekening_daftar_akun);

	$().w2popup('open', {
		title	: 'Edit Nomor Rekening BMT',
		body	: '<div id="popup_edit_nomor_rekening_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 700,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_nomor_rekening_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening_daftar_akun.box).show();
				w2ui.layout_nomor_rekening_daftar_akun.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_nomor_rekening_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening_daftar_akun.box).show();
				w2ui.layout_nomor_rekening_daftar_akun.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #popup_edit_nomor_rekening_daftar_akun').w2render('layout_nomor_rekening_daftar_akun');
				w2ui['form_edit_nomor_rekening_daftar_akun'].url = {save: 'index.php/ctrl_nomor_rekening/update/'};
				
				
			}
		}
	});
	
}

function call_add_nomor_rekening_daftar_akun(recid) {

	w2ui.layout_nomor_rekening_daftar_akun.content('main', w2ui.form_add_nomor_rekening_daftar_akun);


	w2ui.form_add_nomor_rekening_daftar_akun.on('refresh', function(event){
		var Kode_Cabang = [this.record.Kode_Cabang],
			Id_Daftar_Akun = [this.record.Id_Daftar_Akun],
			Id_Nasabah = [this.record.Id_Nasabah],
			Id_Supplier = [this.record.Id_Supplier],
			NIK = [this.record.NIK],
			cekakhir = [Id_Nasabah+Id_Supplier+NIK];


			this.record.Kode_Norek = Kode_Cabang+'.'+Id_Daftar_Akun+'.'+ cekakhir;
			
			event.onComplete = function () {

				if ((Kode_Cabang && Id_Daftar_Akun && cekakhir) != '') {
					var myKodeNorek = this.record.Kode_Norek;
					$('#Kode_Norek').w2tag('Data Valid, Silakan Disimpan.', {onShow : cekNorekValid(myKodeNorek)});					
				}
				if (cekakhir == '') $('#Kode_Norek').w2tag('Isi Field Terakhir!');
				if (Id_Daftar_Akun == '') $('#Kode_Norek').w2tag('Isi Daftar Akun!');
				if (Kode_Cabang == '') $('#Kode_Norek').w2tag('Isi Kode Cabang!');

			console.log('1. ',Kode_Cabang,'2. ',Id_Daftar_Akun,'3. ',cekakhir);
			}
	});



	$().w2popup('open', {
		title	: 'Add Nomor Rekening BMT',
		body	: '<div id="form_add_nomor_rekening_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 800,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.layout_nomor_rekening_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening_daftar_akun.box).show();
				w2ui.layout_nomor_rekening_daftar_akun.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.layout_nomor_rekening_daftar_akun.box).hide();
			event.onComplete = function () {
				$(w2ui.layout_nomor_rekening_daftar_akun.box).show();
				w2ui.layout_nomor_rekening_daftar_akun.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				
				$('#w2ui-popup #form_add_nomor_rekening_daftar_akun').w2render('layout_nomor_rekening_daftar_akun');
				w2ui['form_add_nomor_rekening_daftar_akun'].url = {save: 'index.php/ctrl_nomor_rekening/create/'};
				w2ui['form_add_nomor_rekening_daftar_akun'].action('Reset');
			}
		},
		onClose	: function (event) {
			event.onComplete = function () {
				w2ui['form_add_nomor_rekening_daftar_akun'].action('Reset');
			}
		}

	});
	
}





function call_delete_nomor_rekening_daftar_akun(delrecid){
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
							w2ui['grid_nomor_rekening_daftar_akun'].remove(delrecid);
							w2ui['grid_detail_nomor_rekening_daftar_akun'].clear();
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
		body	: '<div id="form_popup_nomor_rekening_daftar_akun" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_nomor_rekening_daftar_akun').w2render('deletedialog');
			}
		},
	});	
}






function openPopup_Kode_Cabang2(){
	w2ui.layout_nomor_rekening_daftar_akun.content('right', w2ui.grid_dt_identitas_bmt2);

	w2ui['grid_dt_identitas_bmt2'].load('index.php/ctrl_identitas_bmt/read');
	w2ui['grid_dt_identitas_bmt2'].on('reload', function(event) {
		this.load('index.php/ctrl_identitas_bmt/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening_daftar_akun.show('right', true);
	
	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_identitas_bmt2.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening_daftar_akun = w2ui.form_add_nomor_rekening_daftar_akun;
		event.onComplete = function () {
			var sel = grid.getSelection();
			
			if (sel.length == 1) {
				//both of this similiar line is same
				form_add_nomor_rekening_daftar_akun.record.Kode_Cabang = sel[0];
				form_add_nomor_rekening_daftar_akun.refresh();
				w2ui['grid_dt_identitas_bmt2'].reset();

			} else {
				form_add_nomor_rekening_daftar_akun.clear();
			}
		}
	});

}

function openPopup_Id_Daftar_Akun2(){
	w2ui.layout_nomor_rekening_daftar_akun.content('right', w2ui.grid_dt_daftar_akun2);

	w2ui['grid_dt_daftar_akun2'].load('index.php/ctrl_daftar_akun/read');
	w2ui['grid_dt_daftar_akun2'].on('reload', function(event) {
		this.load('index.php/ctrl_daftar_akun/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening_daftar_akun.show('right', true);

	//click event to copy selected recid into specific field in the form
	w2ui.grid_dt_daftar_akun2.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening_daftar_akun = w2ui.form_add_nomor_rekening_daftar_akun;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening_daftar_akun.record.Id_Daftar_Akun  = sel[0];
				form_add_nomor_rekening_daftar_akun.refresh();
				w2ui['grid_dt_daftar_akun2'].reset();
			} else {
				form_add_nomor_rekening_daftar_akun.clear();
			}
		}
	});


}

function openPopup_Id_Nasabah2(){
	w2ui.layout_nomor_rekening_daftar_akun.content('right', w2ui.grid_dt_nasabah2);

	w2ui['grid_dt_nasabah2'].load('index.php/ctrl_nasabah/read');
	w2ui['grid_dt_nasabah2'].on('reload', function(event) {
		this.load('index.php/ctrl_nasabah/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});	

	w2ui.layout_nomor_rekening_daftar_akun.show('right', true);

	w2ui.grid_dt_nasabah2.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening_daftar_akun = w2ui.form_add_nomor_rekening_daftar_akun;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening_daftar_akun.record.Id_Supplier = null;
				form_add_nomor_rekening_daftar_akun.record.NIK = null;
				form_add_nomor_rekening_daftar_akun.record.Id_Nasabah  = sel[0];
				form_add_nomor_rekening_daftar_akun.refresh();
				w2ui['grid_dt_nasabah2'].reset();
			} else {
				form_add_nomor_rekening_daftar_akun.clear();
			}
		}
	});


}

function openPopup_Id_Supplier2(){
	w2ui.layout_nomor_rekening_daftar_akun.content('right', w2ui.grid_dt_supplier2);

	w2ui['grid_dt_supplier2'].load('index.php/ctrl_supplier/read');
	w2ui['grid_dt_supplier2'].on('reload', function(event) {
		this.load('index.php/ctrl_supplier/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});

	w2ui.layout_nomor_rekening_daftar_akun.show('right', true);
	w2ui.grid_dt_supplier2.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening_daftar_akun = w2ui.form_add_nomor_rekening_daftar_akun;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening_daftar_akun.record.Id_Nasabah  = null;
				form_add_nomor_rekening_daftar_akun.record.NIK = null;
				form_add_nomor_rekening_daftar_akun.record.Id_Supplier = sel[0];
				form_add_nomor_rekening_daftar_akun.refresh();
				w2ui['grid_dt_supplier2'].reset();
			} else {
				form_add_nomor_rekening_daftar_akun.clear();
			}
		}
	});

}

function openPopup_NIK2(){
	w2ui.layout_nomor_rekening_daftar_akun.content('right', w2ui.grid_dt_pegawai2);

	w2ui['grid_dt_pegawai2'].load('index.php/ctrl_pegawai/read');
	w2ui['grid_dt_pegawai2'].on('reload', function(event) {
		this.load('index.php/ctrl_pegawai/read');
		this.selectNone();
		this.reset();
		this.refresh();
	});	

	w2ui.layout_nomor_rekening_daftar_akun.show('right', true);

	w2ui.grid_dt_pegawai2.on('click', function(event) {
		var grid = this;
		var form_add_nomor_rekening_daftar_akun = w2ui.form_add_nomor_rekening_daftar_akun;
		event.onComplete = function () {
			var sel = grid.getSelection();
			if (sel.length == 1) {
				form_add_nomor_rekening_daftar_akun.record.Id_Nasabah  = null;
				form_add_nomor_rekening_daftar_akun.record.Id_Supplier = null;
				form_add_nomor_rekening_daftar_akun.record.NIK = sel[0];
				form_add_nomor_rekening_daftar_akun.refresh();
				w2ui['grid_dt_pegawai2'].reset();
			} else {
				form_add_nomor_rekening_daftar_akun.clear();
			}
		}
	});


}

function cekNorekValid(myKodeNorek){
	$.get("index.php/ctrl_nomor_rekening/cekNorek/"+ myKodeNorek ,function(data){
		var data = data.replace(/"/g, '');
		$('#Kode_Norek').val(data)
		w2ui['form_add_nomor_rekening_daftar_akun'].record.Kode_Norek = data;
	});
}

</script>