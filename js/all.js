
$(function() {
	sampleGrid3();
});


function sampleGrid1(){
	$.ajax({
		url : 'index.php/home/read',
		dataType : 'json',
		success : function(response) {
			var myRecords = [];
			for (var i in response) {
				myRecords.push({
					recid : response[i].id,
					name  : response[i].name,
					email : response[i].email
				});
			}
			$('#grid').w2grid({
				name : 'grid',
				columns : [
					{field : 'recid', caption : 'ID',size : '50px'},
					{field : 'name', caption : 'Name',size : '30%'},
					{field : 'email', caption : 'Email', size : '40%'}
				],
				records : myRecords
			}); console.log(myRecords);
		}
	});
	// end of ajax
	
}


function sampleGrid3() {
	$.get("index.php/home/read", function(data) {
		var myRecords = [];
		for (var i in data) {
			myRecords.push({
				recid : data[i].id,
				name : data[i].name,
				email : data[i].email
			});
		}
		$('#grid').w2grid({
			name : 'grid',
			columns : [
			{field : 'recid', caption : 'ID', size : '50px'},
			{field : 'name', caption : 'Name', size : '30%'},
			{field : 'email', caption : 'Email', size : '40%'}],
			records : myRecords
		});
	}, "json"); 
}



