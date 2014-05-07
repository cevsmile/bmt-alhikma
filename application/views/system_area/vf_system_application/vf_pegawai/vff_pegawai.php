<div id="main" style="width: 100%; height: 500px;"></div>

<script type="text/javascript">
// widget configuration

function editUser(recid) {
	$().w2popup('open', {
		title	: 'Edit Pegawai',
		body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form.box).hide();
			event.onComplete = function () {
				$(w2ui.form.box).show();
				w2ui.form.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form.box).hide();
			event.onComplete = function () {
				$(w2ui.form.box).show();
				w2ui.form.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render('form');
				w2ui['form'].url = {save: 'index.php/ctrl_pegawai/update/'};
				
			}
		}
	});
	
}

function addUser(recid) {
	$().w2popup('open', {
		title	: 'Add Pegawai',
		body	: '<div id="form2" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 0px 0px 0px 0px',
		width	: 500,
		height	: 600, 
		showMax : true,
		onMin	: function (event) {
			$(w2ui.form2.box).hide();
			event.onComplete = function () {
				$(w2ui.form2.box).show();
				w2ui.form2.resize();
			}
		},
		onMax	: function (event) {
			$(w2ui.form2.box).hide();
			event.onComplete = function () {
				$(w2ui.form2.box).show();
				w2ui.form2.resize();
			}
		},
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form2').w2render('form2');
				w2ui['form2'].url = {save: 'index.php/ctrl_pegawai/create/'};
				w2ui['form2'].action('Reset');
			}
		}
	});
	
}

function deleteUser(delrecid){
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
							w2ui['users'].remove(delrecid);
							w2ui['users1'].clear();
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
		body	: '<div id="form" style="width: 100%; height: 100%;"></div>',
		style	: 'padding: 15px 0px 0px 0px',
		width	: 500,
		height	: 300, 
		onOpen	: function (event) {
			event.onComplete = function () {
				$('#w2ui-popup #form').w2render('deletedialog');
			}
		},
	});	
	
}
</script>