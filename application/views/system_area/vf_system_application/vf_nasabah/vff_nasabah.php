<script type="text/javascript">
// widget configuration
var config_nasabah = {
	grid_nasabah: { 
        name : 'grid_nasabah',
        header : 'Data Nasabah BMT AL-Hikma',
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
            { field: 'recid', caption: 'ID Nasabah', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama', size: '150px', searchable: true, sortable: true },
            { field: 'Alamat', caption: 'Alamat', size: '150px', searchable: true, sortable: true },
            { field: 'Nomor_KTP', caption: 'Nomor KTP', size: '100%', searchable: true, sortable: true },
            { field: 'Status', caption: 'Status', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_nasabah(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_nasabah(event.recid); 
			var grid = this;
			var form_nasabah = w2ui.form_edit_nasabah;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_nasabah.recid  = sel[0];
					form_nasabah.record = $.extend(true, {}, grid.get(sel[0]));
					form_nasabah.refresh();
				} else {
					form_nasabah.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_nasabah'].getSelection();
			event.preventDefault();
			call_delete_nasabah(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_nasabah'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_nasabah'].add([
				{ recid: 0, name: 'No. Urut :', value: record.Id_Nasabah },
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
	grid_detail_nasabah: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_nasabah', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_nasabah: {
		name: 'form_edit_nasabah',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'ID Nasabah', attr: 'size="10" readonly' } },
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
						w2ui['grid_nasabah'].set(data.records.Id_Nasabah, data.records);
						w2ui['grid_nasabah'].refresh();
						w2ui['grid_nasabah'].selectNone();
						w2ui['grid_detail_nasabah'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_nasabah: {
		name: 'form_add_nasabah',
		fields: [
			{ name: 'Id_Nasabah', type: 'text', required: true, html: { caption: 'ID Nasabah', attr: 'size="10" readonly' } },
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
				gen_Id_Nasabah();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_nasabah'].add(data.records);
						w2ui['grid_nasabah'].selectNone();
						$().w2popup('close');
					}
				});
				
			}
		}
	},

	form_delete_nasabah:{
		name: 'form_delete_nasabah',
		style: 'border: 0px; background-color: transparent;',
		//url : 'index.php/ctrl_nasabah/delete/' + delrecid,
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
							w2ui['grid_nasabah'].remove(data.delrecid);
							w2ui['grid_detail_nasabah'].clear();
							$().w2popup('close');
						}
					// if error, it is already displayed by w2form
					});
				},
				"cancel": function () {
					$().w2popup('close');
				}
			}		
	}
		
}

$(function () {
	$().w2form(config_nasabah.form_add_nasabah);
	$().w2form(config_nasabah.form_edit_nasabah);
	$().w2form(config_nasabah.form_delete_nasabah);
	
});


function call_edit_nasabah(recid) {
	$().w2popup('open', {
		title	: 'Edit nasabah',
		body	: '<div id="form_edit_nasabah" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_nasabah.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_nasabah.box).show();
				w2ui.form_edit_nasabah.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_nasabah.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_nasabah.box).show();
				w2ui.form_edit_nasabah.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_nasabah').w2render('form_edit_nasabah');
				w2ui['form_edit_nasabah'].url = {save: 'index.php/ctrl_nasabah/update/'};
				
			}
		}
	});
	
}

function call_add_nasabah(recid) {
	$().w2popup('open', {
		title	: 'Add nasabah',
		body	: '<div id="form_add_nasabah" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_nasabah.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_nasabah.box).show();
				w2ui.form_add_nasabah.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_nasabah.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_nasabah.box).show();
				w2ui.form_add_nasabah.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_nasabah').w2render('form_add_nasabah');
				w2ui['form_add_nasabah'].url = {save: 'index.php/ctrl_nasabah/create/'};
				//w2ui['form_add_nasabah'].action('Reset');
				gen_Id_Nasabah();
			}
		}
	});
	
}

function call_delete_nasabah(delrecid){
	$().w2popup('open', {
		title	: 'Delete nasabah',
		body	: '<div id="form_popup_nasabah" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_nasabah').w2render('form_delete_nasabah');
				w2ui['form_delete_nasabah'].url = {save: 'index.php/ctrl_nasabah/delete/' + delrecid};
			//url : 'index.php/ctrl_nasabah/delete/' + delrecid,
			}
		},
	});	
}

function gen_Id_Nasabah(){
	  $.get("index.php/ctrl_nasabah/getLastRec",function(data){
	  		w2ui['form_add_nasabah'].record.Id_Nasabah = "N"+''+data;
	  		//$('#NIK').val(data);
	  		w2ui['form_add_nasabah'].refresh();
	  });
}



</script>