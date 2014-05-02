<?php
$attributes = array('class' => "confirm-dialog", 'role' => 'form');
$Username = array('name' => 'Username', 'type' => 'text', 'value' => 'admin');
$Password = array('name' => 'Password', 'type' => 'password', 'value' => 'admin');
$Subkan = array('type' => 'submit', 'name' => 'submit', 'value' => 'Sign in');

echo form_open('site/validate', $attributes);
echo form_input($Username);
echo form_password($Password);
echo form_submit($Subkan);
echo form_close();
?>
<script>
$('#grid').w2grid({
	name: 'grid',
	header: 'grid',
	show: {
		header : true,
		toolbar : true,
		footer : true,
		lineNumbers : true,
		toolbarAdd : true,
		toolbarDelete : true
	},
	columns: [
		{ field: 'recid',caption: 'ID', size: '10%' },
		{ field: 'text', caption: 'Text', size: '50%' },
		{ field: 'href', caption: 'Link', size: '40%' }
	],
	records: data,
	toolbar: {
		onClick: function (target, data) {
			var sel = w2ui['grid'].getSelection();
			switch(target) {
				case 'add':
				break;
				case 'delete-selected':
				var sel = w2ui['grid'].getSelection();
				w2ui['grid'].record_to_delete = sel[0];
				break;
			}
		}
	},
	onDelete: function(target, eventData) {
		eventData.onComplete = function () {
			$.post("seo_links.php", {action: 'delete_link', id: w2ui['grid'].record_to_delete}, function(data) {
				delete w2ui['grid'].record_to_delete;
			}, "JSON");
		}
	}
});


==============================


	onDelete: function (target, data) {
	data.preventDefault();
	$().w2popup({
		width	: 400,
		height	: 180,
		showMax	: false,
		title	: 'Konfirmasi Penghapusan Data',
		body	: '<div class="w2ui-grid-delete-msg">Apakah Anda yakin untuk menghapus data ini?</div>',
		buttons	: '<input type="button" value="No" onclick="$().w2popup(\'close\');" class="w2ui-grid- popup-btn">' +
				  '<input type="button" value="Ya" onclick="deleteGridRecord(); $().w2popup(\'close\');" class="w2ui-grid-popup-btn">'
	});}



	function deleteGridRecord() {
		var recid = w2grid.getSelection();
		if (recid > 0) {
			$.ajax({
				url		: "/Employee/Delete/" + recid,
				type	: "POST",
				async	: true
			}).done(function (e) {
			// validate if your server has already deleted the record, if succeeded then remove data from the grid
			w2grid.remove(recid);
			});
		}
	}


</script>