<script type="text/javascript">
// widget configuration
var config_supplier = {
	grid_supplier: { 
        name : 'grid_supplier',
        header : 'Supplier BMT AL-Hikma',
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
            { field: 'recid', caption: 'Nomor Urut Supplier', size: '150px', searchable: true, sortable: true },
            { field: 'Nama', caption: 'Nama Supplier', size: '150px', searchable: true, sortable: true },
            { field: 'Alamat', caption: 'Alamat Supplier', size: '150px', searchable: true, sortable: true },
            { field: 'NPWP', caption: 'NPWP', size: '100%', searchable: true, sortable: true }
        ],
        onAdd: function (event) {
	        call_add_supplier(event.recid);
        },
        onDblClick: function (event) {
         	call_edit_supplier(event.recid); 
			var grid = this;
			var form_edit_supplier = w2ui.form_edit_supplier;
			event.onComplete = function () {
				var sel = grid.getSelection();
				if (sel.length == 1) {
					form_edit_supplier.recid  = sel[0];
					form_edit_supplier.record = $.extend(true, {}, grid.get(sel[0]));
					form_edit_supplier.refresh();
				} else {
					form_edit_supplier.clear();
				}
			}
        },
		onDelete: function(event) {
			var delrecid= w2ui['grid_supplier'].getSelection();
			event.preventDefault();
			call_delete_supplier(delrecid);
			//console.log(delrecid);
		},	        
		onClick: function (event) {
			w2ui['grid_detail_supplier'].clear();
			var record = this.get(event.recid);
			
			w2ui['grid_detail_supplier'].add([
				{ recid: 0, name: 'Nomor Urut Supplier:', value: record.Id_Supplier },
				{ recid: 1, name: 'Nama Supplier:', value: record.Nama },
				{ recid: 2, name: 'Alamat Supplier:', value: record.Alamat },
				{ recid: 3, name: 'NPWP Supplier:', value: record.NPWP }
			]);
		}
	},
	grid_detail_supplier: { 
		header: 'Details',
		show: { header: true, columnHeaders: false },
		name: 'grid_detail_supplier', 
		columns: [				
			{ field: 'name', caption: 'Name', size: '100px', style: 'background-color: #efefef; border-bottom: 1px solid white; padding-right: 5px;', attr: "align=right" },
			{ field: 'value', caption: 'Value', size: '100%' }
		]
	},
	form_edit_supplier: {
		name: 'form_edit_supplier',
		fields: [
			{ name: 'recid', type: 'text', required: true, html: { caption: 'Nomor Urut Supplier', attr: 'size="20" readonly' } },
			{ name: 'Nama', type: 'text', required: true, html: { caption: 'Nama Supplier', attr: 'size="20" maxlength="20"' } },
			{ name: 'Alamat', type: 'text', required: true, html: { caption: 'Alamat Supplier', attr: 'size="20" maxlength="20"' } },
			{ name: 'NPWP', type: 'text', html: { caption: 'NPWP Supplier', attr: 'size="20" maxlength="20"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_supplier'].set(data.records.Kode_Akun, data.records);
						w2ui['grid_supplier'].refresh();
						w2ui['grid_supplier'].selectNone();
						w2ui['grid_detail_supplier'].clear();
						$().w2popup('close');
					}
				});				
				
			}
		}
	},
	form_add_supplier: {
		name: 'form_add_supplier',
		fields: [
			{ name: 'Id_Supplier', type: 'text', required: true, html: { caption: 'Nomor Urut Supplier', attr: 'size="20" readonly' } },
			{ name: 'Nama', type: 'text', html: { caption: 'Nama Supplier', attr: 'size="20" maxlength="20"' } },
			{ name: 'Alamat', type: 'text', html: { caption: 'Alamat Supplier', attr: 'size="20" maxlength="20"' } },
			{ name: 'NPWP', type: 'text', html: { caption: 'NPWP Supplier', attr: 'size="20" maxlength="20"' } }
		],
		actions: {
			Reset: function () {
				this.clear();
				gen_Id_Supplier();
			},
			Save: function () {
				this.save(function (data) {
					if (data.status == 'success') {
						w2ui['grid_supplier'].add(data.records);
						w2ui['grid_supplier'].selectNone();
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
	$().w2grid(config_supplier.grid_supplier);
	$().w2grid(config_supplier.grid_detail_supplier);

	//initialize fom in memory. We can re-use it without destroying the object		
	$().w2form(config_supplier.form_add_supplier);
	$().w2form(config_supplier.form_edit_supplier);
	
});


function call_edit_supplier(recid) {
	$().w2popup('open', {
		title	: 'Edit Supplier BMT',
		body	: '<div id="form_edit_supplier" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_edit_supplier.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_supplier.box).show();
				w2ui.form_edit_supplier.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_edit_supplier.box).hide();
			event.onComplete = function () {
				$(w2ui.form_edit_supplier.box).show();
				w2ui.form_edit_supplier.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_edit_supplier').w2render('form_edit_supplier');
				w2ui['form_edit_supplier'].url = {save: 'index.php/ctrl_supplier/update/'};
				
			}
		}
	});
	
}

function call_add_supplier(recid) {
	$().w2popup('open', {
		title	: 'Add Kode Akun BMT',
		body	: '<div id="form_add_supplier" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 400, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form_add_supplier.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_supplier.box).show();
				w2ui.form_add_supplier.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form_add_supplier.box).hide();
			event.onComplete = function () {
				$(w2ui.form_add_supplier.box).show();
				w2ui.form_add_supplier.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_add_supplier').w2render('form_add_supplier');
				w2ui['form_add_supplier'].url = {save: 'index.php/ctrl_supplier/create/'};
				gen_Id_Supplier();
			}
		}
	});
	
}

function call_delete_supplier(delrecid){
	$().w2destroy('deletedialog');
	$('#deletedialog').w2form({ 
		name: 'deletedialog',
		style: 'border: 0px; background-color: transparent;',
		url : 'index.php/ctrl_supplier/delete/' + delrecid,
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
							w2ui['grid_supplier'].remove(delrecid);
							w2ui['grid_detail_supplier'].clear();
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
		body	: '<div id="form_popup_supplier" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form_popup_supplier').w2render('deletedialog');
			}
		},
	});	
	
}

function gen_Id_Supplier(){
	  $.get("index.php/ctrl_supplier/getLastRec",function(data){
	  		w2ui['form_add_supplier'].record.Id_Supplier = "S"+''+data;
	  		//$('#NIK').val(data);
	  		w2ui['form_add_supplier'].refresh();
	  });
}


</script>